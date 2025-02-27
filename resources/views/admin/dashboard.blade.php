@extends('layouts.admin.dashboard')

@section('content')
{{-- <div class="row">
    <!-- Statistics -->
    <div class="col-md-6">
        <div class="block block-rounded" href="javascript:void(0)">
        <div class="block-content block-content-full bg-body-extra-light overflow-hidden">
            <div class="py-3">
            <!-- Sparkline Container -->
            <span class="js-sparkline" data-type="line"
                    data-points="[930,860,1100,680,1300,1782,820,960]"
                    data-width="100%"
                    data-height="200px"
                    data-line-color="#6a82fb"
                    data-fill-color="transparent"
                    data-spot-color="transparent"
                    data-min-spot-color="transparent"
                    data-max-spot-color="transparent"
                    data-highlight-spot-color="#6a82fb"
                    data-highlight-line-color="#6a82fb"
                    data-tooltip-suffix="Lines"></span>
            </div>
        </div>
        <div class="block-content block-content-full d-flex align-items-end justify-content-between bg-body-light">
            <div class="me-3">
            <p class="fw-semibold text-uppercase mb-0">
                Code Lines per day
            </p>
            <p class="fs-lg fw-light text-muted mb-0">
                ~930
            </p>
            </div>
            <div>
            <i class="fa fa-2x fa-code text-muted"></i>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="block block-rounded">
        <div class="block-content block-content-full bg-body-extra-light overflow-hidden">
            <div class="py-3">
            <!-- Sparkline Container -->
            <span class="js-sparkline" data-type="line"
                    data-points="[13,12,16,17,12,18,10]"
                    data-width="100%"
                    data-height="200px"
                    data-line-color="#e65c00"
                    data-fill-color="transparent"
                    data-spot-color="transparent"
                    data-min-spot-color="transparent"
                    data-max-spot-color="transparent"
                    data-highlight-spot-color="#e65c00"
                    data-highlight-line-color="#e65c00"
                    data-tooltip-suffix="Tickets"></span>
            </div>
        </div>
        <div class="block-content block-content-full d-flex align-items-end justify-content-between bg-body-light">
            <div class="me-3">
            <p class="fw-semibold text-uppercase mb-0">
                Tickets per day
            </p>
            <p class="fs-lg fw-light text-muted mb-0">
                ~15
            </p>
            </div>
            <div>
            <i class="fa fa-2x fa-life-ring text-muted"></i>
            </div>
        </div>
        </div>
    </div>
    <!-- END Statistics -->
    </div>
    <div class="row">
    <!-- Best Media -->
    <div class="col-md-6 col-xl-4">
        <div class="block block-rounded">
        <div class="block-content block-content-full">
            <p class="text-uppercase fw-semibold text-center mt-2 mb-4">
            Games Collection
            </p>
            <a class="block block-rounded block-link-rotate bg-body-light mb-2" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    480
                </p>
                <p class="text-muted fs-sm mb-0">
                    in Steam
                </p>
                </div>
                <div class="item">
                <i class="fab fa-2x fa-steam text-muted"></i>
                </div>
            </div>
            </a>
            <a class="block block-rounded block-link-rotate bg-body-light mb-2" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    42
                </p>
                <p class="text-muted fs-sm mb-0">
                    in PS4
                </p>
                </div>
                <div class="item">
                <i class="fab fa-2x fa-playstation text-muted"></i>
                </div>
            </div>
            </a>
            <a class="block block-rounded block-link-rotate bg-body-light mb-2" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    35
                </p>
                <p class="text-muted fs-sm mb-0">
                    in Xbox One
                </p>
                </div>
                <div class="item">
                <i class="fab fa-2x fa-xbox text-muted"></i>
                </div>
            </div>
            </a>
            <a class="block block-rounded block-link-rotate bg-body-light mb-0" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    12
                </p>
                <p class="text-muted fs-sm mb-0">
                    in Nintendo Switch
                </p>
                </div>
                <div class="item">
                <i class="fa fa-2x fa-gamepad text-muted"></i>
                </div>
            </div>
            </a>
        </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="block block-rounded">
        <div class="block-content block-content-full">
            <p class="text-uppercase fw-semibold text-center mt-2 mb-4">
            Movies Collection
            </p>
            <a class="block block-rounded block-link-rotate bg-body-light mb-2" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    936
                </p>
                <p class="text-muted fs-sm mb-0">
                    in Adventure
                </p>
                </div>
                <div class="item">
                <i class="fa fa-2x fa-film text-muted"></i>
                </div>
            </div>
            </a>
            <a class="block block-rounded block-link-rotate bg-body-light mb-2" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    260
                </p>
                <p class="text-muted fs-sm mb-0">
                    in Horror
                </p>
                </div>
                <div class="item">
                <i class="fa fa-2x fa-film text-muted"></i>
                </div>
            </div>
            </a>
            <a class="block block-rounded block-link-rotate bg-body-light mb-2" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    763
                </p>
                <p class="text-muted fs-sm mb-0">
                    in Sci-fi
                </p>
                </div>
                <div class="item">
                <i class="fa fa-2x fa-film text-muted"></i>
                </div>
            </div>
            </a>
            <a class="block block-rounded block-link-rotate bg-body-light mb-0" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    150
                </p>
                <p class="text-muted fs-sm mb-0">
                    in Social
                </p>
                </div>
                <div class="item">
                <i class="fa fa-2x fa-film text-muted"></i>
                </div>
            </div>
            </a>
        </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="block block-rounded">
        <div class="block-content block-content-full">
            <p class="text-uppercase fw-semibold text-center mt-2 mb-4">
            Books Collection
            </p>
            <a class="block block-rounded block-link-rotate bg-body-light mb-2" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    260
                </p>
                <p class="text-muted fs-sm mb-0">
                    in Philosophy
                </p>
                </div>
                <div class="item">
                <i class="fa fa-2x fa-book text-muted"></i>
                </div>
            </div>
            </a>
            <a class="block block-rounded block-link-rotate bg-body-light mb-2" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    430
                </p>
                <p class="text-muted fs-sm mb-0">
                    in Fiction
                </p>
                </div>
                <div class="item">
                <i class="fa fa-2x fa-book text-muted"></i>
                </div>
            </div>
            </a>
            <a class="block block-rounded block-link-rotate bg-body-light mb-2" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    368
                </p>
                <p class="text-muted fs-sm mb-0">
                    in Business
                </p>
                </div>
                <div class="item">
                <i class="fa fa-2x fa-book text-muted"></i>
                </div>
            </div>
            </a>
            <a class="block block-rounded block-link-rotate bg-body-light mb-0" href="javascript:void(0)">
            <div class="block-content block-content-sm block-content-full d-flex align-items-center justify-content-between">
                <div class="me-3">
                <p class="fs-lg mb-0">
                    580
                </p>
                <p class="text-muted fs-sm mb-0">
                    in Science
                </p>
                </div>
                <div class="item">
                <i class="fa fa-2x fa-book text-muted"></i>
                </div>
            </div>
            </a>
        </div>
        </div>
    </div>
    <!-- END Best Media -->
</div> --}}
<h1>Welcome to dashboard</h1>
@endsection

@section('scripts')

@endsection