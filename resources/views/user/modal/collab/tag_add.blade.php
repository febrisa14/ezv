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

<div id="saveTagsForm">
    <div class="modal fade" id="modal-add_tag" tabindex="-1" role="dialog" aria-labelledby="modal-default-fadein"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-fullscreen-md-down" role="document">
            <div class="modal-content">
                <div class="modal-header" style="padding-left: 2.3rem !important;">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="height: 450px; overflow-y: scroll; border-radius: 0px;">
                    <input type="hidden" name="id_collab" id="id_collab" value="{{ $profile->id_collab }}">
                    <div class="form-group pt-2 px-4">
                        <div class="row">
                            <div class="translate-text-group"
                                style="display: flex; flex-wrap: wrap; margin-left: 15px;">
                                @foreach ($category as $data)
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="row" style="font-size: 13px;">
                                            @php
                                                $isChecked = '';
                                                foreach ($tags as $item) {
                                                    if ($data->name == $item->collaboratorCategory->name) {
                                                        $isChecked = 'checked';
                                                    }
                                                }
                                            @endphp
                                            <label class="container-checkbox2">
                                                <span class="translate-text-group-items">{{ $data->name }}</span>
                                                <input type="checkbox" value="{{ $data->id_collab_category }}"
                                                    id="{{ $data->id_collab_category }}" name="category[]"
                                                    {{ $isChecked }}>
                                                <span class="checkmark2"></span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-filter-footer d-flex justify-content-center"
                    style="background-color: white; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px; height: 70px;">
                    <div class="col-4" style="text-align: center;">
                        <button id="btnSaveTags" onclick="saveTags()" type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fa fa-check"></i> {{ __('user_page.Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Fade In Default Modal -->
