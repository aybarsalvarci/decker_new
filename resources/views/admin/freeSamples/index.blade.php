@extends("admin.layouts.master")

@section('title', "Free Sample Requests")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">

    <style>
        .card-outline-teal {
            border-top: 3px solid #20c997;
        }

        .box-info-wrapper {
            display: flex;
            align-items: center;
        }

        .box-mini-img {
            width: 50px;
            height: 40px;
            border-radius: 4px;
            object-fit: cover;
            margin-right: 12px;
            border: 1px solid #eee;
        }

        .customer-name {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .location-badge {
            background: #f1f3f5;
            color: #495057;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            border: 1px solid #dee2e6;
        }

        .table td {
            vertical-align: middle !important;
        }
    </style>
@endpush

@section('breadcrumb-title', 'Sample Requests')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Requests</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-teal shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-inbox mr-2 text-teal"></i>Incoming Sample Box Requests
                </h3>
            </div>

            <div class="card-body">
                <table id="sampleTable" class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th style="width: 30%">Requested Box</th>
                        <th>Customer</th>
                        <th>Location</th>
                        <th>Contact</th>
                        <th>Request Date</th>
                        <th width="100" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($freeSamples as $sample)
                        <tr>
                            <td>
                                {{-- Veri yapındaki "box" objesini kontrol ediyoruz --}}
                                @if(isset($sample->box))
                                    <div class="box-info-wrapper">
                                        <img src="{{ asset('storage/' . $sample->box->image) }}" class="box-mini-img">
                                        <div>
                                            <div class="font-weight-bold text-dark">
                                                {{ $sample->box->title_en }}
                                            </div>
                                            <small class="text-muted italic">
                                                {{ $sample->box->title_esp }}
                                            </small>
                                        </div>
                                    </div>
                                @else
                                    <span class="badge badge-secondary">Box #{{ $sample->box_id }} (Deleted)</span>
                                @endif
                            </td>

                            <td>
                                <p class="customer-name">{{ $sample->full_name }}</p>
                                <small class="text-muted">
                                    <i class="far fa-envelope mr-1"></i>{{ $sample->email }}
                                </small>
                            </td>

                            <td>
                                <div class="mb-1">
                <span class="location-badge" title="State">
                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $sample->state }}
                </span>
                                </div>
                                <div>
                <span class="location-badge" title="Town">
                    <i class="fas fa-city mr-1"></i> {{ $sample->town }}
                </span>
                                </div>
                            </td>

                            <td>
                                <div class="small">
                                    <strong>Address:</strong><br>
                                    <span class="text-muted">{{ Str::limit($sample->address, 40) }}</span>
                                </div>
                            </td>

                            <td>
                                <div class="small font-weight-bold">
                                    {{ \Carbon\Carbon::parse($sample->created_at)->format('d.m.Y H:i') }}
                                </div>
                                <div class="text-xs text-info">
                                    {{ \Carbon\Carbon::parse($sample->created_at)->diffForHumans() }}
                                </div>
                            </td>

                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.free-sample.show', $sample->id) }}"
                                       class="btn btn-sm btn-info shadow-sm"
                                       title="View Full Details">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button type="button"
                                            class="btn btn-sm btn-danger shadow-sm btn-delete"
                                            data-url="{{ route('admin.free-sample.destroy', $sample->id) }}"
                                            data-name="{{ $sample->full_name }}">
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
            $("#sampleTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[4, "desc"]],
                "language": {
                    "search": "Filter requests:",
                    "emptyTable": "No sample requests found"
                }
            });

            $('.btn-delete').click(function () {
                let url = $(this).data('url');
                let name = $(this).data('name');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `Delete
                    the request from "${name}"?`,
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
