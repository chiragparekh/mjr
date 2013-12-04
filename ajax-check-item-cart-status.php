<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$pro_id = $_POST["pro_id"];
if (!isset($_SESSION['cart'])) {
    echo "not-in-cart";
} else {
    if (!in_array_r($pro_id, $_SESSION['cart'])) {
        echo "not-in-cart";
    } else {
        echo "already-in-cart";
    }
}

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}

?>