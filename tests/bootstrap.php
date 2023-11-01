<?php

require_once __DIR__ . '/../vendor/autoload.php';

echo "AVANT LES TESTS";

register_shutdown_function(function() {
    echo "APRES LES TESTS";
});