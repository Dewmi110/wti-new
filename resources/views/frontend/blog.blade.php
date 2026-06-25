@extends('frontend.components.layout')

@section('content')
<section class="hero-wrap hero-wrap-2"
  style="background-image: url('{{ $blogBanner && $blogBanner->banner_image ? \Illuminate\Support\Facades\Storage::url($blogBanner->banner_image) : asset('images/hero-bg-1.jpg') }}'); min-height: 85vh; position: relative;">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center" style="min-height: 85vh;">
      <div class="col-md-9 ftco-animate pb-5 text-center">
        <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('frontend.index') }}">Home <i
                class="fa fa-chevron-right"></i></a></span> <span>Blog <i class="fa fa-chevron-right"></i></span></p>
        <h1 class="mb-0 bread">Blog</h1>
      </div>
    </div>
  </div>
  </div>
</section>

{{-- Blog Image Carousel --}}
<section class="blog-carousel-section py-5">
  <div class="container">
    <div id="blogCarousel" class="carousel slide" data-ride="carousel">

      <ol class="carousel-indicators">
        @foreach($sliders->take(5) as $key => $slider)
        <li data-target="#blogCarousel" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}">
        </li>
        @endforeach
      </ol>

      <div class="carousel-inner">
        @foreach($sliders->take(5) as $key => $slider)
        @php
        $image = $slider->image_path
        ? \Illuminate\Support\Facades\Storage::url($slider->image_path)
        : asset('images/destination-1.jpg');
        @endphp

        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
          <div class="carousel-slide-image" style="background-image:url('{{ $image  }}')">

            <div class="carousel-overlay">
              {{-- <div class="carousel-content text-center">
                <span class="badge badge-warning mb-3">
                  Latest Article
                </span>

                <h2>{{ $blog->name }}</h2>

                <a href="{{ route('single.blog', $blog->id) }}" class="btn btn-primary mt-3">
                  Read More
                </a>
              </div> --}}
            </div>

          </div>
        </div>

        @endforeach
      </div>

      <a class="carousel-control-prev" href="#blogCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>

      <a class="carousel-control-next" href="#blogCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>

    </div>
  </div>
</section>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center pb-4">
      <div class="col-md-12 heading-section text-center ftco-animate">
        {{-- <span class="subheading">Our Blog</span>
        <h2 class="mb-4">Recent Post</h2> --}}
      </div>
    </div>
    <div class="row d-flex">
      @foreach($blogs as $blog)
      @php
      $image = $blog->image ?: $blog->images->first()?->image;
      $image = $image ? \Illuminate\Support\Facades\Storage::url($image) :
      asset('images/destination-1.jpg');
      @endphp

      <div class="col-md-4 d-flex ftco-animate mb-4">
        <div class="tour-card-v2 w-100">
          <div class="tour-card-v2__img" style="background-image: url('{{ $image }}');"></div>
          <span class="tour-card-v2__discount">Article</span>
          <div class="tour-card-v2__body">
            <div class="tour-card-v2__meta">
              <span><i class="fa fa-clock-o"></i>{{ $blog->created_at->format('M D, Y') }}</span>
              <span><i class="fa fa-group"></i>Admin</span>
              {{-- <span><i class="fa fa-map-marker"></i> Malaysia</span> --}}
            </div>
            <h3 class="tour-card-v2__title">{{ $blog->name }}</h3>
            {{-- <p class="tour-card-v2__desc">{{ $blog->content ?: 'No description available.' }}</p> --}}
            {{-- <div class="tour-card-v2__price">
              price: <span class="tour-card-v2__old">$1300</span> <span class="tour-card-v2__new">$1105</span>
            </div> --}}
            <a href="{{ route('single.blog', $blog->id) }}" class="tour-card-v2__btn">Read More</a>
          </div>
        </div>
      </div>
      @endforeach
      {{-- <div class="col-md-4 d-flex ftco-animate mb-4">
        <div class="tour-card-v2 w-100">
          <div class="tour-card-v2__img" style="background-image: url('images/image_2.jpg');"></div>
          <span class="tour-card-v2__discount">UPTO 17% off</span>
          <div class="tour-card-v2__body">
            <div class="tour-card-v2__meta">
              <span><i class="fa fa-clock-o"></i> 5D/4N</span>
              <span><i class="fa fa-group"></i> pax: 10</span>
              <span><i class="fa fa-map-marker"></i> Malaysia</span>
            </div>
            <h3 class="tour-card-v2__title">Weekend To Paris</h3>
            <p class="tour-card-v2__desc">Fusce hic augue velit wisi ips quibus dam pariatur, iusto.</p>
            <div class="tour-card-v2__price">
              price: <span class="tour-card-v2__old">$1100</span> <span class="tour-card-v2__new">$900</span>
            </div>
            <a href="blog-single.html" class="tour-card-v2__btn">BOOK NOW</a>
          </div>
        </div>
      </div>

      <div class="col-md-4 d-flex ftco-animate mb-4">
        <div class="tour-card-v2 w-100">
          <div class="tour-card-v2__img" style="background-image: url('images/image_3.jpg');"></div>
          <span class="tour-card-v2__discount">UPTO 20% off</span>
          <div class="tour-card-v2__body">
            <div class="tour-card-v2__meta">
              <span><i class="fa fa-clock-o"></i> 6D/5N</span>
              <span><i class="fa fa-group"></i> pax: 8</span>
              <span><i class="fa fa-map-marker"></i> Sri Lanka</span>
            </div>
            <h3 class="tour-card-v2__title">Most Popular Place In This World</h3>
            <p class="tour-card-v2__desc">Fusce hic augue velit wisi ips quibus dam pariatur, iusto.</p>
            <div class="tour-card-v2__price">
              price: <span class="tour-card-v2__old">$950</span> <span class="tour-card-v2__new">$760</span>
            </div>
            <a href="blog-single.html" class="tour-card-v2__btn">BOOK NOW</a>
          </div>
        </div>
      </div> --}}

    </div>
  </div>
</section>
@endsection