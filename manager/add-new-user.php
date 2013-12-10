<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <title>Add New User</title>

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
                    <h5>Add New User</h5>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="line"></div>

        <!-- Main content wrapper -->
        <div class="wrapper">
            <br />
            <a style="margin: 5px;" class="button blueB" title="" href="all-user.php">
                <img class="icon" alt="" src="images/icons/light/view.png" />
                <span>View</span>
            </a> 
            <?php
            if (isset($_POST['btnSubmit'])) {
                include_once "includes/connection.php";
                $con = new MySQL();
                if (trim($_POST['txtCompName']) != "" && trim($_POST['txtContPerson']) != "" && trim($_POST['txtEmail']) != "" && trim($_POST['txtContNo']) != "" && trim($_POST['txtCity']) != "") {
                    $email = trim($_POST['txtEmail']);
                    $cnm = $_POST['txtCompName'];
                    $cper = $_POST['txtContPerson'];
                    $newpass = $_POST['txtNewPass'];
                    $cno = $_POST['txtContNo'];
                    $addr = $_POST['txtAddr'];
                    $city = $_POST['txtCity'];
                    $state = $_POST['txtState'];
                    $zipcode = $_POST['txtZipCode'];

                    $newpass = md5($newpass);
                    $q = "insert into tbl_user(company_name,contact_person,email,password,contact_no,address,city,state,zip_code,type,is_approve) values('$cnm','$cper','$email','$newpass','$cno','$addr','$city','$state','$zipcode','user','1')";

                    if (mysql_query($q)) {
                        ?>
                        <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>User is added successfully.</p>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to add user. Please try again.</p>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Please provide all required fields.</p>
                    </div>
                    <?php
                }
                $con->CloseConnection();
            }
            ?>
            <form style="margin-top:20px;" action="add-new-user.php" method="post" class="form" id="validate">                
                <fieldset>
                    <div class="widget" style="margin-top: 20px;">
                        <div class="title">
                            <img class="titleIcon" alt="" src="images/icons/dark/add.png" />
                            <h6>Add User</h6>
                        </div>
                        <div class="formRow">
                            <label>Company Name&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <input type="text" id="txtCompName" name="txtCompName" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Contact Person&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <input type="text" id="txtContPerson" name="txtContPerson" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Email&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <input type="text" id="txtEmail" name="txtEmail" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Password</label>
                            <div class="formRight">
                                <input type="password" value="" id="txtNewPass" name="txtNewPass" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Contact No.&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <input type="text" id="txtContNo" name="txtContNo" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Address</label>
                            <div class="formRight">
                                <textarea name="txtAddr" id="txtAddr"></textarea>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>City&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <input type="text" id="txtCity" name="txtCity" class="validate[required]" />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>State</label>
                            <div class="formRight">
                                <input type="text" id="txtState" name="txtState"  />
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Zip Code</label>
                            <div class="formRight">
                                <input type="text" id="txtZipCode" name="txtZipCode"  />
                            </div>
                            <div class="clear"></div>
                        </div>                        
                        <div class="formSubmit" style="float:left">
                            <input type="submit" class="greenB" name="btnSubmit" value="save" />
                        </div>
                        <div class="formSubmit" style="float:left">
                            <input type="button" class="redB" name="btnCancel" value="cancel" onclick="javascript:window.history.back();" />
                        </div>
                        <div class="clear"></div>
                    </div>
                </fieldset>
            </form>
        </div>

<?php include_once "includes/footer.php"; ?>   

    </body>
</html>