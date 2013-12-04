<?php
include_once './includes/connection.php';
$con = new MySQL();
$minWeight = $_POST["minweight"];
$maxWeight = $_POST["maxweight"];
$category = $_POST["category"];
$subcategory = $_POST["subcategory"];

$q = "select p.name as name,p.id as pid,p.image_path as image_path,sc.id as sub_cat_id,sc.name as sub_cat_name from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where 1=1";
if ($minWeight != "-1") {
    $q.=" and p.weight >= $minWeight";
}
if ($maxWeight != "-1") {
    $q.=" and p.weight <= $maxWeight";
}
if ($category != "-1") {
    $q.=" and sc.category_id = $category";
}
if ($subcategory != "-1") {
    $q.=" and p.sub_category_id = $subcategory";
}
$rs = mysql_query($q);
$records = mysql_num_rows($rs);


$page_limit=9;
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
        $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"$previous_page\");'>Prev</a>";
    } else {
        $pagination_system.= "<span class='disabled'>Prev</span>";
    }
    // Pages	
    if ($last_page < 7 + ($pagination_stages * 2)) { // Not enough pages to breaking it up
        for ($page_counter = 1; $page_counter <= $last_page; $page_counter++) {
            if ($page_counter == $current_page) {
                $pagination_system.= "<span class='current'>$page_counter</span>";
            } else {
                $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"$page_counter\");'>$page_counter</a>";
            }
        }
    } elseif ($last_page > 5 + ($pagination_stages * 2)) { // This hides few pages when the displayed pages are much
        //Beginning only hide later pages
        if ($current_page < 1 + ($pagination_stages * 2)) {
            for ($page_counter = 1; $page_counter < 4 + ($pagination_stages * 2); $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"$page_counter\");'>$page_counter</a>";
                }
            }
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"$lastpaged\");'>$lastpaged</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"$last_page\");'>$last_page</a>";
        }
        //Middle hide some front and some back
        elseif ($last_page - ($pagination_stages * 2) > $current_page && $current_page > ($pagination_stages * 2)) {
            $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"1\");'>1</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"2\");'>2</a>";
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            for ($page_counter = $current_page - $pagination_stages; $page_counter <= $current_page + $pagination_stages; $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"$page_counter\");'>$page_counter</a>";
                }
            }
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"$lastpaged\");'>$lastpaged</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"$last_page\");'>$last_page</a>";
        }
        //End only hide early pages
        else {
            $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"1\");'>1</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"2\");'>2</a>";
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            for ($page_counter = $last_page - (2 + ($pagination_stages * 2)); $page_counter <= $last_page; $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"$page_counter\");'>$page_counter</a>";
                }
            }
        }
    }
    //Next Page
    if ($current_page < $page_counter - 1) {
        $pagination_system.= "<a href='javascript:void(0);' onclick='searchProduct(\"$next_page\");'>Next</a>";
    } else {
        $pagination_system.= "<span class='disabled'>Next</span>";
    }
    $pagination_system.= "</div>";
}

$rs = mysql_query($q . " order by pid desc limit $start_page,$page_limit");
$records = mysql_num_rows($rs);
if ($records > 0) {
    while ($row = mysql_fetch_array($rs)) {
        ?>
        <div class="product">
            <div class="pro-heading"><h1 class="center"><?php echo ucwords($row['name']); ?></h1></div>
            <div class="pro-img"><a rel="example_group" href="manager/uploads/original/<?php echo $row["sub_cat_name"]; ?>/<?php echo $row["image_path"]; ?>" title=""><img src="manager/uploads/thumbs/<?php echo $row["sub_cat_name"]; ?>/<?php echo $row["image_path"]; ?>" width="180" height="160" alt="" /></a></div>
            <div class="pro-detail"><a href="product.php?q=<?php echo $row["pid"] ?>">View Detail</a><a href="product.php">Add to Cart</a></div>
        </div>
        <?php
    }
    ?>
    <br/>
    <div style="" align="left"><?php echo $pagination_system; ?></div>
    <br/>
    <?php
} else {
    ?>
    <div style="color: white;text-align: center;font-weight: bold;font-size: large">No Products Found</div>
    <?php
}
$con->CloseConnection();
?>