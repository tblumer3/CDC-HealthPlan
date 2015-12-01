<?php
function validate_aspirin ($basic_answers, $prior_diagnosis) {
    $high_risk = false;

    if ($prior_diagnosis['stroke'] || $prior_diagnosis['heart_attack'] || $prior_diagnosis['coronary_artery_disease']) {
        $high_risk = true;
    }

    if ($basic_answers['age'] < 80 && $high_risk) {
        return "Aspirin";
    } else {
        return false;
    }
}

function qaly_and_cost_per_qaly_aspirin ($basic_answers) {

    if ($basic_answers['gender'] == "male") {
        $id = 82;
    } else {
        $id = 83;
    }

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    $data = fetch($id);
    return $data;
}