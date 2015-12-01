<?php
// all eligible
function validate_osteoporosis ($basic_answers) {
    if ($basic_answers['race'] && $basic_answers['race'] != "other") {
        return "Osteoporosis";
    }
}

function qaly_and_cost_per_qaly_osteoporosis ($basic_answers) {
    if ($basic_answers['race'] == "white") {
        if ($basic_answers['gender'] == "female") {
            if ($basic_answers['age'] < 70) {
                $id = 40;
            } 
            if ($basic_answers['age'] < 75) {
                $id = 41;
            } 
            if ($basic_answers['age'] < 80) {
                $id = 42;
            } 
            if ($basic_answers['age'] < 85) {
                $id = 43;
            } else {
                $id = 44;
            }
        } else {
            if ($basic_answers['age'] < 70) {
                $id = 60;
            } 
            if ($basic_answers['age'] < 75) {
                $id = 61;
            } 
            if ($basic_answers['age'] < 80) {
                $id = 62;
            } 
            if ($basic_answers['age'] < 85) {
                $id = 63;
            } else {
                $id = 64;
            }
        }
    } elseif ($basic_answers['race'] == "black") {
        if ($basic_answers['gender'] == "female") {
            if ($basic_answers['age'] < 70) {
                $id = 45;
            } 
            if ($basic_answers['age'] < 75) {
                $id = 46;
            } 
            if ($basic_answers['age'] < 80) {
                $id = 47;
            } 
            if ($basic_answers['age'] < 85) {
                $id = 48;
            } else {
                $id = 49;
            }
        } else {
            if ($basic_answers['age'] < 70) {
                $id = 65;
            } 
            if ($basic_answers['age'] < 75) {
                $id = 66;
            } 
            if ($basic_answers['age'] < 80) {
                $id = 67;
            } 
            if ($basic_answers['age'] < 85) {
                $id = 68;
            } else {
                $id = 69;
            }
        }
    } elseif ($basic_answers['race'] == "hispanic") {
        if ($basic_answers['gender'] == "female") {
            if ($basic_answers['age'] < 70) {
                $id = 50;
            } 
            if ($basic_answers['age'] < 75) {
                $id = 51;
            } 
            if ($basic_answers['age'] < 80) {
                $id = 52;
            } 
            if ($basic_answers['age'] < 85) {
                $id = 53;
            } else {
                $id = 54;
            }
        } else {
            if ($basic_answers['age'] < 70) {
                $id = 70;
            } 
            if ($basic_answers['age'] < 75) {
                $id = 71;
            } 
            if ($basic_answers['age'] < 80) {
                $id = 72;
            } 
            if ($basic_answers['age'] < 85) {
                $id = 73;
            } else {
                $id = 74;
            }
        }
    } elseif ($basic_answers['race'] == "asian") {
        if ($basic_answers['gender'] == "female") {
            if ($basic_answers['age'] < 70) {
                $id = 55;
            } 
            if ($basic_answers['age'] < 75) {
                $id = 56;
            } 
            if ($basic_answers['age'] < 80) {
                $id = 57;
            } 
            if ($basic_answers['age'] < 85) {
                $id = 58;
            } else {
                $id = 59;
            }
        } else {
            if ($basic_answers['age'] < 70) {
                $id = 75;
            } 
            if ($basic_answers['age'] < 75) {
                $id = 76;
            } 
            if ($basic_answers['age'] < 80) {
                $id = 77;
            } 
            if ($basic_answers['age'] < 85) {
                $id = 78;
            } else {
                $id = 79;
            }
        }
    }

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    $data = fetch($id);
    return $data;
}