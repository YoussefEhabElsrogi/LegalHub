<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::with('client:id,name')->latest()->paginate(10);
        return view('dashboard.companies.index', compact('companies'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('dashboard.companies.create', compact('clients'));
    }
    public function store(StoreCompanyRequest $request)
    {
        $validatedData = $request->validated();

        if (!$this->validateFees($validatedData)) {
            setFlashMessage('error', 'يجب أن تكون الأتعاب مساوية لمجموع الموخر والمقدم.');
            return redirect()->back()->withInput();
        }

        $company = $this->createCompany($validatedData);

        if ($request->hasFile('files')) {
            $files = $request->file('files');

            foreach ($files as $file) {
                $path = storeFile($file, 'uploads/companies', 'uploads');
                $company->files()->create(['path' => $path]);
            }
        }

        setFlashMessage('success', 'تم إضافة الشركة بنجاح.');

        return to_route('companies.index');
    }

    public function show(string $id)
    {
        $company = Company::with('client:id,name')->findOrFail($id);
        return view('dashboard.companies.show', compact('company'));
    }

    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        $clients = Client::all();
        return view('dashboard.companies.edit', compact('company', 'clients'));
    }
    public function update(UpdateCompanyRequest $request, string $id)
    {
        $company = Company::findOrFail($id);
        $validatedData = $request->validated();

        if (!$this->validateFees($validatedData)) {
            setFlashMessage('error', 'يجب أن تكون الأتعاب مساوية لمجموع الموخر والمقدم.');
            return redirect()->back()->withInput();
        }

        $company->update($validatedData);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filePath = storeFile($file, 'uploads/companies', 'uploads');

                $company->files()->create([
                    'path' => $filePath,
                ]);
            }
        }

        setFlashMessage('success', 'تم تحديث الشركة بنجاح.');
        return to_route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    private function createCompany(array $validatedData)
    {
        return   Company::create([
            'client_id' => $validatedData['client_id'],
            'establishment_fees' => $validatedData['establishment_fees'],
            'fees' => $validatedData['fees'],
            'advance_amount' => $validatedData['advance_amount'],
            'remaining_amount' => $validatedData['remaining_amount'],
            'notes' => $validatedData['notes'],
        ]);
    }
    private function validateFees(array $validatedData): bool
    {
        return $validatedData['fees'] == $validatedData['remaining_amount'] + $validatedData['advance_amount'];
    }
}
