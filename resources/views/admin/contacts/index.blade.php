@extends("admin.layouts.master")

@section('title', "Contact Messages")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">
    <style>
        .card-outline-info { border-top: 3px solid #17a2b8; }
        .table td { vertical-align: middle !important; }
        .contact-name { font-weight: 600; color: #2c3e50; font-size: 1rem; }
        .role-badge {
            background: #e9ecef;
            color: #495057;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .message-preview {
            color: #555;
            font-style: italic;
            font-size: 0.9rem;
        }
        .email-link { color: #007bff; text-decoration: none; }
        .email-link:hover { text-decoration: underline; }
        .time-box { font-size: 0.85rem; color: #6c757d; }
    </style>
@endpush

@section('breadcrumb-title', 'Contact Messages')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Contact Messages</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-info shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-inbox mr-2 text-info"></i>Incoming Messages
                </h3>
            </div>

            <div class="card-body">
                <table id="contactTable" class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th style="width: 25%">Sender Details</th>
                        <th>Message Preview</th>
                        <th>Contact Info</th>
                        <th>Date</th>
                        <th width="100" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>
                                {{-- JSON: full_name --}}
                                <div class="contact-name">{{$contact->full_name}}</div>
                                {{-- JSON: role --}}
                                <div class="mt-1">
                                    <span class="role-badge">
                                        <i class="fas fa-user-tag mr-1 text-info"></i>{{$contact->role ?? 'N/A'}}
                                    </span>
                                </div>
                            </td>
                            <td>
                                {{-- JSON: message --}}
                                <div class="message-preview">
                                    "{{ Str::limit($contact->message, 50) }}"
                                </div>
                            </td>
                            <td>
                                {{-- JSON: email --}}
                                <div>
                                    <a href="mailto:{{$contact->email}}" class="email-link">
                                        <i class="far fa-envelope mr-1"></i>{{$contact->email}}
                                    </a>
                                </div>
                                {{-- JSON: phone_number --}}
                                <div class="small mt-1">
                                    <i class="fas fa-phone-alt mr-1 text-muted"></i>{{$contact->phone_number}}
                                </div>
                            </td>
                            <td>
                                <div class="time-box">
                                    <i class="far fa-clock mr-1"></i>{{$contact->created_at->format('d.m.Y')}}
                                    <div class="text-xs text-info">{{$contact->created_at->diffForHumans()}}</div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('admin.contact.show', $contact->id)}}"
                                       class="btn btn-sm btn-info shadow-sm"
                                       title="View Message">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger shadow-sm btn-delete"
                                            data-url="{{route('admin.contact.destroy', $contact->id)}}"
                                            data-sender="{{ $contact->full_name }}"
                                            title="Delete Message">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <form action="" method="post" id="delete-form" class="d-none">
        @method('DELETE')
        @csrf
    </form>
@endsection

@push('js')
    <script src="{{asset('back/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('back/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('back/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('back/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(function () {
            $("#contactTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[3, "desc"]], // Tarihe göre sırala
                "language": {
                    "search": "Filter messages:",
                    "emptyTable": "No messages found."
                }
            });

            $('.btn-delete').click(function(){
                let url = $(this).data('url');
                let sender = $(this).data('sender');

                Swal.fire({
                    title: 'Delete Message?',
                    text: `Are you sure you want to delete the message from "${sender}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = $('#delete-form');
                        form.attr('action', url);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
