<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>MY PLAN</title>
    <link rel="shortcut icon" href="https://cdn1.iconfinder.com/data/icons/dental-2-1/90/89-128.png" type="image/x-icon" />
    <link rel="text/javascript" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
    <!-- bootstrap theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link href="css/priority.css" rel="stylesheet" type="text/css" />
    <script src="js/visual.js" type="text/javascript"></script>
</head>
<div class="output">
<?php
error_reporting(0);
// Take in submitted responses, process them, pass along results to results page
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

// Run optimizations!!!
$optimization_payer_result = optimization_builder($valid_screening_array, $cost_per_qaly_array, "payer", $big_N);
$optimization_patient_result = optimization_builder($valid_screening_array, $qaly_array, "patient", $big_N);

// Last Step: Convert raw results into final (cost, qaly, cost/qaly)
$patient_summary_results = summary_calculator($optimization_patient_result, $cost_array, $qaly_array, $cost_per_qaly_array, $big_N);
$payer_summary_results = summary_calculator($optimization_payer_result, $cost_array, $qaly_array, $cost_per_qaly_array, $big_N);


// Converting results to table format
$table_payer = convert_array($valid_screening_array, $optimization_payer_result, "payer", $cost_per_qaly_array);
$table_patient = convert_array($valid_screening_array, $optimization_patient_result, "patient", $qaly_array);

// die(json_encode($table_payer));
// Run Risk Factor Builder
$risk_factors = risk_factor_builder($basic_answers, $prior_diagnosis);

// Final Data Compilation
// All we need to pass to results page
// $results = [];
// $results['patient_table'] = $table_patient;
// $results['patient_summary'] = $patient_summary_results; // this is a len 3 array
// $results['payer_table'] = $table_payer;
// $results['payer_summary'] = $payer_summary_results; // this is a len 3 array
// $results['final_value_patient'] = $final_value_patient;
// $results['final_value_payer'] = $final_value_payer;
// $results['risk_factors'] = $risk_factors;

// $results_patient
$results_patient = $patient_summary_results;
// $results_payer
$results_payer = $payer_summary_results;

// // Last: Redirect to results.php
// header('Location: ' . "/app/results.php" . "?" . http_build_query($results));
// die("results");
?>
</div>
<body>
<div class="col-sm-8 col-sm-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>5 Year Customized Healthplan for Medicare Beneficiaries</h1>
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Patient Health Optimized Perspective</h2>
        </div>
        <div class="panel-body results-text">
            <div>
                <table class="centerer" border="1">
                    <?php foreach ($table_patient as $row_index => $row): ?>
                        <tr>
                            <?php foreach ($row as $shit => $data) {

                                if ($row_index == 0) { ?>
                                    <th>
                                        <?= $data ?>
                                    </th>
                                <?php } else { ?>
                                    <td>
                                        <?php if ($data != "0" && $data != "1") {
                                            echo $data;
                                        } else {
                                            if ($data == 0 ) {
                                                echo "-";
                                            } else { ?>
                                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                            <?php }
                                        } ?>
                                    </td>
                                <?php } ?>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <br>
            Total Quality Adjusted Life Years Gained: <b><?= $results_patient[1] ?> Years </b></br>
            Average Cost per Quality Adjusted Life Year: <b>$<?= number_format($results_patient[2]) ?></b>
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Society Optimized Perspective</h2>
        </div>
        <div class="panel-body results-text">
            <div>
                <table class="centerer" border="1">
                    <?php foreach ($table_payer as $row_index => $row): ?>
                        <tr>
                            <?php foreach ($row as $shit => $data) {
                                // die(json_encode($row));
                                if ($row_index == 0) { ?>
                                    <th>
                                        <?= $data ?>
                                    </th>
                                <?php } else {
                                    ?>
                                    <td>
                                        <?php if ($data != "0" && $data != "1") {
                                            echo $data;
                                        } else {
                                            if ($data == 0 ) {
                                                echo "-";
                                            } else { ?>
                                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                            <?php }
                                        } ?>
                                    </td>
                                <?php } ?>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <br>
            Total Quality Adjusted Life Years Gained: <b><?= $results_payer[1] ?> Years </b></br>
            Average Cost per Quality Adjusted Life Year: <b>$<?= number_format($results_payer[2]) ?></b>
        </div>
    </div>
</div>
<br>

<div class="col-sm-8 col-sm-offset-2">
    <?php foreach ($risk_factors as $shit => $risk): ?>
    <div class="panel panel-default">
        <div class="panel-heading health-alert">
            <h4>Risk Factor Alert: <?= $risk['condition'] ?></h4>
        </div>
        <div class="panel-body">
            <div class="col-sm-6 results-text">
                You are at increased risk for <span class="condition_name"><?= $risk['condition'] ?></span><br>
                Contributing Risk Factors Include: 
                <?php for ($i=0; $i < sizeof($risk['sub_pops']); $i++) {
                    echo $risk['sub_pops'][$i];
                    if ($i != (sizeof($risk['sub_pops'])-1)) {
                        echo ", ";
                    }
                }?>
            </div>
            <div class="col-sm-6">
                <img src="images/<?= $risk['graph'] ?>" height="150" width="150">
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

