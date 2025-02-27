    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            margin-right: 9px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 0px;
            bottom: 0px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }


        input[type="text"]:disabled {
            background: #ffffff;
            border-style: none;
        }

        header {
            transition: all 0.2s ease;
        }

        .right-bar {
            text-align: right;
            display: flex;
            position: relative;
        }

        .right-bar input[type="button"] {
            font-size: 12px;
            border: solid 1px #444444;
            background: #444444;
            color: #ffffff;
            padding: 5px 10px;
            top: 10px !important;
            position: relative;
            border-radius: 15px;
            max-height: 33px;
            margin-right: 5px;
        }

        /*
        .right-bar i {
            width: 30px;
            height: 30px;
            background: #444;
            color: #fff;
            padding: 5px 6px;
            text-align: center;
            border-radius: 5px;
            margin-right: 5px;
            display: inline-block;
            margin-top: 10px;
            font-size: 18px;
            cursor: pointer;
        }*/

        .col-4.right-bar i:hover {
            background: #ff7400;
        }

        .right-bar input[type="button"] {
            top: 0;
        }

        .dropdown-pd-0 {
            padding: 0 !important;
            margin: 3px 0;
        }

        .dropdown-menu {
            border-radius: 15px !important;
            min-width: 220px;
        }

        .text-small {
            font-size: 12px;
            color: #899097;
        }

        .plus-min {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: solid 1px #b5b5b5;
            margin: 0 auto;
        }

        .text-small span {
            margin-left: 0 !important;
            font-size: 10px;
            color: #798289;
        }

        .dropdown-menu:hover {
            background-color: white !important;
        }

        .dropdown-pd-0:hover {
            background-color: white !important;
        }

        .input-guest {
            position: absolute;
            width: 184px;
            top: 0px;
            left: 0px;
            height: 62px;
        }

        .bg-orange {
            background-color: #ff7400;
        }

        .flatpickr-wrapper {
            padding: 0 !important;
        }

        .guests {
            min-width: 241px;
        }

        @media only screen and (max-width: 328px) {
            .guests {
                min-width: 234px;
            }
        }

        .btn-filter-header {
            outline: none;
            background: #ff7400;
            border-radius: 40px;
            margin-right: 5px;
            padding: 0 12px;
        }

        body {
            overflow-y: scroll !important;
        }

        /*Dropdown users stile*/

        .dropbtn {
            margin-right: 0px;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: #ffffff !important;
            padding: 0;
        }

        .dropbtn::after {
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            content: "\f007";
            color: #ff7400;
            font-size: 18px;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #ff7400;
            box-shadow: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        @media only screen and (max-width: 767px) {
            .dropdown {
                display: none !important;
            }
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 232px;
            overflow: auto;
            z-index: 1;
            right: -6px;
            top: 64px;
            border-radius: 15px;
            border: solid 2px #ff7400;
            padding: 10px 0;
        }

        .dropdown-content a {
            color: #282828;
            text-decoration: none;
            display: block;
            font-size: 12px;
            font-weight: 600;
            padding: 6px 16px;
            text-align: left;
        }

        .dropdown a:hover {
            color: #ff7400;
        }

        .show {
            display: block;
        }

        .dropdown-content a {
            cursor: pointer;
        }

        .dropdown-content a:hover {
            color: #ff7400 !important;
        }
    </style>

    @php
        $condition_villa = Route::is('list') || Route::is('property_type') || Route::is('filter') || Route::is('price') || Route::is('more_filter') || Route::is('box_filter') || Route::is('sort_low_to_high') || Route::is('sort_high_to_low') || Route::is('sort_popularity') || Route::is('sort_newest') || Route::is('sort_highest_rating') || Route::is('filter_activity') || Route::is('filter_activity_get_subcategory') || Route::is('search_villa') || Route::is('amenities_filter') || Route::is('filters') || Route::is('search_villa_combine') || Route::is('search_home_combine');
        $condition_hotel = Route::is('hotel_list') || Route::is('search_hotel') || Route::is('filters-hotel');
        $condition_restaurant = Route::is('restaurant_list') || Route::is('search_restaurant') || Route::is('filter_restaurant') || Route::is('search_food');
        $condition_things_to_do = Route::is('activity_list') || Route::is('search_activity') || Route::is('search_wow') || Route::is('search_wow_sub');
        $condition_collaborator = Route::is('collaborator_list') || Route::is('search_collaborator');
        $tema = isset($_COOKIE['tema']) ? $_COOKIE['tema'] : null;
        // set theme color
        $bgColor = 'bg-body-light';
        $textColor = 'font-black';
        $rowLineColor = 'row-line-white';
        $listColor = 'listoption-light';
        $shadowColor = 'box-shadow-light';
        if (isset($_COOKIE['tema'])) {
            if ($_COOKIE['tema'] == 'black') {
                $bgColor = 'bg-body-black';
                $textColor = 'font-light';
                $rowLineColor = 'row-line-grey';
                $listColor = '{{ $listColor }}';
                $shadowColor = 'box-shadow-dark';
            }
        }

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $url = 'https://';
        } else {
            $url = 'http://';
        }
        // Append the host(domain name, ip) to the URL.
        $url .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL
        $url .= $_SERVER['REQUEST_URI'];

        $url_homes = env('APP_URL') . '/homes-list';
        $url_food = env('APP_URL') . '/food-list';
        $url_wow = env('APP_URL') . '/wow-list';
        $url_hotel = env('APP_URL') . '/hotel-list';

        if ($url == $url_homes || $url == $url_food || $url == $url_wow || $url == $url_hotel) {
            setcookie('sCheck_in', null, time() + 86400 * 30, '/');
            setcookie('sCheck_out', null, time() + 86400 * 30, '/');
            setcookie('sLocation', null, time() + 86400 * 30, '/');
        }
    @endphp

    <div class="row nav-row">
        <div id="navbar-first-dekstop" class="col-lg-2 logo mb-lg-0 villa-list-header-logo d-flex align-items-center">
            <a href="{{ route('index') }}" target="_blank"><img style="width: auto; height: 40px;"
                    src="{{ asset('assets/logo.png') }}" alt="oke"></a>
            <div id="navbar-collapse-button" class="flex-fill d-flex justify-content-end">

                <button type="button" class="btn-filter-header"
                    @if ($condition_villa) onclick="modalFiltersHomes();"
                    @elseif($condition_hotel)
                        onclick="modalFiltersHotel();"
                    @elseif($condition_restaurant || $condition_things_to_do)
                        onclick="moreSubCategory();"
                    @elseif($condition_collaborator)
                        onclick="filterCollab();" @endif>
                    <img src="{{ asset('assets/icon/menu/filter.svg') }}" style="width: 20px; height: auto;">
                </button>


                <div id="searchbox-mobile" class="searchbox searchbox-display-block searchbox-villa" onclick="popUp();"
                    style="cursor: pointer; width: 50px; border: none; margin: 0px;">
                    <p>
                        <span class="top-search">
                            <img src="{{ asset('assets/icon/menu/search.svg') }}" style="width: 20px; height: auto;">
                            <!-- <i class="fa fa-search"></i> -->
                        </span>
                    </p>
                </div>
                <button class="navbar-toggler ps-1" type="button" id="expand-mobile-btn">
                    <i class="fa-solid fa-bars list-description {{ $textColor }}"></i>
                </button>
            </div>
        </div>

        @if ($condition_villa)
            @php
                $get_loc = app('request')->input('sLocation');
                $get_adult = app('request')->input('sAdult');
                $get_child = app('request')->input('sChild');
                $get_infant = app('request')->input('sInfant');
                $get_pet = app('request')->input('sPet');

                if ($get_loc == null) {
                    $get_loc = '';
                }

                // if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] != '') {
                //     $get_loc = $_COOKIE['sLocation'];
                // }

                // if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] == '') {
                //     $get_loc = '';
                // }

                // if (isset($_COOKIE['sCheck_in'])) {
                //     $get_check_in = $_COOKIE['sCheck_in'];
                // }

                // if (isset($_COOKIE['sCheck_out'])) {
                //     $get_check_out = $_COOKIE['sCheck_out'];
                // }
                $get_check_in = '';
                $get_check_out = '';

                if (request()->sCheck_in) {
                    $get_check_in = request()->sCheck_in;
                }

                if (request()->sCheck_out) {
                    $get_check_out = request()->sCheck_out;
                }

                function dateDiffe($get_check_in, $get_check_out)
                {
                    $date1_ts = strtotime($get_check_in);
                    $date2_ts = strtotime($get_check_out);
                    $diff = $date2_ts - $date1_ts;
                    return round($diff / 86400);
                }

                if ($get_check_in == null) {
                    $get_dates = __('user_page.Add Date');
                } else {
                    if ($get_check_out == $get_check_in) {
                        $dateDiffe = 1;
                    } else {
                        $dateDiffe = dateDiffe($get_check_in, $get_check_out);
                    }
                    $get_dates = $dateDiffe . ' ' . trans_choice('user_page.x days', $dateDiffe);
                }

                if ($get_adult == 0) {
                    $get_adult = 1;
                }

                if ($get_child == 0) {
                    $get_child = 0;
                }

                if ($get_infant == 0) {
                    $get_infant = 0;
                }

                if ($get_pet == 0) {
                    $get_pet = 0;
                }

                $get_guest = $get_adult + $get_child;

                if (request()->sLocation) {
                    $get_loc = request()->sLocation;
                }

            @endphp
            <div class="col-lg-8 search-box" style="height: 50px;">
                <div class="row">
                    <div class="col-12 text-center max-h-50">
                        <div id="searchbox" class="searchbox searchbox-display-block searchbox-villa" onclick="popUp();"
                            style="cursor: pointer; width: 49%;">
                            <p>
                                {{ Request::is('homes-list*') || $get_loc == null ? __('user_page.Add Location') : $get_loc }}
                                | {{ $get_dates }}
                                | {{ $get_guest . ' ' . __('user_page.guest') }}
                                <span class="top-search">
                                    <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                        style="width: 20px; height: auto;">
                                    <!-- <i class="fa fa-search"></i> -->
                                </span>
                            </p>
                        </div>

                        <div id="search_bar" class="searchbar-list-display-none">
                            <div id="change_display_block" class="display-none nav-menu-container">
                                <ul class="nav-link-container">
                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        @if (Request::is('homes-list*'))
                                            <a href="{{ route('list') }}" id="villa-form" target="_blank"
                                                class="nav-link-form-detail">
                                            @else
                                                <a href="../homes/search?sLocation={{ $get_loc ?? '' }}&sCheck_in={{ $get_check_in ?? '' }}&sCheck_out={{ $get_check_out ?? '' }}&sAdult=1&sChild=0&fPropertyType=&fAmenities="
                                                    target="_blank" id="villa-form" class="nav-link-form-detail">
                                        @endIf
                                        @if ($condition_villa)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                    style="width: 31px; height: auto;">
                                            </div>
                                            <!-- <i id="villa-button"
                                                class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                    style="width: 31px; height: auto;">
                                            </div>
                                            <!-- <i id="villa-button"
                                                class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Homes') }}
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('list') }}" id="villa-form" class="nav-link-form-detail"
                                            target="_blank">
                                            @if ($condition_villa)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Homes') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        @if (Request::is('homes-list*'))
                                            <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                                target="_blank" class="nav-link-form-detail">
                                            @else
                                                <a href="../food/search?sLocation={{ $get_loc ?? '' }}&sKeyword="
                                                    target="_blank" id="restaurant-form" class="nav-link-form-detail">
                                        @endIf

                                        @if ($condition_restaurant)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i id="restaurant-button"
                                                class=" {{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i id="restaurant-button"
                                                class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Food') }}
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('restaurant_list') }}" id="restaurant-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_restaurant)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class=" {{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Food') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        @if (Request::is('homes-list*'))
                                            <a href="{{ route('hotel_list') }}" id="hotel-form" target="_blank"
                                                class="nav-link-form-detail">
                                            @else
                                                <a href="../hotel/search?fViews=&sLocation={{ $get_loc ?? '' }}&sCheck_in={{ $get_check_in ?? '' }}&sCheck_out={{ $get_check_out ?? '' }}&sAdult=1&sChild=0"
                                                    target="_blank" id="hotel-form" class="nav-link-form-detail">
                                        @endIf

                                        @if ($condition_hotel)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                    style="width: 29px; height: auto;">
                                            </div>
                                            <!-- <i id="hotel-button"
                                                class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                    style="width: 29px; height: auto;">
                                            </div>
                                            <!-- <i id="hotel-button"
                                                class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Hotels') }}
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('hotel_list') }}" id="hotel-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_hotel)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Hotels') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        @if (Request::is('homes-list*'))
                                            <a href="{{ route('activity_list') }}" id="activity-form"
                                                target="_blank" class="nav-link-form-detail">
                                            @else
                                                <a href="../wow/search?sLocation={{ $get_loc ?? '' }}&sKeyword=&sStart={{ $get_check_in ?? '' }}&sEnd={{ $get_check_out ?? '' }}&fCategory=1&fSubCategory="
                                                    target="_blank" id="activity-form" class="nav-link-form-detail">
                                        @endIf

                                        @if ($condition_things_to_do)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                    style="width: 29px; height: auto; filter: none;">
                                            </div>
                                            <!-- <i id="activity-button" style="font-size: 24px;"
                                                class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                    style="width: 29px; height: auto; filter: none;">
                                            </div>
                                            <!-- <i id="activity-button" style="font-size: 24px;"
                                                class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            <!-- {{ __('user_page.things to do') }} -->
                                            WoW
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('activity_list') }}" id="activity-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_things_to_do)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                <!-- {{ __('user_page.things to do') }} -->
                                                WoW
                                            </p>
                                        </a>
                                    @endif
                                    <a href="{{ route('ahost') }}" id="activity-form" class="nav-link-form-detail"
                                        target="_blank" style="margin-left: 60px;">
                                        <div
                                            class="list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail {{ $textColor }}">
                                            <img src="{{ asset('assets/icon/menu/list.svg') }}"
                                                style="width: 22px; height: auto;">
                                        </div>
                                        <!-- <i id="activity-button" style="font-size: 24px;"
                                            class="list-description fa-solid fa-clipboard-list nav-link-gap nav-link-style-detail nav-link-icon-style-detail {{ $textColor }}"></i> -->
                                        <p class="list-description {{ $textColor }}">
                                            {{ __('user_page.Create Listing') }}
                                        </p>
                                    </a>
                                </ul>
                            </div>

                            <div>
                                <div class="bar bar-villa">
                                    <div class="location">
                                        <p>
                                            {{ __('user_page.Location') }}
                                        </p>
                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant"
                                            value="{{ Request::is('homes-list*') || $get_loc == null ? '' : $get_loc }}"
                                            id="loc_sugest_desktop" name="sLocation"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 12px; top: 4px; left: 3px; cursor: pointer; border: none;"
                                            placeholder="{{ __('user_page.Where are you going?') }}">

                                        <div id="sugest_desktop" class="location-popup display-none">
                                            @php
                                                $location = App\Http\Controllers\ViewController::get_location();
                                                $hotelName = App\Http\Controllers\HotelController::get_name();
                                                $addressName = App\Http\Controllers\ViewController::get_address();
                                                $restaurantName = App\Http\Controllers\Restaurant\RestaurantController::get_name();
                                                $activityName = App\Http\Controllers\Activity\ActivityController::get_name();
                                            @endphp
                                            <div class="location-popup-container h-100">
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op_desktop"
                                                            data-value="Canggu">Canggu</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op_desktop"
                                                            data-value="Seminyak">Seminyak</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op_desktop"
                                                            data-value="Ubud">Ubud</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op_desktop"
                                                            data-value="Kuta">Kuta</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op_desktop"
                                                            data-value="Pecatu">Pecatu</a>
                                                    </div>
                                                </div>
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad"
                                                                src="{{ LazyLoad::show() }}"
                                                                data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op_desktop"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op_desktop"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($addressName as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op"
                                                                data-value="{{ $item->address }}, {{ $item->location->name }}">{{ $item->address }}, {{ $item->location->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($hotelName as $item2)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('hotel', $item2->id_hotel) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/hotel/hotel.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('hotel', $item2->id_hotel) }}"
                                                                type="button" class="location_op_desktop" target="_blank"
                                                                data-value="{{ $item2->name }}">{{ $item2->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($restaurantName as $item3)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('restaurant', $item3->id_restaurant) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('restaurant', $item3->id_restaurant) }}"
                                                                type="button" class="location_op_desktop" target="_blank"
                                                                data-value="{{ $item3->name }}">{{ $item3->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($activityName as $item4)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('activity', $item4->id_activity) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/activity.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('activity', $item4->id_activity) }}"
                                                                type="button" class="location_op_desktop" target="_blank"
                                                                data-value="{{ $item4->name }}">{{ $item4->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty-desktop"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="check-in">
                                        <a type="button"
                                            style="position : absolute; z-index:1; width:300px; height: 60px; margin-left: -70px; margin-top: -8px"
                                            class="collapsible-check-search-desktop"></a>
                                        <p>{{ __('user_page.Check in') }}</p>
                                        <input type="text" onfocus="this.value=''"
                                            placeholder="{{ __('user_page.Add dates') }}" class="form-control"
                                            value="{{ $get_check_in }}" id="check_in2" name="sCheck_in"
                                            style="width: 100% !important; background-color: #ffffff00;">
                                    </div>
                                    <div class="check-out">
                                        <p>{{ __('user_page.Check out') }}</p>
                                        <input type="text" onfocus="this.value=''"
                                            style="background-color: #ffffff00;"
                                            placeholder="{{ __('user_page.Add dates') }}" class="form-control"
                                            value="{{ $get_check_out }}" id="check_out2" name="sCheck_out"
                                            readonly>
                                    </div>
                                    <div class="guests">
                                        <p>{{ __('user_page.Guests') }}</p>
                                        <ul class="nav">
                                            <li
                                                class="button-dropdown d-flex align-items-center justify-content-center">
                                                <input type="number" id="total_guest_desktop" value="{{ $get_guest }}"
                                                    style="width: 30px; border: 0;margin-right:5px; text-align: right; -moz-appearance: textfield; background: transparent;"
                                                    disabled min="1">
                                                {{ __('user_page.Guest') }}
                                                <a href="javascript:void(0)" class="dropdown-toggle input-guest">
                                                </a>
                                                <a class="dropdown-toggle-icon d-flex align-items-center"
                                                    style="margin-left: 10px;">
                                                    {{ __('user_page.Add') }}
                                                </a>
                                                <div class="guest-popup dropdown-menu">
                                                    <div class="guests-input-row">
                                                        <div class="col-6">
                                                            <div class="col-12 guest-type-container">
                                                                <p class="guest-type-title">
                                                                    {{ __('user_page.Adults') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Age 13 or above') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="adult_decrement_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="adult_desktop" name="sAdult"
                                                                    value="{{ $get_adult }}"
                                                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield;"
                                                                    min="1" readonly>
                                                            </div>
                                                            <a type="button" onclick="adult_increment_header_list()"
                                                                style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="guests-input-row">
                                                        <div class="col-6">
                                                            <div class="col-12 guest-type-container">
                                                                <p class="guest-type-title">
                                                                    {{ __('user_page.Children') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Ages 2–12') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="child_decrement_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="child_desktop" name="sChild"
                                                                    value="{{ $get_child }}"
                                                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield;"
                                                                    min="0" readonly>
                                                            </div>
                                                            <a type="button" onclick="child_increment_header_list()"
                                                                style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="guests-input-row">
                                                        <div class="col-6">
                                                            <div class="col-12 guest-type-container">
                                                                <p class="guest-type-title">
                                                                    {{ __('user_page.Infants') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Under 2') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="infant_decrement_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="infant_desktop" name="sInfant"
                                                                    value="{{ $get_infant }}"
                                                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield;"
                                                                    min="0" readonly>
                                                            </div>
                                                            <a type="button" onclick="infant_increment_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-plus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="guests-input-row">
                                                        <div class="col-6">
                                                            <div class="col-12 guest-type-container">
                                                                <p class="guest-type-title">
                                                                    {{ __('user_page.Pets') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Service animal ?') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="pet_decrement_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="pet_desktop" name="sPet"
                                                                    value="{{ $get_pet }}"
                                                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield;"
                                                                    min="0" readonly>
                                                            </div>
                                                            <a type="button" onclick="pet_increment_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-plus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="d-block m-auto"
                                                        style="background: #ff7400; color: white; padding: 5px 15px; border-radius: 10px; font-size: 18px;"
                                                        onclick="homesFilter({{ request()->get('fPropertyType') ?? 'null' }}, {{ request()->get('fAmenities') ?? 'null' }})">
                                                        Search
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="button">
                                        <button type="submit" class="btn-company d-block ms-auto me-1"
                                            style="z-index: 1; border: none; background: transparent; padding: 10px 15px !important;"
                                            onclick="homesFilter({{ request()->get('fPropertyType') ?? 'null' }}, {{ request()->get('fAmenities') ?? 'null' }})">
                                            Search
                                            {{-- <div class="cari">
                                                <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div> --}}
                                            <!-- <i class="fa fa-search cari"></i> -->
                                        </button>
                                    </div>

                                </div>

                                {{-- calendar --}}
                                <div class="content sidebar-popup" id="popup_check_search_desktop"
                                    style="margin-left: -955px; width: fit-content; padding: 0px;z-index: 999; min-height: 450px; max-height: 450px;">
                                    <div class="desk-e-call">
                                        <div class="flatpickr-container"
                                            style="display: flex; justify-content: center;">
                                            <div
                                                style="display: table; background-color: white;
                                                border-radius: 15px;">
                                                <div class="col-lg-12"
                                                    style="padding-left: 15px; padding-right: 30px; padding-top: 15px; text-align: right; text-align: center;">
                                                    <a type="button" id="clear_date_header"
                                                        style="padding-bottom: 20px; margin: 0px; font-size: 13px;">{{ __('user_page.Clear Dates') }}</a>
                                                    <p style="margin: 0px; font-size: 13px;"></p>
                                                </div>
                                                <div class="flatpickr" id="inline_reserve_search_desktop"
                                                    style="text-align: left;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- calendar --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($condition_hotel)
            @php
                $get_loc = app('request')->input('sLocation');
                $get_check_in = '';
                $get_check_out = '';
                $get_adult = app('request')->input('sAdult');
                $get_child = app('request')->input('sChild');
                $get_infant = app('request')->input('sInfant');
                $get_pet = app('request')->input('sPet');

                if ($get_loc == null) {
                    $get_loc = '';
                }

                // if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] != '') {
                //     $get_loc = $_COOKIE['sLocation'];
                // }

                // if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] == '') {
                //     $get_loc = '';
                // }

                // if (isset($_COOKIE['sCheck_in'])) {
                //     $get_check_in = $_COOKIE['sCheck_in'];
                // }

                // if (isset($_COOKIE['sCheck_out'])) {
                //     $get_check_out = $_COOKIE['sCheck_out'];
                // }

                if (request()->sCheck_in) {
                    $get_check_in = request()->sCheck_in;
                }

                if (request()->sCheck_out) {
                    $get_check_out = request()->sCheck_out;
                }

                if ($get_check_in == null) {
                    $get_dates = __('user_page.Add Date');
                } else {
                    if ($get_check_out == $get_check_in) {
                        $days = '1 ' . trans_choice('user_page.x days', 1);
                    } else {
                        $diff = abs(strtotime($get_check_out) - strtotime($get_check_in));
                        $years = floor($diff / (365 * 60 * 60 * 24));
                        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                    }
                    $get_dates = $days . ' ' . trans_choice('user_page.x days', $days);
                }

                if ($get_adult == 0) {
                    $get_adult = 1;
                }

                if ($get_child == 0) {
                    $get_child = 0;
                }

                if ($get_infant == 0) {
                    $get_infant = 0;
                }

                if ($get_pet == 0) {
                    $get_pet = 0;
                }

                $get_guest = $get_adult + $get_child;

                if (request()->sLocation) {
                    $get_loc = request()->sLocation;
                }

            @endphp
            <div class="col-lg-8 search-box" style="height: 50px;">
                <div class="row">
                    <div class="col-12 text-center max-h-50">
                        <div id="searchbox" class="searchbox searchbox-display-block" onclick="popUp();"
                            style="cursor: pointer; width: 49%;">
                            <p>
                                {{ Request::is('hotel-list*') || $get_loc == null ? __('user_page.Add Location') : $get_loc }}
                                | {{ $get_dates }}
                                | {{ $get_guest . ' ' . __('user_page.guest') }}
                                <span class="top-search">
                                    <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                        style="width: 20px; height: auto;">
                                    <!-- <i class="fa fa-search"></i> -->
                                </span>
                            </p>
                        </div>

                        <div id="search_bar" class="searchbar-list-display-none">
                            <div id="change_display_block" class="display-none nav-menu-container">
                                <ul class="nav-link-container">
                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        @if (Request::is('hotel-list*'))
                                            <a href="{{ route('list') }}" id="villa-form" target="_blank"
                                                class="nav-link-form-detail">
                                            @else
                                                <a href="../homes/search?sLocation={{ $get_loc ?? '' }}&sCheck_in={{ $get_check_in ?? '' }}&sCheck_out={{ $get_check_out ?? '' }}&sAdult=1&sChild=0&fPropertyType=&fAmenities="
                                                    target="_blank" id="villa-form" class="nav-link-form-detail">
                                        @endIf

                                        @if ($condition_villa)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                    style="width: 31px; height: auto;">
                                            </div>
                                            <!-- <i id="villa-button"
                                                class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                    style="width: 31px; height: auto;">
                                            </div>
                                            <!-- <i id="villa-button"
                                                class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Homes') }}
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('list') }}" id="villa-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_villa)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Homes') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        @if (Request::is('hotel-list*'))
                                            <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                                target="_blank" class="nav-link-form-detail">
                                            @else
                                                <a href="../food/search?sLocation={{ $get_loc ?? '' }}&sKeyword="
                                                    target="_blank" id="restaurant-form"
                                                    class="nav-link-form-detail">
                                        @endIf

                                        @if ($condition_restaurant)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i id="restaurant-button"
                                                class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i id="restaurant-button"
                                                class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Food') }}
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                            target="_blank" class="nav-link-form-detail">
                                            @if ($condition_restaurant)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Food') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        @if (Request::is('hotel-list*'))
                                            <a href="{{ route('hotel_list') }}" id="hotel-form" target="_blank"
                                                class="nav-link-form-detail">
                                            @else
                                                <a href="../hotel/search?fViews=&sLocation={{ $get_loc ?? '' }}&sCheck_in={{ $get_check_in ?? '' }}&sCheck_out={{ $get_check_in ?? '' }}&sAdult=1&sChild=0"
                                                    target="_blank" id="hotel-form" class="nav-link-form-detail">
                                        @endIf

                                        @if ($condition_hotel)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                    style="width: 29px; height: auto;">
                                            </div>
                                            <!-- <i id="hotel-button"
                                                class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                    style="width: 29px; height: auto;">
                                            </div>
                                            <!-- <i id="hotel-button"
                                                class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Hotels') }}
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('hotel_list') }}" id="hotel-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_hotel)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Hotels') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        @if (Request::is('hotel-list*'))
                                            <a href="{{ route('activity_list') }}" id="activity-form"
                                                target="_blank" class="nav-link-form-detail">
                                            @else
                                                <a href="../wow/search?sLocation={{ $get_loc ?? '' }}&sKeyword=&sStart={{ $get_check_in ?? '' }}&sEnd={{ $get_check_out ?? '' }}&fCategory=1&fSubCategory="
                                                    target="_blank" id="activity-form" class="nav-link-form-detail">
                                        @endIf

                                        @if ($condition_things_to_do)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                    style="width: 29px; height: auto; filter: none;">
                                            </div>
                                            <!-- <i id="activity-button" style="font-size: 24px;"
                                                class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                    style="width: 29px; height: auto; filter: none;">
                                            </div>
                                            <!-- <i id="activity-button" style="font-size: 24px;"
                                                class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            <!-- {{ __('user_page.things to do') }} -->
                                            WoW
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('activity_list') }}" id="activity-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_things_to_do)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                <!-- {{ __('user_page.things to do') }} -->
                                                WoW
                                            </p>
                                        </a>
                                    @endif
                                    <a href="{{ route('ahost') }}" id="activity-form" target="_blank"
                                        class="nav-link-form-detail" style="margin-left: 60px;">
                                        <div
                                            class="list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail {{ $textColor }}">
                                            <img src="{{ asset('assets/icon/menu/list.svg') }}"
                                                style="width: 22px; height: auto;">
                                        </div>
                                        <!-- <i id="activity-button" style="font-size: 24px;"
                                            class="list-description fa-solid fa-clipboard-list nav-link-gap nav-link-style-detail nav-link-icon-style-detail {{ $textColor }}"></i> -->
                                        <p class="list-description {{ $textColor }}">
                                            {{ __('user_page.Create Listing') }}
                                        </p>
                                    </a>
                                </ul>
                            </div>

                            <div>
                                <div class="bar bar-villa">
                                    <div class="location">
                                        <p>
                                            {{ __('user_page.Location / Hotel Name') }}
                                        </p>
                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant"
                                            value="{{ Request::is('hotel-list*') || $get_loc == null ? '' : $get_loc }}"
                                            id="loc_sugest_desktop" name="sLocation"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 14px; top: 4px; left: 3px; cursor: pointer; border: none;"
                                            placeholder="{{ __('user_page.Where are you going?') }}">

                                        <div id="sugest_desktop" class="location-popup display-none">
                                            <div class="location-popup-container h-100">
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Canggu">Canggu</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op_desktop"
                                                            data-value="Seminyak">Seminyak</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op_desktop"
                                                            data-value="Ubud">Ubud</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op_desktop"
                                                            data-value="Kuta">Kuta</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first-desktop"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op_desktop"
                                                            data-value="Pecatu">Pecatu</a>
                                                    </div>
                                                </div>
                                                @php
                                                    $location = App\Http\Controllers\ViewController::get_location();
                                                    $hotelName = App\Http\Controllers\HotelController::get_name();
                                                    $restaurantName = App\Http\Controllers\Restaurant\RestaurantController::get_name();
                                                    $activityName = App\Http\Controllers\Activity\ActivityController::get_name();
                                                @endphp
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad"
                                                                src="{{ LazyLoad::show() }}"
                                                                data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op_desktop"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op_desktop"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($hotelName as $item2)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('hotel', $item2->id_hotel) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/hotel/hotel.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('hotel', $item2->id_hotel) }}"
                                                                type="button" class="location_op_desktop" target="_blank"
                                                                data-value="{{ $item2->name }}">{{ $item2->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($restaurantName as $item3)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('restaurant', $item3->id_restaurant) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('restaurant', $item3->id_restaurant) }}"
                                                                type="button" class="location_op_desktop" target="_blank"
                                                                data-value="{{ $item3->name }}">{{ $item3->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($activityName as $item4)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('activity', $item4->id_activity) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/activity.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('activity', $item4->id_activity) }}"
                                                                type="button" class="location_op_desktop" target="_blank"
                                                                data-value="{{ $item4->name }}">{{ $item4->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty-desktop"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="check-in">
                                        <a type="button"
                                            style="position : absolute; z-index:1; width:300px; height: 60px; margin-left: -70px; margin-top: -8px"
                                            class="collapsible-check-search-desktop"></a>
                                        <p>{{ __('user_page.Check in') }}</p>
                                        <input type="text" onfocus="this.value=''"
                                            placeholder="{{ __('user_page.Add dates') }}" class="form-control"
                                            value="{{ $get_check_in }}" id="check_in2" name="sCheck_in"
                                            style="width: 100% !important; background-color: #ffffff00;">
                                    </div>
                                    <div class="check-out">
                                        <p>{{ __('user_page.Check out') }}</p>
                                        <input type="text" onfocus="this.value=''"
                                            style="background-color: #ffffff00;"
                                            placeholder="{{ __('user_page.Add dates') }}" class="form-control"
                                            value="{{ $get_check_out }}" id="check_out2" name="sCheck_out"
                                            readonly>
                                    </div>
                                    <div class="guests">
                                        <p>{{ __('user_page.Guests') }}</p>
                                        <ul class="nav">
                                            <li
                                                class="button-dropdown d-flex align-items-center justify-content-center">
                                                <input type="number" id="total_guest_desktop" value="{{ $get_guest }}"
                                                    style="width: 30px;margin-right:5px; border: 0; text-align: right; background: transparent; -moz-appearance: textfield;"
                                                    disabled min="1">
                                                {{ __('user_page.Guest') }}
                                                <a href="javascript:void(0)" class="dropdown-toggle input-guest">
                                                </a>
                                                <a class="dropdown-toggle-icon d-flex align-items-center"
                                                    style="margin-left:10px;">
                                                    {{ __('user_page.Add') }}
                                                </a>
                                                <div class="guest-popup dropdown-menu">
                                                    <div class="guests-input-row">
                                                        <div class="col-6">
                                                            <div class="col-12 guest-type-container">
                                                                <p class="guest-type-title">
                                                                    {{ __('user_page.Adults') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Age 13 or above') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="adult_decrement_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="adult_desktop" name="sAdult"
                                                                    value="{{ $get_adult }}"
                                                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield;"
                                                                    min="1" readonly>
                                                            </div>
                                                            <a type="button" onclick="adult_increment_header_list()"
                                                                style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="guests-input-row">
                                                        <div class="col-6">
                                                            <div class="col-12 guest-type-container">
                                                                <p class="guest-type-title">
                                                                    {{ __('user_page.Children') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Ages 2–12') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="child_decrement_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="child_desktop" name="sChild"
                                                                    value="{{ $get_child }}"
                                                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield;"
                                                                    min="0" readonly>
                                                            </div>
                                                            <a type="button" onclick="child_increment_header_list()"
                                                                style="height: 39px; width:39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-plus" style="padding:0px;"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="guests-input-row">
                                                        <div class="col-6">
                                                            <div class="col-12 guest-type-container">
                                                                <p class="guest-type-title">
                                                                    {{ __('user_page.Infants') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Under 2') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="infant_decrement_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="infant_desktop" name="sInfant"
                                                                    value="{{ $get_infant }}"
                                                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield;"
                                                                    min="0" readonly>
                                                            </div>
                                                            <a type="button" onclick="infant_increment_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-plus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="guests-input-row">
                                                        <div class="col-6">
                                                            <div class="col-12 guest-type-container">
                                                                <p class="guest-type-title">
                                                                    {{ __('user_page.Pets') }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12" style="padding: 0px;">
                                                                <p class="guest-type-desc">
                                                                    {{ __('user_page.Service animal ?') }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-6"
                                                            style="display: flex; align-items: center; justify-content: end;">
                                                            <a type="button" onclick="pet_decrement_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-minus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                            <div
                                                                style="width: 40px; text-align: center; color: grey; font-size: 13px; padding: 0px;">
                                                                <input type="number" id="pet_desktop" name="sPet"
                                                                    value="{{ $get_pet }}"
                                                                    style="text-align: center; border:none; width:40px; -moz-appearance: textfield;"
                                                                    min="0" readonly>
                                                            </div>
                                                            <a type="button" onclick="pet_increment_header_list()"
                                                                style="height: 39px; width: 39px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px; display: flex; align-items: center; justify-content: center;">
                                                                <i class="fa-solid fa-plus guests-style"
                                                                    style="padding:0px"></i>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="d-block m-auto"
                                                        style="background: #ff7400; color: white; padding: 5px 15px; border-radius: 10px; font-size: 18px;"
                                                        onclick="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('filter') ?? 'null' }}, false)">
                                                        Search
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="button">
                                        <button type="submit" class="btn-company d-block ms-auto me-1"
                                            style="z-index: 1; border: none; background: transparent; padding: 10px 15px !important;"
                                            onclick="hotelFilter({{ request()->get('fCategory') ?? 'null' }}, {{ request()->get('filter') ?? 'null' }}, false)">
                                            Search
                                            {{-- <div class="cari">
                                                <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div> --}}
                                            <!-- <i class="fa fa-search cari"></i> -->
                                        </button>
                                    </div>

                                </div>
                                {{-- calendar --}}
                                <div class="content sidebar-popup" id="popup_check_search_desktop"
                                    style="margin-left: -975px; width:800px; padding:0px; min-height: 450px; max-height: 450px;">
                                    <div class="desk-e-call">
                                        <div class="flatpickr-container"
                                            style="display: flex; justify-content: center;">
                                            <div
                                                style="display: table; background-color: white;
                                                border-radius: 15px;">
                                                <div class="col-lg-12"
                                                    style="padding-left: 15px; padding-right: 30px; padding-top: 15px; text-align: right; text-align: center;">
                                                    <a type="button" id="clear_date_header"
                                                        style="padding-bottom: 20px; margin: 0px; font-size: 13px;">{{ __('user_page.Clear Dates') }}</a>
                                                    <p style="margin: 0px; font-size: 13px;"></p>
                                                </div>
                                                <div class="flatpickr" id="inline_reserve_search_desktop"
                                                    style="text-align: left;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- calendar --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($condition_restaurant)
            @php
                $get_loc = app('request')->input('sLocation');
                $get_keyword = app('request')->input('sKeyword');
                $get_cuisine = app('request')->input('sCuisine');

                $cuisiness = App\Models\RestaurantCuisine::where('id_cuisine', $get_cuisine)
                    ->select('name')
                    ->first();

                if ($get_loc == null) {
                    $get_loc = '';
                }

                // if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] != '') {
                //     $get_loc = $_COOKIE['sLocation'];
                // }

                // if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] == '') {
                //     $get_loc = '';
                // }

                if (request()->sLocation) {
                    $get_loc = request()->sLocation;
                }

                if ($get_keyword == null) {
                    $get_keyword = __('user_page.Type of Food');
                }

            @endphp
            <div class="col-lg-8 search-box" style="height: 50px;">
                <div class="row">
                    <div class="col-12 text-center max-h-50">
                        <div id="searchbox" class="searchbox searchbox-display-block" onclick="popUp();"
                            style="cursor: pointer; width: 49%;">
                            <p>
                                {{ Request::is('food-list*') || $get_loc == null ? __('user_page.Add Location') : $get_loc }}
                                | {{ $get_keyword }}
                                <span class="top-search">
                                    <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                        style="width: 20px; height: auto;">
                                    <!-- <i class="fa fa-search"></i> -->
                                </span>
                            </p>
                        </div>
                        <div id="search_bar" class="searchbar-list-display-none">
                            <div id="change_display_block" class="display-none nav-menu-container">
                                <ul class="nav-link-container">
                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        @if (Request::is('food-list*'))
                                            <a href="{{ route('list') }}" id="villa-form" target="_blank"
                                                class="nav-link-form-detail">
                                            @else
                                                <a href="../homes/search?sLocation={{ $get_loc ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0&fPropertyType=&fAmenities="
                                                    target="_blank" id="villa-form" class="nav-link-form-detail">
                                        @endIf

                                        @if ($condition_villa)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                    style="width: 31px; height: auto;">
                                            </div>
                                            <!-- <i id="villa-button"
                                                class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                    style="width: 31px; height: auto;">
                                            </div>
                                            <!-- <i id="villa-button"
                                                class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Homes') }}
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('list') }}" id="villa-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_villa)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Homes') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        @if (Request::is('food-list*'))
                                            <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                                target="_blank" class="nav-link-form-detail">
                                            @else
                                                <a href="../food/search?sLocation={{ $get_loc ?? '' }}&sKeyword="
                                                    target="_blank" id="restaurant-form"
                                                    class="nav-link-form-detail">
                                        @endIf

                                        @if ($condition_restaurant)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i id="restaurant-button"
                                                class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i id="restaurant-button"
                                                class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Food') }}
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                            target="_blank" class="nav-link-form-detail">
                                            @if ($condition_restaurant)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Food') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                        @if (Request::is('food-list*'))
                                            <a href="{{ route('hotel_list') }}" id="hotel-form" target="_blank"
                                                class="nav-link-form-detail">
                                            @else
                                                <a href="../hotel/search?fViews=&sLocation={{ $get_loc ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0"
                                                    target="_blank" id="hotel-form" class="nav-link-form-detail">
                                        @endIf

                                        @if ($condition_hotel)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                    style="width: 29px; height: auto;">
                                            </div>
                                            <!-- <i id="hotel-button"
                                                class="{{ $textColor }} list-descriptionfa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                    style="width: 29px; height: auto;">
                                            </div>
                                            <!-- <i id="hotel-button"
                                                class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Hotels') }}
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('hotel_list') }}" id="hotel-form" target="_blank"
                                            class="nav-link-form-detail">
                                            @if ($condition_hotel)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="{{ $textColor }} list-descriptionfa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Hotels') }}
                                            </p>
                                        </a>
                                    @endif

                                    @if (isset($_COOKIE['sLocation']))
                                        @if (Request::is('food-list'))
                                            <a href="{{ route('activity_list') }}" id="activity-form"
                                                target="_blank" class="nav-link-form-detail">
                                            @else
                                                <a href="../wow/search?sLocation={{ $get_loc ?? '' }}&sKeyword=&sDate=&fCategory=1&fSubCategory="
                                                    target="_blank" id="activity-form"
                                                    class="nav-link-form-detail">
                                        @endIf

                                        @if ($condition_things_to_do)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                    style="width: 29px; height: auto; filter: none;">
                                            </div>
                                            <!-- <i id="activity-button" style="font-size: 24px;"
                                                class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                    style="width: 29px; height: auto; filter: none;">
                                            </div>
                                            <!-- <i id="activity-button" style="font-size: 24px;"
                                                class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            <!-- {{ __('user_page.things to do') }} -->
                                            WoW
                                        </p>
                                        </a>
                                    @else
                                        <a href="{{ route('activity_list') }}" id="activity-form"
                                            target="_blank" class="nav-link-form-detail">
                                            @if ($condition_things_to_do)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                <!-- {{ __('user_page.things to do') }} -->
                                                WoW
                                            </p>
                                        </a>
                                    @endif
                                    <a href="{{ route('ahost') }}" id="activity-form" target="_blank"
                                        class="nav-link-form-detail" style="margin-left: 60px;">
                                        <div
                                            class="list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail {{ $textColor }}">
                                            <img src="{{ asset('assets/icon/menu/list.svg') }}"
                                                style="width: 22px; height: auto;">
                                        </div>
                                        <!-- <i id="activity-button" style="font-size: 24px;"
                                            class="list-description fa-solid fa-clipboard-list nav-link-gap nav-link-style-detail nav-link-icon-style-detail {{ $textColor }}"></i> -->
                                        <p class="list-description {{ $textColor }}">
                                            {{ __('user_page.Create Listing') }}
                                        </p>
                                    </a>
                                </ul>
                            </div>

                            <div>
                                {{-- <div class="bar bar-restaurant">
                                    <div class="location">
                                        <p>{{ __('user_page.Location / Restaurant') }}
                                        </p>
                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sLocation"
                                            value="{{ Request::is('food-list*') || $get_loc == null ? '' : $get_loc }}"
                                            id="loc_sugest"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="{{ __('user_page.Where are you going?') }}">

                                        <div id="sugest" class="location-popup display-none">
                                            <div class="location-popup-container h-100">
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Canggu">Canggu</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Seminyak">Seminyak</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Ubud">Ubud</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Kuta">Kuta</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Pecatu">Pecatu</a>
                                                    </div>
                                                </div>
                                                @php
                                                    $location = App\Http\Controllers\ViewController::get_location();
                                                    $hotelName = App\Http\Controllers\HotelController::get_name();
                                                    $restaurantName = App\Http\Controllers\Restaurant\RestaurantController::get_name();
                                                    $activityName = App\Http\Controllers\Activity\ActivityController::get_name();
                                                @endphp
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad"
                                                                src="{{ LazyLoad::show() }}"
                                                                data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($hotelName as $item2)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('hotel', $item2->id_hotel) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/hotel/hotel.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('hotel', $item2->id_hotel) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item2->name }}">{{ $item2->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($restaurantName as $item3)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('restaurant', $item3->id_restaurant) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('restaurant', $item3->id_restaurant) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item3->name }}">{{ $item3->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($activityName as $item4)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('activity', $item4->id_activity) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/activity.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('activity', $item4->id_activity) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item4->name }}">{{ $item4->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="check-out">
                                        <p>
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                            {{ __('user_page.Search') }}
                                        </p>

                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sKeyword" value=""
                                            id="search_sugest"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="{{ __('user_page.Search here') }}">

                                        <div id="sugest2" class="location-popup display-none">
                                            <div class="location-popup-container h-100">
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Beach">Beach</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Lake">Lake</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Mountain">Mountain</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Museum">Museum</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Zoo">Zoo</a>
                                                    </div>
                                                </div>
                                                @php
                                                    $activitySubCategory = App\Http\Controllers\Activity\ActivityController::get_subcategory();
                                                @endphp
                                                @foreach ($activitySubCategory as $item3)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                style="background: #222222;"
                                                                src="{{ asset('assets/icon/map/activity.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op2" target="_blank"
                                                                data-value="{{ $item3->name }}">{{ $item3->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty2"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="guests">
                                        <p>{{ __('user_page.What do you want to eat ?') }}</p>
                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sKeyword" value=""
                                            id="search_sugest"
                                            style="width: 100%; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="{{ __('user_page.Search here') }}">

                                        <div id="sugest2" class="location-popup display-none"
                                            style="width: 560px; left: -262px; height: 390px;">
                                            <div class="location-popup-container h-100">
                                                <div class="row location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    @php
                                                        $restaurantSubCategory = App\Http\Controllers\Restaurant\RestaurantController::restaurant_subcategory();
                                                    @endphp

                                                    @foreach ($restaurantSubCategory as $item)
                                                        <div class="col-12 col-md-6 col-lg-4 d-flex"
                                                            style="padding-left: 0px !important; align-items: center;">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    style="background: #222222;"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op2"
                                                                    data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                @foreach ($restaurantSubCategory as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                style="background: #222222;"
                                                                src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op2" target="_blank"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty2"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="button" style="padding-left: 0px;">
                                        <button id="searchBtn" class="d-block ms-auto me-1"
                                            onclick="foodFilter({{ request()->get('fCuisine') ?? 'null' }}, {{ request()->get('fSubCategory') ?? 'null' }}, false, true)"
                                            style="z-index: 1; border: 2px solid #ff7400; background: black; padding: 10px; border-radius: 10px;">
                                            <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                style="width: 15px; height: auto;">
                                            <!-- <i class="fa fa-search cari"></i> -->
                                        </button>
                                    </div>
                                </div> --}}

                                <div class="bar bar-activity">
                                    <div class="location">
                                        <p>{{ __('user_page.Location / Restaurant') }}
                                        </p>
                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sLocation"
                                            value="{{ Request::is('food-list*') || $get_loc == null ? '' : $get_loc }}"
                                            id="loc_sugest"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="{{ __('user_page.Where are you going?') }}">

                                        <div id="sugest" class="location-popup display-none">
                                            <div class="location-popup-container h-100">
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Canggu">Canggu</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Seminyak">Seminyak</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Ubud">Ubud</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Kuta">Kuta</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Pecatu">Pecatu</a>
                                                    </div>
                                                </div>
                                                @php
                                                    $location = App\Http\Controllers\ViewController::get_location();
                                                    $hotelName = App\Http\Controllers\HotelController::get_name();
                                                    $restaurantName = App\Http\Controllers\Restaurant\RestaurantController::get_name();
                                                    $activityName = App\Http\Controllers\Activity\ActivityController::get_name();
                                                @endphp
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad"
                                                                src="{{ LazyLoad::show() }}"
                                                                data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($hotelName as $item2)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('hotel', $item2->id_hotel) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/hotel/hotel.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('hotel', $item2->id_hotel) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item2->name }}">{{ $item2->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($restaurantName as $item3)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('restaurant', $item3->id_restaurant) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('restaurant', $item3->id_restaurant) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item3->name }}">{{ $item3->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($activityName as $item4)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('activity', $item4->id_activity) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/activity.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('activity', $item4->id_activity) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item4->name }}">{{ $item4->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="check-out">
                                        <p> <i class="fa-solid fa-magnifying-glass"></i> Search Cuisine</p>
                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sCuisine" value=""
                                            id="search_sugest2" placeholder="{{ __('user_page.Search here') }}">

                                        <div id="sugest3" class="location-popup display-none">
                                            <div class="location-popup-container h-100">
                                                <div class="row location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    @foreach ($cuisines as $item)
                                                        <div class="col-12 col-md-6 col-lg-4 d-flex"
                                                            style="padding-left: 0px !important; align-items: center;">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    style="background: #222222;"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="https://source.unsplash.com/random/1920x1080/?{{ $item->name }},landscape">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op3"
                                                                    data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                @foreach ($cuisines as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                style="background: #222222;"
                                                                src="https://source.unsplash.com/random/?{{ $item->name }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op3" target="_blank"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty2"
                                                    style="display: none">
                                                    <p>Cuisine not found
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="guests" style="min-width: max-content !important;">
                                        <p>{{ __('user_page.What do you want to eat ?') }}</p>
                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant input-search-food" name="sKeyword"
                                            value="" id="search_sugest"
                                            placeholder="{{ __('user_page.Search here') }}">

                                        <div id="sugest2" class="location-popup display-none"
                                            style="width: 560px; left: -262px; height: 390px;">
                                            <div class="location-popup-container h-100">
                                                <div class="row location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    @php
                                                        $restaurantSubCategory = App\Http\Controllers\Restaurant\RestaurantController::restaurant_subcategory();
                                                    @endphp

                                                    @foreach ($restaurantSubCategory as $item)
                                                        <div class="col-12 col-md-6 col-lg-4 d-flex"
                                                            style="padding-left: 0px !important; align-items: center;">
                                                            <div class="location-popup-map sugest-list-map">
                                                                <img class="location-popup-map-image lozad"
                                                                    style="background: #222222;"
                                                                    src="{{ LazyLoad::show() }}"
                                                                    data-src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                            </div>
                                                            <div class="location-popup-text sugest-list-text">
                                                                <a type="button" class="location_op2"
                                                                    data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                @foreach ($restaurantSubCategory as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                style="background: #222222;"
                                                                src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op2" target="_blank"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty2"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="button">
                                        <button class="d-block ms-auto me-1"
                                            onclick="foodFilter({{ request()->get('fCuisine') ?? 'null' }}, {{ request()->get('fSubCategory') ?? 'null' }}, false, true)"
                                            style="z-index: 1; border: none; background: transparent;">
                                            <div class="cari">
                                                <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($condition_things_to_do)
            @php
                $get_loc = app('request')->input('sLocation');
                $get_search = app('request')->input('sKeyword');
                $get_start = null;
                $get_end = null;

                if ($get_loc == null) {
                    $get_loc = '';
                }

                // if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] != '') {
                //     $get_loc = $_COOKIE['sLocation'];
                // }

                // if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] == '') {
                //     $get_loc = '';
                // }

                if (request()->sLocation) {
                    $get_loc = request()->sLocation;
                }

                if ($get_search == null) {
                    $get_search = __('user_page.Search');
                }

                // if (isset($_COOKIE['sCheck_in'])) {
                //     $get_start = $_COOKIE['sCheck_in'];
                // }

                // if (isset($_COOKIE['sCheck_out'])) {
                //     $get_end = $_COOKIE['sCheck_out'];
                // }

                if (request()->sStart) {
                    $get_start = request()->sStart;
                }

                if (request()->sEnd) {
                    $get_end = request()->sEnd;
                }

                function dateDiffe($get_start, $get_end)
                {
                    $date1_ts = strtotime($get_start);
                    $date2_ts = strtotime($get_end);
                    $diff = $date2_ts - $date1_ts;
                    return round($diff / 86400);
                }

                if ($get_start == null) {
                    $get_date = __('user_page.Add Date');
                } else {
                    if ($get_end == $get_start) {
                        $dateDiffe = 1;
                    } else {
                        $dateDiffe = dateDiffe($get_start, $get_end);
                    }
                    $get_date = $dateDiffe . ' ' . trans_choice('user_page.x days', $dateDiffe);
                }

                if ($get_date == null) {
                    $get_date = __('user_page.Add Date');
                }

            @endphp

            <div class="col-lg-8 search-box" style="height: 50px;">
                <div class="row">
                    <div class="col-12 text-center max-h-50">
                        <div id="searchbox" class="searchbox searchbox-display-block" onclick="popUp();"
                            style="cursor: pointer; width: 49%;">
                            <p>{{ Request::is('wow-list*') || $get_loc == null ? __('user_page.Add Location') : $get_loc }}
                                | {{ $get_search }} | {{ $get_date }}<span class="top-search">
                                    <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                        style="width: 20px; height: auto;">
                                    <!-- <i class="fa fa-search"></i> -->
                                </span>
                            </p>
                        </div>

                        <div id="search_bar" class="searchbar-list-display-none">
                            <div id="change_display_block" class="display-none nav-menu-container">
                                <ul class="nav-link-container">
                                    <ul class="nav-link-container">
                                        @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                            @if (Request::is('wow-list*'))
                                                <a href="{{ route('list') }}" id="villa-form" target="_blank"
                                                    class="nav-link-form-detail">
                                                @else
                                                    <a href="../homes/search?sLocation={{ $get_loc ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0&fPropertyType=&fAmenities="
                                                        target="_blank" id="villa-form"
                                                        class="nav-link-form-detail">
                                            @endIf

                                            @if ($condition_villa)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                        style="width: 31px; height: auto;">
                                                </div>
                                                <!-- <i id="villa-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Homes') }}
                                            </p>
                                            </a>
                                        @else
                                            <a href="{{ route('list') }}" id="villa-form" target="_blank"
                                                class="nav-link-form-detail">
                                                @if ($condition_villa)
                                                    <div
                                                        class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                            style="width: 31px; height: auto;">
                                                    </div>
                                                    <!-- <i id="villa-button"
                                                        class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                            style="width: 31px; height: auto;">
                                                    </div>
                                                    <!-- <i id="villa-button"
                                                        class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p class="{{ $textColor }} list-description">
                                                    {{ __('user_page.Homes') }}
                                                </p>
                                            </a>
                                        @endif

                                        @if (isset($_COOKIE['sLocation']))
                                            @if (Request::is('wow-list*'))
                                                <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                                    target="_blank" class="nav-link-form-detail">
                                                @else
                                                    <a href="../food/search?sLocation={{ $get_loc ?? '' }}&sKeyword="
                                                        target="_blank" id="restaurant-form"
                                                        class="nav-link-form-detail">
                                            @endIf

                                            @if ($condition_restaurant)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                        style="width: 20px; height: auto;">
                                                </div>
                                                <!-- <i id="restaurant-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Food') }}
                                            </p>
                                            </a>
                                        @else
                                            <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                                target="_blank" class="nav-link-form-detail">
                                                @if ($condition_restaurant)
                                                    <div
                                                        class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                            style="width: 20px; height: auto;">
                                                    </div>
                                                    <!-- <i id="restaurant-button"
                                                        class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                            style="width: 20px; height: auto;">
                                                    </div>
                                                    <!-- <i id="restaurant-button"
                                                        class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p class="{{ $textColor }} list-description">
                                                    {{ __('user_page.Food') }}
                                                </p>
                                            </a>
                                        @endif

                                        @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                            @if (Request::is('wow-list*'))
                                                <a href="{{ route('hotel_list') }}" id="hotel-form"
                                                    target="_blank" class="nav-link-form-detail">
                                                @else
                                                    <a href="../hotel/search?fViews=&sLocation={{ $get_loc ?? '' }}&sCheck_in={{ $_COOKIE['sCheck_in'] ?? '' }}&sCheck_out={{ $_COOKIE['sCheck_out'] ?? '' }}&sAdult=1&sChild=0"
                                                        target="_blank" id="hotel-form"
                                                        class="nav-link-form-detail">
                                            @endIf

                                            @if ($condition_hotel)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                        style="width: 29px; height: auto;">
                                                </div>
                                                <!-- <i id="hotel-button"
                                                    class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                {{ __('user_page.Hotels') }}</p>
                                            </a>
                                        @else
                                            <a href="{{ route('hotel_list') }}" id="hotel-form" target="_blank"
                                                class="nav-link-form-detail">
                                                @if ($condition_hotel)
                                                    <div
                                                        class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                            style="width: 29px; height: auto;">
                                                    </div>
                                                    <!-- <i id="hotel-button"
                                                        class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                            style="width: 29px; height: auto;">
                                                    </div>
                                                    <!-- <i id="hotel-button"
                                                        class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p class="{{ $textColor }} list-description">
                                                    {{ __('user_page.Hotels') }}</p>
                                            </a>
                                        @endif

                                        @if (isset($_COOKIE['sLocation']) || isset($_COOKIE['sCheck_in']) || isset($_COOKIE['sCheck_out']))
                                            @if (Request::is('wow-list*'))
                                                <a href="{{ route('activity_list') }}" id="activity-form"
                                                    target="_blank" class="nav-link-form-detail">
                                                @else
                                                    <a href="../wow/search?sLocation={{ $get_loc ?? '' }}&sKeyword=&sStart={{ $get_start ?? '' }}&sEnd={{ $get_end ?? '' }}&fCategory=1&fSubCategory="
                                                        target="_blank" id="activity-form"
                                                        class="nav-link-form-detail">
                                            @endIf

                                            @if ($condition_things_to_do)
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                    <!-- </div>
                                                <i id="activity-button" style="font-size: 24px;"
                                                    class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                </div>
                                            @else
                                                <div
                                                    class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                    <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                        style="width: 29px; height: auto; filter: none;">
                                                </div>
                                                <!-- <i id="activity-button" style="font-size: 24px;"
                                                    class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                            @endif

                                            <p class="{{ $textColor }} list-description">
                                                <!-- {{ __('user_page.things to do') }} -->
                                                WoW
                                            </p>
                                            </a>
                                        @else
                                            <a href="{{ route('activity_list') }}" id="activity-form"
                                                target="_blank" class="nav-link-form-detail">
                                                @if ($condition_things_to_do)
                                                    <div
                                                        class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                            style="width: 29px; height: auto; filter: none;">
                                                    </div>
                                                    <!-- <i id="activity-button" style="font-size: 24px;"
                                                        class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                                @else
                                                    <div
                                                        class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                        <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                            style="width: 29px; height: auto; filter: none;">
                                                    </div>
                                                    <!-- <i id="activity-button" style="font-size: 24px;"
                                                        class="{{ $textColor }} list-description fa-solid fa-surprise nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                                @endif

                                                <p class="{{ $textColor }} list-description">
                                                    <!-- {{ __('user_page.things to do') }} -->
                                                    WoW
                                                </p>
                                            </a>
                                        @endif
                                        <a href="{{ route('ahost') }}" id="activity-form" target="_blank"
                                            class="nav-link-form-detail" style="margin-left: 64px;">
                                            <div
                                                class="list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail {{ $textColor }}">
                                                <img src="{{ asset('assets/icon/menu/list.svg') }}"
                                                    style="width: 22px; height: auto;">
                                            </div>
                                            <!-- <i id="activity-button" style="font-size: 24px;"
                                                class="list-description fa-solid fa-clipboard-list nav-link-gap nav-link-style-detail nav-link-icon-style-detail {{ $textColor }}"></i> -->
                                            <p class="list-description {{ $textColor }}">
                                                {{ __('user_page.Create Listing') }}
                                            </p>
                                        </a>
                                    </ul>
                            </div>

                            <div>
                                <div class="bar bar-activity">
                                    <div class="location">
                                        <p>{{ __('user_page.Location') }}</p>
                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sLocation"
                                            value="{{ Request::is('wow-list*') || $get_loc == null ? '' : $get_loc }}"
                                            id="loc_sugest" name="sLocation"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="{{ __('user_page.Where are you going?') }}">

                                        <div id="sugest" class="location-popup display-none">
                                            <div class="location-popup-container h-100">
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Canggu">Canggu</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Seminyak">Seminyak</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Ubud">Ubud</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Kuta">Kuta</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Pecatu">Pecatu</a>
                                                    </div>
                                                </div>
                                                @php
                                                    $location = App\Http\Controllers\ViewController::get_location();
                                                    $hotelName = App\Http\Controllers\HotelController::get_name();
                                                    $restaurantName = App\Http\Controllers\Restaurant\RestaurantController::get_name();
                                                    $activityName = App\Http\Controllers\Activity\ActivityController::get_name();
                                                @endphp
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad"
                                                                src="{{ LazyLoad::show() }}"
                                                                data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($hotelName as $item2)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('hotel', $item2->id_hotel) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/hotel/hotel.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('hotel', $item2->id_hotel) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item2->name }}">{{ $item2->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($restaurantName as $item3)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('restaurant', $item3->id_restaurant) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('restaurant', $item3->id_restaurant) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item3->name }}">{{ $item3->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($activityName as $item4)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('activity', $item4->id_activity) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/activity.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('activity', $item4->id_activity) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item4->name }}">{{ $item4->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="check-out">
                                        <p>
                                            {{-- <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                style="width: 20px; height: auto;"> --}}
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                            <!-- <i class="fa fa-search" aria-hidden="true"></i -->&nbsp;
                                            {{ __('user_page.Search') }}
                                        </p>
                                        {{-- <input type="text" style="background-color: #ffffff00;"
                                            placeholder="{{ __('user_page.Search here') }}"
                                            value="{{ request()->get('sKeyword') ?? '' }}" id="keyword"
                                            name="sKeyword"> --}}

                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sKeyword" value=""
                                            id="search_sugest"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="{{ __('user_page.Search here') }}">

                                        <div id="sugest2" class="location-popup display-none">
                                            <div class="location-popup-container h-100">
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Beach">Beach</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Lake">Lake</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Mountain">Mountain</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Museum">Museum</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none;">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            style="background: #222222;"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="{{ asset('assets/icon/map/activity.png') }}">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op2"
                                                            data-value="Zoo">Zoo</a>
                                                    </div>
                                                </div>
                                                @php
                                                    $activitySubCategory = App\Http\Controllers\Activity\ActivityController::get_subcategory();
                                                @endphp
                                                @foreach ($activitySubCategory as $item3)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                style="background: #222222;"
                                                                src="{{ asset('assets/icon/map/activity.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op2" target="_blank"
                                                                data-value="{{ $item3->name }}">{{ $item3->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty2"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="guests">
                                        <a type="button"
                                            style="position : absolute; z-index:1; width:100%; height: 60px; margin-left: -90px; margin-top: -8px"
                                            class="collapsible_wow"></a>
                                        <p>{{ __('user_page.Date') }}</p>

                                        @if ((isset($_COOKIE['sCheck_in']) && $_COOKIE['sCheck_in'] != '') ||
                                            (isset($_COOKIE['sCheck_out']) && $_COOKIE['sCheck_out'] != ''))
                                            <p id="add_date_wow"
                                                style="display: none; position: absolute; color: grey; font-size: 15px; top:34px; left: 55px; font-weight: 400;">
                                                {{ __('user_page.Add dates') }}</p>
                                        @else
                                            <p id="add_date_wow"
                                                style="position: absolute; color: grey; font-size: 15px; top:34px; left: 55px; font-weight: 400;">
                                                {{ __('user_page.Add dates') }}</p>
                                        @endIf
                                        <div style="display: flex; padding: 0px;"
                                            class="header-date-input-container">
                                            <input type="text" onfocus="this.value=''" placeholder=""
                                                class="form-control" name="start_date" id="start_date"
                                                value="{{ $get_start ?? '' }}"
                                                style="width: 100%; background-color: #ffffff00;">
                                            <input type="text" onfocus="this.value=''" placeholder=""
                                                class="form-control" name="end_date" id="end_date"
                                                value="{{ $get_end ?? '' }}"
                                                style="width: 100%;  background-color: #ffffff00;">
                                        </div>

                                    </div>

                                    <div class="button">
                                        <button class="d-block ms-auto me-1"
                                            onclick="wowFilter({{ request()->get('fCategory') ?? '1' }}, {{ request()->get('fSubCategory') ?? 'null' }}, null, false)"
                                            style="z-index: 1; border: none; background: transparent;">
                                            <div class="cari">
                                                <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i class="fa fa-search cari"></i> -->
                                        </button>
                                    </div>

                                </div>

                                {{-- calendar --}}
                                <div class="content sidebar-popup" id="popup_wow"
                                    style="margin-left: -975px; width:800px; padding:0px; z-index: 999; min-height: 450px; max-height: 450px;">
                                    <div class="desk-e-call">
                                        <div class="flatpickr-container"
                                            style="display: flex; justify-content: center;">
                                            <div
                                                style="display: table; background-color: white;
                                                border-radius: 15px;">
                                                <div class="col-lg-12"
                                                    style="padding-left: 15px; padding-right: 30px; padding-top: 15px; text-align: right; text-align: center;">
                                                    <a type="button" id="clear_date_wow"
                                                        style="padding-bottom: 20px; margin: 0px; font-size: 13px;">{{ __('user_page.Clear Dates') }}</a>
                                                    <p style="margin: 0px; font-size: 13px;"></p>
                                                </div>
                                                <div class="flatpickr" id="date_wow" style="text-align: left;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- calendar --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($condition_collaborator)
            @php
                $get_loc = app('request')->input('sLocation');
                $get_search = app('request')->input('sKeyword');
                $get_start = null;
                $get_end = null;

                if ($get_loc == null) {
                    $get_loc = '';
                }

                // if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] != '') {
                //     $get_loc = $_COOKIE['sLocation'];
                // }

                // if (isset($_COOKIE['sLocation']) && $_COOKIE['sLocation'] == '') {
                //     $get_loc = '';
                // }

                if (request()->sLocation) {
                    $get_loc = request()->sLocation;
                }

                if ($get_search == null) {
                    $get_search = __('user_page.Search');
                }

                // if (isset($_COOKIE['sCheck_in'])) {
                //     $get_start = $_COOKIE['sCheck_in'];
                // }

                // if (isset($_COOKIE['sCheck_out'])) {
                //     $get_end = $_COOKIE['sCheck_out'];
                // }

                if (request()->sStart) {
                    $get_start = request()->sStart;
                }

                if (request()->sEnd) {
                    $get_end = request()->sEnd;
                }

                function dateDiffe($get_start, $get_end)
                {
                    $date1_ts = strtotime($get_start);
                    $date2_ts = strtotime($get_end);
                    $diff = $date2_ts - $date1_ts;
                    return round($diff / 86400);
                }

                if ($get_start == null) {
                    $get_date = __('user_page.Add Date');
                } else {
                    if ($get_end == $get_start) {
                        $dateDiffe = 1;
                    } else {
                        $dateDiffe = dateDiffe($get_start, $get_end);
                    }
                    $get_date = $dateDiffe . ' ' . trans_choice('user_page.x days', $dateDiffe);
                }

                if ($get_date == null) {
                    $get_date = __('user_page.Add Date');
                }
            @endphp
            <div class="col-lg-8 search-box" style="height: 50px;">
                <div class="row">
                    <div class="col-12 text-center max-h-50">
                        <div id="searchbox" class="searchbox searchbox-display-block" onclick="popUp();"
                            style="cursor: pointer; width: 49%;">
                            <p>{{ Request::is('collaborator-list*') || $get_loc == null ? __('user_page.Add Location') : $get_loc }}
                                | {{ $get_search }} | {{ $get_date }}<span class="top-search">
                                    <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                        style="width: 20px; height: auto;">
                                    <!-- <i class="fa fa-search"></i> -->
                                </span>
                            </p>
                        </div>

                        <div id="search_bar" class="searchbar-list-display-none">
                            <div id="change_display_block" class="display-none nav-menu-container">
                                <ul class="nav-link-container">
                                    <a href="{{ route('list') }}" id="villa-form" class="nav-link-form-detail">
                                        @if ($condition_villa)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                    style="width: 31px; height: auto;">
                                            </div>
                                            <!-- <i id="villa-button"
                                                class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/homes.svg') }}"
                                                    style="width: 31px; height: auto;">
                                            </div>
                                            <!-- <i id="villa-button"
                                                class="{{ $textColor }} list-description fa-solid fa-house nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Homes') }}
                                        </p>
                                    </a>
                                    <a href="{{ route('restaurant_list') }}" id="restaurant-form"
                                        class="nav-link-form-detail">
                                        @if ($condition_restaurant)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i id="restaurant-button"
                                                class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/food.svg') }}"
                                                    style="width: 20px; height: auto;">
                                            </div>
                                            <!-- <i id="restaurant-button"
                                                class="{{ $textColor }} list-description fa-solid fa-utensils nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Food') }}</p>
                                    </a>
                                    <a href="{{ route('hotel_list') }}" id="hotel-form"
                                        class="nav-link-form-detail">
                                        @if ($condition_hotel)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                    style="width: 29px; height: auto;">
                                            </div>
                                            <!-- <i id="hotel-button"
                                                class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/hotel.svg') }}"
                                                    style="width: 29px; height: auto;">
                                            </div>
                                            <!-- <i id="hotel-button"
                                                class="{{ $textColor }} list-description fa-solid fa-city nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Hotels') }}</p>
                                    </a>
                                    <a href="{{ route('activity_list') }}" id="activity-form"
                                        class="nav-link-form-detail">
                                        @if ($condition_things_to_do)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                    style="width: 29px; height: auto; filter: none;">
                                            </div>
                                            <!-- <i id="activity-button" style="font-size: 24px;"
                                                class="{{ $textColor }} list-description fa-solid fa-person-running nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/wow.svg') }}"
                                                    style="width: 29px; height: auto; filter: none;">
                                            </div>
                                            <!-- <i id="activity-button" style="font-size: 24px;"
                                                class="{{ $textColor }} list-description fa-solid fa-person-running nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            WoW
                                        </p>
                                    </a>
                                    <a href="{{ route('collaborator_list') }}" id="collaborator-form"
                                        class="nav-link-form-detail">
                                        @if ($condition_collaborator)
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/collab1-white.svg') }}"
                                                    style="width: 29px; height: auto; ">
                                            </div>
                                            <!-- <i id="activity-button" style="font-size: 24px;"
                                                class="{{ $textColor }} list-description fa-solid fa-person-running nav-link-gap nav-link-style-detail nav-link-style-detail-active nav-link-icon-style-detail"></i> -->
                                        @else
                                            <div
                                                class="{{ $textColor }} list-description nav-link-gap nav-link-style-detail nav-link-icon-style-detail">
                                                <img src="{{ asset('assets/icon/menu/collab1-white.svg') }}"
                                                    style="width: 29px; height: auto; ">
                                            </div>
                                            <!-- <i id="activity-button" style="font-size: 24px;"
                                                class="{{ $textColor }} list-description fa-solid fa-person-running nav-link-gap nav-link-style-detail nav-link-icon-style-detail"></i> -->
                                        @endif

                                        <p class="{{ $textColor }} list-description">
                                            {{ __('user_page.Collabs') }}
                                        </p>
                                    </a>
                                </ul>
                            </div>

                            <div>
                                <div class="bar bar-collaborator">
                                    <div class="location">
                                        <p>{{ __('user_page.Location') }}
                                        </p>
                                        <input autocomplete="off" type="text" onfocus="this.value=''"
                                            class="form-control input-transparant" name="sLocation"
                                            value="{{ Request::is('collaborator-list*') || $get_loc == null ? '' : $get_loc }}"
                                            id="loc_sugest" name="sLocation"
                                            style="width: 100% !important; height: 60px; position: absolute; padding-top: 20px; top: 4px; left: 3px; cursor: pointer;"
                                            placeholder="{{ __('user_page.Where are you going?') }}">

                                        <div id="sugest" class="location-popup display-none">
                                            <div class="location-popup-container h-100">
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Canggu">Canggu</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Seminyak">Seminyak</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Ubud">Ubud</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Kuta">Kuta</a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                    style="display: none ">
                                                    <div class="location-popup-map sugest-list-map">
                                                        <img class="location-popup-map-image lozad"
                                                            src="{{ LazyLoad::show() }}"
                                                            data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                    </div>
                                                    <div class="location-popup-text sugest-list-text">
                                                        <a type="button" class="location_op"
                                                            data-value="Pecatu">Pecatu</a>
                                                    </div>
                                                </div>
                                                @php
                                                    $location = App\Http\Controllers\ViewController::get_location();
                                                    $hotelName = App\Http\Controllers\HotelController::get_name();
                                                    $restaurantName = App\Http\Controllers\Restaurant\RestaurantController::get_name();
                                                    $activityName = App\Http\Controllers\Activity\ActivityController::get_name();
                                                @endphp
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list-first"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image lozad"
                                                                src="{{ LazyLoad::show() }}"
                                                                data-src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($location as $item)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none ">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="https://thumbs.dreamstime.com/b/isometric-d-map-location-pins-gps-navigation-vector-background-isometric-d-map-location-pins-gps-navigation-vector-101080012.jpg">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a type="button" class="location_op"
                                                                data-value="{{ $item->name }}">{{ $item->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($hotelName as $item2)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('hotel', $item2->id_hotel) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/hotel/hotel.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('hotel', $item2->id_hotel) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item2->name }}">{{ $item2->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($restaurantName as $item3)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('restaurant', $item3->id_restaurant) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/restaurant.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('restaurant', $item3->id_restaurant) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item3->name }}">{{ $item3->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @foreach ($activityName as $item4)
                                                    <div class="col-lg-12 location-popup-desc-container sugest-list"
                                                        style="display: none; cursor: pointer;"
                                                        onclick="window.open('{{ route('activity', $item4->id_activity) }}', '_blank');">
                                                        <div class="location-popup-map sugest-list-map">
                                                            <img class="location-popup-map-image"
                                                                src="{{ asset('assets/icon/map/activity.png') }}">
                                                        </div>
                                                        <div class="location-popup-text sugest-list-text">
                                                            <a href="{{ route('activity', $item4->id_activity) }}"
                                                                type="button" class="location_op" target="_blank"
                                                                data-value="{{ $item4->name }}">{{ $item4->name }}</a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-lg-12 location-popup-desc-container sugest-list-empty"
                                                    style="display: none">
                                                    <p>{{ __('user_page.location not found') }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="check-out">
                                        <p>
                                            {{-- <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                style="width: 20px; height: auto;"> --}}
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                            <!-- <i class="fa fa-search" aria-hidden="true"></i> -->&nbsp;
                                            {{ __('user_page.Category') }}
                                        </p>
                                        <input type="text" onfocus="this.value=''"
                                            style="background-color: #ffffff00; border:none; padding: 0.4rem 0 0 0; font-size: 140%;"
                                            placeholder="{{ __('user_page.Search here') }}"
                                            value="{{ request()->get('sKeyword') ?? '' }}" id="keyword"
                                            name="sKeyword">
                                    </div>
                                    <div class="guests">
                                        <a type="button"
                                            style="position : absolute; z-index:1; width:100%; height: 60px; margin-left: -90px; margin-top: -8px"
                                            class="collapsible_wow"></a>
                                        <p>{{ __('user_page.Date') }}</p>

                                        @if ((isset($_COOKIE['sCheck_in']) && $_COOKIE['sCheck_in'] != '') ||
                                            (isset($_COOKIE['sCheck_out']) && $_COOKIE['sCheck_out'] != ''))
                                            <p id="add_date_wow"
                                                style="display: none; position: absolute; color: grey; font-size: 15px; top:34px; left: 55px; font-weight: 400;">
                                                {{ __('user_page.Add dates') }}</p>
                                        @else
                                            <p id="add_date_wow"
                                                style="position: absolute; color: grey; font-size: 15px; top:34px; left: 55px; font-weight: 400;">
                                                {{ __('user_page.Add dates') }}</p>
                                        @endIf
                                        <div style="display: flex; padding: 0px;"
                                            class="header-date-input-container">
                                            <input type="text" onfocus="this.value=''" placeholder=""
                                                class="form-control" name="start_date" id="start_date"
                                                value="{{ $get_start ?? '' }}"
                                                style="width: 100%; background-color: #ffffff00;">
                                            <input type="text" onfocus="this.value=''" placeholder=""
                                                class="form-control" name="end_date" id="end_date"
                                                value="{{ $get_end ?? '' }}"
                                                style="width: 100%;  background-color: #ffffff00;">
                                        </div>
                                    </div>

                                    <div class="button">
                                        <button onclick="collabFilter()" class="d-block ms-auto me-1"
                                            style="z-index: 1; border: none; background: transparent;">
                                            <div class="cari">
                                                <img src="{{ asset('assets/icon/menu/search.svg') }}"
                                                    style="width: 20px; height: auto;">
                                                <!-- <i class="fa fa-search cari"></i> -->
                                            </div>
                                        </button>
                                    </div>

                                </div>

                                {{-- calendar --}}
                                <div class="content sidebar-popup" id="popup_wow"
                                    style="margin-left: -975px; width:800px; padding:0px; z-index: 999; min-height: 450px; max-height: 450px;">
                                    <div class="desk-e-call">
                                        <div class="flatpickr-container"
                                            style="display: flex; justify-content: center;">
                                            <div
                                                style="display: table; background-color: white;
                                                border-radius: 15px;">
                                                <div class="col-lg-12"
                                                    style="padding-left: 15px; padding-right: 30px; padding-top: 15px; text-align: right; text-align: center;">
                                                    <a type="button" id="clear_date_wow"
                                                        style="padding-bottom: 20px; margin: 0px; font-size: 13px;">{{ __('user_page.Clear Dates') }}</a>
                                                    <p style="margin: 0px; font-size: 13px;"></p>
                                                </div>
                                                <div class="flatpickr" id="date_wow" style="text-align: left;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- calendar --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div id="nav-end-dekstop" class="col-lg-2 list-villa-user right-bar" style="padding: 0px;">

            <a type="button" onclick="language()" class="navbar-gap button-change-language"
                style="color: white; margin-right: 9px; width:27px;">
                @if (session()->has('locale'))
                    <img style="border-radius: 3px; box-shadow: 1px 1px 2px #dedede;"
                        src="{{ URL::asset('assets/flags/flag_' . session('locale') . '.svg') }}">
                @else
                    <img style="border-radius: 3px; box-shadow: 1px 1px 2px #dedede;"
                        src="{{ URL::asset('assets/flags/flag_en.svg') }}">
                @endif
            </a>
            @auth
                <div style="display: table; margin-right: 0px; float: right;">
                    <!--<h5 style="">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>-->
                </div>
                <div class="logged-user-menu d-flex">
                    <div style="flex:1;">
                        <label class="container-mode">
                            <input type="checkbox" id="background-color-switch"
                                onclick="changeBackgroundTrigger(this)"
                                {{ $tema != null && $tema == 'black' ? 'checked' : '' }} class="change-mode-dekstop">
                            <span class="checkmark-mode"></span>

                        </label>
                    </div>

                    <div style="flex:1;">
                        <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" class="logged-user-photo" alt="">
                            @else
                                <img src="{{ asset('assets/icon/menu/user_default.svg') }}" class="logged-user-photo"
                                    alt="">
                            @endif

                            <div class="dropdown-menu user-dropdown-menu dropdown-menu-right shadow animated--fade-in-up"
                                aria-labelledby="navbarDropdownUserImage" style="left:-210px; top: 120%;">
                                <h6 class="dropdown-header d-flex align-items-center">
                                    @if (Auth::user()->foto_profile != null)
                                        <img class="dropdown-user-img"
                                            src="{{ asset('foto_profile/' . Auth::user()->foto_profile) }} ">
                                    @elseIf (Auth::user()->avatar != null)
                                        <img class="dropdown-user-img" src="{{ Auth::user()->avatar }}">
                                    @else
                                        <img class="dropdown-user-img"
                                            src="{{ asset('assets/icon/menu/user_default.svg') }}">
                                    @endif
                                    <div class="dropdown-user-details">
                                        <div class="dropdown-user-details-name">{{ Auth::user()->first_name }}
                                            {{ Auth::user()->last_name }}</div>
                                        <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                                    </div>
                                </h6>
                                @php
                                    $role = Auth::user()->role_id;
                                @endphp
                                @if ($role == 1 || $role == 2 || $role == 3)
                                    <a class="dropdown-item" href="{{ route('partner_dashboard') }}">
                                        {{ __('user_page.Dashboard') }}
                                    </a>
                                @endif
                                @if ($role == 1 || $role == 2 || $role == 3 || $role == 5)
                                    <a class="dropdown-item" href="{{ route('collaborator_list') }}">
                                        {{ __('user_page.Collab Portal') }}
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('profile_index') }}">
                                    {{ __('user_page.My Profile') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('change_password') }}">
                                    {{ __('user_page.Change Password') }}
                                </a>
                                <a class="dropdown-item" href="#!"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                                    {{ __('user_page.Sign Out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post"
                                    style="display: none">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                            </div>

                        </a>
                    </div>
                </div>
            @else
                @if (Route::current()->uri() == 'villa/{id}')
                    <input type="button" onclick="location.href='{{ route('register.partner') }}';"
                        value="{{ __('user_page.Become a host') }}" />
                @endif

                <div
                    style="width: 80px; height: 45px; padding-left: 5px; padding-right: 5px; background-image: linear-gradient(to right, #FEA429 , #FD6920); display: flex; border-radius: 20px; align-items: center;">

                    <label class="container-mode">
                        <input type="checkbox" id="background-color-switch" onclick="changeBackgroundTrigger(this)"
                            {{ $tema != null && $tema == 'black' ? 'checked' : '' }} class="change-mode-dekstop">
                        <span class="checkmark-mode"></span>
                    </label>
                    <div style="width: 60%;">
                        <!-- <a onclick="loginForm(2)" class="btn btn-fill border-0 navbar-gap"
                                                                                                                                                                                                                                        style="color: #ff7400; width: 35px; height: 35px; border-radius: 50%; background-color: white; display: inline-block; display: flex; align-items: center; justify-content: center;">
                                                                                                                                                                                                                                        <i class="fa-solid fa-user icon-clear"></i>
                                                                                                                                                                                                                                    </a> -->
                        <div class="dropdown">
                            <button type="button" id="btnMenuDropdown"
                                class="btn-dropdwn dropbtn btn border-0 navbar-gap"></button>
                            <div class="dropdown-content">
                                <a href="#" onclick="loginRegisterForm(2, 'login');">Login</a>
                                <a href="#" onclick="loginRegisterForm(2, 'register');">Register</a>
                                <hr>
                                <a href="{{ route('ahost') }}">Become a Host</a>
                                <a href="{{ route('collaborator_list') }}">Collaborator Portal</a>
                                <a href="{{ route('faq') }}">FAQ</a>
                            </div>
                        </div>
                    </div>
                </div>

            @endauth
        </div>

        <script>
            //Drop down login
            // var supportsTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints;
            // $('.dropbtn').on(supportsTouch ? 'touchend' : 'click', function (event) {
            //     event.stopPropagation();
            //     $('.dropdown-content').slideToggle('fast');
            // });

            $('#btnMenuDropdown').on('click', function(event) {
                $('.dropdown-content').slideToggle('fast');
            });

            // $(document).on(supportsTouch ? 'touchend' : 'click', function (event) {
            //     $('.dropdown-content').slideUp('fast');
            // // document.activeElement.blur();//lose focus
            // });

            $(document).on('click', function(event) {
                if (event.target.id != 'btnMenuDropdown') {
                    if ($('.dropdown-content:visible').length > 0) {
                        $('.dropdown-content').slideUp('fast');
                    }
                }
            });
        </script>

        {{-- Search Location --}}
        <script>
            $(function() {
                var mode = localStorage.getItem("mode");

                $(window).on("resize", function() {
                    if (mode != null) {
                        if (mode == "dark") {
                            if (window.innerWidth < 950) {
                                $('.grid-img-filter').css("box-shadow", "rgb(255 255 255 / 75%) 0px 0px 20px")
                            } else {
                                $('.grid-img-filter').css("box-shadow", "")
                            }
                        } else {
                            if (window.innerWidth < 950) {
                                $('.grid-img-filter').css("box-shadow", "rgb(0 0 0 / 75%) 0px 0px 8px")
                            } else {
                                $('.grid-img-filter').css("box-shadow", "")
                            }
                        }
                    } else {
                        if (window.innerWidth < 950) {
                            $('.grid-img-filter').css("box-shadow", "rgb(0 0 0 / 75%) 0px 0px 8px")
                        } else {
                            $('.grid-img-filter').css("box-shadow", "")
                        }
                    }
                });
                if (mode != null) {
                    if (mode == "dark") {
                        if (window.innerWidth < 950) {
                            $('.grid-img-filter').css("box-shadow", "rgb(255 255 255 / 75%) 0px 0px 20px")
                        }
                    } else {
                        if (window.innerWidth < 950) {
                            $('.grid-img-filter').css("box-shadow", "rgb(0 0 0 / 75%) 0px 0px 8px")
                        }
                    }
                } else {
                    if (window.innerWidth < 950) {
                        $('.grid-img-filter').css("box-shadow", "rgb(0 0 0 / 75%) 0px 0px 8px")
                    }
                }
            });
        </script>
        <script>
            var coll = document.getElementsByClassName("collapsible-check-search");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content_flatpickr = document.getElementById('popup_check_search_mobile');
                    if (content_flatpickr.style.display === "block" && window.innerWidth > 649) {
                        content_flatpickr.style.display = "none";
                    } else {
                        content_flatpickr.style.display = "block";
                        moveToDateMobile();
                        document.addEventListener('mouseup', function(e) {
                            let container = content_flatpickr;
                            if (!container.contains(e.target) && window.innerWidth > 649) {
                                container.style.display = 'none';
                            }
                        });
                    }
                });
            }

            var collDesktop = document.getElementsByClassName("collapsible-check-search-desktop");
            var j;

            for (j = 0; j < collDesktop.length; j++) {
                collDesktop[j].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content_flatpickr = document.getElementById('popup_check_search_desktop');
                    if (content_flatpickr.style.display === "block") {
                        content_flatpickr.style.display = "none";
                    } else {
                        if (window.innerWidth <= 649) {
                            backToMainMobile();
                            $(".search-container-mobile").removeClass("search-container-mobile-closed")
                                .addClass("search-container-mobile-open");
                            $("body").css({
                                "height": "100%",
                                "overflow": "hidden"
                            });
                        } else {
                            content_flatpickr.style.display = "block";
                            document.addEventListener('mouseup', function(e) {
                                let container = content_flatpickr;
                                if (!container.contains(e.target)) {
                                    container.style.display = 'none';
                                }
                            });
                        }

                    }
                });
            }
        </script>

        <script>
            var coll = document.getElementsByClassName("collapsible_wow");
            var i;

            for (i = 0; i < coll.length; i++) {
                coll[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var content_flatpickr = document.getElementById('popup_wow');
                    if (content_flatpickr.style.display === "block") {
                        content_flatpickr.style.display = "none";
                    } else {
                        content_flatpickr.style.display = "block";
                        document.addEventListener('mouseup', function(e) {
                            let container = content_flatpickr;
                            if (!container.contains(e.target)) {
                                container.style.display = 'none';
                            }
                        });
                    }
                });
            }
        </script>

        <script>
            // Set a cookie
            function setCookie2(name, value, days) {

                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            //get a cookie
            function getCookie2(name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }

            var url_string = window.location.href;
            var url = new URL(url_string);

            if (url.searchParams.get('sLocation')) {
                setCookie2("sLocation", url.searchParams.get('sLocation'), 1);
            }
            if (url.searchParams.get('sCheck_in')) {
                setCookie2("sCheck_in", url.searchParams.get('sCheck_in'), 1);
            }
            if (url.searchParams.get('sCheck_out')) {
                setCookie2("sCheck_out", url.searchParams.get('sCheck_out'), 1);
            }
            // let sLocation2 = getCookie("sLocation");
            // document.getElementById("myRef").value = ref3;

            $(document).ready(() => {
                $("body").on("hidden.bs.modal", function() {
                    $(this).removeAttr("style");
                });

                $(window).resize(function() {
                    if (window.innerWidth > 991) {
                        $(".btn-close-expand-navbar-mobile").trigger('click')
                    }
                })
                $(".btn-close-expand-navbar-mobile").on("click", function() {
                    $("body").removeAttr("style");
                    $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "false");
                    $("#overlay").css("display", "none");
                })
                $("#expand-mobile-btn").on("click", function() {
                    whenScroll();
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
                    $("body").removeAttr("style");
                    $(".expand-navbar-mobile").removeClass("expanding-navbar-mobile");
                    $(".expand-navbar-mobile").addClass("closing-navbar-mobile");
                    $(".expand-navbar-mobile").attr("aria-expanded", "false");
                    $("#overlay").css("display", "none");
                    document.getElementById("new-bar-black").classList.remove("header-popup-list");
                    document.getElementById("new-bar-black").classList.remove("search-height");
                    document.getElementById("searchbox").classList.add("searchbox-display-block");
                    document.getElementById("searchbox").classList.remove("searchbox-display-none");
                    document.getElementById("search_bar").classList.remove("active");
                    document.getElementById("search_bar").classList.remove("searchbar-list-display-block");
                    document.getElementById("search_bar").classList.add("searchbar-list-display-none");
                })
                // NEW SEARCH MOBILE
                // fungsi untuk ketika tombol kembali diklik
                $(".search-container-mobile .btn-top-search .back").on('click', backToMainMobile);

                // NEW SEARCH MOBILE
                // fungsi untuk munculin location-popup ketika input search location di mobile diklik
                $(".search-container-mobile #loc_sugest").on('click', moveToLocationMobile);

                // NEW SEARCH MOBILE
                // fungsi untuk munculin location-popup ketika search location di mobile diklik
                $(".search-container-mobile .location-has-selected-container").on('click', moveToLocationMobile);

                $("#loc_sugest").on('click', function() { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list-first");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        ids.show();
                    };

                    $('#sugest_mobile').removeClass("display-none");
                    $('#sugest_mobile').addClass("display-block"); //add the class to the clicked element

                    // condition sementara untuk selain villa dan hotel.
                    // karena yang lain masih belum ada design untuk isi search untuk mobile
                    if ($('#sugest') != null) {
                        $('#sugest').removeClass("display-none");
                        $('#sugest').addClass("display-block"); //add the class to the clicked element
                    }
                });

                $(document).mouseup(function(e) {
                    var container = $('#sugest_mobile');

                    // if the target of the click isn't the container nor a descendant of the container
                    // NEW SEARCH MOBILE
                    // fungsi untuk menyembunyikan location-popup hanya berlaku ketika bukan dimobile
                    if (!container.is(e.target) && container.has(e.target).length === 0 && window.innerWidth >
                        649) {
                        container.removeClass("display-block");
                        container.addClass("display-none");
                    }

                    // condition sementara untuk selain villa dan hotel.
                    // karena yang lain masih belum ada design untuk isi search untuk mobile
                    if ($('#sugest') != null) {
                        var containerSugest = $('#sugest');
                        if (!containerSugest.is(e.target) && containerSugest.has(e.target).length === 0) {
                            containerSugest.removeClass("display-block");
                            containerSugest.addClass("display-none");
                        }
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

                // NEW SEARCH MOBILE
                // fungsi untuk isi nilai dari location di mobile ketika user udh milih
                // dari location yang paling populer di mobile
                $(".first-sugest-location img").on('click', function(e) {
                    // NEW SEARCH MOBILE
                    // fungsi untuk isi nilai dari location di mobile ketika user udh milih
                    $('#loc_sugest').val($(this).parents(".col-4").children(".location-popup-text").children(
                        ".location_op").data("value"));
                    $('#loc_sugest_desktop').val($(this).parents(".col-4").children(".location-popup-text")
                        .children(".location_op").data("value"));
                    $('.loc_sugest_mobile').html($(this).parents(".col-4").children(".location-popup-text")
                        .children(".location_op").data("value"));

                    // NEW SEARCH MOBILE
                    // fungsi untuk sembunyiin popup location
                    $('#sugest_mobile').removeClass("display-block");
                    $('#sugest_mobile').addClass("display-none");

                    // NEW SEARCH MOBILE
                    // fungsi untuk berpindah ke select date di mobile
                    moveToDateMobile();

                    //calendar show when user filled location
                    var content_flatpickr = document.getElementById('popup_check_search');

                    // NEW SEARCH MOBILE
                    // fungsi untuk menyembunyikan calendar hanya berlaku ketika bukan dimobile
                    if (content_flatpickr.style.display === "block" && window.innerWidth > 649) {
                        content_flatpickr.style.display = "none";
                    } else {
                        content_flatpickr.style.display = "block";
                        document.addEventListener('mouseup', function(e) {
                            let container = content_flatpickr;
                            // NEW SEARCH MOBILE
                            // fungsi untuk menyembunyikan calendar hanya berlaku ketika bukan dimobile
                            if (!container.contains(e.target) && window.innerWidth > 649) {
                                container.style.display = 'none';
                            }
                        });
                    }
                });

                $(".location_op").on('click', function(e) {
                    $('#loc_sugest_desktop').val($(this).data("value"));

                    // NEW SEARCH MOBILE
                    // fungsi untuk isi nilai dari location di mobile ketika user udh milih
                    $('#loc_sugest').val($(this).data("value"));
                    $('.loc_sugest_mobile').html($(this).data("value"));

                    $('#sugest_mobile').removeClass("display-block");
                    $('#sugest_mobile').addClass("display-none");

                    // condition sementara untuk selain villa dan hotel.
                    // karena yang lain masih belum ada design untuk isi search untuk mobile
                    if ($('#sugest') != null) {
                        $('#sugest').removeClass("display-block");
                        $('#sugest').addClass("display-none");
                    }

                    // NEW SEARCH MOBILE
                    // fungsi untuk berpindah ke select date di mobile
                    if ($("#check_in2").val() == "") {
                        moveToDateMobile();
                    } else {
                        moveToGuestsMobile();
                    }

                    //calendar show when user filled location
                    var content_flatpickr = document.getElementById('popup_check_search');

                    // NEW SEARCH MOBILE
                    // fungsi untuk menyembunyikan calendar hanya berlaku ketika bukan dimobile
                    if (content_flatpickr.style.display === "block" && window.innerWidth > 649) {
                        content_flatpickr.style.display = "none";
                    } else {
                        content_flatpickr.style.display = "block";
                        document.addEventListener('mouseup', function(e) {
                            let container = content_flatpickr;
                            // NEW SEARCH MOBILE
                            // fungsi untuk menyembunyikan calendar hanya berlaku ketika bukan dimobile
                            if (!container.contains(e.target) && window.innerWidth > 649) {
                                container.style.display = 'none';
                            }
                        });
                    }
                });

                $("#loc_sugest_desktop").on('click', function() { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list-first-desktop");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        ids.show();
                    };

                    if (window.innerWidth <= 649) {
                        backToMainMobile();
                        $(".search-container-mobile").removeClass("search-container-mobile-closed")
                            .addClass("search-container-mobile-open");
                        $("body").css({
                            "height": "100%",
                            "overflow": "hidden"
                        });
                    }else {
                        $('#sugest_desktop').removeClass("display-none");
                        $('#sugest_desktop').addClass("display-block"); //add the class to the clicked element
                    }
                });

                $(document).mouseup(function(e) {
                    var container = $('#sugest_desktop');

                    // if the target of the click isn't the container nor a descendant of the container
                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        container.removeClass("display-block");
                        container.addClass("display-none");
                    }
                });

                $("#loc_sugest_desktop").on('keyup change', async () => {
                    var close = $(".sugest-list-first-desktop");
                    close.hide();
                    var ids = $(".sugest-list");
                    ids.hide();
                    $(".sugest-list-empty-desktop").eq(0).hide();

                    var formValue = $("#loc_sugest_desktop").val();
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
                        $(".sugest-list-empty-desktop").eq(0).show();
                    }

                    if (formValue.length === 0) {
                        close.show();
                        ids.hide();
                    }

                    console.log('done');
                });

                $(".location_op_desktop").on('click', function(e) {
                    $('#loc_sugest_desktop').val($(this).data("value"));
                    $('#loc_sugest').val($(this).data("value"));
                    $('#sugest_desktop').removeClass("display-block");
                    $('#sugest_desktop').addClass("display-none");

                    $('.loc_sugest_mobile').html($(this).data("value"));
                    $('#sugest_mobile').removeClass("display-block");
                    $('#sugest_mobile').addClass("display-none");
                    moveToGuestsMobile();

                    //calendar show when location click
                    var content_flatpickr = document.getElementById('popup_check_search_desktop');
                    if (content_flatpickr.style.display === "block") {
                        content_flatpickr.style.display = "none";
                    } else {
                        content_flatpickr.style.display = "block";
                        document.addEventListener('mouseup', function(e) {
                            let container = content_flatpickr;
                            if (!container.contains(e.target)) {
                                container.style.display = 'none';
                            }
                        });
                    }
                });

                // NEW SEARCH MOBILE
                // Guest mobile
                $(".selected-guest-mobile").on("click", moveToGuestsMobile);

                // $("#loc_sugest").on('click', function() { //use a class, since your ID gets mangled
                //     var ids = $(".sugest-list-first");
                //     ids.hide();
                //     for (let index = 0; index < 5; index++) {
                //         // var rndInt = Math.floor(Math.random() * (ids.length - 1));
                //         // console.log(rndInt);
                //         ids.show();
                //     };

                //     $('#sugest').removeClass("display-none");
                //     $('#sugest').addClass("display-block"); //add the class to the clicked element
                // });

                // $(document).mouseup(function(e) {
                //     var container = $('#sugest');

                //     // if the target of the click isn't the container nor a descendant of the container
                //     if (!container.is(e.target) && container.has(e.target).length === 0) {
                //         container.removeClass("display-block");
                //         container.addClass("display-none");
                //     }
                // });

                // $("#loc_sugest").on('keyup change', async () => {
                //     var close = $(".sugest-list-first");
                //     close.hide();
                //     var ids = $(".sugest-list");
                //     ids.hide();
                //     $(".sugest-list-empty").eq(0).hide();

                //     var formValue = $("#loc_sugest").val();
                //     var isEmpty = true;

                //     $(".sugest-list").map((data) => {
                //         var name = $(".sugest-list").eq(data).children(".sugest-list-text")
                //             .children('a').text();
                //         if (name.toLowerCase().includes(formValue.toLowerCase())) {
                //             $(".sugest-list").eq(data).show();
                //             isEmpty = false;
                //         }
                //     });

                //     if (isEmpty) {
                //         $(".sugest-list-empty").eq(0).show();
                //     }

                //     if (formValue.length === 0) {
                //         close.show();
                //         ids.hide();
                //     }

                //     console.log('done');
                // });

                // $(".location_op").on('click', function(e) {
                //     $('#loc_sugest').val($(this).data("value"));
                //     $('#sugest').removeClass("display-block");
                //     $('#sugest').addClass("display-none");

                //     //calendar show when location click
                //     var content_flatpickr = document.getElementById('popup_check_search');
                //     if (content_flatpickr.style.display === "block") {
                //         content_flatpickr.style.display = "none";
                //     } else {
                //         content_flatpickr.style.display = "block";
                //         document.addEventListener('mouseup', function(e) {
                //             let container = content_flatpickr;
                //             if (!container.contains(e.target)) {
                //                 container.style.display = 'none';
                //             }
                //         });
                //     }
                // });
            });
        </script>

        <script>
            // NEW SEARCH MOBILE
            // fungsi untuk tombol next atau skip di mobile
            $(".next-mobile").on("click", function() {
                if ($("#loc_sugest").val() == "" && $("#check_in2").val() == "" &&
                    $("#check_out2").val() == "" && $(".search-container-mobile .sidebar-popup").css("display") !=
                    "block") {
                    moveToLocationMobile();
                } else if ($("#loc_sugest").val() != "" && $("#check_in2").val() == "" &&
                    $("#check_out2").val() == "" && parseInt($("#total_guest_desktop").val()) < 1) {
                    moveToDateMobile();
                } else if (($("#check_in2").val() == "" ||
                        $("#check_out2").val() == "") || $(".search-container-mobile .sidebar-popup").css("display") ==
                    "block") {
                    moveToGuestsMobile();
                }
            });
            // NEW SEARCH MOBILE
            // fungsi untuk clear all di mobile
            $(".clear-all-mobile").on("click", function() {
                $("#loc_sugest_desktop").val("");
                $("#loc_sugest").val("");
                $("#check_in2").val("");
                $("#check_out2").val("");
                $("#check_in_mobile").val("");
                $("#check_out_mobile").val("");
                $("#total_guest_desktop").val("1");
                $("#adult_desktop").val("1");
                $("#adult_mobile").val("1");
                $("#child_desktop").val("0");
                $("#child_mobile").val("0");
                $("#infant_desktop").val("0");
                $("#infant_mobile").val("0");
                $("#pet_desktop").val("0");
                $("#pet_mobile").val("0");
                $(".search-container-mobile .loc_sugest_mobile").html("Location");
                $(".search-container-mobile .dates-mobile").html("When");
                $(".search-container-mobile .guests-mobile").html("1 Guests");
                calendarSearch(window.countMonthsMobile);
            });
        </script>

        <script>
            $(document).ready(() => {
                function handleResponsive(windowWidth) {
                    if (windowWidth <= 649) {
                        $("#loc_sugest_desktop").attr("readonly", true);
                        calendarSearch(window.countMonthsMobile);
                        calendar_wow(1);
                        $("#clear_date_mobile").click(function() {
                            $("#check_in2").val("");
                            $("#check_out2").val("");

                            // NEW SEARCH MOBILE
                            // clear date untuk mobile
                            $(".search-container-mobile .dates-mobile").html("When");
                            $(".search-container-mobile .next-mobile").html("Skip");

                            // Fungsi untuk menyembunyikan calendar ketika clear date hanya berlaku kalo bukan mobile
                            if (windowWidth > 649) {
                                let content = document.getElementById("popup_check_search_mobile");
                                content.style.display = "none";
                            }
                            calendarSearch(window.countMonthsMobile);
                        });
                        $("#clear_date_wow").click(function() {
                            // $("#check_in2").val("");
                            $("#start_date").val("");
                            $("#end_date").val("");
                            document.getElementById('add_date_wow').style.display = "block";
                            calendar_wow(1);
                        });
                    } else {
                        backToMainMobile();
                        $(".search-container-mobile").removeClass("search-container-mobile-open")
                            .addClass("search-container-mobile-closed");
                        $("body").removeAttr("style");
                        $("#loc_sugest_desktop").attr("readonly", false);
                        calendarSearchDesktop(2);
                        calendar_wow(2);
                        $("#clear_date_header").click(function() {
                            $("#check_in2").val("");
                            $("#check_out2").val("");

                            // NEW SEARCH MOBILE
                            // clear date untuk mobile
                            $(".search-container-mobile .dates-mobile").html("When");
                            $(".search-container-mobile .next-mobile").html("Skip");

                            let content = document.getElementById("popup_check_search_mobile");
                            content.style.display = "none";
                            calendarSearchDesktop(2);
                        });
                        $("#clear_date_wow").click(function() {
                            // $("#check_in2").val("");
                            $("#start_date").val("");
                            $("#end_date").val("");
                            document.getElementById('add_date_wow').style.display = "block";
                            calendar_wow(2);
                        });
                    }
                    if (windowWidth <= 991) {
                        $("#search_bar .bar").addClass("row");
                        $(".bar .location").addClass("col-12 mb-2");
                        $(".bar .location-restaurant").addClass("col-12 mb-2");
                        $(".bar .check-in").addClass("col-6 mb-2");
                        $(".bar .check-out").addClass("col-6 mb-2");
                        $(".bar-activity .check-out").removeClass("col-6");
                        $(".bar-collaborator .check-out").removeClass("col-6");
                        $(".bar-activity .check-out").addClass("col-12");
                        $(".bar-collaborator .check-out").addClass("col-12");
                        $(".bar .guests").addClass("col-10");
                        $(".bar .button").addClass("col-2");
                    } else {
                        $("#search_bar .bar").removeClass("row");
                        $(".bar .location").removeClass("col-12 mb-2");
                        $(".bar .location-restaurant").removeClass("col-12 mb-2");
                        $(".bar .check-in").removeClass("col-6 mb-2");
                        $(".bar .check-out").removeClass("col-6 mb-2");
                        $(".bar-activity .check-out").removeClass("col-12 mb-2");
                        $(".bar-collaborator .check-out").removeClass("col-12 mb-2");
                        $(".bar .guests").removeClass("col-6 col-10");
                        $(".bar .button").removeClass("col-6 col-2");
                    }
                    if (windowWidth <= 649) {
                        $(".bar-villa .guests").removeClass("col-10").addClass("col-6");
                        $(".bar-villa .button").removeClass("col-2").addClass("col-6");
                    } else if (windowWidth > 649 && windowWidth <= 991) {
                        $(".bar-villa .guests").removeClass("col-6").addClass("col-10");
                        $(".bar-villa .button").removeClass("col-6").addClass("col-2");
                    }
                    if (windowWidth > 1360) {
                        var gap = ((windowWidth - 1360) / 2) + 100;
                        var navGap = gap - 100;
                        $("#filter-cat-bg-color").css("padding-left", gap + "px");
                        $("#filter-cat-bg-color").css("padding-right", gap + "px");
                        $("#filter-subcat-bg-color").css("padding-left", gap + "px");
                        $("#filter-subcat-bg-color").css("padding-right", gap + "px");
                        $(".page-header-fixed").css("padding-left", navGap + "px");
                        $(".page-header-fixed").css("padding-right", navGap + "px");
                        $(".grid-container-43").css("padding-left", gap + "px");
                        $(".grid-container-43").css("padding-right", gap + "px");
                        $(".container-grid").css("padding-left", gap + "px");
                        $(".container-grid").css("padding-right", gap + "px");
                        $(".container-grid-activity").css("padding-left", gap + "px");
                        $(".container-grid-activity").css("padding-right", gap + "px");
                        $(".container-grid-hotel").css("padding-left", gap + "px");
                        $(".container-grid-hotel").css("padding-right", gap + "px");
                    } else {
                        $("#filter-cat-bg-color").css("padding-left", "");
                        $("#filter-cat-bg-color").css("padding-right", "");
                        $("#filter-subcat-bg-color").css("padding-left", "");
                        $("#filter-subcat-bg-color").css("padding-right", "");
                        $(".page-header-fixed").css("padding-left", "");
                        $(".page-header-fixed").css("padding-right", "");
                        $(".grid-container-43").removeAttr("style");
                        $(".grid-container-43").removeAttr("style");
                        $(".container-grid").removeAttr("style");
                        $(".container-grid").removeAttr("style");
                        $(".container-grid-activity").removeAttr("style");
                        $(".container-grid-activity").removeAttr("style");
                        $(".container-grid-hotel").removeAttr("style");
                        $(".container-grid-hotel").removeAttr("style");
                    }
                }
                var windowWidth = $(window).width();
                handleResponsive(windowWidth);
                $(window).on("resize", function() {
                    if ($(this).width() !== windowWidth) {
                        windowWidth = $(this).width();
                        handleResponsive(windowWidth);
                    }
                })
                $("#search_sugest").on('click', function() { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list-first");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        // var rndInt = Math.floor(Math.random() * (ids.length - 1));
                        // console.log(rndInt);
                        ids.show();
                    };

                    $('#sugest2').removeClass("display-none");
                    $('#sugest2').addClass("display-block"); //add the class to the clicked element
                });
                $("#search_sugest2").on('click', function() { //use a class, since your ID gets mangled
                    var ids = $(".sugest-list-first");
                    ids.hide();
                    for (let index = 0; index < 5; index++) {
                        // var rndInt = Math.floor(Math.random() * (ids.length - 1));
                        // console.log(rndInt);
                        ids.show();
                    };

                    $('#sugest3').removeClass("display-none");
                    $('#sugest3').addClass("display-block"); //add the class to the clicked element
                });

                $(document).mouseup(function(e) {
                    var container = $('#sugest2, #sugest3');

                    // if the target of the click isn't the container nor a descendant of the container
                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        container.removeClass("display-block");
                        container.addClass("display-none");
                    }
                });

                $("#search_sugest").on('keyup change', async () => {
                    var close = $(".sugest-list-first");
                    close.hide();
                    var ids = $(".sugest-list");
                    ids.hide();
                    $(".sugest-list-empty2").eq(0).hide();

                    var formValue = $("#search_sugest").val();
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
                        $(".sugest-list-empty2").eq(0).show();
                    }

                    if (formValue.length === 0) {
                        close.show();
                        ids.hide();
                    }
                });

                $(".location_op2").on('click', function(e) {
                    $('#search_sugest').val($(this).data("value"));
                    $('#sugest2').removeClass("display-block");
                    $('#sugest2').addClass("display-none");
                });
                $(".location_op3").on('click', function(e) {
                    $('#search_sugest2').val($(this).data("value"));
                    $('#sugest3').removeClass("display-block");
                    $('#sugest3').addClass("display-none");
                });
            });
        </script>

        <script>
            function adult_increment_header_list() {
                // document.getElementById('adult5').stepUp();
                // document.getElementById('total_guest5').value = parseInt(document.getElementById('adult5').value) +
                //     parseInt(document.getElementById('child5').value);
                if (parseInt(document.getElementById('total_guest_desktop').value) < 10
                    && parseInt(document.querySelector('.guests-mobile').innerHTML) < 10) {
                    document.getElementById('adult_desktop').stepUp();
                    document.getElementById('adult_mobile').stepUp();
                    document.getElementById('total_guest_desktop').value = parseInt(document.getElementById('adult_desktop')
                            .value) +
                        parseInt(document.getElementById('child_desktop').value);
                    // NEW SEARCH MOBILE
                    // fungsi untuk mengisi guest di mobile
                    document.querySelector('.guests-mobile').innerHTML = parseInt(document.getElementById('adult_mobile').value) +
                        parseInt(document.getElementById('child_mobile').value) + " Guests";
                }
            }

            function adult_decrement_header_list() {
                // document.getElementById('adult5').stepDown();
                // document.getElementById('total_guest5').value = parseInt(document.getElementById('adult5').value) +
                //     parseInt(document.getElementById('child5').value);
                document.getElementById('adult_desktop').stepDown();
                document.getElementById('adult_mobile').stepDown();
                document.getElementById('total_guest_desktop').value = parseInt(document.getElementById('adult_desktop')
                        .value) +
                    parseInt(document.getElementById('child_desktop').value);
                // NEW SEARCH MOBILE
                // fungsi untuk mengisi guest di mobile
                document.querySelector('.guests-mobile').innerHTML = parseInt(document.getElementById('adult_mobile').value) +
                    parseInt(document.getElementById('child_mobile').value) + " Guests";
            }

            function child_increment_header_list() {
                // document.getElementById('child5').stepUp();
                // document.getElementById('total_guest5').value = parseInt(document.getElementById('adult5').value) +
                //     parseInt(document.getElementById('child5').value);
                if (parseInt(document.getElementById('total_guest_desktop').value) < 10
                    && parseInt(document.querySelector('.guests-mobile').innerHTML) < 10) {
                    document.getElementById('child_desktop').stepUp();
                    document.getElementById('child_mobile').stepUp();
                    document.getElementById('total_guest_desktop').value = parseInt(document.getElementById('adult_desktop')
                            .value) +
                        parseInt(document.getElementById('child_desktop').value);
                    // NEW SEARCH MOBILE
                    // fungsi untuk mengisi guest di mobile
                    document.querySelector('.guests-mobile').innerHTML = parseInt(document.getElementById('adult_mobile').value) +
                        parseInt(document.getElementById('child_mobile').value) + " Guests";
                }
            }

            function child_decrement_header_list() {
                // document.getElementById('child5').stepDown();
                // document.getElementById('total_guest5').value = parseInt(document.getElementById('adult5').value) +
                //     parseInt(document.getElementById('child5').value);
                document.getElementById('child_desktop').stepDown();
                document.getElementById('child_mobile').stepDown();
                document.getElementById('total_guest_desktop').value = parseInt(document.getElementById('adult_desktop')
                        .value) +
                    parseInt(document.getElementById('child_desktop').value);
                // NEW SEARCH MOBILE
                // fungsi untuk mengisi guest di mobile
                document.querySelector('.guests-mobile').innerHTML = parseInt(document.getElementById('adult_mobile').value) +
                    parseInt(document.getElementById('child_mobile').value) + " Guests";
            }

            function infant_increment_header_list() {
                // document.getElementById('infant5').stepUp();
                document.getElementById('infant_desktop').stepUp();
                document.getElementById('infant_mobile').stepUp();
            }

            function infant_decrement_header_list() {
                // document.getElementById('infant5').stepDown();
                document.getElementById('infant_desktop').stepDown();
                document.getElementById('infant_mobile').stepDown();
            }

            function pet_increment_header_list() {
                // document.getElementById('pet5').stepUp();
                document.getElementById('pet_desktop').stepUp();
                document.getElementById('pet_mobile').stepUp();
            }

            function pet_decrement_header_list() {
                // document.getElementById('pet5').stepDown();
                document.getElementById('pet_desktop').stepDown();
                document.getElementById('pet_mobile').stepDown();
            }
        </script>

        <script>
            $(".search-container-mobile .close").on("click", function() {
                backToMainMobile();
                $(".search-container-mobile").removeClass("search-container-mobile-open")
                    .addClass("search-container-mobile-closed");
                $("body").removeAttr("style");
            });
        </script>

        <script>
            // NEW SEARCH MOBILE
            // fungsi untuk kembali ke bagian awal search di mobile
            function backToMainMobile() {
                $(".search-container-mobile form").removeClass("h-100");
                $("#sugest").removeClass("display-block").addClass("display-none");
                $(".search-container-mobile .select-location-mobile-container").removeClass("d-none");
                $(".search-container-mobile .location-has-selected-container").removeClass("d-flex").addClass("d-none");
                $(".search-container-mobile .first-sugest-location").removeClass("d-none");
                $(".search-container-mobile .dates-container").removeClass("d-none h-100 px-0");
                $(".search-container-mobile .sidebar-popup").removeAttr("style");
                $(".search-container-mobile .sidebar-popup").removeClass("d-block").addClass("d-none");
                $(".search-container-mobile .guests-container").removeClass("d-none p-0");
                $(".search-container-mobile .guest-popup").removeClass("d-block").addClass("d-none");
                $(".search-container-mobile .selected-guest-mobile").removeClass("d-none").addClass("d-flex");
                $(".search-container-mobile .bottom-action-container").removeClass("d-none bottom-select-date");
                $(".search-container-mobile .bottom-action-container").removeClass("d-none");
                $(".search-container-mobile .clear-all-mobile").removeClass("d-none");
                $(".search-container-mobile .clear-date-mobile").addClass("d-none");
                if ($("#check_in2").val() != "" && $("#check_out2").val() != "" &&
                    parseInt($("#total_guest_desktop").val()) >= 1 && $("#loc_sugest").val() != "") {
                    $(".search-container-mobile .submit-mobile").removeClass("d-none");
                    $(".search-container-mobile .next-mobile").addClass("d-none");
                } else {
                    $(".search-container-mobile .next-mobile").removeClass("d-none");
                    $(".search-container-mobile .next-mobile").html("Next");
                    $(".search-container-mobile .submit-mobile").addClass("d-none");
                }
                $(".search-container-mobile .btn-top-search .close").removeClass("d-none");
                $(".search-container-mobile .btn-top-search .back").addClass("d-none");
                $(".search-container-mobile .location-container")
                    .addClass("mx-2").removeClass("h-100");
                $('#sugest_mobile').removeClass("display-block").addClass("display-none");
                $("#loc_sugest").attr("readonly", true);
            }
            // NEW SEARCH MOBILE
            // fungsi untuk berpindah ke select location di mobile
            function moveToLocationMobile() {
                $("#loc_sugest").removeAttr("readonly");
                var ids = $(".sugest-list-first");
                ids.hide();
                for (let index = 0; index < 5; index++) {
                    // var rndInt = Math.floor(Math.random() * (ids.length - 1));
                    // console.log(rndInt);
                    ids.show();
                };
                $(".search-container-mobile form").addClass("h-100");
                $(".search-container-mobile .first-sugest-location").addClass("d-none");
                $(".search-container-mobile .dates-container").addClass("d-none");
                $('#popup_check_search_mobile').removeClass('d-block').addClass('d-none');
                $(".search-container-mobile .guests-container").addClass("d-none");
                $(".search-container-mobile .guest-popup").removeClass("d-block");
                $(".search-container-mobile .bottom-action-container").addClass("d-none");
                $(".search-container-mobile .btn-top-search .close").addClass("d-none");
                $(".search-container-mobile .btn-top-search .back").removeClass("d-none");
                $(".search-container-mobile .location-container")
                    .removeClass("mx-2").addClass("h-100");
                $(".search-container-mobile .location-has-selected-container")
                    .removeClass("d-flex").addClass("d-none");
                $(".search-container-mobile .select-location-mobile-container").removeClass("d-none");
                $('#sugest_mobile').removeClass("display-none");
                $('#sugest_mobile').addClass("display-block");
            }
            // NEW SEARCH MOBILE
            // fungsi untuk berpindah ke select date di mobile
            function moveToDateMobile() {
                $('#popup_check_search_mobile').removeClass('d-none').addClass('d-block');
                $(".location-has-selected-container").removeClass("d-none").addClass("d-flex");
                $(".select-location-mobile-container").addClass("d-none");
                $(".search-container-mobile form").addClass("h-100");
                $(".search-container-mobile .first-sugest-location").removeClass("d-none");
                $(".search-container-mobile .dates-container").removeClass("d-none").addClass("h-100 px-0");
                $(".search-container-mobile .guests-container").addClass("d-none");
                $(".search-container-mobile .guest-popup").removeClass("d-block");
                $(".search-container-mobile .bottom-action-container").removeClass("d-none").addClass("bottom-select-date");
                $(".search-container-mobile .btn-top-search .close").removeClass("d-none");
                $(".search-container-mobile .btn-top-search .back").addClass("d-none");
                $(".search-container-mobile .location-container")
                    .addClass("mx-2").removeClass("h-100");
                $('#sugest_mobile').removeClass("display-block").addClass("display-none");
                $("#loc_sugest").attr("readonly", true);
                $(".search-container-mobile .clear-date-mobile").removeClass("d-none");
                $(".search-container-mobile .clear-all-mobile").addClass("d-none");
                if ($("#check_in2").val() == "" && $("#check_out2").val() == "") {
                    $(".search-container-mobile .next-mobile").html("Skip");
                    $(".search-container-mobile .next-mobile").removeClass("d-none");
                    $(".search-container-mobile .submit-mobile").addClass("d-none");
                } else {
                    $(".search-container-mobile .next-mobile").html("Next");
                    $(".search-container-mobile .next-mobile").removeClass("d-none");
                    $(".search-container-mobile .submit-mobile").addClass("d-none");
                }
            }
            // NEW SEARCH MOBILE
            // fungsi untuk berpindah ke select guest di mobile
            function moveToGuestsMobile() {
                $('#popup_check_search_mobile').removeClass("d-block").addClass("d-none");
                $(".location-has-selected-container").removeClass("d-none").addClass("d-flex");
                $(".select-location-mobile-container").addClass("d-none");
                $(".search-container-mobile form").removeClass("h-100");
                $(".search-container-mobile .first-sugest-location").addClass("d-none");
                $(".search-container-mobile .guests-container").removeClass("d-none").addClass("p-0");
                $(".search-container-mobile .dates-container").removeClass("d-none px-0");
                $(".search-container-mobile .sidebar-popup").removeAttr("style");
                $(".search-container-mobile .sidebar-popup").removeClass("d-block").addClass("d-none");
                $(".search-container-mobile .location-container")
                    .addClass("mx-2").removeClass("h-100");
                $(".search-container-mobile .selected-guest-mobile").removeClass("d-flex").addClass("d-none");
                $(".search-container-mobile .guest-popup").removeClass("d-none").addClass("d-block");
                $(".search-container-mobile .bottom-action-container").removeClass("d-none bottom-select-date");
                $(".search-container-mobile .btn-top-search .close").removeClass("d-none");
                $(".search-container-mobile .btn-top-search .back").addClass("d-none");
                $(".search-container-mobile .clear-date-mobile").addClass("d-none");
                $(".search-container-mobile .clear-all-mobile").removeClass("d-none");
                $(".search-container-mobile .next-mobile").addClass("d-none");
                $(".search-container-mobile .submit-mobile").removeClass("d-none");
            }
        </script>

        <script>
            $(document).ready(function() {

                // Close modal on button click
                $(".close-modal").click(function() {
                    $("#modal-map").modal('hide');
                });
            });
        </script>

        <script>
            function popUp() {
                document.getElementById("myBtnContainer").classList.add("display-none");
                document.getElementById("searchbox").classList.remove("searchbox-display-block");
                document.getElementById("searchbox").classList.add("searchbox-display-none");
                document.getElementById("change_display_block").classList.remove("display-none");
                document.getElementById("change_display_block").classList.add("display-block");
                document.getElementById("new-bar-black").classList.add("header-popup-list");
                document.getElementById("new-bar-black").classList.add("search-height");
                document.getElementById("search_bar").classList.add("searchbar-list-display-block");
                document.getElementById("search_bar").classList.remove("searchbar-list-display-none");
                $("#overlay").css("display", "block");

                function addClass(elements, className) {
                    for (var i = 0; i < elements.length; i++) {
                        var element = elements[i];
                        if (element.classList) {
                            element.classList.add(className);
                        } else {
                            element.className += ' ' + className;
                        }
                    }
                }

                function removeClass(elements, className) {
                    for (var i = 0; i < elements.length; i++) {
                        var element = elements[i];
                        if (element.classList) {
                            element.classList.remove(className);
                        } else {
                            element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(
                                    ' ')
                                .join('|') + '(\\b|$)', 'gi'), ' ');
                        }
                    }
                }

                var elss = document.getElementsByClassName("flatpickr-calendar");
                removeClass(elss, 'display-none');
            }
        </script>

        <script>
            window.onscroll = function() {
                whenScroll()
            };

            function whenScroll() {
                function addClass(elements, className) {
                    for (var i = 0; i < elements.length; i++) {
                        var element = elements[i];
                        if (element.classList) {
                            element.classList.add(className);
                        } else {
                            element.className += ' ' + className;
                        }
                    }
                }

                function removeClass(elements, className) {
                    for (var i = 0; i < elements.length; i++) {
                        var element = elements[i];
                        if (element.classList) {
                            element.classList.remove(className);
                        } else {
                            element.className = element.className.replace(new RegExp('(^|\\b)' + className.split(' ')
                                .join('|') + '(\\b|$)', 'gi'), ' ');
                        }
                    }
                }

                function closeNavbar() {
                    document.getElementById("myBtnContainer").classList.remove("display-none");
                    document.getElementById("searchbox").classList.add("searchbox-display-block");
                    document.getElementById("searchbox").classList.remove("searchbox-display-none");
                    document.getElementById("search_bar").classList.remove("active");
                    document.getElementById("change_display_block").classList.add("display-none");
                    document.getElementById("change_display_block").classList.remove("display-block");
                    document.getElementById("new-bar-black").classList.remove("header-popup-list");
                    document.getElementById("new-bar-black").classList.remove("search-height");
                    document.getElementById("search_bar").classList.remove("searchbar-list-display-block");
                    document.getElementById("search_bar").classList.add("searchbar-list-display-none");

                    // hide overlay ketika scroll, dan ketika sidebar close di mobile size
                    if ($('.expand-navbar-mobile').attr('aria-expanded') == 'false') {
                        $("#overlay").css("display", "none");
                    }

                    var els = document.getElementsByClassName("flatpickr-calendar");
                    addClass(els, 'display-none');
                }

                var isFocused = document.querySelector("#loc_sugest") == document.activeElement ||
                    document.querySelector("#search_sugest") == document.activeElement;

                if (!isFocused || window.innerWidth > 768) {
                    if (document.querySelector(".search-container-mobile") != null) {
                        if (!document.querySelector(".search-container-mobile").classList.contains("search-container-mobile-open")) {
                            closeNavbar();
                        }
                    }else {
                        closeNavbar();
                    }
                }
            }
        </script>

        <script>
            $(document).ready(function() {
                $('.stickySubCategory').css({
                    'top': $('#new-bar-black').innerHeight() + 'px'
                })
            })
            $(window).on("resize", function() {
                $('.stickySubCategory').css({
                    'top': $('#new-bar-black').innerHeight() + 'px'
                })
            })
            $(window).scroll(function(event) {
                $('.stickySubCategory').css({
                    'top': $('#new-bar-black').innerHeight() + 'px'
                })
            })
        </script>

        <script>
            $('#adult3').on('change', function() {
                var total_adult = parseInt($('#adult3').val()) + parseInt($('#child3').val());
                $('#total_guest3').val(total_adult);
            });

            $('#child3').on('change', function() {
                var total_child = parseInt($('#adult3').val()) + parseInt($('#child3').val());
                $('#total_guest3').val(total_child);
            });
        </script>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

        <script>
            jQuery(document).ready(function(e) {
                function t(t) {
                    e(t).bind("click", function(t) {
                        t.preventDefault();
                        e(this).parent().fadeOut()
                    })
                }
                e(".dropdown-toggle").click(function() {
                    if (window.innerWidth <= 649) {
                        backToMainMobile();
                        $(".search-container-mobile").removeClass("search-container-mobile-closed")
                            .addClass("search-container-mobile-open");
                        $("body").css({
                            "height": "100%",
                            "overflow": "hidden"
                        });
                    }else {
                        var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(
                        ":hidden");
                        e(".button-dropdown .dropdown-menu").hide();
                        e(".button-dropdown .dropdown-toggle").removeClass("active");
                        if (t) {
                            e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(
                                ".button-dropdown").children(".dropdown-toggle").addClass("active")
                        }
                    }
                });
                e(document).bind("click", function(t) {
                    var n = e(t.target);
                    if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu")
                        .hide();
                });
                e(document).bind("click", function(t) {
                    var n = e(t.target);
                    if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle")
                        .removeClass("active");
                })
            });
        </script>

        <script>
            function loginForm(value) {
                console.log(value);
                if (value == 1) {
                    $('#loginAlert').removeClass('d-none');
                    $('#registerAlert').removeClass('d-none');
                }
                if (value == 2) {
                    $('#loginAlert').addClass('d-none');
                    $('#registerAlert').addClass('d-none');
                }
                sidebarhide();
                $('#LoginModal').modal('show');
            }

            function loginRegisterForm(value, type) {
                console.log(value);
                if (value == 1) {
                    $('#loginAlert').removeClass('d-none');
                    $('#registerAlert').removeClass('d-none');
                }
                if (value == 2) {
                    $('#loginAlert').addClass('d-none');
                    $('#registerAlert').addClass('d-none');
                }
                sidebarhide();

                // close searchbar di mobile size
                $("#bodyList #overlay").trigger("click");

                $('#LoginModal').modal('show');
                if (type == 'login') {
                    $('#trigger-tab-register').removeClass('active');
                    $('#content-tab-register').removeClass('active');
                    $('#trigger-tab-login').addClass('active');
                    $('#content-tab-login').addClass('active');
                } else {
                    $('#trigger-tab-register').addClass('active');
                    $('#content-tab-register').addClass('active');
                    $('#trigger-tab-login').removeClass('active');
                    $('#content-tab-login').removeClass('active');
                }
            }
        </script>

        <script>
            function view_LoginModal(type) {
                sidebarhide();
                $('#LoginModal').modal('show');
                if (type == 'login') {
                    $('#trigger-tab-register').removeClass('active');
                    $('#content-tab-register').removeClass('active');
                    $('#trigger-tab-login').addClass('active');
                    $('#content-tab-login').addClass('active');
                } else {
                    $('#trigger-tab-register').addClass('active');
                    $('#content-tab-register').addClass('active');
                    $('#trigger-tab-login').removeClass('active');
                    $('#content-tab-login').removeClass('active');
                }

            }
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

                // close searchbar di mobile size
                $("#bodyList #overlay").trigger("click")
            }

            function currency() {
                sidebarhide();
                $('#LegalModal').modal('show');
                $('#trigger-tab-language').removeClass('active');
                $('#content-tab-language').removeClass('active');
                $('#trigger-tab-currency').addClass('active');
                $('#content-tab-currency').addClass('active');

                // close searchbar di mobile size
                $("#bodyList #overlay").trigger("click")
            }
        </script>
        <script>
            $(function() {
                $('#switcher').click(function() {
                    $('#background-color-switch').trigger("click");
                });
            });
        </script>
        <script>
            function initChangeBackgroundTrigger() {
                // check if mode has been set
                var checkBox = document.getElementById("background-color-switch");
                var mode = localStorage.getItem("mode");
                if (!mode) {
                    checkBox.checked = false;
                    console.log('mode not found', checkBox.checked);
                    localStorage.setItem("mode", "light");
                    changebackground();
                } else {
                    if (mode == 'light') {
                        checkBox.checked = false;
                        console.log('mode light found', checkBox.checked);
                        changebackground();
                    } else {
                        checkBox.checked = true;
                        console.log('mode dark found', checkBox.checked);
                        changebackground();
                    }
                }
            }

            function changeBackgroundTrigger(element) {
                // var checkBox = document.getElementById("background-color-switch");
                let checkBoxDekstop = document.querySelector('.change-mode-dekstop')
                let checkBoxMobile = document.querySelector('.change-mode-mobile')
                var mode = localStorage.getItem("mode");
                if (mode == null && element.checked) {
                    mode = 'light'
                } else if (mode == null && !element.checked) {
                    mode = 'dark'
                }
                console.log('head', mode)
                if (element.checked && mode == 'dark') {
                    element.checked = true;
                    checkBoxDekstop.checked = true;
                    checkBoxMobile.checked = true;
                    changebackground('black');

                } else if (!element.checked && mode == 'light') {
                    element.checked = false;
                    checkBoxDekstop.checked = false;
                    checkBoxMobile.checked = false;
                    changebackground('light');
                } else if (!element.checked && mode == 'dark') {
                    element.checked = false;
                    checkBoxDekstop.checked = false;
                    checkBoxMobile.checked = false;
                    console.log('mode dark found', element.checked);
                    changebackground('light');
                } else if (element.checked && mode == 'light') {
                    element.checked = true;
                    checkBoxDekstop.checked = true;
                    checkBoxMobile.checked = true;
                    console.log('mode light found', element.checked);
                    changebackground('black');
                }


            }
        </script>

        <script>
            function changebackground(tipe) {
                console.log(tipe, 'load')
                setCookie2("tema", tipe, 1);
                localStorage.removeItem("mode");
                localStorage.setItem("mode", tipe == 'black' ? "dark" : 'light');

                $('.grid-img-filter').css("box-shadow", "");
                if (window.innerWidth < 950) {
                    if (tipe == 'black') {
                        $('.grid-img-filter').css("box-shadow", "rgb(255 255 255 / 75%) 0px 0px 20px");
                    } else {
                        $('.grid-img-filter').css("box-shadow", "rgb(0 0 0 / 75%) 0px 0px 8px");
                    }
                }
                // var checkBox = document.getElementById("background-color-switch");
                var text = document.getElementById("body-color");
                var nav = document.getElementById("new-bar-black");
                var filter = document.getElementById("filter-cat-bg-color");
                var filtersub = document.getElementById("filter-subcat-bg-color");
                var mainContainer = document.getElementById("main-container");
                // var footer= document.getElementById("footer-color");
                var des = $('.list-description');
                var listLoading = $('.list-loading');
                var line = $('.list-row');
                var pagination = $('.page-link');
                var listoption = $('.list-option')
                var slicklist = $('.slick-list')
                var floatingmapbutton = $('.map-floating-button')
                // var FooterLink = $('.footer-link');
                var bodyList = document.getElementById("bodyList");
                var fontBlack = $('.font-black');
                var fontLight = $('.font-light');
                if (tipe == 'light') {
                    fontLight.addClass('font-black');
                    fontLight.removeClass('font-light');

                    text.classList.remove('bg-body-black');
                    text.classList.add('bg-body-light');
                    nav.classList.remove('bg-body-black');
                    nav.classList.add('bg-body-light');
                    mainContainer.classList.remove('bg-body-black');
                    mainContainer.classList.add('bg-body-light');
                    // footer.classList.remove('bg-body-black');
                    // footer.classList.add('bg-body-light');
                    des.addClass('font-black');
                    des.removeClass('font-light');
                    listLoading.addClass('font-black');
                    listLoading.removeClass('font-light');
                    line.addClass('row-line-grey');
                    line.removeClass('row-line-white');
                    pagination.addClass('font-black');
                    pagination.removeClass('font-light');
                    listoption.addClass('listoption-light');
                    listoption.addClass('listoption-dark');
                    slicklist.addClass('box-shadow-light');
                    slicklist.removeClass('box-shadow-dark');
                    floatingmapbutton.addClass('box-shadow-light');
                    floatingmapbutton.removeClass('box-shadow-dark');
                    filter.classList.remove('bg-body-black');
                    filter.classList.add('bg-body-light');
                    filtersub.classList.remove('bg-body-black');
                    filtersub.classList.add('bg-body-light');
                    // FooterLink.addClass('footer-link-light');
                    // FooterLink.removeClass('footer-link-dark');

                    // des.classList.remove('font-light');
                    // des.classList.add('font-black');
                    bodyList.classList.remove('bg-body-black');
                    bodyList.classList.add('bg-body-light');
                } else {


                    fontBlack.addClass('font-light');
                    fontBlack.removeClass('font-black');

                    text.classList.remove('bg-body-light');
                    text.classList.add('bg-body-black');
                    nav.classList.remove('bg-body-light');
                    nav.classList.add('bg-body-black');
                    mainContainer.classList.remove('bg-body-light');
                    mainContainer.classList.add('bg-body-black');
                    // footer.classList.remove('bg-body-light');
                    // footer.classList.add('bg-body-black');
                    des.addClass('font-light');
                    des.removeClass('font-black');
                    listLoading.addClass('font-light');
                    listLoading.removeClass('font-black');
                    line.addClass('row-line-white');
                    line.removeClass('row-line-grey');
                    pagination.addClass('font-light');
                    pagination.removeClass('font-black');
                    listoption.addClass('listoption-dark');
                    listoption.removeClass('listoption-light');
                    slicklist.addClass('box-shadow-dark');
                    slicklist.removeClass('box-shadow-light');
                    floatingmapbutton.addClass('box-shadow-dark');
                    floatingmapbutton.removeClass('box-shadow-light');
                    filter.classList.remove('bg-body-light');
                    filter.classList.add('bg-body-black');
                    filtersub.classList.remove('bg-body-light');
                    filtersub.classList.add('bg-body-black');
                    // FooterLink.addClass('footer-link-dark');
                    // FooterLink.removeClass('footer-link-light');

                    // des.classList.remove('font-black');
                    // des.classList.add('font-light');
                    bodyList.classList.remove('bg-body-light');
                    bodyList.classList.add('bg-body-black');
                }
            }
        </script>
