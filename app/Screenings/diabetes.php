<?php

function validate_diabetes ($basic_answers, $prior_diagnosis) {
    if (!$prior_diagnosis['diabetes']) {
        if ($basic_answers['obese'] || $prior_diagnosis['high_blood_pressure'] || $prior_diagnosis['high_cholesterol']) {
            return "Diabetes";
        }
    }
    return false;
}

function qaly_and_cost_per_qaly_diabetes ($basic_answers) {
    $id = 112;

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    // TBD - test and extract each of the below

    // $cost_per_qaly = 12144.81;
    // $qaly = 0.024;
    // $cost = 292.57;

    return [$cost_per_qaly, $qaly, $cost];
}