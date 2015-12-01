<?php // Currently used in middle_processing.php

function process_diagnosis($request) {
    if ($request['prior']) {
        return $request['prior'];
    } else {
        return [];
    }
}

function process_other($request) {
    if ($request['other']) {
        $other = [];
        if ($request['other']['personal_hiv'] == "true") {
            $other['self_hiv'] = true;
        } else {
            $other['self_hiv'] = false;
        }

        if ($request['other']['partner_hiv'] == "true") {
            $other['partner_hiv'] = true;
        } else {
            $other['partner_hiv'] = false;
        }
        return $other;
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
    $basic_array['gender'] = $request['basic']['gender'];
    $basic_array['drug_user'] = $request['basic']['drugs'];

    return $basic_array;
}

// If BMI >= 30, then returns true
function is_obese($request) {
    $height = $request['basic']['height'];
    $weight = $request['basic']['weight'];

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

// converts screenings, results and QALY - $/QALY to table format
function convert_array($screenings, $results, $type, $numbers) {
    $final_output = [];
    if ($type == "patient") {
        $final_output[0] = ["Screening Name", "QALYs Gained", "Year 1", "Year 2", "Year 3", "Year 4", "Year 5"];
    } else {
        $final_output[0] = ["Screening Name", "$/QALY Gained", "Year 1", "Year 2", "Year 3", "Year 4", "Year 5"];
    }
    foreach ($screenings as $index => $screening_name) {
        $row = [$screening_name];
        $row[] = $numbers[$index];
        foreach ($results as $res_index => $binary) {
            if ($res_index%sizeof($screenings) == $index) {
                $row[]=round($binary);
            }
        }
        $final_output[]= $row;
    }
    return $final_output;
}

// Computes total cost, total qaly, and avg cost/qaly
function summary_calculator($result, $cost, $qaly, $cost_qaly, $n) {
    $total_cost = 0;
    $total_qaly = 0;
    $total_cost_qaly = 0;

    foreach ($cost_qaly as $index => $value) {
        foreach ($result as $results_index => $bin) {
            if ($results_index%sizeof($cost) == $index) {
                if ($bin == 1) {
                    $total_cost += $cost[$index];
                    $total_qaly += $qaly[$index];
                    $total_cost_qaly += $value;
                }
            }
        }
    }

    $avg_cost_qaly = $total_cost_qaly/$n;

    return [$total_cost, $total_qaly, $avg_cost_qaly];
}

