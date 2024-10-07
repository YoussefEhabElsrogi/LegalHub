<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\Client;
use App\Models\Reminder;
use App\Models\Session;
use App\Services\FileService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::with(['client:id,name'])->latest()->paginate(10);
        return view('dashboard.sessions.index', compact('sessions'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('dashboard.sessions.create', compact('clients'));
    }

    public function store(StoreSessionRequest $request)
    {
        return $this->handleSessionCreation($request);
    }

    public function show(string $id)
    {
        $session = Session::with('files', 'client', 'reminders')->findOrFail($id);
        return view('dashboard.sessions.show', compact('session'));
    }

    public function edit(string $id)
    {
        $session = Session::with('reminders')->findOrFail($id);
        $clients = Client::select(['id', 'name'])->get();
        return view('dashboard.sessions.edit', compact('session', 'clients'));
    }

    public function update(UpdateSessionRequest $request, string $id)
    {
        return $this->handleSessionUpdate($request, $id);
    }

    public function destroy(string $id)
    {
        $session = Session::findOrFail($id);
        $this->deleteSessionFiles($session);
        $session->delete();

        setFlashMessage('success', 'تم حذف الدعوي بنجاح.');
        return redirect()->route('sessions.index');
    }

    private function handleSessionCreation($request)
    {
        $validatedData = $request->validated();
        $session = $this->createSession($validatedData);

        if ($this->createReminders($request->reminder_dates, $session->id, $validatedData['session_date'])) {
            return $this->uploadFilesAndRedirect($request, $session->id, 'تم إنشاء الدعوي والتذكيرات بنجاح.');
        }

        return redirect()->back()->withInput();
    }

    private function handleSessionUpdate($request, string $id)
    {
        $session = Session::findOrFail($id);
        $validatedData = $request->validated();

        $session->update($validatedData);

        if ($this->updateReminders($request->reminder_dates, $session->id, $request->session_date)) {
            return $this->uploadFilesAndRedirect($request, $session->id, 'تم تحديث الدعوي بنجاح.');
        }

        return redirect()->back()->withInput();
    }

    private function uploadFilesAndRedirect($request, $sessionId, $successMessage)
    {
        DB::beginTransaction();

        try {
            $this->uploadSessionFiles($request, $sessionId);
            DB::commit();
            return redirect()->route('sessions.index')->with('success', $successMessage);
        } catch (Exception $e) {
            DB::rollBack();
            setFlashMessage('error', 'حدث خطأ حاول مرة أخرى.');
            return redirect()->back();
        }
    }

    private function createSession(array $validatedData)
    {
        return Session::create([
            'client_id' => $validatedData['client_id'],
            'session_type' => $validatedData['session_type'],
            'session_number' => $validatedData['session_number'],
            'opponent_name' => $validatedData['opponent_name'],
            'session_date' => Carbon::parse($validatedData['session_date'])->toDate(),
            'session_status' => $validatedData['session_status'],
            'notes' => $validatedData['notes'] ?? null,
        ]);
    }

    private function createReminders(array $reminderDates, string $sessionId, string $sessionDate)
    {
        return $this->processReminders($reminderDates, $sessionId, $sessionDate, 'create');
    }

    private function updateReminders(array $reminderDates, string $sessionId, string $sessionDate)
    {
        Reminder::where('session_id', $sessionId)->delete();
        return $this->processReminders($reminderDates, $sessionId, $sessionDate, 'update');
    }

    private function processReminders(array $reminderDates, string $sessionId, string $sessionDate, string $action)
    {
        $today = now()->startOfDay();
        $sessionDateCarbon = Carbon::parse($sessionDate);
        $reminderTimes = [];

        foreach ($reminderDates as $datesString) {
            $dates = explode(',', $datesString);

            foreach ($dates as $date) {
                $date = Carbon::parse($date)->startOfDay();

                if ($date->lessThan($today) || $date->greaterThan($sessionDateCarbon)) {
                    setFlashMessage('error', 'لا يمكن اختيار تواريخ قبل اليوم الحالي أو بعد ميعاد الدعوي.');
                    return false;
                }

                if (in_array($date->toDateString(), $reminderTimes)) {
                    setFlashMessage('error', 'توجد تواريخ مكررة. الرجاء التحقق منها.');
                    return false;
                }

                $reminderTimes[] = $date->toDateString();

                Reminder::{$action}([
                    'session_id' => $sessionId,
                    'reminder_time' => $date,
                ]);
            }
        }

        return true;
    }


    private function uploadSessionFiles($request, $sessionId)
    {
        $dir = 'sessions';
        FileService::uploadFiles($request, $dir, $sessionId, 'Session');
        setFlashMessage('success', 'تم رفع الملفات بنجاح');
    }

    private function deleteSessionFiles(Session $session)
    {
        if ($session->files->isNotEmpty()) {
            foreach ($session->files as $file) {
                FileService::deleteFile($file->path, 'uploads');
            }
        }
    }
}
