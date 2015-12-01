<?php
// All Eligible
function validate_cholesterol ($basic_answers) {
    if ($basic_answers['race'] == "white" || $basic_answers['race'] == "black" || $basic_answers['race'] == "hispanic") {
        return "Cholesterol";
    }
    return false;
}

// In progress
function qaly_and_cost_per_qaly_cholesterol ($basic_answers) {

    if ($basic_answers['race'] == "white") {
        if ($basic_answers['gender'] == "male") {
            if ($basic_answers['age'] < 75) {
                $id = 84;
            } else {
                $id = 85;
            }
        } else {
            if ($basic_answers['age'] < 75) {
                $id = 86;
            } else {
                $id = 87;
            }
        }
    } elseif ($basic_answers['race'] == "black") {
        if ($basic_answers['gender'] == "male") {
            if ($basic_answers['age'] < 75) {
                $id = 88;
            } else {
                $id = 89;
            }
        } else {
            if ($basic_answers['age'] < 75) {
                $id = 90;
            } else {    
                $id = 91;
            }
        }
    } elseif ($basic_answers['race'] == "hispanic") {
        if ($basic_answers['gender'] == "male") {
            if ($basic_answers['age'] < 75) {
                $id = 92;               
            } else {
                $id = 93;
            }
        } else {
            if ($basic_answers['age'] < 75) {
                $id = 94;
            } else {
                $id = 95;             
            }
        }
    }

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    $data = fetch($id);
    return $data;
}