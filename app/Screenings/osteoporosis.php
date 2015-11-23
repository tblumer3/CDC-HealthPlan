<?php
// TBD - numbers and questions not valid
function validate_osteoporosis ($survey_answers) {
    return "Osteoporosis";
}

function qaly_and_cost_per_qaly_osteoporosis ($survey_answers) {
    if ($survey_answers['race'] == "white") {
        if ($survey_answers['gender'] == "female") {
            if ($survey_answers['age'] < 70) {
                $id = 40;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 41;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 42;
            } 
            if ($survey_answers['age'] < 85) {
                $id = 43;
            } else {
                $id = 44;
            }
        } else {
            if ($survey_answers['age'] < 70) {
                $id = 60;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 61;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 62;
            } 
            if ($survey_answers['age'] < 85) {
                $id = 63;
            } else {
                $id = 64;
            }
        }
    } elseif ($survey_answers['race'] == "black") {
        if ($survey_answers['gender'] == "female") {
            if ($survey_answers['age'] < 70) {
                $id = 45;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 46;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 47;
            } 
            if ($survey_answers['age'] < 85) {
                $id = 48;
            } else {
                $id = 49;
            }
        } else {
            if ($survey_answers['age'] < 70) {
                $id = 65;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 66;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 67;
            } 
            if ($survey_answers['age'] < 85) {
                $id = 68;
            } else {
                $id = 69;
            }
        }
    } elseif ($survey_answers['race'] == "hispanic") {
        if ($survey_answers['gender'] == "female") {
            if ($survey_answers['age'] < 70) {
                $id = 50;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 51;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 52;
            } 
            if ($survey_answers['age'] < 85) {
                $id = 53;
            } else {
                $id = 54;
            }
        } else {
            if ($survey_answers['age'] < 70) {
                $id = 70;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 71;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 72;
            } 
            if ($survey_answers['age'] < 85) {
                $id = 73;
            } else {
                $id = 74;
            }
        }
    } elseif ($survey_answers['race'] == "asian") {
        if ($survey_answers['gender'] == "female") {
            if ($survey_answers['age'] < 70) {
                $id = 55;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 56;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 57;
            } 
            if ($survey_answers['age'] < 85) {
                $id = 58;
            } else {
                $id = 59;
            }
        } else {
            if ($survey_answers['age'] < 70) {
                $id = 75;
            } 
            if ($survey_answers['age'] < 75) {
                $id = 76;
            } 
            if ($survey_answers['age'] < 80) {
                $id = 77;
            } 
            if ($survey_answers['age'] < 85) {
                $id = 78;
            } else {
                $id = 79;
            }
        }
    }
    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    //TBD - run and spitout sql results

    return [$cost_per_qaly, $qaly, $cost];
}