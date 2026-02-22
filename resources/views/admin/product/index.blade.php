@extends("admin.layouts.master")

@section('title', "Product Management")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">

    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .product-img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            cursor: zoom-in;
        }
        .product-img:hover { transform: scale(2.5); position: relative; z-index: 10; }
        .badge-category { background: #e8f0fe; color: #1967d2; font-weight: 600; font-size: 0.8rem; }
        .badge-slug { font-family: 'Courier New', Courier, monospace; font-size: 0.75rem; background: #f1f3f4; color: #5f6368; border: 1px solid #dadce0; }
        .table td { vertical-align: middle !important; }
        .text-truncate-custom { max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    </style>
@endpush

@section('breadcrumb-title', 'Products')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Products</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-primary shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold"><i class="fas fa-boxes mr-2"></i>Inventory List</h3>
                <div class="card-tools">
                    <a href="{{route('admin.product.create')}}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fa fa-plus-circle mr-1"></i> Add New Product
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="productTable" class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th width="80">Image</th>
                        <th>Product Details</th>
                        <th>Category</th>
                        <th>URL Slugs (EN/ES)</th>
                        <th>History</th>
                        <th width="100" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                @if($product->images)
                                    <img src="{{asset('storage/' . $product->mainImage->image)}}" class="product-img shadow-sm">
                                @else
                                    <div class="text-muted small"><i class="fas fa-image"></i> N/A</div>
                                @endif
                            </td>
                            <td>
                                <div class="font-weight-bold text-dark">{{$product->name_en}}</div>
                                <div class="small text-muted">{{$product->name_esp}}</div>
                            </td>
                            <td>
                            <span class="badge badge-category px-2 py-1">
                                <i class="fas fa-tag mr-1"></i>{{$product->category->name_en ?? $product->category->name}}
                            </span>
                            </td>
                            <td>
                                <div class="badge badge-slug p-1 d-block mb-1 text-truncate-custom" title="{{$product->slug_en}}">
                                    {{ $product->slug_en }}
                                </div>
                                <div class="badge badge-slug p-1 d-block text-truncate-custom" title="{{$product->slug_esp}}">
                                    {{ $product->slug_esp }}
                                </div>
                            </td>
                            <td>
                                <div class="small" title="Created At"><b>C:</b> {{ $product->created_at->format('d.m.y') }}</div>
                                <div class="small text-secondary" title="Updated At"><b>U:</b> {{ $product->updated_at->diffForHumans() }}</div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('admin.product.edit', $product->id)}}"
                                       class="btn btn-sm btn-info shadow-sm mr-1" title="Edit Product">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger shadow-sm btn-delete"
                                            data-url="{{route('admin.product.destroy', $product->id)}}"
                                            data-name="{{ $product->name_en }}"
                                            title="Delete Product">
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
            $("#productTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[4, "desc"]], // En yeni ürünler üstte
                "language": {
                    "search": "Filter products:",
                    "lengthMenu": "Show _MENU_ entries"
                },
                "columnDefs": [
                    { "orderable": false, "targets": [0, 5] } // Resim ve İşlem sıralamasını kapat
                ]
            });

            // SweetAlert2 Silme Onayı
            $('.btn-delete').click(function(){
                let url = $(this).data('url');
                let name = $(this).data('name');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete "${name}". All associated data will be lost!`,
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
