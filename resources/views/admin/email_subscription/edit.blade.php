@extends('admin.layouts.master')

@section('title', 'Edit Subscriber: ' . $sub->email)

@push('css')
    <style>
        /* Düzenleme modu için uyarıcı turuncu/amber tonu */
        .card-outline-warning { border-top: 3px solid #ffc107; }
        .subscriber-box { max-width: 600px; margin: 20px auto; }
        .input-group-text { background-color: #f8f9fa; color: #ffc107; }
        .info-status { font-size: 0.85rem; color: #6c757d; margin-top: 10px; padding: 10px; background: #fffcf5; border-radius: 4px; border: 1px solid #ffeeba; }
    </style>
@endpush

@section('breadcrumb-title', 'Edit Subscription')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.email-subscription.index')}}">Subscriptions</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="subscriber-box">
            <div class="card card-outline-warning shadow-sm">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-user-edit mr-1 text-warning"></i> Edit Subscriber
                    </h3>
                    <div class="card-tools">
                        <a href="{{route('admin.email-subscription.index')}}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Back to List
                        </a>
                    </div>
                </div>

                <form action="{{route('admin.email-subscription.update', $sub->id)}}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card-body p-4">
                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Update Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fas fa-envelope-open"></i>
                                </span>
                                </div>
                                <input type="email" name="email" id="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email', $sub->email) }}"
                                       required>
                            </div>
                            @error('email')
                            <span class="invalid-feedback d-block">{{$message}}</span>
                            @enderror

                            <div class="info-status">
                                <i class="fas fa-history mr-1"></i>
                                <strong>Registration Date:</strong> {{ $sub->created_at->format('d.m.Y H:i') }} <br>
                                <small class="text-muted ml-3">({{ $sub->created_at->diffForHumans() }})</small>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer bg-white text-right py-3">
                        <button type="submit" class="btn btn-warning px-5 shadow-sm font-weight-bold">
                            <i class="fas fa-sync-alt mr-1"></i> Update Subscription
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var input = $('#email');
            var val = input.val();
            input.focus().val('').val(val);
        });
    </script>
@endpush
