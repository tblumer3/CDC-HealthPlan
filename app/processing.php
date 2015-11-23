<?php


die(json_encode($_REQUEST));


// Testing
$screenings = ["Aspirin Use", "Breast Cancer", "Diabetes", "Hepatitis C"];

$costs_array_payer = [90000, 980, 15000, 1000000];
$costs_array_patient = [1.02, .08, .25, .09]; 

$results_patient = [0,1,1,0,1,1,0,0,0,1,1,0,0,1,0,1,0,1,1,0];
$results_payer = [1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,1,1,0,1,0];

// includes treatment name as first entry in each row
$table_patient = convert_array($screenings, $results_patient);
$table_payer = convert_array($screenings, $results_payer);

$final_value_patient = 2.4;
$final_value_payer = 25000;

//Mock risk_factor and risk
$condition = "Osteoporosis";
$impactful_sub_pops = ["female", "white"];
$graph_image_name = "ost.jpeg";

$risk = ['condition' => $condition, 'sub_pops' => $impactful_sub_pops, 'graph' => $graph_image_name];
$risk_factors = [$risk];


function convert_array($screenings, $results) {
    $final_output = [];
    $final_output[0] = ["Screening Name", "Year 1", "Year 2", "Year 3", "Year 4", "Year 5"];
    foreach ($screenings as $index => $screening_name) {
        $row = [$screening_name];
        foreach ($results as $res_index => $binary) {
            if ($res_index%sizeof($screenings) == $index) {
                $row[]=$binary;
            }
        }
        $final_output[]= $row;
    }
    return $final_output;
}
// end Testing


// Final Results Compilation:
$results = [];
$results['table_patient'] = $table_patient;
$results['table_payer'] = $table_payer;
$results['final_value_patient'] = $final_value_patient;
$results['final_value_payer'] = $final_value_payer;
$results['risk_factors'] = $risk_factors;


// Last: Redirect to results.php
header('Location: ' . "/results.php" . "?" . http_build_query($results));
die("results");

