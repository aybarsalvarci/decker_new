@extends("admin.layouts.master")

@section('title', "Product Color Management")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">

    <style>
        .card-outline-teal { border-top: 3px solid #20c997; }
        .color-swatch {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%; /* Daire şeklinde renk numunesi */
            border: 3px solid #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
            cursor: zoom-in;
        }
        .color-swatch:hover {
            transform: scale(1.8);
            z-index: 10;
            position: relative;
        }
        .table td { vertical-align: middle !important; }
        .color-name { font-weight: 600; color: #333; font-size: 1.05rem; }
    </style>
@endpush

@section('breadcrumb-title', 'Product Colors')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Product Colors</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-teal shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-palette mr-2 text-teal"></i>Color & Texture Library
                </h3>
                <div class="card-tools">
                    <a href="{{route('admin.product-color.create')}}" class="btn btn-teal btn-sm shadow-sm" style="background-color: #20c997; color: white;">
                        <i class="fa fa-plus mr-1"></i> Add New Color
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="colorTable" class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th width="100">Swatch</th>
                        <th>Color Name</th>
                        <th>Records</th>
                        <th width="120" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productColors as $color)
                        <tr>
                            <td class="text-center">
                                @if($color->image)
                                    <img src="{{asset('storage/' . $color->image)}}" class="color-swatch shadow-sm">
                                @else
                                    <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center" style="width:60px; height:60px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="color-name">{{$color->name}}</td>
                            <td>
                                <div class="small text-muted">
                                    <div><i class="far fa-clock mr-1"></i> Added: {{ $color->created_at->format('d.m.Y') }}</div>
                                    <div><i class="fas fa-history mr-1"></i> Updated: {{ $color->updated_at->diffForHumans() }}</div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('admin.product-color.edit', $color->id)}}"
                                       class="btn btn-sm btn-info shadow-sm mr-1" title="Edit Color">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger shadow-sm btn-delete"
                                            data-url="{{route('admin.product-color.destroy', $color->id)}}"
                                            data-name="{{ $color->name }}"
                                            title="Delete Color">
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
            $("#colorTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[1, "asc"]],
                "language": {
                    "search": "Quick Search:",
                },
                "columnDefs": [
                    { "orderable": false, "targets": [0, 3] }
                ]
            });

            // Gelişmiş Silme Onayı
            $('.btn-delete').click(function(){
                let url = $(this).data('url');
                let name = $(this).data('name');

                Swal.fire({
                    title: 'Delete this color?',
                    text: `You are about to remove "${name}" from the library. Products using this color might be affected!`,
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
