<?php

function validate_lung_cancer ($basic_answers) {
    if ($basic_answers['smoker']) {
        return "Lung Cancer";
    }
    return false;
}

function qaly_and_cost_per_qaly_lung_cancer ($basic_answers) {
    if ($basic_answers['current_smoker']) {
        $id = 107;
    } else {
        $id = 108;
    }

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    $data = fetch($id);
    return $data;
}