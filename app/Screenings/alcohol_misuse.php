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

    $data = fetch($id);
    return $data;
}