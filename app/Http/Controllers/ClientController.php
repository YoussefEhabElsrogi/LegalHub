<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Services\FileService;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(10);
        return view('dashboard.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('dashboard.clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        $validatedData = $request->validated();
        Client::create($validatedData);
        setFlashMessage('success', 'تم تسجيل العميل بنجاح');

        return to_route('clients.index');
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);

        // Eager load procurations and sessions with their associated files
        $procurations = $client->procurations()->with('files')->paginate(5, ['*'], 'procuration_page');
        $sessions = $client->sessions()->with('files')->paginate(5, ['*'], 'sessions_page');

        // Load expenses and paginate companies with associated files
        $expenses = $client->expenses;
        $companies = $client->companies()->with('files')->paginate(5, ['*'], 'companies_page');

        // Passing all data to the view
        return view('dashboard.clients.show', [
            'client' => $client,
            'procurations' => $procurations,
            'sessions' => $sessions,
            'expenses' => $expenses,
            'companies' => $companies,
        ]);
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('dashboard.clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $validatedData = $request->validated();
        $client->update($validatedData);
        setFlashMessage('success', 'تم تحديث العميل بنجاح!');

        return to_route('clients.index');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);

        $this->deleteAssociatedFiles($client->companies);
        $this->deleteAssociatedFiles($client->procurations);
        $this->deleteAssociatedFiles($client->sessions);

        $client->delete();

        setFlashMessage('success', 'تم حذف العميل وجميع البيانات المرتبطة به بنجاح!');

        return to_route('clients.index');
    }

    private function deleteAssociatedFiles($associations)
    {
        if ($associations && $associations->isNotEmpty()) {
            foreach ($associations as $association) {
                if ($association->files) {
                    foreach ($association->files as $file) {
                        if ($file->path) {
                            FileService::deleteFile($file->path, 'uploads');
                        }
                    }
                    $association->files()->delete();
                }
            }
        }
    }
}
