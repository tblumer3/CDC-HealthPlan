<?php

function fetch($id) {
    // die(json_encode($_ENV['big']));

    if ($_ENV['big'][$id]) {
        return $_ENV['big'][$id];
    } else {
        die(json_encode($id));
    }
}