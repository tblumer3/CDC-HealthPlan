<?php

// To be used in command-line only!

$handle = fopen("data_import.csv", "r");

if ($handle) {
    while (($row = fgetcsv($handle, 1000, ",")) !== false) {
        if ($row[0] == "screening_name") {
            continue;
        }

        $screening_name = $row[0];
        $get_id = intval($row[1]);
        $cost = intval($row[2]);
        $qaly = floatval($row[3]); // decimal stuff
        $cpq = intval($row[4]);

        $sql = "INSERT INTO cpq_table (screening_name, cost, qaly, cpq, get_id) VALUES (\"$screening_name\", $cost, $qaly, $cpq, $get_id)";
    }
} else {
    die("failed to open");
}
