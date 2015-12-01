<?php
function validate_depression ($basic_answers) {
    return "Depression";
}

function qaly_and_cost_per_qaly_depression ($survey_answers) {
    $id = 105;

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    $data = fetch($id);
    return $data;
}