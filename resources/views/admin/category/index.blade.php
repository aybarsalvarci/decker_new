@extends("admin.layouts.master")

@section('title', "Kategori Yönetimi")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">
    <style>
        .card-outline-primary {
            border-top: 3px solid #007bff;
        }

        .category-img {
            width: 80px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            cursor: zoom-in;
        }

        .category-img:hover {
            transform: scale(2.5);
            position: relative;
            z-index: 10;
        }

        .badge-slug {
            font-family: monospace;
            font-size: 0.85rem;
            background: #f8f9fa;
            color: #6c757d;
            border: 1px solid #dee2e6;
        }

        .table td {
            vertical-align: middle !important;
        }

        .action-btns .btn {
            margin: 0 2px;
        }
    </style>
@endpush

@section('breadcrumb-title', 'Categories')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-primary shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold"><i class="fas fa-list mr-2"></i>Category List</h3>
                <div class="card-tools">
                    <a href="{{route('admin.category.create')}}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fa fa-plus-circle mr-1"></i> Add New Category
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="categoryTable" class="table table-hover table-minimal">
                    <thead class="thead-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Image</th>
                        <th>Name (EN/ESP)</th>
                        <th>URL Slugs</th>
                        <th>Timing</th>
                        <th width="120" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($category->image)
                                    <img src="{{asset('storage/' . $category->image)}}" class="category-img">
                                @else
                                    <div class="text-muted small"><i class="fas fa-image"></i> No Image</div>
                                @endif
                            </td>
                            <td>
                                <div class="font-weight-bold text-dark">{{$category->name_en}}</div>
                                <div class="small text-muted italic">{{$category->name_esp}}</div>
                            </td>
                            <td>
                                    <span class="badge badge-slug p-1 d-block mb-1"><i
                                            class="fas fa-link mr-1 small"></i>{{$category->slug_en}}</span>
                                <span class="badge badge-slug p-1 d-block"><i class="fas fa-link mr-1 small"></i>{{$category->slug_esp}}</span>
                            </td>
                            <td>
                                <div class="small" title="Created At">
                                    <b>C:</b> {{ $category->created_at->format('d.m.Y H:i') }}</div>
                                <div class="small text-secondary" title="Updated At">
                                    <b>U:</b> {{ $category->updated_at->diffForHumans() }}</div>
                            </td>
                            <td class="text-center action-btns">
                                <a href="{{route('admin.category.edit', $category->id)}}"
                                   class="btn btn-sm btn-info shadow-sm" title="Edit">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-danger shadow-sm btn-delete"
                                        data-url="{{route('admin.category.destroy', $category->id)}}"
                                        data-name="{{ $category->name_en }}"
                                        title="Delete">
                                    <i class="fa fa-trash"></i>
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
            $("#categoryTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[0, "asc"]],
                "columnDefs": [
                    {"orderable": false, "targets": [1, 5]}
                ],
                "language": {
                    "search": "Filter categories:",
                    "paginate": {
                        "next": '<i class="fas fa-chevron-right"></i>',
                        "previous": '<i class="fas fa-chevron-left"></i>'
                    }
                }
            });

            $('.btn-delete').click(function () {
                let url = $(this).data('url');
                let name = $(this).data('name');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete the category "${name}". This action cannot be undone!`,
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
