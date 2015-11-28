<?php
function validate_tobacco_cessation ($basic_answers) {
    if ($basic_answers['current_smoker']) {
        return "Tobacco Cessation Therapy";
    } else {
        return false;
    }
}

function qaly_and_cost_per_qaly_tobacco_cessation ($basic_answers) {
    //TBD - not sure if the numbers are for the correct gender
    if ($basic_answers['gender'] == 'male') {
        $id = 109;
    } else {
        $id = 110; 
    }

    // TBD - test and extract each of the below

    // $cost_per_qaly = 12144.81;
    // $qaly = 0.024;
    // $cost = 292.57;

    return [$cost_per_qaly, $qaly, $cost];
}