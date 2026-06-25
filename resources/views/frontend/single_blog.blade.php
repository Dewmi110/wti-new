@extends('frontend.components.layout')
@section('content')
<section class="hero-wrap hero-wrap-2"
    style="background-image: url('{{ $coverImageUrl }}'); min-height: 85vh; position: relative;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center" style="min-height: 85vh;">
            <div class="col-md-9 ftco-animate pb-5 text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('frontend.index') }}">Home <i
                                class="fa fa-chevron-right"></i></a></span> <span>Tour List <i
                            class="fa fa-chevron-right"></i></span></p>
                <h1 class="mb-0 bread">{{ $blog->name }}</h1>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="sb-wrap">

    {{-- ══════════════════════════════════════
         MAIN ARTICLE
    ══════════════════════════════════════ --}}
    <article class="sb-article">

        {{-- Inactive notice --}}
        @if($blog->status == 0)
            <div class="sb-status-inactive">This post is currently inactive / unpublished</div>
        @endif

        {{-- Hero image --}}
        @if($blog->image)
            <img
                src="{{ asset('storage/' . $blog->image) }}"
                alt="{{ $blog->name }}"
                class="sb-hero sb-lightbox-trigger"
                loading="eager"
                title="Click to enlarge"
                onclick="document.getElementById('sb-lightbox').classList.add('active')"
            >

            {{-- Lightbox overlay --}}
            <div class="sb-lightbox" id="sb-lightbox" onclick="this.classList.remove('active')">
                <button class="sb-lightbox-close" onclick="event.stopPropagation(); document.getElementById('sb-lightbox').classList.remove('active')">&times;</button>
                <img
                    src="{{ asset('storage/' . $blog->image) }}"
                    alt="{{ $blog->name }}"
                    class="sb-lightbox-img"
                    onclick="event.stopPropagation()"
                >
                <p class="sb-lightbox-caption">{{ $blog->name }}</p>
            </div>
        @else
            <div class="sb-hero-placeholder">No featured image</div>
        @endif

        {{-- Meta --}}
        <div class="sb-meta">
            <span>
                {{-- Author icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Admin
            </span>
            <span>
                {{-- Calendar icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $blog->created_at->format('F d, Y') }}
            </span>
            <span>
                {{-- Comment icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                No Comments
            </span>
        </div>

        {{-- Title --}}
        <h1 class="sb-title">{{ $blog->name }}</h1>

        {{-- Body content --}}
        <div class="sb-body">
            {!! $blog->content !!}
        </div>

        {{-- Tags (static sample — wire up to a real tags relation if needed) --}}
        {{-- <div class="sb-tags">
            <span class="sb-tags-label">Tags:</span>
            <a href="#" class="sb-tag">Destination</a>
            <a href="#" class="sb-tag">Travel</a>
            <a href="#" class="sb-tag">Hiking</a>
            <a href="#" class="sb-tag">Trekking</a>
        </div> --}}

    </article>

    {{-- ══════════════════════════════════════
         SIDEBAR
    ══════════════════════════════════════ --}}
    <aside class="sb-sidebar">
        {{-- Recent Posts --}}
        <div class="sb-card">
            <div class="sb-card-title">Recent Post</div>

            @php
                $recentPosts = \App\Models\Blog::where('status', 1)
                    ->where('id', '!=', $blog->id)
                    ->latest()
                    ->take(3)
                    ->get();
            @endphp

            @forelse($recentPosts as $post)
                <a href="{{ route('single.blog', $post) }}" class="sb-recent-post">
                    @if($post->image)
                        <img
                            src="{{ asset('storage/' . $post->image) }}"
                            alt="{{ $post->name }}"
                            class="sb-recent-thumb"
                        >
                    @else
                        <div class="sb-recent-thumb-placeholder"></div>
                    @endif
                    <div class="sb-recent-info">
                        <div class="sb-recent-title">{{ $post->name }}</div>
                        <div class="sb-recent-date">{{ $post->created_at->format('F d, Y') }} &middot; No Comments</div>
                    </div>
                </a>
            @empty
                <p style="font-size:13px;color:#6b7280;margin:0;">No recent posts yet.</p>
            @endforelse
        </div>

        {{-- Advertisement --}}
        {{-- <div class="sb-ad">
            <div class="sb-ad-tag">Ad</div>
            <div class="sb-ad-icon">✈️</div>
            <h4 style="color:#ffffff;">TRAVELER</h4>
            <p>Travel &amp; Trip Business<br>Elementor Template Kit</p>
            <a href="#">Explore Now</a>
        </div> --}}

    </aside>
</div>
    </div>
</section>
<script>
    // Close lightbox on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            document.getElementById('sb-lightbox')?.classList.remove('active');
        }
    });
</script>
@endsection