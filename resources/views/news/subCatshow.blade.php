@extends('layouts.news')
<!-- This is SEO Section Start -->

@section('title', 'Subcategory: ' . $subCategory->name)
@section('description', 'Browse through the latest updates in ' . $subCategory->name . ' subCategory.')
@section('keywords', 'news, updates, ' . $subCategory->name)

@section('og_title', 'Subcategory: ' . $subCategory->name)
@section('og_description', 'Explore the latest updates and articles in ' . $subCategory->name . ' subcategory at News 52.')
@section('og_image', asset('images/subCategory-banner.jpg'))
@section('og_url', url()->current())

@section('schema')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "headline": "Subcategory: {{ $subCategory->name }}",
  "url": "{{ url()->current() }}",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "url": "{{ url()->current() }}"
  },
  "hasPart": [
    @foreach($posts as $post)
      {
        "@type": "NewsArticle",
        "headline": "{{ $post->title }}",
        "url": "{{ url('news/'.$post->slug) }}"
      } @if(!$loop->last), @endif
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
                    <li><a href="#"><i class="fa fa-home"></i></a></li>
                    <li class="active"><a href="#">সারাদেশ</a></li>
                    <li class="active"><a href="#">{{$subCategory->name}}</a></li>
                </ol>
                <!--/.details-page-breadcrumb-->
                
                <!-- Other Posts -->
                <div class="row custom-row content_list">
                @if($posts->isEmpty())
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="text-danger text-danger text-center">No posts available.</h3>
                            </div>
                        </div>
                        
                    </div>
                @else
                    @foreach ($posts as $post)
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
                @endif

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



                                    @foreach($last_post as $post)
                                    <li><a
                                            href="{{ route('single', $post->slug) }}">
                                            <div class="least-news-left">
                                                <img src="{{ asset('img/posts/' . $post->image) }}"
                                                    class="img-fluid"
                                                    alt="{{ $post->title }}"
                                                    title="{{ $post->title }}" />
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
                                                    title="{{ $post->title }}" />
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