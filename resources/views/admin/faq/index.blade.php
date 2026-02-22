@extends("admin.layouts.master")

@section('title', "FAQ List")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">
    <style>
        .card-outline-primary {
            border-top: 3px solid #007bff;
        }

        .table td {
            vertical-align: middle !important;
        }

        .action-btns .btn {
            margin: 0 2px;
        }

        /* İçerik önizlemesi için stil */
        .content-preview {
            max-width: 400px;
            font-size: 0.9rem;
            color: #666;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endpush

@section('breadcrumb-title', 'FAQ Management')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">FAQ List</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-primary shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold"><i class="fas fa-question-circle mr-2"></i>FAQ List</h3>
                <div class="card-tools">
                    <a href="{{route('admin.faqs.create')}}" class="btn btn-primary btn-sm shadow-sm">
                        <i class="fa fa-plus-circle mr-1"></i> Add New Question
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="faqTable" class="table table-hover table-minimal">
                    <thead class="thead-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Question (EN / ESP)</th>
                        <th>Answer Preview (EN)</th>
                        <th>Timing</th>
                        <th width="120" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($faqs as $faq)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="font-weight-bold text-dark">{{$faq->title_en}}</div>
                                <div class="small text-muted italic">{{$faq->title_esp}}</div>
                            </td>
                            <td>
                                <div class="content-preview" title="{{ strip_tags($faq->content_en) }}">
                                    {{ Str::limit(strip_tags($faq->content_en), 80) }}
                                </div>
                            </td>
                            <td>
                                <div class="small" title="Created At">
                                    <b>C:</b> {{ $faq->created_at->format('d.m.Y H:i') }}</div>
                                <div class="small text-secondary" title="Updated At">
                                    <b>U:</b> {{ $faq->updated_at->diffForHumans() }}</div>
                            </td>
                            <td class="text-center action-btns">
                                <a href="{{route('admin.faqs.edit', $faq->id)}}"
                                   class="btn btn-sm btn-info shadow-sm" title="Edit">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-sm btn-danger shadow-sm btn-delete"
                                        data-url="{{route('admin.faqs.destroy', $faq->id)}}"
                                        data-name="{{ $faq->title_en }}"
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
            $("#faqTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[0, "asc"]],
                "columnDefs": [
                    {"orderable": false, "targets": [4]} // Actions kolonu (4. index) sıralanamaz
                ],
                "language": {
                    "search": "Search Question:",
                    "paginate": {
                        "next": '<i class="fas fa-chevron-right"></i>',
                        "previous": '<i class="fas fa-chevron-left"></i>'
                    }
                }
            });

            // Delete butonuna tıklandığında (dinamik elemanlar için document.on kullanımı daha güvenlidir)
            $(document).on('click', '.btn-delete', function () {
                let url = $(this).data('url');
                let name = $(this).data('name');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete the question: "${name}". This action cannot be undone!`,
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
