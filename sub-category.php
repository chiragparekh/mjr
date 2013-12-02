<?php include_once './includes/checksession.php';?>
<?php
if (!isset($_GET['q']) || $_GET['q']=="") {
    header("location:category.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Gallery :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <script>
            !window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $("#gallery").addClass("active");
            });
        </script>
        <script type="text/javascript">
            <!--//---------------------------------+
    //  Developed by Roshan Bhattarai 
            //  Visit http://roshanbh.com.np for this script and more.
            //  This notice MUST stay intact for legal use
            // --------------------------------->
            $(document).ready(function()
            {
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
        <!--right-content-->
        <div class="right-content">
            <div class="pro-name">
                <?php
                include_once 'includes/connection.php';
                $con = new MySQL();
                $cat_id = $_GET['q'];
                $q="select name from tbl_category where id=".$cat_id;
                $result=mysql_query($q);
                $array=mysql_fetch_array($result);
                $name=$array["name"];
                ?>
                <h1>Sub Categories of <?php echo $name; ?></h1>
                <?php
                $q = "SELECT c.id as 'c_id',c.name as 'c_name' FROM tbl_category c inner join tbl_sub_category sc on c.id=sc.category_id inner join tbl_product pro on sc.id = pro.sub_category_id group by c_name";
                $result = mysql_query($q);
                while ($r = mysql_fetch_array($result)) {
                    if ($r["c_id"] == $cat_id) {
                        ?>
                        <span><a href="sub-category.php?q=<?php echo $r["c_id"]; ?>" style="color:#d8c6ff;font-weight:bold"><?php echo $r["c_name"] ?></a></span>
                        <?php
                    } else {
                        ?>

                        <span><a href="sub-category.php?q=<?php echo $r["c_id"]; ?>"><?php echo $r["c_name"] ?></a></span>
                        <?php
                    }
                }
                ?>        
            </div>
            <?php
            $q = "SELECT c.id as 'c_id',c.name as 'c_name',sc.id as 'sub_id',sc.name as 'sub_name',pro.name as 'pro_name',pro.image_path as 'path' FROM tbl_category c inner join tbl_sub_category sc on c.id=sc.category_id inner join tbl_product pro on sc.id = pro.sub_category_id where c.id=" . $cat_id . " group by sub_name";
            $result = mysql_query($q);
            if (mysql_num_rows($result) > 0) {
                while ($r = mysql_fetch_array($result)) {
                    ?>
                    <div class="category-thumb">
                        <div class="pro-heading"><h1 class="center"><?php echo $r["sub_name"] ?></h1></div>
                        <div class="pro-img"><a href="gallery.php?q=<?php echo $r["sub_id"]; ?>" title=""><img src="manager/uploads/thumbs/<?php echo $r["sub_name"] ?>/<?php echo $r ["path"] ?>" width="180" height="160" alt="" /></a></div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="clear"></div>
                <div class="custom-message">
                    <?php
                    echo "No sub categories found";
                    ?>
                </div>
                <?php
            }
            ?>                
        </div>
        <!--right-content-->
        <?php include_once 'includes/footer.php'; ?>

    </body>
</html>
