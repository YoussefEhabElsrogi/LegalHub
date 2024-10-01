<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::where('role', '!=', 'superadmin')->latest()->paginate(10);
        return view('dashboard.admins.index', compact('admins'));
    }
    public function create()
    {
        return view('dashboard.admins.create');
    }
    public function store(StoreAdminRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $directory = "images/admins";
            $newImageName = storeImage($request, $directory, 'uploads');
            $validatedData['image'] = $directory . '/' . $newImageName;
        } else {
            $validatedData['image'] = 'images/default-image.jpeg';
        }

        $admin = Admin::create($validatedData);

        setFlashMessage('success', 'تم تسجيل المشرف بنجاح');

        return to_route('admins.index');
    }
    public function show($id)
    {
        $admin = Admin::findOrFail($id);
        return view('dashboard.admins.show', compact('admin'));
    }
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
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
    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);

        if ($admin->image !== 'images/default-image.jpeg') {
            $imagePath = public_path($admin->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $admin->delete();

        setFlashMessage('success', 'تم حذف المشرف بنجاح!');

        return to_route('admins.index');
    }
}
