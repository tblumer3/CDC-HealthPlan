<?php
// TBD - numbers and questions not valid
function validate_aspirin ($survey_answers) {
    return "Aspirin";
}

function qaly_and_cost_per_qaly_aspirin ($survey_answers) {
    $cost_per_qaly = 12144.81;
    $qaly = 0.02409;
    $cost = 292.57;

    return [$cost_per_qaly, $qaly, $cost];
}