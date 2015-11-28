<?php

function validate_hiv ($basic_answers, $other_questions) {
    if ($other_questions['partner_hiv'] || $other_questions['self_hiv']) {
        return "HIV/AIDS";
    }
    return false;
}

function qaly_and_cost_per_qaly_hiv ($basic_answers) {
    if ($basic_answers['age'] < 70) {
        $id = 114;
    } elseif ($basic_answers['age'] < 75) {
        $id = 115;
    } else {
        $id = 116;
    }

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    // TBD - test and extract each of the below

    // $cost_per_qaly = 12144.81;
    // $qaly = 0.024;
    // $cost = 292.57;

    return [$cost_per_qaly, $qaly, $cost];
}