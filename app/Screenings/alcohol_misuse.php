<?php

function validate_alcohol_misuse ($survey_answers) {
    if ($survey_answers['drinker']) {
        return "Alcohol Misuse";
    }
    return false;
}


//TBD
function qaly_and_cost_per_qaly_alcohol_misuse ($survey_answers) {
    $cost_per_qaly = 12144.81;
    $qaly = 0.024;
    $cost = 292.57;

    return [$cost_per_qaly, $qaly, $cost];
}