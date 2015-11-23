<?php
function validate_flu ($survey_answers) {
    return "Influenze";
}


function qaly_and_cost_per_qaly_flu ($survey_answers) {
    //TBD
    // $cost_per_qaly = 12144.81;
    // $qaly = 0.024;
    $cost = 2850.43;

    return [$cost_per_qaly, $qaly, $cost];
}