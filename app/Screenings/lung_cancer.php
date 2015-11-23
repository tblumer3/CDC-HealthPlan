<?php

// TBD - numbers and questions not valid
function validate_lung_cancer ($survey_answers) {
    // make sure you check for 'smoker' or 'former_smoker'
    return "Lung Cancer";
}

function qaly_and_cost_per_qaly_lung_cancer ($survey_answers) {

    if ($survey_answers['smoker']) {
        //TBD - put in basic section
        if ($survey_answers['quiting']) {
            $cost_per_qaly = 562500;
            $qaly = 0.008;
            $cost = 4500;
        } else {
            $cost_per_qaly = 117948.72;
            $qaly = 0.039;
            $cost = 4600;
        }
    } else { //former smoker costs
        $cost_per_qaly = 2150000;
        $qaly = 0.002;
        $cost = 4300;       
    }

    return [$cost_per_qaly, $qaly, $cost];
}