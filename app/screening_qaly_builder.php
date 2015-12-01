<?php
require_once "../app" . '/Screenings/aaa.php';
require_once "../app" . '/Screenings/alcohol_misuse.php';
require_once "../app" . '/Screenings/aspirin.php';
require_once "../app" . '/Screenings/breast_cancer.php';
require_once "../app" . '/Screenings/cholesterol.php';
require_once "../app" . '/Screenings/colorectal.php';
require_once "../app" . '/Screenings/depression.php';
require_once "../app" . '/Screenings/diabetes.php';
require_once "../app" . '/Screenings/flu.php';
require_once "../app" . '/Screenings/glaucoma.php';
require_once "../app" . '/Screenings/hepatitis_c.php';
require_once "../app" . '/Screenings/hiv.php';
require_once "../app" . '/Screenings/lung_cancer.php';
require_once "../app" . '/Screenings/osteoporosis.php';
require_once "../app" . '/Screenings/pneumococcal.php';
require_once "../app" . '/Screenings/tobacco_cessation.php';
require_once "../app" . '/Screenings/data_file.php';
require_once "../app" . '/data_importer.php';

function screening_qaly_builder ($basic_answers, $prior_immunizations, $prior_screenings, $prior_diagnosis, $other_questions) {
    $big_var = importer();
    $_ENV['big'] = $big_var;

    $valid_screening_array = [];
    $cost_per_qaly_array = [];
    $qaly_array = [];
    $cost_array = [];

    // Fully Converted
    echo "aaa";
    $aaa = validate_aaa($basic_answers);
    if ($aaa) {
        $valid_screening_array[] = $aaa;
        // get qaly and $/qaly numbers
        $aaa_results = qaly_and_cost_per_qaly_aaa($basic_answers);

        $cost_per_qaly_array[] = $aaa_results[0];
        $qaly_array[] = $aaa_results[1];
        $cost_array[] = $aaa_results[2];
    }

    // Fully Converted
    echo "alcohol";
    $alcohol_misuse = validate_alcohol_misuse($basic_answers);
    if ($alcohol_misuse) {
        $valid_screening_array[] = $alcohol_misuse;
        // get qaly and $/qaly numbers
        $alcohol_misuse_results = qaly_and_cost_per_qaly_alcohol_misuse($basic_answers);

        $cost_per_qaly_array[] = $alcohol_misuse_results[0];
        $qaly_array[] = $alcohol_misuse_results[1];
        $cost_array[] = $alcohol_misuse_results[2];
    }

    // Fully Converted
    echo "asprin";
    $aspirin = validate_aspirin($basic_answers, $prior_diagnosis);
    if ($aspirin) {
        $valid_screening_array[] = $aspirin;
        // get qaly and $/qaly numbers
        $aspirin_results = qaly_and_cost_per_qaly_aspirin($basic_answers);

        $cost_per_qaly_array[] = $aspirin_results[0];
        $qaly_array[] = $aspirin_results[1];
        $cost_array[] = $aspirin_results[2];
    }

    // Fully Converted
    echo "breast_cancer";
    $breast_cancer = validate_breast_cancer($basic_answers);
    if ($breast_cancer) {
        $valid_screening_array[] = $breast_cancer;
        // get qaly and $/qaly numbers
        $breast_cancer_results = qaly_and_cost_per_qaly_breast_cancer($basic_answers);

        $cost_per_qaly_array[] = $breast_cancer_results[0];
        $qaly_array[] = $breast_cancer_results[1];
        $cost_array[] = $breast_cancer_results[2];
    }

    // Fully Converted
    echo "cholesterol";
    $cholesterol = validate_cholesterol($basic_answers);
    if ($cholesterol) {
        $valid_screening_array[] = $cholesterol;
        // get qaly and $/qaly numbers
        $cholesterol_results = qaly_and_cost_per_qaly_cholesterol($basic_answers);

        $cost_per_qaly_array[] = $cholesterol_results[0];
        $qaly_array[] = $cholesterol_results[1];
        $cost_array[] = $cholesterol_results[2];
    }

    // Fully Converted
    echo "colorectal";
    $colorectal = validate_colorectal($basic_answers, $prior_screenings);
    if ($colorectal) {
        $valid_screening_array[] = $colorectal;
        // get qaly and $/qaly numbers
        $colorectal_results = qaly_and_cost_per_qaly_colorectal($basic_answers);

        $cost_per_qaly_array[] = $colorectal_results[0];
        $qaly_array[] = $colorectal_results[1];
        $cost_array[] = $colorectal_results[2];
    }

    // Fully Converted
    echo "depression";
    $depression = validate_depression($basic_answers);
    if ($depression) {
        $valid_screening_array[] = $depression;
        // get qaly and $/qaly numbers
        $depression_results = qaly_and_cost_per_qaly_depression($basic_answers);

        $cost_per_qaly_array[] = $depression_results[0];
        $qaly_array[] = $depression_results[1];
        $cost_array[] = $depression_results[2];
    }

    // Fully Converted
    echo "diabetes";
    $diabetes = validate_diabetes($basic_answers, $prior_diagnosis);
    if ($diabetes) {
        $valid_screening_array[] = $diabetes;
        // get qaly and $/qaly numbers
        $diabetes_results = qaly_and_cost_per_qaly_diabetes($basic_answers);

        $cost_per_qaly_array[] = $diabetes_results[0];
        $qaly_array[] = $diabetes_results[1];
        $cost_array[] = $diabetes_results[2];
    }

    // Fully Converted
    echo "flu";
    $flu = validate_flu($basic_answers);
    if ($flu) {
        $valid_screening_array[] = $flu;
        // get qaly and $/qaly numbers
        $flu_results = qaly_and_cost_per_qaly_flu($basic_answers);

        $cost_per_qaly_array[] = $flu_results[0];
        $qaly_array[] = $flu_results[1];
        $cost_array[] = $flu_results[2];
    }

    // Fully Converted
    echo "glaucoma";
    $glaucoma = validate_glaucoma($basic_answers);
    if ($glaucoma) {
        $valid_screening_array[] = $glaucoma;
        // get qaly and $/qaly numbers
        $glaucoma_results = qaly_and_cost_per_qaly_glaucoma($basic_answers);

        $cost_per_qaly_array[] = $glaucoma_results[0];
        $qaly_array[] = $glaucoma_results[1];
        $cost_array[] = $glaucoma_results[2];
    }

    // Fully Converted
    echo "hepatitis_c";
    $hepatitis_c = validate_hepatitis_c($basic_answers);
    if ($hepatitis_c) {
        $valid_screening_array[] = $hepatitis_c;
        // get qaly and $/qaly numbers
        $hepatitis_c_results = qaly_and_cost_per_qaly_hepatitis_c($basic_answers);

        $cost_per_qaly_array[] = $hepatitis_c_results[0];
        $qaly_array[] = $hepatitis_c_results[1];
        $cost_array[] = $hepatitis_c_results[2];
    }

    // Fully Converted
    echo "hiv";
    $hiv = validate_hiv($basic_answers, $other_questions);
    if ($hiv) {
        $valid_screening_array[] = $hiv;
        // get qaly and $/qaly numbers
        $hiv_results = qaly_and_cost_per_qaly_hiv($basic_answers);

        $cost_per_qaly_array[] = $hiv_results[0];
        $qaly_array[] = $hiv_results[1];
        $cost_array[] = $hiv_results[2];
    }

    // Fully Converted
    echo "lung_cancer";
    $lung_cancer = validate_lung_cancer($basic_answers);
    if ($lung_cancer) {
        $valid_screening_array[] = $lung_cancer;
        // get qaly and $/qaly numbers
        $lung_cancer_results = qaly_and_cost_per_qaly_lung_cancer($basic_answers);

        $cost_per_qaly_array[] = $lung_cancer_results[0];
        $qaly_array[] = $lung_cancer_results[1];
        $cost_array[] = $lung_cancer_results[2];
    }

    // Fully Converted
    echo "osteoporosis";
    $osteoporosis = validate_osteoporosis($basic_answers);
    if ($osteoporosis) {
        $valid_screening_array[] = $osteoporosis;
        // get qaly and $/qaly numbers
        $osteoporosis_results = qaly_and_cost_per_qaly_osteoporosis($basic_answers);

        $cost_per_qaly_array[] = $osteoporosis_results[0];
        $qaly_array[] = $osteoporosis_results[1];
        $cost_array[] = $osteoporosis_results[2];
    }

    // Fully Converted
    echo "pneumococcal";
    $pneumococcal = validate_pneumococcal($basic_answers);
    if ($pneumococcal) {
        $valid_screening_array[] = $pneumococcal;
        // get qaly and $/qaly numbers
        $pneumococcal_results = qaly_and_cost_per_qaly_pneumococcal($basic_answers);

        $cost_per_qaly_array[] = $pneumococcal_results[0];
        $qaly_array[] = $pneumococcal_results[1];
        $cost_array[] = $pneumococcal_results[2];
    }

    // Fully Converted
    echo "tobacco_cessation";
    $tobacco_cessation = validate_tobacco_cessation($basic_answers);
    if ($tobacco_cessation) {
        $valid_screening_array[] = $tobacco_cessation;
        // get qaly and $/qaly numbers
        $tobacco_cessation_results = qaly_and_cost_per_qaly_tobacco_cessation($basic_answers);

        $cost_per_qaly_array[] = $tobacco_cessation_results[0];
        $qaly_array[] = $tobacco_cessation_results[1];
        $cost_array[] = $tobacco_cessation_results[2];
    }

    return [$valid_screening_array, $cost_per_qaly_array, $qaly_array, $cost_array];
}