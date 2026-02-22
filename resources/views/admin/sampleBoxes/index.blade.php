@extends("admin.layouts.master")

@section('title', "Free Sample Box Yönetimi")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .sample-img {
            width: 80px; height: 50px; object-fit: cover;
            border-radius: 4px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s; cursor: zoom-in;
        }
        .sample-img:hover { transform: scale(2.5); position: relative; z-index: 10; }
        .table td { vertical-align: middle !important; }
        .desc-text { font-size: 0.85rem; color: #666; display: block; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    </style>
@endpush

@section('breadcrumb-title', 'Free Sample Boxes')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Free Samples</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-primary shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold"><i class="fas fa-box-open mr-2"></i>Free Sample List</h3>
                <div class="card-tools">
                    <a href="{{route('admin.free-sample.box.create')}}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fa fa-plus-circle mr-1"></i> Add New Sample
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="sampleTable" class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Image</th>
                        <th>Title (EN/ESP)</th>
                        <th>Descriptions</th>
                        <th>Timing</th>
                        <th width="120" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($boxes as $box)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($box->image)
                                    <img src="{{asset('storage/' . $box->image)}}" class="sample-img">
                                @else
                                    <div class="text-muted small"><i class="fas fa-image"></i> No Image</div>
                                @endif
                            </td>
                            <td>
                                <div class="font-weight-bold text-dark">{{$box->title_en}}</div>
                                <div class="small text-muted italic">{{$box->title_esp}}</div>
                            </td>
                            <td>
                                <span class="desc-text" title="{{$box->description_en}}"><strong>EN:</strong> {{$box->description_en}}</span>
                                <span class="desc-text" title="{{$box->description_esp}}"><strong>ESP:</strong> {{$box->description_esp}}</span>
                            </td>
                            <td>
                                <div class="small"><b>C:</b> {{ $box->created_at->format('d.m.Y') }}</div>
                                <div class="small text-secondary"><b>U:</b> {{ $box->updated_at->diffForHumans() }}</div>
                            </td>
                            <td class="text-center">
                                <a href="{{route('admin.free-sample.box.edit', $box->id)}}" class="btn btn-sm btn-info shadow-sm">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger shadow-sm btn-delete"
                                        data-url="{{route('admin.free-sample.box.destroy', $box->id)}}"
                                        data-name="{{ $box->title_en }}">
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
            $("#sampleTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "columnDefs": [
                    {"orderable": false, "targets": [1, 5]}
                ]
            });

            $('.btn-delete').click(function () {
                let url = $(this).data('url');
                let name = $(this).data('name');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `"${name}" will be deleted forever!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
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
