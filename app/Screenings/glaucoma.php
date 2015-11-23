<?php
// TBD - how to put "doctor" recommended in here?
function validate_glaucoma ($survey_answers) {
    return "Glaucoma";
}

function qaly_and_cost_per_qaly_glaucoma ($survey_answers) {
    $cost_per_qaly = 28538.46;
    $qaly = 0.013;
    $cost = 371;

    return [$cost_per_qaly, $qaly, $cost];
}