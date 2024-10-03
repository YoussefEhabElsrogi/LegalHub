@extends('dashboard.master')

@section('title', 'تعديل الإعدادات')

@section('page', 'الإعدادات/')

@section('page-title', 'تعديل الإعدادات')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">تعديل الإعدادات</h1>

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="app_name" class="form-label">اسم التطبيق</label>
                <input type="text" class="form-control" id="app_name" name="app_name"
                    value="{{ old('app_name', $setting->app_name) }}">
                @error('app_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="facebook" class="form-label">فيسبوك</label>
                <input type="url" class="form-control" id="facebook" name="facebook"
                    value="{{ old('facebook', $setting->facebook) }}">
                @error('facebook')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="instagram" class="form-label">إنستجرام</label>
                <input type="url" class="form-control" id="instagram" name="instagram"
                    value="{{ old('instagram', $setting->instagram) }}">
                @error('instagram')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="twitter" class="form-label">تويتر</label>
                <input type="url" class="form-control" id="twitter" name="twitter"
                    value="{{ old('twitter', $setting->twitter) }}">
                @error('twitter')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg me-2">تحديث الإعدادات</button>
                <a href="{{ route('settings.show') }}" class="btn btn-secondary btn-lg">العودة إلى الخلف</a>
            </div>
        </form>
    </div>
@endsection
