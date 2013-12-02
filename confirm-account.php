<?php
if (!isset($_GET['id']) || !isset($_GET["auth"])) {
    header("location: login.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Confirm Account :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <script>
            !window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
        </script>
        <script type="text/javascript">
        <!--//---------------------------------+
        //  Developed by Roshan Bhattarai 
        //  Visit http://roshanbh.com.np for this script and more.
        //  This notice MUST stay intact for legal use
        // --------------------------------->
            $(document).ready(function()
            {
                $("#about-us").addClass("active");
                //slides the element with class "menu_body" when paragraph with class "menu_head" is clicked 
                $("#firstpane p.menu_head").click(function()
                {
                    $(this).css({backgroundImage: "url(down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
                    $(this).siblings().css({backgroundImage: "url(left.png)"});
                });
                //slides the element with class "menu_body" when mouse is over the paragraph
                $("#secondpane p.menu_head").mouseover(function()
                {
                    $(this).css({backgroundImage: "url(down.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
                    $(this).siblings().css({backgroundImage: "url(left.png)"});
                });
            });
        </script>
    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>
        <div class="right-content">
            <div class="pro-name">
                <h1>Confirm Account</h1>
                <div class="content">
                    <?php
                    include_once './includes/connection.php';
                    $con = new MySQL();
                    $query = "select count(*) from tbl_user where md5(id)='" . $_GET['id'] . "' and random='" . $_GET["auth"] . "'";

                    $rs = mysql_query($query);
                    $n = mysql_fetch_array($rs);
                    if (intval($n[0]) > 0) {
                        $query = "update tbl_user set is_confirm='1' where md5(id)='" . $_GET['id'] . "'";
                        if (mysql_query($query)) {
                            ?>
                            <h2>
                                Your account is confirmed successfully.<br />
                                <a href="login.php" style="font-size:18px">Click here to login</a>
                            </h2>
                            <?php
                        }
                    } else {
                        ?>
                        <h2>
                            Unable to confirm your account.               
                        </h2>
                        <?php
                    }

                    $con->CloseConnection();
                    ?>
                </div>
            </div>
        </div>
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
