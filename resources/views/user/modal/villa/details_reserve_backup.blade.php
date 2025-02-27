{{-- MODAL DETAIL RESERVE --}}
@php
    use Illuminate\Support\Facades\Crypt;
@endphp
<style>
    .container-checkbox2 {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-weight: 500 !important;
    }

    /* Hide the browser's default checkbox */
    .container-checkbox2 input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    /* Create a custom checkbox */
    .container-checkbox2 .checkmark2 {
        position: absolute;
        top: 25px;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container-checkbox2:hover input~.checkmark2 {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container-checkbox2 input:checked~.checkmark2 {
        background-color: #FF7400;
    }

    /* Create the checkmark2/indicator (hidden when not checked) */
    .container-checkbox2 .checkmark2:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark2 when checked */
    .container-checkbox2 input:checked~.checkmark2:after {
        display: block;
    }

    /* Style the checkmark2/indicator */
    .container-checkbox2 .checkmark2:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    @media (min-width: 768px) {
        .hide-if-multi {
            width: 41.6% !important;
        }
    }
</style>
<div class="modal fade" id="modal-details-reserve" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true" style="overflow-y:scroll;">
    <div class="modal-dialog modal-md" role="document" style="overflow-y: initial !important">
        <div class="modal-content "
            style="background: white; border-radius:20px; height:100%; margin-top:0 !important;">
            <div class="modal-header modal-header-amenities" style="padding-left: 1.3rem !important;">
                <h5 class="modal-title">{{ Translate::translate('Booking Summary') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="totalprice" class="modal-body p-4" style="overflow-y: auto; overflow-x: hidden;">
                <div class="row">
                    <div class="col-9">
                        <p class="price-box">
                            <span>{{ CurrencyConversion::exchangeWithUnit($villa[0]->price) }}</span>/{{ Translate::translate('night') }}
                        </p>
                    </div>
                </div>
                <div class="reserve-inner-block">
                    <div class="col-12"
                        style="display: flex; border: 2px solid #FF7400; border-radius: 15px; padding-top: 15px; padding-bottom: 15px; box-shadow: 1px 1px 10px #a4a4a4">

                        <div class="col-6 p-5-price line-right-orange">
                            <div class="col-12" style="text-align: center;">
                                <button type="button" class="collapsible_check2" style="background-color: white;">
                                    <p style="margin-left: 0px; margin-bottom:0px; font-size: 12px;">
                                        {{ Translate::translate('CHECK-IN') }}
                                    </p>
                                    <input class=""
                                        style="font-size: 15px; margin-left: 0px; width:100%; text-align: center; border: none !important; border-color: transparent !important;"
                                        type="text" id="check_in3" name="check_in" style="width:80%; border:0"
                                        placeholder="{{ Translate::translate('Add Date') }}" readonly>
                                </button>
                            </div>
                        </div>
                        <div class="col-6 p-5-price">
                            <div class="col-12" style="text-align: center;">
                                <button type="button" class="collapsible_check2" style="background-color: white;">
                                    <p style="margin-left: 0px; margin-bottom: 0px; font-size: 12px;">
                                        {{ Translate::translate('CHECK-OUT') }}
                                    </p>
                                    <input class=""
                                        style="font-size: 15px; margin-left: 0px; width: 100px; text-align: center; border: none !important; border-color: transparent !important;"
                                        type="text" id="check_out3" name="check_out" style="width:80%; border:0"
                                        placeholder="{{ Translate::translate('Add Date') }}" readonly>
                                </button>
                            </div>
                        </div>



                        <div class="content calendar-modal" id="popup_check2">
                            <div class="desk-e-call">
                                <div class="flatpickr-container" style="display: flex; justify-content: center;">
                                    <div style="display: table;">
                                        <div style="padding-left: 15px; padding-right: 30px; text-align: right; text-align: center;"
                                            class="col-lg-12">
                                            <a type="button" id="clear_date2"
                                                style="margin: 0px; font-size: 13px;">{{ Translate::translate('Clear Dates') }}</a>
                                        </div>
                                        <div class="flatpickr" id="inline_reserve2" style="text-align: left;">
                                            {{-- <input type="hidden" class="flatpickr bg-white" name="check_in"> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 p-9-price line-top"
                        style="border: 2px solid #FF7400; margin-top: 19px; border-radius: 15px; box-shadow: 1px 1px 10px #a4a4a4">
                        <button type="button" class="collapsible2">{{ Translate::translate('Number of Guest') }}
                            <p class="guest-right">
                                {{ Translate::translate('guest') }}</p>
                            <input class="guest-right-input" type="number" id="total_guest4" value="1"
                                min="0" readonly>
                        </button>
                        <div class="content sidebar-popup2" style="left: 633px;" id="popup_guest2">
                            <div class="row" style="margin-top: 10px;">

                                <div class="reserve-input-row">
                                    <div class="col-6">
                                        <div class="col-12">
                                            <p class="price-box">
                                                {{ Translate::translate('Adults') }}</p>
                                        </div>
                                        <div class="col-12">
                                            <p class="price-box" style="color: grey">
                                                {{ Translate::translate('Age') }} 13+</p>
                                        </div>
                                    </div>

                                    <div class="col-6"
                                        style="display: flex; align-items: center; justify-content: end;">
                                        <a type="button" onclick="adult_decrement()"
                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                            <i class="fa-solid fa-minus" style="padding:30%"></i>
                                        </a>
                                        <div
                                            style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                            <p><input type="number" id="adult4" name="adult" value="1"
                                                    min="1"
                                                    style="text-align: center; border:none; width:30px;"
                                                    min="0" readonly></p>
                                        </div>
                                        <a type="button" onclick="adult_increment()"
                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                            <i class="fa-solid fa-plus" style="padding:30%"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="reserve-input-row">
                                    <div class="col-6">
                                        <div class="col-12">
                                            <p class="price-box">
                                                {{ Translate::translate('Children') }}</p>
                                        </div>
                                        <div class="col-12">
                                            <p class="price-box" style="color: grey">
                                                {{ Translate::translate('Ages') }} 2-12</p>
                                        </div>
                                    </div>

                                    <div class="col-6"
                                        style="display: flex; align-items: center; justify-content: end;">
                                        <a type="button" onclick="child_decrement()"
                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                            <i class="fa-solid fa-minus" style="padding:30%"></i>
                                        </a>
                                        <div
                                            style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                            <p><input type="number" id="child4" name="child" value="0"
                                                    style="text-align: center; border:none; width:30px;"
                                                    min="0" readonly></p>
                                        </div>
                                        <a type="button" onclick="child_increment()"
                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                            <i class="fa-solid fa-plus" style="padding:30%"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="reserve-input-row">
                                    <div class="col-6">
                                        <div class="col-12">
                                            <p class="price-box">
                                                {{ Translate::translate('Infant') }}</p>
                                        </div>
                                        <div class="col-12">
                                            <p class="price-box" style="color: grey">
                                                {{ Translate::translate('Under') }} 2</p>
                                        </div>
                                    </div>

                                    <div class="col-6"
                                        style="display: flex; align-items: center; justify-content: end;">
                                        <a type="button" onclick="infant_decrement()"
                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                            <i class="fa-solid fa-minus" style="padding:30%"></i>
                                        </a>
                                        <div
                                            style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                            <p><input type="number" id="infant4" name="infant" value="0"
                                                    style="text-align: center; border:none; width:30px;"
                                                    min="0" readonly></p>
                                        </div>
                                        <a type="button" onclick="infant_increment()"
                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                            <i class="fa-solid fa-plus" style="padding:30%"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="reserve-input-row">
                                    <div class="col-6">
                                        <div class="col-12">
                                            <p class="price-box">
                                                {{ Translate::translate('Pets') }}</p>
                                        </div>
                                    </div>

                                    <div class="col-6"
                                        style="display: flex; align-items: center; justify-content: end;">
                                        <a type="button" onclick="pet_decrement()"
                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                            <i class="fa-solid fa-minus" style="padding:30%"></i>
                                        </a>
                                        <div
                                            style="width: 40px; height:20px; text-align: center; color: grey; font-size: 13px;">
                                            <p><input type="number" id="pet4" name="pet" value="0"
                                                    style="text-align: center; border:none; width:30px;"
                                                    min="0" readonly></p>
                                        </div>
                                        <a type="button" onclick="pet_increment()"
                                            style="height: 28px; width: 28px; color: grey; background-color: white; border: 1px solid grey; border-radius: 50%; font-size: 12px;">
                                            <i class="fa-solid fa-plus" style="padding:30%"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12"
                        style="display: flex; flex-direction: column; border: 2px solid #ff7400; border-radius:15px; padding: 9px; box-sizing: border-box; box-shadow: 1px 1px 10px #a4a4a4; margin-top: 20px; display:none"
                        id="counting_part">
                        <div class="col-12" style="display: flex;">
                            <div class="col-6" style="border-right: 2px solid #ff7400;">
                                <p style="font-size: 12px; margin:0px;">
                                    {{ Translate::translate('Total Nights') }}</p>
                            </div>
                            <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                <input id="sum_night3" value="0"
                                    style="font-size: 12px; text-align:left; width: 20px; border:0"><span
                                    style="font-size: 12px;">nights</span>
                            </div>
                        </div>

                        <div class="col-12" style="display: flex;">
                            <div class="col-6" style="border-right: 2px solid #ff7400;">
                                <p style="font-size: 12px; margin:0px;">
                                    {{ Translate::translate('Sub Total') }}</p>
                            </div>

                            <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                <p id="total" style="font-size:12px; margin:0px;">0</p>
                            </div>
                        </div>

                        <div class="col-12" style="display: flex;" id="discount_div">
                            <div class="col-6" style="border-right: 2px solid #ff7400;">
                                <p style="font-size: 12px; margin:0px;">
                                    {{ Translate::translate('Discount') }}</p>
                            </div>

                            <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                <p id="discount" style="font-size:12px; margin:0px; color:green">0</p>
                            </div>
                        </div>

                        <div class="col-12" style="display: flex;" id="cleaning_div">
                            <div class="col-6" style="border-right: 2px solid #ff7400;">
                                <p style="font-size: 12px; margin:0px;">
                                    {{ Translate::translate('Cleaning fee') }}</p>
                            </div>

                            <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                <p id="cleaning_fee" style="font-size:12px; margin:0px;">0</p>
                            </div>
                        </div>

                        <div class="col-12" style="display: flex;">
                            <div class="col-6">
                                <p style="font-size: 12px; margin:0px; border-right: 2px solid #ff7400;">
                                    {{ Translate::translate('Service') }}</p>
                            </div>

                            <div class="col-6" style="padding-left: 12px; box-sizing: border-box;">
                                <p style="font-size: 12px; margin:0px" id="tax"></p>
                            </div>
                        </div>

                        <div class="col-12"
                            style="display: flex; margin-top: 10px; border-top: 2px solid #ff7400; padding-top: 10px;">
                            <div class="col-6">
                                <p style="margin: 0px; font-size: 12px;">
                                    <b>{{ Translate::translate('Total before taxes') }}</b>
                                </p>
                            </div>

                            <div class="col-12">
                                <span style="font-size: 12px;"></span>
                                <b><span id="total_all"
                                        style="font-size:100%; font-size: 12px; margin: 0px;">0</span></b>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-9">
                        <p class="price-box">
                            <span style="font-size:14px;">{{ Translate::translate('Cancellation policy') }}</span>
                        </p>
                    </div>
                    <div class="col-12">
                        <p class="detail-box">
                            <span style="text-align: justify; font-size:12px;">100% refund of amount paid if you cancel
                                by Oct 4, 2022.50% refund of amount paid (minus the service fee) if you cancel by Nov 3,
                                2022.No refund if you cancel after Nov 3, 2022.</span>
                        </p>
                    </div>
                </div>


                    <div class="row" style="padding-left:15px">
                        <div class="col-12">
                            <div class="row" style="font-size: 13px;">
                                <label class="container-checkbox2">
                                    <span class="translate-text-group-items">Virtual Account</span>
                                    <input type="radio" value="va" id="va" name="payment"
                                        onclick="paymentCheck()" autocomplete="off">
                                    <span class="checkmark2"></span>
                                </label>
                            </div>
                        </div>
                        <div id="panel_va" style="display: none; padding:0 30px 10px 20px">
                            <form method="POST" id="va-form" action="{{ route('api.createVa') }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                    @csrf
                                    @auth
                                        <input type="hidden" name="user" id="user" value="{{ Auth::user()->id }}">
                                    @endauth
                                    @guest
                                        <label style="margin: 0px; font-weight: 500;">{{ __('user_page.First Name') }}</label>
                                        <input type="text" class="form-control" name="firstname_va" id="firstname_va" value="" placeholder="firstname">
                                        <small id="err-fname-pay" style="display: none;" class="invalid-feedback"></small>
                                        <label class="mt-3" style="margin: 0px; font-weight: 500;">{{ __('user_page.Last Name') }}</label>
                                        <input type="text" class="form-control" name="lastname_va" id="lastname_va" value="" placeholder="lastname">
                                        <small id="err-lname-pay" style="display: none;" class="invalid-feedback"></small>
                                        <label class="mt-3" style="margin: 0px; font-weight: 500;">{{ __('user_page.Email Address') }}</label>
                                        <input type="email" class="form-control" name="email_va" id="email_va" value="" placeholder="email">
                                        <small id="err-eml-pay" style="display: none;" class="invalid-feedback"></small>
                                    @endguest
                                        <input type="hidden" name="price_total" id="price_total" value="{{ Crypt::encryptString($villa[0]->id_villa) }}">
                                        <input type="hidden" name="check_in_date" id="check_in_date" value="">
                                        <input type="hidden" name="check_out_date" id="check_out_date" value="">
                                        <input type="hidden" name="adult_va" id="adult_va" value="">
                                        <input type="hidden" name="child_va" id="child_va" value="">

                                        <div id="va_brand" class="row" style="font-size: 13px;">
                                            <div class="col-3">
                                                <label class="container-checkbox2">
                                                    <img src="{{ URL::asset('assets/payment_logo/bca-logo.svg') }}">
                                                    <input class="chckbrnd2" type="radio" value="BCA" id="bca" name="bank_option"
                                                        autocomplete="off">
                                                    <span class="checkmark2 chckbrnd"></span>
                                                </label>
                                            </div>
                                            <div class="col-3">
                                                <label class="container-checkbox2">
                                                    <img src="{{ URL::asset('assets/payment_logo/bni-logo.svg') }}">
                                                    <input class="chckbrnd2" type="radio" value="BNI" id="bni" name="bank_option"
                                                        autocomplete="off">
                                                    <span class="checkmark2 chckbrnd"></span>
                                                </label>
                                            </div>
                                            <div class="col-3">
                                                <label class="container-checkbox2">
                                                    <img src="{{ URL::asset('assets/payment_logo/bri-logo.svg') }}">
                                                    <input class="chckbrnd2" type="radio" value="BRI" id="bri" name="bank_option"
                                                        autocomplete="off">
                                                    <span class="checkmark2 chckbrnd"></span>
                                                </label>
                                            </div>
                                            <div class="col-3">
                                                <label class="container-checkbox2">
                                                    <img src="{{ URL::asset('assets/payment_logo/mandiri-logo.svg') }}">
                                                    <input class="chckbrnd2" type="radio" value="MANDIRI" id="mandiri" name="bank_option"
                                                        autocomplete="off">
                                                    <span class="checkmark2 chckbrnd"></span>
                                                </label>
                                            </div>
                                            <div class="col-3">
                                                <label class="container-checkbox2">
                                                    <img src="{{ URL::asset('assets/payment_logo/permata-logo.svg') }}">
                                                    <input class="chckbrnd2" type="radio" value="PERMATA" id="permata" name="bank_option"
                                                        autocomplete="off">
                                                    <span class="checkmark2 chckbrnd"></span>
                                                </label>
                                            </div>
                                            <div class="col-3">
                                                <label class="container-checkbox2">
                                                    <img src="{{ URL::asset('assets/payment_logo/bsi-logo.png') }}"
                                                        style="width: 50%">
                                                    <input class="chckbrnd2" type="radio" value="BSI" id="bsi" name="bank_option"
                                                        autocomplete="off">
                                                    <span class="checkmark2 chckbrnd"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <small id="err-slc-pay" style="display: none;" class="invalid-feedback"></small>
                                        <div class="mt-3 col-12 text-center"><input class="price-button" type="submit"
                                            value="{{ Translate::translate('RESERVE NOW') }}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-12">
                            <div class="row" style="font-size: 13px;">
                                <label class="container-checkbox2">
                                    <span class="translate-text-group-items">Credit Card</span>
                                    <input type="radio" value="credit" id="credit" name="payment"
                                        onclick="paymentCheck()" autocomplete="off">
                                    <span class="checkmark2"></span>
                                </label>
                            </div>
                        </div>
                        <div id="panel_credit" style="display: none; padding:0 30px 10px 20px">
                            <form method="POST" id="payment-form" action="javascript:void(0);">
                                @csrf
                                @auth
                                    <input type="hidden" name="user" id="user" value="{{ Auth::user()->id }}">
                                @endauth
                                <input type="hidden" name="price_total2" id="price_total2" value="">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label style="margin: 0px; font-weight: 500;">{{ __('user_page.Card Number') }}</label>
                                            <div class="input-group">
                                                <input class="form-control" type="text" id="card-number"
                                                    placeholder="Card number" value="" onpaste="return false" oncut="return false" />
                                                <small id="err-cnm-pay" style="display: none;" class="invalid-feedback"></small>
                                                {{-- <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-7 col-md-7">
                                        <div class="form-group">
                                            <label class="mt-3" style="margin: 0px; font-weight: 500;">{{ __('user_page.Expiration') }}</label>
                                            <input class="form-control" type="text" id="card-exp-month"
                                            placeholder="mm/yy" value="" />
                                            <small id="err-exp-pay" style="display: none;" class="invalid-feedback"></small>
                                                {{-- <div class="col-md-6">
                                                    <input class="form-control" type="text" id="card-exp-year"
                                                    placeholder="Card expiration year (yyyy)" value="" />
                                                </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-md-4 pull-right hide-if-multi">
                                        <div class="form-group">
                                            <label class="mt-3" style="margin: 0px; font-weight: 500;">{{ __('user_page.Cvn Code') }}</label>
                                            <input class="form-control" type="text" id="card-cvn" placeholder="Cvn"
                                                value="" />
                                            <small id="err-cvn-pay" style="display: none;" class="invalid-feedback"></small>
                                        </div>
                                    </div>
                                </div>
                                <small id="res-xnd-pay" style="display: none;" class="invalid-feedback mt-2 mb-2"></small>
                                <input class="form-control" type="hidden" id="currency"
                                    placeholder="IDR" value="IDR" />

                                <div class="mt-3 col-12 text-center"><input class="price-button" type="submit"
                                    value="{{ Translate::translate('RESERVE NOW') }}">
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- <div class="col-12 text-center"><input class="price-button" type="submit"
                            value="{{ Translate::translate('RESERVE NOW') }}">
                    </div>
                </form> --}}

                <div id="success" style="display:none;">
                    <p>Success! Use the token id below to charge the credit card.</p>
                    <div class="request">
                        <span>REQUEST DATA</span>
                        <pre class="request-data"></pre>
                    </div>
                    <span>RESPONSE</span>
                    <pre class="result"></pre>
                </div>

                <div id="error" style="display:none;">
                    <p>Whoops! There was an error while processing your request.</p>
                    <div class="request">
                        <span>REQUEST DATA</span>
                        <pre class="request-data"></pre>
                    </div>
                    <span>RESPONSE</span>
                    <pre class="result"></pre>
                </div>


                {{-- <div class="overlay" style="display: none;"></div>
                <div id="three-ds-container" style="display: none;">
                    <iframe height="450" width="550" id="sample-inline-frame" name="sample-inline-frame"> </iframe>
                </div> --}}

                {{-- <div class="col-12 p-5-price price-box text-center">This is the last step before reserve. Please check
                    your booking summary again.</div> --}}
                {{-- <div class="row">
                    <div class="col-7 price-box">Sub Total<input id="sum_night3" value=""
                            style="width: 25px; text-align:right; border:0"> nights</div>
                    <div class="col-5 price-box"><span id="total3" style="font-size:100%">0</span></div>
                    <div class="col-7 price-box">Tax & Service</div>
                    <div class="col-5 price-box"><span id="tax3" style="font-size:100%">0</span></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-7 price-box"><strong>Total </strong></div>
                    <div class="col-5 price-box"><strong><span id="total_all3"
                                style="font-size:100%">0</span></strong></div>
                </div> --}}
            </div>
            <div class="modal-filter-footer" style="height: 20px;"></div>
        </div>
    </div>
</div>
<script>
    $(function() {
        // Virtual Account
        @guest
        // var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@((.*))+$/;

        $(document).on("focusout", "#firstname_va", function () {
            if(!$(this).val()) {
                $('#firstname_va').addClass('is-invalid');
                $('#err-fname-pay').text('{{ __('auth.empty_fname') }}');
                $('#err-fname-pay').show();
            }
        });
        $(document).on("focusout", "#lastname_va", function () {
            if(!$(this).val()) {
                $('#lastname_va').addClass('is-invalid');
                $('#err-lname-pay').text('{{ __('auth.empty_lname') }}');
                $('#err-lname-pay').show();
            }
        });
        $(document).on("focusout", "#email_va", function () {
            if(!$(this).val()) {
                $('#email_va').addClass('is-invalid');

                $('#err-eml-pay').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-pay').show();
            } else {
                if (!regex.test($(this).val())) {
                    $('#email_va').addClass('is-invalid');
                    $('#err-eml-pay').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-pay').show();
                }
            }
        });

        $(document).on("keyup", "#firstname_va", function () {
            this.value = this.value.replace(/[0-9]+$/, '');
            $('#firstname_va').removeClass('is-invalid');
            $('#err-fname-pay').hide();
            $('#err-fname-pay').text('');
        });
        $(document).on("keyup", "#lastname_va", function () {
            this.value = this.value.replace(/[0-9]+$/, '');
            $('#lastname_va').removeClass('is-invalid');
            $('#err-lname-pay').hide();
            $('#err-lname-pay').text('');
        });
        $(document).on("keyup", "#email_va", function () {
            $('#email_va').removeClass('is-invalid');
            $('#err-eml-pay').hide();
            $('#err-eml-pay').text('');
        });
        @endguest
        $(".chckbrnd2").change(function () {
            $('#va_brand').each(function() {
                if($(this).find('input[type="radio"]:checked').length > 0) {
                    $('.chckbrnd').css("border", "");
                    $('#err-slc-pay').hide();
                    $('#err-slc-pay').text('');
                }
            });
        });
        $("#va-form").submit(function(e) {
            let error = 0;
            @guest
            let valname = /[0-9]+$/;
            if(!$('#firstname_va').val()) {
                $('#firstname_va').addClass('is-invalid');
                $('#err-fname-pay').text('{{ __('auth.empty_fname') }}');
                $('#err-fname-pay').show();
                error = 1;
            } else {
                if (valname.test($('#firstname_va').val())) {
                    $('#firstname_va').addClass('is-invalid');
                    $('#err-fname-pay').text('{{ __('auth.invalid_fname') }}');
                    $('#err-fname-pay').show();
                    error = 1;
                }
            }
            if(!$('#lastname_va').val()) {
                $('#lastname_va').addClass('is-invalid');
                $('#err-lname-pay').text('{{ __('auth.empty_lname') }}');
                $('#err-lname-pay').show();
                error = 1;
            } else {
                if (valname.test($('#lastname_va').val())) {
                    $('#lastname_va').addClass('is-invalid');
                    $('#err-lname-pay').text('{{ __('auth.invalid_lname') }}');
                    $('#err-lname-pay').show();
                    error = 1;
                }
            }
            if(!$('#email_va').val()) {
                $('#email_va').addClass('is-invalid');
                $('#err-eml-pay').text('{{ __('auth.empty_mail') }}');
                $('#err-eml-pay').show();
                error = 1;
            } else {
                if (!regex.test($('#email_va').val())) {
                    $('#email_va').addClass('is-invalid');
                    $('#err-eml-pay').text('{{ __('auth.invalid_mail') }}');
                    $('#err-eml-pay').show();
                    error = 1;
                }
            }
            @endguest
            $('#va_brand').each(function() {
                if($(this).find('input[type="radio"]:checked').length == 0) {
                    $('.chckbrnd').css("border", "solid #e04f1a 1px");
                    $('#err-slc-pay').text('{{ __('auth.empty_va') }}');
                    $('#err-slc-pay').show();
                    error = 1;
                }
            });
            if(error == 1) {
                e.preventDefault();
            }
        });

        //Credit Card

        $('#card-number').mask('0000 0000 0000 0000');
        $('#card-exp-month').mask('00/00');
        $('#card-cvn').mask('0000');

        $(document).on("focusout", "#card-number", function () {
            if(!$(this).val()) {
                $('#card-number').addClass('is-invalid');
                $('#err-cnm-pay').text('{{ __('auth.empty_cnm') }}');
                $('#err-cnm-pay').show();
            }
        });
        $(document).on("focusout", "#card-exp-month", function () {
            if(!$(this).val()) {
                $('#card-exp-month').addClass('is-invalid');
                $('#err-exp-pay').text('{{ __('auth.empty_exp') }}');
                $('#err-exp-pay').show();
            }
        });
        $(document).on("focusout", "#card-cvn", function () {
            if(!$(this).val()) {
                $('#card-cvn').addClass('is-invalid');
                $('#err-cvn-pay').text('{{ __('auth.empty_cvn') }}');
                $('#err-cvn-pay').show();
            }
        });

        $(document).on("keyup", "#card-number", function () {
            this.value = this.value.replace(/[a-zA-Z]+$/, '');
            $("#payment-form").find('.submit').prop('disabled', false);
            $('#card-number').removeClass('is-invalid');
            $('#err-cnm-pay').hide();
            $('#err-cnm-pay').text('');
            $('#res-xnd-pay').text();
            $('#res-xnd-pay').hide();
        });
        $(document).on("keyup", "#card-exp-month", function () {
            this.value = this.value.replace(/[a-zA-Z]+$/, '');
            $("#payment-form").find('.submit').prop('disabled', false);
            $('#card-exp-month').removeClass('is-invalid');
            $('#err-exp-pay').hide();
            $('#err-exp-pay').text('');
            $('#res-xnd-pay').text();
            $('#res-xnd-pay').hide();
        });
        $(document).on("keyup", "#card-cvn", function () {
            this.value = this.value.replace(/[a-zA-Z]+$/, '');
            $("#payment-form").find('.submit').prop('disabled', false);
            $('#card-cvn').removeClass('is-invalid');
            $('#err-cvn-pay').hide();
            $('#err-cvn-pay').text('');
            $('#res-xnd-pay').text();
            $('#res-xnd-pay').hide();
        });
        //================ Function ================
        function xenditResponseHandler(err, creditCardToken) {
            if(err) {
                return displayError(err);
            }

            if(creditCardToken.status === 'APPROVED' || creditCardToken.status === 'VERIFIED') {
                displaySuccess(creditCardToken);
            } else if (creditCardToken.status === 'IN_REVIEW') {
                // window.open(creditCardToken.payer_authentication_url, 'sample-inline-frame');
                // $('.overlay').show();
                // $('#three-ds-container').show();
                // $('#modal-3ds').modal('show');
                displayError(creditCardToken);
            } else if (creditCardToken.status === 'FRAUD') {
                displayError(creditCardToken);
            } else if (creditCardToken.status === 'FAILED') {
                displayError(creditCardToken);
            }
        }

        function displayError(err) {
            let error = JSON.stringify(err, null, 4);
            let xparse = JSON.parse(error);
            let text = xparse.message;
            if(text.match("number")) {
                $('#card-number').addClass('is-invalid');
                $('#err-cnm-pay').text(xparse.message);
                $('#err-cnm-pay').show();
            }
            if(text.match("expiration")) {
                $('#card-exp-month').addClass('is-invalid');
                $('#err-exp-pay').text(xparse.message);
                $('#err-exp-pay').show();
            }
            if(text.match("CVN")) {
                $('#card-cvn').addClass('is-invalid');
                $('#err-cvn-pay').text(xparse.message);
                $('#err-cvn-pay').show();
            }
            $('#res-xnd-pay').text("Error from API : " + xparse.message);
            $('#res-xnd-pay').show();

        };

        function displaySuccess(creditCardToken) {
            var requestData = {};
            $.extend(requestData, getTokenData());
            @auth
            var saveData = $.ajax({
                type: 'POST',
                url: "/api/xendit/credit_card/charge",
                data: {
                    dataresult: creditCardToken,
                    datarequest: requestData,
                    user: `{{ Auth::user()->id }}`,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "text",
                success: function(resultData) {
                    alert("success ")
                }
            });
            @endauth
            saveData.error(function() {
                alert("Something went wrong");
            });
        }

        function getTokenData() {
            let exp = $('#card-exp-month').val();
            const split = exp.split("/");
            var cnum = $('#card-number').val();
            var cvn = $('#card-cvn').val();
            return {
                amount: $('#price_total2').val(),
                card_number: cnum.replace(/\s/g, ''),
                card_exp_month: split[0],
                card_exp_year: 20 + split[1],
                card_cvn: $.trim(cvn),
                currency: $('#currency').val(),
            };
        }
        //================ Function ================
        $("#payment-form").submit(function(e) {
            let error = 0;
            let valname = /[a-zA-Z]+$/;
            if(!$('#card-number').val()) {
                $('#card-number').addClass('is-invalid');
                $('#err-cnm-pay').text('{{ __('auth.empty_cnm') }}');
                $('#err-cnm-pay').show();
                error = 1;
            } else {
                if (valname.test($('#card-number').val())) {
                    $('#card-number').addClass('is-invalid');
                    $('#err-lname-pay').text('{{ __('auth.empty_cnm') }}');
                    $('#err-lname-pay').show();
                    error = 1;
                }
            }
            if(!$('#card-exp-month').val()) {
                $('#card-exp-month').addClass('is-invalid');
                $('#err-exp-pay').text('{{ __('auth.empty_exp') }}');
                $('#err-exp-pay').show();
                error = 1;
            } else {
                if (valname.test($('#card-exp-month').val())) {
                    $('#card-exp-month').addClass('is-invalid');
                    $('#err-exp-pay').text('{{ __('auth.empty_exp') }}');
                    $('#err-exp-pay').show();
                    error = 1;
                }
            }
            if(!$('#card-cvn').val()) {
                $('#card-cvn').addClass('is-invalid');
                $('#err-cvn-pay').text('{{ __('auth.empty_cvn') }}');
                $('#err-cvn-pay').show();
                error = 1;
            } else {
                if (valname.test($('#card-cvn').val())) {
                    $('#card-cvn').addClass('is-invalid');
                    $('#err-cvn-pay').text('{{ __('auth.empty_cvn') }}');
                    $('#err-cvn-pay').show();
                    error = 1;
                }
            }
            if(error == 1) {
                e.preventDefault();
            } else {
                Xendit.setPublishableKey(
                    'xnd_public_development_3QHzee46oUGnQ0wEmtefdqdyy4FONKC1Rwfdl2j4IZ0fu74JQAwZHpdRJu1F'
                );
                $("#payment-form").find('.submit').prop('disabled', true);
                var tokenData = getTokenData();
                Xendit.card.createToken(tokenData, xenditResponseHandler);
                return false;
            }
        });
    });
</script>
<script>
    // OLD
    // $(function() {
    //     var $form = $('#payment-form');

    //     $form.submit(function(event) {
    //         hideResults();

    //         Xendit.setPublishableKey(
    //             'xnd_public_development_3QHzee46oUGnQ0wEmtefdqdyy4FONKC1Rwfdl2j4IZ0fu74JQAwZHpdRJu1F'
    //             );

    //         // Disable the submit button to prevent repeated clicks:
    //         $form.find('.submit').prop('disabled', true);

    //         // Request a token from Xendit:
    //         var tokenData = getTokenData();

    //         Xendit.card.createToken(tokenData, xenditResponseHandler);

    //         // Prevent the form from being submitted:
    //         return false;
    //     });

    //     function xenditResponseHandler(err, creditCardToken) {
    //         $form.find('.submit').prop('disabled', false);

    //         if (err) {
    //             return displayError(err);
    //         }

    //         if (creditCardToken.status === 'APPROVED' || creditCardToken.status === 'VERIFIED') {
    //             displaySuccess(creditCardToken);
    //         } else if (creditCardToken.status === 'IN_REVIEW') {
    //             window.open(creditCardToken.payer_authentication_url, 'sample-inline-frame');
    //             $('.overlay').show();
    //             $('#three-ds-container').show();
    //             // $('#modal-3ds').modal('show');
    //         } else if (creditCardToken.status === 'FRAUD') {
    //             displayError(creditCardToken);
    //         } else if (creditCardToken.status === 'FAILED') {
    //             displayError(creditCardToken);
    //         }
    //     }

    //     function displayError(err) {
    //         $('#three-ds-container').hide();
    //         $('.overlay').hide();
    //         $('#error .result').text(JSON.stringify(err, null, 4));
    //         $('#error').show();

    //         var requestData = {};
    //         $.extend(requestData, getTokenData());
    //         $('#error .request-data').text(JSON.stringify(requestData, null, 4));

    //     };

    //     function displaySuccess(creditCardToken) {
    //         $('#three-ds-container').hide();
    //         $('.overlay').hide();

    //         // $('#success .result').text(JSON.stringify(creditCardToken, null, 4));
    //         // $('#success').show();

    //         var requestData = {};
    //         $.extend(requestData, getTokenData());
    //         // $('#success .request-data').text(JSON.stringify(requestData, null, 4));

    //         @auth
    //         var saveData = $.ajax({
    //             type: 'POST',
    //             url: "/api/xendit/credit_card/charge",
    //             data: {
    //                 dataresult: creditCardToken,
    //                 datarequest: requestData,
    //                 user: `{{ Auth::user()->id }}`,
    //                 _token: "{{ csrf_token() }}",
    //             },
    //             dataType: "text",
    //             success: function(resultData) {
    //                 alert("success ")
    //             }
    //         });
    //         @endauth
    //     saveData.error(function() {
    //         alert("Something went wrong");
    //     });

    // }

    // function getTokenData() {
    //     let exp = $form.find('#card-exp-month').val();
    //     const split = exp.split("/");
    //     return {
    //         amount: $form.find('#price_total2').val(),
    //         card_number: $form.find('#card-number').val(),
    //         card_exp_month: split[0],
    //         card_exp_year: 20 + split[1],
    //         card_cvn: $form.find('#card-cvn').val(),
    //         currency: $form.find('#currency').val(),
    //         // on_behalf_of: $form.find('#on-behalf-of').val(),
    //         // billing_details: $form.find('#should-send-billing-details').prop('checked') ? getBillingDetails() : undefined,
    //         // customer: $form.find('#should-send-customer-details').prop('checked') ? getCustomerDetails() : undefined,
    //     };
    // }

    // function hideResults() {
    //     $('#success').hide();
    //     $('#error').hide();
    // }
    // });
</script>

<script>
    function paymentCheck() {
        if (document.getElementById('va').checked) {
            document.getElementById('panel_va').style.display = 'block';
            document.getElementById('panel_credit').style.display = 'none';
        } else if (document.getElementById('credit').checked) {
            document.getElementById('panel_va').style.display = 'none';
            document.getElementById('panel_credit').style.display = 'block';
        }

    }
</script>
