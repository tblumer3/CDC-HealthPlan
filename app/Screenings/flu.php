<?php
function validate_flu ($basic_answers) {
    return "Influenze";
}


function qaly_and_cost_per_qaly_flu ($basic_answers) {
    $id = 104;

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    $data = fetch($id);
    return $data;
}