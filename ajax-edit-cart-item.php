
<?php
session_start();
$pro_id = $_POST['pro_id'];
$pro_qty = $_POST['qty'];
$pro_desc = $_POST['desc'];
foreach ($_SESSION['cart'] as $key => $value) {
    if ($value["id"] == $pro_id) {
        $_SESSION['cart'][$key]["qty"] = $pro_qty;
        $_SESSION['cart'][$key]["desc"] = $pro_desc;
        echo "1";
        break;
    }
}


               