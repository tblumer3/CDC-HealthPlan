<?php
// Take in submitted responses, process them, pass along results to results page
require_once __DIR__ . '/processing_helpers.php';
require_once __DIR__ . '/screening_qaly_builder.php';


// Using Processing Helpers
// Processing of Basic Info - Used to Select Cost and QALY
$basic_info = process_basic_info($_REQUEST);
// Immunization Processing - Immunization Eligibility
$prior_immunizations = $_REQUEST['immunization']; 
// Screenings Processing - Screening Eligibility
$prior_screenings = $_REQUEST['screening'];
// Diagnosis Processing - Screening Eligibility, maybe Cost and QALY
$prior_diagnosis = process_diagnosis($_REQUEST);


// Eligibility, Cost and QALY Arrays
$screening_results = screening_qaly_builder($basic_info, $prior_immunizations, $prior_screenings, $prior_diagnosis);
// Parsing Results from screening qaly builder
$valid_screening_array = $screening_results[0];
$cost_per_qaly_array = $screening_results[1];
$qaly_array = $screening_results[2];

// Run Optimizations - TBD - optimization builder is not valid
$optimization_payer_result = optimization_builder($valid_screening_array, $cost_per_qaly_array, "payer", $big_N, $prior_screenings);
$optimization_patient_result = optimization_builder($valid_screening_array, $qaly_array, "patient", $big_N, $prior_screenings);

// Converting results to table format
$table_payer = convert_array($valid_screening_array, $optimization_payer_result);
$table_patient = convert_array($valid_screening_array, $optimization_patient_result);

// Last Step: Convert raw results into final values ($/QALY avg && QALY's gained - Payer && Patient Respectively) - TBD
$final_value_patient = 10; //number - TBD
$final_value_payer = 10; //number - TBD

// Run Risk Factor Builder - TBD
$risk_factors = risk_factor_builder($stuff);

// All we need to pass to results page
$results = [];
$results['table_patient'] = $table_patient;
$results['table_payer'] = $table_payer;
$results['final_value_patient'] = $final_value_patient;
$results['final_value_payer'] = $final_value_payer;
$results['risk_factors'] = $risk_factors;

// Last: Redirect to results.php
header('Location: ' . "/results.php" . "?" . http_build_query($results));
die("results");