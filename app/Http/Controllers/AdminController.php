<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $defaultImagePath = 'uploads/images/default/default-image.jpeg';
    protected $adminImageDir = 'uploads/images/admins';

    public function index()
    {
        $regularAdmins = Admin::select('id', 'name', 'email', 'phone', 'role')
            ->where('role', '!=', 'superadmin')
            ->latest()
            ->paginate(10);

        return view('dashboard.admins.index', compact('regularAdmins'));
    }

    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(StoreAdminRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['image'] = $this->handleImageUpload($request);

        Admin::create($validatedData);

        setFlashMessage('success', 'تم تسجيل المشرف بنجاح');
        return redirect()->route('admins.index');
    }

    public function show(string $id)
    {
        $admin = Admin::findOrFail($id, ['id', 'name', 'email', 'phone', 'role']);
        return view('dashboard.admins.show', compact('admin'));
    }

    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id, ['id', 'name', 'email', 'phone', 'role']);
        return view('dashboard.admins.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, string $id)
    {
        $admin = Admin::findOrFail($id);
        $validatedData = $request->validated();

        $admin->update($validatedData);

        setFlashMessage('success', 'تم تحديث المشرف بنجاح!');
        return redirect()->route('admins.index');
    }

    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $authUser = Auth::id();

        if ($authUser !== $admin->id) {
            setFlashMessage('error', 'لا يمكنك حذف هذا الحساب');
            return redirect()->back();
        }

        $this->handleImageDeletion($admin);

        $admin->delete();

        setFlashMessage('success', 'تم حذف حسابك بنجاح!');
        return redirect()->route('admins.index');
    }
    private function handleImageUpload($request): string
    {
        if ($request->hasFile('image')) {
            try {
                return ImageService::uploadImage($request->file('image'), $this->adminImageDir);
            } catch (\Exception $e) {
                setFlashMessage('error', 'فشل رفع الصورة حاول مرة أخرى');
                redirect()->back()->withInput();
            }
        }

        return $this->defaultImagePath;
    }
    private function handleImageDeletion(Admin $admin): void
    {
        if ($admin->image !== $this->defaultImagePath) {
            try {
                ImageService::deleteImage($admin->image);
            } catch (\Exception $e) {
                setFlashMessage('error', 'فشل حذف الصورة');
                redirect()->back();
            }
        }
    }
}
