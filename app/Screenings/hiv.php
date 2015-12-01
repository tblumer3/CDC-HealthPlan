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

    $data = fetch($id);
    return $data;
}