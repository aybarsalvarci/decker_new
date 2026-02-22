@extends("admin.layouts.master")

@section('title', "Technical Certificates Management")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .cert-img {
            width: 80px;
            height: 100px; /* A4 dikey formata uygun oran */
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
            transition: transform 0.2s;
            cursor: zoom-in;
            border: 1px solid #dee2e6;
        }
        .cert-img:hover { transform: scale(2.5); z-index: 99; position: relative; }
        .table td { vertical-align: middle !important; }
        .lang-flag { font-size: 0.7rem; font-weight: bold; width: 30px; display: inline-block; text-align: center; }
        .desc-text { font-size: 0.85rem; color: #6c757d; line-height: 1.2; display: block; margin-top: 4px;}
    </style>
@endpush

@section('breadcrumb-title', 'Technical Certificates')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Certificates</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-primary shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-certificate mr-2 text-primary"></i>Certificates List
                </h3>
                <div class="card-tools">
                    <a href="{{route('admin.resources.technical-certificates.create')}}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fa fa-plus-circle mr-1"></i> New Certificate
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="techTable" class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th width="100">Preview</th>
                        <th>Certificate Details (EN / ES)</th>
                        <th>File</th>
                        <th width="120">Dates</th>
                        <th width="100" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($certificates as $tech)
                        <tr>
                            <td class="text-center">
                                @if($tech->image)
                                    <img src="{{asset('storage/' . $tech->image)}}" class="cert-img shadow-sm" alt="Certificate Preview">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted border" style="width:80px; height:100px;">
                                        <i class="fas fa-image fa-2x opacity-20"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="mb-3">
                                    <span class="badge badge-primary lang-flag mr-1">EN</span>
                                    <strong class="text-dark">{{$tech->title_en}}</strong>
                                    <small class="desc-text text-truncate" style="max-width: 400px;" title="{{$tech->desc_en}}">
                                        {{ Str::limit($tech->desc_en, 80) }}
                                    </small>
                                </div>
                                <div>
                                    <span class="badge badge-info lang-flag mr-1">ES</span>
                                    <strong class="text-secondary">{{$tech->title_esp}}</strong>
                                    <small class="desc-text text-truncate" style="max-width: 400px;" title="{{$tech->desc_esp}}">
                                        {{ Str::limit($tech->desc_esp, 80) }}
                                    </small>
                                </div>
                            </td>
                            <td>
                                @if($tech->file)
                                    <a href="{{asset('storage/' . $tech->file)}}" target="_blank" class="btn btn-outline-dark btn-sm shadow-sm">
                                        <i class="fas fa-file-pdf mr-1 text-danger"></i> View PDF
                                    </a>
                                @else
                                    <span class="badge badge-warning">No File</span>
                                @endif
                            </td>
                            <td>
                                <div class="small text-nowrap">
                                    <div title="Created At">
                                        <i class="far fa-calendar-plus text-primary mr-1"></i>{{ $tech->created_at->format('d.m.Y') }}
                                    </div>
                                    <div class="text-muted mt-1" title="Last Update">
                                        <i class="fas fa-history text-secondary mr-1"></i>{{ $tech->updated_at->diffForHumans() }}
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('admin.resources.technical-certificates.edit', $tech->id)}}"
                                       class="btn btn-sm btn-warning shadow-sm" title="Edit">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger shadow-sm btn-delete"
                                            data-url="{{route('admin.resources.technical-certificates.destroy', $tech->id)}}"
                                            data-name="{{ $tech->title_en }}"
                                            title="Delete">
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
            $("#techTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[3, "desc"]], // Tarihe göre sırala
                "columnDefs": [
                    { "orderable": false, "targets": [0, 2, 4] } // Resim, Dosya ve Aksiyonlar kolonunda sıralamayı kapat
                ],
                "language": {
                    "search": "Search Certificate:",
                    "lengthMenu": "Show _MENU_ entries"
                }
            });

            // SweetAlert2 Silme İşlemi
            $(document).on('click', '.btn-delete', function(){
                let url = $(this).data('url');
                let name = $(this).data('name');

                Swal.fire({
                    title: 'Delete Certificate?',
                    html: `You are about to delete <b>"${name}"</b>.<br>This file will be permanently removed.`,
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
