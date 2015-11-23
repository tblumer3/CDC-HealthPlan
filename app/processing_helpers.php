<?php // Currently used in middle_processing.php

function process_diagnosis($request) {
    if ($request['prior']) {
        return $request['prior'];
    } else {
        return [];
    }
}

function process_basic_info($request) {
    $basic_array = [];

    // sets smoking and drinking status
    $basic_array['drinker'] = is_alcoholic($request);
    $basic_array['smoker'] = is_smoker($request); // for lung cancer screening
    $basic_array['current_smoker'] = is_current_smoker($request); // for tobacco cessation therapy
    $basic_array['obese'] = is_obese($request);
    $basic_array['age'] = intval($request['basic']['age']);
    $basic_array['n'] = intval($request['basic']['n']);
    $basic_array['race'] = $request['basic']['race'];

    return $basic_array;
}

// If BMI >= 30, then returns true
function is_obese($request) {
    $weight = $request['basic']['height'];
    $height = $request['basic']['weight'];

    $metric_weight = intval($weight)*0.45;
    $metric_height = intval($height)*0.025;
    $bmi = $metric_weight / ($metric_height*$metric_height);

    if ($bmi >= 30) {
        return true;
    }
    return false;
}

// If more than one drink per day
function is_alcoholic($request) {
    $holder =[];
    if ($request['basic_alcohol']) {
        if ($request['basic']['alcohol']['drinks'] == "7") {
            $holder['drinker'] = true;
        } else {
            $holder['drinker'] = false;
        }
    } else { // no alcohol consumed
        $holder['drinker'] = false;
    }
    return $holder['drinker'];
}

function is_current_smoker($request) {
    if ($request['basic_tobacco_now'] === "true") { 
        return true;
    }
    return false;
}

// If a current smoker with more than 
function is_smoker($request) {
    if ($request['basic_tobacco_now'] === "true") { // Current Smoker
        if ((intval($request['basic']['tobacco_now']['packs'])*intval($request['basic']['tobacco_now']['years'])) >= 30) { // 30 Pack Years
            $basic = true;
        } else {
            $basic = false;
        }
    } else { // Not currently smoking
        if ($request['basic_tobacco_then']) { // Used to smoke
            if ((intval($request['basic']['tobacco_used']['packs'])*intval($request['basic']['tobacco_used']['years'])) >= 30 && $request['basic']['tobacco_used']['quit_years'] <= 15) { // 30 Pack Years, quit less than 15 years ago
                $basic = true;
            } else {
                $basic = false;
            }
        } else {
            $basic = false;
        }
    }
    return $basic;
}

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

