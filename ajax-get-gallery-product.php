<?php
include_once 'includes/connection.php';
session_start();
$con = new MySQL();
$sub_cat_id = $_POST["sub_id"];
$q = "select sub.name as 'sub_name',p.image_path as 'path',p.name as 'pro_name',p.id as 'pro_id' from tbl_product p inner join tbl_sub_category sub on p.sub_category_id=sub.id where sub_category_id=" . $sub_cat_id;
$result_category = mysql_query($q);
$records = mysql_num_rows($result_category);

$page_limit = 6;
$pagination_stages = 2;
$current_page = strip_tags($_POST['page']);
$start_page = ($current_page - 1) * $page_limit;


//This initializes the page setup
if ($current_page == 0) {
    $current_page = 1;
}
$previous_page = $current_page - 1;
$next_page = $current_page + 1;
$last_page = ceil($records / $page_limit);
$lastpaged = $last_page - 1;
$pagination_system = '';
if ($last_page > 1) {
    $pagination_system .= "<div class='pagination_system'>";
    // Previous Page
    if ($current_page > 1) {
        $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"$previous_page\",\"$sub_cat_id\");'>Prev</a>";
    } else {
        $pagination_system.= "<span class='disabled'>Prev</span>";
    }
    // Pages	
    if ($last_page < 7 + ($pagination_stages * 2)) { // Not enough pages to breaking it up
        for ($page_counter = 1; $page_counter <= $last_page; $page_counter++) {
            if ($page_counter == $current_page) {
                $pagination_system.= "<span class='current'>$page_counter</span>";
            } else {
                $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"$page_counter\",\"$sub_cat_id\");'>$page_counter</a>";
            }
        }
    } elseif ($last_page > 5 + ($pagination_stages * 2)) { // This hides few pages when the displayed pages are much
        //Beginning only hide later pages
        if ($current_page < 1 + ($pagination_stages * 2)) {
            for ($page_counter = 1; $page_counter < 4 + ($pagination_stages * 2); $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"$page_counter\",\"$sub_cat_id\");'>$page_counter</a>";
                }
            }
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"$lastpaged\",\"$sub_cat_id\");'>$lastpaged</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"$last_page\",\"$sub_cat_id\");'>$last_page</a>";
        }
        //Middle hide some front and some back
        elseif ($last_page - ($pagination_stages * 2) > $current_page && $current_page > ($pagination_stages * 2)) {
            $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"1\",\"$sub_cat_id\");'>1</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"2\",\"$sub_cat_id\");'>2</a>";
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            for ($page_counter = $current_page - $pagination_stages; $page_counter <= $current_page + $pagination_stages; $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"$page_counter\",\"$sub_cat_id\");'>$page_counter</a>";
                }
            }
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"$lastpaged\",\"$sub_cat_id\");'>$lastpaged</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"$last_page\",\"$sub_cat_id\");'>$last_page</a>";
        }
        //End only hide early pages
        else {
            $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"1\",\"$sub_cat_id\");'>1</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"2\",\"$sub_cat_id\");'>2</a>";
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            for ($page_counter = $last_page - (2 + ($pagination_stages * 2)); $page_counter <= $last_page; $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"$page_counter\",\"$sub_cat_id\");'>$page_counter</a>";
                }
            }
        }
    }
    //Next Page
    if ($current_page < $page_counter - 1) {
        $pagination_system.= "<a href='javascript:void(0);' onclick='getProduct(\"$next_page\",\"$sub_cat_id\");'>Next</a>";
    } else {
        $pagination_system.= "<span class='disabled'>Next</span>";
    }
    $pagination_system.= "</div>";
}
$q_cat = $q . " order by p.id desc limit " . $start_page . "," . $page_limit;
$rs = mysql_query($q_cat);
$records = mysql_num_rows($rs);


while ($r = mysql_fetch_array($rs)) {
    ?>
    <div class="product">
        <div class="pro-heading"><h1 class="center"><?php echo ucwords($r["pro_name"]); ?></h1></div>
        <div class="pro-img"><a rel="example_group" href="manager/uploads/original/<?php echo $r["sub_name"]; ?>/<?php echo $r['path']; ?>" title=""><img src="manager/uploads/thumbs/<?php echo $r["sub_name"]; ?>/<?php echo $r['path']; ?>" width="180" height="160" alt="" /></a></div>
        <div class="pro-detail">
            <a href="product.php?q=<?php echo $r["pro_id"] ?>">View Detail</a>
            <?php
            if (!isset($_SESSION['cart'])) {
                ?>
                <a class="add-to-cart-link" id="add-to-cart-link-<?php echo $r["pro_id"] ?>" href="#<?php echo $r["pro_id"] ?>">Add to Cart</a>
                <?php
            } else {
                if (!in_array_r($r['pro_id'], $_SESSION['cart'])) {
                    ?>
                    <a class="add-to-cart-link" id="add-to-cart-link-<?php echo $r["pro_id"] ?>" href="#<?php echo $r["pro_id"] ?>">Add to Cart</a>
                    <?php
                } else {
                    ?>
                    <a id="add-to-cart-link-<?php echo $r["pro_id"] ?>" href="javascript:void(0)" style="color:#d8c6ff;font-weight:bold">Item added</a>
                    <?php
                }
            }
            ?>            
        </div>
    </div>
    <?php
}
?>
<div class="clear"></div>
<div style="" align="left"><?php echo $pagination_system; ?></div>
<div class="clear"></div>
<br/>
<?php

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }
    return false;
}
?>