<?php include_once "includes/checksession.php"; ?>
<?php
if (!isset($_GET['q'])) {
    header("location:all-user.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <title>User Detail</title>

        <?php include_once "includes/common-css-js.php"; ?>

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
                    <h5>User Detail</h5>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="line"></div>

        <!-- Main content wrapper -->
        <div class="wrapper">            
            <?php
            include_once "includes/connection.php";
            $con = new MySQL();
            $rs = mysql_query("select * from tbl_user where type like 'user' and id=" . $_GET['q']);
            $r = mysql_fetch_array($rs);
            $con->CloseConnection();
            ?>
            <form enctype="multipart/form-data" style="margin-top:20px;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form" id="validate">
                <fieldset>
                    <div class="widget" style="margin-top: 20px;">
                        <div class="title">
                            <img class="titleIcon" alt="" src="images/icons/dark/view.png" />
                            <h6>User Detail</h6>
                        </div>
                        <div class="formRow">
                            <label>Company Name</label>
                            <div class="formRight">
                                <?php echo $r['company_name']; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Contact Person</label>
                            <div class="formRight">
                                <?php echo $r['contact_person']; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Email</label>
                            <div class="formRight">
                                <?php echo $r['email']; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Contact No.</label>
                            <div class="formRight">
                                <?php echo $r['contact_no']; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Address</label>
                            <div class="formRight">
                                <?php echo $r['address']; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>City</label>
                            <div class="formRight">
                                <?php echo $r['city']; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>State</label>
                            <div class="formRight">
                                <?php echo $r['state']; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Zip Code</label>
                            <div class="formRight">
                                <?php echo $r['zip_code']; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Status</label>
                            <div class="formRight">
                                <?php echo ($r['is_approve'] == "1") ? "Approved" : "Unapproved"; ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div>
                            <a href="all-user.php" title="" class="button blueB" style="margin: 5px;">
                                <img src="images/icons/light/goBack.png" alt="" class="icon">
                                    <span>Back</span>
                            </a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </fieldset>
            </form>
        </div>

        <?php include_once "includes/footer.php"; ?>   

    </body>
</html>