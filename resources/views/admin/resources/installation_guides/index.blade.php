@extends('admin.layouts.master')

@section('title', 'Installation Guides')

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">

    <style>
        .card-outline-info { border-top: 3px solid #17a2b8; }

        /* Iframe'in Modal içinde 16:9 oranında ve tam genişlikte görünmesi için */
        .video-container {
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
            height: 0;
            overflow: hidden;
            background: #000;
        }
        .video-container iframe,
        .video-container object,
        .video-container embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
@endpush

@section('breadcrumb-title', 'Installation Guides')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Installation Videos</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-outline-info shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-video mr-2 text-info"></i> Installation Videos
                </h3>
                <div class="card-tools">
                    <a href="{{route('admin.resources.installation-guides.create')}}" class="btn btn-info btn-sm shadow-sm">
                        <i class="fas fa-plus mr-1"></i> Add New Video
                    </a>
                </div>
            </div>

            <div class="card-body">
                <table id="videoTable" class="table table-hover table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th width="50">#</th>
                        <th>Title (EN / ESP)</th>
                        <th width="150" class="text-center">Preview</th>
                        <th width="120" class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($videos as $video)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="font-weight-bold text-dark">{{ $video->title_en }}</div>
                                <small class="text-muted">{{ $video->title_esp }}</small>
                            </td>
                            <td class="text-center">
                                <textarea id="video-content-{{$video->id}}" style="display:none;">{!! $video->video !!}</textarea>

                                <button type="button" class="btn btn-sm btn-outline-primary btn-preview" data-id="{{$video->id}}">
                                    <i class="fas fa-play-circle mr-1"></i> Watch
                                </button>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.resources.installation-guides.edit', $video->id) }}"
                                   class="btn btn-sm btn-outline-info" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <button type="button" class="btn btn-sm btn-outline-danger btn-delete"
                                        data-url="{{ route('admin.resources.installation-guides.destroy', $video->id) }}"
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white p-2">
                    <h5 class="modal-title pl-2" style="font-size: 1rem;">Video Preview</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-black p-0">
                    <div id="modalVideoContent"></div>
                </div>
            </div>
        </div>
    </div>

    <form action="" method="post" id="delete-form" class="d-none">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('js')
    <script src="{{asset('back/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('back/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('back/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

    <script>
        $(function () {
            // DataTable Başlatma
            $("#videoTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "order": [[ 0, "asc" ]],
                "columnDefs": [
                    { "orderable": false, "targets": [2, 3] } // Preview ve Action sütunları sıralanmasın
                ]
            });

            // 1. VIDEO PREVIEW (DÜZELTİLDİ)
            // DataTables sayfalandırması olduğu için 'document' üzerinden delegate ediyoruz.
            $(document).on('click', '.btn-preview', function() {
                let id = $(this).data('id');

                // Textarea içindeki ham metni (iframe kodunu) alıyoruz
                let iframeCode = $('#video-content-' + id).val();

                if (iframeCode) {
                    // Responsive görünüm için wrapper ekleyerek modala basıyoruz
                    $('#modalVideoContent').html('<div class="video-container">' + iframeCode + '</div>');
                    $('#previewModal').modal('show');
                } else {
                    Swal.fire('Error', 'No video code found for this item.', 'error');
                }
            });

            // Modal kapanınca içeriği temizle (Videoyu durdurur)
            $('#previewModal').on('hidden.bs.modal', function () {
                $('#modalVideoContent').html('');
            });

            // 2. SILME ISLEMI
            $(document).on('click', '.btn-delete', function () {
                let url = $(this).data('url');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form').attr('action', url).submit();
                    }
                });
            });
        });
    </script>
@endpush
