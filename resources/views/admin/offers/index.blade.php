@extends("admin.layouts.master")

@section('title', "Offer Management")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">

    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .customer-name { font-weight: 600; color: #2c3e50; }
        .table td { vertical-align: middle !important; }
        /* Mesaj önizlemesi için stil */
        .message-preview { font-style: italic; color: #6c757d; font-size: 0.9rem; }
    </style>
@endpush

@section('breadcrumb-title', 'Offers')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Offers</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-primary shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-file-invoice-dollar mr-2 text-primary"></i>Recent Offer Requests
                </h3>
            </div>

            <div class="card-body">
                <table id="offerTable" class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th width="30%">Message</th> <th>Request Date</th>
                        <th width="100" class="text-center">Process</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($offers as $offer)
                        <tr>
                            <td class="customer-name">
                                {{$offer->full_name}}
                            </td>

                            <td>
                                <a href="mailto:{{$offer->email}}">{{$offer->email}}</a>
                            </td>

                            <td>
                                <a href="tel:{{$offer->phone}}" class="text-dark">{{$offer->phone}}</a>
                            </td>

                            <td class="message-preview" title="{{ $offer->message }}">
                                {{ str()->limit($offer->message, 60, '...') }}
                            </td>

                            <td>
                                <div class="small">
                                    <div><i class="far fa-clock mr-1 text-muted"></i>{{$offer->created_at->format('d.m.Y')}}</div>
                                    <div class="text-xs text-info">{{$offer->created_at->diffForHumans()}}</div>
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('admin.offer.show', $offer->id)}}"
                                       class="btn btn-sm btn-info shadow-sm"
                                       title="View Offer Details">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger shadow-sm btn-delete"
                                            data-url="{{route('admin.offer.destroy', $offer->id)}}"
                                            data-name="{{ $offer->full_name }}"
                                            title="Delete Offer">
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
            $("#offerTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[4, "desc"]],
                "language": {
                    "search": "Filter offers:",
                    "emptyTable": "No offers found yet."
                },
                "columnDefs": [
                    { "orderable": false, "targets": 5 } // İşlemler sütununda sıralamayı kapat
                ]
            });

            // Gelişmiş Silme Onayı
            $(document).on('click', '.btn-delete', function(){ // Dinamik element hatası önlemi için 'document' kullanıldı
                let url = $(this).data('url');
                let name = $(this).data('name');

                Swal.fire({
                    title: 'Delete this offer?',
                    text: `You are deleting the request from ${name}. This cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
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
