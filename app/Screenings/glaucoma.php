<?php
function validate_glaucoma ($basic_answers) {
    return "Glaucoma";
}

function qaly_and_cost_per_qaly_glaucoma ($basic_answers) {
    $id = 106;

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    $data = fetch($id);
    return $data;
}