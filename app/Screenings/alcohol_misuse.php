<?php

function validate_alcohol_misuse ($basic_answers) {
    if ($basic_answers['drinker']) {
        return "Alcohol Misuse";
    }
    return false;
}

function qaly_and_cost_per_qaly_alcohol_misuse ($basic_answers) {
    $id = 81;

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    // TBD - test and extract each of the below

    // $cost_per_qaly = 12144.81;
    // $qaly = 0.024;
    // $cost = 292.57;

    return [$cost_per_qaly, $qaly, $cost];
}