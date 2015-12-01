<?php

function importer() {
    ini_set('auto_detect_line_endings',TRUE);
    $handle = fopen("data_input.csv", "r");
    $big_var = [];
    if ($handle) {
        while (($row = fgetcsv($handle)) !== false) {
            if ($row[0] == "screening_name") {
                continue;
            }

            $screening_name = $row[0];
            $get_id = intval($row[1]);
            $cost = intval($row[2]);
            $qaly = floatval($row[3]); // decimal stuff
            $cpq = intval($row[4]);

            $big_var[$get_id] = [$cpq, $qaly, $cost];
            
        }
    } else {
        die("failed to open");
    }
    ini_set('auto_detect_line_endings',FALSE);

    return $big_var;
}