@extends("admin.layouts.master")

@section('title', "Galeri Yönetimi")

@push('css')
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">

    <style>
        /* Galeri Kartı Tasarımı */
        .gallery-card {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            background: #fff;
            border: 1px solid #dee2e6;
        }

        /* Kart üzerine gelince */
        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        /* Görsel Alanı */
        .gallery-img-container {
            height: 180px; /* Sabit yükseklik */
            width: 100%;
            overflow: hidden;
            background-color: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Resmi kutuya doldur */
            transition: transform 0.5s ease;
            cursor: pointer;
        }

        /* Resme hover olunca hafif zoom */
        .gallery-card:hover .gallery-img {
            transform: scale(1.1);
        }

        /* Silme Butonu Alanı */
        .card-actions {
            padding: 10px;
            text-align: center;
            background: #fff;
            border-top: 1px solid #f1f1f1;
        }
    </style>
@endpush

@section('breadcrumb-title', 'Gallery')

    @section('breadcrumb-links')
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Gallery</li>
    @endsection

    @section('content')
        <div class="container-fluid">
            <div class="card card-outline shadow-sm" style="border-top: 3px solid #6c757d;">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold text-secondary">
                        <i class="fas fa-images mr-2"></i> Photo List
                    </h3>
                    <div class="card-tools">
                        <a href="{{route('admin.resources.gallery.create')}}" class="btn btn-success btn-sm shadow-sm">
                            <i class="fa fa-plus mr-1"></i> Add New Photo
                        </a>
                    </div>
                </div>

                <div class="card-body bg-light">
                    @if($galleryItems->count() > 0)
                        <div class="row">
                            @foreach($galleryItems as $item)
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="gallery-card">
                                        <div class="gallery-img-container">

                                            <img src="{{ asset('storage/' . $item->path) }}" class="gallery-img" alt="Gallery Item"
                                                 onclick="window.open(this.src, '_blank')">
                                        </div>

                                        <div class="card-actions">
                                            <button type="button"
                                                    class="btn btn-danger btn-sm btn-block btn-delete shadow-sm"
                                                    data-url="{{ route('admin.resources.gallery.destroy', $item->id) }}">
                                                <i class="fas fa-trash-alt mr-1"></i> Delete
                                            </button>
                                            <div class="text-muted mt-2" style="font-size: 11px;">
                                                {{ $item->created_at->format('d.m.Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{$galleryItems->links()}}
                        </div>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-camera fa-4x mb-3 text-secondary opacity-50"></i>
                            <h5>No photos have been uploaded yet.</h5>
                            <p>Add the first photo using the button above.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <form action="" method="post" id="delete-form" class="d-none">
            @method('DELETE')
            @csrf
        </form>
    @endsection

    @push('js')
        <script src="{{asset('back/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

        <script>
            $(document).ready(function () {
                // SweetAlert2 Silme Onayı
                $('.btn-delete').click(function(){
                    let url = $(this).data('url');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This photo will be deleted permanently!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, Delete!',
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
