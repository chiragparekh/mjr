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
        <title>Update User</title>

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
                    <h5>Update User</h5>
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
            <form style="margin-top:20px;" action="update-user2.php" method="post" class="form" id="validate">
                <input type="hidden" name="hidId" value="<?php echo $_GET['q']; ?>" />
                <fieldset>
                    <div class="widget" style="margin-top: 20px;">
                        <div class="title">
                            <img class="titleIcon" alt="" src="images/icons/dark/view.png" />
                            <h6>Update User</h6>
                        </div>
                        <div class="formRow">
                            <label>Company Name&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <input type="text" value="<?php echo $r['company_name']; ?>" id="txtCompName" name="txtCompName" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Contact Person&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <input type="text" value="<?php echo $r['contact_person']; ?>" id="txtContPerson" name="txtContPerson" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Email&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <input type="text" value="<?php echo $r['email']; ?>" id="txtEmail" name="txtEmail" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>New Password</label>
                            <div class="formRight">
                                <input type="text" value="" id="txtNewPass" name="txtNewPass" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Contact No.&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <input type="text" value="<?php echo $r['contact_no']; ?>" id="txtContNo" name="txtContNo" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Address</label>
                            <div class="formRight">
                                <textarea name="txtAddr" id="txtAddr"><?php echo $r['address']; ?></textarea>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>City&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <input type="text" value="<?php echo $r['city']; ?>" id="txtCity" name="txtCity" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>State</label>
                            <div class="formRight">
                                <input type="text" value="<?php echo $r['state']; ?>" id="txtState" name="txtState"  />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Zip Code</label>
                            <div class="formRight">
                                <input type="text" value="<?php echo $r['zip_code']; ?>" id="txtZipCode" name="txtZipCode"  />
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
                        <div class="formSubmit">
                            <input type="submit" class="redB" name="btnSubmit" value="save" />
                        </div>
                        <div class="clear"></div>
                    </div>
                </fieldset>
            </form>
        </div>

        <?php include_once "includes/footer.php"; ?>   

    </body>
</html>