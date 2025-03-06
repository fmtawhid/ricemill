<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
@inject('settings', 'App\Models\Setting')
@php
    $setting = $settings::find(1);
@endphp
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title', '{{ $setting->name }}')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'News 52 provides breaking news and updates in every niche and category.')">
    <meta name="keywords" content="@yield('keywords', 'breaking news, updates, niche news, bangladesh, politics, entertainment')">

    <!-- OpenGraph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', 'News 52 - Latest News Updates')" />
    <meta property="og:description" content="@yield('og_description', 'Stay updated with the latest news and updates in all categories at News 52.')" />
    <meta property="og:image" content="@yield('og_image', asset('assets/frontend/image/1727430350fav.png'))" />
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:site_name" content="News 52" />
    @yield('schema')
    <!-- <title> {{ $setting->name }}</title>
    <meta name="description" content="This is A Professional News Protal Website in Bangladesh.">
    <meta name="keywords" content="Songbad">
    <meta property="og:title" content="সংবাদ ৫২" />
    <meta property="og:type" content="website" />
    <meta property="og:URL" content="index.html" />
    <meta property="og:image"
        content="https://news.rafusoft.com/assets/images/logo/1726830883Screenshot_1.jpg />
    <meta property="og:description"
        content="This is A Professional News Protal Website in Bangladesh." /> -->
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/setting/' . $setting->favicon) }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open%20Sans&amp;display=swap" rel="stylesheet">
    <!--==== BASE CSS ====-->
    <link href="{{ asset('assets/frontend/assets/frontend/asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/frontend/asset/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('assets/frontend/assets/frontend/asset/css/menu.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/frontend/assets/frontend/asset/css/owl.carousel.css') }}" rel="stylesheet">
    <!--==== CUSTOM CSS ====-->
    <link href="{{ asset('assets/frontend/assets/frontend/asset/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/frontend/assets/frontend/asset/css/responsive.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/frontend/assets/frontend/eror/css/style.css') }}" />
    <link rel="stylesheet" id="color"
        href="{{ asset('assets/frontend/assets/front/css/colore0ee.css?base_color=0d3852&amp;footer_color=1f3f66&amp;copyright_color=0a0102') }}">
    <link rel="stylesheet" id="color"
        href="{{ asset('assets/frontend/assets/front/css/font68b4.html?font_familly=Open%20Sans') }}">
    <meta name="google-site-verification" content="27TFL9sedPA39difsO1J02G4qVJMOtna3LZv_0K4w6A" />
    <meta name="google-site-verification" content="27TFL9sedPA39difsO1J02G4qVJMOtna3LZv_0K4w6A" />
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-F758S21JWX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-F758S21JWX');
    </script>

<style>
  
  /* Full-Screen Loader */
    #loader-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        z-index: 9999;
    }

    /* Loader Logo */
    .loader-logo {
        width: 150px;
        height: auto;
        margin-bottom: 15px;
        opacity: 0;
        animation: fadeIn 1s ease-in-out forwards;
    }

    /* Circular Spinner */
    .spinner {
        width: 50px;
        height: 50px;
        border: 5px solid rgba(0, 0, 0, 0.1);
        border-top: 5px solid #ff3c00;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    /* Spinning Animation */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Smooth Fade-In */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Smooth Page Fade-In */
    .fade-in {
        animation: fadeInContent 1s ease-in-out forwards;
    }

    @keyframes fadeInContent {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>


</head>

<body>

    <!-- 🔥 News Site Loader Start -->
<div id="loader-wrapper">
    <div class="loader">
        {{-- <img src="{{ asset('public/assets/frontend/assets/images/1727430172logo.png') }}" alt="News Logo" class="loader-logo"> --}}
        <div class="spinner"></div>
    </div>
</div>
<!-- 🔥 News Site Loader End -->


    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="connect.facebook.net/en_GB/sdk.html#xfbml=1&version=v4.0"></script>
    <style>
        .main-logo {
            padding: 22px 0 20px 0;
        }

        @media only screen and (max-width: 767px) {
            .main-logo {
                padding: 10px 0 13px 0;
                text-align: center;
            }
        }
    </style>
    <!--/========== START SCROLLUP ============-->
    <div class="scrollup">
        <i aria-hidden="true" class="fa fa-chevron-up"></i>
    </div><!--back-to-top-->
    <!--/========== END SCROLLUP ============-->
    <header>
        <script src="{{ asset('assets/frontend/../bangla.plus/scripts/bangladatetoday.min.js') }}"></script>
        <script>
            dateToday('date-today', 'bangla');
        </script>
        <script>
            setInterval(displayTime, 1000);

            function displayTime() {

                const timeNow = new Date();

                let hoursOfDay = timeNow.getHours();
                let minutes = timeNow.getMinutes();
                let seconds = timeNow.getSeconds();
                let weekDay = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"]
                let today = weekDay[timeNow.getDay()];
                let months = timeNow.toLocaleString("default", {
                    month: "long"
                });
                let year = timeNow.getFullYear();
                let period = "AM";

                if (hoursOfDay > 12) {
                    hoursOfDay -= 12;
                    period = "PM";
                }

                if (hoursOfDay === 0) {
                    hoursOfDay = 12;
                    period = "AM";
                }

                hoursOfDay = hoursOfDay < 10 ? "0" + hoursOfDay : hoursOfDay;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                let time = hoursOfDay + ":" + minutes + ":" + seconds + " " + period;

                document.getElementById('Clock').innerHTML = time;

                var chars = {
                    '1': '১',
                    '2': '২',
                    '3': '৩',
                    '4': '৪',
                    '5': '৫',
                    '6': '৬',
                    '7': '৭',
                    '8': '৮',
                    '9': '৯',
                    '0': '০',
                    'A': 'এ',
                    'P': 'পি',
                    'M': 'এম'
                };
                let str = document.getElementById("Clock").innerHTML;
                let res = str.replace(/[1234567890AMP]/g, m => chars[m]);
                document.getElementById("Clock").innerHTML = res;

            }
            displayTime();
        </script>




        <!-- Header Part-->
        <div class="header-top-area">
            <div class="container custom-container">
                <div class="row custom-row">
                    <div class="col-md-6 custom-padding">
                        <div class="date-area">
                            <ul class="current-date">
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i> ঢাকা</li>
                                <span id ="Clock" onload="displayTime()"></span> | <span id="date-today"></span>
                                বঙ্গাব্দ
                            </ul><!--/.date-area-->
                        </div><!--/.date-area-->
                    </div><!--/.col-md-5-->
                    <div class="col-md-6 custom-padding">
                        <div class="social-icon-wrapper float-right">
                            <!-- <div class="top-other-link">
              <ul class="other-link">
                <li><a href="#"><i class="fa fa-newspaper-o" aria-hidden="true"></i> English </a></li>
              </ul>
            </div> -->
                            <div class="top_socail_icon_area d-flex">
                                <!-- <a href="{{url('/panel/dashboard')}}" style="background: #0d3852; color: white; padding: 3px 20px; margin-right: 5px;">Go to Login</a> -->
                                @if(auth()->check())
                                    <!-- Logged in user -->
                                    <a href="{{ url('/panel/dashboard') }}" style="background: #0d3852; color: white; padding: 3px 20px; margin-right: 5px;">Dashboard</a>
                                @else
                                    <!-- Not logged in user -->
                                    <a href="{{ route('login') }}" style="background: #0d3852; color: white; padding: 3px 20px; margin-right: 5px;">Login</a>
                                @endif

                                <ul class="list-inline">

                                    

                                    <li><a target="_blank" href="https://www.youtube.com/rafusoft" class="youtube"
                                            target="_blank">
                                            <span class="cube">
                                                <span class="cube-top"><i class="fa fa-youtube"></i></span>
                                                <span class="cube-front"><i class="fa fa-youtube"></i></span>
                                            </span>
                                        </a>
                                    </li>

                                    <li><a target="_blank" href="https://www.facebook.com/rafusoft"
                                            class="linkedin" target="_blank">
                                            <span class="cube">
                                                <span class="cube-top"><i class="fa fa-linkedin"></i></span>
                                                <span class="cube-front"><i class="fa fa-linkedin"></i></span>
                                            </span>
                                        </a></li>

                                    <li><a target="_blank" href="https://www.facebook.com/rafusoft"
                                            class="twitter" target="_blank">
                                            <span class="cube">
                                                <span class="cube-top"><i class="fa fa-twitter"></i></span>
                                                <span class="cube-front"><i class="fa fa-twitter"></i></span>
                                            </span>
                                        </a></li>

                                    <li><a target="_blank" href="https://www.facebook.com/rafusoft"
                                            class="facebook" target="_blank">
                                            <span class="cube">
                                                <span class="cube-top"><i class="fa fa-facebook"></i></span>
                                                <span class="cube-front"><i class="fa fa-facebook"></i></span>
                                            </span>
                                        </a></li>

                                    <li><a target="_blank" href="log-reg.html" class="youtube" target="_blank">
                                            <span class="cube">
                                                <span class="cube-top"><i class="fa fa-user-circle"></i></span>
                                                <span class="cube-front"><i class="fa fa-user-circle"></i></span>
                                            </span>
                                        </a></li>

                                </ul>
                            </div><!--/.top_socail_icon_area-->
                        </div><!--/.social-icon-wrapper-->
                    </div><!--/.col-md-7-->
                </div><!--/.row-->
            </div><!--/.container-->
        </div><!--/.header-top-area-->
        <div class="logo-area">
            <div class="container custom-container">
                <div class="row custom-row">
                    <div class="col-md-4 custom-padding">

                        <div class="main-logo">
                            <a href="{{ route('home') }}"><img class="img-fluid" src="{{ asset('assets/setting/' . $setting->logo) }}"
                                    alt="সংবাদ ৫২"></a>
                        </div><!--/.main-logo-->
                    </div><!--/.col-md-3-->
                    <div class="col-md-8 custom-padding">
                        <div class="header-baner float-right">
                            <img class="img-fluid"
                                src="{{ asset('assets/frontend/image/header.jpg') }}"
                                alt="Bongosoft Ltd.">
                        </div>
                    </div><!--/.col-md-9-->
                </div><!--/.row-->
            </div><!--/.container-->
        </div><!--/.logo-area-->
    </header>
    <div class="top-nav-main">
        <nav class="navbar navbar-expand-lg top-nav-sports">
            <div class="container navbar-container custom-container">
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars iconbar"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item d-none d-lg-block" id="home">
                            <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-home"></i></a>
                        </li>




                        <ul class="nav">
    <!-- Display the first 13 categories -->
    @foreach ($categories->take(12) as $category)
        <li class="nav-item" id="{{ $category->slug }}">
            <a class="nav-link" href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
        </li><!--/.nav-item-->
    @endforeach

    <!-- Display 'সারদেশ' category with its subcategories -->
    <li class="nav-item dropdown position-relative">
        <a class="nav-link dropdown-toggle" href="saradesh.html" id="navbarDropdown"
            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            সারাদেশ
        </a>
        <ul class="dropdown-menu dropdown-sub-menu" aria-labelledby="navbarDropdown">
            <!-- Loop through the subcategories of 'saradesh' -->
            @foreach ($categories->where('slug', 'saradesh')->first()->subCategories as $subCategory)
                <li>
                    <a href="{{ route('posts.bySubCategory', $subCategory->slug) }}" class="dropdown-item">
                        {{ $subCategory->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </li><!--/.dropdown-->
</ul>

                       



                    </ul>
                </div><!--/.navbarSupportedContent-->
                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div><!--/.attr-nav-->
                <!-- End Atribute Navigation -->
            </div><!-- container -->
        </nav>
        <div class="top-search">
            <div class="container custom-container">
                <div class="col-lg-3 col-md-4 col-12 top-search-secton">
                    <form action="{{ route('search.results') }}" method="get" class="search-form">
                        <div class="input-group">
                            <label for="search" class="sr-only">Search</label>
                            <input type="hidden" />
                            <input type="text" class="form-control" name="query" id="q" placeholder="search">
                            <button class="input-group-addon" type="submit"><i class="fa fa-search"></i></button>
                            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div><!--/.input-group-->
                    </form>
                </div><!--/.col-lg-2 col-md-4 -->
            </div><!--/.container-->
        </div><!--/.top-search-->
    </div><!--/.top-nav-main-->
    <div class="container top-lead-news custom-container">
    </div> <!-- Header Part End-->

    @yield('content')


    <!-- Footer Area Start -->
    <footer class="footer-new">
        <div class="container jagaran-container">
            <div class="row custom-row">
                <div class="col-lg-3 custom-padding">
                    <div class="contact-details">
                        <h3> <span> আমাদের পরিচিতি </span> </h3>
                        <p>সম্পাদক ও প্রকাশক : মোঃ আব্দুর রশিদ</p>
                        <p>নির্বাহী সম্পাদক : মোঃ নজরুল ইসলাম</p>
                        <p>বার্তা সম্পাদক : মোঃ নাইম হোসেন</p>
                    </div><!--/.contact-details-->
                    <ul class="social-icon footer-icon footer-icon-2">


                        <li><a target="_blank" href="https://www.youtube.com/rafusoft" class="youtube"><i
                                    class="fa fa-youtube"></i></a></li>

                        <li><a target="_blank" href="https://www.facebook.com/rafusoft" class="linkedin"><i
                                    class="fa fa-linkedin"></i></a></li>

                        <li><a target="_blank" href="https://www.facebook.com/rafusoft" class="twitter"><i
                                    class="fa fa-twitter"></i></a></li>

                        <li><a target="_blank" href="https://www.facebook.com/rafusoft" class="facebook"><i
                                    class="fa fa-facebook"></i></a></li>
                    </ul><!--/.social-icon-->
                </div><!--/.col-lg-3-->
                <div class="col-lg-3 custom-padding">
                    <div class="contact-details">
                        <h3> <span> রেজিস্টার্ড অফিস </span> </h3>
                        <ul class="footer-address-ul">
                            <li>
                                <span class="size-w-3">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                </span>
                                <span class="size-w-4">
                                    হাউজঃ মুন্সি বাড়ি, নয়ার হাট স্কুল সংলগ্ন, বড়বাড়ি, লালমনির হাট।
                                </span>
                            </li>
                            <li>
                                <span class="size-w-3">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                                <span class="size-w-4">
                                    .০১৭৭৫৪৫৭০০৮
                                </span>
                            </li>
                            <li>
                                <span class="size-w-3">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </span>
                                <span class="size-w-4">
                                    info@rafusoft.com
                                </span>
                            </li>
                            <li>
                                <span class="size-w-3">
                                    <i class="fa fa-internet-explorer" aria-hidden="true"></i>
                                </span>
                                <span class="size-w-4">
                                    https://news.rafusoft.com
                                </span>
                            </li>
                        </ul>
                    </div><!--/.contact-details-->
                </div><!--/.col-md-4-->


                <div class="col-lg-3 custom-padding">
                    <div class="contact-details">
                        <h3> <span> কর্পোরেট অফিস </span> </h3>
                        <ul class="footer-address-ul">
                            <li>
                                <span class="size-w-3">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                </span>
                                <span class="size-w-4">
                                    হাউজঃ মুন্সি বাড়ি, নয়ার হাট স্কুল সংলগ্ন, বড়বাড়ি, লালমনির হাট।
                                </span>
                            </li>
                            <li>
                                <span class="size-w-3">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                                <span class="size-w-4">
                                    .০১৭৭৫৪৫৭০০৮
                                </span>
                            </li>
                            <li>
                                <span class="size-w-3">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                </span>
                                <span class="size-w-4">
                                    info@rafusoft.com
                                </span>
                            </li>
                            <li>
                                <span class="size-w-3">
                                    <i class="fa fa-internet-explorer" aria-hidden="true"></i>
                                </span>
                                <span class="size-w-4">
                                    https://news.rafusoft.com
                                </span>
                            </li>
                        </ul>
                    </div><!--/.contact-details-->
                </div><!--/.col-md-3-->
                <div class="col-lg-3 custom-padding">
                    <div class="contact-details">
                        <h3> <span> মানচিত্রে আমরা </span> </h3>
                    </div>
                    <div class="footer-widget-map">

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233658.1265244922!2d90.25896990107319!3d23.786282142064017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755cb283ea84837%3A0x87b6aee2a98fcc24!2sElite%20Designs%20BD!5e0!3m2!1sen!2sbd!4v1727162558327!5m2!1sen!2sbd"
                            width="100%" height="220" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>
                </div><!--/.col-lg-3-->
            </div><!--/.row-->
        </div><!--/.container-->
    </footer><!--/.footer-new-->
    <div class="footer">
        <div class="container custom-container">
            <div class="row custom-row footer-bottom-row">
                <div class="col-md-8 footer-copy-text">
                    <p>© সকল কিছুর স্বত্বাধিকারঃ Rafusoft </p>
                </div>
                <div class="col-md-4">
                    <div class="design-link">
                        <p>সকল কারিগরী সহযোগিতায় <a href="https://rafusoft.com/" target="_blank"
                                title="https://rafusoft.com/"> Rafusoft </a></p>
                    </div>
                </div>
            </div><!--/.custom-row-->
        </div><!--/.custom-container-->
    </div><!--/.footer--> <!-- Footer Area End -->



    <!--===== JAVASCRIPT FILES =====-->
    <script src="{{ asset('assets/frontend/assets/frontend/asset/js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/frontend/asset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/frontend/asset/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/frntend/assets/frontend/asset/js/menu.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/frontend/asset/js/jquery-stick.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/frontend/asset/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/frontend/asset/js/custom.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/frontend/asset/js/jquery.marquee.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/assets/frontend/asset/js/jquery.pause.js') }}"></script>

    <div id='fb-root' />
    <script type='text/javascript'>
        //<![CDATA[
        window.fbAsyncInit = function() {
            FB.init({
                appId: 'FB APP ID',
                status: true, // check login status
                cookie: true, // enable cookies 
                xfbml: true // parse XFBML
            });
        };
        (function() {
            var e = document.createElement('script');
            e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
            e.async = true;
            document.getElementById('fb-root').appendChild(e);
        }());
        //]]>
    </script>


    <script>
        //get getSubCatList Bangla
        $(function() {
            /*-------------------------------------
            jQuery Marquee
            -------------------------------------*/
            $('.marquee').marquee({
                pauseOnHover: true,
                duration: 20000
            });

            $('.marquee-breaking').marquee({
                pauseOnHover: true,
                duration: 25000
            });

        });
        //to move active class
        $('#home').addClass('active')
    </script>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let loaderWrapper = document.getElementById("loader-wrapper");
        let content = document.getElementById("content");

        setTimeout(function () {
            loaderWrapper.style.opacity = "0";  // Fade out
            setTimeout(() => loaderWrapper.style.display = "none", 300);  // Hide completely after fade
            content.style.display = "block";  // Show content
            content.classList.add("fade-in");  // Apply smooth fade-in effect
        }, 10);  // Loader disappears after .5 seconds
    });
</script>


</body>








</html>
