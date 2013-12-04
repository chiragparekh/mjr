<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$pro_id = $_POST["pro_id"];
if (!isset($_SESSION["cart"])) {
    $items = array($pro_id);
    $_SESSION["cart"] = $items;
    echo "added";
} else {
    $items = $_SESSION["cart"];
    if (in_array($pro_id, $items)) {
        echo "already-added";
    } else {
        array_push($items, $pro_id);
        $_SESSION["cart"] = $items;
        echo "added";
    }    
}
?>