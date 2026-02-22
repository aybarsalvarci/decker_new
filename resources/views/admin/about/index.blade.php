@extends('admin.layouts.master')

@section('title', 'About Page Management')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    {{-- SweetAlert CSS --}}
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">
    <style>
        .card-primary.card-outline-tabs > .card-header a.active { border-top: 3px solid #007bff; }
        .input-group-text { background-color: #f4f6f9; border-color: #ced4da; font-weight: bold; color: #495057; }
        .lang-icon { font-size: 1.2em; margin-right: 5px; }
        .section-header { font-size: 1.1rem; font-weight: 600; color: #343a40; margin-bottom: 15px; border-bottom: 2px solid #e9ecef; padding-bottom: 5px; margin-top: 10px; }
        .preview-box { width: 100%; height: 180px; border: 2px dashed #ced4da; background: #f8f9fa; display: flex; align-items: center; justify-content: center; border-radius: 5px; overflow: hidden; position: relative; }
        .preview-box img { max-width: 100%; max-height: 100%; object-fit: cover; }
        .preview-label { position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.5); color: #fff; text-align: center; font-size: 12px; padding: 3px; }
        .stat-card { background: #343a40; color: #fff; padding: 15px; border-radius: 5px; margin-bottom: 15px; }
        .stat-card label { color: #ced4da; font-size: 0.85rem; }
        .value-item { background: #fff; border: 1px solid #dee2e6; border-radius: 8px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        /* Yeni Tablo Stili */
        .table.v-middle td { vertical-align: middle; }
    </style>
@endpush

@section('breadcrumb-title', 'About Us Page')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">About Us</li>
@endsection

@section('content')
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $er)
                        <li>{{$er}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ANA GÜNCELLEME FORMU (HERO, STORY, STATS, VALUES ve FACTORY BAŞLIKLARI İÇİN) --}}
        <form action="{{route('admin.about.update', $about->id)}}" method="post" enctype="multipart/form-data" id="mainUpdateForm">
            @csrf
            @method('PUT')

            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="about-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="hero-tab" data-toggle="pill" href="#hero" role="tab"><i class="fas fa-align-left mr-2"></i> Hero & Vision</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="story-tab" data-toggle="pill" href="#story" role="tab"><i class="fas fa-book-open mr-2"></i> Our Story</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="factory-tab" data-toggle="pill" href="#factory" role="tab"><i class="fas fa-industry mr-2"></i> Factory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="stats-tab" data-toggle="pill" href="#stats" role="tab"><i class="fas fa-chart-bar mr-2"></i> Statistics</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="values-tab" data-toggle="pill" href="#values" role="tab"><i class="fas fa-gem mr-2"></i> Core Values</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">

                        {{-- 1. HERO & VISION SECTION --}}
                        <div class="tab-pane fade show active" id="hero" role="tabpanel">
                            <div class="section-header">Hero Section Configuration</div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>🇺🇸 Top Label</label>
                                    <input type="text" name="hero_label_en" class="form-control" value="{{ old('hero_label_en', $about->hero_label_en) }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>🇪🇸 Top Label</label>
                                    <input type="text" name="hero_label_esp" class="form-control" value="{{ old('hero_label_esp', $about->hero_label_esp) }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>🇺🇸 Main Title</label>
                                    <textarea name="hero_title_en" rows="2" class="form-control">{{ old('hero_title_en', $about->hero_title_en) }}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>🇪🇸 Main Title</label>
                                    <textarea name="hero_title_esp" rows="2" class="form-control">{{ old('hero_title_esp', $about->hero_title_esp) }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>🇺🇸 Description</label>
                                    <textarea name="hero_desc_en" rows="3" class="form-control">{{ old('hero_desc_en', $about->hero_desc_en) }}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>🇪🇸 Description</label>
                                    <textarea name="hero_desc_esp" rows="3" class="form-control">{{ old('hero_desc_esp', $about->hero_desc_esp) }}</textarea>
                                </div>
                            </div>
                            <div class="section-header mt-4">Vision Statement</div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>🇺🇸 Vision Text</label>
                                    <textarea name="vision_en" rows="3" class="form-control">{{ old('vision_en', $about->vision_en) }}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>🇪🇸 Vision Text</label>
                                    <textarea name="vision_esp" rows="3" class="form-control">{{ old('vision_esp', $about->vision_esp) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- 2. OUR STORY SECTION --}}
                        <div class="tab-pane fade" id="story" role="tabpanel">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="section-header">Story Content</div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>🇺🇸 Title</label>
                                            <input type="text" name="story_title_en" class="form-control" value="{{ old('story_title_en', $about->story_title_en) }}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>🇪🇸 Title</label>
                                            <input type="text" name="story_title_esp" class="form-control" value="{{ old('story_title_esp', $about->story_title_esp) }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label>🇺🇸 Subtitle</label>
                                            <textarea name="story_subtitle_en" rows="2" class="form-control">{{ old('story_subtitle_en', $about->story_subtitle_en) }}</textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>🇪🇸 Subtitle</label>
                                            <textarea name="story_subtitle_esp" rows="2" class="form-control">{{ old('story_subtitle_esp', $about->story_subtitle_esp) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6 form-group">
                                            <label>🇺🇸 Content</label>
                                            <textarea name="story_content_en" class="form-control summernote">{{ old('story_content_en', $about->story_content_en) }}</textarea>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label>🇪🇸 Content</label>
                                            <textarea name="story_content_esp" class="form-control summernote">{{ old('story_content_esp', $about->story_content_esp) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="section-header">Images</div>
                                    <div class="preview-box mb-2" style="height: 250px;">
                                        <img src="{{ isset($about->story_image) ? asset('storage/'.$about->story_image) : asset('admin/img/no-image.png') }}" id="story-preview">
                                        <div class="preview-label">story_image</div>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="story_image" id="story_image" class="custom-file-input" onchange="previewImage(this, '#story-preview')">
                                        <label class="custom-file-label" for="story_image">Choose story image</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 3. FACTORY SECTION (HYBRID: STATIC HEADER + DYNAMIC LIST) --}}
                        <div class="tab-pane fade" id="factory" role="tabpanel">

                            {{-- A. Section Headers (Static - Main Form) --}}
                            <div class="alert alert-secondary text-center p-1 mb-3"><small>SECTION HEADER SETTINGS</small></div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>🇺🇸 Section Title</label>
                                    <input type="text" name="factory_title_en" class="form-control" value="{{ old('factory_title_en', $about->factory_title_en) }}">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>🇪🇸 Section Title</label>
                                    <input type="text" name="factory_title_esp" class="form-control" value="{{ old('factory_title_esp', $about->factory_title_esp) }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>🇺🇸 Section Desc</label>
                                    <textarea name="factory_desc_en" rows="2" class="form-control">{{ old('factory_desc_en', $about->factory_desc_en) }}</textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>🇪🇸 Section Desc</label>
                                    <textarea name="factory_desc_esp" rows="2" class="form-control">{{ old('factory_desc_esp', $about->factory_desc_esp) }}</textarea>
                                </div>
                            </div>

                            <hr class="my-4">

                            {{-- B. Factory List (Dinamik Liste) --}}
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="section-header m-0 border-0">
                                    <i class="fas fa-list mr-2"></i> Facilities List
                                </div>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addFactoryModal">
                                    <i class="fas fa-plus mr-1"></i> Add New Facility
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover v-middle">
                                    <thead class="thead-light">
                                    <tr>
                                        <th width="50">Ord.</th>
                                        <th width="120">Images</th>
                                        <th>Title (EN)</th>
                                        <th>Img 1 Title</th>
                                        <th>Img 2 Title</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($factories->sortBy('order') as $factory)
                                        <tr>
                                            <td><span class="badge badge-light border">{{ $factory->order }}</span></td>
                                            <td>
                                                <div class="d-flex">
                                                    {{-- Modelde getImage1UrlAttribute ve getImage2UrlAttribute tanımlı olmalı --}}
                                                    <img src="{{ asset('storage/' . $factory->image1) }}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 4px; margin-right: 5px; border:1px solid #ddd;" title="Image 1">
                                                    <img src="{{ asset('storage/' . $factory->image2) }}" style="height: 40px; width: 40px; object-fit: cover; border-radius: 4px; border:1px solid #ddd;" title="Image 2">
                                                </div>
                                            </td>
                                            <td class="font-weight-bold">{{ $factory->title_en }}</td>
                                            <td class="small text-muted">{{ Str::limit($factory->image1_title_en, 20) }}</td>
                                            <td class="small text-muted">{{ Str::limit($factory->image2_title_en, 20) }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editFactoryModal{{ $factory->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                {{-- SWEETALERT DELETE BUTTON --}}
                                                <button type="button" class="btn btn-danger btn-sm" onclick="deleteFactory({{$factory->id}})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="text-center text-muted py-4">No facilities added yet.</td></tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- 4. STATISTICS SECTION --}}
                        <div class="tab-pane fade" id="stats" role="tabpanel">
                            <div class="row">
                                @for($i = 1; $i <= 4; $i++)
                                    <div class="col-md-3">
                                        <div class="stat-card">
                                            <h6 class="border-bottom pb-2">Statistic #{{$i}}</h6>
                                            <div class="form-group mb-2">
                                                <label>Number</label>
                                                <input type="text" name="stat_{{$i}}_num" class="form-control form-control-sm" value="{{ old('stat_'.$i.'_num', $about->{'stat_'.$i.'_num'}) }}">
                                            </div>
                                            <div class="form-group mb-1">
                                                <label>🇺🇸 Text</label>
                                                <input type="text" name="stat_{{$i}}_text_en" class="form-control form-control-sm" value="{{ old('stat_'.$i.'_text_en', $about->{'stat_'.$i.'_text_en'}) }}">
                                            </div>
                                            <div class="form-group mb-0">
                                                <label>🇪🇸 Text</label>
                                                <input type="text" name="stat_{{$i}}_text_esp" class="form-control form-control-sm" value="{{ old('stat_'.$i.'_text_esp', $about->{'stat_'.$i.'_text_esp'}) }}">
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        {{-- 5. CORE VALUES SECTION --}}
                        <div class="tab-pane fade" id="values" role="tabpanel">
                            <div class="row mb-3">
                                <div class="col-md-6"><label>Title EN</label><input type="text" name="values_title_en" class="form-control" value="{{ old('values_title_en', $about->values_title_en) }}"></div>
                                <div class="col-md-6"><label>Title ES</label><input type="text" name="values_title_esp" class="form-control" value="{{ old('values_title_esp', $about->values_title_esp) }}"></div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6"><label>Subtitle EN</label><input type="text" name="values_subtitle_en" class="form-control" value="{{ old('values_subtitle_en', $about->values_subtitle_en) }}"></div>
                                <div class="col-md-6"><label>Subtitle ES</label><input type="text" name="values_subtitle_esp" class="form-control" value="{{ old('values_subtitle_esp', $about->values_subtitle_esp) }}"></div>
                            </div>
                            <hr>
                            @foreach([1, 2, 3] as $i)
                                <div class="value-item">
                                    <h5 class="text-primary font-weight-bold">Value Card #{{$i}}</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-2 text-center border-right">
                                            <div class="form-group">
                                                <label>Icon Class</label>
                                                <input type="text" name="val_{{$i}}_icon" class="form-control text-center" value="{{ old('val_'.$i.'_icon', $about->{'val_'.$i.'_icon'}) }}">
                                                <div class="mt-3 display-4"><i class="{{ $about->{'val_'.$i.'_icon'} ?? 'fas fa-question' }}"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group"><label>🇺🇸 Title</label><input type="text" name="val_{{$i}}_title_en" class="form-control font-weight-bold" value="{{ old('val_'.$i.'_title_en', $about->{'val_'.$i.'_title_en'}) }}"></div>
                                            <div class="form-group"><label>🇺🇸 Desc</label><textarea name="val_{{$i}}_desc_en" rows="3" class="form-control">{{ old('val_'.$i.'_desc_en', $about->{'val_'.$i.'_desc_en'}) }}</textarea></div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group"><label>🇪🇸 Title</label><input type="text" name="val_{{$i}}_title_esp" class="form-control font-weight-bold" value="{{ old('val_'.$i.'_title_esp', $about->{'val_'.$i.'_title_esp'}) }}"></div>
                                            <div class="form-group"><label>🇪🇸 Desc</label><textarea name="val_{{$i}}_desc_esp" rows="3" class="form-control">{{ old('val_'.$i.'_desc_esp', $about->{'val_'.$i.'_desc_esp'}) }}</textarea></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="card-footer text-right bg-white">
                    <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                        <i class="fas fa-save mr-2"></i> UPDATE MAIN SECTIONS
                    </button>
                </div>
            </div>
        </form> {{-- MAIN FORM BITIŞI --}}


        {{-- ========================================================= --}}
        {{-- MODALS & EXTERNAL FORMS (MUST BE OUTSIDE MAIN FORM) --}}
        {{-- ========================================================= --}}

        {{-- 1. ADD FACTORY MODAL --}}
        <div class="modal fade" id="addFactoryModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document"> {{-- modal-xl yaptık çünkü içerik geniş --}}
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title"><i class="fas fa-plus-circle mr-2"></i>Add New Facility</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('admin.about.factories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body bg-light">

                            {{-- 1. GENERAL INFO --}}
                            <div class="card shadow-none border mb-3">
                                <div class="card-header bg-white font-weight-bold text-primary">1. General Information</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5 form-group">
                                            <label>Main Title (EN)</label>
                                            <input type="text" name="title_en" class="form-control" placeholder="e.g. Production Area" required>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <label>Main Title (ESP)</label>
                                            <input type="text" name="title_esp" class="form-control" placeholder="e.g. Área de Producción">
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label>Order</label>
                                            <input type="number" name="order" class="form-control" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- 2. IMAGE AREA 1 --}}
                                <div class="col-md-6">
                                    <div class="card shadow-none border h-100">
                                        <div class="card-header bg-white font-weight-bold text-info"><i class="fas fa-image mr-1"></i> Image Area 1</div>
                                        <div class="card-body">
                                            <div class="form-group bg-white p-2 border rounded">
                                                <label>Upload Image 1</label>
                                                <input type="file" name="image1" class="form-control-file" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Title 1 (EN)</label>
                                                <input type="text" name="image1_title_en" class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group">
                                                <label>Title 1 (ESP)</label>
                                                <input type="text" name="image1_title_esp" class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group">
                                                <label>Desc 1 (EN)</label>
                                                <textarea name="image1_desc_en" rows="2" class="form-control form-control-sm"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Desc 1 (ESP)</label>
                                                <textarea name="image1_desc_esp" rows="2" class="form-control form-control-sm"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- 3. IMAGE AREA 2 --}}
                                <div class="col-md-6">
                                    <div class="card shadow-none border h-100">
                                        <div class="card-header bg-white font-weight-bold text-info"><i class="fas fa-image mr-1"></i> Image Area 2</div>
                                        <div class="card-body">
                                            <div class="form-group bg-white p-2 border rounded">
                                                <label>Upload Image 2</label>
                                                <input type="file" name="image2" class="form-control-file" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Title 2 (EN)</label>
                                                <input type="text" name="image2_title_en" class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group">
                                                <label>Title 2 (ESP)</label>
                                                <input type="text" name="image2_title_esp" class="form-control form-control-sm">
                                            </div>
                                            <div class="form-group">
                                                <label>Desc 2 (EN)</label>
                                                <textarea name="image2_desc_en" rows="2" class="form-control form-control-sm"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Desc 2 (ESP)</label>
                                                <textarea name="image2_desc_esp" rows="2" class="form-control form-control-sm"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save Facility</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 2. EDIT FACTORY MODALS (LOOP) --}}
        @foreach($factories as $factory)
            <div class="modal fade" id="editFactoryModal{{ $factory->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title"><i class="fas fa-edit mr-2"></i>Edit Facility</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form action="{{ route('admin.about.factories.update', $factory->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body bg-light">

                                {{-- 1. GENERAL INFO --}}
                                <div class="card shadow-none border mb-3">
                                    <div class="card-header bg-white font-weight-bold text-primary">1. General Information</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5 form-group">
                                                <label>Main Title (EN)</label>
                                                <input type="text" name="title_en" class="form-control" value="{{ $factory->title_en }}" required>
                                            </div>
                                            <div class="col-md-5 form-group">
                                                <label>Main Title (ESP)</label>
                                                <input type="text" name="title_esp" class="form-control" value="{{ $factory->title_esp }}">
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label>Order</label>
                                                <input type="number" name="order" class="form-control" value="{{ $factory->order }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- 2. IMAGE AREA 1 --}}
                                    <div class="col-md-6">
                                        <div class="card shadow-none border h-100">
                                            <div class="card-header bg-white font-weight-bold text-info"><i class="fas fa-image mr-1"></i> Image Area 1</div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-4">
                                                        <img src="{{ asset('storage/' . $factory->image1) }}" class="img-fluid rounded border">
                                                    </div>
                                                    <div class="col-8">
                                                        <label>Change Image 1</label>
                                                        <input type="file" name="image1" class="form-control-file">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Title 1 (EN)</label>
                                                    <input type="text" name="image1_title_en" class="form-control form-control-sm" value="{{ $factory->image1_title_en }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Title 1 (ESP)</label>
                                                    <input type="text" name="image1_title_esp" class="form-control form-control-sm" value="{{ $factory->image1_title_esp }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Desc 1 (EN)</label>
                                                    <textarea name="image1_desc_en" rows="2" class="form-control form-control-sm">{{ $factory->image1_desc_en }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Desc 1 (ESP)</label>
                                                    <textarea name="image1_desc_esp" rows="2" class="form-control form-control-sm">{{ $factory->image1_desc_esp }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- 3. IMAGE AREA 2 --}}
                                    <div class="col-md-6">
                                        <div class="card shadow-none border h-100">
                                            <div class="card-header bg-white font-weight-bold text-info"><i class="fas fa-image mr-1"></i> Image Area 2</div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-4">
                                                        <img src="{{ asset('storage/' . $factory->image2) }}" class="img-fluid rounded border">
                                                    </div>
                                                    <div class="col-8">
                                                        <label>Change Image 2</label>
                                                        <input type="file" name="image2" class="form-control-file">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Title 2 (EN)</label>
                                                    <input type="text" name="image2_title_en" class="form-control form-control-sm" value="{{ $factory->image2_title_en }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Title 2 (ESP)</label>
                                                    <input type="text" name="image2_title_esp" class="form-control form-control-sm" value="{{ $factory->image2_title_esp }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Desc 2 (EN)</label>
                                                    <textarea name="image2_desc_en" rows="2" class="form-control form-control-sm">{{ $factory->image2_desc_en }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Desc 2 (ESP)</label>
                                                    <textarea name="image2_desc_esp" rows="2" class="form-control form-control-sm">{{ $factory->image2_desc_esp }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update Facility</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- 3. DELETE FORMS (HIDDEN) --}}
            <form id="delete-factory-{{$factory->id}}" action="{{ route('admin.about.factories.destroy', $factory->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endforeach

    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="{{asset('back/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
        });

        // SWEETALERT DELETE FUNCTION
        function deleteFactory(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-factory-' + id).submit();
                }
            })
        }

        function previewImage(input, targetSelector) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(targetSelector).attr('src', e.target.result).hide().fadeIn();
                }
                reader.readAsDataURL(input.files[0]);
                $(input).next('.custom-file-label').html(input.files[0].name);
            }
        }
    </script>
@endpush
