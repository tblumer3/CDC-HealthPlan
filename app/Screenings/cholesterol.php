<?php
// TBD
function validate_cholesterol ($survey_answers) {
    return "Cholesterol";
}


//returns [$cost_per_qaly, $qaly] for AAA
function qaly_and_cost_per_qaly_cholesterol ($survey_answers) {

    if ($survey_answers['race'] == "white") {
        if ($survey_answers['gender'] == "male") {
            if ($survey_answers['age'] < 75) {
                $cost_per_qaly = 40241.18;
                $qaly = 0.00268;
            } else {
                $cost_per_qaly = 10452.47;
                $qaly = 0.0103;
            }
        } else {
            if ($survey_answers['age'] < 75) {
                $cost_per_qaly = 46990.19;
                $qaly = 0.0023;
            } else {
                $cost_per_qaly = 36887.37;
                $qaly = 0.0029;
            }
        }
    } elseif ($survey_answers['race'] == "black") {
        if ($survey_answers['gender'] == "male") {
            if ($survey_answers['age'] < 75) {
                $cost_per_qaly = 39516.67;
                $qaly = 0.0027;
            } else {
                $cost_per_qaly = 8500;
                $qaly = 0.0127;
            }
        } else {
            if ($survey_answers['age'] < 75) {
                $cost_per_qaly = 47543.48;
                $qaly = 0.00227;
            } else {
                $cost_per_qaly = 41566.66;
                $qaly = 0.002598;
            }
        }
    } elseif ($survey_answers['race'] == "hispanic") {
        if ($survey_answers['gender'] == "male") {
            if ($survey_answers['age'] < 75) {
                $cost_per_qaly = 41266;
                $qaly = 0.0026;                
            } else {
                $cost_per_qaly = 2400;
                $qaly = 0.045;
            }
        } else {
            if ($survey_answers['age'] < 75) {
                $cost_per_qaly = 46250;
                $qaly = 0.00233;
            } else {
                $cost_per_qaly = 38000;
                $qaly = 0.00284;               
            }
        }
    }

    $cost = 108;
    return [$cost_per_qaly, $qaly, $cost];
}