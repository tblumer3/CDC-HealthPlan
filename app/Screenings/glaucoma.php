<?php
// TBD - how to put "doctor" recommended in here?
function validate_glaucoma ($basic_answers) {
    return "Glaucoma";
}

function qaly_and_cost_per_qaly_glaucoma ($basic_answers) {
    $id = 106;

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    // TBD - test and extract each of the below

    // $cost_per_qaly = 12144.81;
    // $qaly = 0.024;
    // $cost = 292.57;

    return [$cost_per_qaly, $qaly, $cost];
}