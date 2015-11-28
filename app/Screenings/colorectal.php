<?php
function validate_colorectal ($basic_answers, $prior_screenings) {
    if ($basic_answers['age'] < 75) {
        // Either never had, or had one >10 yrs and was negative
        if (!$prior_screenings['colonoscopy'] || ($prior_screenings['colonoscopy'] && $prior_screenings['colonoscopy_years'] >= 10 && $prior_screenings['colonoscopy_result'] == "false")) {
            return "Colorectal";
        }
    }
    return false;
}
// TBD - the spreadsheet numbers are wrong for colorectal
function qaly_and_cost_per_qaly_colorectal ($basic_answers) {
    if ($basic_answers['race'] == "white") {
        if ($basic_answers['gender'] == "female") {
            if ($basic_answers['age'] < 70) {
                $id = 96;
            } else {
                $id = 97;
            }
        } else {
            if ($basic_answers['age'] < 70) {
                $id = 98;
            } else {
                $id = 99;
            }
        }
    } elseif ($basic_answers['race'] == "black") {
        if ($basic_answers['gender'] == "female") {
            if ($basic_answers['age'] < 70) {
                $id = 100;
            } else {
                $id = 101;
            }
        } else {
            if ($basic_answers['age'] < 70) {
                $id = 102;
            } else {
                $id = 103;
            }
        }
    }

    $sql = "SELECT cost, qaly, cpq FROM cpq_table WHERE get_id=" . $id;

    // TBD - test and extract each of the below

    // $cost_per_qaly = 12144.81;
    // $qaly = 0.024;
    // $cost = 292.57;

    return [$cost_per_qaly, $qaly, $cost];
}