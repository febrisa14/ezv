<!-- Fade In Default Modal -->

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

</style>

<div class="modal fade" id="modal-add_facilities" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-md-down modal-lg modal-dialog-centered modal-horizontal-centered" role="document">
        <div class="modal-content">
            <form action="javascript:void(0);" method="POST" id="basic-form"
                    class="js-validation" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_restaurant" id="id_restaurant"
                        value="{{ $restaurant->id_restaurant }}">
                <div class="modal-header" style="padding-left: 2rem !important;">
                    <h5 class="modal-title">{{ __('user_page.Edit Facilities') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-1" style="height: 450px; overflow-y: auto; border-radius: 0px;">
                        <div class="form-group">
                            <div class="row" style="padding-left: 10px">
                                <div class="row space-y-2 translate-text-group">
                                    @foreach ($facilities as $data)
                                        <div class="col-12 col-md-6 col-lg-4 form-check row admin-edit-aminities-modal translate-text-group">
                                            @php
                                                $isChecked = '';
                                                foreach ($restaurant->facilities as $item) {
                                                    if ($data->name == $item->name) {
                                                        $isChecked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <label class="container-checkbox2">
                                                <span class="translate-text-group-items">
                                                    {{ $data->name }}
                                                </span>
                                                <input type="checkbox" value="{{ $data->id_facilities }}"
                                                    id="{{ $data->id_facilities }}" name="facilities[]"
                                                    {{ $isChecked }}>
                                                <span class="checkmark2"></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                </div>
                <!-- Submit -->
                <div class="modal-filter-footer d-flex justify-content-center"
                    style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; height: 50px;">
                    <div class="col-4" style="text-align: center;">
                        <button type="submit" id="btnSaveFacilities" onclick="saveFacilities()" class="btn btn-sm btn-primary w-100">
                            <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                        </button>
                    </div>
                </div>
            <!-- END Submit -->
            </form>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->

<script>
    function add_facilities() {
        $('#modal-add_facilities').modal('show');
    }
</script>
