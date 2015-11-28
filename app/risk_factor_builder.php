<?php

function risk_factor_builder($basic_answers, $prior_diagnosis) {
    $risk_factors = [];

    //tbd - make sure these match the input
    $diabetes = $prior_diagnosis['diabetes'];
    $hypertension = $prior_diagnosis['high_blood_pressure'];
    $cholesterol = $prior_diagnosis['high_cholesterol'];
    $obese = $basic_answers['obese'];

    //each screening
    echo "osteoporosis risk";
    $osteoporosis = osteoporosis($basic_answers);
    if ($osteoporosis) {
        $risk_factors[] = $osteoporosis;
    }

    echo "diabetus risk";
    $diabetes = diabetes($basic_answers, $cholesterol, $hypertension, $obese);
    if ($diabetes) {
        $risk_factors[] = $diabetes;
    }

    echo "cholesterol risk";
    $cholesterol = cholesterol($basic_answers, $hypertension, $obese, $diabetes);
    if ($cholesterol) {
        $risk_factors[] = $cholesterol;
    }

    echo "hypertension risk";
    $hypertension = hypertension($basic_answers, $cholesterol, $diabetes, $obese);
    if ($hypertension) {
        $risk_factors[] = $hypertension;
    }

    echo "done with risk factors";
    return $risk_factors;
}

function osteoporosis($answers) {
    $gender = $answers['gender'];
    $age = intval($answers['age']);
    $race = $answers['race'];
    $graph = "img_loc"; // TBD
    $risk = ['condition' => "Osteoporosis", 'graph' => $graph, 'sub_pops' => []];

    if ($gender == 'female') {
        $risk['sub_pops'][] = 'female';
    }
    if ($age >= 75) {
        $risk['sub_pops'][] = 'over 75';
    }
    if ($race == 'white') {
        $risk['sub_pops'][] = 'race: white';
    }

    if (sizeof($risk['sub_pops']) > 0) {
        return $risk;
    }
    return false;
}

function diabetes($answers, $cholesterol, $hypertension, $obese) {
    $race = $answers['race'];
    $graph = "img_loc"; // TBD
    $risk = ['condition' => "Diabetes", 'graph' => $graph, 'sub_pops' => []];

    if ($cholesterol) {
        $risk['sub_pops'][] = 'high cholesterol';
    }
    if ($hypertension) {
        $risk['sub_pops'][] = 'high blood pressure';
    }
    if ($race != 'white') {
        $risk['sub_pops'][] = 'race: ' . $race;
    }
    if ($obese) {
        $risk['sub_pops'][] = 'obesity';
    }

    if (sizeof($risk['sub_pops']) > 0) {
        return $risk;
    }
    return false;
}

function cholesterol($answers, $hypertension, $obese, $diabetes) {
    $graph = "img_loc"; // TBD
    $risk = ['condition' => "Cholesterol", 'graph' => $graph, 'sub_pops' => []];

    if ($diabetes) {
        $risk['sub_pops'][] = 'diabetes';
    }
    if ($hypertension) {
        $risk['sub_pops'][] = 'high blood pressure';
    }
    if ($obese) {
        $risk['sub_pops'][] = 'obesity';
    }

    if (sizeof($risk['sub_pops']) > 0) {
        return $risk;
    }
    return false;
}

function hypertension($answers, $cholesterol, $diabetes, $obese) {
    $race = $answers['race'];
    $graph = "img_loc"; // TBD
    $risk = ['condition' => "Hypertension (High Blood Pressure)", 'graph' => $graph, 'sub_pops' => []];

    if ($cholesterol) {
        $risk['sub_pops'][] = 'high cholesterol';
    }
    if ($diabetes) {
        $risk['sub_pops'][] = 'diabetes';
    }
    if ($race == 'black') {
        $risk['sub_pops'][] = 'race: ' . $race;
    }
    if ($obese) {
        $risk['sub_pops'][] = 'obesity';
    }

    if (sizeof($risk['sub_pops']) > 0) {
        return $risk;
    }
    return false;
}