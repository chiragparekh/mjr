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
        <title>All User</title>

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
                    <h5>All User</h5>
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
            } else if (isset($_POST['btnMail'])) {
                $ids = $_POST['checkRow'];
                if (count($ids) > 0) {
                    include_once("includes/connection.php");
                    $qid = "";
                    foreach ($ids as $id) {
                        $qid.=$id . ",";
                    }
                    $qid = substr($qid, 0, strlen($qid) - 1);
                    $con = new MySQL();
                    $rs = mysql_query("select email from tbl_user where type like 'user' and id in(" . $qid . ")");
                    ?>
                    <form method="post" action="user-send-mail.php" class="form">
                        <fieldset>
                            <div class="widget">
                                <div class="title"><img src="images/icons/dark/list.png" alt="" class="titleIcon" /><h6>Send E-mail</h6></div>
                                <div class="formRow">
                                    <label>Selected emails:</label>
                                    <div style="border: 1px solid gray;height:150px;overflow:scroll;">
                                        <?php
                                        while ($r = mysql_fetch_array($rs)) {
                                            echo $r["email"] . "<br />";
                                        }
                                        ?>
                                    </div>
                                </div>                                                                          
                                <div class="formRow">
                                    <label>Write your mail content:</label>
                                    <div class="formRight"><textarea name="mail_content" rows="8" cols=""></textarea></div>
                                    <div class="clear"></div>
                                </div>  
                                <div class="formRow">
                                    <div class="formSubmit">
                                        <input name="btnSend" class="blueB" type="submit" value="Send" />
                                    </div>
                                    <div class="clear"></div>
                                </div> 
                                <input type="hidden" name="ids" value="<?php echo $qid; ?>" />                  


                            </div>
                        </fieldset>

                    </form>
                    <?php
                    $con->CloseConnection();
                } else {
                    echo $msg->warning("Select at least one user.");
                    ?>
                    <a style="margin: 5px;" class="button blueB" title="" href="user.php">
                        <img class="icon" alt="" src="images/icons/light/view.png" />
                        <span>View User</span>
                    </a>
                    <?php
                }
            }
            ?>

            <?php
            if (!isset($_POST['btnMail'])) {
                ?>
                <div class="widget" style="margin-top:20px;">
                    <div class="title"><span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck" /></span><h6>All User</h6></div>
                    <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable withCheck mTable">
                            <thead>
                                <tr>
                                    <td><img alt="" src="images/icons/tableArrows.png"></td>
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
                                    <td colspan="8">
                                        <div style="float: left;" class="formSubmit">
                                            <input name="btnDelete" class="redB" type="submit" value="Delete Selected" onclick="javascript: return confirm('Do you really want to delete selected user?');" />
                                        </div>
                                        <div style="float: left;" class="formSubmit">
                                            <input name="btnMail" class="blueB" type="submit" value="Send E-mail To Selected" />
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
                                                <input value="<?php echo $r['id'] ?>" type="checkbox" name="checkRow[]" id="checkRow<?php echo $r['id'] ?>" id="titleCheck2" />
                                            </td>
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
                                            <td>
                                                <img alt="status" title="<?php echo($r['is_approve']=="1")?"Approved":"Unapproved";?>" style="width: 30px;height:30px" src="images/<?php echo($r['is_approve']=="1")?"approved.png":"unapprove.png";?>" />
                                            </td>
                                            <td class="actBtns">
                                                <a class="tipS" title="Detail" href="user-detail.php?q=<?php echo $r["id"]; ?>">
                                                    <img style="width: 10px;height: 10px" alt="" src="images/icons/color/grid.png" />
                                                </a>
                                                <a class="tipS" title="Edit" href="edit-user.php?q=<?php echo $r["id"]; ?>">
                                                    <img style="width: 10px;height: 10px" alt="" src="images/icons/edit.png" />
                                                </a>
                                                <a onclick="javascript: return confirm('Do you really want to delete this user?');" class="tipS" title="Delete" href="delete-user.php?q=<?php echo $r["id"]; ?>">
                                                    <img style="width: 10px;height: 10px" alt="" src="images/icons/remove.png" />
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="8">
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
                <?php
            }
            ?>
        </div>

        <?php include_once "includes/footer.php"; ?>   

    </body>
</html>