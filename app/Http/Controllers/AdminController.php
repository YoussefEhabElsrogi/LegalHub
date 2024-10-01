<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Services\ImageService;

class AdminController extends Controller
{
    public function index()
    {
        $regularAdmins = Admin::select('id', 'name', 'email', 'phone', 'role')->where('role', '!=', 'superadmin')->latest()->paginate(10);

        return view('dashboard.admins.index', compact('regularAdmins'));
    }

    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(StoreAdminRequest $request)
    {
        $validatedData = $request->validated();

        $dir = 'uploads/images';
        $defaultImagePath = "{$dir}/default/default-image.jpeg";

        if ($request->hasFile('image')) {
            try {
                $newImageName = ImageService::uploadImage($request->file('image'), "{$dir}/admins");
                $validatedData['image'] = $newImageName;
            } catch (\Exception $e) {
                setFlashMessage('error', 'فشل رفع الصورة حاول مرة أخرى: ' . $e->getMessage());
                return redirect()->back()->withInput();
            }
        } else {
            $validatedData['image'] = $defaultImagePath;
        }

        Admin::create($validatedData);

        setFlashMessage('success', 'تم تسجيل المشرف بنجاح');
        return redirect()->route('admins.index');
    }

    public function show(string $id)
    {
        $admin = Admin::select('id', 'name', 'email', 'phone', 'role')->findOrFail($id);
        return view('dashboard.admins.show', compact('admin'));
    }

    public function edit($id)
    {
        $admin = Admin::select('id', 'name', 'email', 'phone', 'role')->findOrFail($id);
        return view('dashboard.admins.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $validatedData = $request->validated();

        $admin->update($validatedData);

        setFlashMessage('success', 'تم تحديث المشرف بنجاح!');
        return to_route('admins.index');
    }

    public function destroy(string $id)
    {
        $admin = Admin::findOrFail($id);
        $dir = 'uploads/images';
        $defaultImagePath = "{$dir}/default/default-image.jpeg";

        if ($admin->image !== $defaultImagePath) {
            try {
                ImageService::deleteImage($admin->image);
            } catch (\Exception $e) {
                setFlashMessage('error', 'فشل حذف الصورة: ' . $e->getMessage());
                return redirect()->back();
            }
        }

        $admin->delete();
        setFlashMessage('success', 'تم حذف المشرف بنجاح!');
        return to_route('admins.index');
    }
}
