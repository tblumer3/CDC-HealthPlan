<?php
// TBD - numbers and questions not valid
function validate_depression ($survey_answers) {
    return "depression";
}

function qaly_and_cost_per_qaly_depression ($survey_answers) {
    $cost_per_qaly = 192470.73;
    $qaly = 0.00002247;
    $cost = 43.24;

    return [$cost_per_qaly, $qaly, $cost];
}