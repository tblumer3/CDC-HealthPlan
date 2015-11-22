function show_sub(event) {
    var div_id = event.target.id;
    var value = $('#'+div_id).prop('checked');
    var follow_div_id = div_id + "-follow";

    if (value) {
        $('#'+follow_div_id).show();
    } else {
        $('#'+follow_div_id).hide();
    }
    return true;
}

// Goes through each required question, checks if it is a valid input and shows required flags accordingly
function check_required() {
    // First reset the form's required notifications
    reset_required();
    // Return value default
    var success = true;

    // Age
    if ($("#age").val() === "") {
        $("#age_required").addClass("required2");
        $("#age_required > .asterisk").show();

        success = false;
    }

    // Gender
    if (!$("#female").prop("checked") && !$("#male").prop("checked")) {
        $("#gender_required").addClass("required2");
        $("#gender_required > .asterisk").show();

        success = false;
    }

    // Height
    if ($("#height").val() === "") {
        $("#height_required").addClass("required2");
        $("#height_required > .asterisk").show();

        success = false;
    } else {
        var height = $("#height").val();
        if (isNaN(height)) {
            $("#height_number").show();

            success = false;
        }
    }

    // Weight
    if ($("#weight").val() === "") {
        $("#weight_required").addClass("required2");
        $("#weight_required > .asterisk").show();

        success = false;
    } else {
        var weight = $("#weight").val();
        if (isNaN(weight)) {
            $("#weight_number").show();

            success = false;
        }
    }

    // Drugs
    if (!$("#drugs-yes").prop("checked") && !$("#drugs-no").prop("checked")) {
        $("#drugs_required").addClass("required2");
        $("#drugs_required > .asterisk").show();

        success = false;
    }

    // Race
    if ($("#race").val() === "") {
        $("#race_required").addClass("required2");
        $("#race_required > .asterisk").show();

        success = false;
    }

    // Number of Screenings
    if ($("#n").val() === "") {
        $("#n_required").addClass("required2");
        $("#n_required > .asterisk").show();

        success = false;
    }

    // Tobacco
    if (!tobacco_checker()) {
        success = false;
    }

    // Alcohol
    if (!alcohol_checker()) {
        success = false;
    }

    // Checks all other inputs
    if (!prior_medical_information_checker()) {
        success = false;
    }
    

    if (!success) {
        $("#final_required").show();
    }

    return success;
}

// Removes the old red requireds to help them finish their survey
function reset_required() {
    $(".required2").removeClass("required2");
    $(".asterisk").hide();
}

function tobacco_checker() {
    var success = true;
    if (!$("#tobacco_yes").prop("checked") && !$("#tobacco_no").prop("checked")) {
        $("#tobacco_required").addClass("required2");
        $("#tobacco_required > .asterisk").show();

        success = false;
    } else {
        // Current smoker branch
        if ( $("#tobacco_yes").prop("checked") ) {
            // Did Select #Packs?
            if ($("#tobacco_yes_packs").val() === "") {
                $("#tobacco_yes_packs_required").addClass("required2");
                $("#tobacco_yes_packs_required > .asterisk").show();

                success = false;
            }
            // Did Select #Years
            if ($("#tobacco_yes_years").val() === "") {
                $("#tobacco_yes_years_required").addClass("required2");
                $("#tobacco_yes_years_required > .asterisk").show();

                success = false;
            }
        } else { // Non-current smoker branch
            if (!$("#tobacco_old_yes").prop("checked") && !$("#tobacco_old_no").prop("checked")) {
                $("#tobacco_no_required").addClass("required2");
                $("#tobacco_no_required > .asterisk").show();

                success = false;
            } else {
                if ($("#tobacco_old_yes").prop("checked")) {
                    if ($("#tobacco_no_quit_years").val() === "") {

                        $("#tobacco_no_quit_years_required").addClass("required2");
                        $("#tobacco_no_quit_years_required > .asterisk").show();
                        success = false;
                    }
                    if ($("#tobacco_no_quit_packs").val() === "") {

                        $("#tobacco_no_quit_packs_required").addClass("required2");
                        $("#tobacco_no_quit_packs_required > .asterisk").show();
                        success = false;
                    }
                    if ($("#tobacco_no_quit_years_smoked").val() === "") {

                        $("#tobacco_no_quit_years_smoked_required").addClass("required2");
                        $("#tobacco_no_quit_years_smoked_required > .asterisk").show();
                        success = false;
                    }
                }
            }
        }
    }
    return success;
}

function alcohol_checker() {
    var success = true;

    if (!$("#alcohol_yes").prop("checked") && !$("#alcohol_no").prop("checked")) {
        $("#alcohol_required").addClass("required2");
        $("#alcohol_required > .asterisk").show();

        success = false;
    }
    if ($("#alcohol_yes_drinks").val() === "") {
        $("#alcohol_yes_drinks_required").addClass("required2");
        $("#alcohol_yes_drinks_required > .asterisk").show();
    }
    return success;
}

function prior_medical_information_checker() {
    // TBD
    return true;
}

function tobacco_switcher() {
    $("input[name=basic_tobacco_then]:radio").change(function() {
        if ($("#tobacco_old_yes").prop("checked")) {
            $(".tobacco_used_follow").show();
            //making spacing correct
            $("#last_and_first").addClass("form-group-short");
            $("#last_and_first").removeClass("form-group-last");
        } else {
            $(".tobacco_used_follow").hide();
            //making spacing correct
            $("#last_and_first").addClass("form-group-last");
            $("#last_and_first").removeClass("form-group-short");
        }
    });

    // Do You currently Smoke Tobacco
    $("input[name=basic_tobacco_now]:radio").change(function() {
        if ($("#tobacco_yes").prop("checked")) { // Current smoker

            $(".tobacco_yes_follow").show();
            $(".tobacco_no_follow").hide();
            $(".tobacco_used_follow").hide();

        } else { // Not Current Smoker

            if ($("#tobacco_old_yes").prop("checked")) {
                console.log("Tobacco old yes");
                $(".tobacco_used_follow").show();
                //making spacing correct
                $("#last_and_first").addClass("form-group-short");
                $("#last_and_first").removeClass("form-group-last");
            }

            // Hide current smoker stuff
            $(".tobacco_yes_follow").hide();
            $(".tobacco_no_follow").show();
        }
    });
}

function alcohol_switcher() {
    $("input[name=basic_alcohol]:radio").change(function() {
        if ($("#alcohol_yes").prop("checked")) {
            $(".alcohol_follow").show();
        } else {
            $(".alcohol_follow").hide();
        }
    });
}

$(document).ready(function() {
    tobacco_switcher();
    alcohol_switcher();
});



