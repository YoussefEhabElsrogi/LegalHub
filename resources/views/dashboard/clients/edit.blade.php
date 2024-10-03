@extends('dashboard.master')

@section('title', 'تعديل العميل')

@section('page', 'العملاء/')

@section('page-title', 'تعديل عميل')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header text-center">تعديل عميل</h5>
                    <div class="card-body">
                        <form action="{{ route('clients.update', $client->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">الاسم</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $client->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">رقم الهاتف</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone', $client->phone) }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="national_id" class="form-label">الرقم القومي</label>
                                <input type="text" class="form-control" id="national_id" name="national_id"
                                    value="{{ old('national_id', $client->national_id) }}">
                                @error('national_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100">تحديث</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
