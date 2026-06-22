@extends('backend.components.layoutV2')

@section('main')
@include('backend.components.navbars.header')

<div class="page">
    <div class="section-block">
        <div class="card">
            {{-- Page Selector --}}
            <div class="card-body">
                <div class="section-title" style="margin-bottom:14px">Select Page</div>
                <div class="transport-grid">
                    <a href="{{ route('admin.image_sliders.index') }}" class="transport-btn {{ request()->routeIs('admin.image_sliders.*') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        Home Slider
                    </a>
                    {{-- <div class="transport-btn">
                        <i class="fas fa-globe-asia"></i>
                        Destination Banner
                    </div> --}}
                    <a href="{{ route('admin.tour_banners.index') }}" class="transport-btn {{ request()->routeIs('admin.tour_banners.*') ? 'active' : '' }}">
                        <i class="fas fa-route"></i>
                        Tour Banner
                    </a>
                    <a href="{{ route('admin.corporate_banners.index') }}" class="transport-btn {{ request()->routeIs('admin.corporate_banners.*') ? 'active' : '' }}">
                        <i class="fas fa-building"></i>
                        Corporate Banner
                    </a>
                    <a href="{{ route('admin.blog_banners.index') }}" class="transport-btn {{ request()->routeIs('admin.blog_banners.*') ? 'active' : '' }}">
                        <i class="fas fa-blog"></i>
                        Blog Banner
                    </a>
                    <div class="transport-btn">
                        <i class="fas fa-address-book"></i>
                        Contact Banner
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{-- HOME SLIDERS SECTION --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        @if(request()->routeIs('admin.image_sliders.*'))
        <div class="card" style="margin-top:24px;">
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Image Sliders</div>
                    <div class="card-header-sub">Manage home page image sliders</div>
                </div>
                <a href="{{ route('admin.image_sliders.create_home') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New Slider
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success" style="margin-bottom:18px;">
                    <i class="fas fa-check-circle alert-icon"></i>
                    <div class="alert-body">{{ session('success') }}</div>
                </div>
                @endif

                @if(isset($sliders) && $sliders->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-image"></i>
                    <p>No image sliders found. <a href="{{ route('admin.image_sliders.create_home') }}">Create one now</a>.</p>
                </div>
                @elseif(isset($sliders))
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; min-width:700px;">
                        <thead>
                            <tr style="background:#f8f7fe; border-bottom:0.5px solid #e5e3f0;">
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left; width:80px;">Image</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left; min-width:160px;">Header</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left; min-width:160px;">Title</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left;">Description</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:right; width:160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr style="border-bottom:0.5px solid #eeecf8;">
                                <td style="padding:13px 16px; vertical-align:middle;">
                                    @if($slider->image_path)
                                    <img src="{{ asset('storage/' . $slider->image_path) }}" alt="{{ $slider->title }}"
                                        style="width:52px;height:52px;object-fit:cover;border-radius:8px;display:block;">
                                    @else
                                    <div style="width:52px;height:52px;border-radius:8px;background:#f0f0f6;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-image" style="color:#aaa;"></i>
                                    </div>
                                    @endif
                                </td>
                                <td style="padding:13px 16px; vertical-align:middle; font-size:14px; font-weight:500; color:#1a1a2e;">{{ $slider->header }}</td>
                                <td style="padding:13px 16px; vertical-align:middle; font-size:14px; color:#6c757d;">{{ $slider->title }}</td>
                                <td style="padding:13px 16px; vertical-align:middle; font-size:14px; color:#6c757d;">{{ Str::limit($slider->description, 60) }}</td>
                                <td style="padding:13px 16px; vertical-align:middle;">
                                    <div style="display:flex;gap:8px;justify-content:flex-end;">
                                        <a href="{{ route('admin.image_sliders.edit_home', $slider) }}"
                                            style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;font-size:13px;border-radius:7px;border:0.5px solid #d0ccea;background:transparent;color:#6d5cce;text-decoration:none;">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{-- TOUR BANNERS SECTION --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        @if(request()->routeIs('admin.tour_banners.*'))
        <div class="card" style="margin-top:24px;">
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Tour Banners</div>
                    <div class="card-header-sub">Attach a banner image to an existing tour type</div>
                </div>
                <a href="{{ route('admin.tour_banners.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Set Tour Banner
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success" style="margin-bottom:18px;">
                    <i class="fas fa-check-circle alert-icon"></i>
                    <div class="alert-body">{{ session('success') }}</div>
                </div>
                @endif

                @if(isset($tourTypes) && $tourTypes->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-route"></i>
                    <p>No tour types found. Add a tour type first, then come back to set its banner.</p>
                </div>
                @elseif(isset($tourTypes))
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; min-width:700px;">
                        <thead>
                            <tr style="background:#f8f7fe; border-bottom:0.5px solid #e5e3f0;">
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left; width:80px;">Banner</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left; min-width:160px;">Tour Type</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left; width:120px;">Status</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:right; width:160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tourTypes as $tourType)
                            <tr style="border-bottom:0.5px solid #eeecf8;">
                                <td style="padding:13px 16px; vertical-align:middle;">
                                    @if($tourType->banner_image)
                                    <img src="{{ asset('storage/' . $tourType->banner_image) }}" alt="{{ $tourType->type_name }}"
                                        style="width:52px;height:52px;object-fit:cover;border-radius:8px;display:block;">
                                    @else
                                    <div style="width:52px;height:52px;border-radius:8px;background:#f0f0f6;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-route" style="color:#aaa;"></i>
                                    </div>
                                    @endif
                                </td>
                                <td style="padding:13px 16px; vertical-align:middle; font-size:14px; font-weight:500; color:#1a1a2e;">{{ $tourType->type_name }}</td>
                                <td style="padding:13px 16px; vertical-align:middle;">
                                    @if($tourType->banner_image)
                                    <span style="font-size:12px; padding:3px 10px; border-radius:12px; background:#e8f8ee; color:#1f9254;">Banner set</span>
                                    @else
                                    <span style="font-size:12px; padding:3px 10px; border-radius:12px; background:#fdf1e8; color:#c9740a;">No banner</span>
                                    @endif
                                </td>
                                <td style="padding:13px 16px; vertical-align:middle;">
                                    <div style="display:flex;gap:8px;justify-content:flex-end;">
                                        <a href="{{ route('admin.tour_banners.create', ['tour_type_id' => $tourType->id]) }}"
                                            style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;font-size:13px;border-radius:7px;border:0.5px solid #d0ccea;background:transparent;color:#6d5cce;text-decoration:none;">
                                            <i class="fas fa-edit"></i> {{ $tourType->banner_image ? 'Edit' : 'Set Banner' }}
                                        </a>
                                        {{-- @if($tourType->banner_image)
                                        <form action="{{ route('admin.tour_banners.destroy', $tourType) }}" method="POST"
                                            style="display:inline;" onsubmit="return confirm('Remove this banner image?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;font-size:13px;border-radius:7px;border:0.5px solid #f09595;background:transparent;color:#a32d2d;cursor:pointer;">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </form>
                                        @endif --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{-- CORPORATE BANNERS SECTION --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        @if(request()->routeIs('admin.corporate_banners.*'))
        <div class="card" style="margin-top:24px;">
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Corporate Banners</div>
                    <div class="card-header-sub">Manage corporate page banner</div>
                </div>
                <a href="{{ route('admin.corporate_banners.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New Banner
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success" style="margin-bottom:18px;">
                    <i class="fas fa-check-circle alert-icon"></i>
                    <div class="alert-body">{{ session('success') }}</div>
                </div>
                @endif

                @if(isset($corporates) && $corporates->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-building"></i>
                    <p>No corporate banners found. <a href="{{ route('admin.corporate_banners.create') }}">Create one now</a>.</p>
                </div>
                @elseif(isset($corporates))
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; min-width:700px;">
                        <thead>
                            <tr style="background:#f8f7fe; border-bottom:0.5px solid #e5e3f0;">
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left; width:80px;">Image</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left; min-width:160px;">Title</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left; min-width:160px;">Sub Title</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left;">Description</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:right; width:160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($corporates as $corporate)
                            <tr style="border-bottom:0.5px solid #eeecf8;">
                                <td style="padding:13px 16px; vertical-align:middle;">
                                    @if($corporate->banner_image)
                                    <img src="{{ asset('storage/' . $corporate->banner_image) }}" alt="{{ $corporate->title }}"
                                        style="width:52px;height:52px;object-fit:cover;border-radius:8px;display:block;">
                                    @else
                                    <div style="width:52px;height:52px;border-radius:8px;background:#f0f0f6;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-building" style="color:#aaa;"></i>
                                    </div>
                                    @endif
                                </td>
                                <td style="padding:13px 16px; vertical-align:middle; font-size:14px; font-weight:500; color:#1a1a2e;">{{ $corporate->title }}</td>
                                <td style="padding:13px 16px; vertical-align:middle; font-size:14px; color:#6c757d;">{{ $corporate->sub_title }}</td>
                                <td style="padding:13px 16px; vertical-align:middle; font-size:14px; color:#6c757d;">{{ Str::limit($corporate->description, 60) }}</td>
                                <td style="padding:13px 16px; vertical-align:middle;">
                                    <div style="display:flex;gap:8px;justify-content:flex-end;">
                                        <a href="{{ route('admin.corporate_banners.edit', $corporate) }}"
                                            style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;font-size:13px;border-radius:7px;border:0.5px solid #d0ccea;background:transparent;color:#6d5cce;text-decoration:none;">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        {{-- <form action="{{ route('admin.corporate_banners.destroy', $corporate) }}" method="POST"
                                            style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;font-size:13px;border-radius:7px;border:0.5px solid #f09595;background:transparent;color:#a32d2d;cursor:pointer;">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        @endif

        {{-- ═══════════════════════════════════════════════════════════════ --}}
        {{-- BLOG BANNERS SECTION --}}
        {{-- ═══════════════════════════════════════════════════════════════ --}}
        @if(request()->routeIs('admin.blog_banners.*'))
        <div class="card" style="margin-top:24px;">
            <div class="card-header" style="padding:18px 22px 0;">
                <div>
                    <div class="card-header-title">Blog Banners</div>
                    <div class="card-header-sub">Manage blog page banner images</div>
                </div>
                <a href="{{ route('admin.blog_banners.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New Banner
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success" style="margin-bottom:18px;">
                    <i class="fas fa-check-circle alert-icon"></i>
                    <div class="alert-body">{{ session('success') }}</div>
                </div>
                @endif

                @if(isset($blogBanners) && $blogBanners->isEmpty())
                <div class="empty-state">
                    <i class="fas fa-blog"></i>
                    <p>No blog banners found. <a href="{{ route('admin.blog_banners.create') }}">Create one now</a>.</p>
                </div>
                @elseif(isset($blogBanners))
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; min-width:500px;">
                        <thead>
                            <tr style="background:#f8f7fe; border-bottom:0.5px solid #e5e3f0;">
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left; width:100px;">Banner</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:left;">Added</th>
                                <th style="padding:11px 16px; font-size:11px; font-weight:500; color:#888; text-transform:uppercase; letter-spacing:0.06em; text-align:right; width:180px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogBanners as $blogBanner)
                            <tr style="border-bottom:0.5px solid #eeecf8;">
                                <td style="padding:13px 16px; vertical-align:middle;">
                                    @if($blogBanner->banner_image)
                                    <img src="{{ asset('storage/' . $blogBanner->banner_image) }}" alt="Blog banner"
                                        style="width:64px;height:64px;object-fit:cover;border-radius:8px;display:block;">
                                    @else
                                    <div style="width:64px;height:64px;border-radius:8px;background:#f0f0f6;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-blog" style="color:#aaa;"></i>
                                    </div>
                                    @endif
                                </td>
                                <td style="padding:13px 16px; vertical-align:middle; font-size:14px; color:#6c757d;">
                                    {{ $blogBanner->created_at->format('M d, Y') }}
                                </td>
                                <td style="padding:13px 16px; vertical-align:middle;">
                                    <div style="display:flex;gap:8px;justify-content:flex-end;">
                                        <a href="{{ route('admin.blog_banners.edit', $blogBanner) }}"
                                            style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;font-size:13px;border-radius:7px;border:0.5px solid #d0ccea;background:transparent;color:#6d5cce;text-decoration:none;">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        {{-- <form action="{{ route('admin.blog_banners.destroy', $blogBanner) }}" method="POST"
                                            style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this banner?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="display:inline-flex;align-items:center;gap:5px;padding:6px 12px;font-size:13px;border-radius:7px;border:0.5px solid #f09595;background:transparent;color:#a32d2d;cursor:pointer;">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>

<style>
    .transport-btn {
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        color: inherit;
    }
</style>

@endsection
