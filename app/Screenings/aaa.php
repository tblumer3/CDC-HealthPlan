<?php

function validate_aaa ($basic_answers) {
    if ($basic_answers['gender'] == "male") {
        if ($basic_answers['smoker']) {
            return "AAA"; //Should be the User ready name
        }
    }
    return false;
}

function qaly_and_cost_per_qaly_aaa ($basic_answers) {
    $id = 80;

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    $data = fetch($id);
    return $data;
}