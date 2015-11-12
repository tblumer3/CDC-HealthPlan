<?php


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

function final_value($val_array, $results) {

}

//Testing
$screenings = ["AAA", "Cancer", "Cancer2", "Annoying Treatment"];

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
$increased_risk = 40;
$impactful_sub_pops = ["female", "white"];
$graph_image_name = "ost.jpeg";

$risk = ['condition' => $condition, 'increased_risk' => $increased_risk, 'sub_pops' => $impactful_sub_pops, 'graph' => $graph_image_name];
$risk_factors = [$risk];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SNR DESIGN</title>
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
            <div class="col-sm-offset-2">
                <table border="1">
                    <? foreach ($table_patient as $row_index => $row): ?>
                        <tr>
                            <? foreach ($row as $shit => $data) {
                                // die(json_encode($row));
                                if ($row_index == 0) { ?>
                                    <th>
                                        <?= $data ?>
                                    </th>
                                <? } else { ?>
                                    <td>
                                        <? if (is_string($data)) {
                                            echo $data;
                                        } else {
                                            if ($data == 0 ) {
                                                echo "-";
                                            } else { ?>
                                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                            <? }
                                        } ?>
                                    </td>
                                <? } ?>
                            <? } ?>
                        </tr>
                    <? endforeach; ?>
                </table>
            </div>
            <br>
            Total Quality Adjusted Life Years Gained: <?= $final_value_patient ?> Years
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Society Optimized Perspective</h2>
        </div>
        <div class="panel-body results-text">
            <div class="col-sm-offset-2">
            <table border="1">
                <? foreach ($table_payer as $row_index => $row): ?>
                    <tr>
                        <? foreach ($row as $shit => $data) {
                            // die(json_encode($row));
                            if ($row_index == 0) { ?>
                                <th>
                                    <?= $data ?>
                                </th>
                            <? } else { ?>
                                <td>
                                    <? if (is_string($data)) {
                                        echo $data;
                                    } else {
                                        if ($data == 0 ) {
                                            echo "-";
                                        } else { ?>
                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                        <? }
                                    } ?>
                                </td>
                            <? } ?>
                        <? } ?>
                    </tr>
                <? endforeach; ?>
            </table>
            </div>
            <br>
            Cost Per Quality Adjusted Life Year Gained: $<?= $final_value_payer ?>
        </div>
    </div>
</div>
<br>

<div class="col-sm-8 col-sm-offset-2">
    <div class="panel panel-default">
        <?php foreach ($risk_factors as $shit => $risk): ?>
            <div class="panel-heading health-alert">
                <h4>Risk Factor Alert: <?= $risk['condition'] ?></h4>
            </div>
            <div class="panel-body">
                <div class="col-sm-6 results-text">
                    You are at <?= $risk['increased_risk']?>% increased risk for <?= $risk['condition'] ?><br>
                    Contributing risk factors include: 
                    <? for ($i=0; $i < sizeof($risk['sub_pops']); $i++) {
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
        <?php endforeach; ?>
    </div>
</div>











