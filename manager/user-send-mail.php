<?php include_once "includes/checksession.php"; ?>
<?php 
    include_once "includes/message.php";
    $msg=new Message();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>User</title>

<?php include_once "includes/common-css-js.php";?>
<style type="text/css">
 #user{
    background-position: 0 -86px;
    border-top: 1px solid #657D92;}
</style>
</head>

<body>

<?php include_once "includes/leftside.php";?>



<?php include_once "includes/rightside.php";?>    
    <!-- Title area -->
    <div class="titleArea">
        <div class="wrapper">
            <div class="pageTitle">
                <h5>User</h5>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
        <br />
<a style="margin: 5px;" class="button blueB" title="" href="user.php">
            <img class="icon" alt="" src="images/icons/light/view.png" />
            <span>View User</span>
        </a>
        <br />
        <?php
            if(isset($_POST['btnSend']))
            {
                $ids=$_POST['ids'];
                $message=$_POST['mail_content'];
                if(count($ids)>0)
                {
                    include_once("includes/connection.php");
                    $con=new MySQL();
                    $rs=mysql_query("select email from tbl_user where type like 'user' and id in(".$ids.")");
                    $header =     'From: MJR Jewellers<info@mjrjewels.com>' . "\r\n" .
                           'Reply-To: info@mjrjewels.com' . "\r\n" .
                          'X-Mailer: PHP/' . phpversion();
                    echo $msg->success("Mail sent successfully except following recipients :");
                    $fc=0;
                    while($r=mysql_fetch_array($rs))
                    {
                        //echo "Sending mail to " . $r["email"];
                        $result = mail($r["email"], 'Mail from www.mjrjewels.com', $message, $header);
                        if($result) {
                            //echo $msg->success("To: ".$r["email"]." - Mail Sent");
                        } else {
                            $fc++;
                            echo $msg->error("To: ".$r["email"]." - Failed to send mail");
                        } 
                    }
                    $con->CloseConnection();
                }
                if($fc==0)
                    echo $msg->information("All mail sent without any failure");
            }
        ?>
    </div>
    
<?php include_once "includes/footer.php";?>   

</body>
</html>