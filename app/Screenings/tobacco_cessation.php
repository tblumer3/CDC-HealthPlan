<?php
function validate_tobacco_cessation ($survey_answers) {
    if ($survey_answers['current_smoker']) {
        return "Tobacco Cessation Therapy";
    } else {
        return false;
    }
}

function qaly_and_cost_per_qaly_tobacco_cessation ($survey_answers) {
    //TBD - not sure if the numbers are for the correct gender
    if ($survey_answers['gender'] == 'female') {
        $cost_per_qaly = 1212.25;
        $qaly = 0.338;
        $cost = 409.74;
    } else {
        $cost_per_qaly = 644.11;
        $qaly = 0.550;
        $cost = 354.26;  
    }

    return [$cost_per_qaly, $qaly, $cost];
}