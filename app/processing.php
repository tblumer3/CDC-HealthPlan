<?php
require_once "../app" . "/processing_helpers.php";


// Testing
$screenings = ["Aspirin Use", "Breast Cancer", "Diabetes", "Hepatitis C"];

$costs_per_qaly_array = [90000, 980, 15000, 1000000];
$qaly_array = [1.02, 0.08, 0.25, 0.09];
$cost_array = [88235, 78.4, 3750, 90000];

$optimization_payer_result = [0,1,1,0,1,1,0,0,0,1,1,0,0,1,0,1,0,1,1,0];
$optimization_patient_result = [1,0,1,0,1,0,1,0,1,0,1,0,1,0,0,1,1,0,1,0];

$big_N = 10;

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


// Last: Redirect to results.php
header('Location: ' . "/results.php" . "?" . http_build_query($results));
die("results");

