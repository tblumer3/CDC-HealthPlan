<?php
// $table_patient
$table_patient = $_REQUEST['patient_table'];
// $results_patient
$results_patient = $_REQUEST['patient_summary'];
// $table_payer
$table_payer = $_REQUEST['payer_table'];
// $results_payer
$results_payer = $_REQUEST['payer_summary'];
// $risk_factors
$risk_factors = $_REQUEST['risk_factors'];

?>
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
                                        <?php if (is_string($data) && $data != "0" && $data != "1") {
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
                                        <?php if (is_string($data) && $data != "0" && $data != "1") {
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
    <div class="panel panel-default">
        <?php foreach ($risk_factors as $shit => $risk): ?>
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
        <?php endforeach; ?>
    </div>
</div>