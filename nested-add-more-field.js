
$(document).ready(function(e) {
    // Add More Parent Fields
    var i = 0;
    $("#add-more").click(function() {
        i++;
        var newFieldSet = $(".field-set:first").clone();
        // newFieldSet.find("input").val(""); // Clear input values
        newFieldSet.find(".nested-fields").empty(); // Clear nested fields
        $("#fields-container").append(`<div class="field-set">
                <div class="card mb-3">
                    <div class="card-body px-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="select_a_field" class="mb-2">If</label>
                                    <select name="select[0][field]" id="select_field" class="form-select">
                                        <option value="">select a field</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <select name="select[0][condition_is]" id="condition_is"
                                                class="form-select">
                                                <option value="is">is</option>
                                                <option value="is_not">is not</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="dynamic_condition"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="show_hide" class="mb-2">Then</label>
                                    <select name="select[0][show_hide]" id="show_hide" class="form-select">
                                        <option value="show">Show</option>
                                        <option value="hide">Hide</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <select name="select[0][one_more]" id="select_one_more"
                                                class="form-select">
                                                <option value="">select one more filed</option>
                                                <option value="">select one more filed</option>
                                            </select>
                                            <span class="pt-2 text-muted" style="font-size: 15px !important;">Select
                                                one or more fields to show based on condition. </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nested-fields">
                            <!-- Nested fields will go here -->
                        </div>
                        <button type="button" class="add-nested btn btn-none text-primary fs-6 ps-0"><i
                                class="fas fa-plus"></i> Add Condition</button>
                        <div class="text-end">
                            <a href="javascript:" class="btn  btn-secondary remove_field">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>`);
        if (i > 0) {
            $('.condition_fields').addClass('d-none');
        }
    });

    $(".add_a_field").click(function() {
        i++;
        var newFieldSet = $(".field-set:first").clone();
        // newFieldSet.find("input").val(""); // Clear input values
        newFieldSet.find(".nested-fields").empty(); // Clear nested fields
        $("#fields-container").append(`<div class="field-set">
                <div class="card mb-3">
                    <div class="card-body px-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="select_a_field" class="mb-2">If</label>
                                    <select name="select[0][field]" id="select_field" class="form-select">
                                        <option value="">select a field</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <select name="select[0][condition_is]" id="condition_is"
                                                class="form-select">
                                                <option value="is">is</option>
                                                <option value="is_not">is not</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="dynamic_condition"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="show_hide" class="mb-2">Then</label>
                                    <select name="select[0][show_hide]" id="show_hide" class="form-select">
                                        <option value="show">Show</option>
                                        <option value="hide">Hide</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <select name="select[0][one_more]" id="select_one_more"
                                                class="form-select">
                                                <option value="">select one more filed</option>
                                                <option value="">select one more filed</option>
                                            </select>
                                            <span class="pt-2 text-muted" style="font-size: 15px !important;">Select
                                                one or more fields to show based on condition. </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nested-fields">
                            <!-- Nested fields will go here -->
                        </div>
                        <button type="button" class="add-nested btn btn-none text-primary fs-6 ps-0"><i
                                class="fas fa-plus"></i> Add Condition</button>
                        <div class="text-end">
                            <a href="javascript:" class="btn  btn-secondary remove_field">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>`);
        if (i > 0) {
            $('.condition_fields').addClass('d-none');
        }
    });

    $(document).on('click', '.remove_field', function(){  
        $(this).parents('.field-set').remove();
        i--;
        if (i == 0) {
            $('.condition_fields').removeClass('d-none');
        }
    });
    

    
    // Add More Nested Fields within a Parent Field
    $(document).on("click", ".add-nested", function() {
        var newNestedFields = `<div class="row remove_condition">
            <div class="row">
                <div class="col-md-2">
                    <div class="mb-3">
                        <select name="select[0][condition_and_or]" id="condition_and_or" class="form-select">
                            <option value="and">and</option>
                            <option value="or">or</option>
                        </select>
                    </div>
                </div>    
            </div>
            <div class="col-md-6 mb-3"><select name="select[0][field]" id="select_field" class="form-select"><option value="">select a field</option></select></div>
            <div class="row align-items-center mb-3">
                <div class="col-md-4"><select name="select[0][condition]" id="condition" class="form-select"><option value="is">is</option><option value="is_not">is not</option></select></div>
                <div class="col-md-2"><a href="javascript:" class="remove_condition text-end btn  btn-secondary"><i class="fas fa-trash"></i></a></div>
            </div>
        </div>`;
        $(this).siblings(".nested-fields").append(newNestedFields);
    });

    $(document).on('click', '.remove_condition', function(){  
        $(this).parents('.remove_condition').remove();
    });
});