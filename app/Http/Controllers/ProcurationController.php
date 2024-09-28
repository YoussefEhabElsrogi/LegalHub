<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProcurationRequest;
use App\Models\Client;
use App\Models\Procuration;
use Illuminate\Http\Request;
use App\Helpers\FileHelper;
use App\Http\Requests\UpdateProcurationRequest;
use App\Models\File;

class ProcurationController extends Controller
{
    public function index()
    {
        $procurations = Procuration::latest()->paginate(10);
        return view('dashboard.procuration.index', compact('procurations'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('dashboard.procuration.create', compact('clients'));
    }

    public function store(StoreProcurationRequest $request)
    {
        $validatedData = $request->validated();
        $procuration = $this->createProcuration($validatedData);

        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $file) {
                $path = storeFile($file, 'uploads/procurations', 'uploads');
                $procuration->files()->create(['path' => $path]);
            }
        }

        setFlashMessage('success', 'تم إضافة التوكيل بنجاح.');
        return to_route('procuration.index');
    }

    public function show($id)
    {
        $procuration = Procuration::with('files', 'client')->findOrFail($id);
        return view('dashboard.procuration.show', compact('procuration'));
    }

    public function edit(string $id)
    {
        $procuration = Procuration::findOrFail($id);
        $clients = Client::all();
        return view('dashboard.procuration.edit', compact('procuration', 'clients'));
    }

    public function update(UpdateProcurationRequest $request, string $id)
    {
        $procuration = Procuration::findOrFail($id);
        $validatedData = $request->validated();

        $procuration->update($validatedData);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = storeFile($file, 'uploads/procurations', 'uploads');

                $procuration->files()->create([
                    'path' => $filePath,
                ]);
            }
        }

        setFlashMessage('success', 'تم تحديث التوكيل بنجاح.');
        return to_route('procuration.index');
    }

    public function destroy(string $id)
    {
        $procuration = Procuration::findOrFail($id);

        $procuration->delete();

        if ($procuration->files->isNotEmpty()) {
            foreach ($procuration->files as $file) {
                deleteFile($file->path, 'uploads');
            }
        }

        setFlashMessage('success', 'تم حذف التوكيل بنجاح.');

        return to_route('procuration.index');
    }
    private function createProcuration(array $validatedData)
    {
        return Procuration::create([
            'client_id' => $validatedData['client_id'],
            'authorization_number' => $validatedData['authorization_number'],
            'notebook_number' => $validatedData['notebook_number'],
            'notes' => $validatedData['notes'],
        ]);
    }
}
