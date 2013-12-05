<?php
include_once 'includes/connection.php';
$con = new MySQL();
$cat_id = $_POST["cat_id"];
$q = "SELECT c.id as 'c_id',c.name as 'c_name',sc.id as 'sub_id',sc.name as 'sub_name',pro.name as 'pro_name',pro.image_path as 'path' FROM tbl_category c inner join tbl_sub_category sc on c.id=sc.category_id inner join tbl_product pro on sc.id = pro.sub_category_id where c.id=" . $cat_id . " group by sub_name";
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
        $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"$previous_page\",\"$cat_id\");'>Prev</a>";
    } else {
        $pagination_system.= "<span class='disabled'>Prev</span>";
    }
    // Pages	
    if ($last_page < 7 + ($pagination_stages * 2)) { // Not enough pages to breaking it up
        for ($page_counter = 1; $page_counter <= $last_page; $page_counter++) {
            if ($page_counter == $current_page) {
                $pagination_system.= "<span class='current'>$page_counter</span>";
            } else {
                $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"$page_counter\",\"$cat_id\");'>$page_counter</a>";
            }
        }
    } elseif ($last_page > 5 + ($pagination_stages * 2)) { // This hides few pages when the displayed pages are much
        //Beginning only hide later pages
        if ($current_page < 1 + ($pagination_stages * 2)) {
            for ($page_counter = 1; $page_counter < 4 + ($pagination_stages * 2); $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"$page_counter\",\"$cat_id\");'>$page_counter</a>";
                }
            }
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"$lastpaged\",\"$cat_id\");'>$lastpaged</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"$last_page\",\"$cat_id\");'>$last_page</a>";
        }
        //Middle hide some front and some back
        elseif ($last_page - ($pagination_stages * 2) > $current_page && $current_page > ($pagination_stages * 2)) {
            $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"1\",\"$cat_id\");'>1</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"2\",\"$cat_id\");'>2</a>";
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            for ($page_counter = $current_page - $pagination_stages; $page_counter <= $current_page + $pagination_stages; $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"$page_counter\",\"$cat_id\");'>$page_counter</a>";
                }
            }
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"$lastpaged\",\"$cat_id\");'>$lastpaged</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"$last_page\",\"$cat_id\");'>$last_page</a>";
        }
        //End only hide early pages
        else {
            $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"1\",\"$cat_id\");'>1</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"2\",\"$cat_id\");'>2</a>";
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            for ($page_counter = $last_page - (2 + ($pagination_stages * 2)); $page_counter <= $last_page; $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"$page_counter\",\"$cat_id\");'>$page_counter</a>";
                }
            }
        }
    }
    //Next Page
    if ($current_page < $page_counter - 1) {
        $pagination_system.= "<a href='javascript:void(0);' onclick='getSubCategory(\"$next_page\",\"$cat_id\");'>Next</a>";
    } else {
        $pagination_system.= "<span class='disabled'>Next</span>";
    }
    $pagination_system.= "</div>";
}
$q_cat = $q . " order by sc.id desc limit " . $start_page . "," . $page_limit;
$rs = mysql_query($q_cat);
$records = mysql_num_rows($rs);

if ($records > 0) {
    while ($r = mysql_fetch_array($rs)) {
        ?>
        <div class="category-thumb">
            <div class="pro-heading"><h1 class="center"><?php echo $r["sub_name"] ?></h1></div>
            <div class="pro-img"><a href="gallery.php?q=<?php echo $r["sub_id"]; ?>" title=""><img src="manager/uploads/thumbs/<?php echo $r["sub_name"] ?>/<?php echo $r ["path"] ?>" width="180" height="160" alt="" /></a></div>
        </div>
        <?php
    }
    ?>
    <div class="clear"></div>
    <div style="" align="left"><?php echo $pagination_system; ?></div>
    <div class="clear"></div>
    <br/>
    <?php
} else {
    ?>
    <div class="clear"></div>
    <div class="custom-message">
        <?php
        echo "No sub categories found";
        ?>
    </div>
<?php }
?>
