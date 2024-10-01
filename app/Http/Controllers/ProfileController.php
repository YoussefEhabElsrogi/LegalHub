<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Admin;
use App\Services\ImageService;
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
        $dir = 'uploads/images';
        $defaultImagePath = "{$dir}/default/default-image.jpeg";

        $oldData = $admin->only(['name', 'email', 'phone', 'image']);

        if ($request->hasFile('image')) {
            try {
                if ($admin->image !== $defaultImagePath) {
                    ImageService::deleteImage($admin->image);
                }
                $newImageName = ImageService::uploadImage($request->file('image'), "{$dir}/admins");
                $validatedData['image'] = $newImageName;
            } catch (\Exception $e) {
                setFlashMessage('error', 'فشل رفع الصورة حاول مرة أخرى');
                return redirect()->back()->withInput();
            }
        } else {
            $validatedData['image'] = ($admin->image !== $defaultImagePath) ? $admin->image : $defaultImagePath;
        }

        $isUpdated = array_diff($oldData, $validatedData);

        if ($isUpdated) {
            $admin->update($validatedData);
            setFlashMessage('success', 'تم تحديث معلوماتك بنجاح');
        } else {
            setFlashMessage('info', 'لا توجد تغييرات لتحديثها.');
        }

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

        $this->deleteImageIfExists($admin);

        Auth::logout();
        $admin->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        setFlashMessage('success', 'تم حذف الحساب بنجاح.');
        return to_route('admin.login');
    }

    private function checkUser(string $id): ?Admin
    {
        $admin = Admin::select(['id', 'name', 'email', 'phone', 'role', 'image'])->find($id);

        if (!$admin || $admin->id !== Auth::id()) {
            setFlashMessage('error', 'لا يمكنك عرض معلومات هذا المستخدم.');
            return null;
        }
        return $admin;
    }

    private function deleteImageIfExists(Admin $admin)
    {
        if ($admin->image !== 'uploads/images/default/default-image.jpeg') {
            $imagePath = public_path($admin->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    }
}
