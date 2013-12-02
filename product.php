<?php
if (!isset($_GET['q']) || $_GET['q'] == "") {
    header("location:category.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Product :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
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
                $("#pro-detail-form").css("display", "none");
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


            function openDetailForm()
            {
                $("#txtQty,#txtDesc").val("");
                $("#pro-detail-form").css("display", "inline");
                $("#txtQty").focus();
            }
            function closeDetailForm()
            {
                $("#pro-detail-form").css("display", "none");
            }
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
    <body onload="initLightbox()">
        <?php include_once 'includes/header.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>            
        <!--right-content-->
        <div class="right-content">
            <div class="pro-name">
                <?php
                include_once 'includes/connection.php';
                $con = new MySQL();
                $pro_id = $_GET['q'];
                $q = "select p.image_path as image_path,p.name as name,p.weight as weight,p.description as description,p.sub_category_id as sub_category_id,sc.name as sub_name from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where p.id=" . $pro_id;
                $result = mysql_query($q);
                $array = mysql_fetch_array($result);
                $name = $array["name"];
                $weight = $array["weight"];
                $desc = $array["description"];                
                $path = $array["image_path"]; 
                $sub_cat_id=$array["sub_category_id"];
                $sub_name = $array["sub_name"];                
                ?>        
                <h1><?php echo $name ?></h1>
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
            <div class="sub-product">
                <div class="sub-pro-heading"><h1 class="center"><?php echo $name ?></h1></div>
                <div class="sub-pro-img"><a rel="example_group" href="manager/uploads/original/<?php echo $sub_name ?>/<?php echo $path ?>" title="Hello"><img src="manager/uploads/thumbs/<?php echo $sub_name ?>/<?php echo $path ?>" width="280" height="240" alt="" /></a></div>
            </div>   

            <div class="product-detail">
                <label>NAME : <span><?php echo $name ?></span></label> 
                <label>WEIGHT : <span><?php echo $weight ?></span></label> 
                <label>DESCRIPTION : <span><?php echo $desc ?></span></label>  
                <samp>
                    <img src="images/cart.png" width="36" height="40" alt="" />
                    <a href="javascript:openDetailForm()">Add to Cart </a><a href="#">View Selected Items</a>
                </samp>
                <div class="clear"></div>
                <div id="pro-detail-form" style="background: white;width: 300px;margin: 4px auto;border: 1px solid gray">
                    <form>
                        <table>
                            <tr>
                                <td class="pull-right">
                                    Quantity
                                </td>
                                <td>
                                    <input type="text" name="txtQty" id="txtQty" />
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right valign-top">
                                    Description
                                </td>
                                <td>
                                    <textarea name="txtDesc" id="txtDesc"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="submit" value="OK" />
                                    <input onclick="closeDetailForm()" type="button" value="Close" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="next"><a href="#">Next</a></div>
            </div>
            <div class="pro-slider">
                <a href="#"><div class="left-arrow"></div></a>
                <div class="scroll-image-first"><img src="images/scroller_img.jpg" width="140" height="140" alt="" /></div>
                <div class="scroll-image"><img src="images/scroller_img.jpg" width="140" height="140" alt="" /></div>
                <div class="scroll-image"><img src="images/scroller_img.jpg" width="140" height="140" alt="" /></div>
                <div class="scroll-image"><img src="images/scroller_img.jpg" width="140" height="140" alt="" /></div>
                <a href="#"><div class="right-arrow"></div></a>
            </div>
        </div>
        <!--right-content-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
