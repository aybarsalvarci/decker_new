@extends("admin.layouts.master")

@section('title', "Email Subscriptions")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">

    <style>
        .card-outline-indigo { border-top: 3px solid #6610f2; }
        .email-cell { font-weight: 500; color: #4b38b3; }
        .time-badge { font-size: 0.85rem; color: #6c757d; }
        .table td { vertical-align: middle !important; }
        .btn-indigo { background-color: #6610f2; color: white; border: none; }
        .btn-indigo:hover { background-color: #520dc2; color: white; }
    </style>
@endpush

@section('breadcrumb-title', 'Email Subscriptions')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Email Subscriptions</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-indigo shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-users mr-2 text-indigo"></i>Subscriber List
                </h3>
                <div class="card-tools">
                    <a href="{{route('admin.email-subscription.create')}}" class="btn btn-indigo btn-sm shadow-sm">
                        <i class="fa fa-user-plus mr-1"></i> Add New Subscriber
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="subscriptionTable" class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Email Address</th>
                        <th>Subscription Date</th>
                        <th>Last Update</th>
                        <th width="120" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subs as $sub)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="email-cell">
                                <i class="far fa-envelope mr-2 text-muted"></i>{{$sub->email}}
                            </td>
                            <td>
                                <div class="time-badge">
                                    <i class="far fa-calendar-alt mr-1"></i>{{ $sub->created_at->format('d.m.Y H:i') }}
                                </div>
                            </td>
                            <td>
                                <div class="small text-muted">
                                    <i class="fas fa-sync-alt mr-1"></i>{{ $sub->updated_at->diffForHumans() }}
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('admin.email-subscription.edit', $sub->id)}}"
                                       class="btn btn-sm btn-warning shadow-sm"
                                       title="Edit Subscriber">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger shadow-sm btn-delete"
                                            data-url="{{route('admin.email-subscription.destroy', $sub->id)}}"
                                            data-email="{{ $sub->email }}"
                                            title="Remove Subscriber">
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
            $("#subscriptionTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[2, "desc"]], // En yeni aboneler üstte
                "language": {
                    "search": "Quick Filter:",
                    "lengthMenu": "Display _MENU_ subscribers"
                }
            });

            // Gelişmiş Silme Onayı
            $('.btn-delete').click(function(){
                let url = $(this).data('url');
                let email = $(this).data('email');

                Swal.fire({
                    title: 'Remove Subscriber?',
                    text: `Are you sure you want to remove ${email} from the newsletter list?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, remove it!',
                    cancelButtonText: 'Cancel'
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
