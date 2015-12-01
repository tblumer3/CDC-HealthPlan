<?php

function validate_pneumococcal ($basic_answers) {
    return "Pneumococcal Vaccine";
}

function qaly_and_cost_per_qaly_pneumococcal ($basic_answers) {
    $id = 117;

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    $data = fetch($id);
    return $data;
}