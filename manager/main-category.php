<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <title>Category</title>

        <?php include_once "includes/common-css-js.php"; ?>

        <link rel="stylesheet" href="css/zebra_pagination.css" type="text/css" />
        <script type="text/javascript" src="js/zebra_pagination.js">
        </script> 

        <style type="text/css">
            #photogal{
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
                    <h5>Category</h5>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="line"></div>

        <!-- Main content wrapper -->
        <div class="wrapper">
            <br />
            <a style="margin: 5px;" class="button blueB" title="" href="add-new-main-category.php">
                <img class="icon" alt="" src="images/icons/light/add.png" />
                <span>Add New</span>
            </a>
            <?php
            include_once("includes/checksession.php");
            if (isset($_POST['btnDelete'])) {
                $ids = $_POST['checkRow'];
                if (count($ids) > 0) {
                    include_once("includes/functions.php");
                    include_once("includes/connection.php");
                    $qid = "";
                    foreach ($ids as $id) {
                        $qid.=$id . ",";
                    }
                    $qid = substr($qid, 0, strlen($qid) - 1);
                    $con = new MySQL();

                    $trs = mysql_query("select name from tbl_sub_category where category_id in(" . $qid . ")");
                    while ($tr = mysql_fetch_array($trs)) {
                        deleteDirectory("uploads/thumbs/" . $tr[0]);
                        deleteDirectory("uploads/original/" . $tr[0]);
                    }

                    if (mysql_query("delete from tbl_category where id in(" . $qid . ")")) {
                        ?>
                        <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Selected category deleted successfully.</p>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to delete selected category. Please try again.</p>
                        </div>
                        <?php
                    }
                    $con->CloseConnection();
                } else {
                    ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Select at least one category.</p>
                    </div>
                    <?php
                }
            }
            ?>
            <form onsubmit="javascript: return confirm('Do you really want to delete selected category?');" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div style="float: left;margin: 5px" class="formSubmit">
                    <input name="btnDelete" class="redB" type="submit" value="Delete Selected" />
                </div>
                <div class="widget" style="margin-top:20px;">
                    <div class="title"><span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span><h6>Category</h6></div>

                    <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable withCheck mTable">
                        <thead>
                            <tr>
                                <td><img alt="" src="images/icons/tableArrows.png"></td>
                                <td class="sortCol">Category Name</td>
                                <td style="width: 11%;">Actions</td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="3">
                                    <div style="float: left;" class="formSubmit">
                                        <input name="btnDelete" class="redB" type="submit" value="Delete Selected" />
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            include_once "includes/connection.php";
                            $con = new MySQL();

                            $tbl_name = "tbl_category";
                            $adjacents = 3;
                            $query = "SELECT COUNT(*) as num FROM $tbl_name";
                            $total_pages = mysql_fetch_array(mysql_query($query));
                            $totalcount = $total_pages;
                            $total_pages = $total_pages['num'];

                            $targetpage = "main-category.php";
                            $limit = 10;        //how many items to show per page
                            $page = isset($_GET['page']) ? $_GET['page'] : null;
                            if ($page)
                                $start = ($page - 1) * $limit;    //first item to display on this page
                            else
                                $start = 0;

                            $sql = "select * from $tbl_name order by id desc LIMIT $start, $limit";
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
                                        <td align="left"><?php echo $r["name"]; ?></td>                        
                                        <td class="actBtns">
                                            <a class="tipS" title="Update" href="update-main-category.php?q=<?php echo $r["id"]; ?>">
                                                <img style="height: 12px;width: 12px" alt="" src="images/icons/edit.png" />
                                            </a>
                                            &nbsp;&nbsp;
                                            <a onclick="javascript: return confirm('Do you really want to delete this category?');" class="tipS" title="Remove" href="delete-main-category.php?q=<?php echo $r["id"]; ?>">
                                                <img style="height: 12px;width: 12px" alt="" src="images/icons/remove.png" />
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="3">
                                        <div style="margin-top: 0px;" class="nNote nInformation hideit">
                                            <p><strong>INFORMATION: </strong>No category found.</p>
                                        </div>
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