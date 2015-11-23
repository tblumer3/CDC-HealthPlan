<?php
function validate_colorectal ($survey_answers) {
    if ($survey_answers['age'] < 85) {
        return "Colorectal";
    }
    return false;
}


function qaly_and_cost_per_qaly_colorectal ($survey_answers) {
    if ($survey_answers['race'] == "white") {
        if ($survey_answers['gender'] == "female") {
            if ($survey_answers['age'] < 70) {
                $id = 11;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 12;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 13;

            } 
            if ($survey_answers['age'] < 85) {
                $id = 14;
            }
        } else {
            if ($survey_answers['age'] < 70) {
                $id = 16;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 17;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 18;
            } 
            if ($survey_answers['age'] < 85) {
                $id = 19;
            }
        }
    } elseif ($survey_answers['race'] == "black") {
        if ($survey_answers['gender'] == "female") {
            if ($survey_answers['age'] < 70) {
                $id = 21;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 22;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 23;

            } 
            if ($survey_answers['age'] < 85) {
                $id = 24;
            }
        } else {
            if ($survey_answers['age'] < 70) {
                $id = 26;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 27;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 28;
            } 
            if ($survey_answers['age'] < 85) {
                $id = 29;
            }
        }
    }
    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    //TBD - run and spitout sql results

    return [$cost_per_qaly, $qaly, $cost];
}