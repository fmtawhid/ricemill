@extends('layouts.news')

<!-- This is SEO Section Start -->

@section('title', $post->title)
@section('description', $post->short_summary)
@section('keywords', $post->tags, $post->keywords)

@section('og_title', $post->title)
@section('og_description', $post->short_summary)
@section('og_image', asset($post->image))
@section('og_url', url()->current())

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "{{ $post->title }}",
  "description": "{{ $post->short_summary }}",
  "image": "{{ asset('/img/posts/' . $post->image) }}",
  "author": {
    "@type": "Person",
    "name": "{{ $post->author_name }}"
  },
  "publisher": {
    "@type": "Organization",
    "name": "News 52",
    "logo": {
      "@type": "ImageObject",
      "url": "{{ asset('assets/frontend/image/1727430350fav.png') }}"
    }
  },
  "datePublished": "{{ $post->date }}",
  "dateModified": "{{ $post->updated_at->toIso8601String() }}",
  "url": "{{ url()->current() }}"
}
</script>
@endsection

<!-- This is SEO Section End -->


@section('content')
    <div class="container custom-container">
        <div class="row custom-row">
            <div class="left-content-area details-left-content-area">
                <div class="col-lg-12 custom-padding">

                    <ol class="breadcrumb details-page-breadcrumb">
                        <li><a href="{{ route('home') }}"><i class="fa fa-home"></i></a></li>
                        <li class="active"><a href=""> {{ $post->title }} </a></li>
                    </ol><!--/.details-page-breadcrumb-->
                    <div class="details-content">
                        <h3>{{ $post->title }}</h3>
                        <hr>
                        <small class="small">


                            <img style="width: 50px;
                                height: 50px;
                                border-radius: 21px;float: left;margin-right: 9px;"
                                class="img-fluid writer-image"
                                src="{{ asset('assets/frontend/image/dummy.png') }}"
                                alt="FavIcon">


                            <div class="writer-name">
                                {{ $post->author_name ?? 'Admin' }} <br>
                                নিউজ প্রকাশের তারিখ : {{ $post->date }} ইং </div>
                        </small>
                        <img class="img-fluid" src="{{ asset('img/posts/' . $post->image) }}"
                            alt="{{ $post->title }}">
                        <!-- <img alt="ad728" border="0"
                            src="{{ asset('img/posts/' . $post->image) }}"
                            title="ad728"> -->
                        <p style="text-align: justify;">
                        <div style="text-align: justify;">
                            {!! $post->description !!}
                        </div>
                        </p>
                        @if($post->video_link)
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $post->video_link }}" title="Video Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        @else
                            <p style="text-align: justify;"></p> <!-- এখানে আপনি কোনো পরিবর্তন করতে পারেন -->
                        @endif

                        <p style="text-align: justify;"></p>


                        <!-- <ul class="tag-ul">
                            <li> সংবাদটি প্রিন্ট করুন: </li>
                            <li><a
                                    href="https://news.rafusoft.com/print/521/সালমান-শাহ:-ইস্কাটন-রোডের-ফ্ল্যাটে-কী-হয়েছিল-সেই-শুক্রবারে">প্রিন্ট
                                    করুন</a></li>
                        </ul> -->
                    </div><!--/.details-content-->

                    <!-- <div class="facebook-comment-box">
                        <h2 class="fb-h2" style="">আপনার মতামত লিখুন :</h2>
                        <div id="fb-root"></div>
                        <script async defer crossorigin="anonymous"
                            src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v20.0&appId=1716117305495236" nonce="OKS9Fdbx">
                        </script>
                        <div class="fb-comments"
                            data-href="https://news.rafusoft.com/details/521/সালমান-শাহ:-ইস্কাটন-রোডের-ফ্ল্যাটে-কী-হয়েছিল-সেই-শুক্রবারে"
                            data-width="700" data-numposts="10"></div>

                    </div>/.facebook-comment-box -->


                </div><!--/.col-lg-12-->
            </div><!--/.left-content-area-->

            <div class="right-content-area details-right-content-area">
                <div class="col-lg-12 custom-padding">

                    <div class="details-page-side-banner">
                        <img border="0" data-original-height="250" data-original-width="300"
                            src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEhSIS1TdPaigibldvKuaRtAMXv_8a-gpBEedpOhcuTTIq9hbG3AnKt46xl3rRz7yMmSmaIuyo0IsyLOr9hL94ohj7QCa5BGLMSOJUnDkTcA7PCD_hHEBFGYyIgdRZEl-U4zadk1Kft73IQL_vHVUaUTu3Ub5axgN06PwjbPz9Lq8jUIM1yz-uw_aUVWmfsq/s16000/ibbl.gif">
                    </div><!--/.details-page-side-banner-->

                    <div class="details-right-news-heading">

                        <h2>আলোচিত শীর্ষ ১০ সংবাদ </h2>
                    </div><!--/.details-right-news-heading-->
                    <div class="row custom-row">


                        <!-- Loop through postsWithNewsType5 and display them -->
                        @foreach($postsWithNewsType5->take(10) as $post)
                            <div class="col-lg-6 col-md-6 col-6">
                                <div class="details-news-single">
                                    <!-- Use dynamic URLs with route helper -->
                                    <a href="{{ route('single', $post->slug) }}">
                                        <img src="{{ asset('/img/posts/' . $post->image) }}" 
                                            class="img-fluid" 
                                            alt="{{ $post->title }}" 
                                            title="{{ $post->title }}" />
                                        <div class="details-news-single-text">
                                            <span></span>
                                            <h3>{{ $post->title }}</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach


                        
                    </div><!--/.row-->

                </div><!--/.details-right-news-->

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



                                @foreach ($latestPosts as $post)
                                    <li>
                                        <a href="{{ route('single', $post->slug) }}">
                                            <div class="least-news-left">
                                                <!-- Display the post's image dynamically -->
                                                <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid" alt="{{ $post->title }}" title="{{ $post->title }}" />
                                            </div>
                                            <div class="least-news-right">
                                                <!-- Display the post's title dynamically -->
                                                <h3>{{ $post->title }}</h3>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach



                                    


                                </ul><!--/.least-news-ul-->
                            </div><!--/.least-news-->
                        </div><!--/.tab-pane-->

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">
                            <div class="least-news">
                                <ul class="least-news-ul detail-least-news-ul">



                                @foreach ($popularPosts as $post)
                                    <li>
                                        <a href="{{ route('single', $post->slug) }}">
                                            <div class="least-news-left">
                                                <!-- Display the post's image dynamically -->
                                                <img src="{{ asset('img/posts/' . $post->image) }}" class="img-fluid" alt="{{ $post->title }}" title="{{ $post->title }}" />
                                            </div>
                                            <div class="least-news-right">
                                                <!-- Display the post's title dynamically -->
                                                <h3>{{ $post->title }}</h3>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach




                                </ul><!--/.least-news-ul-->
                            </div><!--/.least-news-->
                        </div><!--/.tab-pane-->

                    </div><!--/.tab-content-->
                </div><!--/.details-tab-container-->

            </div><!--/.col-lg-12-->
        </div><!--/.right-content-area-->
    </div><!--/.row-->
    </div><!--/.container-->
@endsection
