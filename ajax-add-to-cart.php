<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$pro_id = $_POST["pro_id"];
$qty = $_POST["qty"];
$desc = $_POST["desc"];
/*
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
  } */


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (!in_array_r($pro_id, $_SESSION['cart'])) {
    array_push($_SESSION['cart'], array(
        'id' => $pro_id,
        'qty' => $qty,
        'desc' => $desc
    ));
    echo "added";
} else {
    echo "already-added";
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