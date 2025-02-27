<!-- Fade In Default Modal -->

<style>
    .column.left {
        width: 25%;
        float: left;
    }

    .modal-header-language {
        border-bottom: none !important;
        padding: 2rem 3rem 1rem 3rem;
        display: flex;
    }

    .modal-body-language {
        /* padding: 0rem 2rem 2rem 2rem !important; */
        height: 490px !important;
        overflow-y: auto !important;
    }

    @media (min-width: 768px) {

        .modal-content-language{
            background-color: white;
            width: 90% !important;
        }
    }
    .modal-horizontal-centered {
        display: flex;
        justify-content: center;
    }

    .modal-body-title {
        font-family: "Poppins" !important;
        color: black;
        font-size: 20px;
        margin-bottom: 2rem;
        font-weight: 500;
        margin-top: 2rem;
    }

    .filter-language-option-text {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin-top: 12px;
        font-size: 15px;
        color: grey;
    }

    .filter-language-option-container {
        padding-bottom: 10px;
    }

    .filter-option-text {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin: 6px 0px 0px 0px;
        font-size: 13px !important;
        color: black;
    }

    .filter-option-text-currency {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin: 0px 0px 0px 0px;
        font-size: 13px !important;
        color: black;
    }

    .filter-option-currency {
        font-family: "Poppins" !important;
        font-weight: 500;
        margin: 6px 0px 0px 0px;
        font-size: 13px !important;
        color: grey;
    }

    .filter-language-option-text:focus {
        border: none !important;
    }

    .column.right {
        width: 75%;
        float: left;
    }

    .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
        border: none;
        width: 100%;
        background-color: transparent;
        color: black !important;
    }

    .nav>li>a:active {
        border-right: 2px solid;
        background-color: transparent;
        outline: none;
    }

    .nav>li>a:focus,
    .nav>li>a:hover {
        background-color: transparent;
        outline: none !important;
        border: none !important;
    }


    /* Start of filter modal*/
    .btn-close-modal {
        background: none !important;
        border: none;
    }

    .filter-modal {
        justify-content: flex-end;
    }

    .filter-modal-body {
        padding: 0rem 2rem 2rem 2rem !important;
    }

    .filter-modal-row-language {
        /* padding-top: 2rem; */
        padding-bottom: 2rem;
        display: table;
        width: 100%;
        border-bottom: none;
    }

    .filter-modal-row-title {
        cursor: pointer;
        font-family: "Poppins";
        color: black;
        font-size: 20px;
        margin-bottom: 2rem;
        font-weight: 500;
    }

    .filter-modal-row-title-secondary {
        color: black;
        font-weight: 500;
        font-family: "Poppins";
    }

    .margin-bottom-0px {
        margin-bottom: 0px !important;
    }

    .roomnumberoption-type-title-modal {
        color: black;
        font-family: "Poppins";
        font-size: 16px;
        font-weight: 400;
        margin: 0px;
    }

    .nav-tabs li {
        margin-right: 10px;
    }

    .modal-filter-checkbox {}

    .propertytypemdoal-checkbox-alias {
        border-radius: 15px;
        border: 1px solid rgba(200, 200, 200, 0.77);
        display: inline-block;
        width: 100%;
        height: 110px;
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 15px;
        position: relative;
        cursor: pointer;
    }

    .propertytype-grid-container input[type="checkbox"] {
        display: none;
                /*   margin-right: -20px;
        position: relative;
        z-index: 2; */
    }

    .propertytype-grid-container input[type="checkbox"]:checked+.propertytypemdoal-checkbox-alias {
        border: 2px solid #ff7400;
        background-color: rgba(242, 242, 242, 0.506);
    }

    .propertytypemodal-icon {
        font-size: 26px;
        margin-bottom: 14px;
        margin-top: 7px;
        display: flex;
        justify-content: center;
    }

    .propertymodal-text {
        display: flex;
        justify-content: center;
    }

    .propertymodal-text p {
        margin: 0px;
        font-family: "Poppins" !important;
        font-size: 14px;
        font-weight: 400;
    }

    .modal-filter-text-row {
        margin-top: 0;
        margin-bottom: 2rem !important;
    }

    .mt-2rem {
        margin-top: 2rem !important;
    }

    .modal-fiter-desc {
        font-family: "Poppins" !important;
        font-size: 15px;
        font-weight: 400;
        color: grey;
    }

    .modal-fiter-desc-secondary {
        font-family: "Poppins" !important;
        font-size: 14px;
        font-weight: 400;
        color: grey;
    }

    .checkdesign-modal-filter {
        display: flex;
        align-items: center;
        height: 25px;
        font-family: "Poppins";
        font-weight: 400;
        padding-left: 36px !important;
    }

    .checkdesign-gap {
        margin-top: 15px;
    }

    .modal-margin-0 {
        margin: 0px;
    }

    .modal-padding-0 {
        padding: 0px;
    }

    .modal-booking-checkbox {
        padding: 0px;
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .margin-top-2rem {
        margin-top: 2rem;
    }

    .modal-filter-footer-language {
        display: flex;
        flex-wrap: wrap;
        flex-shrink: 0;
        align-items: center;
        justify-content: flex-end;
        border-top: none;
        height: 20px;
    }

    .modal-checkbox-row {
        margin-top: -17px;
    }

    .propertytype-grid-container {
        grid-template-columns: repeat(4, 1fr) !important;
        grid-template-rows: repeat(1, auto) !important;
        gap: 16px;
        display: grid;
    }

    @media (max-width: 900px) {
    .propertytype-grid-container {
        grid-template-columns: repeat(2, 1fr) !important;
        }
        .nav-tabs > li {
        width: 40%;
        }
    }

    /* End of filter modal*/

    /*Start of filter radio option*/
    .roomnumber-filter-container {
        width: 100%;
    }

    .language-checkbox-alias {
        border-radius: 10px;
        border: 1px solid rgba(200, 200, 200, 0.77);
        display: flex;
        /* align-items: center; */
        width: 100%;
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 15px;
        position: relative;
        cursor: pointer;
        height:100%;
    }

    .roomnumberoption-container input[type="radio"] {
        display: none;
        /*   margin-right: -20px;
        position: relative;
        z-index: 2; */
    }

    .roomnumberoption-container input[type="radio"]:checked+.language-checkbox-alias {
        border: 2px solid #ff7400;
        background-color: rgba(242, 242, 242, 0.506);
    }

    .roomnumberoption-container {
        grid-template-columns: repeat(9, 1fr) !important;
        grid-template-rows: repeat(1, auto) !important;
        gap: 12px;
        display: grid;
        height:100%;
    }

    .roomnumberfiltertitle-gap {
        margin-top: 1.5rem;
    }

    .roomnumberfilter-gap {
        margin-top: 1.5rem;
    }

    /*End of filter radio option*/

</style>
{{--
    <div class="modal fade" id="modal-language" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="overflow-y: initial !important">
            <div class="modal-content" style="background: #fff;">
                <div class="modal-header filter-modal">
                    <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="filter-modal-body">
                    <form action="{{ route('filters') }}" method="GET" id="basic-form" class="js-validation col-12"
    enctype="multipart/form-data"
    style="display: table">
    <div class="filter-modal-row">
        <h5 class="col-12 filter-modal-row-title" style="cursor: pointer;">Price Range</h5>

    </div>
    </div>
    <!-- Submit -->
    <div class="modal-filter-footer">
        <button type="submit"
            style="width:150px; border-radius: 9px; padding : 8px; box-sizing: border-box; background-color: #FF7400; border: none;"
            class="btn btn-primary btn-lg btn-block">
            Save
        </button>
    </div>
    <!-- END Submit -->
    </form>
    </div>
    </div>
    </div>
--}}

<div id="LegalModal" class="modal fade bs-example-modal-lg">
    <div class="modal-dialog modal-fullscreen-md-down modal-xl modal-dialog-centered modal-horizontal-centered"
        style="overflow-y: initial !important;">
        <div class="modal-content modal-content-language">
            <div class="modal-header-language filter-modal">
                <button type="button" class="btn-close-modal" data-bs-dismiss="modal" aria-label="Close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body modal-body-language">
                <div class="tabbable column-wrapper">
                    <!-- Only required for left/right tabs -->

                    <ul class="nav filter-language-option-container nav-tabs sideTab column"
                        style="display: flex; flex-wrap: nowrap;">
                        <li id="trigger-tab-language" onclick="switchTabLanguage('language')"><a class="tab1 filter-language-option-text">{{ __('user_page.Language') }}</a></li>
                        <li id="trigger-tab-currency" onclick="switchTabLanguage('currency')"><a class="filter-language-option-text">{{ __('user_page.Currency') }}</a></li>
                    </ul>
                    <div class="tab-content tab-content-language column rigth" id="tabs">
                        <div class="tab-pane active" id="content-tab-language">
                            <h3 class="modal-body-title">{{ __('user_page.Choose a Language') }}</h3>

                            @php
                            $language = App\Http\Controllers\CurrencyController::language();
                            @endphp

                            <form action="{{ route('language_set') }}" method="post" id="translateForm">
                                @csrf
                                <div class="filter-modal-row-language">
                                    <div class="propertytype-input-row">
                                        <div class="col-12 propertytype-grid-container">
                                            @foreach ($language as $item)
                                            <div class="">
                                                <div class="roomnumberoption-container" style="display: flex;">
                                                    <div class="roomnumber-filter-container">
                                                        @php
                                                            $isChecked = '';
                                                            if(session()->has('locale')) {
                                                                if($item->locale == session('locale')) {
                                                                    $isChecked = 'checked';
                                                                }
                                                            } else {
                                                                if($item->locale == 'en') {
                                                                    $isChecked = 'checked';
                                                                }
                                                            }
                                                        @endphp
                                                        <input type="radio" value="{{ $item->locale }}" id="{{ $item->locale }}" name="locale" onchange="this.form.submit()" {{ $isChecked }} />
                                                        <label class="language-checkbox-alias"
                                                            for="{{ $item->locale }}">
                                                            <div>
                                                                <img src="{{ URL::asset('assets/flags/flag_'.$item->locale.'.svg')}}"
                                                                    style="width: 27px; border:0.1px solid grey;">
                                                                <p class="filter-option-text">
                                                                    {{ $item->locale_name }}
                                                                </p>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" form="translateForm" class="d-none">{{ __('user_page.translate') }}</button>
                            </form>

                        </div>
                        <div class="tab-pane" id="content-tab-currency">
                            <h3 class="modal-body-title">{{ __('user_page.Choose a currency') }}</h3>
                            @php
                            $currency = App\Models\Currency::where('symbol', '!=', '')->get();
                            @endphp
                            <form action="{{ route('currency_set') }}" method="post">
                                @csrf
                                <div class="filter-modal-row-language">
                                    <div class="propertytype-input-row">
                                        <div class="col-12 propertytype-grid-container">
                                            @foreach ($currency as $item)
                                            <div class="">
                                                <div class="roomnumberoption-container" style="display: flex;">
                                                    <div class="roomnumber-filter-container">
                                                        @php
                                                            $isChecked = '';
                                                            if(session()->has('currency')) {
                                                                if($item->code == session('currency')) {
                                                                    $isChecked = 'checked';
                                                                }
                                                            } else {
                                                                if($item->code == 'IDR') {
                                                                    $isChecked = 'checked';
                                                                }
                                                            }
                                                        @endphp
                                                        <input type="radio" value="{{ $item->code }}" id="{{ $item->code }}" onchange="this.form.submit()" name="currency" {{ $isChecked }} />
                                                        <label class="language-checkbox-alias"
                                                            for="{{ $item->code }}">
                                                            <div>
                                                                <p class="filter-option-text-currency">{{ $item->name }}</p>
                                                                <p class="filter-option-currency">{{ $item->code }} -
                                                                    {{ $item->symbol }}</p>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-filter-footer-language">

            </div>
        </div>
    </div>
</div>

<script>
    function switchTabLanguage(indicator){
        if(indicator == 'currency'){
            $('#trigger-tab-language').removeClass('active');
            $('#content-tab-language').removeClass('active');
            $('#trigger-tab-currency').addClass('active');
            $('#content-tab-currency').addClass('active');
        }
        if(indicator == 'language'){
            $('#trigger-tab-language').addClass('active');
            $('#content-tab-language').addClass('active');
            $('#trigger-tab-currency').removeClass('active');
            $('#content-tab-currency').removeClass('active');
        }
    }
</script>


