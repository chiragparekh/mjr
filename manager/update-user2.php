<?php include_once "includes/checksession.php"; ?>
<?php
if (!isset($_POST['btnSubmit']))
    header("location: all-user.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <title>Update User</title>

        <?php include_once "includes/common-css-js.php"; ?>

        <style type="text/css">
            #mediagal{
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
            <br />
            <a style="margin: 5px;" class="button blueB" title="" href="all-user.php">
                <img class="icon" alt="" src="images/icons/light/view.png" />
                <span>View</span>
            </a>
            <a style="margin: 5px;" class="button blueB" title="" href="add-new-user.php">
                <img class="icon" alt="" src="images/icons/light/add.png" />
                <span>Add New</span>
            </a>
            <?php
            if (isset($_POST['btnSubmit'])) {
                if (trim($_POST['txtCompName']) != "" && trim($_POST['txtContPerson']) != "" && trim($_POST['txtEmail']) != "" && trim($_POST['txtContNo']) != "" && trim($_POST['txtCity']) != "") {
                    include_once "includes/connection.php";
                    $con = new MySQL();
                    $id = $_POST['hidId'];
                    $email = trim($_POST['txtEmail']);
                    $cnm = $_POST['txtCompName'];
                    $cper = $_POST['txtContPerson'];
                    $newpass = $_POST['txtNewPass'];
                    $cno = $_POST['txtContNo'];
                    $addr = $_POST['txtAddr'];
                    $city = $_POST['txtCity'];
                    $state = $_POST['txtState'];
                    $zipcode = $_POST['txtZipCode'];
                    
                    $q="";
                    if(trim($newpass)=="")
                    {
                        $q="update tbl_user set company_name='$cnm',contact_person='$cper',email='$email',contact_no='$cno',address='$addr' ,city='$city',state='$state',zip_code='$zipcode' where type like 'user' and id=" . $id;
                    }
                    else
                    {
                        $newpass=  md5($newpass);
                        $q="update tbl_user set company_name='$cnm',contact_person='$cper',email='$email',password='$newpass',contact_no='$cno',address='$addr' ,city='$city',state='$state',zip_code='$zipcode' where type like 'user' and id=" . $id;
                    }
                    if (mysql_query($q)) {
                        ?>
                        <div class="nNote nSuccess hideit">
                            <p><strong>SUCCESS: </strong>User updated successfully.</p>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to update user. Please try again.</p>
                        </div>
                        <?php
                    }
                    $con->CloseConnection();
                } else {
                    ?>
                    <div class="nNote nWarning hideit">
                        <p><strong>WARNING: </strong>Please provide all required fields.</p>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <?php include_once "includes/footer.php"; ?>   

    </body>
</html>