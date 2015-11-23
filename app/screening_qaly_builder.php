<?php

//TBD - make sure all the screenings are included
require_once __DIR__ . '/Screenings/aaa.php';
require_once __DIR__ . '/Screenings/alcohol_misuse.php';
require_once __DIR__ . '/Screenings/aspirin.php';
require_once __DIR__ . '/Screenings/cholesterol.php';
require_once __DIR__ . '/Screenings/colorectal.php';
require_once __DIR__ . '/Screenings/depression.php';
require_once __DIR__ . '/Screenings/flu.php';
require_once __DIR__ . '/Screenings/glaucoma.php';
require_once __DIR__ . '/Screenings/lung_cancer.php';
require_once __DIR__ . '/Screenings/osteoporosis.php';
require_once __DIR__ . '/Screenings/tobacco_cessation.php';

//TBD
// only pass in "basic" answers. If you need the prior medical stuff, add a second input
function screening_qaly_builder ($basic_info, $prior_immunizations, $prior_screenings, $prior_diagnosis) {
    $valid_screening_array = [];
    $cost_per_qaly_array = [];
    $qaly_array = [];
    $cost_array = [];

    echo "aaa";
    $aaa = validate_aaa($answers);
    if ($aaa) {
        $valid_screening_array[] = $aaa;
        // get qaly and $/qaly numbers
        $aaa_results = qaly_and_cost_per_qaly_aaa($answers);

        $cost_per_qaly_array[] = $aaa_results[0];
        $qaly_array[] = $aaa_results[1];
        $cost_array[] = $aaa_results[2];
    }

    echo "alcohol";
    $alcohol_misuse = validate_alcohol_misuse($answers);
    if ($alcohol_misuse) {
        $valid_screening_array[] = $alcohol_misuse;
        // get qaly and $/qaly numbers
        $alcohol_misuse_results = qaly_and_cost_per_qaly_alcohol_misuse($answers);

        $cost_per_qaly_array[] = $alcohol_misuse_results[0];
        $qaly_array[] = $alcohol_misuse_results[1];
        $cost_array[] = $alcohol_misuse_results[2];
    }

    echo "asprin";
    $aspirin = validate_aspirin($answers);
    if ($aspirin) {
        $valid_screening_array[] = $aspirin;
        // get qaly and $/qaly numbers
        $aspirin_results = qaly_and_cost_per_qaly_aspirin($answers);

        $cost_per_qaly_array[] = $aspirin_results[0];
        $qaly_array[] = $aspirin_results[1];
        $cost_array[] = $aspirin_results[2];
    }

    echo "cholesterol";
    $cholesterol = validate_cholesterol($answers);
    if ($cholesterol) {
        $valid_screening_array[] = $cholesterol;
        // get qaly and $/qaly numbers
        $cholesterol_results = qaly_and_cost_per_qaly_cholesterol($answers);

        $cost_per_qaly_array[] = $cholesterol_results[0];
        $qaly_array[] = $cholesterol_results[1];
        $cost_array[] = $cholesterol_results[2];
    }

    echo "colorectal";
    $colorectal = validate_colorectal($answers);
    if ($colorectal) {
        $valid_screening_array[] = $colorectal;
        // get qaly and $/qaly numbers
        $colorectal_results = qaly_and_cost_per_qaly_colorectal($answers);

        $cost_per_qaly_array[] = $colorectal_results[0];
        $qaly_array[] = $colorectal_results[1];
        $cost_array[] = $colorectal_results[2];
    }

    echo "flu";
    $flu = validate_flu($answers);
    if ($flu) {
        $valid_screening_array[] = $flu;
        // get qaly and $/qaly numbers
        $flu_results = qaly_and_cost_per_qaly_flu($answers);

        $cost_per_qaly_array[] = $flu_results[0];
        $qaly_array[] = $flu_results[1];
        $cost_array[] = $flu_results[2];
    }

    echo "depression";
    $depression = validate_depression($answers);
    if ($depression) {
        $valid_screening_array[] = $depression;
        // get qaly and $/qaly numbers
        $depression_results = qaly_and_cost_per_qaly_depression($answers);

        $cost_per_qaly_array[] = $depression_results[0];
        $qaly_array[] = $depression_results[1];
        $cost_array[] = $depression_results[2];
    }

    echo "glaucoma";
    $glaucoma = validate_glaucoma($answers);
    if ($glaucoma) {
        $valid_screening_array[] = $glaucoma;
        // get qaly and $/qaly numbers
        $glaucoma_results = qaly_and_cost_per_qaly_glaucoma($answers);

        $cost_per_qaly_array[] = $glaucoma_results[0];
        $qaly_array[] = $glaucoma_results[1];
        $cost_array[] = $glaucoma_results[2];
    }

    echo "lung_cancer";
    $lung_cancer = validate_lung_cancer($answers);
    if ($lung_cancer) {
        $valid_screening_array[] = $lung_cancer;
        // get qaly and $/qaly numbers
        $lung_cancer_results = qaly_and_cost_per_qaly_lung_cancer($answers);

        $cost_per_qaly_array[] = $lung_cancer_results[0];
        $qaly_array[] = $lung_cancer_results[1];
        $cost_array[] = $lung_cancer_results[2];
    }

    echo "osteoporosis";
    $osteoporosis = validate_osteoporosis($answers);
    if ($osteoporosis) {
        $valid_screening_array[] = $osteoporosis;
        // get qaly and $/qaly numbers
        $osteoporosis_results = qaly_and_cost_per_qaly_osteoporosis($answers);

        $cost_per_qaly_array[] = $osteoporosis_results[0];
        $qaly_array[] = $osteoporosis_results[1];
        $cost_array[] = $osteoporosis_results[2];
    }

    echo "tobacco_cessation";
    $tobacco_cessation = validate_tobacco_cessation($answers);
    if ($tobacco_cessation) {
        $valid_screening_array[] = $tobacco_cessation;
        // get qaly and $/qaly numbers
        $tobacco_cessation_results = qaly_and_cost_per_qaly_tobacco_cessation($answers);

        $cost_per_qaly_array[] = $tobacco_cessation_results[0];
        $qaly_array[] = $tobacco_cessation_results[1];
        $cost_array[] = $tobacco_cessation_results[2];
    }

    return [$valid_screening_array, $cost_per_qaly_array, $qaly_array];
}