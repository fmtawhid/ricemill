@extends('layouts.news')
<!-- This is SEO Section Start -->
@section('title', 'News 52 - Home')
@section('description', 'Stay updated with the latest breaking news and updates at News 52.')
@section('keywords', 'breaking news, world updates, Bangladesh news, trending stories')

@section('og_title', 'News 52 - Home')
@section('og_description', 'Get the latest news, articles, and updates in all categories at News 52.')
@section('og_image', asset('assets/frontend/image/1727430350fav.png'))


@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "headline": "News 52 - Home",
  "url": "{{ url()->current() }}",
  "mainEntityOfPage": {
    "@type": "WebPage"
  },
  "description": "Stay updated with the latest news, trending topics, and articles on News 52.",
  "about": [
    @foreach($categories as $category)
      {
        "@type": "Categories",
        "name": "{{ addslashes($category->name) }}",
        "url": "{{ url('category/' . $category->slug) }}"
      }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>

@endsection
<!-- This is SEO Section End -->

@section('content')
<div class="container custom-container marquee-container">
    <div class="row custom-row">
        <div class="col-md-12 custom-padding">
            <div class="marquee-block">
                <h2>সর্বশেষ :</h2>
                <ul class="marquee">
                    @foreach($last_post as $post)
                    <li><a href="{{ route('single', $post->slug) }}"><span><img class="img-fluid"
                                    src="{{ asset('assets/frontend/image/1727430350fav.png') }}"></span>
                            {{ $post->title }}
                        </a>
                    </li>
                    @endforeach



            </div>
            <!--/.marquee-block-->
        </div>
        <!--/.col-md-12-->
    </div>
    <!--/.row-->
</div>
<!--/.container-->

<div class="container top-news-section custom-container">
    <div class="row custom-row">
        <div class="top-news-middle">
            <div class="col-md-12 custom-padding">

                <div class="row custom-row category-row">
                    <!-- Post 1 -->
                    <div class="col-md-8 custom-padding">
                        <div class="lead-news">
                            <a href="{{ route('single', $postsWithNewsType4[0]->slug) }}">
                                <img src="{{ asset('/img/posts/' . $postsWithNewsType4[0]->image) }}"
                                    class="img-fluid"
                                    alt="{{ $postsWithNewsType4[0]->title }}"
                                    title="{{ $postsWithNewsType4[0]->title }}" />
                                <div class="lead-news-heading">
                                    <h1>{{ $postsWithNewsType4[0]->title }}</h1>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Post 2, 3 -->
                    <div class="col-md-4 custom-padding">
                        @foreach($postsWithNewsType4->skip(1)->take(2) as $post) <!-- Skip first post and take 2 next posts -->
                        <div class="lead-news-small-wrapper">
                            <div class="lead-news-small">
                                <a href="{{ route('single', $post->slug) }}">
                                    <img src="{{ asset('/img/posts/' . $post->image) }}"
                                        class="img-fluid"
                                        alt="{{ $post->title }}"
                                        title="{{ $post->title }}" />
                                    <div class="lead-news-heading-small">
                                        <h3>{{ $post->title }}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="row custom-row">
                    <!-- Post 4, 5, 6, 7, 8, 9 -->
                    @foreach($postsWithNewsType4->skip(3)->take(6) as $post) <!-- Skip first 3 posts and take next 6 posts -->
                    <div class="col-md-4 custom-padding">
                        <div class="lead-news-second">
                            <a href="{{ route('single', $post->slug) }}">
                                <img src="{{ asset('/img/posts/' . $post->image) }}"
                                    class="img-fluid"
                                    alt="{{ $post->title }}"
                                    title="{{ $post->title }}" />
                                <div class="lead-news-second-heading">
                                    <h3>{{ $post->title }}</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            <!--/.col-md-12 custom-padding-->
        </div>
        <!--/.top-news-middle-->

        <div class="top-news-right">

            <div class="col-md-12 custom-padding">
                <div class="right-top-banner">
                    <img border="0" data-original-height="250" data-original-width="300"
                        src="{{ asset('assets/frontend/image/ibbl.gif') }}">
                </div>
                <!--/.right-top-banner-->
            </div>
            <!--/.col-md-12-->

            <div class="col-md-12 custom-padding">

                <ul class="nav nav-pills side-tab-main" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                            aria-controls="pills-home" aria-selected="true">সর্বশেষ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                            aria-controls="pills-profile" aria-selected="false">জনপ্রিয়</a>
                    </li>
                </ul>

                <div class="tab-content alokitonews-tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                        aria-labelledby="pills-home-tab">





                        <div class="least-news">
                            <ul class="least-news-ul">
                                @foreach ($posts as $post)
                                <li><a href="{{ route('single', $post->slug) }}">
                                        <div class="least-news-left">
                                            <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                                alt="{{ $post->title }}" title="{{ $post->title }}" />
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

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="least-news">
                            <ul class="least-news-ul">
                                @foreach ($popularPosts as $post)
                                <li><a href="{{ route('single', $post->slug) }}">
                                        <div class="least-news-left">
                                            <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                                alt="{{ $post->title }}" title="{{ $post->title }}" />
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
            <!--/.col-md-12 custom-padding-->

        </div>
        <!--/.top-news-right-->
    </div>
    <!--/.row-->
</div>
<!--/.container .top-news-section-->


<div class="feature-news-wrapper bg-white">
    <div class="container custom-container">
        <div class="row custom-row">


            <div class="col-md-6 col-lg-3 custom-padding">
                <div class="special-event-heading">
                    <h2 class="title"> 
                        <a href="{{ url('/category/national') }}">
                            <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                <span style="font-size: 24px; font-weight: bold;">জাতীয়</span>
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                            </div>
                        </a>
                    </h2>
                </div>
                <!--/.special-event-heading-->

                <!-- Post 1 - First Post -->
                @if($nationalPosts->isNotEmpty())
                <div class="feature-news-lead">
                    <a href="{{ route('single', $nationalPosts->first()->slug) }}">
                        <img src="{{ asset('img/posts/' . $nationalPosts->first()->image) }}" class="img-fluid"
                            alt="{{ $nationalPosts->first()->title }}" title="{{ $nationalPosts->first()->title }}" />
                        <div class="feature-news-heading">
                            <h3>{{ $nationalPosts->first()->title }}</h3>
                        </div>
                    </a>
                </div>
                @endif

                <!-- Post 2, 3, 4, 5, ... - Remaining Posts -->
                <ul class="feature-news-ul">
                    @if($nationalPosts->isEmpty())
                    <li>No posts available in the National category.</li>
                    @else
                    @foreach ($nationalPosts->skip(1)->take(4) as $post)
                    <!-- skip(1) to exclude the first post -->
                    <li>
                        <a href="{{ route('single', $post->slug) }}">
                            <div class="feature-news-single">
                                <div class="feature-news-left">
                                    <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                        alt="{{ $post->title }}" title="{{ $post->title }}" />
                                </div>
                                <div class="feature-news-right">
                                    <h3>{{ $post->title }}</h3>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>

            </div>
            <!--/.col-md-6 col-lg-3-->

            <div class="col-md-6 col-lg-3 custom-padding">
                <div class="special-event-heading">
                    <h2 class="title">
                        <a href="{{ url('/category/politics') }}">
                            <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                <span style="font-size: 24px; font-weight: bold;">রাজনীতি</span>
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                            </div>
                        </a>
                    </h2>
                </div>
                <!--/.special-event-heading-->

                <!-- Post 1 - First Post -->
                @if($politicsPosts->isNotEmpty())
                <div class="feature-news-lead">
                    <a href="{{ route('single', $politicsPosts->first()->slug) }}">
                        <img src="{{ asset('img/posts/' . $politicsPosts->first()->image) }}" class="img-fluid"
                            alt="{{ $nationalPosts->first()->title }}" title="{{ $nationalPosts->first()->title }}" />
                        <div class="feature-news-heading">
                            <h3>{{ $politicsPosts->first()->title }}</h3>
                        </div>
                    </a>
                </div>
                @endif

                <!-- Post 2, 3, 4, 5, ... - Remaining Posts -->
                <ul class="feature-news-ul">
                    @if($politicsPosts->isEmpty())
                    <li>No posts available in the National category.</li>
                    @else
                    @foreach ($politicsPosts->skip(1)->take(4) as $post)
                    <!-- skip(1) to exclude the first post -->
                    <li>
                        <a href="{{ route('single', $post->slug) }}">
                            <div class="feature-news-single">
                                <div class="feature-news-left">
                                    <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                        alt="{{ $post->title }}" title="{{ $post->title }}" />
                                </div>
                                <div class="feature-news-right">
                                    <h3>{{ $post->title }}</h3>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>

            </div>
            <!--/.col-md-6 col-lg-3-->

            <div class="col-md-6 col-lg-3 custom-padding">
                <div class="special-event-heading">
                    <h2 class="title">
                        <a href="{{ url('/category/international') }}">
                            <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                <span style="font-size: 24px; font-weight: bold;">আন্তর্জাতিক</span>
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                            </div>
                        </a>
                    </h2>
                </div>
                <!--/.special-event-heading-->

                <!-- Post 1 - First Post -->
                @if($internationalPosts->isNotEmpty())
                <div class="feature-news-lead">
                    <a href="{{ route('single', $internationalPosts->first()->slug) }}">
                        <img src="{{ asset('img/posts/' . $internationalPosts->first()->image) }}" class="img-fluid"
                            alt="{{ $nationalPosts->first()->title }}" title="{{ $nationalPosts->first()->title }}" />
                        <div class="feature-news-heading">
                            <h3>{{ $internationalPosts->first()->title }}</h3>
                        </div>
                    </a>
                </div>
                @endif

                <!-- Post 2, 3, 4, 5, ... - Remaining Posts -->
                <ul class="feature-news-ul">
                    @if($internationalPosts->isEmpty())
                    <li>No posts available in the National category.</li>
                    @else
                    @foreach ($internationalPosts->skip(1)->take(4) as $post)
                    <!-- skip(1) to exclude the first post -->
                    <li>
                        <a href="{{ route('single', $post->slug) }}">
                            <div class="feature-news-single">
                                <div class="feature-news-left">
                                    <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                        alt="{{ $post->title }}" title="{{ $post->title }}" />
                                </div>
                                <div class="feature-news-right">
                                    <h3>{{ $post->title }}</h3>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>

            </div>
            <!--/.col-md-6 col-lg-3-->




            <div class="col-md-6 col-lg-3 custom-padding">
                <div class="special-event-heading mobile-heading tab-heading">
                    <h2 class="title">
                        <a href="{{ url('/category/saradesh') }}">
                            <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                <span style="font-size: 24px; font-weight: bold;">সারাদেশ</span>
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                            </div>
                        </a>
                    </h2>
                </div>
                <!--/.special-event-heading-->
                <ul class="writter-ul">



                    @foreach ($saradeshPosts->take(5) as $post)
                    <li><a href="{{ route('single', $post->slug) }}">
                            <div class="writter-ul-single">
                                <div class="writter-ul-left">
                                    <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                        alt="{{ $post->title }}" title="{{ $post->title }}" />
                                </div>
                                <div class="writter-ul-right">
                                    <h3>{{ $post->title }}</h3>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach

                </ul>


            </div>
            <!--/.col-md-6 col-lg-3-->



        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</div>
<!--/.new-international-->


<section class="international">
    <div class="container custom-container">
        <div class="row custom-row">
            <div class="international-news-left">
                <div class="col-md-12 custom-padding">
                    <div class="special-event-heading">
                        <h2 class="title"> 
                            <a href="{{ url('/category/ict') }}">
                                <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                    <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                    <span style="font-size: 24px; font-weight: bold;">তথ্য যোগাযোগ প্রযুক্তি </span>
                                    <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                </div>
                            </a>
                        </h2>
                    </div>
                    <!--/.special-event-heading-->
                    <div class="row custom-row international-news-row">
                        <div class="col-md-7 custom-padding">
                            <div class="international-lead">
                                @if($ictPosts->isNotEmpty())
                                <a href="{{ route('single', $ictPosts->first()->slug) }}">
                                    <div class="international-lead-img">
                                        <img src="{{ asset('img/posts/' . $ictPosts->first()->image) }}"
                                            class="img-fluid" alt="{{ $ictPosts->first()->title }}"
                                            title="{{ $ictPosts->first()->title }}" />
                                        <div class="international-lead-heading">
                                            <h2>{{ $ictPosts->first()->title }}</h2>
                                        </div>
                                    </div>
                                    <div class="international-lead-detail">
                                        <p style="text-align: justify">{{ $ictPosts->first()->short_summary }}</p>
                                    </div>
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-5 custom-padding">
                            <ul class="international-news-ul">
                                @foreach($ictPosts->skip(1)->take(4) as $post)
                                <!-- skip(1) to exclude the first post -->
                                <li>
                                    <a href="{{ route('single', $post->slug) }}">
                                        <div class="international-news-ul-left">
                                            <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                                alt="{{ $post->title }}" title="{{ $post->title }}" />
                                        </div>
                                        <div class="international-news-ul-right">
                                            <h3>{{ $post->title }}</h3>
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <!--/.custom-row-->


                </div>
                <!--/.col-md-12-->
            </div>
            <!--/.international-news-left-->
            <div class="international-news-right">
                <div class="col-md-12 custom-padding">
                    <div class="special-event-heading">
                        <h2 class="title"> 
                            <a href="{{ url('/category/saradesh') }}">
                                <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                    <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                    <span style="font-size: 24px; font-weight: bold;">সারাদেশ</span>
                                    <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                </div>
                            </a>
                        </h2>
                    </div>
                    <!--/.special-event-heading-->
                    <ul class="writter-ul">


                        @foreach ($saradeshPosts->skip(5)->take(3) as $post)
                        <li><a href="{{ route('single', $post->slug) }}">
                                <div class="writter-ul-single writter-ul-single-white">
                                    <div class="writter-ul-left">
                                        <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                            alt="{{ $post->title }}" title="{{ $post->title }}" />
                                    </div>
                                    <div class="writter-ul-right">
                                        <h3>{{ $post->title }}</h3>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach

                    </ul>
                    <!--/.writter-ul-->
                    <div class="footer-facebook-like">
                        <div class="fb-page" data-href="https://www.facebook.com/official.elitedesign" data-width="300"
                            data-height="250" data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/official.elitedesign"><a
                                        href="https://www.facebook.com/official.elitedesign">সংবাদ ৫২</a></blockquote>
                            </div>
                        </div>

                    </div>
                    <!--/.footer-facebook-like-->
                    <!-- <div class="right-international-banner">
              <img src="media/common/sider-banner.gif" alt="Banner AD.">
            </div> -->
                </div>
                <!--/.col-md-12-->
            </div>
            <!--/.international-news-right-->
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
<!--/.international-->

<section class="capital-section bg-white">
    <div class="container custom-container">
        <div class="row custom-row">

            <div class="col-md-6 col-lg-3 custom-padding">
                <div class="special-event-heading">
                    <h2 class="title"> 
                        <a href="{{ url('/category/campus') }}">
                            <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                <span style="font-size: 24px; font-weight: bold;">ক্যাম্পাস </span>
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                            </div>
                        </a>
                    </h2>
                </div>
                <!--/.special-event-heading-->

                <!-- Post 1 - First Post -->
                @if($campusPosts->isNotEmpty())
                <div class="feature-news-lead">
                    <a href="{{ route('single', $campusPosts->first()->slug) }}">
                        <img src="{{ asset('img/posts/' . $campusPosts->first()->image) }}" class="img-fluid"
                            alt="{{ $nationalPosts->first()->title }}" title="{{ $nationalPosts->first()->title }}" />
                        <div class="feature-news-heading">
                            <h3>{{ $campusPosts->first()->title }}</h3>
                        </div>
                    </a>
                </div>
                @endif

                <!-- Post 2, 3, 4, 5, ... - Remaining Posts -->
                <ul class="feature-news-ul">
                    @if($campusPosts->isEmpty())
                    <li>No posts available in the National category.</li>
                    @else
                    @foreach ($campusPosts->skip(1)->take(4) as $post)
                    <!-- skip(1) to exclude the first post -->
                    <li>
                        <a href="{{ route('single', $post->slug) }}">
                            <div class="feature-news-single">
                                <div class="feature-news-left">
                                    <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                        alt="{{ $post->title }}" title="{{ $post->title }}" />
                                </div>
                                <div class="feature-news-right">
                                    <h3>{{ $post->title }}</h3>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>

            </div>
            <!--/.col-md-6 col-lg-3-->

            <div class="col-md-6 col-lg-3 custom-padding">
                <div class="special-event-heading">
                    <h2 class="title"> 
                        <a href="{{ url('/category/media') }}">
                            <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                <span style="font-size: 24px; font-weight: bold;">মিডিয়া </span>
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                            </div>
                        </a>
                    </h2>
                </div>
                <!--/.special-event-heading-->

                <!-- Post 1 - First Post -->
                @if($mediaPosts->isNotEmpty())
                <div class="feature-news-lead">
                    <a href="{{ route('single', $mediaPosts->first()->slug) }}">
                        <img src="{{ asset('img/posts/' . $mediaPosts->first()->image) }}" class="img-fluid"
                            alt="{{ $nationalPosts->first()->title }}" title="{{ $nationalPosts->first()->title }}" />
                        <div class="feature-news-heading">
                            <h3>{{ $mediaPosts->first()->title }}</h3>
                        </div>
                    </a>
                </div>
                @endif

                <!-- Post 2, 3, 4, 5, ... - Remaining Posts -->
                <ul class="feature-news-ul">
                    @if($mediaPosts->isEmpty())
                    <li>No posts available in the National category.</li>
                    @else
                    @foreach ($mediaPosts->skip(1)->take(4) as $post)
                    <!-- skip(1) to exclude the first post -->
                    <li>
                        <a href="{{ route('single', $post->slug) }}">
                            <div class="feature-news-single">
                                <div class="feature-news-left">
                                    <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                        alt="{{ $post->title }}" title="{{ $post->title }}" />
                                </div>
                                <div class="feature-news-right">
                                    <h3>{{ $post->title }}</h3>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>

            </div>
            <!--/.col-md-6 col-lg-3-->

            <div class="col-md-6 col-lg-3 custom-padding">
                <div class="special-event-heading">
                    <h2 class="title">
                        <a href="{{ url('/category/sports') }}">
                            <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                <span style="font-size: 24px; font-weight: bold;">খেলাধুলা </span>
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                            </div>
                        </a>
                    </h2>
                </div>
                <!--/.special-event-heading-->

                <!-- Post 1 - First Post -->
                @if($sportsPosts->isNotEmpty())
                <div class="feature-news-lead">
                    <a href="{{ route('single', $sportsPosts->first()->slug) }}">
                        <img src="{{ asset('img/posts/' . $sportsPosts->first()->image) }}" class="img-fluid"
                            alt="{{ $nationalPosts->first()->title }}" title="{{ $nationalPosts->first()->title }}" />
                        <div class="feature-news-heading">
                            <h3>{{ $sportsPosts->first()->title }}</h3>
                        </div>
                    </a>
                </div>
                @endif

                <!-- Post 2, 3, 4, 5, ... - Remaining Posts -->
                <ul class="feature-news-ul">
                    @if($sportsPosts->isEmpty())
                    <li>No posts available in the National category.</li>
                    @else
                    @foreach ($sportsPosts->skip(1)->take(4) as $post)
                    <!-- skip(1) to exclude the first post -->
                    <li>
                        <a href="{{ route('single', $post->slug) }}">
                            <div class="feature-news-single">
                                <div class="feature-news-left">
                                    <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                        alt="{{ $post->title }}" title="{{ $post->title }}" />
                                </div>
                                <div class="feature-news-right">
                                    <h3>{{ $post->title }}</h3>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>

            </div>
            <!--/.col-md-6 col-lg-3-->

            <div class="col-md-6 col-lg-3 custom-padding">
                <div class="special-event-heading">
                    <h2 class="title"> 
                        <a href="{{ url('/category/education') }}">
                            <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                <span style="font-size: 24px; font-weight: bold;">শিক্ষা </span>
                                <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                            </div>
                        </a>
                    </h2>
                </div>
                <!--/.special-event-heading--> 

                <!-- Post 1 - First Post -->
                @if($educationPosts->isNotEmpty())
                <div class="feature-news-lead">
                    <a href="{{ route('single', $educationPosts->first()->slug) }}">
                        <img src="{{ asset('img/posts/' . $educationPosts->first()->image) }}" class="img-fluid"
                            alt="{{ $nationalPosts->first()->title }}" title="{{ $nationalPosts->first()->title }}" />
                        <div class="feature-news-heading">
                            <h3>{{ $educationPosts->first()->title }}</h3>
                        </div>
                    </a>
                </div>
                @endif

                <!-- Post 2, 3, 4, 5, ... - Remaining Posts -->
                <ul class="feature-news-ul">
                    @if($educationPosts->isEmpty())
                    <li>No posts available in the National category.</li>
                    @else
                    @foreach ($educationPosts->skip(1)->take(4) as $post)
                    <!-- skip(1) to exclude the first post -->
                    <li>
                        <a href="{{ route('single', $post->slug) }}">
                            <div class="feature-news-single">
                                <div class="feature-news-left">
                                    <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                        alt="{{ $post->title }}" title="{{ $post->title }}" />
                                </div>
                                <div class="feature-news-right">
                                    <h3>{{ $post->title }}</h3>
                                </div>
                            </div>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>

            </div>
            <!--/.col-md-6 col-lg-3-->






        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
<!--/.capital-section-->

<section class="sports">
    <div class="container custom-container">

        <div class="row custom-row">
            <div class="sports-news-left">



                <div class="col-md-12">
                    <div class="special-event-heading">
                        <h2 class="title">
                            <a href="{{ url('/category/law-and-courts') }}">
                                <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                    <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                    <span style="font-size: 24px; font-weight: bold;"> আইন ও আদালত </span>
                                    <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                </div>
                            </a>
                        </h2>
                    </div>
                    <!--/.special-event-heading-->


                    <div class="row custom-row">
                        @if($lawPosts->isNotEmpty())
                        <!-- Post 1 start -->
                        <div class="col-md-6 custom-padding">
                            <div class="sports-lead-news">
                                <a href="{{ route('single', $lawPosts->first()->slug) }}">
                                    <img src="{{ asset('img/posts/' . $lawPosts->first()->image) }}" class="img-fluid"
                                        alt="{{ $lawPosts->first()->title }}" title="{{ $lawPosts->first()->title }}" />
                                    <div class="sports-lead-news-text">
                                        <h2>{{ $lawPosts->first()->title }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endif
                        <!-- Post 1 end -->

                        <div class="col-md-6 custom-padding">
                            <div class="row custom-row">
                                <!-- Post 2,3,4,5 start-->
                                @if($lawPosts->isEmpty())
                                <li>No posts available in the Law and Courts category.</li>
                                @else
                                @foreach ($lawPosts->skip(1)->take(4) as $post)
                                <div class="col-md-6 custom-padding">
                                    <div class="sports-small-news">
                                        <a href="{{ route('single', $post->slug) }}">
                                            <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid"
                                                alt="{{ $post->title }}" title="{{ $post->title }}" />
                                            <div class="sports-small-news-text">
                                                <h3>{{ $post->title }}</h3>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                                <!-- Post 2,3,4,5 end-->
                            </div>
                        </div>
                    </div>

                    <div class="row custom-row">
                        @if($lawPosts->isEmpty())
                        <li>No posts available in the Law and Courts category.</li>
                        @else
                        @foreach ($lawPosts->skip(5)->take(4) as $post)
                        <!-- Post 6,7,8,9 start-->
                        <div class="col-md-3 custom-padding">
                            <div class="sports-small-news">
                                <a href="{{ route('post.details', $post->slug) }}">
                                    <img src="{{ asset('/img/posts/' . $post->image) }}"
                                        class="img-fluid" alt="{{ $post->title }}" title="{{ $post->title }}" />
                                    <div class="sports-small-news-text">
                                        <h3>{{ $post->title }}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <!-- Post 6,7,8,9 end-->
                    </div>
                </div>
                <!--/.col-md-12-->


            </div>
            <!--/.sports-news-left-->
            <div class="sports-news-right">
                <div class="col-md-12">
                    <div class="sports-banner-1 text-center">
                        <img border="0" data-original-height="250" data-original-width="300"
                            src="{{ asset('assets/frontend/image/ibbl.gif') }}">
                    </div>
                    <!--/.sports-banner-1-->
                    <div class="sports-banner-2">
                        <img border="0" data-original-height="250" data-original-width="300" height="250" width="300"
                            src="{{ asset('assets/frontend/image/jamuna.gif') }}">
                    </div>
                    <!--/.sports-banner-2-->
                </div>
                <!--/.col-md-12-->
            </div>
            <!--/.sports-news-right-->
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
<!--/.sports-->


<section class="life-style-section">
    <div class="container custom-container">
        <div class="row custom-row">
            <div class="life-style-left">
                <div class="col-md-12 custom-padding">
                    <div class="special-event-heading">
                        <h2 class="title">
                            <a href="#">
                                <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                    <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                    <span style="font-size: 24px; font-weight: bold;"> আলোচিত সংবাদ </span>
                                    <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                </div>
                            </a>
                        </h2>
                    </div>
                    <!--/.special-event-heading-->
                    <div class="row custom-row life-style-row">
                        <!-- Post 1, 2, 3 -->
                        @foreach ($postsWithNewsType3->take(3) as $post)
                        <div class="col-md-4 custom-padding">
                            <div class="life-style-single">
                                <a href="{{ route('single', $post->slug) }}">
                                    <img src="{{ asset('/img/posts/' . $post->image) }}"
                                        class="img-fluid"
                                        alt="{{ $post->title }}"
                                        title="{{ $post->title }}" />
                                    <div class="life-style-single-text">
                                        <h2>{{ $post->title }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Post 4, 5, 6, 7 -->
                    <div class="row custom-row">
                        @foreach($postsWithNewsType3->skip(3)->take(4) as $post)
                        <div class="col-md-3 custom-padding">
                            <div class="life-style-single">
                                <a href="{{ route('single', $post->slug) }}">
                                    <img src="{{ asset('/img/posts/' . $post->image) }}"
                                        class="img-fluid"
                                        alt="{{ $post->title }}"
                                        title="{{ $post->title }}" />
                                    <div class="life-style-single-text">
                                        <h2>{{ $post->title }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!--/.row-->
                </div>
                <!--/.col-md-12-->
            </div>
            <!--/.life-style-left-->
            <div class="life-style-right">
                <div class="col-md-12">
                    <div class="namaj-time">
                        <div class="namaj-time-heading">
                            <h2> নামাজের সময়সূচী </h2>
                        </div>
                        <!--/.namaj-time-heading-->
                        <div class="namaj-time-body">
                            <div class="namaj-time-body-left">
                                <img class="img-fluid" src="{{asset('assets/frontend/assets/frontend/namaj-time.jpg')}}"
                                    alt="Masjid">
                            </div>
                            <!--/.namaj-time-body-left-->
                            <div class="namaj-time-body-right">
                                <table class="table table-striped namaj-time-table">
                                    <tbody>
                                        <tr>
                                            <td>ফজর</td>
                                            <td>৪:২২</td>
                                        </tr>
                                        <tr>
                                            <td>জোহর</td>
                                            <td>১১:৫৯</td>
                                        </tr>
                                        <tr>
                                            <td>আসর</td>
                                            <td>৪:৪৫</td>
                                        </tr>
                                        <tr>
                                            <td>মাগরিব</td>
                                            <td>৬:১৯</td>
                                        </tr>
                                        <tr>
                                            <td>এশা</td>
                                            <td>৭:৩২</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--/.namaj-time-body-right-->
                        </div>
                        <!--/.namaj-time-body-->
                    </div>
                    <!--/.namaj-time-->
                    <div class="life-style-2 text-center">
                        <img class="img-fluid" src="{{ asset('assets/frontend/image/marcel.jpeg') }}" alt="Banner">
                    </div>
                    <!--/.sports-banner-2-->
                </div>
                <!--/.col-md-12-->
            </div>
            <!--/.life-style-right-->
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
<!--/.life-style-section-->

<section class="video-gallery-section bg-white">
    <div class="container jagaran-container">
        <div class="video-gallery-heading">
            <h3 class="title-bg"><a href="video.html">ভিডিও গ্যালারি</a></h3>
        </div>
        <!--/.video-gallery-heading-->
        @if($postsWithVideo->isEmpty())
        <div class="text-center">
            <h2 style="color:red;">ভিডিও পোষ্ট পাওয়া যায়নি</h2>
            <p>এই মুহূর্তে কোনো ভিডিও পোষ্ট পাওয়া যায়নি।</p>
        </div>
        @else
        <div id="featured-videos-section" class="owl-carousel">
            @foreach ($postsWithVideo->take(20) as $post)
            <div class="item">
                <a href="{{ route('single', $post->slug) }}">
                    <div class="single-videos">
                        <div class="images">
                            <img src="{{ asset('/img/posts/' . $post->image) }}" alt="{{ $post->title }}"
                                title="{{ $post->title }}" class="img-fluid">
                            <div class="overley">
                                <div class="videos-icon">
                                    <div class="videos-icon-wapper">
                                        <i class="fa fa-play" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="videos-text">
                            <h3>{{ Str::limit($post->title, 80) }}</h3> <!-- Truncate title if needed -->
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <!--/featured-videos-section-->
        @endif

    </div>
    <!--/.container-->
</section>
<!--/.video-gallery-section-->

<section class="international">
    <div class="container custom-container">
        <div class="row custom-row">
            <div class="international-news-left">
                <div class="col-md-12 custom-padding">
                    <div class="special-event-heading">
                        <h2 class="title"> 
                            <a href="#">
                                <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                                    <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                    <span style="font-size: 24px; font-weight: bold;">জনপ্রিয় আলোচনা</span>
                                    <span style="flex-grow: 1; height: 3px; background-color: black; margin: 0 10px;"></span>
                                </div>
                            </a>
                        </h2>
                    </div>
                    <!--/.special-event-heading-->

                    <div class="row custom-row natioal-top-section">
                        <!-- Post 1 - First Post -->
                        @if($popularPosts->isNotEmpty())
                        <div class="col-md-6 custom-padding">
                            <!-- Post 1 -->
                            <div class="lead-national-main">
                                <a href="{{ route('single', $popularPosts->first()->slug) }}">
                                    <div class="lead-national-main-img">
                                        <img src="{{ asset('/img/posts/' . $popularPosts->first()->image) }}"
                                            class="img-fluid" alt="{{ $popularPosts->first()->title }}"
                                            title="{{ $popularPosts->first()->title }}" />
                                        <div class="lead-national-heading">
                                            <h2>{{ $popularPosts->first()->title }}</h2>
                                        </div>
                                    </div>
                                    <div class="lead-national-main-text">
                                        <p style="text-align: justify">
                                            {{ Str::limit($popularPosts->first()->short_summary, 150) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endif

                        <!-- Post 2, 3, 4, 5 (Remaining Posts) -->
                        <div class="col-md-6 custom-padding">
                            <div class="row custom-row">
                                @foreach($popularPosts->slice(1, 4) as $post)
                                <!-- skip(1) to exclude the first post -->
                                <div class="col-md-6 custom-padding">
                                    <div class="sports-small-news">
                                        <a href="{{ route('single', $post->slug) }}">
                                            <img src="{{ asset('/img/posts/' . $post->image) }}" class="img-fluid"
                                                alt="{{ $post->title }}" title="{{ $post->title }}" />
                                            <div class="sports-small-news-text">
                                                <h3>{{ $post->title }}</h3>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Row for Post 6, 7, 8, 9 -->
                    <div class="row custom-row">
                        @foreach($popularPosts->slice(4) as $post)
                        <!-- Get posts 6, 7, 8, 9 -->
                        <div class="col-md-3 custom-padding">
                            <div class="sports-small-news">
                                <a href="{{ route('single', $post->slug) }}">
                                    <img src="{{ asset('/img/posts/' . $post->image) }}" class="img-fluid"
                                        alt="{{ $post->title }}" title="{{ $post->title }}" />
                                    <div class="sports-small-news-text">
                                        <h3>{{ $post->title }}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                </div>
                <!--/.col-md-12-->
            </div>
            <!--/.international-news-left-->
            <div class="international-news-right">
                <div class="col-md-12 custom-padding">
                    <div class="map-heading">
                        <h2> এক ক্লিকে বিভাগের সব খবর </h2>
                    </div>
                    <div class="bangladesh-map">
                        <!--?xml version="1.0" encoding="utf-8"?-->
                        <!-- Generator: Adobe Illustrator 16.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->

                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="-1183.849 0 1065.106 1391" enable-background="new -1183.849 0 1065.106 1391"
                            xml:space="preserve">
                            <g id="Dhaka">
                                <a href="{{ url('/sub-category/dhaka') }}"
                                    xlink:href="{{ url('/sub-category/dhaka') }}">
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-805.061,792.43 -810.275,786.251
-805.062,792.43 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-833.156,747.247 -834.51,744.351
-834.411,741.069 -834.51,744.351 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-807.381,773.7 -811.339,754.971
-813.174,750.337 -811.34,754.971 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-737.482,896.89 -739.8,898.743
-737.481,896.89 -741.344,890.035 -744.431,887.14 -744.432,887.14 -741.344,890.035 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-864.532,705.154 -873.125,694.146
-864.533,705.154 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-788.939,836.454 -792.51,835.778
-794.249,834.234 -792.511,835.778 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-766.445,867.444 -765.286,871.596
-766.444,867.444 -767.409,865.32 -770.114,861.555 -767.41,865.32 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-805.352,799.863 -801.199,795.809
-798.786,792.237 -798.787,792.237 -801.2,795.809 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-789.714,830.757 -788.166,827.572
-784.981,822.938 -788.169,827.572 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-873.125,694.146 -873.704,692.121
-862.892,663.93 -873.705,692.121 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-885.482,354.796 -878.822,361.362
-864.919,353.349 -878.822,361.361 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-771.947,470.456 -771.947,470.456
-772.046,465.628 -773.106,461.381 -772.046,465.629 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-891.469,334.232 -900.061,332.109
-891.469,334.233 -890.792,343.019 -885.482,354.796 -890.792,343.018 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-862.698,659.296 -863.084,657.461
-866.077,648.483 -863.085,657.461 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-535.125,393.801 -532.905,390.422
-532.228,388.201 -532.905,390.421 -535.125,393.8 -536.962,397.662 -539.276,405.965 -539.276,405.965 -536.962,397.663 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-832.48,362.81 -852.368,356.245
-832.48,362.81 -816.041,362.81 -816.041,362.81 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-777.839,504.632 -778.416,501.833
-778.416,501.833 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-871.949,646.148 -871.002,646.359
-866.077,648.483 -871.001,646.359 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-924.402,629.068 -923.437,624.048
-923.437,624.048 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-769.533,584.764 -769.823,578.585
-772.719,576.075 -769.823,578.586 ">
                                    </polygon>
                                    <path fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" d="M-532.135,385.112l-0.095,3.089L-532.135,385.112
    z"></path>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-578.738,694.438 -579.052,693.762
-579.052,693.763 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-570.846,672.136 -572.007,667.212
-572.007,667.213 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-552.309,657.655 -552.31,657.655
-546.134,661.709 -545.456,661.898 -546.133,661.709 ">
                                    </polygon>
                                    <rect x="-501.047" y="578.667" fill="#0E660C" stroke="#9B9B9B" stroke-width="2"
                                        stroke-miterlimit="10" width="0" height="2.635">
                                    </rect>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-489.074,571.731 -483.177,574.813
-489.073,571.73 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-502.882,583.316 -502.881,583.316
-503.302,583.158 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-570.091,714.823 -570.846,713.747
-576.349,708.05 -570.846,713.747 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-491.487,466.015 -491.487,466.016
-489.943,454.044 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-572.777,701.486 -572.777,701.484
-573.26,699.844 -575.385,697.334 -573.26,699.844 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-575.385,697.334 -578.379,695.21
-578.379,695.211 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-745.205,902.394 -745.108,903.746
-743.759,905.096 -744.073,906.518 -743.758,905.096 -745.108,903.744 -745.204,902.394 -743.758,899.689 -743.759,899.689 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-752.091,922.474 -751.77,922.089
-751.77,922.089 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-750.032,933.867 -747.811,935.894
-746.363,937.825 -744.049,944.679 -740.669,947.19 -739.412,948.349 -737.771,953.271 -737.676,956.072 -737.676,956.072
-737.77,953.271 -739.411,948.349 -740.666,947.188 -744.048,944.679 -746.363,937.825 -747.811,935.894 -750.031,933.867
-750.131,932.901 -750.131,932.901 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-752.255,926.144 -747.039,926.723
-745.205,927.301 -744.143,928.943 -745.204,927.301 -747.039,926.723 -752.254,926.144 -753.604,925.467 -753.604,925.469 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-747.136,913.785 -745.302,914.849
-744.338,915.91 -745.302,914.847 -747.135,913.785 -748.006,911.758 -748.006,911.758 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-773.492,487.833 -774.554,483.393
-773.492,487.834 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-666.521,848.426 -668.55,848.039
-668.551,848.039 -666.521,848.426 -663.337,847.942 -661.597,849.101 -663.337,847.942 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-728.021,880.96 -730.531,883.567
-732.074,884.392 -730.53,883.567 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-661.597,849.101 -661.5,853.059
-661.5,853.059 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-717.496,864.935 -717.265,864.644
-717.497,864.935 -720.393,871.209 -721.853,873.236 -720.392,871.209 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-780.153,851.418 -785.27,840.51
-787.3,837.419 -785.271,840.51 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-740.763,967.076 -740.763,967.078
-739.895,969.009 -736.613,970.746 -739.894,969.008 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-475.654,509.17 -477.875,513.417
-479.166,515.252 -477.875,513.418 ">
                                    </polygon>
                                    <path fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        d="M-472.76,501.544l-2.896,7.626L-472.76,501.544z">
                                    </path>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-472.76,529.348 -473.05,532.146
-476.522,534.658 -473.05,532.148 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-635.724,846.591 -635.724,846.591
-636.484,847.748 "></polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-455.765,624.733 -456.44,623.864
-455.766,624.732 -455.863,626.76 -456.732,632.069 -456.731,632.07 -455.863,626.761 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-462.234,591.715 -460.786,591.039
-456.25,590.074 -454.897,589.302 -454.898,589.301 -456.25,590.073 -460.786,591.038 -462.234,591.714 -463.78,593.356
-463.878,597.218 -463.878,597.218 -463.779,593.356 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-461.558,607.452 -461.365,604.556
-462.331,600.694 -463.188,598.763 -462.332,600.693 -461.366,604.555 -461.559,607.451 -460.885,613.146 -459.344,618.748
-460.885,613.148 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-461.175,583.413 -455.476,579.938
-451.807,576.751 -451.807,576.75 -455.476,579.936 -461.175,583.412 -462.525,584.956 -462.228,585.343 -462.524,584.957 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-482.702,559.663 -485.794,567.482
-487.432,569.027 -485.794,567.483 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-617.094,778.335 -626.939,773.121
-634.469,770.417 -639.972,770.417 -640.552,772.446 -638.331,775.729 -631.766,782.583 -628.003,785.382 -624.045,786.541
-620.277,784.706 -619.118,782.101 -614.969,783.741 -607.342,789.342 -609.077,784.32 ">
                                    </polygon>

                                    <path fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" d="M-576.638,726.007l2.123-2.315l-1.545-2.605
    l0.869-1.932l2.51-1.256l3.188-0.386l0.48-1.158l-1.076-1.529l-0.758-1.076l-5.503-5.697l1.834-1.834l1.545-3.089l0.193-1.641
    l-0.482-1.645l-2.125-2.51l-2.992-2.123v-0.001v-0.001l-0.359-0.771l-0.314-0.675v-0.003l0,0l0.388-2.026l3.28-5.021l4.248-11.197
    l0.29-3.38l-1.158-4.924v-0.001l0,0l0.098-1.834l2.026-2.992l2.703-2.123l2.799-0.772l6.373,0.291l1.643-0.193l4.055-1.931l0,0
    h0.001l6.179,4.055l0.677,0.189l1.736,0.486l1.933-1.063l2.896-2.414l7.917-11.006l4.247-9.558l1.063-5.601l-0.869-4.345
    l1.835-5.407l2.413-2.314l3.379-2.125l4.056-4.635l1.544-4.826l-4.055-2.414l1.545-3.283l-3.766-5.406l0.289-1.063l-0.868-4.441
    l1.255-0.771l4.729-1.644l6.951-9.558l2.801,2.22l1.122,0.422l0.424,0.158l1.446-0.193l0.579-1.834l-0.386-2.604v-0.001v-2.316
    l1.834-1.063l4.055-0.387l3.572-1.256l2.703-1.931l0,0h0.001l1.641-2.703l1.643-1.545l3.09-7.82l7.048-3.186l4.537-3.188
    l-2.896-4.537l2.317-2.511l1.447-0.481l1.063-2.124l-0.386-1.738l-2.414-3.186l-4.537-4.057l3.476-2.511l0.29-2.799l-1.158-5.406
    l-2.512-1.159l-2.315-0.191l-1.544-0.966l-1.644-1.932l0.193-1.642l2.025-2.027l0.544-0.772l1.291-1.836l2.222-4.246l2.896-7.627
    l-3.765-2.026l-2.414-2.414l-1.063-2.414l-2.605-3.282l-0.097-1.739l4.826-2.414l0.677-1.255l0.29-4.344l2.22-3.862l0.099-1.736
    l-0.869-2.801l-1.158-1.737l-2.221-1.063l-6.372-0.29l-3.767,0.483l-1.158-0.483l-1.352-4.149l0,0v-0.001l1.544-11.973
    l-0.771-10.231l-1.447-4.731l-2.703-10.33l-24.813,2.607l-5.984-2.703l-3.401-5.669c-0.076,2.131-6.139,6.815-7.602,11.687
    c-1.932,6.438,2.573,8.688,10.94,11.907c8.367,3.218,1.932,17.377-6.114,18.343c-8.045,0.967-7.079,1.609-15.77,4.186
    c-8.688,2.574-33.469,2.574-42.479,3.54c-9.012,0.965-5.471,16.091-12.551,19.63c-7.081,3.54-20.596,3.54-32.503,3.862
    c-11.905,0.32-12.873,5.793-6.758,8.688c6.115,2.896,9.332,1.931,12.551,18.987c3.22,17.056-10.299,8.045-24.779,2.896
    c-14.48-5.147-20.918,9.333-27.354,7.402s-9.978,4.827-18.343-1.288c-8.366-6.114-8.69-11.907-6.115-24.779
    c2.575-12.873-1.608-10.619-11.907-20.272c-10.297-9.655-7.401-19.631-5.793-29.931c1.609-10.298-8.688-9.011-7.081-15.769
    c1.608-6.758-4.504-8.045-10.939-0.965c-6.438,7.08-18.185,6.273-18.185,6.273c-13.033-0.966-13.262,13.999-13.262,13.999
    l1.063,4.248l0.098,4.827l0,0v0.001l-2.317,10.426l-0.29,2.512l1.063,4.439v0.001v2.896l0,0l-1.544,5.793l-2.317,2.799l-1.063,2.51
    l0.579,2.799l0.192,4.249l-0.29,4.538l-1.737,7.146l-0.192,8.593l-1.932,16.412v2.315l1.255,8.785l-0.097,8.979l0.193,1.931
    l7.723,8.496l2.896,2.51l0.29,6.181l3.765,0.966l0.772,2.124l-0.386,2.124l0.965,2.414l-0.868,3.281l-0.387,3.282l0.578,0.389
    l-2.025,3.859l-0.58,8.109l-1.544,3.09l-1.932,3.187l-2.611,2.414l-17.86,14.868l-2.703,7.047l-0.869,5.021l0.58,3.38l2.125,10.619
    v2.703l-4.729,1.255l-11.585,1.063l-3.379,1.352l-6.275,4.15l-3.669,1.159l-5.31-1.063l-8.399-7.627l-4.731-2.8l-18.632-8.014
    l-6.854-4.634l2.994,8.979l0.385,1.834l-0.193,4.634l-10.813,28.191l0.579,2.026l8.593,11.008l5.985-0.388l3.476-1.063l2.703-0.191
    l2.22,1.063l12.357,18.535l2.605,2.994l1.353,2.22l0.867,2.896l1.257,2.414l2.125,1.063l1.255,1.063l-1.933,2.219l-4.149,3.092
    l-0.098,3.28l1.353,2.896l3.379-4.924l6.082,0.677l6.373,3.477l4.149,3.86l1.837,4.635l3.956,18.729l-2.701-1.254l-1.545-2.029
    h-1.546l-0.191,7.241l3.09,8.593l5.214,6.18l6.274-0.191l0,0h0.001l-2.414,3.57l-4.152,4.056l-1.738,3.379l11.104,2.994l0.481,3.958
    l-0.676,4.633l3.089,4.058l2.607,0.287l3.572-2.798l2.414-0.581l2.991,1.159l1.159,2.124l-0.676,2.025l-2.607,0.869l-1.351,0.967
    l-3.186,4.635l-1.547,3.186l-2.124-0.771l-4.149-3.477l-0.193,2.511l0.388,2.122l1.544,3.092l1.737,1.544l3.571,0.676l1.641,0.966
    l2.028,3.091l5.117,10.908l3.282,3.958l6.758,6.179l2.704,3.767l0.965,2.124l1.158,4.15l0.869,1.545l1.157,0.966l4.44,2.222
    l4.249,4.827l1.544,1.448l8.593,4.537h0.001h-0.001l7.436-1.257l3.57-0.771l1.353-0.721l1.544-0.824l2.51-2.606l2.415-2.511
    l3.753-5.214l1.459-2.026l2.896-6.273l0.23-0.291l0.927-1.157l4.057-3.861l1.735-2.704l3.478-3.57l3.958-2.123l1.545-4.248
    l1.931-3.477l10.233-1.932l2.315,0.386l1.738,0.771l1.255,1.739l0.678,1.832l0.481,5.696l1.159,3.767l4.054,4.923l2.993,2.125
    l2.414,0.966l3.09-0.387l2.027-1.448l2.315-3.767l1.544-1.447l1.837-3.669l-0.099-3.958l-1.738-1.158l-3.186,0.482l-2.028-0.387
    h0.001h-0.001l1.835-3.671l2.317-1.544l3.088-1.254l6.758,1.544l4.731,3.668l2.8,2.704l5.504,2.604l3.571-2.123l1.46-2.223
    l0.76-1.156l-0.189-1.448l0.965-3.766l2.604-1.063l7.82,0.289l3.958-0.965l2.896-1.545l2.317-2.221l2.316-3.188h1.446v1.547
    l-2.025,1.642l-0.966,2.221l0.481,1.833l2.51,0.678l1.354-1.353l5.6-8.109l0.772-5.406l-0.869-13.42l-1.063-4.439l1.934,2.026
    l2.413,3.573l-0.677-8.015l-0.966-3.767l-6.083-9.363l-1.735-1.448l-13.612-1.544l-3.283-1.16l-5.792-2.896l-6.564-1.447
    l-1.836-2.221l-1.353-2.801l-1.931-2.802l-3.283-2.704l-27.032-16.41l-1.931-2.512l0.191-2.604l7.146,4.729l7.916,2.896
    l40.839,8.012l6.95,2.992l0.387-3.571l1.354-4.054l1.641-3.283l1.642-1.352l0.678-2.511l-0.482-20.37l-1.738-1.834l-7.724-0.291
    l-3.475-0.578l-3.38-1.354l-2.993-2.315l-1.643-3.478l5.312,3.38l2.704,0.966l3.475,0.291l3.283-0.291l2.51-0.966l1.063-1.932
    l-1.157-3.185l7.627-3.188l3.476-0.387l1.644,2.222l1.157-0.387l1.643,0.387l-5.214,2.413l-3.379,5.311l-0.868,6.469l3.186,8.979
    l0.967,0.771l2.991-2.027l5.312-1.736l3.959-2.414l2.314,0.289l3.669,2.125l1.448-4.729l-3.765-2.992l-1.835-2.125l0.579-0.966
    l5.021,0.097l1.833-2.8L-576.638,726.007z"></path>
                                </a>
                                <g class="dhaka-dev">
                                    <path fill="#231F20" d="M-740.959,648.055v37.748c1.223,2.447,2.961,3.669,5.214,3.669c3.218,0,6.531-1.963,9.943-5.889
    c3.089-3.669,4.827-7.369,5.213-11.103l-1.834,0.191c-0.837-0.063-1.674-0.256-2.51-0.579c-0.837-0.32-1.578-0.771-2.22-1.352
    c-0.646-0.579-1.175-1.255-1.593-2.027c-0.419-0.771-0.627-1.607-0.627-2.51c0-1.994,0.627-3.701,1.883-5.117
    c1.255-1.415,2.911-2.124,4.972-2.124c3.089,0,5.631,1.513,7.627,4.538c0.708,1.158,1.271,2.526,1.689,4.104
    c0.418,1.577,0.628,3.171,0.628,4.778c0,5.344-2.222,10.619-6.662,15.833c-4.506,5.536-9.398,8.304-14.675,8.304
    c-3.412,0-6.147-1.063-8.206-3.187c-2.062-2.124-3.413-5.117-4.056-8.979v-36.301h-8.013l-5.213-5.405h48.176l5.503,5.405
    L-740.959,648.055L-740.959,648.055z"></path>
                                    <path fill="#231F20" d="M-695.873,648.055v56.479l-5.214-5.406v-40.064c0-1.674-0.322-3.188-0.965-4.538
    c-0.644-1.353-1.529-2.493-2.654-3.428c-1.128-0.933-2.414-1.673-3.862-2.221c-1.448-0.546-2.945-0.82-4.489-0.82l-5.407-5.405
    h6.18c3.282,0,5.824,0.724,7.627,2.172c1.801,1.447,3.25,3.847,4.345,7.191c0-1.094-0.033-2.444-0.097-4.055
    c-0.065-1.608-0.193-3.508-0.387-5.696c-0.129-2.124-0.226-3.974-0.29-5.551s-0.097-2.912-0.097-4.007l1.931,1.642
    c0.644,3.861,1.771,6.629,3.38,8.304h3.861l5.311,5.405L-695.873,648.055L-695.873,648.055z"></path>
                                    <path fill="#231F20"
                                        d="M-649.436,648.055v3.958c6.308,0,11.393,2.575,15.255,7.725c3.668,4.634,5.502,9.719,5.502,15.254
    c0,1.352-0.227,2.64-0.676,3.86c-0.451,1.225-1.063,2.304-1.834,3.234c-0.772,0.935-1.706,1.675-2.8,2.221
    c-1.095,0.549-2.285,0.82-3.572,0.82c-0.901,0-1.771-0.176-2.606-0.53c-0.838-0.354-1.594-0.82-2.27-1.399
    s-1.223-1.271-1.641-2.075c-0.42-0.805-0.627-1.689-0.627-2.655c0-1.738,0.609-3.186,1.834-4.345
    c1.222-1.158,2.733-1.737,4.536-1.737c1.095,0,2.076,0.258,2.945,0.772c0.869,0.516,1.656,1.223,2.365,2.124l0.481-1.256
    c0-3.731-1.48-7.079-4.44-10.04c-2.896-3.153-7.08-4.697-12.551-4.636v45.088c-0.387-0.063-0.771-0.209-1.158-0.436
    c-0.387-0.225-0.646-0.498-0.772-0.821c-1.288-3.151-2.815-6.097-4.585-8.833c-1.771-2.734-3.718-5.165-5.842-7.289
    c-4.892-4.891-10.363-7.689-16.412-8.398l-7.627-9.462c9.203-7.272,19.662-12.808,31.377-16.605v-4.537h-35.143l-5.503-5.405
    h68.353l5.601,5.405L-649.436,648.055L-649.436,648.055z M-654.844,660.026c-3.281,1.223-6.564,2.751-9.848,4.585
    c-3.282,1.835-6.758,4.04-10.427,6.612c9.01,3.8,15.704,9.816,20.082,18.055h0.191L-654.844,660.026L-654.844,660.026z">
                                    </path>
                                    <path fill="#231F20" d="M-610.529,648.055v56.479l-5.214-5.406v-40.064c0-1.674-0.323-3.188-0.966-4.538
    c-0.645-1.353-1.529-2.493-2.654-3.428c-1.127-0.933-2.414-1.673-3.861-2.221c-1.449-0.546-2.945-0.82-4.49-0.82l-5.405-5.405
    h6.179c3.282,0,5.825,0.724,7.627,2.172c1.802,1.447,3.249,3.847,4.345,7.191c0-1.094-0.033-2.444-0.097-4.055
    c-0.065-1.608-0.192-3.508-0.386-5.696c-0.13-2.124-0.228-3.974-0.29-5.551c-0.065-1.577-0.098-2.912-0.098-4.007l1.933,1.642
    c0.643,3.861,1.77,6.629,3.379,8.304h3.861l5.311,5.405L-610.529,648.055L-610.529,648.055z"></path>
                                </g>
                            </g>
                            <g id="Khulna">
                                <a href="{{ url('/sub-category/khulna') }}"
                                    xlink:href="{{ url('/sub-category/khulna') }}">
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-740.763,967.078 -740.763,967.076
-740.763,967.076 -739.991,963.505 -738.156,959.451 -737.676,956.072 -737.771,953.271 -739.412,948.349 -740.669,947.19
-744.049,944.679 -746.363,937.825 -747.811,935.894 -750.032,933.867 -750.131,932.901 -750.131,932.901 -750.131,932.901
-747.811,931.936 -745.784,932.707 -744.338,932.128 -744.143,928.943 -745.205,927.301 -747.039,926.723 -752.255,926.144
-753.604,925.469 -753.604,925.467 -753.604,924.309 -753.604,924.309 -752.091,922.474 -751.77,922.089 -751.77,922.089
-751.769,922.087 -745.398,917.841 -744.338,915.91 -745.302,914.849 -747.136,913.785 -748.006,911.758 -748.006,911.758
-748.006,910.117 -747.232,908.475 -744.143,906.835 -744.073,906.518 -743.759,905.096 -745.108,903.746 -745.205,902.394
-743.759,899.689 -743.758,899.689 -743.758,899.689 -742.503,899.111 -740.379,899.207 -739.8,898.743 -737.482,896.89
-741.344,890.035 -744.432,887.14 -753.025,882.604 -754.569,881.154 -758.818,876.327 -763.26,874.105 -764.419,873.141
-765.286,871.596 -766.445,867.444 -767.41,865.32 -770.114,861.555 -776.871,855.376 -780.153,851.418 -785.271,840.51
-787.3,837.419 -788.939,836.454 -792.511,835.778 -794.249,834.234 -795.796,831.144 -796.18,829.021 -795.987,826.511
-791.838,829.986 -789.714,830.757 -788.169,827.572 -784.981,822.938 -783.632,821.972 -781.023,821.104 -780.346,819.076
-781.507,816.952 -784.498,815.793 -786.911,816.374 -790.484,819.172 -793.093,818.884 -796.18,814.827 -795.506,810.194
-795.987,806.236 -807.092,803.242 -805.352,799.863 -801.2,795.809 -798.787,792.237 -805.061,792.43 -805.061,792.43
-805.062,792.43 -810.275,786.251 -813.365,777.658 -813.174,770.417 -811.629,770.417 -810.082,772.446 -807.381,773.7
-811.34,754.971 -813.174,750.337 -817.323,746.476 -823.695,743 -829.777,742.323 -833.156,747.247 -834.51,744.351
-834.411,741.069 -830.26,737.979 -828.329,735.76 -829.586,734.696 -831.71,733.635 -832.965,731.221 -833.832,728.324
-835.183,726.105 -837.79,723.11 -850.148,704.575 -852.368,703.514 -855.071,703.706 -858.547,704.768 -864.532,705.154
-864.532,705.154 -864.533,705.154 -873.125,694.146 -873.705,692.121 -862.892,663.93 -862.698,659.296 -863.085,657.461
-866.077,648.483 -871.002,646.359 -871.949,646.148 -876.215,645.201 -881.814,644.718 -899.095,646.552 -904.791,645.49
-909.329,643.366 -913.77,640.47 -921.783,633.519 -923.81,631.105 -924.39,629.078 -924.39,629.078 -924.39,629.077
-923.425,624.057 -923.425,621.644 -924.293,619.617 -928.542,614.21 -930.375,608.514 -938.003,601.176 -942.83,594.709
-944.471,593.356 -948.236,591.426 -952.388,591.136 -954.511,593.936 -957.311,595.866 -970.731,602.239 -974.593,603.107
-978.647,602.432 -980.289,601.563 -983.378,599.343 -988.399,596.64 -989.75,595.481 -993.032,590.46 -993.998,586.985
-993.998,586.985 -993.998,586.984 -997.281,588.528 -1001.915,590.266 -1003.942,592.294 -1005.197,595.093 -1005.101,597.314
-1004.135,601.949 -1004.425,604.651 -1005.679,609.383 -1005.97,611.506 -1005.005,614.113 -1001.046,617.492 -1000.369,620.388
-995.35,621.547 -995.253,623.767 -997.667,626.953 -1000.274,631.395 -998.825,634.098 -997.571,638.442 -996.99,643.365
-997.667,647.42 -999.695,650.027 -1007.611,657.847 -1010.41,660.068 -1014.368,660.938 -1018.713,660.551 -1022.768,660.743
-1026.147,663.35 -1026.823,665.57 -1026.147,669.723 -1026.147,671.75 -1027.21,674.356 -1030.298,679.279 -1031.264,681.693
-1031.361,683.818 -1029.816,687.293 -1029.526,689.417 -1033.968,710.174 -1033.581,712.684 -1031.65,713.648 -1029.526,714.132
-1028.465,715.001 -1028.85,717.801 -1029.526,719.539 -1029.43,721.084 -1027.402,723.303 -1025.279,724.172 -1021.127,723.689
-1019.486,724.076 -1016.396,727.455 -1011.472,736.338 -1007.997,740.104 -1001.915,744.351 -999.597,745.412 -996.508,751.495
-993.902,750.529 -991.489,746.668 -988.784,744.545 -985.985,746.86 -986.468,751.688 -996.605,778.72 -1001.625,786.83
-1003.556,791.271 -1003.363,796.195 -1001.335,800.54 -998.536,803.05 -984.826,807.49 -982.606,807.587 -980.965,806.718
-977.779,804.208 -974.979,803.821 -971.504,804.498 -956.925,809.613 -953.257,810.966 -947.561,810.773 -946.402,811.835
-946.402,813.67 -947.464,816.083 -949.299,818.206 -954.898,822.938 -966.194,835.006 -969.09,840.702 -969.573,852.384
-971.504,858.852 -971.697,863.292 -970.827,865.804 -966.87,870.823 -964.648,874.395 -960.208,885.014 -957.794,888.009
-952.002,889.939 -949.588,892.159 -949.105,895.249 -949.492,899.594 -950.264,904.034 -951.229,907.027 -953.449,910.502
-955.767,913.398 -957.215,916.489 -956.733,920.543 -954.222,927.108 -953.449,930.005 -952.677,935.024 -950.071,939.756
-948.044,945.548 -947.174,951.63 -948.429,956.843 -953.063,960.03 -946.595,962.54 -944.085,964.566 -942.251,972.869
-938.389,981.849 -937.52,987.063 -937.906,988.896 -939.644,991.89 -940.223,994.207 -940.223,996.33 -937.713,1008.398
-936.554,1011.102 -933.176,1017.087 -936.168,1019.21 -934.141,1023.941 -925.065,1035.913 -923.328,1039.679 -922.169,1044.119
-921.783,1049.525 -925.452,1054.354 -924.776,1058.505 -926.031,1068.834 -925.065,1072.407 -920.431,1078.779 -918.983,1083.51
-919.08,1088.722 -921.301,1098.184 -921.783,1102.818 -921.397,1106.582 -916.184,1124.926 -915.315,1126.374 -913.191,1128.209
-908.557,1130.622 -905.854,1131.396 -904.599,1130.43 -903.73,1128.403 -901.702,1126.182 -899.772,1124.926 -898.902,1125.892
-898.516,1130.43 -892.048,1148.773 -892.434,1151.283 -894.654,1153.021 -895.427,1157.075 -894.171,1161.229 -890.214,1163.543
-886.158,1163.061 -882.007,1161.229 -878.435,1158.62 -876.021,1155.82 -880.365,1153.696 -880.946,1151.188 -877.469,1143.463
-876.601,1137.961 -878.724,1129.174 -878.822,1123.479 -877.469,1123.479 -876.311,1126.472 -875.249,1126.376 -874.187,1124.541
-870.808,1116.238 -869.456,1113.921 -867.332,1111.218 -863.857,1107.646 -863.085,1105.619 -863.085,1102.046 -863.953,1098.86
-865.305,1096.061 -865.884,1093.164 -864.629,1089.785 -863.085,1089.785 -862.119,1093.646 -858.258,1101.177 -857.388,1105.715
-857.871,1111.025 -860.671,1117.879 -861.733,1121.934 -862.409,1132.07 -862.119,1137.863 -860.961,1141.242 -855.651,1147.229
-853.333,1147.035 -845.707,1140.471 -842.907,1136.896 -840.882,1132.649 -840.108,1127.533 -840.687,1122.029 -841.363,1118.362
-841.171,1115.175 -838.853,1111.218 -836.052,1108.611 -833.349,1106.582 -831.131,1103.977 -829.198,1092.005 -829.586,1090.46
-831.131,1088.434 -833.639,1082.931 -834.411,1080.419 -835.763,1078.104 -835.474,1075.786 -832.965,1075.304 -831.902,1074.242
-830.164,1068.546 -829.97,1065.263 -831.131,1062.753 -832.385,1060.822 -833.446,1058.021 -834.411,1053.387 -836.149,1054.354
-837.114,1057.249 -837.307,1060.436 -838.853,1060.436 -840.593,1031.955 -838.853,1017.087 -837.307,1017.087 -835.281,1021.914
-834.991,1026.451 -835.956,1036.492 -835.474,1041.127 -826.011,1063.524 -826.205,1066.421 -828.329,1071.151 -828.908,1073.469
-828.618,1083.51 -826.977,1086.985 -823.019,1084.862 -822.054,1081.579 -820.316,1067.29 -819.835,1065.068 -817.711,1060.724
-817.226,1058.021 -817.323,1052.904 -818.966,1047.98 -823.309,1040.258 -823.504,1037.265 -821.09,1033.307 -817.033,1030.217
-815.779,1028.286 -817.711,1023.072 -816.937,1021.045 -814.524,1018.631 -811.629,1012.454 -809.697,1009.558 -807.381,1007.819
-809.407,1011.777 -810.76,1016.218 -811.434,1020.854 -811.723,1025.68 -813.365,1029.445 -819.736,1037.844 -819.64,1041.03
-816.842,1044.313 -814.234,1048.561 -812.399,1053.291 -811.723,1058.021 -812.786,1062.945 -817.805,1071.925 -818.966,1076.462
-820.51,1089.591 -819.64,1105.813 -820.316,1109.577 -821.96,1113.052 -825.819,1117.589 -827.463,1120.485 -828.04,1125.604
-825.722,1134.87 -826.012,1138.828 -820.123,1147.904 -815.682,1150.704 -811.723,1146.65 -812.11,1144.719 -814.427,1138.732
-813.847,1137.479 -808.731,1136.513 -806.413,1136.513 -803.807,1138.153 -798.69,1139.506 -794.153,1136.318 -791.932,1131.878
-793.766,1129.657 -797.92,1127.533 -802.552,1122.514 -806.607,1116.914 -809.02,1112.762 -803.134,1100.405 -800.138,1104.653
-799.755,1106.873 -801.973,1110.734 -801.878,1113.244 -800.138,1117.396 -797.63,1119.424 -794.056,1120.872 -790.194,1121.741
-786.719,1121.934 -784.112,1120.775 -780.927,1118.652 -778.32,1117.976 -777.259,1121.162 -776.294,1122.32 -774.071,1121.934
-770.212,1120.485 -768.279,1119.327 -765.964,1115.854 -760.652,1111.025 -756.017,1110.155 -754.473,1109.577 -753.025,1106.004
-754.183,1103.107 -756.213,1100.598 -757.948,1096.253 -760.748,1091.813 -761.617,1089.785 -761.617,1087.372 -760.555,1083.317
-760.362,1081.192 -761.231,1075.883 -763.741,1072.407 -767.41,1069.994 -771.851,1068.063 -771.851,1066.423 -767.893,1066.423
-764.61,1067.29 -761.617,1067.677 -758.141,1065.745 -756.404,1062.85 -755.728,1058.987 -756.017,1051.168 -758.431,1036.011
-760.652,1027.997 -763.162,1023.267 -754.473,1006.467 -753.701,1001.64 -754.473,997.778 -755.634,993.916 -756.017,989.188
-749.742,994.207 -746.173,995.269 -744.529,991.697 -743.37,988.124 -740.474,984.456 -733.812,977.602 -735.552,972.389
-736.613,970.746 -739.895,969.009 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-913.866,1132.747 -918.694,1129.947
-921.108,1123.285 -923.135,1108.225 -923.907,1105.04 -925.162,1102.626 -926.031,1102.046 -928.542,1102.145 -928.735,1104.267
-927.383,1108.225 -926.804,1111.7 -924.776,1119.135 -924.68,1123.479 -926.031,1127.729 -927.287,1129.078 -927.287,1130.043
-916.667,1142.692 -910.391,1146.071 -907.881,1142.111 -909.039,1135.934 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-907.881,1142.113 -907.881,1142.111
-907.881,1142.111 	"></polygon>
                                </a>
                                <g class="khulna-dev">
                                    <path fill="#231F20"
                                        d="M-880.583,894.838h-5.459v36.522c-0.461-0.417-0.879-0.909-1.255-1.476
    c-0.376-0.563-0.669-1.118-0.878-1.663c-0.336-0.836-0.639-1.589-0.91-2.259c-0.273-0.669-0.472-1.106-0.597-1.316
    c-0.837-1.465-1.842-2.763-3.012-3.892c-1.172-1.13-2.532-2.154-4.079-3.075h0.063c-2.804-1.673-5.898-2.677-9.287-3.013
    l-5.962-7.279c0.46,0.085,0.931,0.157,1.412,0.221c0.479,0.063,0.973,0.095,1.475,0.095c1.171,0,2.416-0.157,3.734-0.471
    c1.317-0.314,2.646-0.765,3.984-1.351c1.632-0.711,2.896-1.495,3.796-2.354c0.899-0.856,1.351-1.768,1.351-2.729
    c0-1.506-0.607-2.782-1.82-3.828c-3.85,3.851-7.698,5.773-11.547,5.773c-1.423,0-2.657-0.46-3.703-1.381
    c-1.046-0.919-1.569-2.07-1.569-3.451c0-1.004,0.366-1.903,1.099-2.698c0.73-0.794,1.621-1.192,2.667-1.192
    c2.133,0,3.263,1.089,3.389,3.264c0.71-0.125,1.432-0.386,2.165-0.784c0.732-0.396,1.475-0.888,2.229-1.475
    c0.083-0.041,0.471-0.408,1.16-1.099c0.69-0.689,1.433-1.412,2.229-2.165c1.338,1.129,2.426,2.07,3.263,2.823
    c0.836,0.753,1.359,1.234,1.569,1.443c1.673,1.8,2.51,3.661,2.51,5.585c0,2.051-0.816,4.017-2.448,5.898
    c-1.631,1.8-3.514,2.991-5.646,3.577c5.104,2.552,8.806,5.857,11.106,9.915h0.125v-36.209l1.945,1.255
    c0,0.712,0.041,1.423,0.125,2.134c0.083,0.712,0.167,1.192,0.251,1.443c0.46,1.004,1.443,1.568,2.949,1.694L-880.583,894.838z"></path>
                                    <path fill="#231F20" d="M-878.512,942.907c-0.627-0.837-1.317-1.686-2.07-2.541c-0.753-0.858-1.538-1.674-2.354-2.447
    c-0.814-0.775-1.631-1.486-2.446-2.134c-0.816-0.649-1.579-1.184-2.291-1.602c-1.841,2.595-4.226,3.995-7.154,4.205
    c-1.798,0-3.389-0.48-4.771-1.442c-1.338-1.005-2.008-2.322-2.008-3.954c0-0.837,0.178-1.601,0.533-2.29
    c0.356-0.69,0.827-1.287,1.412-1.789c0.586-0.502,1.266-0.888,2.04-1.16c0.773-0.271,1.58-0.408,2.416-0.408
    c1.339,0,3.054,0.627,5.146,1.884c0.293-0.629,0.389-1.538,0.283-2.73c-0.104-1.192-0.24-2.248-0.408-3.169l3.515,2.009
    c0.21,1.004,0.304,1.967,0.282,2.886c-0.021,0.921-0.072,1.884-0.156,2.888c0.921,0.795,1.873,1.684,2.854,2.667
    c0.983,0.982,1.895,1.956,2.73,2.919c0.711,0.836,1.224,1.495,1.537,1.977c0.313,0.48,0.616,0.974,0.909,1.476L-878.512,942.907
    L-878.512,942.907z M-894.451,930.671c-2.342,0.042-3.555,0.753-3.64,2.133c0,1.088,0.586,1.736,1.757,1.945
    c1.004,0.126,2.05-0.063,3.138-0.564c0.963-0.627,1.611-1.275,1.945-1.944c-0.417-0.461-0.889-0.806-1.412-1.035
    C-893.186,930.975-893.781,930.796-894.451,930.671z"></path>
                                    <path fill="#231F20" d="M-849.71,894.838v37.088l-3.64-3.389v-20.081c0-1.256-0.449-2.354-1.35-3.295
    c-0.9-0.941-1.978-1.412-3.231-1.412c-2.008,0-3.012,1.214-3.012,3.64c0,0.545,0.104,1.277,0.313,2.196l-1.443,0.565
    c-0.335-1.883-1.276-3.432-2.824-4.646c-1.506-1.213-3.263-1.818-5.271-1.818c-0.878,0-1.716,0.179-2.511,0.532
    c-0.795,0.356-1.496,0.827-2.103,1.412c-0.607,0.586-1.088,1.286-1.443,2.104c-0.355,0.814-0.532,1.663-0.532,2.541
    c0,2.846,1.693,4.519,5.083,5.021c-0.753-1.13-1.13-2.111-1.13-2.948c0-1.005,0.408-1.894,1.225-2.668
    c0.815-0.772,1.726-1.16,2.729-1.16c3.222,0.21,4.832,1.944,4.832,5.208c-0.042,1.381-0.544,2.511-1.506,3.389
    c-0.963,0.879-2.364,1.381-4.205,1.507c-1.506,0-2.887-0.24-4.142-0.722c-1.255-0.48-2.333-1.161-3.232-2.04
    c-0.899-0.878-1.6-1.936-2.102-3.169s-0.753-2.604-0.753-4.11c0-2.426,0.669-4.664,2.008-6.715
    c1.506-2.259,3.43-3.389,5.773-3.389c3.012,0,5.71,1.549,8.095,4.645c0-1.088,0.479-2.092,1.442-3.013
    c0.963-0.962,1.925-1.443,2.888-1.443c2.928,0,5.104,1.945,6.525,5.836v-9.664h-28.74l-3.641-3.514h38.844l3.577,3.514
    L-849.71,894.838L-849.71,894.838z"></path>
                                    <path fill="#231F20" d="M-816.638,894.838v37.778l-2.761-1.758l0.251-3.702c0.042-3.975-0.878-8.116-2.761-12.425
    c-2.804-4.896-6.066-7.344-9.79-7.344c-0.46,0.042-0.795,0.147-1.004,0.314c1.547,2.05,2.321,3.535,2.321,4.455
    c0,1.506-0.438,2.771-1.317,3.797c-0.878,1.025-2.05,1.537-3.515,1.537c-4.518,0-6.776-2.196-6.776-6.589
    c0-2.386,0.836-4.352,2.51-5.899c1.798-1.589,3.849-2.384,6.15-2.384c4.936,0,9.287,3.891,13.053,11.672h0.125v-19.454h-24.726
    l-3.45-3.514h34.2l3.641,3.514L-816.638,894.838L-816.638,894.838z"></path>
                                    <path fill="#231F20" d="M-803.587,894.838v36.711l-3.389-3.514v-26.043c0-1.088-0.209-2.071-0.627-2.949
    c-0.418-0.879-0.994-1.621-1.726-2.229c-0.732-0.605-1.569-1.087-2.511-1.442c-0.94-0.355-1.914-0.534-2.918-0.534l-3.514-3.514
    h4.016c2.135,0,3.786,0.471,4.958,1.412c1.171,0.939,2.112,2.5,2.824,4.675c0-0.711-0.021-1.59-0.063-2.636
    c-0.042-1.045-0.125-2.279-0.251-3.702c-0.084-1.381-0.147-2.583-0.188-3.608c-0.042-1.023-0.063-1.893-0.063-2.604l1.255,1.065
    c0.418,2.512,1.149,4.311,2.195,5.397h2.511l3.452,3.514H-803.587z"></path>
                                </g>
                            </g>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-858.547,704.768 -864.532,705.154
-864.532,705.154 "></polygon>
                            <rect x="-801.926" y="789.195" fill="#0E660C" stroke="#9B9B9B" stroke-width="2"
                                stroke-miterlimit="10" width="0" height="6.275"></rect>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-635.722,846.591 -635.724,846.591
-635.724,846.591 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-623.076,842.15 -626.455,843.502
-634.469,843.502 -633.406,846.785 -631.671,856.053 -629.931,854.991 -625.2,849.198 -622.014,846.012 -621.725,844.371 ">
                            </polygon>
                            <g id="Barishal">
                                <a href="{{ url('/sub-category/barishal') }}"
                                    xlink:href="{{ url('/sub-category/barishal') }}">
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-605.798,1091.138 -605.798,1086.502
-619.797,1096.157 -621.532,1098.86 -622.111,1101.179 -621.725,1105.04 -623.076,1106.488 -621.532,1107.55 -618.732,1111.218
-620.373,1111.508 -624.524,1112.764 -624.524,1114.404 -620.856,1114.694 -616.802,1111.411 -613.326,1106.584 -611.59,1102.046
-610.139,1102.046 -608.402,1103.205 -606.375,1098.088 -603.094,1097.316 -604.25,1093.743 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-616.029,1069.607 -623.465,1076.077
-624.524,1078.104 -624.332,1081.192 -623.367,1083.605 -621.242,1084.668 -617.284,1083.51 -612.844,1078.2 -611.01,1070.477
-609.756,1061.884 -607.342,1054.16 -606.181,1056.768 -605.798,1060.436 -601.644,1046.631 -603.478,1046.244 -605.891,1047.597
-608.402,1050.01 -610.139,1052.616 -612.747,1052.52 -618.346,1058.795 -620.953,1060.436 -624.622,1061.884 -627.035,1065.457
-628.29,1070.38 -628.677,1075.689 -627.423,1075.689 -626.262,1073.373 -617.284,1068.063 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-555.496,980.304 -564.67,971.905
-569.594,966.884 -572.198,959.934 -573.743,948.928 -577.025,943.617 -580.307,939.659 -583.302,934.254 -586.873,926.916
-589.479,920.641 -591.799,912.627 -593.923,905.869 -597.975,906.352 -601.644,907.221 -605.219,908.669 -607.437,910.31
-608.885,912.819 -613.519,931.357 -614.004,939.273 -613.036,947.575 -609.657,948.541 -597.881,956.941 -594.5,959.934
-592.183,965.34 -589.675,979.05 -587.356,983.2 -587.356,984.648 -588.224,987.354 -587.742,991.793 -586.1,998.455
-587.356,1002.316 -587.356,1015.543 -588.031,1019.887 -589.094,1023.557 -597.782,1042.575 -599.809,1050.877 -597.492,1055.803
-600.485,1060.726 -602.802,1067.29 -603.674,1073.663 -602.319,1078.104 -599.037,1077.427 -587.355,1060.436 -589.866,1066.615
-593.727,1073.469 -596.237,1079.938 -594.5,1084.862 -592.378,1085.15 -585.328,1081.966 -579.924,1072.6 -577.894,1071.442
-573.164,1066.423 -571.619,1069.607 -567.95,1066.423 -556.943,1049.237 -555.206,1043.444 -555.399,1007.048 -551.248,985.614
">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-650.109,1078.296 -648.76,1072.698
-651.557,1073.276 -654.744,1078.393 -657.447,1084.958 -658.701,1089.785 -657.447,1089.785 -655.998,1085.055 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-652.136,1084.668 -655.711,1088.724
-660.245,1097.316 -662.274,1102.24 -663.142,1107.646 -663.142,1118.073 -662.177,1118.652 -660.245,1117.396 -658.315,1114.887
-653.297,1097.316 -648.082,1088.434 -647.309,1083.51 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-597.492,986.291 -600.294,983.2
-602.802,982.043 -604.154,982.525 -604.636,983.877 -604.154,986.87 -601.549,986.966 -600.294,987.835 -598.94,991.89
-597.396,1000.675 -596.046,1004.73 -597.492,1004.73 -597.106,1011.972 -596.046,1013.998 -594.693,1010.04 -596.046,1001.063
-594.5,997.104 -594.016,998.743 -591.699,1003.379 -592.182,998.068 -594.5,991.793 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-532.035,1035.913 -533.194,1037.361
-534.449,1035.721 -536.186,1040.74 -537.635,1047.498 -537.927,1053.773 -535.802,1057.251 -531.65,1056.188 -530.104,1050.877
-530.104,1038.713 -530.59,1036.688 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-524.602,1025.197 -525.857,1029.638
-525.953,1041.706 -523.54,1039.582 -522.094,1035.431 -521.512,1030.604 -521.706,1026.453 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-618.056,868.796 -612.457,868.699
-610.139,868.409 -608.305,867.638 -606.76,866.382 -604.636,867.06 -602.802,868.508 -600.294,873.044 -598.748,874.783
-596.913,875.554 -590.348,876.327 -591.41,874.105 -593.052,871.982 -595.079,870.052 -595.757,868.604 -590.348,868.409
-590.348,867.06 -594.982,863.486 -602.899,853.64 -607.342,849.874 -612.457,850.356 -619.408,856.053 -623.558,863.294
-620.277,868.409 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-523.057,1020.178 -522.187,1015.543
-522.383,1010.91 -523.253,1006.758 -524.409,1003.379 -525.953,1001.64 -528.078,1005.31 -529.334,1010.813 -530.104,1021.047
-531.359,1024.136 -533.483,1027.997 -534.16,1031.086 -530.879,1032.438 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-590.444,980.208 -590.831,977.794
-591.699,975.381 -593.245,974.607 -594.5,987.835 -593.245,986.387 -590.348,984.648 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-637.944,849.97 -641.516,852.095
-647.019,849.487 -649.819,846.785 -654.552,843.115 -661.308,841.571 -664.397,842.825 -666.716,844.371 -668.55,848.039
-666.521,848.426 -663.337,847.942 -661.597,849.101 -661.5,853.059 -661.5,853.059 -661.5,853.061 -663.337,856.729
-664.882,858.176 -667.197,861.941 -669.224,863.39 -672.314,863.776 -674.727,862.811 -677.72,860.686 -681.775,855.763
-682.933,851.997 -683.416,846.303 -684.094,844.468 -685.347,842.729 -687.087,841.958 -689.402,841.571 -699.635,843.502
-701.566,846.979 -703.112,851.226 -707.07,853.349 -710.548,856.922 -712.283,859.624 -716.34,863.486 -717.265,864.644
-717.496,864.935 -720.392,871.209 -721.853,873.236 -725.606,878.45 -728.021,880.96 -730.53,883.567 -732.074,884.392
-733.427,885.112 -736.998,885.886 -744.431,887.14 -741.344,890.035 -737.481,896.89 -739.8,898.743 -740.38,899.207
-742.503,899.111 -743.758,899.689 -745.204,902.394 -745.108,903.744 -743.758,905.096 -744.073,906.518 -744.143,906.835
-747.232,908.475 -748.006,910.117 -748.006,911.758 -747.135,913.785 -745.302,914.847 -744.338,915.91 -745.398,917.841
-751.77,922.089 -752.091,922.474 -753.604,924.309 -753.604,925.467 -752.254,926.144 -747.039,926.723 -745.204,927.301
-744.143,928.943 -744.338,932.128 -745.784,932.709 -747.811,931.936 -750.131,932.901 -750.031,933.867 -747.811,935.894
-746.363,937.825 -744.048,944.679 -740.666,947.188 -739.411,948.349 -737.77,953.271 -737.676,956.072 -737.676,956.072
-737.676,956.072 -738.156,959.451 -739.991,963.505 -740.763,967.076 -739.894,969.008 -736.613,970.746 -735.552,972.387
-733.812,977.601 -733.136,976.925 -729.95,975.188 -731.205,977.696 -731.977,980.4 -733.136,983.2 -750.321,1008.302
-754.473,1018.631 -755.534,1024.037 -755.245,1026.451 -754.473,1029.348 -753.41,1031.568 -750.707,1035.913 -750.225,1038.036
-749.742,1043.732 -747.811,1053.001 -747.328,1069.607 -746.749,1072.311 -744.915,1077.427 -744.528,1079.648 -743.177,1083.992
-739.991,1087.854 -736.226,1089.206 -733.136,1086.502 -732.654,1083.605 -733.136,1073.469 -731.884,1071.538 -726.282,1066.036
-724.447,1063.524 -721.165,1052.422 -718.558,1048.561 -713.153,1046.629 -714.407,1049.333 -716.34,1050.686 -718.655,1051.747
-720.588,1053.968 -721.358,1057.347 -722.323,1059.855 -721.552,1066.615 -722.133,1070.09 -723.482,1071.635 -725.317,1072.504
-727.247,1074.242 -728.889,1076.944 -729.082,1080.323 -730.339,1083.51 -723.677,1086.212 -721.552,1086.502 -718.558,1086.02
-717.496,1084.958 -716.821,1083.317 -714.117,1079.165 -712.476,1074.338 -711.028,1072.021 -698.573,1058.601 -695.195,1056.574
-689.595,1055.801 -686.602,1053.581 -683.996,1048.464 -680.326,1038.713 -679.652,1044.698 -681.196,1050.781 -684.479,1055.801
-688.823,1058.892 -693.457,1057.152 -695.291,1058.021 -698.962,1063.524 -707.552,1071.346 -709.483,1074.53 -710.642,1080.035
-711.607,1083.51 -713.442,1086.212 -718.269,1089.495 -720.2,1091.138 -722.422,1096.253 -722.999,1108.417 -724.447,1114.404
-721.937,1114.692 -719.235,1117.01 -717.496,1117.396 -715.565,1116.431 -712.961,1113.438 -711.028,1112.762 -709,1110.831
-705.332,1101.659 -704.175,1102.528 -703.21,1105.715 -704.366,1108.417 -706.393,1110.446 -707.649,1112.665 -706.104,1115.854
-709.677,1115.079 -711.028,1117.976 -710.159,1121.645 -706.78,1123.479 -703.112,1124.251 -695.291,1127.533 -691.045,1128.211
-687.087,1127.438 -684.188,1125.41 -672.7,1115.563 -670.576,1112.569 -668.934,1108.225 -667.006,1099.826 -666.038,1091.233
-665.172,1087.081 -661.213,1078.875 -660.245,1074.917 -657.06,1071.056 -653.297,1065.263 -651.556,1060.436 -650.883,1053.485
-650.302,1051.168 -649.529,1050.686 -647.695,1051.36 -647.116,1048.175 -644.413,1044.988 -643.447,1043.444 -643.158,1041.706
-643.93,1039.486 -646.344,1038.038 -648.082,1036.492 -648.469,1033.307 -646.44,1023.267 -647.309,1018.631 -643.834,1019.501
-643.158,1022.301 -644.51,1029.35 -644.026,1032.342 -641.613,1038.713 -642.482,1044.119 -647.505,1054.835 -648.76,1060.436
-647.406,1062.174 -644.413,1064.201 -640.843,1065.745 -638.041,1066.421 -635.724,1065.359 -633.696,1062.85 -627.713,1052.325
-626.455,1048.851 -625.972,1045.762 -625.009,1043.732 -622.885,1041.802 -617.284,1038.713 -613.229,1037.748 -608.305,1029.928
-601.644,1012.646 -600.388,1003.379 -600.582,998.646 -601.644,994.11 -605.798,986.097 -607.244,982.043 -607.342,976.925
-603.094,978.567 -606.567,970.746 -609.077,963.217 -612.844,956.747 -620.277,952.114 -624.235,951.341 -627.903,951.92
-630.993,953.755 -633.117,956.845 -633.506,959.259 -632.926,963.796 -633.117,966.113 -634.084,967.563 -636.785,969.879
-637.365,968.913 -634.952,956.362 -633.795,952.983 -631.862,951.729 -627.035,951.053 -625.2,949.989 -623.176,947.287
-622.594,945.645 -623.465,937.825 -625.972,930.488 -626.746,923.439 -627.423,921.124 -629.642,917.745 -633.31,914.654
-636.885,913.979 -638.814,918.13 -642.868,916.104 -648.76,914.075 -651.847,911.758 -647.309,908.766 -644.801,911.371
-642,910.214 -641.133,907.221 -644.51,904.229 -638.621,902.877 -636.109,896.602 -634.178,889.07 -630.22,884.051
-627.228,883.76 -624.235,884.533 -621.145,884.92 -617.962,883.374 -616.898,881.25 -617.766,879.61 -620.856,876.906
-623.076,876.327 -623.656,874.685 -623.367,872.079 -623.849,870.921 -628.003,865.417 -631.862,858.659 -634.76,851.514
-635.724,846.591 -636.484,847.748 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-640.165,1072.698 -642.868,1074.917
-643.64,1077.042 -643.158,1084.186 -643.64,1088.916 -644.801,1091.716 -646.15,1094.13 -647.309,1097.316 -647.309,1101.179
-645.67,1104.459 -642.868,1105.907 -639.488,1104.267 -634.662,1098.57 -630.22,1095.868 -628.194,1088.724 -630.802,1082.737
">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-615.548,906.738 -612.36,905.579
-606.278,899.884 -598.554,900.367 -591.41,901.815 -588.13,901.138 -591.121,896.505 -594.982,891.87 -598.844,890.132
-603.094,885.595 -606.087,884.533 -614.291,884.533 -616.029,884.822 -617.476,887.912 -620.856,888.396 -628.003,887.14
-630.802,888.299 -632.344,891.388 -632.926,895.346 -633.117,899.498 -632.441,905.773 -632.73,907.8 -634.469,910.406
-628.869,912.145 -626.746,913.593 -625.972,915.91 -625.683,918.033 -622.98,920.543 -620.953,923.055 -618.056,919.193
-619.118,915.62 -618.732,910.021 	">
                                    </polygon>
                                </a>
                                <g class="barishal-dev">
                                    <path fill="#231F20" d="M-709.711,967.242v36.898l-1.944-2.321c-0.125-0.376-0.283-0.764-0.472-1.16
    c-0.188-0.397-0.544-1.1-1.066-2.104c-0.523-1.004-1.266-2.103-2.229-3.295c-0.962-1.191-1.861-2.186-2.697-2.979
    c-3.013-2.763-7.009-4.394-11.986-4.896l-4.581-6.525c7.028-4.896,14.224-8.576,21.587-11.045v-2.573h-24.035l-3.452-3.514h34.703
    l3.39,3.514H-709.711z M-713.099,975.526c-2.259,0.837-4.55,1.841-6.872,3.012c-2.322,1.172-4.76,2.615-7.311,4.33
    c6.316,2.636,11.045,6.651,14.183,12.049V975.526z"></path>
                                    <path fill="#231F20" d="M-667.478,959.461c-1.129-1.004-2.384-1.997-3.765-2.979c-1.38-0.982-2.949-1.955-4.707-2.919
    c-1.59-0.92-3.232-1.59-4.927-2.009c-1.693-0.417-3.44-0.627-5.239-0.627c-2.637,0-5.334,0.921-8.096,2.761
    c-3.054,2.01-4.666,4.247-4.832,6.716l1.382,3.325h3.828l3.576,3.515h-6.149v36.711l-3.577-3.514v-33.197h-5.334l-3.451-3.515
    h9.35l-2.446-2.321c-0.921-0.92-1.381-1.861-1.381-2.824c0-2.844,1.589-5.521,4.77-8.032c3.095-2.342,6.087-3.514,8.974-3.514
    c7.446,0,14.56,3.514,21.336,10.542L-667.478,959.461z"></path>
                                    <path fill="#231F20"
                                        d="M-664.593,967.242v36.898l-1.944-2.321v0.063c-0.67-1.673-1.225-2.896-1.663-3.672
    c-0.439-0.773-1.142-1.757-2.104-2.949c-0.962-1.191-1.861-2.186-2.698-2.979c-3.012-2.763-7.008-4.394-11.985-4.896h0.063
    l-4.644-6.525c7.027-4.896,14.224-8.576,21.587-11.045v-2.573h-24.035l-3.452-3.514h34.577l3.515,3.514H-664.593z
     M-682.853,997.364c0-1.045,0.355-1.914,1.066-2.604c0.711-0.689,1.568-1.035,2.572-1.035s1.861,0.346,2.573,1.035
    c0.711,0.69,1.067,1.561,1.067,2.604c0,0.963-0.356,1.81-1.067,2.541c-0.712,0.732-1.569,1.099-2.573,1.099
    s-1.861-0.365-2.572-1.099C-682.498,999.174-682.853,998.327-682.853,997.364z M-667.98,975.526
    c-2.259,0.837-4.55,1.841-6.872,3.012c-2.322,1.172-4.76,2.615-7.311,4.33c6.316,2.636,11.045,6.651,14.183,12.049V975.526z"></path>
                                    <path fill="#231F20" d="M-626.25,967.242v36.962l-3.642-3.577l0.252-22.528c0-1.464-0.796-3.282-2.385-5.459
    c-1.591-2.092-3.097-3.138-4.519-3.138c-0.922,0-1.811,0.282-2.668,0.847c-0.856,0.565-1.286,1.267-1.286,2.104
    c3.682,2.636,5.522,4.812,5.522,6.525c0,1.507-0.408,2.729-1.225,3.672c-0.815,0.94-1.978,1.579-3.482,1.913
    c-1.172-0.041-2.25-0.429-3.231-1.16c-0.982-0.731-1.705-1.788-2.164-3.169c-1.089,2.929-3.014,4.393-5.773,4.393
    c-1.256,0-2.291-0.512-3.105-1.537c-0.815-1.023-1.225-2.186-1.225-3.482c0-0.837,0.156-1.662,0.472-2.479
    c0.313-0.814,0.753-1.578,1.316-2.29c0.565-0.711,1.225-1.339,1.979-1.883c0.752-0.543,1.547-0.962,2.385-1.255
    c-1.674-2.971-3.641-4.466-5.899-4.487c-2.259-0.021-3.599-0.01-4.017,0.031l-3.514-3.514h7.53c1.842,0,3.577,0.689,5.208,2.069
    c1.633,1.381,2.638,3.056,3.014,5.021c2.134-4.771,5.083-7.154,8.849-7.154c1.296,0,2.99,1.235,5.082,3.703
    c1.924,2.301,3.117,4.184,3.578,5.646h0.188l-0.627-15.563l2.134,2.008c0.377,2.636,1.59,4.06,3.641,4.269l3.514,3.514
    L-626.25,967.242L-626.25,967.242z"></path>
                                    <path fill="#231F20" d="M-613.386,967.242v36.711l-3.389-3.514v-26.043c0-1.089-0.209-2.071-0.627-2.949
    c-0.418-0.879-0.994-1.621-1.727-2.229c-0.731-0.604-1.568-1.087-2.511-1.441c-0.941-0.355-1.914-0.534-2.918-0.534l-3.514-3.514
    h4.016c2.135,0,3.786,0.471,4.958,1.411c1.171,0.94,2.112,2.5,2.823,4.676c0-0.712-0.021-1.591-0.063-2.637
    c-0.041-1.045-0.125-2.278-0.25-3.702c-0.085-1.381-0.146-2.583-0.188-3.607c-0.041-1.024-0.063-1.894-0.063-2.604l1.256,1.066
    c0.419,2.511,1.15,4.31,2.195,5.396h2.511l3.452,3.515H-613.386L-613.386,967.242z"></path>
                                    <path fill="#231F20" d="M-576.738,967.242v37.088l-3.639-3.389V980.86c0-1.257-0.451-2.354-1.351-3.295
    c-0.899-0.941-1.977-1.412-3.231-1.412c-2.009,0-3.013,1.214-3.013,3.64c0,0.544,0.104,1.277,0.313,2.196l-1.443,0.564
    c-0.335-1.883-1.275-3.431-2.823-4.645c-1.506-1.213-3.264-1.819-5.271-1.819c-0.879,0-1.717,0.18-2.51,0.533
    c-0.797,0.356-1.497,0.827-2.104,1.412c-0.605,0.586-1.088,1.286-1.442,2.103c-0.355,0.815-0.533,1.663-0.533,2.541
    c0,2.847,1.694,4.52,5.084,5.021c-0.754-1.13-1.13-2.112-1.13-2.949c0-1.004,0.406-1.893,1.224-2.667
    c0.816-0.772,1.726-1.161,2.729-1.161c3.223,0.21,4.832,1.945,4.832,5.208c-0.042,1.381-0.544,2.512-1.506,3.39
    c-0.963,0.879-2.363,1.381-4.204,1.507c-1.506,0-2.887-0.24-4.143-0.723c-1.255-0.479-2.332-1.16-3.231-2.039
    c-0.898-0.879-1.601-1.936-2.103-3.17c-0.502-1.232-0.753-2.604-0.753-4.109c0-2.426,0.669-4.664,2.009-6.715
    c1.506-2.26,3.43-3.39,5.773-3.39c3.012,0,5.71,1.55,8.095,4.646c0-1.088,0.479-2.092,1.442-3.014
    c0.962-0.962,1.925-1.442,2.888-1.442c2.928,0,5.104,1.945,6.525,5.836v-9.664h-28.74l-3.641-3.514h38.844l3.578,3.514
    L-576.738,967.242L-576.738,967.242z"></path>
                                </g>
                            </g>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-712.283,859.624 -710.548,856.922
-707.07,853.349 -703.112,851.226 -707.07,853.349 -710.548,856.92 -712.283,859.624 -716.34,863.486 -717.265,864.644
-716.34,863.486 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-721.853,873.236 -725.606,878.45
-728.021,880.96 -725.606,878.45 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-664.397,842.825 -666.716,844.369
-668.551,848.039 -668.55,848.039 -666.716,844.371 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-649.819,846.785 -647.019,849.487
-641.516,852.095 -637.944,849.97 -636.484,847.748 -637.944,849.97 -641.515,852.093 -647.019,849.487 -649.819,846.783
-654.552,843.115 -661.308,841.571 -654.552,843.115 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-667.197,861.941 -664.882,858.176
-663.337,856.729 -661.5,853.061 -661.5,853.059 -663.337,856.729 -664.882,858.176 -667.197,861.941 -669.224,863.39
-672.314,863.776 -669.224,863.39 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-699.635,843.502 -701.566,846.979
-703.112,851.226 -701.566,846.979 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-685.347,842.729 -684.094,844.468
-685.347,842.729 -687.087,841.956 -689.402,841.571 -687.087,841.958 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-682.933,851.997 -683.416,846.301
-684.094,844.468 -683.416,846.303 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-733.427,885.112 -732.074,884.392
-733.427,885.112 -736.998,885.884 -744.432,887.14 -744.431,887.14 -736.998,885.886 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-747.232,908.475 -744.143,906.835
-744.073,906.518 -744.143,906.835 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-739.991,963.505 -738.156,959.451
-737.676,956.072 -737.676,956.072 -738.156,959.451 ">
                            </polygon>
                            <path fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" d="M-740.763,967.076l0.772-3.571L-740.763,967.076z
    "></path>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-742.503,899.111 -743.758,899.689
-743.758,899.689 -742.503,899.111 -740.38,899.207 -739.8,898.743 -740.379,899.207 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-751.77,922.089 -745.398,917.841
-751.769,922.087 "></polygon>
                            <path fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" d="M-753.604,924.309l1.515-1.835L-753.604,924.309z
    "></path>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-747.811,931.936 -750.131,932.901
-750.131,932.901 -747.811,931.936 -745.784,932.709 -744.338,932.128 -745.784,932.707 ">
                            </polygon>
                            <g id="Chittagong">
                                <a href="{{ url('/sub-category/chittagong') }}"
                                    xlink:href="{{ url('/sub-category/chittagong') }}">
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-318.77,1190.48 -318.288,1185.46
-316.357,1176 -315.875,1171.27 -317.805,1162.386 -325.338,1147.615 -326.011,1137.479 -326.011,1132.747 -329.39,1133.713
-333.155,1134.195 -331.611,1139.215 -331.42,1144.911 -332.675,1150.317 -335.955,1154.277 -335.279,1151.188 -333.735,1147.615
-332.769,1144.141 -333.831,1141.244 -336.824,1138.83 -339.14,1138.636 -341.072,1140.663 -343.099,1145.105 -344.26,1153.408
-339.817,1168.372 -338.758,1177.448 -338.851,1182.758 -339.43,1185.073 -342.617,1189.805 -342.715,1191.447 -342.037,1192.991
-341.171,1196.949 -340.01,1198.784 -338.177,1200.038 -335.955,1200.232 -333.445,1198.88 -333.544,1197.142 -334.509,1195.501
-334.509,1194.245 -330.452,1193.666 -325.238,1194.632 -320.604,1194.439 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-483.184,1019.694 -485.308,1011.585
-488.397,1008.688 -490.039,1003.088 -494.577,999.13 -501.817,995.364 -505.389,995.945 -506.644,1013.516 -506.84,1029.35
-508.674,1040.258 -510.12,1044.023 -513.981,1050.01 -519.969,1057.251 -518.715,1060.531 -516.301,1062.174 -513.016,1063.043
-507.803,1063.332 -503.844,1060.726 -501.528,1056.768 -498.825,1056.188 -495.832,1054.16 -491.584,1050.589 -487.529,1042.575
-485.503,1039.1 -482.122,1032.245 -483.09,1024.908 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-339.527,1122.9 -336.633,1117.204
-335.955,1113.631 -336.245,1110.446 -338.757,1102.046 -339.047,1100.213 -340.203,1098.86 -345.129,1104.459 -346.673,1107.355
-347.443,1111.218 -345.899,1122.706 -349.181,1141.34 -347.443,1145.105 -345.706,1142.98 -341.17,1130.721 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-487.915,970.071 -495.255,973.258
-497.28,979.533 -493.032,982.235 -487.722,981.946 -483.474,980.016 -479.132,977.119 -477.102,971.905 -479.323,967.563 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-179.264,1236.436 -186.699,1213.652
-188.921,1202.451 -189.498,1196.757 -192.491,1143.271 -188.921,1108.901 -189.498,1102.145 -192.491,1088.529 -193.07,1084.571
-195.773,1069.703 -200.506,1054.547 -197.994,1052.325 -194.905,1052.424 -192.491,1051.264 -192.202,1045.567 -204.366,971.905
-204.655,968.044 -207.358,960.995 -208.134,957.134 -207.649,944.101 -209.097,926.626 -210.062,923.15 -212.283,919.771
-217.884,914.849 -220.391,911.47 -221.842,904.613 -223.677,886.947 -226.669,883.182 -233.619,880.285 -237.48,874.396
-239.122,866.769 -238.928,851.031 -244.238,818.884 -244.047,809.904 -243.177,806.429 -239.411,798.609 -237.965,794.555
-238.156,792.237 -239.122,790.017 -240.183,786.251 -240.183,783.934 -239.604,779.493 -239.8,777.466 -240.666,776.308
-243.369,774.087 -244.431,772.639 -244.721,771.094 -244.337,767.907 -244.721,766.171 -245.882,764.24 -248.584,761.632
-249.644,759.799 -250.61,756.42 -251.866,745.317 -259.782,719.443 -260.361,711.815 -257.948,702.161 -258.43,697.238
-262.775,694.921 -266.25,696.947 -268.857,707.472 -272.045,710.563 -274.844,706.604 -276.969,697.913 -281.118,691.542
-289.903,694.632 -293.283,698.494 -300.136,707.954 -303.709,711.141 -308.536,712.395 -311.819,710.754 -320.51,700.81
-323.115,696.563 -325.721,693.376 -328.618,693.569 -329.969,696.465 -330.355,701.391 -330.066,710.079 -324.563,736.435
-324.852,745.414 -329.584,753.426 -332.287,756.418 -335.666,758.832 -347.154,763.854 -350.533,766.846 -355.94,774.183
-362.022,784.803 -365.98,796.001 -364.822,805.077 -361.732,812.317 -358.643,827.861 -355.94,834.813 -355.17,837.516
-356.036,839.544 -359.221,843.02 -362.408,842.923 -363.375,843.791 -363.566,846.881 -367.138,852.191 -368.589,853.832
-372.063,857.114 -373.607,858.854 -376.216,860.493 -381.813,861.749 -386.158,863.1 -390.598,861.941 -392.433,862.715
-394.173,866.769 -395.427,868.409 -398.804,870.34 -399.481,869.569 -399.481,867.348 -400.736,864.838 -403.634,863.486
-406.432,862.907 -409.135,861.846 -411.841,858.854 -412.709,856.535 -412.997,849.777 -413.576,849.004 -415.509,848.426
-416.089,847.75 -417.148,841.958 -421.975,825.352 -422.941,823.035 -424.388,815.987 -424.872,815.987 -427.964,812.898
-427.964,808.938 -429.313,807.105 -430.088,808.843 -431.727,805.754 -434.815,801.409 -438.774,798.223 -443.408,798.417
-445.725,801.602 -446.885,806.911 -446.787,817.049 -442.927,836.069 -443.698,843.502 -450.649,841.667 -455.672,834.909
-458.373,825.545 -463.2,788.955 -465.226,784.803 -465.613,783.066 -464.165,780.941 -462.041,778.914 -461.175,777.079
-461.847,775.729 -464.552,775.052 -467.257,773.025 -469.381,768.391 -472.178,758.735 -473.143,753.138 -473.629,751.398
-474.978,749.275 -478.647,747.055 -480.385,745.414 -482.315,741.648 -484.052,734.213 -485.598,730.159 -491.68,718.767
-492.645,714.809 -491.875,709.306 -489.266,709.016 -486.37,709.21 -484.536,705.54 -485.794,702.065 -489.266,700.81
-492.552,698.977 -493.42,694.051 -491.487,689.707 -488.205,688.549 -484.246,688.163 -480.385,686.231 -478.26,682.466
-474.109,670.012 -473.433,665.765 -474.302,662.868 -476.718,657.559 -476.812,654.469 -475.944,651.283 -468.802,638.539
-466.677,635.546 -463.878,633.036 -460.207,631.492 -456.731,632.07 -456.732,632.069 -455.863,626.76 -455.766,624.732
-456.44,623.864 -458.76,620.872 -459.344,618.748 -460.885,613.146 -461.559,607.451 -461.366,604.555 -462.332,600.693
-463.188,598.763 -463.878,597.219 -463.878,597.218 -463.878,597.218 -463.78,593.356 -462.234,591.714 -460.786,591.038
-456.25,590.073 -454.898,589.301 -456.25,588.047 -461.269,586.599 -462.228,585.343 -462.525,584.956 -461.175,583.412
-455.476,579.936 -451.807,576.75 -451.807,575.207 -454.415,574.144 -456.828,574.531 -459.724,575.883 -466.677,581.675
-471.888,580.71 -483.177,574.813 -489.074,571.731 -491.776,573.661 -495.348,574.916 -499.404,575.303 -501.238,576.364
-501.238,578.681 -500.852,581.288 -500.852,581.288 -500.852,581.289 -501.43,583.123 -502.881,583.316 -502.881,583.316
-502.882,583.316 -503.302,583.158 -504.427,582.737 -507.223,580.517 -514.177,590.074 -518.906,591.715 -520.161,592.487
-519.294,596.929 -519.582,597.991 -515.816,603.396 -517.36,606.68 -513.305,609.093 -514.85,613.92 -518.906,618.554
-522.285,620.679 -524.698,622.996 -526.532,628.402 -525.664,632.747 -526.725,638.346 -530.973,647.904 -538.889,658.91
-541.786,661.323 -543.719,662.386 -545.456,661.898 -546.134,661.709 -552.31,657.655 -556.365,659.585 -558.008,659.779
-564.38,659.489 -567.177,660.262 -569.883,662.386 -571.908,665.378 -572.007,667.212 -570.846,672.136 -571.135,675.516
-575.385,686.714 -578.666,691.734 -579.052,693.762 -578.738,694.438 -578.379,695.21 -575.385,697.334 -573.26,699.844
-572.777,701.484 -572.777,701.486 -572.777,701.486 -572.97,703.127 -574.514,706.216 -576.349,708.05 -570.846,713.747
-570.091,714.823 -569.011,716.354 -569.494,717.513 -572.68,717.898 -575.191,719.152 -576.059,721.084 -574.514,723.691
-576.638,726.007 -581.273,729.001 -583.107,731.8 -581.274,733.151 -580.308,736.24 -580.404,744.641 -585.328,747.343
-597.493,747.247 -602.609,750.434 -604.347,755.646 -604.636,768.969 -604.057,773.313 -602.031,780.071 -598.554,784.803
-593.245,782.968 -593.344,784.128 -591.7,784.706 -594.016,786.638 -593.824,789.63 -590.348,797.063 -591.7,797.063
-590.831,801.313 -592.569,805.56 -594.886,809.904 -596.047,814.924 -596.334,824.289 -598.748,838.094 -598.748,840.605
-598.265,843.212 -596.047,849.196 -579.924,871.209 -578.86,874.01 -578.28,879.125 -576.736,882.891 -574.805,886.27
-573.164,890.229 -571.619,897.951 -569.109,904.131 -568.819,906.448 -568.143,907.992 -565.151,912.24 -563.801,916.297
-560.324,918.323 -558.682,919.676 -556.175,927.784 -555.207,929.04 -549.125,928.557 -546.807,929.521 -545.166,935.99
-542.176,940.143 -541.498,942.169 -540.145,944.196 -534.45,948.349 -533.194,951.438 -530.395,953.755 -524.12,954.045
-517.361,952.983 -513.113,950.858 -512.633,946.514 -514.272,939.95 -517.17,933.675 -520.26,930.488 -517.17,929.521
-515.43,931.453 -513.113,938.403 -510.893,942.363 -508.768,945.065 -506.551,954.72 -502.397,960.803 -494.48,964.761
-484.247,962.636 -478.744,961.092 -474.885,957.906 -470.635,953.851 -468.22,945.162 -466.579,941.977 -465.904,939.081
-468.22,934.542 -473.723,932.225 -485.794,929.04 -485.794,927.396 -480.967,927.592 -479.516,925.949 -480.481,923.439
-483.091,921.122 -483.091,919.674 -475.944,919.771 -472.854,920.156 -470.248,921.122 -470.248,925.178 -469.959,926.047
-468.317,925.854 -461.945,927.205 -458.373,927.205 -454.897,926.336 -452.194,924.405 -451.615,921.122 -453.258,919.771
-456.635,918.226 -460.4,916.972 -449.59,916.777 -445.921,915.813 -443.891,913.881 -444.375,911.758 -448.815,910.406
-448.815,908.766 -444.277,908.958 -440.802,909.635 -437.715,911.083 -434.527,913.496 -435.202,908.089 -434.14,903.069
-431.244,899.399 -426.707,897.951 -424.582,895.441 -421.01,883.664 -420.337,879.416 -418.79,879.416 -418.886,884.822
-422.171,894.38 -423.52,900.945 -425.452,903.744 -425.934,906.448 -425.55,909.345 -424.582,911.662 -423.231,912.724
-421.592,911.854 -419.948,915.428 -417.052,919.481 -413.385,922.86 -406.721,925.564 -380.076,963.021 -365.981,990.924
-363.76,999.13 -360.094,1024.906 -356.905,1029.928 -352.368,1030.314 -348.798,1027.61 -348.699,1023.267 -350.632,1021.818
-353.237,1020.854 -355.457,1019.114 -356.036,1015.543 -354.492,1013.321 -349.375,1010.523 -348.699,1009.363 -345.031,1008.109
-341.941,1005.502 -339.527,1002.896 -338.079,1001.64 -338.468,999.903 -336.438,991.214 -335.955,987.835 -331.709,987.835
-336.535,1003.861 -338.758,1007.819 -343.295,1010.232 -348.699,1011.873 -352.368,1014.577 -351.691,1020.178 -350.243,1021.432
-348.023,1022.396 -346.189,1024.328 -345.899,1027.997 -346.964,1030.024 -350.726,1033.886 -351.691,1037.361 -351.5,1042.962
-350.243,1048.464 -348.12,1053.387 -345.899,1057.249 -344.644,1057.249 -344.644,1052.904 -343.099,1050.008 -341.265,1049.623
-340.882,1052.133 -343.099,1051.168 -342.715,1058.987 -337.403,1081.966 -337.403,1090.46 -336.727,1092.487 -333.735,1095.866
-333.156,1098.088 -332.19,1106.969 -331.225,1111.604 -330.066,1114.404 -328.811,1112.377 -327.172,1110.831 -325.239,1109.77
-323.018,1109.577 -323.018,1111.218 -325.818,1112.569 -328.038,1114.308 -328.908,1116.431 -327.266,1118.748 -331.032,1120.68
-333.156,1125.507 -333.544,1130.816 -331.611,1132.747 -324.273,1130.43 -314.619,1129.657 -314.619,1131.203 -319.545,1133.23
-320.801,1136.609 -319.35,1138.443 -315.875,1135.933 -314.619,1137.479 -317.805,1140.471 -320.51,1141.05 -322.344,1142.306
-323.018,1147.325 -322.247,1150.608 -320.316,1153.311 -318.385,1153.601 -317.322,1149.738 -315.875,1149.738 -315.778,1152.345
-316.936,1155.918 -317.515,1159.489 -315.875,1162.097 -312.399,1162.193 -309.985,1159.007 -307.185,1151.283 -306.413,1151.766
-307.765,1156.11 -306.606,1156.593 -305.062,1158.041 -304.677,1159.972 -305.93,1162.097 -305.061,1164.316 -305.64,1165.959
-308.827,1169.723 -307.959,1173.488 -309.888,1176.675 -312.785,1179.377 -314.619,1181.889 -314.619,1186.039 -313.463,1190.77
-311.433,1194.824 -308.827,1197.336 -312.688,1195.888 -316.067,1198.301 -318.577,1202.548 -320.123,1206.507 -321.763,1205.155
-323.018,1205.155 -322.344,1208.823 -320.894,1212.782 -318.868,1216.063 -316.646,1217.319 -314.619,1219.442 -303.133,1240.683
-301.972,1244.931 -301.588,1250.337 -303.323,1264.722 -303.034,1269.453 -301.588,1273.123 -292.318,1284.031 -290.003,1287.604
-286.622,1294.168 -284.594,1297.064 -273.684,1306.332 -272.334,1308.649 -268.76,1323.131 -254.569,1349.198 -249.742,1360.783
-247.039,1363.68 -245.977,1365.224 -244.625,1365.997 -242.887,1364.259 -242.404,1361.845 -243.081,1359.529 -244.529,1356.633
-248.39,1344.95 -248.873,1340.703 -249.841,1338.386 -255.824,1329.214 -258.047,1321.008 -258.913,1311.933 -258.625,1302.665
-257.272,1294.072 -265.768,1286.831 -268.375,1280.073 -273.301,1275.438 -274.844,1272.35 -276.004,1268.392 -274.169,1258.255
-273.88,1253.91 -275.424,1245.026 -275.326,1240.683 -274.264,1236.725 -268.375,1228.326 -265.575,1218.768 -263.26,1214.327
-259.783,1213.845 -253.219,1213.939 -245.302,1204.286 -238.545,1206.604 -235.842,1210.271 -234.97,1213.939 -234.488,1217.706
-233.04,1221.567 -231.302,1223.499 -229.082,1224.656 -224.35,1226.299 -215.469,1227.168 -208.517,1225.72 -203.207,1226.878
-199.152,1235.953 -197.511,1244.931 -196.063,1249.564 -193.552,1252.365 -189.305,1252.075 -184.478,1248.792 -180.426,1244.546
-178.492,1240.973 	">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-423.52,951.341 -427.865,953.658
-432.692,965.146 -431.436,972.389 -427.964,981.365 -421.782,990.441 -415.219,994.11 -405.273,992.951 -403.536,985.422
-404.984,975.768 	">
                                    </polygon>
                                </a>
                                <g class="chittagong-dev">
                                    <path fill="#231F20" d="M-322.196,987.242h-21.649c-0.252,3.474,2.719,6.149,8.91,8.033c6.066,1.925,9.016,4.309,8.849,7.152
    c0,3.475-1.632,7.302-4.896,11.484c-3.389,4.435-6.818,6.651-10.291,6.651c-1.255,0-2.572-0.753-3.953-2.26
    c-1.298-1.59-1.945-3.074-1.945-4.456v-26.606h-5.396l-3.451-3.514h30.247L-322.196,987.242z M-331.734,1002.178
    c-5.564-1.757-9.562-4.727-11.986-8.911v20.521c0,1.381,0.522,2.071,1.568,2.071c1.967,0,4.226-1.527,6.776-4.581
    c2.595-3.055,3.892-5.563,3.892-7.53C-331.484,1002.785-331.568,1002.262-331.734,1002.178z"></path>
                                    <path fill="#231F20" d="M-312.282,987.242v18.826c0,2.553,0.919,3.828,2.761,3.828c2.426,0,4.434-0.586,6.025-1.758
    c1.84-1.381,2.696-3.222,2.571-5.521l-0.063-1.883c-3.013-0.92-4.52-2.321-4.52-4.204c0-1.213,0.407-2.261,1.225-3.139
    c0.815-0.879,1.809-1.317,2.979-1.317c3.725,0,5.586,2.636,5.586,7.907c0,2.385-0.94,5.544-2.823,9.476
    c1.422,2.804,2.133,4.874,2.133,6.213c0,2.636-0.982,4.706-2.949,6.213c-1.757,1.38-4.016,2.07-6.777,2.07
    c-4.435,0-8.198-1.798-11.295-5.396c-2.887-3.305-4.54-7.175-4.958-11.608c0.209,0.125,0.472,0.251,0.784,0.376
    c0.314,0.126,0.597,0.251,0.849,0.377c1.59,3.682,3.522,6.525,5.805,8.534c2.279,2.009,4.675,3.055,7.186,3.138
    c1.463,0.336,3.138,0.105,5.021-0.69c2.552-1.255,3.828-2.571,3.828-3.952c0-1.339-0.732-2.322-2.196-2.949
    c-1.506,1.883-3.891,2.824-7.153,2.824c-5.104-0.084-7.655-4.101-7.655-12.05v-15.313h-7.218l-3.45-3.514h27.233
    c0.293-0.712,0.513-1.244,0.659-1.602c0.146-0.354,0.22-0.596,0.22-0.722c0-1.673-2.594-2.51-7.78-2.51
    c-0.462,0-1.078,0.011-1.853,0.03c-0.774,0.021-1.621,0.073-2.541,0.157l-4.268,0.125c-1.214,0-2.386-0.198-3.515-0.596
    c-1.13-0.397-2.219-0.951-3.264-1.663c-2.26-1.758-3.389-3.786-3.389-6.087c0-1.841,0.563-3.284,1.693-4.33l2.071,1.191
    c-1.047,0.545-1.569,1.778-1.569,3.702c0,1.297,2.028,2.094,6.087,2.386c1.466,0.084,2.919,0.136,4.361,0.155
    c1.443,0.021,2.896,0.055,4.361,0.096c1.841,0.084,3.44,0.293,4.801,0.627c1.359,0.336,2.521,0.815,3.482,1.442
    c2.385,1.507,3.577,4.038,3.577,7.594h2.07l3.514,3.515L-312.282,987.242L-312.282,987.242z"></path>
                                    <path fill="#231F20" d="M-255.113,987.242h-6.401v37.652l-3.954-4.832c0.042-6.275,0.104-10.981,0.189-14.119
    c0.041-1.842,0.063-3.409,0.063-4.707c0-1.38-0.272-2.792-0.815-4.235c-0.544-1.442-1.297-2.834-2.259-4.174
    c-2.26-2.97-4.729-4.455-7.405-4.455c-4.06,0-6.861,1.862-8.408,5.585c1.757-0.753,3.283-1.13,4.58-1.13
    c1.004,0,1.936,0.137,2.793,0.408s1.6,0.639,2.229,1.099c0.668,0.586,1.19,1.266,1.567,2.039c0.377,0.774,0.564,1.663,0.564,2.667
    c0,1.34-0.64,3.023-1.914,5.052c-1.276,2.029-3.043,4.278-5.303,6.746l-4.078-4.644c0.543-0.377,1.19-0.932,1.944-1.663
    c0.752-0.731,1.547-1.579,2.386-2.542c1.004-1.087,1.786-2.028,2.353-2.823s0.847-1.381,0.847-1.758
    c0-1.129-0.688-1.694-2.069-1.694c-0.502,0-1.632,0.524-3.39,1.569c-0.838,0.461-1.567,0.826-2.195,1.098
    c-0.628,0.273-1.13,0.408-1.507,0.408c-0.92,0-1.842-0.585-2.762-1.757c-0.795-1.046-1.191-2.134-1.191-3.264
    c0-2.888,1.339-5.271,4.017-7.153c1.213-0.837,2.499-1.453,3.859-1.853c1.357-0.396,2.792-0.596,4.298-0.596
    c3.724,0,6.631,1.214,8.723,3.64c1.422,1.675,2.95,4.79,4.582,9.351l-0.563-10.166c-0.085-2.049-0.158-3.892-0.222-5.522
    c-0.063-1.631-0.094-3.114-0.094-4.455l2.008,2.009c-0.084,0.336-0.125,0.67-0.125,1.004c-0.084,2.553,0.962,3.808,3.139,3.766
    c0.251,0,0.585-0.021,1.004-0.063L-255.113,987.242z"></path>
                                    <path fill="#231F20" d="M-261.201,1026.213c-0.252-0.168-0.899-1.191-1.945-3.075c-1.256-2.175-1.986-3.43-2.197-3.766
    c-1.463-1.506-3.806-2.259-7.026-2.259c-1.046,0-2.146,0.021-3.295,0.063c-1.15,0.042-2.521,0.105-4.11,0.188
    c-1.798,0.084-3.515-0.229-5.146-0.941c-1.841-0.794-3.18-1.903-4.017-3.326c-1.087-1.798-1.61-3.514-1.569-5.146
    c0.085-3.598,0.211-5.313,0.377-5.146l1.759,1.758c-0.335,0.67-0.398,1.506-0.189,2.51c0.42,2.009,1.736,3.536,3.954,4.581
    c0.502,0.294,1.862,0.502,4.079,0.628c1.631,0.084,3.264,0.168,4.895,0.251c2.009,0.125,3.577,0.354,4.707,0.689
    c0.752,0.21,1.61,0.502,2.572,0.878c1.925,1.173,3.159,2.197,3.703,3.075c1.548,1.842,2.552,3.475,3.012,4.896
    C-261.347,1022.991-261.201,1024.371-261.201,1026.213z"></path>
                                    <path fill="#231F20" d="M-248.59,987.242v36.711l-3.389-3.514v-26.043c0-1.089-0.21-2.071-0.628-2.949
    c-0.418-0.879-0.994-1.621-1.725-2.229c-0.732-0.604-1.569-1.087-2.512-1.441c-0.941-0.355-1.914-0.534-2.918-0.534l-3.515-3.514
    h4.017c2.135,0,3.786,0.471,4.958,1.411c1.17,0.94,2.111,2.5,2.823,4.676c0-0.712-0.021-1.591-0.063-2.637
    c-0.042-1.045-0.126-2.278-0.251-3.702c-0.084-1.381-0.146-2.583-0.188-3.607s-0.063-1.894-0.063-2.604l1.255,1.066
    c0.418,2.511,1.149,4.31,2.195,5.396h2.512l3.451,3.515H-248.59L-248.59,987.242z"></path>
                                    <path fill="#231F20" d="M-208.927,987.242h-6.339v36.898l-1.38-1.381c-1.883-7.11-5.146-11.421-9.79-12.927
    c-1.046,1.339-2.113,2.238-3.2,2.698c-1.089,0.461-2.093,0.689-3.013,0.689c-1.673,0-3.085-0.554-4.235-1.663
    c-1.15-1.107-1.727-2.52-1.727-4.235c0-1.967,0.731-3.534,2.197-4.706c1.255-1.004,2.948-1.506,5.082-1.506
    c1.131,0,2.05,0.229,2.762,0.689c0-2.971-0.648-5.104-1.945-6.4c-0.838-0.794-2.447-1.526-4.832-2.196
    c-1.255-0.377-2.332-0.763-3.231-1.161c-0.899-0.396-1.643-0.784-2.228-1.161c-0.879-0.585-1.967-1.757-3.264-3.514l-3.703-3.641
    h35.331L-208.927,987.242z M-218.593,1012.595v-25.353h-17.069c3.641,2.972,6.149,5.419,7.53,7.343
    c2.218,2.845,3.326,5.898,3.326,9.162c0,0.293,0,0.563,0,0.814s-0.021,0.544-0.063,0.88c1.338,1.129,2.52,2.279,3.545,3.45
    c1.024,1.173,1.893,2.406,2.604,3.702L-218.593,1012.595L-218.593,1012.595z"></path>
                                </g>
                            </g>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-556.365,659.585 -552.31,657.655
-552.31,657.655 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-507.224,580.516 -514.177,590.074
-518.906,591.715 -514.177,590.074 -507.223,580.517 -504.427,582.737 -503.302,583.158 -504.427,582.736 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-575.385,686.714 -571.135,675.516
-570.846,672.136 -571.136,675.516 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-526.533,628.402 -525.664,632.747
-526.532,628.402 -524.698,622.996 -522.285,620.679 -524.698,622.995 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-519.582,597.991 -519.294,596.929
-520.161,592.487 -519.295,596.928 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-530.973,647.903 -538.89,658.91
-541.787,661.323 -543.719,662.385 -545.456,661.898 -543.719,662.386 -541.786,661.323 -538.889,658.91 -530.973,647.904
-526.725,638.346 -525.664,632.747 -526.726,638.346 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-513.306,609.093 -514.85,613.92
-513.305,609.093 -517.36,606.68 -515.816,603.396 -517.361,606.68 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-571.909,665.378 -572.007,667.212
-572.007,667.212 -571.908,665.378 -569.883,662.386 -567.177,660.262 -569.883,662.385 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-579.052,693.761 -579.052,693.762
-578.666,691.734 -575.385,686.714 -578.669,691.734 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-569.495,717.513 -572.681,717.896
-575.191,719.152 -572.68,717.898 -569.494,717.513 -569.011,716.354 -570.091,714.823 -569.012,716.354 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-572.777,701.486 -572.777,701.486
-572.97,703.127 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-574.515,723.689 -576.638,726.007
-574.514,723.691 -576.059,721.084 -575.191,719.152 -576.06,721.084 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-578.379,695.21 -578.738,694.438
-578.38,695.209 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-576.349,708.05 -574.514,706.216
-572.97,703.127 -574.515,706.216 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-576.638,726.007 -581.274,729
-583.107,731.8 -581.273,729.001 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-567.177,660.262 -564.38,659.489
-558.008,659.779 -564.381,659.488 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-502.881,583.316 -502.881,583.316
-501.43,583.123 -500.852,581.289 -500.852,581.288 -501.431,583.123 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                points="-491.777,573.661 -495.349,574.916
-499.404,575.302 -501.238,576.364 -499.404,575.303 -495.348,574.916 -491.776,573.661 -489.074,571.731 -489.074,571.73 ">
                            </polygon>
                            <g id="Sylhet">
                                <a href="{{ url('/sub-category/sylhet') }}"
                                    xlink:href="{{ url('/sub-category/sylhet') }}">
                                    <path fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" d="M-210.061,421.315l-1.642-3.668l-1.933-1.933
    l-5.117-2.22l1.738-1.644l-0.869-1.062l-1.932-0.965l-6.758-5.021v-0.771l-5.312-1.738l-1.159-6.565l-5.213-3.089l-5.89-2.51
    l-3.281-4.73l-1.835-1.352l-10.813-1.545l-3.767-0.869l-2.8-1.255l-2.51-1.834l-2.896-2.51l-3.09-4.055l-1.352-1.255l-1.738-0.29
    l-2.8,0.869l-2.605-1.545l-2.994-0.192l-1.642-0.483l-1.254-1.255l-2.027-3.282l-1.642-1.352l-5.602-2.221l-6.66-1.641l-6.76-0.29
    l-9.461,2.992l-11.585-1.737l-22.302,2.8l-10.041-0.966l-3.186,0.483l-1.354,1.255l-1.255,2.8l-1.448,1.158l-4.538-1.931
    l-2.414,0.097l-1.062,3.765l-2.124,2.125l-4.923,0.676l-5.313-0.193l-3.476-0.869l-3.379-2.8l-1.448-2.607l-1.448-1.737
    l-3.669-0.29l-1.736,0.772l-3.571,2.896l-4.635,0.869l-4.248,1.448l-2.026,0.29l-8.11-0.965l-30.894-9.461l-10.04-5.31
    l-2.222,0.097l-4.537,2.414l-2.606,0.386l-11.585-0.386l-33.404,5.406l-6.563,2.414l-1.834,0.193l-0.019,0.29l0,0l0.019-0.29
    l-23.46,3.282l-5.892-0.772l-2.991-1.448l-2.606-2.027l-2.703-1.642l-2.412-0.276c-0.264,2.514-1.221,12.197-1.221,19.971
    c0,9.011,6.759,23.814,13.838,24.78c7.08,0.965,10.942,3.218,14.805,6.758c3.861,3.54,9.654,7.724,16.091,8.045
    c0.763,0.038,1.285,0.16,1.63,0.353v0.001c0.359,0.2,0.513,0.481,0.501,0.833l3.399,5.669l5.986,2.704l24.813-2.607l2.702,10.33
    l1.448,4.729l0.771,10.234l-1.544,11.972l1.353,4.15l1.158,0.482l3.766-0.482l6.372,0.291l2.22,1.062l1.159,1.738l0.869,2.8
    l-0.098,1.738l-2.221,3.862l-0.29,4.344l-0.677,1.255l-4.827,2.414l0.099,1.738l2.604,3.283l1.063,2.412l2.414,2.414l3.765,2.027
    v0.001l-2.896,7.626l-2.222,4.248l-1.291,1.834l-0.543,0.771l-0.001,0.002l-2.025,2.025l-0.192,1.644l1.642,1.931l1.546,0.965
    l2.315,0.192l2.511,1.159l1.158,5.405l-0.29,2.802l-3.475,2.51l4.537,4.054l2.414,3.188l0.386,1.736l-1.063,2.124l-1.445,0.483
    l-2.317,2.51l2.896,4.538l-4.535,3.188l-7.049,3.186l-3.091,7.821l-1.641,1.544l-1.642,2.703l5.896,3.081l11.288,5.896l5.213,0.965
    l6.951-5.792l2.896-1.352l2.413-0.386l2.607,1.062v0.001v1.543v0.001l-3.669,3.188l-5.696,3.477l-1.352,1.544l0.296,0.386
    l0.959,1.256l5.02,1.447l1.354,1.255h-0.001h0.001l-1.354,0.772l-4.536,0.965l-1.447,0.676l-1.545,1.643l-0.099,3.859l0.688,1.545
    l0.856,1.933l0.966,3.86l-0.192,2.896l0.676,5.697l1.539,5.599l0.584,2.123l2.319,2.994l0.675,0.869l-0.099,2.025l-0.867,5.312
    v0.001l3.861,1.062l2.511-1.735l2.124-9.271l0.386-8.688l2.51-5.891l8.689-0.771l15.834,3.475l7.723,0.676l8.592-1.062l4.828-1.448
    l2.993-2.028l2.026-3.186l1.642-4.827l2.221-14.479l0.967-2.703l2.125,0.771l3.668,9.27l1.931,3.477l3.766,2.413l4.057,0.579
    l3.571-1.352l2.413-3.571l-0.097-3.959l-1.353-4.634l-0.578-4.346l2.124-2.992l13.227,2.896l2.222,0.097l0.577,1.448l0.29,5.214
    l0.482,2.027l6.372,6.373l4.248,1.062l2.604-1.736l1.545-3.959l4.537-19.501l0.193-4.442l-2.222-9.171l0.678-4.055l4.634-1.545
    l1.931,1.737l4.538,3.188l4.057,1.642l-0.193-3.09l-4.729-7.819l0.288-2.703l17.38,1.545l6.081-0.482l5.311-2.51l4.056-5.504
    l0.771-6.564l-1.157-13.903l1.063-4.344l2.604-2.606l3.188-1.932l2.99-2.414l2.224-3.379l1.062-3.475l0.965-7.82l2.027-8.882
    l10.62-29.928l0.481-3.572l0.098-3.573l-0.387-3.668l-2.702-7.434l-0.87-4.057l1.063-3.86l6.082-2.703l8.014,2.703l14.191,8.688
    l0.193,1.737l0.867,1.159l1.546,0.676l2.025,0.29l12.744-4.248l7.435-2.028l2.896-4.538l0.676-2.51L-210.061,421.315z">
                                    </path>
                                </a>
                                <g class="sylhet-dev">
                                    <path fill="#231F20" d="M-412.344,475.735c-1.129-1.004-2.385-1.997-3.766-2.98c-1.38-0.981-2.949-1.955-4.706-2.918
    c-1.591-0.92-3.231-1.59-4.927-2.009c-1.693-0.417-3.441-0.627-5.239-0.627c-2.636,0-5.334,0.921-8.095,2.761
    c-3.056,2.009-4.666,4.247-4.832,6.715l1.381,3.326h3.827l3.577,3.514h-6.15v36.711l-3.576-3.514v-33.197h-5.334l-3.451-3.514
    h9.351l-2.447-2.322c-0.921-0.92-1.381-1.86-1.381-2.823c0-2.845,1.59-5.521,4.77-8.032c3.097-2.343,6.087-3.515,8.975-3.515
    c7.445,0,14.56,3.515,21.337,10.542L-412.344,475.735z"></path>
                                    <path fill="#231F20" d="M-404.752,483.517v37.025c-0.587-0.669-1.16-1.328-1.726-1.978c-0.563-0.647-1.12-1.308-1.663-1.978
    c0.041-1.255,0.083-2.311,0.126-3.169c0.041-0.857,0.072-1.568,0.094-2.134c0.021-0.564,0.031-1.035,0.031-1.412
    c0-0.376,0-0.731,0-1.066c0-2.803-0.272-5.25-0.815-7.342c-0.545-2.092-1.267-3.64-2.164-4.645c-0.9-1.004-1.957-1.391-3.17-1.16
    c-1.214,0.229-2.47,1.266-3.766,3.104c-1.172,1.969-2.187,3.525-3.044,4.677c-0.856,1.15-1.6,2.019-2.228,2.604
    c-0.629,0.585-1.161,0.951-1.602,1.098c-0.438,0.147-0.847,0.221-1.223,0.221c-1.089,0-2.063-0.262-2.918-0.784
    c-0.859-0.522-1.623-1.171-2.291-1.945c-0.67-0.773-1.256-1.609-1.758-2.511c-0.502-0.898-0.964-1.746-1.381-2.541l2.321-2.134
    c0.126,0.419,0.283,0.899,0.471,1.442c0.188,0.544,0.43,1.058,0.724,1.537c0.291,0.481,0.637,0.891,1.035,1.225
    c0.396,0.336,0.847,0.502,1.349,0.502c0.209,0,0.46-0.083,0.753-0.251c0.293-0.166,0.68-0.513,1.161-1.035
    c0.479-0.522,1.108-1.255,1.883-2.196c0.773-0.941,1.746-2.186,2.918-3.733c-0.21-1.673-0.492-2.98-0.847-3.923
    c-0.356-0.94-0.858-1.673-1.507-2.195c-0.649-0.522-1.466-0.921-2.447-1.192c-0.983-0.271-2.207-0.574-3.671-0.909
    c-0.838-0.209-1.686-0.534-2.541-0.973c-0.858-0.439-1.748-1.016-2.668-1.728c-0.335-0.251-0.856-0.711-1.568-1.38
    c-0.711-0.669-1.609-1.548-2.699-2.636h37.904l3.389,3.514L-404.752,483.517L-404.752,483.517z M-408.139,483.517h-16.566
    c1.883,1.675,3.188,3.224,3.922,4.646c0.732,1.422,1.119,3.033,1.162,4.832c1.17-1.297,2.247-2.145,3.229-2.542
    s1.914-0.429,2.793-0.094s1.758,0.963,2.636,1.882c0.88,0.921,1.819,2.029,2.824,3.326V483.517L-408.139,483.517z">
                                    </path>
                                    <path fill="#231F20"
                                        d="M-376.889,483.517c-2.636,0.628-4.916,1.611-6.84,2.95c-1.925,1.339-3.557,3.012-4.896,5.021
    c-1.214,1.883-2.134,3.976-2.762,6.274c-0.628,2.303-0.939,4.874-0.939,7.72c0.041,2.511,0.71,4.77,2.008,6.776
    c2.259,3.139,4.455,4.394,6.589,3.767c-0.796-0.503-1.371-1.089-1.726-1.758c-0.355-0.669-0.533-1.358-0.533-2.07
    c0-1.088,0.449-2.009,1.349-2.762c0.899-0.754,1.894-1.13,2.981-1.13c1.17,0,2.174,0.472,3.012,1.412
    c0.836,0.941,1.255,2.146,1.255,3.608c0,0.837-0.167,1.609-0.502,2.32c-0.335,0.712-0.796,1.329-1.38,1.853
    c-0.587,0.522-1.268,0.932-2.04,1.224c-0.774,0.293-1.579,0.439-2.416,0.439c-4.101,0-7.238-2.05-9.413-6.15
    c-1.842-3.346-2.762-7.217-2.762-11.608c0-6.107,2.488-12.069,7.469-17.886h-11.673l-3.515-3.514h23.281L-376.889,483.517z"></path>
                                    <path fill="#231F20" d="M-346.957,483.517v37.089l-3.64-3.39v-20.081c0-1.256-0.451-2.354-1.35-3.295
    c-0.9-0.94-1.978-1.412-3.232-1.412c-2.008,0-3.012,1.214-3.012,3.641c0,0.544,0.104,1.276,0.313,2.195l-1.443,0.565
    c-0.335-1.883-1.276-3.431-2.823-4.646c-1.506-1.213-3.264-1.818-5.271-1.818c-0.879,0-1.718,0.179-2.511,0.533
    c-0.796,0.355-1.497,0.826-2.104,1.411c-0.606,0.587-1.088,1.286-1.443,2.104c-0.354,0.815-0.533,1.663-0.533,2.541
    c0,2.846,1.695,4.519,5.084,5.021c-0.754-1.13-1.13-2.111-1.13-2.948c0-1.004,0.407-1.894,1.225-2.667
    c0.815-0.773,1.726-1.161,2.729-1.161c3.223,0.21,4.832,1.944,4.832,5.208c-0.042,1.381-0.544,2.511-1.506,3.389
    c-0.963,0.879-2.364,1.381-4.204,1.507c-1.506,0-2.887-0.239-4.143-0.722c-1.255-0.48-2.332-1.161-3.231-2.04
    c-0.898-0.878-1.601-1.935-2.103-3.169c-0.502-1.233-0.753-2.604-0.753-4.11c0-2.426,0.669-4.664,2.009-6.715
    c1.506-2.259,3.43-3.389,5.772-3.389c3.013,0,5.71,1.549,8.096,4.645c0-1.088,0.479-2.092,1.442-3.013
    c0.962-0.962,1.924-1.443,2.888-1.443c2.928,0,5.104,1.945,6.525,5.836v-9.664h-28.741l-3.64-3.514h38.844l3.578,3.514
    L-346.957,483.517L-346.957,483.517z"></path>
                                    <path fill="#231F20" d="M-333.402,483.517v24.537c0.795,1.59,1.924,2.386,3.389,2.386c2.092,0,4.246-1.276,6.464-3.828
    c2.009-2.386,3.139-4.79,3.39-7.218l-1.192,0.126c-1.129,0-2.165-0.396-3.104-1.191c-0.941-0.795-1.412-1.799-1.412-3.013
    c0-1.297,0.406-2.405,1.223-3.326c0.816-0.919,1.893-1.38,3.232-1.38c2.008,0,3.659,0.982,4.957,2.948
    c0.461,0.753,0.825,1.644,1.099,2.667c0.271,1.025,0.407,2.062,0.407,3.106c0,3.473-1.443,6.902-4.33,10.291
    c-2.929,3.599-6.107,5.396-9.538,5.396c-2.218,0-3.995-0.689-5.334-2.07s-2.218-3.326-2.636-5.836v-23.597h-5.647l-3.2-3.514
    h26.67c0-0.335,0.01-0.7,0.031-1.099c0.021-0.396,0.031-0.764,0.031-1.099c0.041-2.092-1.422-3.138-4.394-3.138
    c-0.67,0-1.757,0.125-3.264,0.376c-0.711,0.085-1.317,0.147-1.819,0.188c-0.502,0.042-0.94,0.063-1.316,0.063
    c-2.678,0-5.146-0.647-7.405-1.945c-2.47-1.38-3.702-3.347-3.702-5.897c0-2.677,0.856-4.079,2.572-4.205
    c0,0.168,0.021,0.355,0.063,0.564c0.041,0.21,0.063,0.418,0.063,0.627c-0.587,0.503-0.879,1.131-0.879,1.884
    c0,1.465,0.605,2.531,1.818,3.2c1.132,0.628,2.427,0.94,3.893,0.94c0.502,0,1.118-0.031,1.851-0.094
    c0.733-0.063,1.579-0.136,2.542-0.22c1.883-0.251,3.325-0.377,4.33-0.377c3.138,0,5.501,0.921,7.091,2.762
    c1.256,1.632,1.884,4.121,1.884,7.468h1.944l3.515,3.514h-23.284V483.517z"></path>
                                </g>
                            </g>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-476.62,471.518 -475.463,473.257
-474.594,476.056 -475.463,473.256 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-482.702,489.668 -482.605,491.407
-480,494.688 -482.605,491.406 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-479.166,515.252 -479.712,516.025
-479.709,516.024 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-492.163,439.08 -490.717,443.811
-489.943,454.044 -490.717,443.81 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-529.065,422.983 -529.065,422.984
-525.664,428.653 -519.677,431.356 -525.664,428.652 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-476.427,522.783 -478.743,522.59
-480.288,521.625 -478.744,522.59 -476.427,522.784 -473.919,523.942 -472.76,529.348 -473.916,523.941 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-476.522,534.658 -471.985,538.713
-469.571,541.899 -471.985,538.712 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-476.522,499.516 -472.76,501.544
-472.76,501.543 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                points="-488.977,470.649 -490.135,470.166
-491.487,466.016 -491.487,466.016 -490.135,470.167 -488.977,470.65 -485.214,470.167 -478.842,470.457 -485.214,470.166 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-456.25,588.046 -461.269,586.598
-462.228,585.343 -461.269,586.599 -456.25,588.047 -454.898,589.301 -454.897,589.301 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-454.415,574.144 -451.807,575.207
-451.807,575.206 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-459.724,575.882 -466.677,581.674
-471.888,580.709 -483.177,574.813 -471.888,580.71 -466.677,581.675 -459.724,575.883 -456.828,574.531 -454.415,574.144
-456.828,574.53 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-459.344,618.748 -458.76,620.872
-456.44,623.864 -458.76,620.871 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-463.878,597.219 -463.188,598.763
-463.878,597.218 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-771.947,470.457 -771.947,470.456
-774.264,480.883 "></polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-866.077,648.483 -859.223,653.117
-840.593,661.131 -859.222,653.117 ">
                            </polygon>
                            <path fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                d="M-778.416,501.833l1.062-2.51L-778.416,501.833z"></path>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-777.354,499.323 -775.037,496.523
-773.492,490.73 -773.492,490.73 -775.037,496.522 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-779.673,520.563 -777.933,513.418
-777.643,508.881 -777.933,513.417 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-993.032,590.46 -989.75,595.481
-988.399,596.64 -983.378,599.343 -980.289,601.563 -978.647,602.432 -974.593,603.107 -978.647,602.431 -980.289,601.563
-983.378,599.342 -988.399,596.639 -989.75,595.48 -993.032,590.459 -993.998,586.985 -993.998,586.985 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-944.471,593.356 -948.236,591.425
-952.388,591.135 -954.511,593.936 -952.388,591.136 -948.236,591.426 -944.471,593.356 -942.83,594.709 -938.003,601.176
-942.83,594.708 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-924.293,619.616 -928.542,614.21
-924.293,619.617 -923.425,621.644 -923.425,621.643 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-938.003,601.176 -930.375,608.514
-928.542,614.21 -930.375,608.513 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-909.329,643.365 -913.77,640.469
-921.783,633.519 -913.77,640.47 -909.329,643.366 -904.791,645.49 -899.095,646.552 -904.791,645.489 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-974.593,603.107 -970.731,602.239
-957.311,595.866 -970.731,602.238 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-881.814,644.717 -899.095,646.552
-881.814,644.718 -876.215,645.201 -871.949,646.148 -876.215,645.2 ">
                            </polygon>
                            <path fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                d="M-924.39,629.078l0.58,2.027L-924.39,629.078z"></path>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-798.615,364.172 -811.919,362.81
-816.041,362.81 -816.041,362.81 -811.919,362.81 ">
                            </polygon>
                            <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" points="-791.258,354.507 -795.891,364.451
-795.89,364.451 "></polygon>

                            <g id="Mymensingh">
                                <a href="{{ url('/sub-category/mymensingh') }}"
                                    xlink:href="{{ url('/sub-category/mymensingh') }}">
                                    <path fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" d="M-576.735,362.713l-2.222,2.414l-1.256,0.676
    l-1.736,0.096l-7.726-1.352l-4.536-2.027l-2.413-0.772l-2.896-0.097l-8.399,2.221l-17.087-1.545l-21.144,4.538l-7.338-0.29
    l-16.22-6.855l-32.729-7.337l-46.245-19.599l-7.917,0.29l-7.433,2.993l-3.283-0.579l-2.414-4.538l-1.834-8.207l-0.675-7.82
    l0.868-6.662l-3.477,0.676l-2.993,1.931l-1.834,3.379l-4.729,11.392l1.834,12.551l-1.159,5.792l-3.089,4.538l-2.51,2.896
    l-1.933,3.089l-4.634,9.944l-2.8,12.357l-1.931,12.165l-1.159,19.309l0.29,1.931l5.021,24.908l1.834,4.538l2.8,5.599l2.124,2.317
    l3.571,2.414l6.179,3.28l3.767,3.572l1.737,2.124l1.353,2.414c0,0,0.229-14.964,13.262-13.999c0,0,11.746,0.804,18.185-6.275
    c6.437-7.078,12.549-5.793,10.939,0.967c-1.606,6.758,8.69,5.471,7.081,15.769c-1.607,10.298-4.504,20.274,5.793,29.929
    c10.297,9.655,14.481,7.401,11.907,20.274c-2.575,12.873-2.251,18.665,6.115,24.779c8.367,6.113,11.907-0.645,18.343,1.288
    c6.436,1.931,12.873-12.553,27.354-7.402c14.48,5.148,27.999,14.16,24.779-2.896c-3.219-17.056-6.436-16.09-12.551-18.985
    c-6.115-2.896-5.148-8.367,6.758-8.689c11.907-0.321,25.422-0.321,32.503-3.86c7.08-3.54,3.539-18.665,12.55-19.632
    c9.014-0.966,33.791-0.966,42.479-3.54c8.688-2.572,7.725-3.218,15.77-4.184s14.481-15.125,6.114-18.343
    c-8.367-3.219-12.872-5.471-10.94-11.907c1.463-4.871,7.523-9.556,7.602-11.687l-0.501-0.837c-0.343-0.188-0.867-0.313-1.629-0.351
    c-6.437-0.321-12.229-4.505-16.09-8.045c-3.862-3.54-7.727-5.792-14.807-6.758c-7.078-0.966-13.838-15.77-13.838-24.78
    c0-7.774,0.957-17.458,1.222-19.971l-0.968-0.11L-576.735,362.713z"></path>
                                </a>
                                <g class="mymensingh-dev">
                                    <path fill="#231F20" d="M-750.923,436.688h-6.338v36.898l-1.38-1.381c-1.883-7.111-5.146-11.421-9.79-12.927
    c-1.046,1.339-2.113,2.237-3.201,2.697c-1.088,0.461-2.092,0.69-3.012,0.69c-1.673,0-3.085-0.554-4.236-1.663
    c-1.15-1.108-1.726-2.52-1.726-4.236c0-1.966,0.73-3.533,2.196-4.706c1.255-1.004,2.95-1.506,5.083-1.506
    c1.13,0,2.049,0.23,2.761,0.69c0-2.971-0.649-5.104-1.945-6.401c-0.837-0.794-2.446-1.525-4.832-2.195
    c-1.255-0.378-2.333-0.764-3.231-1.161c-0.9-0.396-1.643-0.784-2.229-1.161c-0.878-0.585-1.967-1.757-3.263-3.515l-3.703-3.64
    h35.331L-750.923,436.688z M-760.587,462.039v-25.354h-17.068c3.64,2.973,6.149,5.42,7.531,7.344
    c2.217,2.845,3.325,5.897,3.325,9.162c0,0.293,0,0.563,0,0.814s-0.021,0.544-0.063,0.879c1.338,1.129,2.52,2.28,3.545,3.451
    c1.025,1.172,1.893,2.406,2.604,3.702L-760.587,462.039L-760.587,462.039z"></path>
                                    <path fill="#231F20" d="M-724.755,436.688v37.339c-0.963-0.711-2.259-2.512-3.891-5.397c-1.757-3.053-3.452-5.291-5.083-6.714
    c-2.678-2.092-6.15-3.242-10.417-3.452l-4.707-6.087c1.883-1.798,3.734-3.514,5.554-5.146c1.82-1.633,3.503-3.014,5.053-4.143
    c-0.418-0.46-1.234-0.981-2.447-1.569c-1.214-0.585-2.824-1.255-4.832-2.008c-4.729-1.381-7.97-3.492-9.728-6.338h32.569
    l3.641,3.515H-724.755z M-742.889,467.813c0-1.004,0.355-1.86,1.067-2.572c0.71-0.71,1.547-1.066,2.51-1.066
    c1.004,0,1.861,0.356,2.573,1.066c0.71,0.712,1.065,1.568,1.065,2.572c0,0.964-0.355,1.801-1.065,2.511
    c-0.712,0.712-1.569,1.066-2.573,1.066c-0.963,0-1.799-0.354-2.51-1.066C-742.534,469.612-742.889,468.775-742.889,467.813z
     M-728.205,436.688h-13.492c1.087,0.67,2.384,1.735,3.891,3.2c1.506,1.465,3.138,3.264,4.896,5.396
    c-1.423,1.339-2.846,2.729-4.268,4.173c-1.423,1.443-2.866,2.96-4.33,4.55c5.773,2.008,10.166,5.564,13.179,10.668h0.125V436.688z
    "></path>
                                    <path fill="#231F20" d="M-684.78,436.688h-6.338v36.898l-1.38-1.381c-1.884-7.111-5.146-11.421-9.79-12.927
    c-1.047,1.339-2.113,2.237-3.201,2.697c-1.088,0.461-2.092,0.69-3.013,0.69c-1.673,0-3.085-0.554-4.235-1.663
    c-1.151-1.108-1.727-2.52-1.727-4.236c0-1.966,0.731-3.533,2.196-4.706c1.255-1.004,2.95-1.506,5.083-1.506
    c1.13,0,2.049,0.23,2.761,0.69c0-2.971-0.648-5.104-1.944-6.401c-0.837-0.794-2.447-1.525-4.832-2.195
    c-1.255-0.378-2.333-0.764-3.232-1.161c-0.899-0.396-1.642-0.784-2.228-1.161c-0.878-0.585-1.968-1.757-3.264-3.515l-3.703-3.64
    h35.331L-684.78,436.688z M-694.444,462.039v-25.354h-17.069c3.641,2.973,6.15,5.42,7.531,7.344
    c2.217,2.845,3.326,5.897,3.326,9.162c0,0.293,0,0.563,0,0.814s-0.021,0.544-0.063,0.879c1.338,1.129,2.521,2.28,3.545,3.451
    c1.025,1.172,1.894,2.406,2.604,3.702L-694.444,462.039L-694.444,462.039z"></path>
                                    <path fill="#231F20" d="M-657.734,436.688v37.777l-2.761-1.758l0.251-3.702c0.042-3.974-0.878-8.116-2.762-12.425
    c-2.803-4.896-6.065-7.343-9.79-7.343c-0.46,0.042-0.795,0.146-1.004,0.313c1.547,2.05,2.322,3.535,2.322,4.455
    c0,1.506-0.438,2.771-1.318,3.797c-0.878,1.025-2.05,1.537-3.514,1.537c-4.518,0-6.777-2.196-6.777-6.589
    c0-2.385,0.837-4.351,2.511-5.899c1.798-1.589,3.849-2.384,6.149-2.384c4.937,0,9.288,3.892,13.054,11.672h0.125v-19.454h-24.726
    l-3.451-3.514h34.2l3.642,3.514h-6.151V436.688z"></path>
                                    <path fill="#231F20" d="M-615.564,428.905c-1.129-1.004-2.385-1.997-3.766-2.98c-1.381-0.981-2.949-1.955-4.706-2.918
    c-1.592-0.92-3.231-1.59-4.928-2.009c-1.692-0.417-3.44-0.627-5.238-0.627c-2.637,0-5.334,0.921-8.096,2.761
    c-3.055,2.009-4.666,4.247-4.832,6.715l1.382,3.326h3.826l3.577,3.514h-6.149v36.712l-3.576-3.515v-33.197h-5.334l-3.451-3.514
    h9.35l-2.446-2.322c-0.921-0.92-1.381-1.86-1.381-2.823c0-2.845,1.59-5.521,4.77-8.032c3.096-2.342,6.087-3.515,8.974-3.515
    c7.446,0,14.561,3.515,21.338,10.542L-615.564,428.905z"></path>
                                    <path fill="#231F20"
                                        d="M-607.972,436.688v37.024c-0.586-0.669-1.16-1.328-1.726-1.978c-0.564-0.647-1.12-1.308-1.663-1.978
    c0.041-1.255,0.084-2.311,0.126-3.169c0.041-0.856,0.072-1.568,0.094-2.134c0.021-0.564,0.032-1.035,0.032-1.412
    c0-0.376,0-0.731,0-1.066c0-2.803-0.273-5.25-0.816-7.342c-0.545-2.092-1.266-3.64-2.165-4.645
    c-0.898-1.004-1.956-1.391-3.169-1.16c-1.214,0.229-2.469,1.266-3.766,3.104c-1.172,1.969-2.187,3.525-3.043,4.677
    c-0.858,1.15-1.602,2.019-2.229,2.604c-0.627,0.586-1.159,0.951-1.6,1.099c-0.439,0.146-0.848,0.22-1.224,0.22
    c-1.09,0-2.063-0.261-2.918-0.784c-0.858-0.522-1.622-1.171-2.29-1.945c-0.671-0.773-1.257-1.609-1.759-2.511
    c-0.502-0.898-0.963-1.746-1.381-2.541l2.322-2.134c0.125,0.419,0.282,0.899,0.471,1.442c0.188,0.545,0.429,1.058,0.723,1.537
    c0.292,0.481,0.638,0.891,1.034,1.225c0.397,0.336,0.848,0.502,1.35,0.502c0.209,0,0.461-0.083,0.754-0.251
    c0.292-0.166,0.68-0.513,1.16-1.035c0.479-0.522,1.107-1.255,1.883-2.196c0.772-0.94,1.746-2.186,2.918-3.732
    c-0.209-1.674-0.492-2.981-0.847-3.924c-0.356-0.94-0.858-1.673-1.508-2.195c-0.647-0.522-1.465-0.92-2.446-1.192
    c-0.982-0.271-2.207-0.574-3.67-0.909c-0.838-0.209-1.687-0.534-2.542-0.973c-0.858-0.439-1.747-1.015-2.667-1.727
    c-0.336-0.251-0.857-0.712-1.568-1.381s-1.611-1.548-2.699-2.636h37.903l3.389,3.514h-6.463V436.688z M-611.361,436.688h-16.566
    c1.883,1.674,3.189,3.223,3.922,4.645c0.731,1.422,1.119,3.033,1.161,4.832c1.171-1.297,2.248-2.145,3.231-2.542
    c0.981-0.397,1.914-0.429,2.793-0.094s1.757,0.963,2.635,1.882c0.879,0.921,1.82,2.03,2.824,3.326V436.688L-611.361,436.688z"></path>
                                    <path fill="#231F20" d="M-583.937,442.335c0,2.134-0.732,4.058-2.197,5.773c-1.422,1.59-3.2,2.384-5.334,2.384
    c-2.259,0-4.204-0.815-5.836-2.447c-1.631-1.631-2.447-3.598-2.447-5.897c0-1.005,0.188-1.986,0.564-2.949
    c0.377-0.962,0.982-1.861,1.82-2.698c1.631-1.716,3.472-2.573,5.521-2.573c2.218,0,4.08,0.857,5.586,2.573
    C-584.714,438.172-583.937,440.117-583.937,442.335z M-581.302,473.712c-1.297-1.297-2.697-2.594-4.204-3.892
    c-1.507-1.296-3.033-2.521-4.581-3.671c-1.549-1.15-3.074-2.237-4.58-3.264c-1.508-1.024-2.908-1.914-4.204-2.667v-7.906
    c2.761,2.134,5.855,5.03,9.286,8.69c3.431,3.661,6.191,6.956,8.283,9.884V473.712L-581.302,473.712z M-587.326,440.515
    c0-2.008-0.838-3.012-2.512-3.012c-1.632,0-3.097,0.712-4.394,2.134c-0.586,0.669-1.035,1.411-1.349,2.229
    c-0.313,0.814-0.472,1.643-0.472,2.479c0,1.842,0.711,2.762,2.134,2.762c1.716,0,3.242-0.668,4.581-2.009
    C-587.996,443.8-587.326,442.271-587.326,440.515z"></path>
                                    <path fill="#231F20"
                                        d="M-546.286,436.688h-18.575c0.334,0.461,0.668,0.909,1.004,1.35c0.334,0.438,0.648,0.847,0.941,1.224
    c3.598,1.255,5.981,2.596,7.153,4.018c1.883,1.841,2.823,4.267,2.823,7.278c0,2.762-1.151,5.083-3.451,6.967
    c-1.674,1.422-4.289,2.613-7.845,3.575c2.385,1.424,4.927,3.285,7.625,5.585c2.698,2.303,5.617,5.042,8.754,8.222v-0.063
    l0.816,3.703c-1.675-1.883-3.516-3.651-5.522-5.303c-2.009-1.652-4.268-3.211-6.777-4.676c-2.385-1.339-4.854-2.511-7.404-3.515
    c-2.554-1.004-5.104-1.819-7.656-2.446l-4.204-8.786c2.887,1.591,6.171,2.553,9.854,2.887c2.719,0.21,5.124-0.229,7.217-1.317
    c2.887-1.422,4.268-3.325,4.142-5.711c0-0.753-0.116-1.483-0.345-2.195c-0.23-0.711-0.565-1.34-1.005-1.884
    c-0.438-0.543-0.952-0.981-1.537-1.316c-0.587-0.335-1.108-0.513-1.569-0.533s-0.868,0-1.223,0.063
    c-0.356,0.063-0.701,0.179-1.036,0.345c0,1.674-0.712,3.2-2.134,4.581c-1.465,1.381-3.012,2.07-4.645,2.07
    c-1.046,0-2.009-0.323-2.887-0.973c-0.878-0.648-1.317-1.495-1.317-2.542c0-1.966,0.837-3.723,2.511-5.271
    c1.631-1.507,3.535-2.343,5.711-2.511c0-0.669-0.795-1.609-2.385-2.823h-12.552l-3.515-3.515h35.519L-546.286,436.688z">
                                    </path>
                                </g>
                            </g>

                            <path fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" d="M-529.566,422.149l0.501,0.833
    C-529.053,422.632-529.205,422.351-529.566,422.149z"></path>
                            <rect x="-529.316" y="422.08" fill="#0E660C" stroke="#9B9B9B" stroke-width="2"
                                stroke-miterlimit="10" width="0.001" height="0.974"></rect>

                            <g id="Rajshahi">
                                <a href="{{ url('/sub-category/rajshahi') }}"
                                    xlink:href="{{ url('/sub-category/rajshahi') }}">
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-765.286,595.673 -764.419,592.391
-765.384,589.979 -764.996,587.854 -765.769,585.729 -769.533,584.764 -769.823,578.586 -772.719,576.075 -780.443,567.579
-780.636,565.648 -780.54,556.67 -781.797,547.884 -781.797,545.567 -779.864,529.155 -779.673,520.563 -777.933,513.417
-777.643,508.881 -777.839,504.632 -778.416,501.833 -778.416,501.833 -778.416,501.833 -777.354,499.323 -775.037,496.522
-773.492,490.73 -773.492,487.834 -774.554,483.393 -774.264,480.883 -771.947,470.456 -772.046,465.629 -773.106,461.381
-774.46,458.967 -776.196,456.843 -779.962,453.271 -786.139,449.989 -789.714,447.575 -791.838,445.258 -794.635,439.659
-796.469,435.121 -801.49,410.213 -801.78,408.282 -800.621,388.973 -798.69,376.809 -795.89,364.451 -795.891,364.451
-798.615,364.172 -811.919,362.81 -816.041,362.81 -832.48,362.81 -852.368,356.245 -864.919,353.349 -878.822,361.362
-885.482,354.796 -890.792,343.019 -891.469,334.233 -900.061,332.109 -922.555,332.109 -943.217,331.433 -941.671,333.268
-941.188,335.488 -941.671,337.805 -943.217,340.025 -951.036,345.818 -952.871,348.329 -953.063,351.417 -952.484,354.507
-953.063,356.728 -956.925,357.596 -953.836,362.52 -959.146,362.134 -973.434,357.113 -976.137,355.858 -977.875,356.148
-979.227,357.79 -981.351,362.81 -982.992,364.065 -995.446,362.81 -1007.997,358.079 -1014.272,356.921 -1021.609,356.631
-1023.54,357.403 -1026.051,360.3 -1027.595,361.265 -1029.913,361.845 -1037.443,359.72 -1044.008,357.113 -1047.386,356.245
-1054.531,357.5 -1056.558,361.265 -1055.979,374.299 -1057.717,389.359 -1060.227,396.214 -1065.054,402.296 -1065.634,408.379
-1068.241,413.689 -1075.482,423.246 -1079.246,430.004 -1081.177,431.452 -1084.653,431.163 -1093.438,428.75 -1095.948,428.653
-1096.141,424.405 -1097.976,419.964 -1100.969,416.103 -1104.347,413.689 -1108.403,413.302 -1112.264,414.654 -1122.595,420.35
-1122.595,421.412 -1121.436,422.57 -1120.47,424.598 -1117.768,432.515 -1117.188,436.859 -1119.216,439.852 -1122.112,442.748
-1124.043,446.899 -1126.746,446.417 -1128.098,448.058 -1128.773,450.761 -1129.063,453.947 -1130.511,456.071 -1133.117,456.554
-1135.435,457.519 -1136.4,467.56 -1139.2,471.518 -1140.841,475.669 -1142,482.621 -1138.042,483.779 -1134.566,485.228
-1132.539,489.958 -1129.449,493.047 -1128.87,494.495 -1128.87,506.371 -1128.581,507.529 -1125.974,510.813 -1124.043,514.19
-1123.656,515.735 -1117.574,517.087 -1062.834,545.857 -1047.386,558.214 -1042.656,559.277 -1029.14,559.856 -1018.81,563.428
-1014.272,563.139 -1011.087,558.313 -1008.866,553.001 -1004.425,554.063 -997.571,558.214 -992.743,564.779 -991.585,573.758
-991.198,574.724 -990.715,578.489 -990.233,579.358 -990.908,581.482 -993.322,585.054 -993.998,586.985 -993.032,590.459
-989.75,595.48 -988.399,596.639 -983.378,599.342 -980.289,601.563 -978.647,602.431 -974.593,603.107 -970.731,602.238
-957.311,595.866 -954.511,593.936 -952.388,591.135 -948.236,591.425 -944.471,593.356 -942.83,594.708 -938.003,601.176
-930.375,608.513 -928.542,614.21 -924.293,619.616 -923.425,621.643 -923.425,621.644 -923.425,624.057 -923.425,624.058
-924.39,629.078 -923.81,631.105 -921.783,633.519 -913.77,640.469 -909.329,643.365 -904.791,645.489 -899.095,646.552
-881.814,644.717 -876.215,645.2 -871.949,646.148 -871.001,646.359 -866.077,648.483 -859.222,653.117 -840.593,661.131
-835.859,663.93 -827.462,671.557 -822.15,672.619 -818.481,671.46 -812.206,667.309 -808.827,665.958 -797.242,664.896
-792.51,663.641 -792.51,660.938 -794.635,650.317 -795.217,646.938 -794.345,641.918 -791.642,634.871 -773.782,620.002
-771.177,617.589 -769.244,614.403 -767.7,611.313 -767.12,603.204 -765.094,599.343 -765.674,598.956 ">
                                    </polygon>
                                </a>
                                <g class="rajshahi-dev">
                                    <path fill="#231F20"
                                        d="M-975.627,511.033v36.898l-1.945-2.321v0.063c-0.67-1.673-1.224-2.896-1.663-3.672
    c-0.438-0.773-1.141-1.757-2.103-2.949c-0.962-1.191-1.862-2.186-2.698-2.979c-3.012-2.763-7.008-4.394-11.986-4.896h0.063
    l-4.645-6.525c7.028-4.896,14.225-8.576,21.587-11.045v-2.573h-24.034l-3.452-3.515h34.577l3.514,3.515H-975.627L-975.627,511.033
    z M-993.888,541.155c0-1.045,0.355-1.914,1.066-2.604c0.711-0.689,1.569-1.035,2.573-1.035s1.86,0.346,2.573,1.035
    c0.711,0.69,1.066,1.561,1.066,2.604c0,0.963-0.355,1.81-1.066,2.541c-0.713,0.732-1.569,1.099-2.573,1.099
    s-1.862-0.365-2.573-1.099C-993.533,542.965-993.888,542.118-993.888,541.155z M-979.016,519.317
    c-2.259,0.837-4.55,1.841-6.872,3.012c-2.321,1.172-4.76,2.615-7.311,4.33c6.317,2.636,11.045,6.651,14.183,12.049V519.317z"></path>
                                    <path fill="#231F20" d="M-962.136,511.033v36.711l-3.389-3.514v-26.043c0-1.089-0.209-2.071-0.627-2.949
    c-0.418-0.879-0.994-1.621-1.726-2.229c-0.732-0.604-1.569-1.087-2.511-1.441c-0.94-0.355-1.913-0.534-2.918-0.534l-3.514-3.514
    h4.016c2.135,0,3.786,0.471,4.958,1.411s2.112,2.5,2.824,4.676c0-0.712-0.021-1.591-0.063-2.637
    c-0.042-1.045-0.125-2.278-0.251-3.702c-0.084-1.381-0.147-2.583-0.188-3.607c-0.042-1.024-0.063-1.894-0.063-2.604l1.255,1.066
    c0.418,2.511,1.149,4.31,2.195,5.397h2.511l3.452,3.514H-962.136L-962.136,511.033z"></path>
                                    <path fill="#231F20" d="M-913.188,511.033h-20.082c-0.586,0.042-1.182,0.305-1.788,0.785s-0.951,0.973-1.036,1.475
    c0,0.586,0.24,1.088,0.723,1.506c0.479,0.419,1.056,0.784,1.726,1.098c0.669,0.314,1.35,0.557,2.04,0.723
    c0.69,0.168,1.225,0.251,1.601,0.251c1.924,0.168,3.64,0.095,5.146-0.219c1.506-0.314,2.761-0.743,3.765-1.287l5.334,5.585
    c-1.925,1.883-3.389,4.205-4.393,6.966c-1.004,2.762-1.506,5.94-1.506,9.539c0,2.72,0.898,6.065,2.699,10.04l-3.452-0.941
    c-0.837-2.385-1.506-4.747-2.008-7.091c-0.502-2.343-0.775-4.832-0.816-7.468c0-3.43,0.753-7.007,2.259-10.73
    c-3.724,0-6.735-0.46-9.037-1.381c-2.427-0.962-4.728-2.845-6.902-5.646l-0.314-0.126c-0.586,0-1.191,0.293-1.819,0.879
    c-0.629,0.586-1.277,1.423-1.945,2.51c-1.381,2.218-2.071,3.933-2.071,5.146c0,1.716,0.919,2.572,2.761,2.572
    c0.417,0,0.962-0.104,1.632-0.313c0.669-0.209,1.422-0.522,2.259-0.941l3.891-2.009c1.506,0.67,2.845,2.03,4.017,4.079
    c0.585,1.089,1.045,2.134,1.381,3.138c0.334,1.005,0.502,1.925,0.502,2.763c0,2.595-0.983,4.916-2.95,6.966
    c-1.925,1.925-4.227,2.887-6.903,2.887c-6.065,0-10.438-3.284-13.115-9.853c-0.963-2.386-1.685-5.03-2.164-7.938
    c-0.481-2.907-0.723-6.182-0.723-9.821l1.82,1.13c-0.125,1.005-0.125,2.238,0,3.702c0.417,4.143,1.506,7.595,3.263,10.354
    c1.255,2.093,2.688,3.702,4.298,4.832c1.61,1.13,3.399,1.693,5.366,1.693c1.798,0,3.555-0.396,5.271-1.191
    c2.259-1.004,3.389-2.3,3.389-3.892c0-0.627-0.179-1.285-0.534-1.977c-0.355-0.69-0.869-1.035-1.538-1.035
    c-0.251,0-1.191,0.293-2.824,0.878c-1.465,0.587-2.72,0.879-3.765,0.879c-2.344,0-4.289-0.94-5.836-2.823
    c-1.591-1.841-2.385-3.975-2.385-6.4c0-1.422,0.543-3.075,1.631-4.958c1.171-1.924,2.405-3.367,3.703-4.33h-15.438l-3.514-3.514
    h44.932L-913.188,511.033z"></path>
                                    <path fill="#231F20" d="M-881.561,511.033v36.962l-3.64-3.577l0.251-22.528c0-1.464-0.795-3.282-2.385-5.459
    c-1.59-2.092-3.097-3.138-4.519-3.138c-0.921,0-1.81,0.282-2.667,0.847s-1.287,1.267-1.287,2.104
    c3.682,2.636,5.522,4.812,5.522,6.525c0,1.507-0.408,2.729-1.224,3.672c-0.816,0.94-1.978,1.579-3.483,1.913
    c-1.172-0.041-2.25-0.429-3.232-1.16s-1.705-1.788-2.165-3.169c-1.088,2.929-3.012,4.393-5.772,4.393
    c-1.255,0-2.291-0.512-3.106-1.537c-0.815-1.023-1.224-2.186-1.224-3.482c0-0.837,0.157-1.662,0.471-2.479
    c0.313-0.814,0.753-1.578,1.317-2.29c0.564-0.711,1.224-1.339,1.977-1.883c0.753-0.543,1.547-0.962,2.386-1.255
    c-1.675-2.971-3.641-4.466-5.899-4.487c-2.259-0.021-3.599-0.01-4.017,0.031l-3.515-3.514h7.531c1.84,0,3.577,0.689,5.208,2.069
    c1.631,1.381,2.636,3.056,3.012,5.021c2.133-4.771,5.083-7.154,8.849-7.154c1.296,0,2.99,1.235,5.083,3.703
    c1.924,2.301,3.115,4.184,3.576,5.646h0.188l-0.627-15.563l2.134,2.008c0.376,2.636,1.589,4.06,3.64,4.269l3.515,3.514
    L-881.561,511.033L-881.561,511.033z"></path>
                                    <path fill="#231F20" d="M-868.697,511.033v36.711l-3.389-3.514v-26.043c0-1.089-0.209-2.071-0.627-2.949
    c-0.418-0.879-0.994-1.621-1.727-2.229c-0.731-0.604-1.568-1.087-2.51-1.441c-0.941-0.355-1.914-0.534-2.918-0.534l-3.514-3.514
    h4.016c2.134,0,3.786,0.471,4.958,1.411c1.171,0.94,2.112,2.5,2.824,4.676c0-0.712-0.021-1.591-0.063-2.637
    c-0.042-1.045-0.125-2.278-0.251-3.702c-0.084-1.381-0.146-2.583-0.188-3.607c-0.042-1.024-0.063-1.894-0.063-2.604l1.255,1.066
    c0.418,2.511,1.15,4.31,2.196,5.397h2.51l3.452,3.514H-868.697L-868.697,511.033z"></path>
                                    <path fill="#231F20" d="M-829.539,511.033h-18.575c0.334,0.461,0.668,0.91,1.004,1.35c0.334,0.439,0.647,0.848,0.94,1.225
    c3.599,1.255,5.982,2.595,7.154,4.017c1.883,1.841,2.824,4.267,2.824,7.279c0,2.761-1.151,5.083-3.451,6.966
    c-1.674,1.422-4.289,2.614-7.844,3.576c2.385,1.423,4.926,3.285,7.625,5.585c2.698,2.302,5.617,5.042,8.754,8.221v-0.063
    l0.814,3.702c-1.674-1.883-3.514-3.65-5.521-5.303c-2.008-1.651-4.268-3.211-6.777-4.676c-2.385-1.338-4.854-2.51-7.404-3.514
    c-2.552-1.004-5.104-1.82-7.656-2.447l-4.205-8.786c2.887,1.591,6.17,2.553,9.854,2.887c2.719,0.21,5.123-0.229,7.216-1.316
    c2.887-1.422,4.268-3.326,4.142-5.711c0-0.753-0.116-1.484-0.345-2.196c-0.23-0.711-0.565-1.339-1.004-1.883
    c-0.439-0.543-0.952-0.982-1.537-1.317c-0.586-0.335-1.109-0.512-1.569-0.533c-0.461-0.021-0.869,0-1.224,0.063
    c-0.356,0.063-0.701,0.179-1.036,0.345c0,1.674-0.712,3.2-2.134,4.581c-1.466,1.381-3.012,2.071-4.645,2.071
    c-1.046,0-2.008-0.324-2.887-0.974c-0.879-0.648-1.318-1.495-1.318-2.542c0-1.966,0.837-3.723,2.511-5.271
    c1.631-1.506,3.535-2.342,5.71-2.51c0-0.67-0.796-1.61-2.385-2.824h-12.551l-3.515-3.515h35.519L-829.539,511.033z">
                                    </path>
                                    <path fill="#231F20" d="M-824.142,511.033v36.711l-3.451-3.514v-33.197h-5.146l-3.828-3.514h8.974
    c-1.716-9.915-8.43-14.873-20.144-14.873c-0.962,0-1.924,0.053-2.887,0.156c-0.963,0.104-1.924,0.282-2.888,0.533
    c-2.844,0.628-4.267,1.591-4.267,2.887c0,1.047,1.799,1.675,5.397,1.884c4.812,0.251,8.012,0.605,9.601,1.065
    c1.883,0.587,3.285,1.402,4.205,2.447c0.921,1.047,1.38,2.427,1.38,4.142c0,0.168-0.083,0.879-0.251,2.135h-3.515
    c1.005-0.712,1.507-1.548,1.507-2.511c0-1.339-1.778-2.195-5.334-2.572c-2.72-0.334-4.885-0.605-6.495-0.815
    c-1.61-0.209-2.646-0.355-3.106-0.439c-1.589-0.502-2.844-1.213-3.765-2.134c-0.92-0.92-1.38-2.027-1.38-3.326
    c0-1.129,0.438-2.143,1.317-3.043c0.879-0.898,2.112-1.704,3.702-2.416c1.256-0.46,2.596-0.848,4.017-1.16
    c1.423-0.313,2.804-0.472,4.142-0.472c11.421,0,18.826,6.172,22.214,18.514h3.389l3.452,3.514L-824.142,511.033L-824.142,511.033z
    "></path>
                                </g>
                            </g>
                            <g id="Rangpur">
                                <a href="{{ url('/sub-category/rangpur') }}"
                                    xlink:href="{{ url('/sub-category/rangpur') }}">
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-766.155,245.605 -770.885,233.923
-774.747,213.07 -773.975,207.374 -764.997,191.444 -764.031,185.941 -765.769,184.589 -768.955,184.3 -772.912,181.886
-768.858,180.438 -765.865,178.024 -765.286,174.838 -768.279,170.977 -769.342,171.17 -770.788,172.715 -772.14,173.293
-773.395,172.907 -776.196,168.177 -780.443,162.578 -781.601,160.453 -781.891,156.398 -781.408,153.502 -781.698,150.605
-784.402,146.745 -786.045,143.558 -787.01,139.793 -788.263,136.317 -790.677,134.29 -792.608,134.097 -796.76,134.483
-798.303,134.29 -800.814,133.132 -801.01,131.684 -800.719,121.836 -801.878,118.36 -805.641,117.588 -810.179,119.133
-811.629,121.063 -811.144,128.111 -809.795,130.814 -809.888,131.973 -814.233,130.622 -815.681,130.814 -818.481,132.746
-820.702,136.993 -819.351,139.89 -815.875,141.531 -812.013,142.013 -814.524,143.655 -817.516,145.2 -819.835,147.13
-819.835,149.833 -817.711,150.896 -814.813,150.316 -812.11,150.413 -810.565,153.309 -812.302,157.268 -821.474,164.895
-823.215,171.267 -823.019,174.355 -823.598,177.349 -825.048,179.473 -827.846,180.052 -829.97,178.894 -831.804,176.383
-834.8,171.267 -837.79,170.301 -849.088,171.267 -850.244,171.652 -853.237,171.267 -856.423,166.536 -858.837,166.536
-861.346,168.853 -864.725,170.784 -868.104,170.397 -872.353,168.467 -876.118,165.86 -881.138,159.971 -888.476,156.592
-890.214,154.468 -891.565,150.027 -893.689,147.13 -896.778,145.103 -910.584,139.021 -913.191,136.028 -914.736,131.876
-916.473,117.781 -918.018,114.112 -922.169,107.065 -923.521,103.3 -923.714,97.024 -921.301,96.734 -918.307,98.183
-916.473,97.217 -916.57,94.031 -918.115,92.39 -923.038,90.942 -926.513,89.397 -926.804,87.853 -926.128,85.825 -927.094,83.025
-928.927,81.48 -933.465,80.322 -935.782,79.356 -937.713,77.812 -940.803,74.143 -943.217,72.984 -946.498,70.475 -948.429,68.544
-950.36,67.964 -953.739,69.605 -956.442,72.116 -959.049,76.074 -960.691,80.418 -960.594,84.377 -956.25,89.011 -950.264,91.038
-945.147,93.741 -943.217,100.403 -941.865,102.237 -940.223,102.817 -938.292,102.334 -936.361,101.079 -937.134,106.003
-935.589,107.547 -933.176,107.644 -930.858,108.32 -929.797,112.664 -933.948,115.657 -943.217,117.974 -949.105,115.946
-958.277,106.679 -963.973,105.617 -968.125,108.513 -971.31,116.14 -974.593,117.491 -978.068,115.851 -980.095,112.567
-981.448,108.609 -983.089,105.037 -990.619,102.141 -1008.19,108.609 -1011.859,106.003 -1010.314,104.265 -1002.687,100.403
-999.984,98.086 -998.053,93.838 -998.536,90.942 -1001.335,88.722 -1006.162,86.211 -1007.418,84.474 -1007.128,80.418
-1010.507,79.067 -1011.087,77.522 -1010.604,75.495 -1009.735,73.564 -1014.562,72.405 -1019.003,69.896 -1020.741,67.771
-1023.251,62.848 -1025.761,61.689 -1030.202,61.786 -1031.94,61.593 -1036.671,59.565 -1040.822,56.669 -1044.78,52.421
-1047.386,50.297 -1050.09,47.111 -1053.469,45.566 -1060.807,43.249 -1063.606,40.16 -1064.186,35.525 -1063.992,30.602
-1064.282,26.257 -1066.213,25.002 -1068.916,27.802 -1071.427,32.146 -1072.971,35.429 -1077.219,50.394 -1079.922,55.028
-1081.081,58.117 -1080.887,61.979 -1079.246,65.068 -1076.543,65.84 -1075.578,64.489 -1074.999,59.082 -1074.323,57.538
-1072.778,57.441 -1067.95,59.565 -1055.979,61.882 -1050.38,64.585 -1047.386,69.605 -1043.236,82.253 -1042.753,88.142
-1047.386,87.37 -1051.055,88.045 -1052.986,87.949 -1056.558,85.922 -1057.717,86.887 -1058.682,89.011 -1060.227,91.038
-1070.074,97.217 -1073.26,100.113 -1076.35,104.651 -1077.122,108.03 -1076.833,116.429 -1078.474,119.905 -1082.142,122.222
-1094.307,126.374 -1098.652,127.339 -1100.872,128.208 -1103.672,131.394 -1105.506,133.035 -1112.361,137.476 -1114.099,140.276
-1116.416,147.806 -1117.381,150.316 -1117.092,152.537 -1116.32,153.695 -1113.906,155.819 -1113.616,158.33 -1115.065,162.771
-1120.278,166.922 -1124.332,174.742 -1128.194,187.872 -1130.994,191.348 -1129.449,201.678 -1128.001,205.153 -1128.29,209.305
-1125.009,212.974 -1124.043,215 -1122.595,219.442 -1119.892,222.242 -1116.03,222.049 -1111.878,220.214 -1108.403,218.187
-1099.135,215.483 -1092.377,218.959 -1079.729,233.73 -1064.572,244.061 -1059.069,250.336 -1058.2,264.528 -1055.303,267.424
-1047.386,271.383 -1045.262,276.017 -1039.663,280.361 -1038.022,283.74 -1035.995,285.768 -1031.65,286.637 -1022.768,287.022
-1018.714,288.954 -1011.956,293.395 -1007.612,294.457 -1005.198,293.781 -1001.529,289.629 -999.308,287.795 -997.667,287.505
-993.805,287.892 -991.681,286.926 -991.874,282.871 -985.502,285.382 -983.668,286.926 -981.158,290.016 -978.551,292.429
-976.62,295.422 -976.331,300.346 -979.903,308.552 -979.806,310 -977.586,311.641 -977.007,313.572 -976.813,315.793
-975.944,318.303 -971.021,324.482 -969.475,325.737 -967.352,326.316 -963.008,326.605 -958.277,331.24 -953.353,331.916
-943.217,331.433 -922.555,332.109 -900.061,332.109 -891.469,334.232 -890.792,343.018 -885.482,354.796 -878.822,361.361
-864.919,353.349 -852.368,356.245 -832.48,362.81 -816.041,362.81 -811.919,362.81 -798.615,364.172 -795.891,364.451
-791.258,354.507 -789.325,351.417 -786.815,348.521 -783.726,343.983 -782.567,338.191 -784.402,325.64 -779.673,314.248
-777.839,310.869 -774.844,308.938 -771.368,308.262 -771.079,305.945 -769.746,300.998 -766.348,288.374 -765.963,270.996
-764.03,254.68 ">
                                    </polygon>
                                    <polygon fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10"
                                        points="-777.839,310.869 -774.844,308.938
-771.368,308.262 -774.844,308.938 -777.839,310.869 -779.673,314.248 -784.402,325.64 -779.673,314.248 ">
                                    </polygon>
                                    <path fill="#0E660C" stroke="#9B9B9B" stroke-width="2" stroke-miterlimit="10" d="M-795.891,364.451l-2.724-0.279L-795.891,364.451
    z"></path>
                                </a>
                                <g class="rangpur-dev">
                                    <path fill="#231F20"
                                        d="M-930.704,245.987v36.899l-1.945-2.322v0.063c-0.67-1.673-1.224-2.896-1.663-3.672
    c-0.438-0.773-1.141-1.757-2.103-2.949c-0.962-1.192-1.862-2.186-2.698-2.98c-3.012-2.762-7.008-4.393-11.986-4.895h0.063
    l-4.645-6.526c7.028-4.896,14.225-8.576,21.588-11.045v-2.573h-24.035l-3.452-3.514h34.577l3.514,3.514H-930.704z
     M-948.966,276.109c0-1.045,0.354-1.914,1.065-2.604s1.569-1.035,2.573-1.035s1.861,0.345,2.573,1.035
    c0.711,0.69,1.066,1.56,1.066,2.604c0,0.963-0.355,1.81-1.066,2.541c-0.712,0.733-1.569,1.099-2.573,1.099
    s-1.862-0.365-2.573-1.099C-948.611,277.919-948.966,277.072-948.966,276.109z M-934.093,254.271
    c-2.26,0.837-4.551,1.841-6.872,3.012c-2.322,1.172-4.761,2.615-7.312,4.33c6.317,2.636,11.045,6.651,14.184,12.049V254.271z"></path>
                                    <path fill="#231F20" d="M-906.545,251.636c0,2.134-0.732,4.058-2.197,5.773c-1.422,1.59-3.2,2.384-5.334,2.384
    c-2.259,0-4.204-0.815-5.836-2.447c-1.631-1.631-2.447-3.598-2.447-5.898c0-1.004,0.188-1.986,0.564-2.949
    c0.377-0.962,0.982-1.861,1.819-2.698c1.631-1.716,3.473-2.573,5.522-2.573c2.217,0,4.079,0.857,5.585,2.573
    C-907.32,247.473-906.545,249.418-906.545,251.636z M-903.909,283.013c-1.297-1.297-2.698-2.594-4.204-3.892
    c-1.506-1.296-3.034-2.52-4.581-3.671c-1.548-1.15-3.075-2.237-4.581-3.263c-1.506-1.025-2.908-1.914-4.205-2.667v-7.907
    c2.762,2.134,5.857,5.031,9.288,8.691c3.43,3.661,6.191,6.956,8.283,9.884V283.013L-903.909,283.013z M-909.933,249.815
    c0-2.008-0.837-3.012-2.51-3.012c-1.632,0-3.097,0.712-4.393,2.134c-0.586,0.669-1.035,1.411-1.35,2.228
    c-0.313,0.815-0.471,1.643-0.471,2.479c0,1.842,0.711,2.761,2.134,2.761c1.715,0,3.242-0.668,4.581-2.008
    C-910.603,253.101-909.933,251.572-909.933,249.815z"></path>
                                    <path fill="#231F20" d="M-869.709,245.987v36.648l-3.766-3.64l0.502-18.764c0-0.543-0.125-1.139-0.376-1.788
    c-0.251-0.648-0.606-1.35-1.066-2.103c-0.461-0.711-0.921-1.317-1.381-1.819s-0.9-0.92-1.317-1.256l-12.363,12.426l-5.02-1.82
    c2.426-2.3,3.64-4.12,3.64-5.459c0-2.426-0.712-3.64-2.134-3.64c-0.335,0-0.69,0.063-1.067,0.188
    c-0.376,0.126-0.857,0.294-1.442,0.503c-1.046,0.46-1.882,0.689-2.51,0.689c-0.713,0-1.351-0.292-1.914-0.878
    c-0.565-0.586-0.848-1.233-0.848-1.945c0-1.256,0.449-2.511,1.35-3.766c0.898-1.255,2.165-2.426,3.796-3.514
    c1.506-0.962,3.012-1.694,4.519-2.197c1.506-0.502,2.928-0.753,4.268-0.753c5.146,0,9.936,3.787,14.371,11.358l0.125-0.063
    c-0.125-3.054-0.272-6.128-0.439-9.225c-0.167-3.096-0.313-6.191-0.439-9.288l1.569,1.318c0.208,1.883,0.397,3.097,0.564,3.64
    c0.502,1.172,1.4,1.757,2.698,1.757c0.334,0,0.711-0.041,1.13-0.125l3.514,3.514h-5.962V245.987z M-880.126,249.564
    c-1.632-1.798-3.474-2.698-5.522-2.698c-3.891,0-6.631,1.591-8.221,4.77c1.882,0,3.252,0.627,4.109,1.882
    c0.857,1.256,1.183,2.824,0.974,4.707L-880.126,249.564z"></path>
                                    <path fill="#231F20"
                                        d="M-861.74,294.057c-0.627-0.837-1.318-1.685-2.071-2.541c-0.753-0.858-1.538-1.674-2.354-2.447
    c-0.815-0.775-1.631-1.486-2.447-2.134c-0.816-0.649-1.579-1.183-2.291-1.601c-1.84,2.594-4.225,3.995-7.154,4.205
    c-1.798,0-3.389-0.481-4.77-1.443c-1.338-1.005-2.008-2.322-2.008-3.954c0-0.837,0.178-1.6,0.533-2.29s0.826-1.287,1.411-1.789
    c0.586-0.502,1.267-0.888,2.04-1.16c0.774-0.272,1.58-0.408,2.416-0.408c1.339,0,3.055,0.627,5.146,1.883
    c0.293-0.628,0.388-1.538,0.283-2.73s-0.24-2.248-0.408-3.169l3.514,2.009c0.21,1.004,0.304,1.967,0.283,2.886
    c-0.021,0.921-0.073,1.883-0.157,2.887c0.921,0.795,1.873,1.684,2.855,2.667c0.982,0.983,1.894,1.956,2.729,2.919
    c0.711,0.836,1.225,1.495,1.537,1.978c0.314,0.479,0.617,0.973,0.91,1.475L-861.74,294.057L-861.74,294.057z M-877.679,281.82
    c-2.342,0.042-3.555,0.753-3.64,2.133c0,1.088,0.586,1.736,1.757,1.945c1.004,0.126,2.05-0.063,3.139-0.564
    c0.963-0.627,1.61-1.276,1.944-1.945c-0.417-0.461-0.888-0.805-1.412-1.035C-876.413,282.124-877.009,281.945-877.679,281.82z"></path>
                                    <path fill="#231F20"
                                        d="M-837.893,245.987v36.899l-1.945-2.322v0.063c-0.67-1.673-1.224-2.896-1.663-3.672
    c-0.438-0.773-1.141-1.757-2.103-2.949c-0.962-1.192-1.862-2.186-2.698-2.98c-3.012-2.762-7.008-4.393-11.985-4.895h0.063
    l-4.644-6.526c7.028-4.896,14.224-8.576,21.587-11.045v-2.573h-24.035l-3.452-3.514h34.577l3.514,3.514H-837.893z
     M-856.155,276.109c0-1.045,0.355-1.914,1.066-2.604s1.568-1.035,2.572-1.035s1.861,0.345,2.573,1.035
    c0.711,0.69,1.066,1.56,1.066,2.604c0,0.963-0.355,1.81-1.066,2.541c-0.712,0.733-1.569,1.099-2.573,1.099
    s-1.861-0.365-2.572-1.099C-855.8,277.919-856.155,277.072-856.155,276.109z M-841.282,254.271
    c-2.259,0.837-4.55,1.841-6.872,3.012c-2.322,1.172-4.76,2.615-7.311,4.33c6.316,2.636,11.044,6.651,14.183,12.049V254.271z"></path>
                                </g>
                            </g>

                            <g>
                                <path fill="#DB2028" d="M-359.575,434.156c0-10.679-8.656-19.333-19.335-19.333c-10.68,0-19.334,8.655-19.334,19.333
    c0,15.299,19.334,37.939,19.334,37.939S-359.575,449.376-359.575,434.156z M-388.445,433.001c0-5.268,4.271-9.537,9.537-9.537
    s9.535,4.269,9.535,9.537s-4.269,9.537-9.535,9.537S-388.445,438.269-388.445,433.001z"></path>
                                <circle fill="#FFFFFF" cx="-378.91" cy="433.001" r="4.689"></circle>
                            </g>
                            <g>
                                <path fill="#DB2028" d="M-651.575,390.156c0-10.679-8.656-19.333-19.335-19.333c-10.68,0-19.334,8.655-19.334,19.333
    c0,15.299,19.334,37.939,19.334,37.939S-651.575,405.376-651.575,390.156z M-680.445,389.001c0-5.268,4.271-9.537,9.537-9.537
    s9.535,4.269,9.535,9.537s-4.269,9.537-9.535,9.537S-680.445,394.269-680.445,389.001z"></path>
                                <circle fill="#FFFFFF" cx="-670.91" cy="389.001" r="4.689"></circle>
                            </g>
                            <g>
                                <path fill="#DB2028" d="M-879.575,200.156c0-10.679-8.656-19.333-19.335-19.333c-10.68,0-19.334,8.655-19.334,19.333
    c0,15.299,19.334,37.939,19.334,37.939S-879.575,215.376-879.575,200.156z M-908.445,199.001c0-5.268,4.271-9.537,9.537-9.537
    s9.535,4.269,9.535,9.537s-4.269,9.537-9.535,9.537S-908.445,204.269-908.445,199.001z"></path>
                                <circle fill="#FFFFFF" cx="-898.91" cy="199.001" r="4.689"></circle>
                            </g>
                            <g>
                                <path fill="#DB2028" d="M-886.575,462.156c0-10.679-8.656-19.333-19.335-19.333c-10.68,0-19.334,8.655-19.334,19.333
    c0,15.299,19.334,37.939,19.334,37.939S-886.575,477.376-886.575,462.156z M-915.445,461.001c0-5.268,4.271-9.537,9.537-9.537
    s9.535,4.269,9.535,9.537s-4.269,9.537-9.535,9.537S-915.445,466.269-915.445,461.001z"></path>
                                <circle fill="#FFFFFF" cx="-905.91" cy="461.001" r="4.689"></circle>
                            </g>
                            <g>
                                <path fill="#DB2028" d="M-267.575,933.156c0-10.68-8.656-19.334-19.335-19.334c-10.68,0-19.334,8.654-19.334,19.334
    c0,15.299,19.334,37.938,19.334,37.938S-267.575,948.376-267.575,933.156z M-296.445,932.001c0-5.268,4.271-9.536,9.537-9.536
    s9.535,4.269,9.535,9.536s-4.269,9.537-9.535,9.537S-296.445,937.269-296.445,932.001z"></path>
                                <circle fill="#FFFFFF" cx="-286.91" cy="932.001" r="4.688"></circle>
                            </g>
                            <g>
                                <path fill="#DB2028" d="M-657.575,594.156c0-10.68-8.656-19.334-19.335-19.334c-10.68,0-19.334,8.654-19.334,19.334
    c0,15.299,19.334,37.938,19.334,37.938S-657.575,609.376-657.575,594.156z M-686.445,593.001c0-5.268,4.271-9.536,9.537-9.536
    s9.535,4.269,9.535,9.536s-4.269,9.537-9.535,9.537S-686.445,598.269-686.445,593.001z"></path>
                                <circle fill="#FFFFFF" cx="-676.91" cy="593.001" r="4.688"></circle>
                            </g>
                            <g>
                                <path fill="#DB2028" d="M-644.575,913.156c0-10.68-8.656-19.334-19.335-19.334c-10.68,0-19.334,8.654-19.334,19.334
    c0,15.299,19.334,37.938,19.334,37.938S-644.575,928.376-644.575,913.156z M-673.445,912.001c0-5.268,4.271-9.536,9.537-9.536
    s9.535,4.269,9.535,9.536s-4.269,9.537-9.535,9.537S-673.445,917.269-673.445,912.001z"></path>
                                <circle fill="#FFFFFF" cx="-663.91" cy="912.001" r="4.688"></circle>
                            </g>
                            <g>
                                <path fill="#DB2028" d="M-840.575,846.156c0-10.68-8.656-19.334-19.335-19.334c-10.68,0-19.334,8.654-19.334,19.334
    c0,15.299,19.334,37.938,19.334,37.938S-840.575,861.376-840.575,846.156z M-869.445,845.001c0-5.268,4.271-9.536,9.537-9.536
    s9.535,4.269,9.535,9.536s-4.269,9.537-9.535,9.537S-869.445,850.269-869.445,845.001z"></path>
                                <circle fill="#FFFFFF" cx="-859.91" cy="845.001" r="4.688"></circle>
                            </g>
                            <style type="text/css">
                            #Khulna:hover polygon {
                                fill: #0c4d0b;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Khulna:hover .khulna-dev path {
                                fill: #fff;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Barishal:hover polygon {
                                fill: #0c4d0b;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Barishal:hover .barishal-dev path {
                                fill: #fff;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Chittagong:hover polygon {
                                fill: #0c4d0b;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Chittagong:hover .chittagong-dev path {
                                fill: #fff;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Rajshahi:hover polygon {
                                fill: #0c4d0b;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Rajshahi:hover .rajshahi-dev path {
                                fill: #fff;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Sylhet:hover path {
                                fill: #0c4d0b;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Sylhet:hover .sylhet-dev path {
                                fill: #fff;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Mymensingh:hover path {
                                fill: #0c4d0b;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Mymensingh:hover .mymensingh-dev path {
                                fill: #fff;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Rangpur:hover polygon {
                                fill: #0c4d0b;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Rangpur:hover .rangpur-dev path {
                                fill: #fff;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Dhaka:hover path {
                                fill: #0c4d0b;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }

                            #Dhaka:hover .dhaka-dev path {
                                fill: #fff;
                                cursor: pointer;
                                transition: all 0.5s ease 0s;
                            }
                            </style>
                        </svg>

                    </div>
                    <!--/.bangladesh Map-->

                    <div class="single-block">
                        <div class="map-heading">
                            <h2> জাতীয় সঙ্গীত </h2>
                        </div>
                        <audio controls="" style="width:100%">
                            <source src="{{asset('assets/frontend/assets/frontend/bd_national_anthem.mp3')}}"
                                type="audio/mp3">
                        </audio>
                    </div>
                </div>
                <!--/.single-block-->
            </div>
            <!--/.col-md-12-->
        </div>
        <!--/.international-news-right-->
    </div>
    <!--/.row-->
    </div>
    <!--/.container-->
</section>
<!--/.international-->
<section class="photo-gallery-wrapper bg-white">
    <div class="container custom-container">
        <div class="photo-gallery-heading">
            <h2><a href="photo.html"> ফটো গ্যালারি</a></h2>
        </div>
        <!--/.photo-gallery-heading-->
        <div class="row custom-row">
        <div class="photo-gallery-left">
    <div class="col-md-12 custom-padding">
        <div id="gallery-images-section" class="owl-carousel">
            @foreach ($galleryImages->take(5) as $gallery)
            <li data-thumb="{{ asset($gallery->url) }}" style="list-style:none;">
                <img class="img-fluid" src="{{ asset('/img/galleries/'. $gallery->image) }}" />
                <a class="photo-gallery-text" href="#">
                    <h3 style="font-size:20px;">{{ $gallery->note }}</h3>
                </a>
            </li>
            @endforeach
        </div>
    </div>
</div>

<div class="photo-gallery-right">
    <div class="col-md-12 custom-padding">
        <div class="row custom-row">
            <div class="col-md-12 custom-padding">
                <ul class="photo-gallery-ul col-md-12">
                    @foreach ($galleryImages->skip(5)->take(4) as $image)
                    <li>
                        <a href="{{ asset($image->link) }}">
                            <i class="fa fa-camera" aria-hidden="true"></i>
                            <div class="photo-gallery-ul-left">
                                <img class="img-fluid" src="{{ asset('/img/galleries/'. $gallery->image) }}" alt="{{ $gallery->note }}">
                            </div>
                            <div class="photo-gallery-ul-right">
                                <h2>{{ $gallery->note }}</h2>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <!--/.photo-gallery-ul-->
            </div>
            <!--/.col-md-12-->
        </div>
        <!--/.row-->
    </div>
    <!--/.col-md-12-->
</div>

            <!--/.photo-gallery-right-->

        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
<!--/.photo-gallery-wrapper-->




@endsection