@extends('layouts.news')

<!-- This is SEO Section Start -->

@section('title', 'Category: ' . $category->name)
@section('description', 'Explore the latest news and updates in the ' . $category->slug . ' category.')
@section('keywords', 'news, updates, ' . $category->slug . ', Bangladesh')

@section('og_title', 'Category: ' . $category->slug)
@section('og_description', 'Browse through the latest news and articles in ' . $category->name . ' at News 52.')
@section('og_image', asset('assets/frontend/image/1727430350fav.png'))


@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "headline": "Category: {{ $category->name ?? 'General News' }}",
  "description": "{{ $category->description ?? 'Get the latest updates, news, and articles in this category.' }}",
  "url": "{{ url()->current() ?? 'https://example.com/category/general-news' }}",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "url": "{{ url()->current() ?? 'https://example.com/category/general-news' }}"
  },
  "breadcrumb": {
    "@type": "BreadcrumbList",
    "itemListElement": [
      {
        "@type": "ListItem",
        "position": 1,
        "name": "Home",
        "item": "{{ url('/') ?? 'https://example.com' }}"
      },
      {
        "@type": "ListItem",
        "position": 2,
        "name": "{{ $category->name ?? 'General News' }}",
        "item": "{{ url()->current() ?? 'https://example.com/category/general-news' }}"
      }
    ]
  },
  "author": {
    "@type": "Organization",
    "name": "{{ config('app.name') ?? 'News Portal' }}",
    "url": "{{ url('/') ?? 'https://example.com' }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "{{ config('app.name') ?? 'News Portal' }}",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('path-to-your-logo.png') ?? 'https://example.com/logo.png' }}",
      "width": 600,
      "height": 60
    }
  },
  "isPartOf": {
    "@type": "WebSite",
    "url": "{{ url('/') ?? 'https://example.com' }}",
    "name": "{{ config('app.name') ?? 'News Portal' }}"
  },
  "hasPart": [
    @foreach ($posts as $post)
    {
      "@type": "NewsArticle",
      "headline": "{{ $post->title }}",
      "url": "{{ route('single', $post->slug) }}",
      "image": {
        "@type": "ImageObject",
        "url": "{{ asset('img/posts/' . $post->image) }}",
        "width": 800,
        "height": 450
      },
      "datePublished": "{{ $post->created_at->format('Y-m-d') }}",
      "dateModified": "{{ $post->updated_at->format('Y-m-d') }}",
      "author": {
        "@type": "Person",
        "name": "{{ $post->author_name ?? 'Admin' }}"
      },
      "publisher": {
        "@type": "Organization",
        "name": "{{ config('app.name') ?? 'News Portal' }}",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ asset('assets/setting/1727430172logo_1740816209.png') ?? '' }}",
          "width": 600,
          "height": 60
        }
      }
    } @if (!$loop->last), @endif
    @endforeach
  ]
}
</script>


@endsection

<!-- This is SEO Section End -->

@section('content')


<!--Content of each page-->




<div class="container custom-container">
    <div class="row custom-row">
        <div class="left-content-area details-left-content-area">
            <div class="col-lg-12 custom-padding">

                <ol class="breadcrumb details-page-breadcrumb">
                    <li><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                    <li class="active"><a href="#">{{ $category->name }}</a></li>
                </ol>
                <!--/.details-page-breadcrumb-->
                <div class="category-page">
                  <div class="category-content">

                    <!-- Post 1 - First post -->
                    @if ($posts->isNotEmpty())
                        <div class="category-content-lead">
                            <a href="{{ route('single', $posts->first()->slug) }}">
                                <div class="category-content-lead-left">
                                    <img class="img-fluid"
                                        src="{{ asset('img/posts/' . $posts->first()->image) }}" 
                                        alt="{{ $posts->first()->title }}">
                                </div>
                                <div class="category-content-lead-right">
                                    <div class="category-content-lead-right-text">
                                        <h1>{{ $posts->first()->title }}</h1>
                                        <p>{{ \Illuminate\Support\Str::limit($posts->first()->short_summary, 300) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @else
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="text-danger text-center">No posts available.</h3>
                                </div>
                            </div>
                        </div>
                    @endif

                  </div>

                  <!-- Other Posts -->
                  <div class="row custom-row content_list">
                    @foreach ($posts->skip(1) as $post) <!-- Skip the first post -->
                        <div class="col-md-6 custom-padding">
                            <div class="category-content-single">
                                <a href="{{ route('single', $post->slug) }}">
                                    <div class="category-content-single-left">
                                        <img class="img-fluid"
                                            src="{{ asset('img/posts/' . $post->image) }}"
                                            alt="{{ $post->title }}">
                                    </div>
                                    <div class="category-content-single-right">
                                        <h2>{{ $post->title }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                  </div>

                    <div class="row" id="show_more_main18127" style="margin-bottom:30px;">
                        <div class="col-sm-12 text-center">
                            <div class="mt-3"></div>
                        </div>
                    </div>
                </div>

                <!-- <div class="category-content-btn">
           <div class="details-btn">
             <a href="#" class="btn btn-more-details hvr-bounce-to-right">আরও খবর </a>
           </div>
         </div> -->

            </div>
            <!--/.col-lg-12-->
        </div>
        <!--/.left-content-area-->

        <div class="right-content-area details-right-content-area">
            <div class="col-lg-12 custom-padding">

                <div class="details-page-side-banner">
                    <img border="0" data-original-height="250" data-original-width="300"
                        src="{{ asset('assets/frontend/image/ibbl.gif') }}">
                </div>
                <!--/.details-page-side-banner-->

                <div class="details-tab-container">
                    <ul class="nav nav-pills side-tab-main" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">সর্বশেষ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">জনপ্রিয়</a>
                        </li>
                    </ul>

                    <div class="tab-content alokitonews-tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="least-news">
                                <ul class="least-news-ul detail-least-news-ul">



                                    @foreach($latestPosts as $post)
                                    <li><a
                                            href="{{ route('single', $post->slug) }}">
                                            <div class="least-news-left">
                                                <img src="{{ asset('img/posts/' . $post->image) }}"
                                                    class="img-fluid"
                                                    alt="{{ $post->title }}"
                                                    title="{{ $post->title }}"/>
                                            </div>
                                            <div class="least-news-right">
                                                <h3>{{ $post->title }}</h3>
                                            </div>
                                        </a>
                                    </li>
                                    
                                    @endforeach
                                    


                                </ul>
                                <!--/.least-news-ul-->
                            </div>
                            <!--/.least-news-->
                        </div>
                        <!--/.tab-pane-->

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="least-news">
                                <ul class="least-news-ul detail-least-news-ul">



                                @foreach($popularPosts as $post)
                                    <li><a
                                            href="{{ route('single', $post->slug) }}">
                                            <div class="least-news-left">
                                                <img src="{{ asset('img/posts/' . $post->image) }}"
                                                    class="img-fluid"
                                                    alt="{{ $post->title }}"
                                                    title="{{ $post->title }}"/>
                                            </div>
                                            <div class="least-news-right">
                                                <h3>{{ $post->title }}</h3>
                                            </div>
                                        </a>
                                    </li>
                                    
                                @endforeach



                                </ul>
                                <!--/.least-news-ul-->
                            </div>
                            <!--/.least-news-->
                        </div>
                        <!--/.tab-pane-->

                    </div>
                    <!--/.tab-content-->
                </div>
                <!--/.details-tab-container-->

            </div>
            <!--/.col-lg-12-->
        </div>
        <!--/.right-content-area-->
    </div>
    <!--/.row-->
</div>
<!--/.container-->








<!--Content of each page end-->

@endsection