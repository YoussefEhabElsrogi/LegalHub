@extends('dashboard.master')

@section('title', 'إضافة عميل')

@section('page', 'العملاء/')

@section('page-title', 'إضافة عميل')

@section('content')
    <div class="col-xxl" style="margin-top: -25px">
        <div class="card mb-4">
            <h5 class="card-header">إضافة عميل</h5>
            <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 p-2">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="ادخل اسم العميل"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="phone" class="form-label">رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="ادخل رقم الهاتف"
                        value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 p-2">
                    <label for="national_id" class="form-label">الرقم القومي</label>
                    <input type="text" name="national_id" class="form-control" id="national_id"
                        placeholder="ادخل الرقم القومي" value="{{ old('national_id') }}">
                    @error('national_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary m-3">إضافة العميل</button>
            </form>
        </div>
    </div>
@endsection
