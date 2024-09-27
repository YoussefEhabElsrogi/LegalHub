<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;

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

        $procuration = $client->procuration()->with('files')->paginate(5, ['*'], 'procuration_page');
        $sessions = $client->sessions()->with('files')->paginate(5, ['*'], 'sessions_page');

        return view('dashboard.clients.show', compact('client', 'procuration', 'sessions'));
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

        $client->delete();

        setFlashMessage('success', 'تم حذف العميل بنجاح!');

        return to_route('clients.index');
    }
}
