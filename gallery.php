<?php include_once './includes/checksession.php'; ?>
<?php
if (!isset($_GET['q']) || $_GET['q'] == "") {
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
        <script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />

        <script type="text/javascript">
            $(document).ready(function() {
                $("#gallery").addClass("active");
                /*
                 *   Examples - images
                 */

                $("a#example1").fancybox();

                $("a#example2").fancybox({
                    'overlayShow': false,
                    'transitionIn': 'elastic',
                    'transitionOut': 'elastic'
                });

                $("a#example3").fancybox({
                    'transitionIn': 'none',
                    'transitionOut': 'none'
                });

                $("a#example4").fancybox({
                    'opacity': true,
                    'overlayShow': false,
                    'transitionIn': 'elastic',
                    'transitionOut': 'none'
                });

                $("a#example5").fancybox();

                $("a#example6").fancybox({
                    'titlePosition': 'outside',
                    'overlayColor': '#000',
                    'overlayOpacity': 0.9
                });

                $("a#example7").fancybox({
                    'titlePosition': 'inside'
                });

                $("a#example8").fancybox({
                    'titlePosition': 'over'
                });

                $("a[rel=example_group]").fancybox({
                    'transitionIn': 'none',
                    'transitionOut': 'none',
                    'titlePosition': 'over',
                    'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
                        return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                    }
                });

                /*
                 *   Examples - various
                 */

                $("#various1").fancybox({
                    'titlePosition': 'inside',
                    'transitionIn': 'none',
                    'transitionOut': 'none'
                });

                $("#various2").fancybox();

                $("#various3").fancybox({
                    'width': '75%',
                    'height': '75%',
                    'autoScale': false,
                    'transitionIn': 'none',
                    'transitionOut': 'none',
                    'type': 'iframe'
                });

                $("#various4").fancybox({
                    'padding': 0,
                    'autoScale': false,
                    'transitionIn': 'none',
                    'transitionOut': 'none'
                });
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
            function addToCart(pro_id) {
                var pro_id = pro_id;
                var qty = document.getElementById("cart_qty").value;
                var desc = document.getElementById("cart_desc").value;
                if (qty.trim() == "") {
                    alert("Provide quantity for product");
                    document.getElementById("cart_qty").focus();
                } else if (desc.trim() == "") {
                    alert("Provide description for product");
                    document.getElementById("cart_desc").focus();
                } else {
                    //if all validation works perfectly
                    var formData = {pro_id: pro_id};
                    $.ajax({
                        url: "ajax-add-to-cart.php",
                        type: "POST",
                        data: formData,
                        success: function(data, textStatus, jqXHR)
                        {
                            if (data.trim() == "added") {
                                alert("Item added to your order.")
                            } else if (data.trim() == "already-added") {
                                alert("Item already added to your order.")
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {

                        }
                    });
                }
                return false;
            }
        </script>
    </head>
    <body onload="initLightbox()">
        <?php include_once 'includes/header.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>        
        <!--right-content-->
        <div class="right-content">
            <div class="pro-name">
                <?php
                include_once 'includes/connection.php';
                $con = new MySQL();
                $sub_cat_id = $_GET['q'];
                $q = "select name from tbl_sub_category where id=" . $sub_cat_id;
                $result = mysql_query($q);
                $array = mysql_fetch_array($result);
                $name = $array["name"];
                ?>
                <h1>Products of <?php echo $name; ?></h1>
                <?php
                $q = "SELECT c.id as 'c_id',c.name as 'c_name',sc.id as 'sub_id',sc.name as 'sub_name',pro.name as 'pro_name',pro.image_path as 'path' FROM tbl_category c inner join tbl_sub_category sc on c.id=sc.category_id inner join tbl_product pro on sc.id = pro.sub_category_id group by sub_name";
                $result = mysql_query($q);
                while ($r = mysql_fetch_array($result)) {
                    if ($r["sub_id"] == $sub_cat_id) {
                        ?>
                        <span><a href="gallery.php?q=<?php echo $r["sub_id"]; ?>" style="color:#d8c6ff;font-weight:bold"><?php echo $r["sub_name"] ?></a></span>
                        <?php
                    } else {
                        ?>

                        <span><a href="gallery.php?q=<?php echo $r["sub_id"]; ?>"><?php echo $r["sub_name"] ?></a></span>
                        <?php
                    }
                }
                ?>        
            </div>

            <?php
            $q = "select sub.name as 'sub_name',p.image_path as 'path',p.name as 'pro_name',p.id as 'pro_id' from tbl_product p inner join tbl_sub_category sub on p.sub_category_id=sub.id where sub_category_id=" . $sub_cat_id;
            $result = mysql_query($q);
            while ($r = mysql_fetch_array($result)) {
                ?>
                <div class="product">
                    <div class="pro-heading"><h1 class="center"><?php echo ucwords($r["pro_name"]); ?></h1></div>
                    <div class="pro-img"><a rel="example_group" href="manager/uploads/original/<?php echo $r["sub_name"]; ?>/<?php echo $r['path']; ?>" title=""><img src="manager/uploads/thumbs/<?php echo $r["sub_name"]; ?>/<?php echo $r['path']; ?>" width="180" height="160" alt="" /></a></div>
                    <div class="pro-detail"><a href="product.php?q=<?php echo $r["pro_id"] ?>">View Detail</a><a href="javascript:addToCart(<?php echo $r["pro_id"] ?>)">Add to Cart</a></div>
                </div>
                <?php
            }
            ?>
        </div>

        <!--right-content-->
        <?php include_once 'includes/footer.php'; ?>

    </body>
</html>
