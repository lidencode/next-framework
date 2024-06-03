<?php

function pre($obj, $die = false) {
    echo '<pre>';
    var_dump($obj);
    echo '</pre>';

    if ($die) die();
}