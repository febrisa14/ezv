@extends('new-admin.layouts.admin_layout')

@section('title', 'Taxes - EZV2')

<style>
    @media only screen and (max-width: 767px) {
        .card-tax-info-container {
            padding-left: 1.5rem !important;
            padding-right: 1.5rem !important;
            margin-top: 1rem !important;
        }
        .card-tax-info {
            width: 100% !important;
        }
        .ml-max-md-10p {
            margin-left: 10px !important;
        }
        .ml-max-md-0p {
            margin-left: 0px !important;
        }
    }
    @media only screen and (min-width: 768px) {
        .mb-md-7r {
            margin-bottom: 7rem !important;
        }
    }
    @media only screen and (min-width: 768px) and (max-width: 991px) {
        .card-tax-info-container {
            position: absolute !important;
            top: 200px !important;
            right: 7rem !important;
        }
    }
    @media only screen and (min-width: 768px) and (max-width: 1199px) {
        .card-tax-info {
            width: 18rem !important;
        }
    }
    @media only screen and (min-width: 992px) {
        .card-tax-info-container {
            position: absolute !important;
            top: 180px !important;
            right: 7rem !important;
        }
    }
    @media only screen and (min-width: 1200px) {
        .card-tax-info-container {
            position: absolute !important;
            top: 180px !important;
            right: 7rem !important;
        }
        .card-tax-info {
            width: 23rem !important;
        }
    }
</style>

@section('content_admin')

<div class="page-header">
    <div class="container text-dark mb-md-7r">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between" style="position: relative;">
                <div class="col-12 mt-2 ml-max-md-10p" style="margin-left: 30px;">
                    <div class="block-content">
                        <nav aria-label="breadcrumb" style="margin-left: -10px;">
                            <ol class="breadcrumb" style="background: transparent;">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('account_setting') }}" style="color: #FF7400">Account</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Payments & payouts</li>
                            </ol>
                        </nav>
                    </div>
                    <h1 style="font-weight:bold; color: #383838; font-size:25pt; margin-top: -20px;">
                        Payments & payouts
                    </h1>
                </div>

                <div class="col-12">
                    <div class="col-md-7 mt-5 ml-max-md-0p" style="margin-left: 20px; border-bottom: 1px solid #DFDFDE;">
                        <div class="title-bar" style="margin-right: 20px; display: inline-block;">
                            <a style="text-decoration: none;" href="{{ route('payments') }}">
                                <h6>Payments</h6>
                            </a>
                        </div>
                        <div class="title-bar" style="display: inline-block; margin-right: 20px;">
                            <a style="text-decoration: none;" href="{{ route('payouts') }}">
                                <h6>Payouts</h6>
                            </a>
                        </div>
                        <div class="title-bar"
                            style="display: inline-block; border-bottom: 2px solid #FF7400; margin-right: 20px;">
                            <a style="text-decoration: none;" href="{{ route('taxes') }}">
                                <h6><b>Taxes</b></h6>
                            </a>
                        </div>
                        <div class="title-bar" style="display: inline-block; margin-right: 20px;">
                            <a style="text-decoration: none;" href="{{ route('guest-contributions') }}">
                                <h6>Guest Contributions</h6>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-md-9">
                    <div class="col-md-9 mt-5 ml-max-md-0p" style="margin-left: 20px;">
                        <div>
                            <h3><b>VAT</b></h3>
                            <p>If you are registered for VAT or your stay is for business, you may not be charged VAT on
                                EZV service fees. To get started, enter your business’ VAT ID Number. <a
                                    href="#"><u>Learn more about VAT.</u></a></p>

                            <button type="button" class="btn btn-dark mt-4">Add VAT ID Number</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3 card-tax-info-container">
                    <div class="card p-4 card-tax-info">
                        <div class="card-body">
                            <svg viewBox="0 0 24 24" role="presentation" aria-hidden="true" focusable="false"
                                style="height: 40px; width: 40px; display: block; fill: rgb(255, 115, 0);">
                                <path
                                    d="M8.9997,1.9857 L5.9997,1.9857 C5.4467,1.9857 4.9997,2.4327 4.9997,2.9857 L4.9997,15.9857 C4.9997,16.5387 5.4467,16.9857 5.9997,16.9857 L8.9997,16.9857 C9.5527,16.9857 9.9997,16.5387 9.9997,15.9857 L9.9997,2.9857 C9.9997,2.4327 9.5527,1.9857 8.9997,1.9857">
                                </path>
                                <path
                                    d="M23.4646,1.9886 C23.3616,1.9956 23.1726,2.0096 22.9076,2.0326 C22.6266,2.0546 22.3186,2.0836 21.9996,2.1126 L21.9996,1.0766 C21.9996,0.8506 21.8486,0.6526 21.6306,0.5936 C21.5586,0.5746 21.4276,0.5416 21.2446,0.5006 C20.9436,0.4306 20.6076,0.3626 20.2416,0.2986 C18.9656,0.0746 17.6726,-0.0384 16.4576,0.0196 C14.4816,0.1146 12.9226,0.6516 11.9676,1.7596 C10.9646,0.7386 9.5236,0.1966 7.7686,0.0456 C6.4486,-0.0704 5.0476,0.0426 3.6756,0.2976 C3.3266,0.3616 3.0076,0.4306 2.7236,0.5016 C2.5506,0.5436 2.4266,0.5766 2.3586,0.5966 C2.1446,0.6586 1.9976,0.8546 1.9976,1.0766 L1.9976,2.1256 C1.6806,2.0926 1.3786,2.0636 1.0986,2.0386 C0.8326,2.0136 0.6436,1.9976 0.5406,1.9896 C0.2496,1.9656 -0.0004,2.1956 -0.0004,2.4876 L-0.0004,4.5016 C-0.0004,4.7766 0.2246,5.0016 0.4996,5.0016 C0.7766,5.0016 0.9996,4.7766 0.9996,4.5016 C1.0026,3.5226 1.0046,3.0336 1.0066,3.0346 C1.3146,3.0616 1.6466,3.0936 1.9976,3.1306 L1.9976,18.3596 C1.9976,18.6546 2.2516,18.8856 2.5456,18.8576 C2.6096,18.8516 2.7356,18.8426 2.9136,18.8326 C4.3736,18.7526 6.0396,18.8286 7.6066,19.1756 C9.4086,19.5766 10.7906,20.2896 11.6026,21.3546 C11.7856,21.5956 12.1416,21.6196 12.3556,21.4026 C13.5296,20.2156 14.4836,19.6646 15.5416,19.4616 C16.0546,19.3636 16.4696,19.3436 17.4986,19.3436 C17.7756,19.3436 17.9986,19.1206 17.9986,18.8436 C17.9986,18.5676 17.7756,18.3436 17.4986,18.3436 C16.4056,18.3436 15.9496,18.3656 15.3546,18.4796 C14.2116,18.6976 13.1826,19.2486 12.0336,20.3206 C11.0466,19.2796 9.6026,18.5946 7.8226,18.2006 C6.2026,17.8406 4.5066,17.7546 2.9976,17.8266 L2.9976,2.7626 C2.9996,2.7536 3.0006,2.7436 3.0016,2.7336 C3.0066,2.6866 3.0046,2.6406 2.9976,2.5966 L2.9976,1.4636 C3.2556,1.4006 3.5446,1.3396 3.8586,1.2806 C5.1496,1.0406 6.4646,0.9356 7.6816,1.0416 C9.4486,1.1946 10.7966,1.7766 11.5976,2.8636 C11.8096,3.1526 12.2456,3.1316 12.4296,2.8236 C13.1046,1.6886 14.5256,1.1136 16.5056,1.0186 C17.6376,0.9646 18.8606,1.0716 20.0686,1.2836 C20.4076,1.3426 20.7206,1.4066 20.9996,1.4696 L20.9996,17.8706 C20.6706,17.8826 20.3066,17.9016 19.9156,17.9306 C19.6406,17.9516 19.4336,18.1916 19.4546,18.4676 C19.4756,18.7426 19.7146,18.9486 19.9896,18.9276 C20.3906,18.8986 20.7606,18.8796 21.0916,18.8686 C21.2886,18.8616 21.4286,18.8596 21.4996,18.8596 C21.7766,18.8596 21.9996,18.6356 21.9996,18.3596 L21.9996,3.1176 C22.3496,3.0846 22.6886,3.0536 22.9996,3.0276 L22.9996,18.9906 C23.0006,19.9346 23.0796,19.8266 22.3526,19.9436 C22.0516,19.9916 20.5616,20.2916 18.1566,20.7846 C17.2576,20.9686 16.2976,21.1666 15.3406,21.3646 C14.7986,21.4756 14.7986,21.4756 14.4166,21.5546 C14.1306,21.6146 14.1306,21.6146 14.0676,21.6276 C13.9736,21.6466 13.8876,21.6926 13.8186,21.7596 C13.7026,21.8726 13.4866,22.0536 13.2096,22.2356 C12.7836,22.5126 12.3686,22.6796 11.9946,22.6906 C11.6446,22.6936 11.2626,22.5376 10.8866,22.2666 C10.6516,22.0986 10.4756,21.9296 10.3856,21.8276 C10.3146,21.7446 10.2176,21.6886 10.1106,21.6666 C10.0456,21.6526 10.0456,21.6526 9.7526,21.5926 C9.3616,21.5106 9.3616,21.5106 8.8086,21.3966 C7.8296,21.1946 6.8496,20.9926 5.8606,20.7896 C3.4716,20.2996 1.9476,19.9926 1.6406,19.9436 C0.9186,19.8276 0.9986,19.9386 0.9996,18.9906 L0.9996,6.5016 C0.9996,6.2256 0.7766,6.0016 0.4996,6.0016 C0.2246,6.0016 -0.0004,6.2256 -0.0004,6.5016 L-0.0004,18.9906 C-0.0024,20.3976 0.2356,20.7306 1.4836,20.9306 C1.7676,20.9756 3.3086,21.2866 5.7286,21.7836 C6.6486,21.9716 7.6276,22.1746 8.6066,22.3766 C9.1596,22.4906 9.1596,22.4906 9.5496,22.5716 C9.6436,22.5916 9.7066,22.6036 9.7526,22.6136 C9.8886,22.7516 10.0736,22.9156 10.3026,23.0796 C10.8366,23.4626 11.4066,23.6956 12.0436,23.6896 C12.6146,23.6746 13.1906,23.4426 13.7566,23.0726 C14.0266,22.8966 14.2476,22.7206 14.4066,22.5786 C14.4516,22.5696 14.5176,22.5556 14.6196,22.5346 C15.0016,22.4556 15.0016,22.4556 15.5436,22.3426 C16.4996,22.1456 17.4586,21.9486 18.4256,21.7506 C20.7246,21.2786 22.2326,20.9746 22.5096,20.9306 C23.7596,20.7306 24.0016,20.3956 23.9996,18.9896 L23.9996,2.4876 C23.9996,2.1976 23.7536,1.9676 23.4646,1.9886 Z M13.4776,10.9856 L18.9996,10.9856 C19.2766,10.9856 19.4996,10.7616 19.4996,10.4856 C19.4996,10.2096 19.2766,9.9856 18.9996,9.9856 L13.4776,9.9856 C13.2006,9.9856 12.9776,10.2096 12.9776,10.4856 C12.9776,10.7616 13.2006,10.9856 13.4776,10.9856 Z M13.9996,6.9856 L18.9996,6.9856 L18.9996,4.9856 L13.9996,4.9856 L13.9996,6.9856 Z M12.9996,6.9856 L12.9996,4.9856 C12.9996,4.4326 13.4466,3.9856 13.9996,3.9856 L18.9996,3.9856 C19.5526,3.9856 19.9996,4.4326 19.9996,4.9856 L19.9996,6.9856 C19.9996,7.5386 19.5526,7.9856 18.9996,7.9856 L13.9996,7.9856 C13.4466,7.9856 12.9996,7.5386 12.9996,6.9856 Z M13.4776,13.9856 L18.9996,13.9856 C19.2766,13.9856 19.4996,13.7616 19.4996,13.4856 C19.4996,13.2096 19.2766,12.9856 18.9996,12.9856 L13.4776,12.9856 C13.2006,12.9856 12.9776,13.2096 12.9776,13.4856 C12.9776,13.7616 13.2006,13.9856 13.4776,13.9856 Z M9.9996,3.9856 L4.9996,3.9856 C4.7236,3.9856 4.4996,4.2096 4.4996,4.4856 C4.4996,4.7616 4.7236,4.9856 4.9996,4.9856 L9.9996,4.9856 C10.2766,4.9856 10.4996,4.7616 10.4996,4.4856 C10.4996,4.2096 10.2766,3.9856 9.9996,3.9856 Z M10.4996,7.4856 C10.4996,7.7616 10.2766,7.9856 9.9996,7.9856 L4.9996,7.9856 C4.7236,7.9856 4.4996,7.7616 4.4996,7.4856 C4.4996,7.2096 4.7236,6.9856 4.9996,6.9856 L9.9996,6.9856 C10.2766,6.9856 10.4996,7.2096 10.4996,7.4856 Z"
                                    fill="#484848"></path>
                            </svg>
                            <h5 class="card-title mt-4"><b>Where is my VAT invoice?</b></h5>
                            <p class="card-text">Once you book a place for business travel, you can find a link to the
                                VAT invoice in the booking confirmation email. <a href="#"><u>Learn more.</u></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('new-admin.layouts.footer')
    @endsection

    @section('scripts')
    @endsection
