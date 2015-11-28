<?php

function validate_hepatitis_c ($basic_answers) {
    if ($basic_answers['drug_user'] == "true" || $basic_answers['age'] < 70) {
        return "Hepatitis C";
    }
    return false;
}

function qaly_and_cost_per_qaly_hepatitis_c ($basic_answers) {
    $id = 113;

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    // TBD - test and extract each of the below

    // $cost_per_qaly = 12144.81;
    // $qaly = 0.024;
    // $cost = 292.57;

    return [$cost_per_qaly, $qaly, $cost];
}