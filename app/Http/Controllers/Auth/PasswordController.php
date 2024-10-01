<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function update(UpdatePasswordRequest $request)
    {
        $admin = Auth::user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors([
                'current_password' => 'كلمة المرور الحالية غير صحيحة.',
            ]);
        }

        $admin->update([
            'password' => Hash::make($request->new_password),
        ]);

        setFlashMessage('success', 'تم تغيير كلمة المرور بنجاح.');

        return redirect()->route('profile.show', ['id' => $admin->id]);
    }
}
