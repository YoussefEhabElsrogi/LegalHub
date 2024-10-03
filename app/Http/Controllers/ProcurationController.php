<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcurationRequest;
use App\Http\Requests\UpdateProcurationRequest;
use App\Models\Client;
use App\Models\Procuration;
use App\Services\FileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProcurationController extends Controller
{
    protected FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index(): View
    {
        $procurations = Procuration::select(['id', 'client_id', 'authorization_number', 'notebook_number', 'notes'])
            ->latest()
            ->paginate(10);

        return view('dashboard.procuration.index', compact('procurations'));
    }

    public function create(): View
    {
        $clients = Client::select(['id', 'name'])->get();
        return view('dashboard.procuration.create', compact('clients'));
    }

    public function store(StoreProcurationRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        return $this->saveProcuration(function () use ($validatedData, $request) {
            $procuration = $this->createProcuration($validatedData);
            $this->handleFileUpload($request, $procuration->id);
        });
    }

    public function show(int $id): View
    {
        $procuration = Procuration::with('files', 'client')->findOrFail($id);
        return view('dashboard.procuration.show', compact('procuration'));
    }

    public function edit(int $id): View
    {
        $procuration = Procuration::findOrFail($id);
        $clients = Client::select(['id', 'name'])->get();

        return view('dashboard.procuration.edit', compact('procuration', 'clients'));
    }

    public function update(UpdateProcurationRequest $request, int $id): RedirectResponse
    {
        $procuration = Procuration::findOrFail($id);
        $validatedData = $request->validated();

        return $this->saveProcuration(function () use ($procuration, $validatedData, $request) {
            $procuration->update($validatedData);
            $this->handleFileUpload($request, $procuration->id);
        });
    }

    public function destroy(int $id): RedirectResponse
    {
        $procuration = Procuration::findOrFail($id);

        if ($procuration->files->isNotEmpty()) {
            $this->deleteProcurationFiles($procuration);
        }

        $procuration->delete();

        setFlashMessage('success', 'تم حذف التوكيل بنجاح.');

        return to_route('procurations.index');
    }

    private function saveProcuration(callable $callback): RedirectResponse
    {
        try {
            $callback();
            setFlashMessage('success', 'تم تنفيذ العملية بنجاح.');
        } catch (\Exception $e) {
            setFlashMessage('error', 'حدث خطأ. حاول مرة أخرى.');
            return redirect()->back()->withInput();
        }

        return to_route('procurations.index');
    }

    private function createProcuration(array $validatedData): Procuration
    {
        return Procuration::create([
            'client_id' => $validatedData['client_id'],
            'authorization_number' => $validatedData['authorization_number'],
            'notebook_number' => $validatedData['notebook_number'],
            'notes' => $validatedData['notes'],
        ]);
    }

    private function handleFileUpload(Request $request, int $procurationId): void
    {
        $directory = 'procurations';
        $this->fileService->uploadFiles($request, $directory, $procurationId, 'Procuration');
    }

    private function deleteProcurationFiles(Procuration $procuration): void
    {
        foreach ($procuration->files as $file) {
            $this->fileService->deleteFile($file->path, 'uploads');
        }
        $procuration->files()->delete();
    }
}
