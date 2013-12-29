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
        <title>Order Log</title>

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
            </style>

        </head>

        <body>

            <?php include_once "includes/leftside.php"; ?>



            <?php include_once "includes/rightside.php"; ?>    
            <!-- Title area -->
            <div class="titleArea">
            <div class="wrapper">
                <div class="pageTitle">
                    <h5>Order Log</h5>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="line"></div>

        <!-- Main content wrapper -->
        <div class="wrapper">
            <br />
            <!--
    <a style="margin: 5px;" class="button blueB" title="" href="add-new-latest-news.php">
                <img class="icon" alt="" src="images/icons/light/add.png" />
                <span>Add New</span>
            </a>
            -->
            <?php
            include_once("includes/checksession.php");
            if (isset($_POST['btnDelete'])) {
                $ids = $_POST['checkRow'];
                if (count($ids) > 0) {
                    include_once("includes/connection.php");
                    $qid = "";
                    foreach ($ids as $id) {
                        $qid.=$id . ",";
                    }
                    $qid = substr($qid, 0, strlen($qid) - 1);
                    $con = new MySQL();
                    if (mysql_query("delete from tbl_user where type like 'user' and id in(" . $qid . ")")) {
                        $msg->success("Selected users deleted successfully");
                    } else {
                        $msg->error("We are unable to delete selected users. Please try again.");
                    }
                    $con->CloseConnection();
                } else {
                    $msg->warning("Select at least one user.");
                }
            }
            ?>

            <div class="widget" style="margin-top:20px;">
                <div class="title"><h6>Order Log</h6></div>
                <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable withCheck mTable">
                        <thead>
                            <tr>                                
                                <td class="sortCol">Company Name</td>
                                <td class="sortCol">Contact Person </td>
                                <td class="sortCol">Email</td>
                                <td class="sortCol">Contact No.</td>                                    
                                <td class="sortCol">City</td>                                   
                                <td class="sortCol">Status</td>
                                <td style="width: 11%;">Actions</td>                                    

                                <!--
        <td style="width: 11%;">Actions</td>
                                -->
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="7">
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

                            $tbl_name = "tbl_user";
                            $adjacents = 3;
                            $query = "SELECT COUNT(*) as num FROM $tbl_name where type like 'user'";
                            $total_pages = mysql_fetch_array(mysql_query($query));
                            $totalcount = $total_pages;
                            $total_pages = $total_pages['num'];

                            $targetpage = "all-user.php";
                            $limit = 10;         //how many items to show per page
                            $page = isset($_GET['page']) ? $_GET['page'] : null;
                            if ($page)
                                $start = ($page - 1) * $limit;    //first item to display on this page
                            else
                                $start = 0;

                            $sql = "select * from $tbl_name where type like 'user' order by id desc LIMIT $start, $limit";
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
                                //$pagination.= "<li class=\"prev\"><a href=\"$targetpage?page=$prev\"><</a></li>";
                                    $pagination.= "<li class=\"prev\"><a href=\"$targetpage?page=$prev\">Previous</a></li>";
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
                                        //$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                                            $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                                    }
                                }
                                elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
                                    //close to beginning; only hide later pages
                                    if ($page < 1 + ($adjacents * 2)) {
                                        for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                                            if ($counter == $page)
                                                $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                                            else
                                                $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                                        }
                                        $pagination.= "...";
                                        $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                                        $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";
                                    }
                                    //in middle; hide some front and some back
                                    elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                                        $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                                        $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                                        $pagination.= "...";
                                        for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                                            if ($counter == $page)
                                                $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                                            else
                                                $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                                        }
                                        $pagination.= "...";
                                        $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                                        $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";
                                    }
                                    //close to end; only hide early pages
                                    else {
                                        $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                                        $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                                        $pagination.= "...";
                                        for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                                            if ($counter == $page)
                                                $pagination.= "<li><a href=\"#\" class=\"active\">$counter</a></li>";
                                            else
                                                $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                                        }
                                    }
                                }

                                //next button
                                if ($page < $counter - 1)
                                    $pagination.= "<li class=\"next\"><a href=\"$targetpage?page=$next\">Next</a></li>";
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
                                        <td>
                                            <?php echo $r['company_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $r['contact_person']; ?>
                                        </td>
                                        <td>
                                            <?php echo $r['email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $r['contact_no']; ?>
                                        </td>                                           
                                        <td>
                                            <?php echo $r['city']; ?>
                                        </td>
                                        <td align="center">
                                            <img alt="status" title="<?php echo($r['is_approve'] == "1") ? "Approved" : "Unapproved"; ?>" style="width: 30px;height:30px" src="images/<?php echo($r['is_approve'] == "1") ? "approved.png" : "unapprove.png"; ?>" />
                                        </td>
                                        <td class="actBtns">                                                
                                            <a class="tipS" title="View order detail" href="order-log-detail.php?q=<?php echo $r["id"]; ?>">
                                                <img style="width: 10px;height: 10px" alt="" src="images/icons/color/grid.png" />
                                            </a>                                                
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7">
                                        <?php
                                        $msg->information("No user found.");
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
        </div>

        <?php include_once "includes/footer.php"; ?>   

    </body>
</html>