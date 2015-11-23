<?php

// using questions to determine if you are cms enabled
function validate_aaa ($survey_answers) {
    if ($survey_answers['male']) {
        if ($survey_answers['smoker']) {
            return "AAA"; //Should be the User ready name
        }
    }
    return false;
}


//returns [$cost_per_qaly, $qaly] for AAA
function qaly_and_cost_per_qaly_aaa ($survey_answers) {
    $cost_per_qaly = 10631.03;
    $qaly = 0.029;
    $cost = 308.3;

    return [$cost_per_qaly, $qaly, $cost];
}