<?php
function validate_tobacco_cessation ($basic_answers) {
    if ($basic_answers['current_smoker']) {
        return "Tobacco Cessation Therapy";
    } else {
        return false;
    }
}

function qaly_and_cost_per_qaly_tobacco_cessation ($basic_answers) {
    if ($basic_answers['gender'] == 'male') {
        $id = 109;
    } else {
        $id = 110; 
    }

    $data = fetch($id);
    return $data;
}