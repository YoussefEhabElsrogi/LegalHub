<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('image')) {
            $directory = "images/admins";
            $newImageName = storeImage($request, $directory);
            $validatedData['image'] = $directory . '/' . $newImageName;
        } else {
            $validatedData['image'] = 'images/default-image.jpeg';
        }

        $admin = Admin::create($validatedData);

        Auth::login($admin);

        session()->flash('success', 'تم تسجيل الدخول بنجاح، أهلاً وسهلاً بك في لوحة التحكم!');

        // return redirect(RouteServiceProvider::HOME);
    }
}
