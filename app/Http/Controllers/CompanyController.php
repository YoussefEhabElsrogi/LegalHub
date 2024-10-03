<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Client;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use App\Services\FileService;
use Exception;

class CompanyController extends Controller
{
    protected $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        $companies = Company::with('client:id,name')->latest()->paginate(10);
        return view('dashboard.companies.index', compact('companies'));
    }

    public function create()
    {
        $clients = Client::select(['id', 'name'])->get();
        return view('dashboard.companies.create', compact('clients'));
    }

    public function store(StoreCompanyRequest $request)
    {
        return $this->handleRequest($request, function () use ($request) {
            $validatedData = $request->validated();
            $this->validateFees($validatedData);

            $company = $this->createCompany($validatedData);
            $this->handleFileUpload($request, $company->id);

            return 'تم إضافة الشركة بنجاح.';
        });
    }

    public function show(string $id)
    {
        $company = Company::with('client:id,name')->findOrFail($id);
        return view('dashboard.companies.show', compact('company'));
    }

    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        $clients = Client::select(['id', 'name'])->get();
        return view('dashboard.companies.edit', compact('company', 'clients'));
    }

    public function update(UpdateCompanyRequest $request, string $id)
    {
        return $this->handleRequest($request, function () use ($request, $id) {
            $company = Company::findOrFail($id);
            $validatedData = $request->validated();
            $this->validateFees($validatedData);

            $company->update($validatedData);
            $this->handleFileUpload($request, $company->id);

            return 'تم تحديث الشركة بنجاح.';
        });
    }

    public function destroy(string $id)
    {
        return $this->handleRequest(null, function () use ($id) {
            $company = Company::findOrFail($id);
            $this->deleteCompanyFiles($company);
            $company->delete();
            return 'تم حذف الشركة بنجاح';
        });
    }

    private function createCompany(array $validatedData): Company
    {
        return Company::create($validatedData);
    }

    private function validateFees(array $validatedData): void
    {
        if ($validatedData['fees'] != $validatedData['remaining_amount'] + $validatedData['advance_amount']) {
            throw new Exception('يجب أن تكون الأتعاب مساوية لمجموع المؤخر والمقدم.');
        }
    }

    private function handleFileUpload($request, int $companyId): void
    {
        $directory = "companies";
        $uploadResult = $this->fileService->uploadFiles($request, $directory, $companyId, 'Company');

        $message = $uploadResult !== 0 ? 'تم إضافة الملفات بنجاح.' : 'لم يتم رفع أي ملفات.';
        setFlashMessage($uploadResult !== 0 ? 'success' : 'warning', $message);
    }

    private function deleteCompanyFiles(Company $company): void
    {
        foreach ($company->files as $file) {
            $this->fileService->deleteFile($file->path, 'uploads');
            $file->delete();
        }
    }

    private function flashAndRedirect(string $type, string $message)
    {
        setFlashMessage($type, $message);
        return to_route('companies.index');
    }

    private function handleRequest($request, callable $operation)
    {
        DB::beginTransaction();

        try {
            $message = $operation();
            DB::commit();
            return $this->flashAndRedirect('success', $message);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->flashAndRedirect('error', 'حدث خطا حاول مرة أخري');
        }
    }
}
