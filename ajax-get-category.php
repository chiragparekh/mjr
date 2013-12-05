<?php
include_once 'includes/connection.php';
$con = new MySQL();
$q_cat = "SELECT c.id as 'c_id',c.name as 'c_name',pro.image_path as 'path',sc.name as 'sub_name' FROM tbl_category c inner join tbl_sub_category sc on c.id=sc.category_id inner join tbl_product pro on sc.id = pro.sub_category_id group by c_name";
$result_category = mysql_query($q_cat);
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
        $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"$previous_page\");'>Prev</a>";
    } else {
        $pagination_system.= "<span class='disabled'>Prev</span>";
    }
    // Pages	
    if ($last_page < 7 + ($pagination_stages * 2)) { // Not enough pages to breaking it up
        for ($page_counter = 1; $page_counter <= $last_page; $page_counter++) {
            if ($page_counter == $current_page) {
                $pagination_system.= "<span class='current'>$page_counter</span>";
            } else {
                $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"$page_counter\");'>$page_counter</a>";
            }
        }
    } elseif ($last_page > 5 + ($pagination_stages * 2)) { // This hides few pages when the displayed pages are much
        //Beginning only hide later pages
        if ($current_page < 1 + ($pagination_stages * 2)) {
            for ($page_counter = 1; $page_counter < 4 + ($pagination_stages * 2); $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"$page_counter\");'>$page_counter</a>";
                }
            }
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"$lastpaged\");'>$lastpaged</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"$last_page\");'>$last_page</a>";
        }
        //Middle hide some front and some back
        elseif ($last_page - ($pagination_stages * 2) > $current_page && $current_page > ($pagination_stages * 2)) {
            $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"1\");'>1</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"2\");'>2</a>";
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            for ($page_counter = $current_page - $pagination_stages; $page_counter <= $current_page + $pagination_stages; $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"$page_counter\");'>$page_counter</a>";
                }
            }
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"$lastpaged\");'>$lastpaged</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"$last_page\");'>$last_page</a>";
        }
        //End only hide early pages
        else {
            $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"1\");'>1</a>";
            $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"2\");'>2</a>";
            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
            for ($page_counter = $last_page - (2 + ($pagination_stages * 2)); $page_counter <= $last_page; $page_counter++) {
                if ($page_counter == $current_page) {
                    $pagination_system.= "<span class='current'>$page_counter</span>";
                } else {
                    $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"$page_counter\");'>$page_counter</a>";
                }
            }
        }
    }
    //Next Page
    if ($current_page < $page_counter - 1) {
        $pagination_system.= "<a href='javascript:void(0);' onclick='getCategory(\"$next_page\");'>Next</a>";
    } else {
        $pagination_system.= "<span class='disabled'>Next</span>";
    }
    $pagination_system.= "</div>";
}
$q_cat = $q_cat . " order by c.id desc limit " . $start_page . "," . $page_limit;
$rs = mysql_query($q_cat);
$records = mysql_num_rows($rs);
if ($records > 0) {
    while ($rc = mysql_fetch_array($rs)) {
        ?>
        <div class="category-thumb">
            <div class="pro-heading"><h1 class="center"><?php echo ucwords($rc["c_name"]); ?></h1></div>
            <div class="pro-img"><a href="sub-category.php?q=<?php echo $rc["c_id"] ?>" title=""><img src="manager/uploads/thumbs/<?php echo $rc["sub_name"]; ?>/<?php echo $rc["path"]; ?>" width="180" height="160" alt="" /></a></div>
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
        echo "No categories found";
        ?>
    </div>
    <?php
}
?>