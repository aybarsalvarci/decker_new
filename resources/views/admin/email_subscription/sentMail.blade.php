@extends("admin.layouts.master")

@section('title', "Newsletter History")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .mail-preview-box {
            max-width: 400px;
            font-size: 0.85rem;
            color: #666;
            background: #fcfcfc;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #eee;
            line-height: 1.4;
        }
        .time-info { font-size: 0.85rem; white-space: nowrap; }
        .table td { vertical-align: middle !important; }
    </style>
@endpush

@section('breadcrumb-title', 'Sent Mails')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Newsletter History</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-primary shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-history mr-2 text-primary"></i>Sent Newsletter Archive
                </h3>
                <div class="card-tools">
                    <a href="{{route('admin.sent-mail.send')}}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fa fa-paper-plane mr-1"></i> Send New Newsletter
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="mailArchiveTable" class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Message Preview (Content)</th>
                        <th>Sent Date</th>
                        <th width="80" class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($mails as $mail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="mail-preview-box">
                                    <i class="fas fa-quote-left mr-2 text-muted small"></i>
                                    {{ str($mail->message)->limit(120) }}
                                </div>
                            </td>
                            <td>
                                <div class="time-info">
                                    <i class="far fa-calendar-check mr-1 text-success"></i>
                                    {{ $mail->created_at->format('d.m.Y H:i') }}
                                    <div class="text-muted x-small ml-4">{{ $mail->created_at->diffForHumans() }}</div>
                                </div>
                            </td>
                            <td class="text-center">
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger btn-delete"
                                        data-url="{{route('admin.sent-mail.destroy', $mail->id)}}"
                                        title="Delete Record">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
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
            $("#mailArchiveTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[2, "desc"]], // En son gönderilen en üstte
                "language": {
                    "search": "Search in archive:",
                }
            });

            // SweetAlert2 Silme Onayı
            $('.btn-delete').click(function(){
                let url = $(this).data('url');

                Swal.fire({
                    title: 'Delete log entry?',
                    text: "This will only delete the record from this list, it won't affect sent emails.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete log!',
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
