@extends("admin.layouts.master")

@section('title', "Compose Newsletter")

@push('css')
    <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.min.css')}}">
    <style>
        .card-outline-primary { border-top: 3px solid #007bff; }
        .note-editor.note-frame { border: 1px solid #dee2e6; box-shadow: none; border-radius: 8px; overflow: hidden; }
        .note-toolbar { background-color: #f8f9fa; border-bottom: 1px solid #dee2e6; }
        .compose-header { background: #fbfbfb; padding: 15px; border-bottom: 1px solid #eee; }
        .input-subject { border: none; border-bottom: 1px solid #eee; border-radius: 0; box-shadow: none !important; font-size: 1.1rem; font-weight: 500; padding-left: 0; }
        .input-subject:focus { border-bottom-color: #007bff; }
        .send-info-box { background: #e7f3ff; color: #004a99; border-radius: 8px; padding: 12px; margin-bottom: 20px; font-size: 0.9rem; }
    </style>
@endpush

@section('breadcrumb-title', 'Sent Mails')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.sent-mail.index')}}">Newsletter Archive</a></li>
    <li class="breadcrumb-item active">Compose</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 mx-auto">
                <div class="send-info-box shadow-sm">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong>Important:</strong> This message will be sent to all active subscribers. Please double-check your content before clicking send.
                </div>

                <div class="card card-outline-primary shadow">
                    <form action="{{route('admin.sent-mail.send')}}" method="POST" id="composeForm">
                        @csrf
                        <div class="compose-header">
                            <div class="form-group mb-0">
                                <input class="form-control input-subject @error('subject') is-invalid @enderror"
                                       name="subject"
                                       value="{{ old('subject') }}"
                                       placeholder="Subject:"
                                       autocomplete="off">
                                @error('subject')
                                <span class="text-danger small font-weight-bold">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="p-3">
                            <textarea name="message" id="compose-textarea" class="@error('message') is-invalid @enderror">
                                {{ old('message') }}
                            </textarea>
                                @error('message')
                                <span class="text-danger small font-weight-bold d-block mt-2">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer bg-white py-3">
                            <div class="float-right">
                                <button type="button" class="btn btn-default mr-2" onclick="window.location.reload();">
                                    <i class="fas fa-eraser"></i> Clear
                                </button>
                                <button type="submit" class="btn btn-primary px-5 shadow btn-send">
                                    <i class="far fa-paper-plane mr-1"></i> Send Newsletter
                                </button>
                            </div>
                            <a href="{{route('admin.sent-mail.index')}}" class="btn btn-link text-muted">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function () {
            $('#compose-textarea').summernote({
                height: 400,
                placeholder: 'Write your newsletter content here...',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear', 'italic']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                callbacks: {
                    onPaste: function (e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                }
            });

            $('#composeForm').on('submit', function(e) {
                e.preventDefault();
                let form = this;

                Swal.fire({
                    title: 'Ready to send?',
                    text: "This newsletter will be sent to all your subscribers immediately!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Start Sending!',
                    cancelButtonText: 'Review Again'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.btn-send').html('<i class="fas fa-spinner fa-spin mr-1"></i> Sending...').attr('disabled', true);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
