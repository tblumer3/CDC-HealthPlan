<?php

function validate_diabetes ($basic_answers, $prior_diagnosis) {
    if (!$prior_diagnosis['diabetes']) {
        if ($basic_answers['obese'] || $prior_diagnosis['high_blood_pressure'] || $prior_diagnosis['high_cholesterol']) {
            return "Diabetes";
        }
    }
    return false;
}

function qaly_and_cost_per_qaly_diabetes ($basic_answers) {
    $id = 112;

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    $data = fetch($id);
    return $data;
}