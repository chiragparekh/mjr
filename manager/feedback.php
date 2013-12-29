<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <title>User Feedback</title>
        <?php include_once "includes/common-css-js.php"; ?>

        <style type="text/css">
            #feedback{
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
                    <h5>User Feedback</h5>
                   <!--<span>Manage Photo Album.</span>-->
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="line"></div>

        <!-- Main content wrapper -->
        <div class="wrapper">
            <br />               
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
                    if (mysql_query("delete from tbl_feedback where id in(" . $qid . ")")) {
                        ?>
                        <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>Selected feedback deleted successfully.</p>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to delete selected feedback. Please try again.</p>
                        </div>
                        <?php
                    }
                    $con->CloseConnection();
                } else {
                    ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Select at least one feedback.</p>
                    </div>
                    <?php
                }
            }//end of button delete
            ?>  
            <form id="frm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div style="float: left;margin-left: 5px; margin-right: 5px;" class="formSubmit">
                    <input  onclick="javascript: return confirm('Do you really want to delete selected feedback?');" name="btnDelete" class="redB" type="submit" value="Delete Selected" />
                </div> 
                <div class="widget" style="margin-top:20px;">
                    <div class="title"><span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span><h6>Feedback</h6></div>

                    <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable withCheck mTable">
                        <thead>
                            <tr>
                                <td><img alt="" src="images/icons/tableArrows.png"/></td>
                                <td class="sortCol">Name</td>
                                <td>Email</td>
                                <td>Mobile</td>
                                <td>Description</td>
                                <td style="width: 11%;">Actions</td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="6">
                                    <div style="float: left;margin-left: 5px; margin-right: 5px;" class="formSubmit">
                                        <input  onclick="javascript: return confirm('Do you really want to delete selected feedback?');" name="btnDelete" class="redB" type="submit" value="Delete Selected" />
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            include_once "includes/connection.php";
                            $con = new MySQL();
                            $rs = mysql_query("select * from tbl_feedback order by id desc");
                            if (mysql_num_rows($rs) > 0) {
                                while ($r = mysql_fetch_array($rs)) {
                                    ?>       

                                    <tr>
                                        <td>
                                            <input value="<?php echo $r['id'] ?>" type="checkbox" name="checkRow[]" id="checkRow<?php echo $r['id'] ?>" id="titleCheck2" />
                                        </td>
                                        <td align="left"><?php echo $r["name"]; ?></td>
                                        <td align="left"><?php echo $r["email"]; ?></td>
                                        <td align="left"><?php echo $r["mobile"]; ?></td>
                                        <td align="left"><?php echo $r["content"]; ?></td>

                                        <td class="actBtns" style="padding: 5px;">
                                            <a onclick="javascript: return confirm('Do you really want to delete this feedback?');" class="tipS" title="Remove" href="delete-feedback.php?q=<?php echo $r["id"]; ?>">
                                                <img alt="" src="images/icons/dark/close.png" />
                                            </a>                                                        
                                        </td>
                                    </tr>

                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <div style="margin-top: 0px;" class="nNote nInformation hideit">
                                            <p><strong>INFORMATION: </strong>No feedback found.</p>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            $con->CloseConnection();
                            ?>        
                        </tbody>
                    </table>
            </form>
        </div>
        </div>
        <?php include_once "includes/footer.php"; ?>   

    </body>
</html>