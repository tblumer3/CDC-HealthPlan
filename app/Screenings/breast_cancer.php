<?php

function validate_breast_cancer ($basic_answers) {
    if ($basic_answers['gender'] == "male") {
        if ($basic_answers['age'] < 75) {
            return "Breast Cancer";
        }
    }
    return false;
}

function qaly_and_cost_per_qaly_breast_cancer ($basic_answers) {
    $id = 111;

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    // TBD - test and extract each of the below

    // $cost_per_qaly = 12144.81;
    // $qaly = 0.024;
    // $cost = 292.57;

    return [$cost_per_qaly, $qaly, $cost];
}