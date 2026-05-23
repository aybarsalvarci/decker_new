@extends('admin.layouts.master')

@section('title', 'Message Details: ' . $contact->full_name)

@push('css')
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .info-label { color: #6c757d; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; margin-bottom: 5px; }
        .info-value { color: #2c3e50; font-size: 1.05rem; margin-bottom: 20px; padding: 10px; background: #f8f9fa; border-radius: 6px; border-left: 3px solid #dee2e6; }
        .message-content { background: #ffffff; border: 1px solid #e9ecef; border-radius: 8px; padding: 25px; min-height: 200px; white-space: pre-line; line-height: 1.6; color: #444; }
        .role-badge { background: #e7f3ff; color: #007bff; padding: 5px 15px; border-radius: 20px; font-weight: 600; font-size: 0.9rem; border: 1px solid #b3d7ff; }
    </style>
@endpush

@section('breadcrumb-title', 'Message Details')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.contact.index')}}">Contacts</a></li>
    <li class="breadcrumb-item active">View Message</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="card card-outline-primary shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold">
                            <i class="fas fa-envelope-open-text mr-2 text-primary"></i> Message Details
                        </h3>
                        <div class="card-tools">
                            <a href="{{route('admin.contact.index')}}" class="btn btn-default btn-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Back to List
                            </a>
                            <button onclick="window.print();" class="btn btn-outline-secondary btn-sm ml-2">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row mb-4 border-bottom pb-3 align-items-center">
                            <div class="col-md-8">
                                <h4 class="mb-1">Message from {{ $contact->full_name }}</h4>
                                <span class="text-muted small">
                                    <i class="far fa-clock mr-1"></i> Received on: {{ $contact->created_at->format('d M Y, H:i') }}
                                    <span class="text-primary">({{ $contact->created_at->diffForHumans() }})</span>
                                </span>
                            </div>
                            <div class="col-md-4 text-md-right mt-2 mt-md-0">
                                <span class="role-badge shadow-sm">
                                    <i class="fas fa-user-tag mr-1"></i> {{ $contact->role ?? 'Role Not Specified' }}
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 border-right">
                                <div>
                                    <div class="info-label">Sender Name</div>
                                    <div class="info-value font-weight-bold">{{ $contact->full_name }}</div>
                                </div>

                                <div>
                                    <div class="info-label">Email Address</div>
                                    <div class="info-value">
                                        <a href="mailto:{{ $contact->email }}" class="text-primary text-decoration-none">
                                            <i class="far fa-envelope mr-1"></i>{{ $contact->email }}
                                        </a>
                                    </div>
                                </div>

                                <div>
                                    <div class="info-label">Phone Number</div>
                                    <div class="info-value">
                                        @if($contact->phone_number)
                                            <a href="tel:{{ $contact->phone_number }}" class="text-dark text-decoration-none">
                                                <i class="fas fa-phone-alt mr-1"></i>{{ $contact->phone_number }}
                                            </a>
                                        @else
                                            <span class="text-muted font-italic">Not Provided</span>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <div class="info-label">Professional Role</div>
                                    <div class="info-value">{{ $contact->role ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="info-label pl-2">Message Content</div>
                                <div class="message-content shadow-sm">
                                    {{ $contact->message }}
                                </div>

                                <div class="mt-4 text-right">
                                    <a href="mailto:{{ $contact->email }}?subject=Re: Inquiry from Decker Website" class="btn btn-primary shadow-sm">
                                        <i class="fas fa-reply mr-1"></i> Reply via Email
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
