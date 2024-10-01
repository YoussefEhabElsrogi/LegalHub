<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show(string $id)
    {
        $admin = $this->checkUser($id);

        if ($admin === null) {
            return to_route('dashboard.home');
        }

        return view('dashboard.profile.show', compact('admin'));
    }
    public function edit(Request $request): View
    {
        $admin = Auth::user();
        return view('dashboard.profile.edit', compact('admin'));
    }
    public function update(UpdateProfileRequest $request, string $id)
    {
        $admin = $this->checkUser($id);

        if ($admin === null) {
            return to_route('dashboard.home');
        }

        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $directory = "images/admins";
            $newImageName = storeImage($request, $directory, 'uploads');
            $validatedData['image'] = $directory . '/' . $newImageName;
            if ($admin->imgae !== 'images/default-image.jpeg') {
                deleteFile($admin->image, 'uploads');
            }
        } else {
            $validatedData['image'] = 'images/default-image.jpeg';
            deleteFile($admin->image, 'uploads');
        }

        $admin->update($validatedData);

        setFlashMessage('success', 'تم تحديث معلوماتك بنجاح');

        return to_route('profile.show', ['id' => $admin->id]);
    }
    public function updatePassword()
    {
        return view('dashboard.profile.change-password');
    }
    public function destroy(Request $request, string $id): RedirectResponse
    {
        $admin = $this->checkUser($id);

        if ($admin === null) {
            return to_route('dashboard.home');
        }

        if ($admin->image !== 'images/default-image.jpeg') {
            $imagePath = public_path($admin->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        Auth::logout();

        $admin->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        setFlashMessage('success', 'تم حذف الحساب بنجاح.');

        return to_route('admin.login');
    }
    private function checkUser(string $id): ?Admin
    {
        $adminAuth = Auth::user()->id;
        $admin = Admin::findOrFail($id);

        if ($adminAuth !== $admin->id) {
            setFlashMessage('error', 'لا يمكنك عرض معلومات هذا المستخدم.');
            return null;
        }

        return $admin;
    }
}
