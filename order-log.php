<?php include_once './includes/checksession.php'; ?>
<?php
if (isset($_POST["btnConfirm"])) {
    include_once './includes/connection.php';
    $con = new MySQL();
    $q = "select o.order_date as o_date,sc.name as sc_name,p.name as name,p.weight as weight,o.product_qty as qty,o.product_desc as descr from tbl_order o inner join tbl_product p on o.product_id=p.id inner join tbl_sub_category sc on p.sub_category_id=sc.id order by o.order_date desc";
    $date = date("d-m-Y");
    $filename = "Order_Log_".$date;
    $result = mysql_query($q);
    $file_ending = "xls";
//header info for browser
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=$filename.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    /*     * *****Start of Formatting for Excel****** */
//define separator (defines columns in excel & tabs in word)
    $sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
    /*for ($i = 0; $i < mysql_num_fields($result); $i++) {
        echo mysql_field_name($result, $i) . "\t";
    }*/
    echo "Order Date\tSub Category Name\tProduct Name\tWeight\tQuantity\tDescription";
    print("\n");
    print("\n");
//end of printing column names  
//start while loop to get data
    while ($row = mysql_fetch_row($result)) {
        $schema_insert = "";
        for ($j = 0; $j < mysql_num_fields($result); $j++) {
            if (!isset($row[$j]))
                $schema_insert .= "NULL" . $sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]" . $sep;
            else
                $schema_insert .= "" . $sep;
        }
        $schema_insert = str_replace($sep . "$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }
    return;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Order History :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/table.css" media="screen"/>
        <script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/pagination-style.css" media="screen"/>
        <script>
            !window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
        </script>
        <script type="text/javascript">
            <!--//---------------------------------+
        //  Developed by Roshan Bhattarai 
            //  Visit http://roshanbh.com.np for this script and more.
            //  This notice MUST stay intact for legal use
            // --------------------------------->
            $(document).ready(function()
            {
                //slides the element with class "menu_body" when paragraph with class "menu_head" is clicked 
                $("#firstpane p.menu_head").click(function()
                {
                    $(this).css({backgroundImage: "url(down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
                    $(this).siblings().css({backgroundImage: "url(left.png)"});
                });
                //slides the element with class "menu_body" when mouse is over the paragraph
                $("#secondpane p.menu_head").mouseover(function()
                {
                    $(this).css({backgroundImage: "url(down.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
                    $(this).siblings().css({backgroundImage: "url(left.png)"});
                });
                $("a[rel=example_group]").fancybox({
                    'transitionIn': 'fade',
                    'transitionOut': 'fade',
                    'titlePosition': 'over',
                    'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
                        return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                    }
                });
            });
        </script>              
    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>
        <!--cart-->   
        <div class="right-content">
            <div class="pro-name">
                <h1>Order / Inquiry History
                    <div style="float:right"><a href="javascript:history.back(-1);">Back</a></div>
                </h1>
                <div class="content" style="background: none">
                    <div class="CSSTableGenerator" id="csstablediv">
                        <form method="post">
                            <table cellpadding="5" border="1" rules="all" style="margin:10px auto;" align="center">
                                <tr class="heading">
                                    <td style="width:130px">Product Name</td>
                                    <td>Weight</td>
                                    <td>Quantity</td>
                                    <td style="width:170px">Description</td>
                                    <td style="width: 100px;">Date</td>
                                    <td style="width: 70px;">Image</td>
                                </tr>                               
                                <?php
                                include_once 'includes/connection.php';
                                $con = new MySQL();
                                $q = "select o.order_date as o_date,sc.name as sc_name,p.name as name,p.weight as weight,o.product_qty as qty,o.product_desc as descr,p.image_path as path from tbl_order o inner join tbl_product p on o.product_id=p.id inner join tbl_sub_category sc on p.sub_category_id=sc.id";
                                $result = mysql_query($q);
                                $records = mysql_num_rows($result);
                                $page_limit = 5;
                                $pagination_stages = 2;
                                $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
                                $current_page = strip_tags($page);
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
                                    $pagination_system .= "<div class='pagination_system' style='margin-right:3px'>";
                                    // Previous Page
                                    if ($current_page > 1) {
                                        $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . $previous_page . "'>Prev</a>";
                                    } else {
                                        $pagination_system.= "<span class='disabled'>Prev</span>";
                                    }
                                    // Pages	
                                    if ($last_page < 7 + ($pagination_stages * 2)) { // Not enough pages to breaking it up
                                        for ($page_counter = 1; $page_counter <= $last_page; $page_counter++) {
                                            if ($page_counter == $current_page) {
                                                $pagination_system.= "<span class='current'>$page_counter</span>";
                                            } else {
                                                $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . $page_counter . "'>$page_counter</a>";
                                            }
                                        }
                                    } elseif ($last_page > 5 + ($pagination_stages * 2)) { // This hides few pages when the displayed pages are much
                                        //Beginning only hide later pages
                                        if ($current_page < 1 + ($pagination_stages * 2)) {
                                            for ($page_counter = 1; $page_counter < 4 + ($pagination_stages * 2); $page_counter++) {
                                                if ($page_counter == $current_page) {
                                                    $pagination_system.= "<span class='current'>$page_counter</span>";
                                                } else {
                                                    $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . $page_counter . "'>$page_counter</a>";
                                                }
                                            }
                                            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
                                            $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . $lastpaged . "'>$lastpaged</a>";
                                            $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . $last_page . "'>$last_page</a>";
                                        }
                                        //Middle hide some front and some back
                                        elseif ($last_page - ($pagination_stages * 2) > $current_page && $current_page > ($pagination_stages * 2)) {
                                            $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=1'>1</a>";
                                            $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=2'>2</a>";
                                            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
                                            for ($page_counter = $current_page - $pagination_stages; $page_counter <= $current_page + $pagination_stages; $page_counter++) {
                                                if ($page_counter == $current_page) {
                                                    $pagination_system.= "<span class='current'>$page_counter</span>";
                                                } else {
                                                    $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . $page_counter . "'>$page_counter</a>";
                                                }
                                            }
                                            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
                                            $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . $lastpaged . "'>$lastpaged</a>";
                                            $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . $last_page . "'>$last_page</a>";
                                        }
                                        //End only hide early pages
                                        else {
                                            $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=1'>1</a>";
                                            $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=2'>2</a>";
                                            $pagination_system.= "<span style=\"color:white;font-weight:bold\">...</span>";
                                            for ($page_counter = $last_page - (2 + ($pagination_stages * 2)); $page_counter <= $last_page; $page_counter++) {
                                                if ($page_counter == $current_page) {
                                                    $pagination_system.= "<span class='current'>$page_counter</span>";
                                                } else {
                                                    $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . $page_counter . "'>$page_counter</a>";
                                                }
                                            }
                                        }
                                    }
                                    //Next Page
                                    if ($current_page < $page_counter - 1) {
                                        $pagination_system.= "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . $next_page . "'>Next</a>";
                                    } else {
                                        $pagination_system.= "<span class='disabled'>Next</span>";
                                    }
                                    $pagination_system.= "</div>";
                                }
                                $q_cat = $q . " order by o.id desc,o.order_date desc limit " . $start_page . "," . $page_limit;
                                $result = mysql_query($q_cat);

                                if (mysql_num_rows($result) > 0) {
                                    while ($r = mysql_fetch_array($result)) {
                                        ?>
                                        <tr>
                                            <td align="center"><?php echo $r["name"]; ?></td>
                                            <td align="center"><?php echo $r["weight"]; ?></td>
                                            <td align="center"><?php echo ($r['qty']) == 0 ? "<span style='color:gray'>---</span>" : ($r['qty']); ?></td>
                                            <td align="center"><?php echo trim($r['descr']) == "" ? "<i style='color:gray'>Not Provided</i>" : trim($r['descr']); ?></td>
                                            <td align="center"><?php echo date('d-m-Y', strtotime($r["o_date"])); ?></td>
                                            <td align="center">
                                                <a rel="example_group" href="manager/uploads/original/<?php echo $r["sc_name"]; ?>/<?php echo $r['path']; ?>" title="">
                                                    <img src="manager/uploads/thumbs/<?php echo $r["sc_name"]; ?>/<?php echo $r['path']; ?>" width="80" height="80" alt="" />
                                                </a>
                                                <!--<img width="80" height="80" src="<?php echo "manager/uploads/thumbs/" . $r["sc_name"] . "/" . $r["path"] ?>" />-->
                                            </td>                                        
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" align="center">
                                            No products found in your order.
                                        </td>
                                    </tr>       
                                    <?php
                                }
                                ?>                               
                                <tr style="background: #decefd">
                                    <td colspan="6">
                                        <div align="center" style="text-align: center;">                     
                                            <input value="Export to Excel" type="submit" name="btnConfirm" id="btnConfirm" />                        
                                        </div> 
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="clear"></div>
                    <div style="" align="left"><?php echo $pagination_system; ?></div></br>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <!--endo-of-cart-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
