<?php
// TBD - remove logging

// TBD - remove test data below
$screenings = ["AAA", "Aspirin", "Breast Cancer", "Alcohol Misuse"];
$numbers = [1000,1200,1500,900];
$perspective = "payer";
$big_N = 10;

// TBD - remove test call below
optimization_builder($screenings, $numbers, $perspective, $big_N);

function optimization_builder($screenings, $numbers, $perspective, $big_N) {
    // Objective function
    $number_of_columns = sizeof($numbers)*5;

    // Declare Model
    
    $lp = lpsolve('make_lp', 0, $number_of_columns);
    echo "Model Declaration ";
    // Objective Function - Final
    objective_function_builder($numbers, $perspective, $lp);

    // Binary Constraints - Final
    binary_constraint_builder($screenings, $lp);

    // for constraint visualization
    ?>
    </br>
    <?php

    // column limits - Final
    column_limits($screenings, $big_N, $lp);
    echo "|| Column limits complete ";


    // row limits - Final
    row_limits($screenings, $lp);
    echo "|| Row limits complete ";

    // total limit - Final
    total_n_limit($screenings, $big_N, $lp);
    echo "|| Total limit complete ";

    print lpsolve('solve', $lp) . "\n"; // - Solves the LP
    print lpsolve('get_objective', $lp) . "\n";
    print_r(lpsolve('get_variables', $lp));

    $variables = lpsolve('get_variables', $lp);
    // print_r(lpsolve('get_constraints', $lp));
    lpsolve('delete_lp', $lp);
    
    die("fuck");
}

function objective_function_builder($numbers, $perspective, $lp) {
    if ($perspective == "payer") {
        echo "PAYER PERSPECTIVE";
        lpsolve('set_minim', $lp);
        $max_min = "Minimum";
    } else {
        lpsolve('set_maxim', $lp);
        $max_min = "Maximum";
    }

    $objective_array = [];
    for ($i=0; $i < 5; $i++) { 
        $objective_array = array_merge($objective_array, $numbers);
    }

    $return = lpsolve('set_obj_fn', $lp, $objective_array);

    if ($return) {
        echo "|| Set objective function ";
    } else {
        echo "|| failed to set objective function ";
        die();
    }
}

function binary_constraint_builder($screenings, $lp) {
    $number_of_screenings = sizeof($screenings);
    $number_of_columns = $number_of_screenings*5;
    // die(json_encode($number_of_columns));

    $vars_array = [];
    for ($i=0; $i < $number_of_columns; $i++) {
        $zero_array = zero_constraints_generator($number_of_screenings);

        $zero_array[$i] = 1;
        $success = lpsolve('set_binary',$lp, $zero_array);

    }

    if ($success) {
        echo "|| added binary vars ";
    } else {
        echo "|| failed to set bin vars ";
    }
}

function column_limits($screenings, $big_N, $lp) {
    $number_of_screenings = sizeof($screenings);
    $number_of_columns = $number_of_screenings*5;

    $column_max_count = ceil($big_N / 5);

    for ($n=0; $n < 5; $n++) { 
        $zero_array = zero_constraints_generator($number_of_screenings);
        
        for ($i=0; $i < $number_of_screenings; $i++) { 
            $index = $n*$number_of_screenings + $i;
            $zero_array[$index] = 1;
        }

        $result = lpsolve('add_constraint', $lp, $zero_array, LE, $column_max_count);
        if (!$result) {
            echo "|| column limit failure ";
        }

        // local logging - TBD - remove
        log_constraint($zero_array, "LOE", $column_max_count, "Column " . $n . " max screenings constraint");
    }
}

//need to intigrate past screening data (through $prior_screenings answers)
function row_limits($screenings, $lp) {
    $frequency_list = ["AAA" => 10, "Alcohol Misuse" => 2, "Aspirin" => 1, "Breast Cancer" => 1, "Cholesterol" => 5, "Colorectal" => 10, "Depression" => 1, "Diabetes" => 1, "Influenze" => 1, "Glaucoma" => 1, "Hepatitis C" => 10, "HIV/AIDS" => 5, "Lung Cancer" => 1, "Osteoporosis" => 2, "Pneumococcal Vaccine" => 10, "Tobacco Cessation Therapy" => 2];
    $number_of_screenings = sizeof($screenings);

    foreach ($screenings as $screening_index => $screening_name) {
        $frequency = $frequency_list[$screening_name];

        standard_frequency_constraints($frequency, $screening_index, $screening_name, $lp, $number_of_screenings);
    }
}

function total_n_limit($screenings, $big_N, $lp) {
    $number_of_screenings = sizeof($screenings);
    $zero_array = zero_constraints_generator($number_of_screenings);
    foreach ($zero_array as $index => $value) {
        $zero_array[$index] = 1;
    }

    $result = lpsolve('add_constraint', $lp, $zero_array, EQ, $big_N);
    if (!$result) {
        echo "|| total screening limit failure ";
    }

    // local logging - TBD - remove
    log_constraint($zero_array, "EQ", $big_N, "Total N limit");  
}

function standard_frequency_constraints($freq, $index, $name, $lp, $number_of_screenings) {
    switch ($freq) {
        case 1:
            break;

        case 2:
            for ($n=0; $n <= 3; $n++) { 
                $zero_array = zero_constraints_generator($number_of_screenings);
                $var1 = ($index + $n * $number_of_screenings);
                $var2 = ($index + ($n+1) * $number_of_screenings);

                $zero_array[$var1] = 1;
                $zero_array[$var2] = 1;

                $result = lpsolve('add_constraint', $lp, $zero_array, LE, 1);
                if (!$result) {
                    echo "|| row limit failure ";
                }
                log_constraint($zero_array, "LOE", 1, $name . " frequency limit - 2 years");

            }
            break;

        case 3:
            for ($n=0; $n <= 2; $n++) { 
                $zero_array = zero_constraints_generator($number_of_screenings);
                $var1 = ($index + $n * $number_of_screenings);
                $var2 = ($index + ($n+1) * $number_of_screenings);
                $var3 = ($index + ($n+2) * $number_of_screenings);

                $zero_array[$var1] = 1;
                $zero_array[$var2] = 1;
                $zero_array[$var3] = 1;

                $result = lpsolve('add_constraint', $lp, $zero_array, LE, 1);
                if (!$result) {
                    echo "|| row limit failure ";
                }  
                log_constraint($zero_array, "LOE", 1, $name . " frequency limit - 3 years");

            }
            break;
        case 5:
            $zero_array = zero_constraints_generator($number_of_screenings);

            for ($n=0; $n < 5; $n++) { 
                $var = ($index + $n * $number_of_screenings);
                $zero_array[$var] = 1;
            }

            $result = lpsolve('add_constraint', $lp, $zero_array, LE, 1);
            if (!$result) {
                echo "|| row limit failure ";
            }
            log_constraint($zero_array, "LOE", 1, $name . " frequency limit - 5 years");
            
            break;
        default:
            $zero_array = zero_constraints_generator($number_of_screenings);

            for ($n=0; $n < 5; $n++) { 
                $var = ($index + $n * $number_of_screenings);
                $zero_array[$var] = 1;
            }

            $result = lpsolve('add_constraint', $lp, $zero_array, LE, 1);
            if (!$result) {
                echo "|| row limit failure ";
            }
            log_constraint($zero_array, "LOE", 1, $name . " frequency limit - 10 years / Once Only");
            break;
    }
}
function log_constraint($args, $sign, $value, $description) {
    $output = "";
    $string_args = json_encode($args);

    $output .= $description;
    $output .= "; " . $sign;
    $output .= "; " . $value;
    $output .= "; - " . $string_args . "\n";

    echo $output;
    ?>
    </br>
    <?php
}

//returns the full array of all possible screening years, zero'd
function zero_constraints_generator($number_of_screenings) {
    $zero_array = [];
    for ($n=0; $n < 5; $n++) { 
        for ($i=1; $i <= $number_of_screenings; $i++) {
            $zero_array[] = 0;
        }
    }
    
    return $zero_array;
}


optimization_builder($screenings, $numbers, $perspective, $big_N, $prior_screenings);

