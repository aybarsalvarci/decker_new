@extends('admin.layouts.master')

@section('title', 'Add New Subscriber')

@push('css')
    <style>
        .card-outline-indigo { border-top: 3px solid #6610f2; }
        .subscriber-box { max-width: 600px; margin: 20px auto; }
        .input-group-text { background-color: #f4f6f9; color: #6610f2; }
        .help-text { font-size: 0.85rem; color: #6c757d; margin-top: 5px; }
    </style>
@endpush

@section('breadcrumb-title', 'Email Subscriptions')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.email-subscription.index')}}">Subscriptions</a></li>
    <li class="breadcrumb-item active">Add New</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="subscriber-box">
            <div class="card card-outline-indigo shadow-sm">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-user-plus mr-1 text-indigo"></i> Add New Subscriber
                    </h3>
                    <div class="card-tools">
                        <a href="{{route('admin.email-subscription.index')}}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Back
                        </a>
                    </div>
                </div>

                <form action="{{route('admin.email-subscription.store')}}" method="post">
                    @csrf
                    <div class="card-body p-4">
                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Subscriber Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>
                                </div>
                                <input type="email" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{old('email')}}"
                                       placeholder="example@domain.com" required>
                            </div>
                            @error('email')
                            <span class="invalid-feedback d-block">{{$message}}</span>
                            @enderror
                            <p class="help-text">
                                <i class="fas fa-info-circle mr-1"></i> This email will be added to the newsletter distribution list.
                            </p>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-right py-3">
                        <button type="submit" class="btn btn-indigo px-5 shadow-sm" style="background-color: #6610f2; color: white;">
                            <i class="fas fa-plus-circle mr-1"></i> Add Subscriber
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Opsiyonel: Inputa otomatik odaklanma
        $(document).ready(function() {
            $('#email').focus();
        });
    </script>
@endpush
