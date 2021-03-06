<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <title>Send mail to all</title>

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
                    <h5>Send mail to all</h5>
                    <!--<span>Add new category.</span>-->
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
            if (isset($_POST['btnSubmit'])) {
                $useremailrs = mysql_query("select email from tbl_user where type like 'user'");
                $useremails = "";
                while ($row = mysql_fetch_array($useremailrs)) {
                    $useremails.=$row['email'] . ",";
                }
                $useremails = substr($useremails, 0, strlen($useremails) - 1);
                $header = 'From: MJR Jewellers<manojranpara@ymail.com>' . "\r\n" .
                        'BCC: '.$useremails. "\r\n" .
                        'Reply-To: manojranpara@ymail.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion()."\r\n";
                $message = trim($_POST['txtDesc']);
                if (!mail(null, "Notification from MJR Jewels website (www.mjrjewels.com)", $message, $header)) {
                    ?>
                    <div class="nNote nFailure hideit">
                        <p><strong>FAILURE: </strong>Oops sorry. We are unable to send notification mail to users.</p>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="nNote nSuccess hideit">
                        <p><strong>SUCCESS: </strong>Mail sent successfully.</p>
                    </div>
                    <?php
                }
            }
            $con->CloseConnection();
            ?>
            <form  style="margin-top:20px;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form" id="validate">
                <fieldset>
                    <div class="widget" style="margin-top: 20px;">
                        <div class="title">
                            <img class="titleIcon" alt="" src="images/icons/dark/pencil.png" />
                            <h6>Send mail to all</h6>
                        </div>                        
                        <div class="formRow">
                            <label>Mail Body:</label>
                            <div class="formRight">
                                <textarea name="txtDesc" rows="5" id="txtDesc" class="validate[required]" ></textarea>
                            </div><div class="clear"></div>
                        </div>
                        <div class="formSubmit" style="float: left">
                            <input type="submit" class="redB" name="btnSubmit" value="send" />
                        </div>
                        <div class="clear"></div>
                    </div>
                </fieldset>
            </form>
        </div>

        <?php include_once "includes/footer.php"; ?>   

    </body>
</html>