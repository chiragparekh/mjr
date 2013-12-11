
<?php
session_start();
$pro_id = $_POST['pro_id'];
foreach ($_SESSION['cart'] as $key => $value) {
    if ($value["id"] == $pro_id) {
        echo json_encode(array(
            'qty' => $_SESSION['cart'][$key]["qty"],
            'desc' => $_SESSION['cart'][$key]["desc"]
        ));
        break;
    }
}


               