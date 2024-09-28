<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSessionRequest;
use App\Http\Requests\UpdateSessionRequest;
use App\Models\Client;
use App\Models\Session;
use Illuminate\Http\Request;

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
        $validatedData = $request->validated();

        $session = $this->createSession($validatedData);

        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $file) {
                $path = storeFile($file, 'uploads/sessions', 'uploads');
                $session->files()->create(['path' => $path]);
            }
        }
        setFlashMessage('success', 'تم إضافة الجلسة بنجاح.');

        return to_route('sessions.index');
    }
    public function show(string $id)
    {
        $session = Session::with('files', 'client')->findOrFail($id);
        return view('dashboard.sessions.show', compact('session'));
    }
    public function edit(string $id)
    {
        $session = Session::findOrFail($id);
        $clients = Client::all();
        return view('dashboard.sessions.edit', compact('session', 'clients'));
    }
    public function update(UpdateSessionRequest $request, string $id)
    {
        $session = Session::findOrFail($id);
        $validatedData = $request->validated();

        $session->update($validatedData);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = storeFile($file, 'uploads/sessions', 'uploads');
                $session->files()->create([
                    'path' => $filePath,
                ]);
            }
        }

        setFlashMessage('success', 'تم تحديث الجلسة بنجاح.');

        return to_route('sessions.index');
    }
    public function destroy(string $id)
    {
        $session = Session::findOrFail($id);

        $session->delete();

        if ($session->files->isNotEmpty()) {
            foreach ($session->files as $file) {
                deleteFile($file->path, 'uploads');
            }
        }

        setFlashMessage('success', 'تم حذف الجلسة بنجاح.');

        return to_route('sessions.index');
    }
    private function createSession(array $validatedData)
    {
        return Session::create([
            'client_id' => $validatedData['client_id'],
            'session_type' => $validatedData['session_type'],
            'session_number' => $validatedData['session_number'],
            'opponent_name' => $validatedData['opponent_name'],
            'session_date' => $validatedData['session_date'],
            'session_status' => $validatedData['session_status'],
            'notes' => $validatedData['notes'] ?? null,
        ]);
    }
}
