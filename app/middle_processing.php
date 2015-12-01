<?php
// Take in submitted responses, process them, pass along results to results page
// TBD - needs to change based on hosting stuff
require_once "../app" . "/processing_helpers.php";
require_once "../app" . "/screening_qaly_builder.php";
require_once "../app" . "/risk_factor_builder.php";
require_once "../app" . "/optimization_builder.php";

// Using Processing Helpers
// Processing of Basic Info - Used to Select Cost and QALY
$basic_answers = process_basic_info($_REQUEST);
// Immunization Processing - Immunization Eligibility
$prior_immunizations = $_REQUEST['immunization']; 
// Screenings Processing - Screening Eligibility
$prior_screenings = $_REQUEST['screening'];
// Diagnosis Processing - Screening Eligibility, maybe Cost and QALY
$prior_diagnosis = process_diagnosis($_REQUEST);
// Currently just HIV questions, could be expanded
$other_questions = process_other($_REQUEST);
// Set Big_N
$big_N = $basic_answers['n'];

// Eligibility, Cost and QALY Arrays
$screening_results = screening_qaly_builder($basic_answers, $prior_immunizations, $prior_screenings, $prior_diagnosis, $other_questions);

// Parsing Results from screening qaly builder
$valid_screening_array = $screening_results[0];
$cost_per_qaly_array = $screening_results[1];
$qaly_array = $screening_results[2];
$cost_array = $screening_results[3];

die(json_encode($valid_screening_array) . "////" . json_encode($cost_per_qaly_array));

// 
// Done above this line
//

// Run Optimizations - TBD - optimization builder is not valid
$optimization_payer_result = optimization_builder($valid_screening_array, $cost_per_qaly_array, "payer", $big_N);
$optimization_patient_result = optimization_builder($valid_screening_array, $qaly_array, "patient", $big_N);



// 
// Done Below This Line
// 

// Last Step: Convert raw results into final (cost, qaly, cost/qaly)
$patient_summary_results = summary_calculator($optimization_patient_result, $cost_array, $qaly_array, $costs_per_qaly_array, $big_N);
$payer_summary_results = summary_calculator($optimization_payer_result, $cost_array, $qaly_array, $costs_per_qaly_array, $big_N);


// Converting results to table format
$table_payer = convert_array($valid_screening_array, $optimization_payer_result, "payer", $cost_per_qaly_array);
$table_patient = convert_array($valid_screening_array, $optimization_patient_result, "patient", $qaly_array);

// Run Risk Factor Builder
$risk_factors = risk_factor_builder($basic_answers, $prior_diagnosis);

// Final Data Compilation
// All we need to pass to results page
$results = [];
$results['patient_table'] = $table_patient;
$results['patient_summary'] = $patient_summary_results; // this is a len 3 array
$results['payer_table'] = $table_payer;
$results['payer_summary'] = $payer_summary_results; // this is a len 3 array
$results['final_value_patient'] = $final_value_patient;
$results['final_value_payer'] = $final_value_payer;
$results['risk_factors'] = $risk_factors;

// Last: Redirect to results.php
header('Location: ' . "/results.php" . "?" . http_build_query($results));
die("results");


