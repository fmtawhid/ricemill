<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <title>তালিমুল ইসলাম স্কুল এন্ড মাদ্রাসা</title> -->
    <title> @yield('title', 'তালিমুল ইসলাম স্কুল এন্ড মাদ্রাসা') - তালিমুল ইসলাম স্কুল এন্ড মাদ্রাসা</title>

    <!-- Meta Title -->
    <meta name="title" content="<?php echo isset($page['meta_title']) ? $page['meta_title'] : 'Best Madrasa in Dinajpur | Islamic Education Center'; ?>">
    <!-- Meta Keywords -->
    <meta name="keywords" content="<?php echo isset($page['meta_keyword']) ? $page['meta_keyword'] : 'Madrasa in Dinajpur, Islamic Education Dinajpur, Quran Classes, Hifz Madrasa Dinajpur, Dinajpur Islamic School'; ?>">
    <!-- Meta Description -->
    <meta name="description" content="<?php echo isset($page['meta_description']) ? $page['meta_description'] : 'Join the best Madrasa in Dinajpur offering Islamic education, Quran memorization (Hifz), Arabic language classes, and a holistic educational experience for students.'; ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('assets/img/logo.svg') }}" type="image/x-icon">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/datepicker/bootstrap-datepicker3.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dist/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/ss-print.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/dropify.min.css') }}">

    <script src="{{ asset('assets/dist/jquery.min.js') }}"></script><!-- error -->
    <script src="{{ asset('assets/dist/moment.min.js') }}"></script>
    <script src="{{ asset('assets/dist/dropify.min.js') }}"></script>

    <script src="{{ asset('assets/dist/bootstrap-select.min.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <style type="text/css">
        form .form-bottom button.btn {
            min-width: 105px;
        }

        form .form-bottom .input-error {
            border-color: #d03e3e;
            color: #d03e3e;
        }

        form.gauthenticate-form {
            display: none;
        }

        .cs {
            margin-left: 3px;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            /* Ensures it appears correctly */
            top: 100%;
            /* Adjust the position below the parent item */
            left: 0;
            z-index: 1000;
        }

        /* Show the dropdown-menu on hover */
        .dropdown:hover .dropdown-menu {
            display: block;
        }


        /* Mobile menu styles */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -250px;
            width: 250px;
            height: 100%;
            background: #fff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            transition: right 0.3s ease-in-out;
            z-index: 1050;
        }

        .mobile-menu.show {
            right: 0;
        }

        .mobile-menu ul {
            padding: 15px;
            list-style: none;
        }

        .mobile-menu ul li {
            margin: 10px 0;
        }

        .navbar-toggle {
            border: none;
            background: none;
            font-size: 18px;
        }

        .icon-bar {
            display: block;
            width: 22px;
            height: 2px;
            background: #000;
            margin: 4px auto;
        }

        .close-menu {
            text-align: right;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            color: #000;
            border-bottom: 1px solid #ddd;
        }

        .mlogo {
            display: none;
        }


        /* Mobile menu brand logo styling */
        .mobile-menu .mobile-brand {
            display: flex;
            align-items: center;
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            display: none;
        }

        .mobile-menu .mobile-brand img {
            max-width: 50px;
            /* Adjust logo size for mobile */
            margin-right: 10px;
        }

        .mobile-menu .mobile-brand span {
            font-size: 16px;
            font-weight: bold;
            color: #000;
        }






        /* For mobile */
        @media (max-width: 992px) {
            .slide-after-section {
                padding-top: 0px;
            }

            .slider-container {
                margin-bottom: 1px;
            }
        }


        /* for desktop */
        @media (min-width: 992px) {
            .mobile-menu {
                display: none;
            }

            .mobile-brand {
                display: none;
            }

            .mm {
                display: none;
            }
        }
    </style>



</head>

<body>
    {{--
    <style>
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    </style>
    <!-- preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const preloader = document.getElementById("preloader");
        window.addEventListener("load", function() {
            preloader.style.display = "none";
        });
    });
    </script> --}}
    <!-- Loader Container -->



    <div id="loader" class="loader">
    <img src="{{ asset('assets/img/loader.gif') }}" alt="Loading...">
</div>

<style>
    /* Loader Style */
    .loader {
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
        background-color: rgb(255, 255, 255);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .loader img {
        width: 50px;
        height: 50px;
    }
</style>

<script>
    // Show the loader when the page starts loading
    document.addEventListener("DOMContentLoaded", function() {
        const loader = document.getElementById("loader");
        window.addEventListener("load", function() {
            loader.style.display = "none";
        });
    });
</script>

    {{-- <div id="loader" class="loader">
        <img src="{{ asset('assets/img/loader.gif') }}" alt="Loading...">
    </div>

    <style>
        /* Loader Style */
        .loader {
            width: 98vw;
            height: 100vh;
            z-index: 9999;
            background-color: rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader img {
            width: 50px;
            height: 50px;
        }
    </style>


    <script>
        // Show the loader when the page starts loading
        document.addEventListener("DOMContentLoaded", function() {
            const loader = document.getElementById("loader");
            window.addEventListener("load", function() {
                loader.style.display = "none";
            });
        });
    </script> --}}








    <div id="alert" class="">
        <div class="topsection">
            <section class="newsarea">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="newscontent ">
                                <div class="newstab">নোটিশ </div>
                                <div class="newscontent">
                                    <marquee behavior="scroll" direction="left" onmouseover="this.stop();"
                                        onmouseout="this.start();">
                                        <ul style="font-weight:300;">
                                            @foreach ($notices as $notice)
                                                <li>
                                                    <a href="{{ asset('img/notice_pdf/' . $notice->pdf_file) }}">
                                                        <div class="datenews">
                                                            {{ $notice->date }}
                                                            <span></span>
                                                        </div>
                                                        {{ Str::limit($notice->section_title, 100) }}
                                                    </a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </marquee>
                                </div>
                                <!--./newscontent-->

                            </div>
                            <!--./sidebar-->
                        </div>
                        <!--./col-md-12-->
                    </div>
                </div>
            </section>

            <div class="toparea">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-3">
                            <ul class="toplist">
                                <li><a href="mailto:talimulislamdnj@gmail.com"><i class="bi bi-envelope"></i><span
                                            class="">talimulislamdnj@gmail.com</span></a></li>
                            </ul>
                        </div>
                        <!--./col-md-5-->
                        <div class="col-lg-6 col-md-6 col-sm-9">
                            <ul class="topicon">
                                <li><span class="hidden-xs">কল করুন</span></li>
                                <li class="mr-4" style="font-weight:700"><span class="hidden-xs">+880
                                        1322-926843</span>
                                </li>
                                <li><span class="hidden-xs">ফলো করুন</span></li>
                                <li>
                                    <a href="https://wa.me/+8801322926843" target="_blank">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                </li>

                                <li><a href="https://www.facebook.com/talimulislamdnj" target="_blank"><i
                                            class="bi bi-facebook"></i></a></li>
                                <li><a href="https://x.com/AllBd293018" target="_blank"><i
                                            class="bi bi-twitter"></i></a>
                                </li>
                                <li><a href="https://www.youtube.com/@talimulislamschoolmadrasa" target="_blank"><i
                                            class="bi bi-youtube"></i></a></li>
                                <li><a href="https://www.linkedin.com/in/talimul-islam-school-7b2978339"
                                        target="_blank"><i class="bi bi-linkedin"></i></a></li>
                                <li><a href="https://www.instagram.com/talimulislamschool/" target="_blank"><i
                                            class="bi bi-instagram"></i></a></li>

                            </ul>
                        </div>
                        <!--./col-md-6-->
                    </div>
                </div>
            </div>
            <!--./toparea-->
        </div>
        <!--./topsection-->
        <header class="dheader">
            <link href="{{ asset('backend/toast-alert/toastr.css') }}" rel="stylesheet" />
            <script src="{{ asset('backend/toast-alert/toastr.js') }}"></script>


            <div class="container">
                <div class="row ">
                    <div class="col-md-10 col-sm-8 d-flex align-items-center mlogo">
                        <a class="logo d-flex align-items-center" href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/logo.svg') }}" alt="">
                            <!-- <img src="{{ asset('assets/img/logoB.png') }}" alt=""> -->
                            <span class="logotext">তা'লীমুল ইসলাম স্কুল এন্ড মাদ্রাসা</span>
                        </a>
                    </div>
                    <!--./col-md-4-->
                    <div class="col-md-2 col-sm-4 " style="margin-top: 25px;">
                        <ul class="header-extras">

                            <!-- <li>
                        <a class="d-flex align-items-center" href="https://wa.me/8801322926843" target="_blank">
                            <i class="fa fa-whatsapp i-plain"></i>
                            <div class="he-text ">
                                <span style=" font-weight:bolder ">কল করুন</span> <span>০১৩২২৯২৬৮৪৩</span>
                            </div>
                        </a>
                    </li> -->




                            <!-- Login / Logout Button -->
                            <li>
                                @if (Auth::check())
                                    <!-- Show the Dashboard Button if user is logged in -->
                                    <a class="complainbtn" href="{{ route('dashboard') }}">Dashboard</a>
                                @else
                                    <!-- Show the Login Button if user is not logged in -->
                                    <a class="complainbtn" href="{{ url('/panel/login') }}"
                                        target="_blank">Login</a>
                                @endif

                            </li>
                        </ul>

                    </div>
                    <!--./col-md-8-->
                </div>
                <!--./row-->
            </div>
            <!--./container-->

            <div class="navborder sticky-header">
                <div class="container">
                    <div class="row">
                        <nav class="navbar">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#navbar-collapse-3">
                                    <span class="sr-only">Toggle Navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="collapse navbar-collapse" id="navbar-collapse-3">
                                <!-- Main Menu -->
                                <ul class="nav navbar-nav">
                                    <!-- Menu Item 1 -->
                                    <li class="cs {{ Request::is('/') ? 'active' : '' }}">
                                        <a href="{{ url('/') }}">হোম </a>
                                    </li>

                                    <li class="cs dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">একাডেমী শাখা
                                            <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ url('nurani') }}">নুরানী বিভাগ </a></li>
                                            <li><a href="{{ url('hefjo') }}">হেফজ বিভাগ </a></li>
                                            <li><a href="{{ url('school') }}">স্কুল বিভাগ </a></li>
                                        </ul>
                                    </li>



                                    <li class="cs dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> পরিচিতি <b
                                                class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ url('about') }}"> আমাদের পরিচয় </a></li>
                                            <li><a href="{{ url('campus') }}">ক্যাম্পাস সম্পর্কে </a></li>
                                            <li><a href="{{ url('teachers') }}">শিক্ষক সম্পর্কে </a></li>
                                        </ul>
                                    </li>





                                    <!-- Menu Item 4 -->
                                    <li class=" cs {{ Request::is('gallery') ? 'active' : '' }}">
                                        <a href="{{ route('gallery') }}">গ্যালারী</a>
                                    </li>



                                    <li class="cs dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">পাঠ্যক্রম <b
                                                class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ url('computerlab') }}">কম্পিউটার ল্যাব</a></li>
                                            <li><a href="{{ url('library') }}">লাইবেরি </a></li>
                                            <li><a href="{{ url('sports') }}">খেলাধুলা</a></li>
                                            <li><a href="{{ url('occasions') }}">অন্যান্য অনুষ্ঠান</a></li>
                                        </ul>
                                    </li>

                                    <!-- Menu Item 5 -->
                                    <li class="cs {{ Request::is('notice') ? 'active' : '' }}">
                                        <a href="{{ route('notice') }}">নোটিশ</a>
                                    </li>

                                    <li class="cs dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> অন্যান্য
                                            তথ্য <b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('costs') }}">খরচ সমূহ</a></li>
                                        </ul>
                                    </li>


                                    <!-- Menu Item 3 -->
                                    <li class="cs {{ Request::is('contact') ? 'active' : '' }}">
                                        <a href="{{ route('contact') }}">যোগাযোগ </a>
                                    </li>

                                </ul>
                            </div><!-- /.navbar-collapse -->

                        </nav><!-- /.navbar -->
                    </div>
                </div>
            </div>

        </header>







        <!-- mobile menu  -->
        <header>
            <nav class="navbar mm">
                <div class="container">
                    <div class="navbar-header d-flex align-items-center justify-content-center">
                        <a class=" mobile-brand d-flex align-items-center justify-content-center" href="#"
                            style="max-width: 305px;">
                            <img src="{{ asset('assets/img/logo.svg') }}" alt="" srcset=""
                                style="width: 40px;">
                            <span style="font-size:20px; color:#B62E35; margin-left:5px;">তা'লীমুল
                                ইসলাম স্কুল এন্ড
                                মাদ্রাসা</span>
                        </a>
                        <button type="button" class="navbar-toggle" id="menu-toggle" style="margin-left:15px;">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                </div>
            </nav>
        </header>

        <div class="mobile-menu" id="mobile-menu">
            <div class="close-menu" id="menu-close">&times;</div>
            <ul class="nav navbar-nav">
                <!-- Menu Item 1 -->
                <li class="mcs {{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}">হোম </a>
                </li>

                <!-- Dropdown Menu: একাডেমী শাখা -->
                <li class="mcs dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">একাডেমী শাখা <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('nurani') }}">নুরানী বিভাগ </a></li>
                        <li><a href="{{ url('hefjo') }}">হেফজ বিভাগ </a></li>
                        <li><a href="{{ url('school') }}">স্কুল বিভাগ </a></li>
                    </ul>
                </li>

                <!-- Dropdown Menu: পরিচিতি -->
                <li class="mcs dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">পরিচিতি <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('about') }}">আমাদের পরিচয় </a></li>
                        <li><a href="{{ url('campus') }}">ক্যাম্পাস সম্পর্কে </a></li>
                        <li><a href="{{ url('teachers') }}">শিক্ষক সম্পর্কে </a></li>
                    </ul>
                </li>

                <!-- Menu Item: গ্যালারী -->
                <li class="mcs {{ Request::is('gallery') ? 'active' : '' }}">
                    <a href="{{ route('gallery') }}">গ্যালারী</a>
                </li>

                <!-- Dropdown Menu: পাঠ্যক্রম -->
                <li class="mcs dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">পাঠ্যক্রম <b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ url('computerlab') }}">কম্পিউটার ল্যাব</a></li>
                        <li><a href="{{ url('library') }}">লাইব্রেরি </a></li>
                        <li><a href="{{ url('sports') }}">খেলাধুলা</a></li>
                        <li><a href="{{ url('occasions') }}">অন্যান্য অনুষ্ঠান</a></li>
                    </ul>
                </li>

                <!-- Menu Item: নোটিশ -->
                <li class="mcs {{ Request::is('notice') ? 'active' : '' }}">
                    <a href="{{ route('notice') }}">নোটিশ</a>
                </li>

                <!-- Menu Item: যোগাযোগ -->
                <li class="mcs {{ Request::is('contact') ? 'active' : '' }}">
                    <a href="{{ route('contact') }}">যোগাযোগ</a>
                </li>


                <!-- Login / Logout Button -->
                <li>
                    @if (Auth::check())
                        <!-- Show the Dashboard Button if user is logged in -->
                        <a class="complainbtn btn-block" href="{{ route('dashboard') }}">Dashboard</a>
                    @else
                        <!-- Show the Login Button if user is not logged in -->
                        <a class="complainbtn btn-block" href="{{ url('/panel/login') }}" target="_blank">Login</a>
                    @endif

                </li>
            </ul>
        </div>

        <script>
            $(document).ready(function() {
                // Show the mobile menu
                $('#menu-toggle').click(function() {
                    $('#mobile-menu').addClass('show');
                });

                // Close the mobile menu
                $('#menu-close').click(function() {
                    $('#mobile-menu').removeClass('show');
                });
            });
        </script>






        <!---   Guest Signup  --->
        <div id="myModal" class="modal fade" role="dialog" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modal-header-small">
                        <button type="button" class="close closebtnmodal" data-dismiss="modal">&times;</button>
                        <h4>{{ __('guest_registration') }}</h4>
                    </div>
                    <form action="{{ url('course/guestsignup') }}" method="post" class="signupform"
                        id="signupform">
                        <!-- Form Content -->
                    </form>
                </div>
            </div>
        </div>
        <!-- End Guest Signup -->

        <script>
            window.onscroll = function() {
                var header = document.querySelector('.sticky-header');
                var sticky = header.offsetTop; // Get the initial offset of the header

                if (window.pageYOffset > sticky) {
                    // When scrolled down, add the sticky class
                    header.classList.add('sticky-active');
                } else {
                    // When scrolled up, remove the sticky class
                    header.classList.remove('sticky-active');
                }
            };
        </script>


        @yield('body-content')


        <footer style="background:url({{ asset('assets/images/2.jpg') }}) !important">
            <div class="container spacet40 spaceb40">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <h3 class="fo-title">লিঙ্কসমূহ</h3>
                        <ul class="f1-list">
                            <li>
                                <a href="{{ url('/') }}" class="pe-auto">হোম</a>
                            </li>
                            <li>
                                <a href="{{ url('about') }}">আমাদের সম্পর্কে</a>
                            </li>
                            <li>
                                <a href="{{ url('gallery') }}">গ্যালারী</a>
                            </li>
                            <li>
                                <a href="{{ url('contact') }}">যোগাযোগ</a>
                            </li>
                        </ul>
                    </div>
                    <!--./col-md-4-->

                    <div class="col-md-4 col-sm-6">
                        <h3 class="fo-title">আমাদের অনুসরণ করুন</h3>
                        <ul class="company-social">
                            <li><a href="https://wa.me/+8801322926843" target="_blank"><i
                                        class="fa fa-whatsapp"></i></a></li>
                            <li><a href="https://www.facebook.com/talimulislamdnj" target="_blank"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li><a href="https://x.com/AllBd293018" target="_blank"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li><a href="https://www.youtube.com/@talimulislamschoolmadrasa" target="_blank"><i
                                        class="fa fa-youtube"></i></a></li>
                            <li><a href="https://www.linkedin.com/in/talimul-islam-school-7b2978339"
                                    target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="https://www.instagram.com/talimulislamschool/" target="_blank"><i
                                        class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!--./col-md-4-->

                    <div class="col-md-4 col-sm-6">
                        <h3 class="fo-title">প্রতিক্রিয়া</h3>
                        <div class="complain">
                            <a href="{{ route('contact') }}#complaint"><i
                                    class="fa fa-pencil-square-o i-plain"></i>অভিযোগ</a>
                        </div>
                    </div>
                    <!--./col-md-4-->
                </div>
                <!--./row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="infoborderb"></div>
                        <div class="col-md-4">
                            <div class="contacts-item">
                                <div class="cleft"><i class="fa fa-phone"></i></div>
                                <div class="cright">
                                    <a href="#" class="content-title">যোগাযোগ</a>
                                    <p class="content-title" style="font-weight:700;">০১৩২২৯২৬৮৪৩</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="contacts-item">
                                <div class="cleft"><i class="fa fa-envelope"></i></div>
                                <div class="cright">
                                    <a href="#" class="content-title">ইমেইল করুন</a>
                                    <p><a href="mailto:info@example.com"
                                            class="content-title">talimulislamdnj@gmail.com</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="contacts-item">
                                <div class="cleft"><i class="fa fa-map-marker"></i></div>
                                <div class="cright">
                                    <a href="#" class="content-title">ঠিকানা</a>
                                    <p class="sub-title">ঈদগাহ, আ/এ, সি, এন্ড বি, রোড সংলগ্ন, সদর, দিনাজপুর</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--./row-->
            </div>
            <!--./container-->
        </footer>

        <div class="copy-right">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center">
                        <p>&copy; 2024 সর্বস্বত্ব সংরক্ষিত | Rafusoft</p>
                    </div>
                </div>
                <!--./row-->
            </div>
            <!--./container-->
        </div>
        <!--./copy-right-->

        <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>

        <script>
            function setsitecookies() {
                // Dummy function
                $('.cookieConsent').hide();
            }

            function check_cookie_name(name) {
                var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
                if (match) {
                    console.log(match[2]);
                    $('.cookieConsent').hide();
                } else {
                    $('.cookieConsent').show();
                }
            }
            check_cookie_name('sitecookies');
        </script>




        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('assets/js/ss-lightbox.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/datepicker/bootstrap-datepicker.min.js') }}"></script>




</body>



</html>
