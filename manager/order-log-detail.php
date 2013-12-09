<?php
if (!isset($_GET['q']) || $_GET['q'] == "") {
    header("location:order-log.php");
}
?>
<?php include_once "includes/checksession.php"; ?>
<?php
include_once "includes/message.php";
$msg = new Message();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <title>User Order Detail</title>

        <?php include_once "includes/common-css-js.php"; ?>

        <style type="text/css">
            .wordwrap
            {
                /* wrap long text and urls */
                white-space: pre; /* CSS 2.0 */
                white-space: pre-wrap; /* CSS 2.1 */
                white-space: pre-line; /* CSS 3.0 */
                white-space: -pre-wrap; /* Opera 4-6 */
                white-space: -o-pre-wrap; /* Opera 7 */
                white-space: -moz-pre-wrap; /* Mozilla */
                word-wrap: break-word; /* IE 5+ */
                left:2px;
                width:86px;
            }
            #user{
                background-position: 0 -86px;
                border-top: 1px solid #657D92;}
            td{
                text-align: center;
            }
        </style>            
        <script type="text/javascript">
            <!--//---------------------------------+
   //  Developed by Roshan Bhattarai 
            //  Visit http://roshanbh.com.np for this script and more.
            //  This notice MUST stay intact for legal use
            // --------------------------------->
            $(document).ready(function()
            {
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

        <?php include_once "includes/leftside.php"; ?>



        <?php include_once "includes/rightside.php"; ?>    
        <!-- Title area -->
        <div class="titleArea">
            <div class="wrapper">
                <div class="pageTitle">
                    <h5>User Order Detail</h5>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="line"></div>

        <!-- Main content wrapper -->
        <div class="wrapper">
            <br />
            <?php
            if (isset($_GET['q'])) {
                ?>                
                <div class="widget" style="margin-top:20px;">
                    <div class="title"><h6>User Order Detail</h6></div>
                    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable withCheck mTable">
                            <thead>
                                <tr>                                    
                                    <td  style="width: 20%" class="sortCol">Product Name</td>
                                    <td style="width: 15%" align="center"  class="sortCol">Weight</td>
                                    <td style="width: 15%;text-align: center" align="center"  class="sortCol">Quantity</td>
                                    <td style="width: 20%" align="center"  class="sortCol">Description</td>
                                    <td style="width: 15%" align="center" class="sortCol">Date</td>
                                    <td style="width: 10%;" align="center">Image</td>                                   
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <div style="float: left;" class="formSubmit">
                                            <a style="margin-left: 10px;" class="button blueB" title="" href="javascript:history.back(-1)">                                                
                                                <span>Back</span>
                                            </a>                                            
                                        </div>                                        
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                include_once "includes/connection.php";
                                $con = new MySQL();

                                //$tbl_name = "tbl_user";
                                $adjacents = 3;
                                //$query = "SELECT COUNT(*) as num FROM $tbl_name where type like 'user'";
                                $query = "select COUNT(*) as num from tbl_order o inner join tbl_product p on o.product_id=p.id inner join tbl_sub_category sc on p.sub_category_id=sc.id where o.user_id=" . $_GET['q'] . " ";
                                $total_pages = mysql_fetch_array(mysql_query($query));
                                $totalcount = $total_pages;
                                $total_pages = $total_pages['num'];

                                $targetpage = "order-log-detail.php";
                                $limit = 10;         //how many items to show per page
                                $page = isset($_GET['page']) ? $_GET['page'] : null;
                                if ($page)
                                    $start = ($page - 1) * $limit;    //first item to display on this page
                                else
                                    $start = 0;

                                //$sql = "select * from $tbl_name where type like 'user' order by id desc LIMIT $start, $limit";
                                $sql = "select  o.order_date as o_date,sc.name as sc_name,p.name as name,p.weight as weight,o.product_qty as qty,o.product_desc as descr,p.image_path as path  from tbl_order o inner join tbl_product p on o.product_id=p.id inner join tbl_sub_category sc on p.sub_category_id=sc.id where o.user_id=" . $_GET['q'] . " order by o.id desc,o.order_date desc limit  $start, $limit";
                                $result = mysql_query($sql);

                                if ($page == 0)
                                    $page = 1;     //if no page var is given, default to 1.
                                $prev = $page - 1;       //previous page is page - 1
                                $next = $page + 1;       //next page is page + 1
                                $lastpage = ceil($total_pages / $limit);  //lastpage is = total pages / items per page, rounded up.
                                $lpm1 = $lastpage - 1;      //last page minus 1

                                $pagination = "";
                                if ($lastpage > 1) {
                                    $pagination .= "<div style=\"margin-top:0px\" class=\"pagination\"><ul class=\"pages\">";
                                    //previous button
                                    if ($page > 1)
                                    //$pagination.= "<li class=\"prev\"><a href=\"$targetpage?q=$_GET['q']page=$prev\"><</a></li>";
                                        $pagination.= "<li class=\"prev\"><a href=\"$targetpage?q=" . $_GET['q'] . "&page=$prev\">Previous</a></li>";
                                    else
                                    //$pagination.= "<span class=\"disabled\"><< Previous</span>";
                                    //$pagination.= "<li class=\"prev\"><a href=\"#\"><</a></li>";
                                        $pagination.= "<li class=\"prev fg-button ui-button ui-state-disabled\">Previous</li>";


                                    //pages	
                                    if ($lastpage < 7 + ($adjacents * 2)) { //not enough pages to bother breaking it up
                                        for ($counter = 1; $counter <= $lastpage; $counter++) {
                                            if ($counter == $page)
                                            //$pagination.= "<span class=\"current\">$counter</span>";
                                                $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                                            else
                                            //$pagination.= "<a href=\"$targetpage?q=".$_GET['q']."&page=$counter\">$counter</a>";
                                                $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=$counter\">$counter</a></li>";
                                        }
                                    }
                                    elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
                                        //close to beginning; only hide later pages
                                        if ($page < 1 + ($adjacents * 2)) {
                                            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                                                if ($counter == $page)
                                                    $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                                                else
                                                    $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=$counter\">$counter</a></li>";
                                            }
                                            $pagination.= "...";
                                            $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=$lpm1\">$lpm1</a></li>";
                                            $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=$lastpage\">$lastpage</a></li>";
                                        }
                                        //in middle; hide some front and some back
                                        elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                                            $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=1\">1</a></li>";
                                            $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=2\">2</a></li>";
                                            $pagination.= "...";
                                            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                                                if ($counter == $page)
                                                    $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                                                else
                                                    $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=$counter\">$counter</a></li>";
                                            }
                                            $pagination.= "...";
                                            $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=$lpm1\">$lpm1</a></li>";
                                            $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=$lastpage\">$lastpage</a></li>";
                                        }
                                        //close to end; only hide early pages
                                        else {
                                            $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=1\">1</a></li>";
                                            $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=2\">2</a></li>";
                                            $pagination.= "...";
                                            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                                                if ($counter == $page)
                                                    $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                                                else
                                                    $pagination.= "<li><a href=\"$targetpage?q=" . $_GET['q'] . "&page=$counter\">$counter</a></li>";
                                            }
                                        }
                                    }

                                    //next button
                                    if ($page < $counter - 1)
                                        $pagination.= "<li class=\"next\"><a href=\"$targetpage?q=" . $_GET['q'] . "&page=$next\">Next</a></li>";
                                    else
                                        $pagination.= "<li class=\"next fg-button ui-button ui-state-disabled\">Next</li>";
                                    $pagination.= "</ul></div>\n";
                                }
                                ?>       
                                <?php
                                if (mysql_num_rows($result) > 0) {
                                    while ($r = mysql_fetch_array($result)) {
                                        ?>
                                        <tr>                                            
                                            <td style="text-align: left">
                                                <?php echo $r['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $r['weight']; ?>
                                            </td>
                                            <td>
                                                <?php echo ($r['qty']) == 0 ? "<span style='color:gray'>---</span>" : ($r['qty']); ?>
                                            </td>
                                            <td>
                                                <?php echo trim($r['descr']) == "" ? "<i style='color:gray'>Not Provided</i>" : trim($r['descr']); ?>
                                            </td>                                           
                                            <td>
                                                <?php echo date('d-m-Y', strtotime($r["o_date"])); ?>
                                            </td>
                                            <td>
                                                <a rel="lightbox" title="" href="uploads/original/<?php echo $r["sc_name"] . "/" . $r["path"]; ?>">
                                                    <img style="height: 60px;width: 60px;border:2px solid #cecece" alt="" src="uploads/thumbs/<?php echo $r["sc_name"] . "/" . $r["path"]; ?>" />
                                                </a>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6">
                                            <?php
                                            $msg->information("No order found for this user.");
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                $con->CloseConnection();
                                ?>        
                            </tbody>
                        </table>
                        <div>
                            <?php echo $pagination; ?> 
                        </div>
                    </form>
                </div>
                <?php
            }
            ?>
        </div>

        <?php include_once "includes/footer.php"; ?>   

    </body>
</html>