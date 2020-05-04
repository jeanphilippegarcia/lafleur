<?php

function dbg($x) {
    echo '<pre>';
        var_dump($x);
    echo '<pre>';
    echo'<hr>';
}

// rendre anonyme la fonction de debuggage
global $msg;
$msg = function ($x) {
    echo '<pre>';
        var_dump($x);
    echo '<pre>';
    echo'<hr>';
};