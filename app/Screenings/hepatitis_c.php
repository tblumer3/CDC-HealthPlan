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

    $data = fetch($id);
    return $data;
}