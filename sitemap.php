<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Sitemap :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
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
                $("#sitemap").addClass("active");
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
        <!--Sitemap-->   
        <div class="right-content">
            <div class="pro-name">
                <h1>Sitemap</h1>
                <div class="content">
                    <div id="sitemap-links" style="margin-left: 15px;margin-top: 15px;line-height: 120%"> 
                        <a href="index.php">Home</a><br/>
                        <a href="about-us.php">About Us</a><br/>
                        <a href="category.php">Gallery</a><br/>
                        <div style="padding-left: 20px;">
                            <?php
                            include_once './includes/connection.php';
                            $con = new MySQL();
                            $rs = mysql_query("select id,name from tbl_category");
                            while ($r = mysql_fetch_array($rs)) {
                                ?>
                                <a href="sub-category.php?q=<?php echo $r['id']; ?>"><?php echo ucwords($r['name']); ?></a><br/>
                                <div style="padding-left: 20px;">
                                    <?php
                                    $rs_sc = mysql_query("select id,name from tbl_sub_category where category_id=" . $r['id']);
                                    while ($rsc = mysql_fetch_array($rs_sc)) {
                                        ?>
                                        <a href="gallery.php?q=<?php echo $rsc['id']; ?>"><?php echo ucwords($rsc['name']); ?></a><br/>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                        <a href="latest-arrivals.php">Latest Arrivals</a><br/>
                        <a href="search.php">Advance Search</a><br/>
                        <a href="contact-us.php">Contact Us</a><br/>
                        <a href="login.php">Login/Register</a><br/>
                        <a href="cart.php">Order Cart</a><br/>
                        <a href="order-log.php">Order History</a><br/>
                        <?php
                        $con->CloseConnection();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--endo-of-Sitemap-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
