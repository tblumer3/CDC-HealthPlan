<?php
require_once "../app" . "/processing_helpers.php";


// Testing
$screenings = ["Aspirin Use", "Breast Cancer", "Cholesterol", "Colorectal", "Depression Screening", "Flu Shot", "Osteoporosis", "Pneumococcal"];

$costs_per_qaly_array = [12667, 50131, 46990, 37529.67, 192470, 2850, 43333, -1945];
$qaly_array = [0.006, 0.008, 0.0022, 0.01, 0.0002247, 0.0008, 0.024, 0.00333];
$cost_array = [76, 185, 108, 695800, 43.24, 58, 1040, -6.48];


$optimization_payer_result = [1,0,0,0,0,1,0,1,1,0,0,1,0,1,0,0,1,0,0,0,0,1,0,0,1,0,0,0,0,1,0,0,1,0,0,0,0,1,0,0];


$optimization_patient_result = [1,0,0,1,0,0,1,0,1,1,0,0,0,0,0,1,1,0,1,0,0,0,0,0,1,0,0,0,0,1,0,0,1,0,0,0,0,1,0,0];

$big_N = 12;

// includes treatment name as first entry in each row
$table_patient = convert_array($screenings, $optimization_patient_result, "patient", $qaly_array);
$table_payer = convert_array($screenings, $optimization_payer_result, "payer", $costs_per_qaly_array);


// Get summary stats
$patient_summary_results = summary_calculator($optimization_patient_result, $cost_array, $qaly_array, $costs_per_qaly_array, $big_N);
$payer_summary_results = summary_calculator($optimization_payer_result, $cost_array, $qaly_array, $costs_per_qaly_array, $big_N);
//Mock risk_factor and risk
$condition = "Osteoporosis";
$impactful_sub_pops = ["female", "white"];
$graph_image_name = "ost.jpeg";

$risk = ['condition' => $condition, 'sub_pops' => $impactful_sub_pops, 'graph' => $graph_image_name];
$risk_factors = [$risk];

// end Testing


// Final Results Compilation:
$results = [];
$results['patient_table'] = $table_patient;
$results['patient_summary'] = $patient_summary_results;
$results['payer_table'] = $table_payer;
$results['payer_summary'] = $payer_summary_results;
$results['risk_factors'] = $risk_factors;

// die(json_encode($results));


// Last: Redirect to results.php
header('Location: ' . "/app/results.php" . "?" . http_build_query($results));
die("results");

