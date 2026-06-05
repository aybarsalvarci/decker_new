@extends('admin.layouts.master')

@section('title', 'Contact Information')

@push('css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ─── Temel Değişkenler ─────────────────────────────── */
        :root {
            --brand: #2563eb;
            --brand-light: #eff6ff;
            --brand-mid: #dbeafe;
            --success: #16a34a;
            --success-light: #f0fdf4;
            --warning: #d97706;
            --warning-light: #fffbeb;
            --danger: #dc2626;
            --surface: #ffffff;
            --surface-2: #f8fafc;
            --border: #e2e8f0;
            --border-strong: #cbd5e1;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --radius: 10px;
            --radius-sm: 6px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,.06), 0 1px 2px rgba(0,0,0,.04);
            --shadow: 0 4px 16px rgba(0,0,0,.07), 0 1px 4px rgba(0,0,0,.04);
            --shadow-lg: 0 8px 32px rgba(37,99,235,.12), 0 2px 8px rgba(0,0,0,.05);
            --transition: .18s cubic-bezier(.4,0,.2,1);
        }

        body, .content-wrapper { font-family: 'Plus Jakarta Sans', sans-serif !important; }

        /* ─── Sayfa Başlığı ─────────────────────────────────── */
        .ci-page-header {
            background: linear-gradient(135deg, var(--brand) 0%, #1d4ed8 100%);
            border-radius: var(--radius);
            padding: 28px 32px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
        }
        .ci-page-header::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }
        .ci-page-header h1 { color: #fff; font-size: 1.5rem; font-weight: 700; margin: 0 0 4px; position: relative; }
        .ci-page-header p  { color: rgba(255,255,255,.75); font-size: .875rem; margin: 0; position: relative; }
        .ci-page-header .header-icon {
            position: absolute; right: 32px; top: 50%; transform: translateY(-50%);
            width: 72px; height: 72px; background: rgba(255,255,255,.12);
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
        }
        .ci-page-header .header-icon i { font-size: 1.8rem; color: rgba(255,255,255,.8); }

        /* ─── Kart Sistemi ──────────────────────────────────── */
        .ci-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            margin-bottom: 20px;
            overflow: hidden;
        }
        .ci-card-header {
            padding: 18px 24px 16px;
            border-bottom: 1px solid var(--border);
            background: var(--surface);
            display: flex; align-items: center; gap: 12px;
        }
        .ci-card-icon {
            width: 36px; height: 36px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: .85rem; flex-shrink: 0;
        }
        .ci-card-icon.blue  { background: var(--brand-light); color: var(--brand); }
        .ci-card-icon.green { background: var(--success-light); color: var(--success); }
        .ci-card-icon.amber { background: var(--warning-light); color: var(--warning); }
        .ci-card-icon.slate { background: #f1f5f9; color: #475569; }

        .ci-card-header h3 {
            font-size: .9375rem; font-weight: 700; color: var(--text-primary);
            margin: 0; letter-spacing: -.01em;
        }
        .ci-card-header small { color: var(--text-muted); font-size: .78rem; display: block; margin-top: 1px; }
        .ci-card-body { padding: 24px; }

        /* ─── Form Elemanları ───────────────────────────────── */
        .field-group { margin-bottom: 20px; }
        .field-group:last-child { margin-bottom: 0; }
        .field-label {
            font-size: .8125rem; font-weight: 600; color: var(--text-primary);
            margin-bottom: 7px; display: flex; align-items: center; gap: 6px;
        }
        .field-label .required-dot {
            width: 5px; height: 5px; background: var(--danger);
            border-radius: 50%; display: inline-block; flex-shrink: 0;
        }
        .field-label .field-hint {
            font-size: .73rem; font-weight: 400; color: var(--text-muted);
            margin-left: auto;
        }
        .input-wrap {
            position: relative; display: flex; align-items: stretch;
        }
        .input-wrap .input-icon {
            position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
            color: var(--text-muted); font-size: .8rem; pointer-events: none; z-index: 1;
        }
        .input-wrap input,
        .input-wrap textarea {
            width: 100%; padding: 10px 14px 10px 36px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: .875rem; font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-primary); background: var(--surface);
            transition: border-color var(--transition), box-shadow var(--transition);
            outline: none;
            appearance: none; -webkit-appearance: none;
        }
        .input-wrap textarea { padding-left: 36px; resize: vertical; }
        .input-wrap input:focus,
        .input-wrap textarea:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(37,99,235,.12);
        }
        .input-wrap input.is-invalid,
        .input-wrap textarea.is-invalid { border-color: var(--danger); }
        .input-wrap input.is-invalid:focus,
        .input-wrap textarea.is-invalid:focus { box-shadow: 0 0 0 3px rgba(220,38,38,.12); }
        .invalid-msg { color: var(--danger); font-size: .78rem; margin-top: 5px; display: flex; align-items: center; gap: 4px; }
        .invalid-msg::before { content: "\f071"; font-family: 'Font Awesome 5 Free'; font-weight: 900; font-size: .7rem; }

        /* Textarea için icon'u yukarı al */
        .input-wrap.textarea-wrap .input-icon { top: 14px; transform: none; }
        .input-wrap.textarea-wrap textarea { font-family: 'Menlo', 'Consolas', monospace; font-size: .8rem; }

        /* Dil Etiketleri (Badge) */
        .lang-badge {
            font-size: .68rem; font-weight: 700; padding: 1px 5px; border-radius: 4px;
            text-transform: uppercase; letter-spacing: .02em; display: inline-block;
        }
        .lang-badge.en { background: #e0f2fe; color: #0369a1; }
        .lang-badge.esp { background: #fef3c7; color: #b45309; }

        /* ─── Dosya Yükleme ─────────────────────────────────── */
        .file-upload-zone {
            border: 2px dashed var(--border-strong);
            border-radius: var(--radius-sm);
            padding: 20px;
            text-align: center;
            background: var(--surface-2);
            cursor: pointer;
            transition: border-color var(--transition), background var(--transition);
            position: relative;
        }
        .file-upload-zone:hover, .file-upload-zone.drag-over {
            border-color: var(--brand);
            background: var(--brand-light);
        }
        .file-upload-zone input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .file-upload-zone .upload-icon {
            width: 44px; height: 44px; background: var(--brand-mid);
            border-radius: 10px; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 10px; color: var(--brand); font-size: 1.1rem;
        }
        .file-upload-zone .upload-label { font-size: .8125rem; font-weight: 600; color: var(--text-primary); }
        .file-upload-zone .upload-sub { font-size: .76rem; color: var(--text-muted); margin-top: 3px; }
        .file-upload-zone .upload-filename {
            display: none; font-size: .8rem; color: var(--brand); font-weight: 600;
            background: var(--brand-light); border-radius: 4px; padding: 4px 10px;
            margin-top: 8px; word-break: break-all;
        }

        /* ─── Bilgi Notu ────────────────────────────────────── */
        .info-note {
            background: var(--warning-light); border: 1px solid #fde68a;
            border-left: 3px solid var(--warning); border-radius: var(--radius-sm);
            padding: 12px 14px; font-size: .8rem; color: #78350f;
            display: flex; gap: 10px; margin-top: 14px; align-items: flex-start;
        }
        .info-note i { color: var(--warning); flex-shrink: 0; margin-top: 1px; }
        .info-note strong { font-weight: 700; }

        /* ─── Sağ Panel ─────────────────────────────────────── */
        .sticky-sidebar { position: sticky; top: 20px; }

        /* Önizleme Kartları */
        .preview-label {
            font-size: .72rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: .08em; color: var(--text-muted); margin-bottom: 10px;
            display: flex; align-items: center; gap: 6px;
        }
        .preview-label::after {
            content: ''; flex: 1; height: 1px; background: var(--border);
        }

        /* Hero Image Preview */
        .hero-preview-frame {
            border-radius: var(--radius-sm); overflow: hidden;
            background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
            aspect-ratio: 16/5; display: flex; align-items: center;
            justify-content: center; position: relative;
        }
        .hero-preview-frame img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .hero-preview-frame .no-image {
            text-align: center; color: var(--text-muted);
        }
        .hero-preview-frame .no-image i { font-size: 1.5rem; display: block; margin-bottom: 6px; }
        .hero-preview-frame .no-image span { font-size: .78rem; font-weight: 500; }
        .hero-preview-frame .preview-overlay {
            position: absolute; bottom: 0; left: 0; right: 0;
            background: linear-gradient(to top, rgba(0,0,0,.5), transparent);
            padding: 12px 10px 8px; display: none;
        }
        .hero-preview-frame:hover .preview-overlay { display: block; }
        .preview-badge {
            display: inline-flex; align-items: center; gap: 4px;
            background: rgba(255,255,255,.15); backdrop-filter: blur(4px);
            border: 1px solid rgba(255,255,255,.25); border-radius: 20px;
            font-size: .7rem; font-weight: 600; color: #fff; padding: 2px 8px;
        }

        /* Harita Preview */
        .map-frame {
            border-radius: var(--radius-sm); overflow: hidden;
            border: 1px solid var(--border); height: 240px;
            background: var(--surface-2); position: relative;
        }
        .map-frame iframe { width: 100% !important; height: 100% !important; border: none; display: block; }
        .map-frame .map-placeholder {
            height: 100%; display: flex; flex-direction: column;
            align-items: center; justify-content: center; gap: 8px;
            color: var(--text-muted);
        }
        .map-frame .map-placeholder i { font-size: 2rem; color: var(--border-strong); }
        .map-frame .map-placeholder span { font-size: .8rem; font-weight: 500; }
        .map-live-badge {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: .72rem; font-weight: 600; color: var(--success);
            background: var(--success-light); border-radius: 20px; padding: 2px 8px;
        }
        .map-live-badge .dot {
            width: 6px; height: 6px; background: var(--success);
            border-radius: 50%; animation: pulse-dot 1.5s infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; } 50% { opacity: .3; }
        }

        /* ─── Submit Butonu ─────────────────────────────────── */
        .btn-submit {
            width: 100%; padding: 14px 24px;
            background: linear-gradient(135deg, var(--brand), #1d4ed8);
            border: none; border-radius: var(--radius-sm);
            color: #fff; font-size: .9375rem; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; display: flex; align-items: center;
            justify-content: center; gap: 10px;
            box-shadow: 0 4px 14px rgba(37,99,235,.35);
            transition: transform var(--transition), box-shadow var(--transition), background var(--transition);
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(37,99,235,.45);
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
        }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit i { font-size: 1rem; }

        /* Kaydetme durumu göstergesi */
        .save-meta {
            text-align: center; font-size: .76rem; color: var(--text-muted);
            margin-top: 10px; display: flex; align-items: center;
            justify-content: center; gap: 5px;
        }
        .save-meta i { color: var(--success); }

        /* ─── İki Kolonlu Grid ──────────────────────────────── */
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        @media (max-width: 576px) { .field-row { grid-template-columns: 1fr; } }

        /* ─── Quick Info Kartı ──────────────────────────────── */
        .quick-info-list { list-style: none; padding: 0; margin: 0; }
        .quick-info-list li {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 10px 0; border-bottom: 1px solid var(--border); font-size: .82rem;
        }
        .quick-info-list li:last-child { border-bottom: none; padding-bottom: 0; }
        .quick-info-list li .qi-icon {
            width: 30px; height: 30px; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem; flex-shrink: 0; background: var(--surface-2);
            color: var(--text-secondary);
        }
        .quick-info-list li .qi-label { font-size: .73rem; color: var(--text-muted); }
        .quick-info-list li .qi-value { font-weight: 600; color: var(--text-primary); word-break: break-all; }
        .qi-empty { color: var(--text-muted) !important; font-style: italic; }

        /* ─── Genel Düzeltmeler ─────────────────────────────── */
        .content-wrapper { background: #f1f5f9 !important; }
        .main-footer { background: #f1f5f9 !important; border-top: 1px solid var(--border) !important; }
    </style>
@endpush

@section('breadcrumb-title', 'Contact Info')

@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Contact Information</li>
@endsection

@section('content')
    <div class="container-fluid" style="padding: 24px;">
        <form action="{{ route('admin.contact.infoUpdate') }}" method="post" enctype="multipart/form-data" id="contactForm">
            @csrf
            @method('PUT')

            {{-- ─── Sayfa Başlığı ─────────────────────────────── --}}
            <div class="ci-page-header">
                <h1><i class="fas fa-address-card mr-2" style="opacity:.85;"></i>Contact Page Configuration</h1>
                <p>Manage the content and multilingual localized assets displayed on your public contact page.</p>
                <div class="header-icon d-none d-md-flex">
                    <i class="fas fa-cogs"></i>
                </div>
            </div>

            <div class="row align-items-start">

                {{-- ══════════════════════════════════════════════
                     SOL KOLON — Form Alanları
                ══════════════════════════════════════════════ --}}
                <div class="col-lg-8">

                    {{-- Kart 1 : Multilingual Hero Banner --}}
                    <div class="ci-card">
                        <div class="ci-card-header">
                            <div class="ci-card-icon blue"><i class="fas fa-desktop"></i></div>
                            <div>
                                <h3>Hero Banner Localization</h3>
                                <small>Top banner text configurations for supported languages</small>
                            </div>
                        </div>
                        <div class="ci-card-body">

                            {{-- English Assets Row --}}
                            <div class="field-row mb-3">
                                <div class="field-group">
                                    <label class="field-label" for="hero_title_en">
                                        Hero Title <span class="lang-badge en">EN</span>
                                    </label>
                                    <div class="input-wrap">
                                        <i class="fas fa-heading input-icon"></i>
                                        <input type="text" name="hero_title_en" id="hero_title_en"
                                               class="@error('hero_title_en') is-invalid @enderror"
                                               value="{{ old('hero_title_en', $contact->hero_title_en ?? '') }}"
                                               placeholder="e.g., Get in Touch">
                                    </div>
                                    @error('hero_title_en')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                                <div class="field-group">
                                    <label class="field-label" for="hero_subtitle_en">
                                        Hero Subtitle <span class="lang-badge en">EN</span>
                                    </label>
                                    <div class="input-wrap">
                                        <i class="fas fa-align-left input-icon"></i>
                                        <input type="text" name="hero_subtitle_en" id="hero_subtitle_en"
                                               class="@error('hero_subtitle_en') is-invalid @enderror"
                                               value="{{ old('hero_subtitle_en', $contact->hero_subtitle_en ?? '') }}"
                                               placeholder="e.g., We'd love to hear from you">
                                    </div>
                                    @error('hero_subtitle_en')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <hr style="border-top: 1px dashed var(--border); margin: 0 0 20px 0;">

                            {{-- Spanish Assets Row --}}
                            <div class="field-row mb-4">
                                <div class="field-group">
                                    <label class="field-label" for="hero_title_esp">
                                        Hero Title <span class="lang-badge esp">ESP</span>
                                    </label>
                                    <div class="input-wrap">
                                        <i class="fas fa-heading input-icon"></i>
                                        <input type="text" name="hero_title_esp" id="hero_title_esp"
                                               class="@error('hero_title_esp') is-invalid @enderror"
                                               value="{{ old('hero_title_esp', $contact->hero_title_esp ?? '') }}"
                                               placeholder="e.g., Ponerse en contacto">
                                    </div>
                                    @error('hero_title_esp')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                                <div class="field-group">
                                    <label class="field-label" for="hero_subtitle_esp">
                                        Hero Subtitle <span class="lang-badge esp">ESP</span>
                                    </label>
                                    <div class="input-wrap">
                                        <i class="fas fa-align-left input-icon"></i>
                                        <input type="text" name="hero_subtitle_esp" id="hero_subtitle_esp"
                                               class="@error('hero_subtitle_esp') is-invalid @enderror"
                                               value="{{ old('hero_subtitle_esp', $contact->hero_subtitle_esp ?? '') }}"
                                               placeholder="e.g., Nos encantaría saber de ti">
                                    </div>
                                    @error('hero_subtitle_esp')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                            </div>

                            <div class="field-group" style="margin-bottom:0;">
                                <label class="field-label" for="hero_image">
                                    Global Background Image
                                    <span class="field-hint">Recommended: 1920×450px · JPG, PNG, WebP</span>
                                </label>
                                <div class="file-upload-zone" id="uploadZone">
                                    <input type="file" name="hero_image" id="hero_image" accept="image/*">
                                    <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                    <div class="upload-label">Drag & drop or click to upload</div>
                                    <div class="upload-sub">Leave blank to keep the current image asset</div>
                                    <div class="upload-filename" id="uploadFilename"></div>
                                </div>
                                @error('hero_image')<div class="invalid-msg">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Kart 2 : İletişim Kanalları --}}
                    <div class="ci-card">
                        <div class="ci-card-header">
                            <div class="ci-card-icon green"><i class="fas fa-envelope-open-text"></i></div>
                            <div>
                                <h3>Communication Channels</h3>
                                <small>Primary contact details visible to visitors</small>
                            </div>
                        </div>
                        <div class="ci-card-body">
                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label" for="email">
                                        Email Address
                                        <span class="required-dot"></span>
                                    </label>
                                    <div class="input-wrap">
                                        <i class="fas fa-envelope input-icon"></i>
                                        <input type="email" name="email" id="email" required
                                               class="@error('email') is-invalid @enderror"
                                               value="{{ old('email', $contact->email ?? '') }}"
                                               placeholder="info@company.com">
                                    </div>
                                    @error('email')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                                <div class="field-group">
                                    <label class="field-label" for="phone">
                                        Phone Number
                                        <span class="required-dot"></span>
                                    </label>
                                    <div class="input-wrap">
                                        <i class="fas fa-phone-alt input-icon"></i>
                                        <input type="text" name="phone" id="phone" required
                                               class="@error('phone') is-invalid @enderror"
                                               value="{{ old('phone', $contact->phone ?? '') }}"
                                               placeholder="+1 234 567 89 00">
                                    </div>
                                    @error('phone')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kart 3 : Konum & Çalışma Saatleri --}}
                    <div class="ci-card">
                        <div class="ci-card-header">
                            <div class="ci-card-icon amber"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h3>Location & Working Hours</h3>
                                <small>Office address and availability schedule</small>
                            </div>
                        </div>
                        <div class="ci-card-body">
                            <div class="field-row">
                                <div class="field-group">
                                    <label class="field-label" for="location">Physical Address</label>
                                    <div class="input-wrap">
                                        <i class="fas fa-map-marked-alt input-icon"></i>
                                        <input type="text" name="location" id="location"
                                               class="@error('location') is-invalid @enderror"
                                               value="{{ old('location', $contact->location ?? '') }}"
                                               placeholder="Street, City, State, ZIP">
                                    </div>
                                    @error('location')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                                <div class="field-group">
                                    <label class="field-label" for="working_hours">Operational Hours</label>
                                    <div class="input-wrap">
                                        <i class="far fa-clock input-icon"></i>
                                        <input type="text" name="working_hours" id="working_hours"
                                               class="@error('working_hours') is-invalid @enderror"
                                               value="{{ old('working_hours', $contact->working_hours ?? '') }}"
                                               placeholder="Mon – Fri: 09:00 AM – 06:00 PM">
                                    </div>
                                    @error('working_hours')<div class="invalid-msg">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kart 4 : Google Harita --}}
                    <div class="ci-card">
                        <div class="ci-card-header">
                            <div class="ci-card-icon slate"><i class="fas fa-map"></i></div>
                            <div>
                                <h3>Google Map Embed</h3>
                                <small>Paste the iframe code from Google Maps</small>
                            </div>
                        </div>
                        <div class="ci-card-body">
                            <div class="field-group" style="margin-bottom:0;">
                                <label class="field-label" for="map_input">Iframe Embed Code</label>
                                <div class="input-wrap textarea-wrap">
                                    <i class="fas fa-code input-icon"></i>
                                    <textarea name="map" id="map_input" rows="5"
                                              class="@error('map') is-invalid @enderror"
                                              placeholder='<iframe src="https://www.google.com/maps/embed?..." ...></iframe>'>{{ old('map', $contact->map ?? '') }}</textarea>
                                </div>
                                @error('map')<div class="invalid-msg">{{ $message }}</div>@enderror

                                <div class="info-note">
                                    <i class="fas fa-lightbulb"></i>
                                    <div>
                                        <strong>How to get the code:</strong>
                                        Open Google Maps → Search your location → Click <strong>Share</strong> → Select <strong>Embed a map</strong> tab → Copy HTML and paste above.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /col-lg-8 --}}

                {{-- ══════════════════════════════════════════════
                     SAĞ KOLON — Önizlemeler & Kaydet
                ══════════════════════════════════════════════ --}}
                <div class="col-lg-4">
                    <div class="sticky-sidebar">

                        {{-- Hero Önizleme --}}
                        <div class="ci-card">
                            <div class="ci-card-body" style="padding: 18px;">
                                <div class="preview-label"><i class="fas fa-image" style="color:var(--text-muted);font-size:.75rem;"></i> Hero Preview</div>
                                <div class="hero-preview-frame" id="heroPrevFrame">
                                    @if(!empty($contact->hero_image))
                                        <img src="{{ asset('storage/' . $contact->hero_image) }}" id="heroPrevImg" alt="Hero Preview">
                                        <div class="preview-overlay">
                                            <span class="preview-badge"><i class="fas fa-check-circle"></i> Image set</span>
                                        </div>
                                    @else
                                        <div class="no-image" id="heroNoImage">
                                            <i class="fas fa-image"></i>
                                            <span>No image selected</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Hızlı Bilgi Özeti --}}
                        <div class="ci-card">
                            <div class="ci-card-header" style="padding: 14px 18px 12px;">
                                <div class="ci-card-icon blue" style="width:30px;height:30px;border-radius:7px;font-size:.75rem;"><i class="fas fa-eye"></i></div>
                                <div><h3 style="font-size:.875rem;">Current Info Summary</h3></div>
                            </div>
                            <div class="ci-card-body" style="padding: 8px 18px 14px;">
                                <ul class="quick-info-list" id="quickInfoList">
                                    <li>
                                        <div class="qi-icon"><i class="fas fa-envelope"></i></div>
                                        <div>
                                            <div class="qi-label">Email</div>
                                            <div class="qi-value" id="qi-email">{{ $contact->email ?? '' }}</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="qi-icon"><i class="fas fa-phone-alt"></i></div>
                                        <div>
                                            <div class="qi-label">Phone</div>
                                            <div class="qi-value" id="qi-phone">{{ $contact->phone ?? '' }}</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="qi-icon"><i class="fas fa-map-marker-alt"></i></div>
                                        <div>
                                            <div class="qi-label">Location</div>
                                            <div class="qi-value" id="qi-location">{{ $contact->location ?? '' }}</div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="qi-icon"><i class="far fa-clock"></i></div>
                                        <div>
                                            <div class="qi-label">Working Hours</div>
                                            <div class="qi-value" id="qi-hours">{{ $contact->working_hours ?? '' }}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        {{-- Canlı Harita Önizleme --}}
                        <div class="ci-card">
                            <div class="ci-card-body" style="padding: 18px;">
                                <div class="preview-label" style="margin-bottom:10px;">
                                    <i class="fas fa-map-marked-alt" style="color:var(--text-muted);font-size:.75rem;"></i>
                                    Live Map Preview
                                    <span class="map-live-badge ml-1"><span class="dot"></span>Synced</span>
                                </div>
                                <div class="map-frame" id="mapPreviewContainer">
                                    @if(!empty($contact->map))
                                        {!! $contact->map !!}
                                    @else
                                        <div class="map-placeholder">
                                            <i class="fas fa-map-slash"></i>
                                            <span>No map code entered</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Kaydet Butonu --}}
                        <div class="ci-card" style="border: none; box-shadow: none; background: transparent;">
                            <button type="submit" class="btn-submit" id="submitBtn">
                                <i class="fas fa-save"></i>
                                Save Changes
                            </button>
                            <div class="save-meta">
                                <i class="fas fa-shield-alt"></i>
                                Changes are applied immediately after saving.
                            </div>
                        </div>

                    </div>{{-- /sticky-sidebar --}}
                </div>{{-- /col-lg-4 --}}

            </div>{{-- /row --}}
        </form>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {

            /* ── Canlı Harita Senkronizasyonu ──────────────────── */
            $('#map_input').on('input', function () {
                const code = $(this).val().trim();
                if (code && code.includes('<iframe')) {
                    $('#mapPreviewContainer').html(code);
                } else if (code) {
                    $('#mapPreviewContainer').html(`
                <div class="map-placeholder" style="color: var(--danger);">
                    <i class="fas fa-exclamation-triangle" style="color:#fca5a5; font-size:1.8rem;"></i>
                    <span>Invalid iframe code</span>
                </div>`);
                } else {
                    $('#mapPreviewContainer').html(`
                <div class="map-placeholder">
                    <i class="fas fa-map-slash"></i>
                    <span>No map code entered</span>
                </div>`);
                }
            });

            /* ── Hero Image Seçimi & Önizleme ──────────────────── */
            $('#hero_image').on('change', function (e) {
                const file = e.target.files[0];
                const filename = $(this).val().split('\\').pop();

                $('#uploadFilename').text(filename).show();

                if (file && file.type.match('image.*')) {
                    const reader = new FileReader();
                    reader.onload = function (evt) {
                        const frame = $('#heroPrevFrame');
                        frame.html(`
                    <img src="${evt.target.result}" id="heroPrevImg" alt="Hero Preview" style="width:100%;height:100%;object-fit:cover;">
                    <div class="preview-overlay" style="display:block;">
                        <span class="preview-badge"><i class="fas fa-check-circle"></i> New image selected</span>
                    </div>`);
                    };
                    reader.readAsDataURL(file);
                }
            });

            /* ── Drag & Drop Efekti ────────────────────────────── */
            const zone = document.getElementById('uploadZone');
            zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('drag-over'); });
            zone.addEventListener('dragleave', () => zone.classList.remove('drag-over'));
            zone.addEventListener('drop', e => {
                e.preventDefault();
                zone.classList.remove('drag-over');
                const file = e.dataTransfer.files[0];
                if (file) {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    document.getElementById('hero_image').files = dt.files;
                    $('#hero_image').trigger('change');
                }
            });

            /* ── Canlı Bilgi Özeti Güncellemesi ────────────────── */
            const fields = [
                { input: '#email',         preview: '#qi-email' },
                { input: '#phone',         preview: '#qi-phone' },
                { input: '#location',      preview: '#qi-location' },
                { input: '#working_hours', preview: '#qi-hours' },
            ];
            fields.forEach(f => {
                $(f.input).on('input', function () {
                    const val = $(this).val().trim();
                    $(f.preview)
                        .text(val || '—')
                        .toggleClass('qi-empty', !val);
                });
            });

            /* Başlangıçta boş olanları işaretle */
            fields.forEach(f => {
                if (!$(f.input).val().trim()) {
                    $(f.preview).text('—').addClass('qi-empty');
                }
            });

            /* ── Submit Butonu Yükleme Durumu ──────────────────── */
            $('#contactForm').on('submit', function () {
                $('#submitBtn').html('<i class="fas fa-spinner fa-spin"></i> Saving...').prop('disabled', true);
            });

        });
    </script>
@endpush
