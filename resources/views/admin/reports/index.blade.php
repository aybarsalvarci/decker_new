@extends("admin.layouts.master")

@section('title', "Report Management")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">
    <style>
        .card-outline-success { border-top: 3px solid #28a745; }
        .report-img {
            width: 120px;
            height: 75px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
            cursor: zoom-in;
        }
        .report-img:hover { transform: scale(2.2); z-index: 10; position: relative; }
        .badge-slug { font-family: 'Courier New', Courier, monospace; font-size: 0.75rem; background: #f8f9fa; color: #6c757d; border: 1px solid #dee2e6; }
        .table td { vertical-align: middle !important; }
        .type-badge { width: 85px; display: inline-block; text-align: center; }
    </style>
@endpush

@section('breadcrumb-title', 'Reports')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-success shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-newspaper mr-2 text-success"></i>Report & News List
                </h3>
                <div class="card-tools">
                    <a href="{{route('admin.report.create')}}" class="btn btn-success btn-sm shadow-sm">
                        <i class="fa fa-plus-circle mr-1"></i> New Report
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="reportTable" class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th width="130">Cover</th>
                        <th>Content (EN / ES)</th>
                        <th>Type</th>
                        <th>Dates</th>
                        <th width="100" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>
                                @if($report->image)
                                    <img src="{{asset('storage/' . $report->image)}}" class="report-img shadow-sm">
                                @else
                                    <div class="bg-light rounded text-center py-3 small text-muted border">No Image</div>
                                @endif
                            </td>
                            <td>
                                <div class="mb-1">
                                    <span class="badge badge-primary mr-1">EN</span>
                                    <strong class="text-dark">{{$report->title_en}}</strong>
                                    <div class="badge badge-slug ml-2">{{$report->slug_en}}</div>
                                </div>
                                <div>
                                    <span class="badge badge-info mr-1">ES</span>
                                    <span class="text-secondary">{{$report->title_esp}}</span>
                                    <div class="badge badge-slug ml-2">{{$report->slug_esp}}</div>
                                </div>
                            </td>
                            <td>
                                @if($report->type == "exhibition")
                                    <span class="badge badge-info py-2 px-1 type-badge">
                                    <i class="fas fa-calendar-star mr-1"></i> EXHIBITION
                                </span>
                                @else
                                    <span class="badge badge-success py-2 px-3 type-badge">
                                    <i class="fas fa-news mr-1"></i> NEWS
                                </span>
                                @endif
                            </td>
                            <td>
                                <div class="small text-nowrap">
                                    <div title="Created At">
                                        <i class="far fa-plus-square text-success mr-1"></i>{{ $report->created_at->format('d.m.Y') }}
                                    </div>
                                    <div class="text-muted mt-1" title="Last Update">
                                        <i class="fas fa-sync-alt text-warning mr-1"></i>{{ $report->updated_at->diffForHumans() }}
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route('admin.report.edit', $report->id)}}"
                                       class="btn btn-sm btn-warning shadow-sm" title="Edit">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger shadow-sm btn-delete"
                                            data-url="{{route('admin.report.destroy', $report->id)}}"
                                            data-name="{{ $report->title_en }}"
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
            $("#reportTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[3, "desc"]], // En yeni tarihli en üstte
                "language": {
                    "search": "Filter reports:",
                }
            });

            // SweetAlert2 Silme Onayı
            $('.btn-delete').click(function(){
                let url = $(this).data('url');
                let name = $(this).data('name');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete "${name}". This cannot be undone!`,
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
