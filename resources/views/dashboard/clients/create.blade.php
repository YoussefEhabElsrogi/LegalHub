@extends('dashboard.master')

@section('title', 'إضافة عميل')

@section('page', 'العملاء/')

@section('page-title', 'إضافة عميل')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-sm border-light">
                    <h5 class="card-header bg-primary text-white text-center">إضافة عميل</h5>
                    <div class="card-body">
                        <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="ادخل اسم العميل" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">رقم الهاتف</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    placeholder="ادخل رقم الهاتف" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="national_id" class="form-label">الرقم القومي</label>
                                <input type="text" name="national_id" class="form-control" id="national_id"
                                    placeholder="ادخل الرقم القومي" value="{{ old('national_id') }}">
                                @error('national_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">إضافة العميل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
