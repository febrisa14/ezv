<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - EZV</title>
    <meta name="description" content="EZV2 created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="EZV2">
    <meta property="og:site_name" content="Dashmix">
    <meta property="og:description" content="EZV2 created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <script src="https://kit.fontawesome.com/3fa51a741b.js" crossorigin="anonymous"></script>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/magnific-popup/magnific-popup.css') }}">
    <!-- <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/view-villa.css') }}"> -->

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet"
        href="{{ asset('assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick-carousel/slick-theme.css') }}">

    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/home.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/header_minimaliste.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/blog.css') }}">

    <!-- Fonts and Dashmix framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ asset('assets/css/dashmix.css') }}">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div id="page-container">
     {{-- navbar --}}
     <section id="header-container" class="header" style="position:sticky;top:0;">
        <!-- Header -->
        @include('layouts.user.header_minimaliste')
    </section>
    <div class="container-fluid blog-header">
        <div class="vert-middle">
            <div class="privacy-title mb-4"><h2>Blog</h2>
            </div>
        </div>
    <br>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Blog</a></li>
        </ol>
    </nav>
    <section class="blog-body">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="row blog-contents">
                <!-- ad-foreach disini -->
                <div class="col-lg-4 col-md-4 col-sm-12 mb-3 pd-lr-0">
                    <img class="blog-img" src="https://source.unsplash.com/random/?car">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 mb-3">
                    <h1 class="list-header">Lorem Ipsum Dolor Sit Amet 1</h1>
                    <p class="smaller">By EZV on 12/12-2022</p>
                    <p>EZV2Villa exists to help build connections between people and make the world more open and inclusive....</p>
                    <button class="more" onclick="window.location='{{ route('blog')}}';">Read More</button>
                    <!-- Pleae note: href mestinya mengarah ke /blog-detail -->
                </div>
                <hr>
                <!-- /ad-foreach disini -->
                <!-- ad-foreach disini -->
                <div class="col-lg-4 col-md-4 col-sm-12 mb-3 pd-lr-0">
                    <img class="blog-img" src="https://source.unsplash.com/random/?tractor">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 mb-3">
                    <h1 class="list-header">Lorem Ipsum Dolor Sit Amet 2</h1>
                    <p class="smaller">By EZV on 12/12-2022</p>
                    <p>EZV2Villa exists to help build connections between people and make the world more open and inclusive....</p>
                    <button class="more">Read More</button>
                </div>
                <hr>
                <!-- /ad-foreach disini -->
                <!-- ad-foreach disini -->
                <div class="col-lg-4 col-md-4 col-sm-12 mb-3 pd-lr-0">
                    <img class="blog-img" src="https://source.unsplash.com/random/?missile">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 mb-3">
                    <h1 class="list-header">Lorem Ipsum Dolor Sit Amet 3</h1>
                    <p class="smaller">By EZV on 12/12-2022</p>
                    <p>EZV2Villa exists to help build connections between people and make the world more open and inclusive....</p>
                    <button class="more">Read More</button>
                </div>
                <hr>
                <!-- /ad-foreach disini -->
                <!-- ad-foreach disini -->
                <div class="col-lg-4 col-md-4 col-sm-12 mb-3 pd-lr-0">
                    <img class="blog-img" src="https://source.unsplash.com/random/?motorbike">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 mb-3">
                    <h1 class="list-header">Lorem Ipsum Dolor Sit Amet 4</h1>
                    <p class="smaller">By EZV on 12/12-2022</p>
                    <p>EZV2Villa exists to help build connections between people and make the world more open and inclusive....</p>
                    <button class="more">Read More</button>
                </div>
                <hr>
                <!-- /ad-foreach disini -->
                <!-- ad-foreach disini -->
                <div class="col-lg-4 col-md-4 col-sm-12 mb-3 pd-lr-0">
                    <img class="blog-img" src="https://source.unsplash.com/random/?scorpions">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 mb-3">
                    <h1 class="list-header">Lorem Ipsum Dolor Sit Amet 5</h1>
                    <p class="smaller">By EZV on 12/12-2022</p>
                    <p>EZV2Villa exists to help build connections between people and make the world more open and inclusive....</p>
                    <button class="more">Read More</button>
                </div>
                <hr>
                <!-- /ad-foreach disini -->
                <!-- ad-foreach disini -->
                <div class="col-lg-4 col-md-4 col-sm-12 mb-3 pd-lr-0">
                    <img class="blog-img" src="https://source.unsplash.com/random/?forest">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 mb-3">
                    <h1 class="list-header">Lorem Ipsum Dolor Sit Amet 6</h1>
                    <p class="smaller">By EZV on 12/12-2022</p>
                    <p>EZV2Villa exists to help build connections between people and make the world more open and inclusive....</p>
                    <button class="more">Read More</button>
                </div>
                <hr>
                <!-- /ad-foreach disini -->
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 right-block">
            <div id="sidebar_fix" class="right-content">
                <h4 class="title">Latest Blogs</h4>
                <ul>
                    <li><a href="#">Lorem Ipsum ... Amet 1 (12/12-2022)</a></li>
                    <li><a href="#">Lorem Ipsum ... Amet 2 (12/12-2022)</a></li>
                    <li><a href="#">Lorem Ipsum ... Amet 3 (12/12-2022)</a></li>
                    <li><a href="#">Lorem Ipsum ... Amet 4 (12/12-2022)</a></li>
                    <li><a href="#">Lorem Ipsum ... Amet 5 (12/12-2022)</a></li>
                </ul>
            </div>
        </div>
    </div>
    </section>
    {{-- modal laguage and currency --}}
        @include('user.modal.filter.filter_language')
        {{-- modal laguage and currency --}}

        {{-- modal login --}}
        @include('user.modal.auth.login_register')
        {{-- @include('user.modal.user.bar_modal') --}}

        <!-- Footer -->
        @include('layouts.user.footer')
        <!-- END Footer -->
</div>
    <!-- END Page Container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script>
        //Sticky Bar
        // $(function(){
        // $(window).scroll(function(){
        //     var winTop = $(window).scrollTop();
        //     if(winTop >= 100){
        //     $("#header-container").addClass("fix-header");
        //     }else{
        //     $("#header-container").removeClass("fix-header");
        //     }
        //     });
        // });
    </script>
    <script src="{{ asset('assets/js/dashmix.app.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/home.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
        </script>
        {{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> --}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/js/plugins/slick-carousel/slick.min.js') }}"></script>
        {{-- Search Location --}}
        <script>
            $(document).ready(() => {
                var $sidebar = $("#sidebar_fix");
                var $sidebarHeight = $sidebar.outerHeight();
                var $sidebarPos = $("#sidebar_fix").offset().top + $sidebarHeight;
                var $blogBodyHeight = $(".blog-body").offset().top + $(".blog-body").outerHeight() - parseInt($(".blog-body").css("padding-bottom"));
                $(window).on("resize", function() {
                    $sidebarHeight = $sidebar.outerHeight();
                    $sidebarPos = $("#sidebar_fix").offset().top + $sidebarHeight;
                    $blogBodyHeight = $(".blog-body").offset().top + $(".blog-body").outerHeight() - parseInt($(".blog-body").css("padding-bottom"));
                })
                $(window).on("scroll", function() {
                    $sidebarHeight = $sidebar.outerHeight();
                    $sidebarPos = $("#sidebar_fix").offset().top + $sidebarHeight;
                    $blogBodyHeight = $(".blog-body").offset().top + $(".blog-body").outerHeight() - parseInt($(".blog-body").css("padding-bottom"));
                    if ($("#header-container").hasClass("fix-header")
                            && $(this).scrollTop() + 65 > $(".blog-contents div").last().offset().top - 65){
                        $sidebar.removeClass("fixed");
                        $sidebar.addClass('abs');
                        $sidebar.css({
                            "top": $blogBodyHeight - $sidebarHeight
                        });
                    } else if ($("#header-container").hasClass("fix-header")
                            && $(this).scrollTop() + 65 < $(".blog-contents div").last().offset().top - 65) {
                        $sidebar.addClass("fixed");
                    } else {
                        $sidebar.removeClass("fixed");
                        $sidebar.addClass('abs');
                        $sidebar.css({
                            "top": ""
                        });
                    }
                });
                if (window.scrollY == 0 && window.innerWidth <= 991) {
                    document.getElementById("ul").style.display = "none";
                }
                $(".btn-close-expand-navbar-mobile").on("click", function() {
                    $("body").css({
                        "height": "auto",
                        "overflow": "auto"
                    })
                    $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "false");
                    $("#overlay").css("display", "none");
                })
                $("#expand-mobile-btn").on("click", function() {
                    $("body").css({
                        "height": "100%",
                        "overflow": "hidden"
                    })
                    $(".expand-navbar-mobile").removeClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "true");
                    $("#overlay").css("display", "block");
                })
                $('#overlay').click(function() {
                    $("body").css({
                        "height": "auto",
                        "overflow": "auto"
                    })
                    $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "false");
                    $("#overlay").css("display", "none");
                })
                $("#loc_sugest").on('click', function() { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list-first");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        // var rndInt = Math.floor(Math.random() * (ids.length - 1));
                        // console.log(rndInt);
                        ids.show();
                    };

                    $('#sugest').removeClass("display-none");
                    $('#sugest').addClass("display-block"); //add the class to the clicked element
                });

                $(document).mouseup(function(e) {
                    var container = $('#sugest');

                    // if the target of the click isn't the container nor a descendant of the container
                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        container.removeClass("display-block");
                        container.addClass("display-none");
                    }
                });

                $("#loc_sugest").on('keyup change', async () => {
                    var close = $(".sugest-list-first");
                    close.hide();
                    var ids = $(".sugest-list");
                    ids.hide();
                    $(".sugest-list-empty").eq(0).hide();

                    var formValue = $("#loc_sugest").val();
                    var isEmpty = true;

                    $(".sugest-list").map((data) => {
                        var name = $(".sugest-list").eq(data).children(".sugest-list-text")
                            .children('a').text();
                        if (name.toLowerCase().includes(formValue.toLowerCase())) {
                            $(".sugest-list").eq(data).show();
                            isEmpty = false;
                        }
                    });

                    if (isEmpty) {
                        $(".sugest-list-empty").eq(0).show();
                    }

                    if (formValue.length === 0) {
                        close.show();
                        ids.hide();
                    }

                    console.log('done');
                });

                $(".location_op").on('click', function(e) {
                    $('#loc_sugest').val($(this).data("value"));
                    $('#sugest').removeClass("display-block");
                    $('#sugest').addClass("display-none");
                });
            });
        </script>

        <script>
            function sidebarhide() {
                $("body").css({
                    "height": "auto",
                    "overflow": "auto"
                })
                $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                $(".expand-navbar-mobile").attr("aria-expanded", "false");
                $("#overlay").css("display", "none");
            }
            function language() {
                sidebarhide();
                $('#LegalModal').modal('show');
                $('#trigger-tab-language').addClass('active');
                $('#content-tab-language').addClass('active');
                $('#trigger-tab-currency').removeClass('active');
                $('#content-tab-currency').removeClass('active');
            }
            function currency() {
                sidebarhide();
                $('#LegalModal').modal('show');
                $('#trigger-tab-language').removeClass('active');
                $('#content-tab-language').removeClass('active');
                $('#trigger-tab-currency').addClass('active');
                $('#content-tab-currency').addClass('active');
            }
        </script>
        <script>
            function view_LoginModal() {
                $('#LoginModal').modal('show');
            }
        </script>

        {{-- LAZY LOAD --}}
        @include('components.lazy-load.lazy-load')
        {{-- END LAZY LOAD --}}
</body>

</html>
