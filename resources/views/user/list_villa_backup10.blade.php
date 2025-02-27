@extends('layouts.user.list')

@section('title', 'List of Homes - EZV2')

@section('content')
    {{-- function get data --}}
    @php
    // $villas = $villa->shuffle()->sortBy('grade');
    $villas = $villa;
    $list = [];
    foreach ($villas as $item) {
        array_push($list, $item->id_villa);
    }

    $scenic_views = App\Models\ScenicViews::all();
    $get_check_in = app('request')->input('sCheck_in');
    $get_check_out = app('request')->input('sCheck_out');

    function dateDiff($get_check_in, $get_check_out)
    {
        $date1_ts = strtotime($get_check_in);
        $date2_ts = strtotime($get_check_out);
        $diff = $date2_ts - $date1_ts;
        return round($diff / 86400);
    }

    if ($get_check_in == null) {
        $get_dates = Translate::translate('Add Date');
    } else {
        if ($get_check_out == $get_check_in) {
            $dateDiff = '1 ' . Translate::translate('day');
        } else {
            $dateDiff = dateDiff($get_check_in, $get_check_out);
        }
    }

    if (request()->fCategory) {
        $fCategory = request()->fCategory;
    } else {
        $fCategory = '';
    }
    @endphp

    @php
    // set theme color
    $bgColor = 'bg-body-light';
    $textColor = 'font-black';
    $rowLineColor = 'row-line-white';
    $listColor = 'listoption-light';
    $shadowColor = 'box-shadow-light';
    if (isset($_COOKIE['tema'])) {
        if($_COOKIE['tema'] == 'black'){
            $bgColor = 'bg-body-black';
            $textColor = 'font-light';
            $rowLineColor = 'row-line-grey';
            $listColor = 'listoption-dark';
            $shadowColor = 'box-shadow-dark';
        }
    }
    @endphp

    <style>
        .sub-icon:hover {
            color: #ff7400 !important;
            cursor: pointer;
        }
    </style>
    {{-- function get data --}}

    <div id="body-color" class="{{ $bgColor }}">
        <!-- Page Content -->
        <div id="div-to-refresh">
            <!-- Refresh Page -->
            <div class="col-lg-12" style="position: relative; min-height: 100px;">
                <div class="w-100" id="view-map-button-float">
                    <div class="map-floating-button skeleton skeleton-h-4 skeleton-w-4 {{ $shadowColor }}">
                        <button onclick="view_main_map()" style="height:inherit;">
                            <!-- partial:index.partial.html -->
                            <div class="notice">
                                <span class="world">
                                    <span class="images" style="color: #52EB35;">
                                        <img src="{{ asset('assets/earth.svg') }}" alt="Earth SVG">
                                    </span>
                                </span>
                            </div>
                            <!-- partial -->
                        </button>
                    </div>
                </div>

                <div id="filter-cat-bg-color" class="container-grid-cat {{ $bgColor }}" style="width: 100%;"
                    data-isshow="true">
                    @foreach ($villaCategory->take(6) as $item)
                        <div class="skeleton skeleton-h-4 skeleton-w-100">
                            <a href="#" class="grid-img-container"
                                onclick="homesFilter({{ $item->id_villa_category }}, null)">
                                <img class="grid-img-filter lozad"
                                    @if ($fCategory == $item->id_villa_category) style="border: 5px solid #ff7400;" @endif
                                    src="https://source.unsplash.com/random/?{{ $item->name }}" data-loaded="true">
                                <div class="grid-text translate-text-group-items">
                                    {{ $item->name }}
                                </div>
                            </a>
                        </div>
                    @endforeach

                    <div class="skeleton skeleton-h-4 skeleton-w-100">
                        <a href="#" class="grid-img-container" onclick="moreCategory()">
                            <img class="grid-img-filter lozad" src="https://source.unsplash.com/random/?bali"
                                data-loaded="true">
                            <div class="grid-text">
                                {{ __('user_page.More') }}
                            </div>
                        </a>
                    </div>
                </div>

                <div id="filter-subcat-bg-color" class="container-grid-sub-cat {{ $bgColor }}" style="width: 100%;"
                    data-isshow="true">
                    @foreach ($villaFilter->sortBy('order')->take(8) as $item)
                        <div class="skeleton skeleton-h-3 skeleton-w-100">
                            <div style="cursor:pointer;" class="grid-sub-cat-content-container text-13"
                                onclick="homesFilter({{ request()->get('fCategory') ?? 'null' }}, {{ $item->id_villa_filter }})">
                                <div>
                                    <i
                                        class="{{ $item->icon }} text-18 list-description {{ $textColor }} sub-icon"></i>
                                </div>
                                <div class="list-description {{ $textColor }}">{{ $item->name }}</div>
                            </div>
                        </div>
                    @endforeach

                    <div class="skeleton skeleton-h-3 skeleton-w-100">
                        <div class="grid-sub-cat-content-container text-13 list-description {{ $textColor }}"
                            onclick="moreSubCategory()">

                            <div>
                                <i class="fa-solid fa-ellipsis text-18 list-description {{ $textColor }} sub-icon"></i>
                            </div>
                            <p class="list-description {{ $textColor }}">
                                {{ __('user_page.More') }}
                            </p>

                        </div>
                    </div>
                </div>


                <div id="villa-data" class="grid-container-43">
                    @include('user.data_list_villa')
                </div>
                <div></div>

                <div class="ajax-load text-center" style="display:none;">
                    <p class="list-loading {{ $textColor }}">
                        {{ __('user_page.Loading More') }}
                    </p>
                </div>
                <!-- End Grid 43 -->
                <div style="height: 35px;">&nbsp;</div>
            </div>
        </div>
        <!-- End Page Content -->
        {{-- modal laguage and currency --}}
        @include('user.modal.filter.filter_language')
        @include('user.modal.auth.login_register')
        @include('user.modal.villa.filter')
        @include('user.modal.villa.category')
        {{-- modal laguage and currency --}}
    </div>

    {{-- VIEW VIDEO --}}
    @include('user.modal.villa.list.video')
    {{-- END VIEW VIDEO --}}
@endsection

@section('scripts')
    @include('user.modal.villa.list.map')

    <script>
        var itemIds = [];

        function add(items) {
            if (items.length) {
                items.forEach(id => {
                    if (items.indexOf(id) != -1) {
                        itemIds.push(id);
                    }
                });
            }
            console.log(itemIds);
        }
    </script>
    <script>
        var page = 1;
        function disabledScrollAction() {
            $(window).off('scroll');
        }
        function enabledScrollAction() {
            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() + 100 >= $(document).height()) {
                    page++;
                    loadMoreData(page);
                }
            });
        }
    </script>
    <script>
        async function loadMoreData(page) {
            disabledScrollAction();

            // check if link indicator is link list
            // otherwise link filter
            var linkIndicator = location.origin + location.pathname;
            var linkTarget = `{{ route('list') }}`;
            if (linkIndicator == linkTarget) {
                let load = await $.ajax({
                    url: '?page=' + page,
                    type: 'get',
                    beforeSend: function() {
                        $(".ajax-load").show();
                    },
                    data: {
                        itemIds: itemIds
                    },
                })
                .done(function(data) {
                    console.log(data);
                    // append data to element
                    if (data.html == " ") {
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#villa-data").append(data.html);

                    // rerun slick
                    $('.js-slider-2 .slick-next').not('.slick-initialized').css('display', 'none');
                    $('.js-slider-2 .slick-prev').not('.slick-initialized').css('display', 'none');
                    $('.js-slider-2').not('.slick-initialized').mouseenter(function(e) {
                        $(this).children('.slick-prev').not('.slick-initialized').css('display', 'block');
                        $(this).children('.slick-next').not('.slick-initialized').css('display', 'block');
                    })
                    $('.js-slider-2').not('.slick-initialized').mouseleave(function(e) {
                        $(this).children('.slick-prev').not('.slick-initialized').css('display', 'none');
                        $(this).children('.slick-next').not('.slick-initialized').css('display', 'none');
                    })

                    $(".js-slider-2").not('.slick-initialized').slick({
                        rtl: false,
                        autoplay: false,
                        autoplaySpeed: 5000,
                        speed: 800,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        variableWidth: true,
                        pauseOnHover: false,
                        easing: "linear",
                        arrows: true
                    });
                    // rerun change background

                    // changebackground();
                    enabledScrollAction();
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert("Server not responding");
                    enabledScrollAction();
                });
            } else {
                let load = await $.ajax({
                    url: location.href+'&page=' + page,
                    type: 'get',
                    beforeSend: function() {
                        $(".ajax-load").show();
                    },
                    data: {
                        itemIds: itemIds
                    },
                })
                .done(function(data) {
                    // append data to element
                    if (data.html == " ") {
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#villa-data").append(data.html);

                    // rerun slick
                    $('.js-slider-2 .slick-next').not('.slick-initialized').css('display', 'none');
                    $('.js-slider-2 .slick-prev').not('.slick-initialized').css('display', 'none');
                    $('.js-slider-2').not('.slick-initialized').mouseenter(function(e) {
                        $(this).children('.slick-prev').not('.slick-initialized').css('display', 'block');
                        $(this).children('.slick-next').not('.slick-initialized').css('display', 'block');
                    })
                    $('.js-slider-2').not('.slick-initialized').mouseleave(function(e) {
                        $(this).children('.slick-prev').not('.slick-initialized').css('display', 'none');
                        $(this).children('.slick-next').not('.slick-initialized').css('display', 'none');
                    })

                    $(".js-slider-2").not('.slick-initialized').slick({
                        rtl: false,
                        autoplay: false,
                        autoplaySpeed: 5000,
                        speed: 800,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        variableWidth: true,
                        pauseOnHover: false,
                        easing: "linear",
                        arrows: true
                    });
                    // rerun change background

                    // changebackground();
                    enabledScrollAction();
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert("Server not responding");
                    enabledScrollAction();
                });
            }


            removeSkeletonClass()
        }
    </script>
    <script>
        $(window).on('load', () => {
            add(@json($villas->pluck('id_villa')));
        });
        enabledScrollAction();
    </script>

    <script src="{{ asset('assets/js/list-villa-extend.js') }}"></script>

    {{-- Search --}}
    <script>
        $(document).ready(function() {
            $('.js-slider-2 .slick-next').css('display', 'none');
            $('.js-slider-2 .slick-prev').css('display', 'none');
            $('.js-slider-2').mouseenter(function(e) {
                $(this).children('.slick-prev').css('display', 'block');
                $(this).children('.slick-next').css('display', 'block');
            })
            $('.js-slider-2').mouseleave(function(e) {
                $(this).children('.slick-prev').css('display', 'none');
                $(this).children('.slick-next').css('display', 'none');
            })
            $(".drop-down").hover(function() {
                $('.mega-menu').addClass('display-on');
            });
            $(".drop-down").mouseleave(function() {
                $('.mega-menu').removeClass('display-on');
            });

            $(".drop-down2").hover(function() {
                $('.mega-menu2').addClass('display-on');
            });
            $(".drop-down2").mouseleave(function() {
                $('.mega-menu2').removeClass('display-on');
            });

            $(".drop-down3").hover(function() {
                $('.mega-menu3').addClass('display-on');
            });
            $(".drop-down3").mouseleave(function() {
                $('.mega-menu3').removeClass('display-on');
            });

            $(".drop-down4").hover(function() {
                $('.mega-menu4').addClass('display-on');
            });
            $(".drop-down4").mouseleave(function() {
                $('.mega-menu4').removeClass('display-on');
            });

            $(".drop-down5").hover(function() {
                $('.mega-menu5').addClass('display-on');
            });
            $(".drop-down5").mouseleave(function() {
                $('.mega-menu5').removeClass('display-on');
            });

        });
    </script>

    {{-- SEARCH FUNCTION --}}
    <script>
        function moreCategory() {
            $('#categoryModal').modal('show');
        }

        function moreSubCategory() {
            $('#modalSubCategory').modal('show');
        }

        function villaRefreshFilter(suburl) {
            window.location.href = `{{ env('APP_URL') }}/homes/search?${suburl}`;
        }
    </script>

    {{-- <script>
        function villaFilter() {
            var fMaxPriceFormInput = $("input[name='fMaxPrice']").val();

            var fMinPriceFormInput = $("input[name='fMinPrice']").val();

            var fPropertyFormInput = [];
            $("input[name='fProperty[]']:checked").each(function() {
                fPropertyFormInput.push(parseInt($(this).val()));
            });

            var fBedroomFormInput = $("input[name='fBedroom']:checked").val();
            var fBathroomFormInput = $("input[name='fBathroom']:checked").val();
            var fBedsFormInput = $("input[name='fBeds']:checked").val();

            var fFacilitiesFormInput = [];
            $("input[name='fFacilities[]']:checked").each(function() {
                fFacilitiesFormInput.push(parseInt($(this).val()));
            });

            var fSuitableFormInput = [];
            $("input[name='fSuitable[]']:checked").each(function() {
                fSuitableFormInput.push(parseInt($(this).val()));
            });

            var fViewsFormInput = [];
            $("input[name='fViews[]']:checked").each(function() {
                fViewsFormInput.push(parseInt($(this).val()));
            });

            var fAmenitiesFormInput = [];
            $("input[name='fAmenities[]']:checked").each(function() {
                fAmenitiesFormInput.push(parseInt($(this).val()));
            });

            var sLocationFormInput = $("input[name='sLocation']").val();

            var sCheck_inFormInput = $("input[name='sCheck_in']").val();

            var sCheck_outFormInput = $("input[name='sCheck_out']").val();

            var sAdultFormInput = $("input[name='sAdult']").val();

            var sChildFormInput = $("input[name='sChild']").val();

            function setCookie2(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            setCookie2("sLocation", sLocationFormInput, 1);
            setCookie2("sCheck_in", sCheck_inFormInput, 1);
            setCookie2("sCheck_out", sCheck_outFormInput, 1);

            var subUrl =
                `fMinPrice=${fMinPriceFormInput}&fMaxPrice=${fMaxPriceFormInput}&fBedroom=${fBedroomFormInput}&fBathroom=${fBathroomFormInput}&fBeds=${fBedsFormInput}&fProperty=${fPropertyFormInput}&fViews=${fViewsFormInput}&fAmenities=${fAmenitiesFormInput}&sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}`;
            villaRefreshFilter(subUrl);
        }
    </script> --}}

    <script>
        function homesFilter(valueCategory, valueClick) {
            var sLocationFormInput = $("input[name='sLocation']").val();
            var sCheck_inFormInput = $("input[name='sCheck_in']").val();
            var sCheck_outFormInput = $("input[name='sCheck_out']").val();
            var sAdultFormInput = $("input[name='sAdult']").val();
            var sChildFormInput = $("input[name='sChild']").val();

            function setCookie2(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            setCookie2("sLocation", sLocationFormInput, 1);
            setCookie2("sCheck_in", sCheck_inFormInput, 1);
            setCookie2("sCheck_out", sCheck_outFormInput, 1);
            setCookie2("sAdult", sAdultFormInput, 1);
            setCookie2("sChild", sChildFormInput, 1);

            var filterFormInput = [];
            $("input[name='filter[]']:checked").each(function() {
                filterFormInput.push(parseInt($(this).val()));
            });

            if (filterFormInput.includes(valueClick) == true) {
                var filterCheck = filterFormInput.filter(unCheck);

                function unCheck(dataCheck) {
                    return dataCheck != valueClick;
                }

                var filteredArray = filterCheck.filter(function(item, pos) {
                    return filterCheck.indexOf(item) == pos;
                });
            } else {
                filterFormInput.push(valueClick);

                var filteredArray = filterFormInput.filter(function(item, pos) {
                    return filterFormInput.indexOf(item) == pos;
                });
            }

            if (valueCategory == null) {
                var subUrl =
                    `sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}&fCategory=&filter=${filteredArray}`;
            } else {
                var subUrl =
                    `sLocation=${sLocationFormInput}&sCheck_in=${sCheck_inFormInput}&sCheck_out=${sCheck_outFormInput}&sAdult=${sAdultFormInput}&sChild=${sChildFormInput}&fCategory=${valueCategory}&filter=${filteredArray}`;
            }

            villaRefreshFilter(subUrl);
        }
    </script>

    <script>
        function filters_click() {
            var element = document.getElementById("filters");
            element.classList.toggle("filter-active");
            $('#modal-filters').modal('show');
        }
    </script>

    @auth
        @include('components.favorit.like-favorit')
    @endauth
    <script src="{{ asset('assets/js/translate.js') }}"></script>
    {{-- END SEARCH FUNCTION --}}
@endsection
