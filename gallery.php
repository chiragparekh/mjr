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
        <link rel="stylesheet" type="text/css" href="css/pagination-style.css" media="screen"/>
        <script type="text/javascript" src="js/jquery.blockUI.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bubble-tooltip.css" media="screen"/>
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
                //logic of add to cart           
                var pro_id = $("#current-item").val();
                var qty = document.getElementById("txtQty").value;
                var desc = document.getElementById("txtDesc").value;
                if (qty.trim() == "") {
                    alert("Provide quantity for product");
                    document.getElementById("txtQty").focus();
                } else if (desc.trim() == "") {
                    alert("Provide description for product");
                    document.getElementById("txtDesc").focus();
                } else {
                    //if all validation works perfectly
                    block();
                    var formData = {pro_id: pro_id, qty: qty, desc: desc};
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
                            changeAddToCartLink();
                            //closeDetailForm();
                            $(".bubble").fadeOut('slow');
                            $.unblockUI();
                        },
                        error: function(jqXHR, textStatus, errorThrown)
                        {
                            $.unblockUI();
                            $(".bubble").fadeOut('slow');
                        }
                    });
                }
                return false;
            }
            function changeAddToCartLink() {  
                var pro_id = $("#current-item").val();
                $("#add-to-cart-link-"+pro_id).attr("href", "javascript:void(0)");
                $("#add-to-cart-link-"+pro_id).attr("class", "");
                $("#add-to-cart-link-"+pro_id).css({"background-color": "#E4D5FF", "border-radius": "5px", "color": "#322453", "width": "75px", "text-align": "center", "height": "14px", "padding": "5px", "text-decoration": "none", "margin-top": "5px", "-webkit-border-radius": "5px", "-moz-border-radius": "5px"});
                $("#add-to-cart-link-"+pro_id).html("Item added");
            }
            function resetAddToCartLink() {
                var pro_id = $("#current-item").val();
                $("#add-to-cart-link-"+pro_id).attr("href", "javascript:openDetailForm()");
                $("#add-to-cart-link-"+pro_id).attr("style", "");
                $("#add-to-cart-link-"+pro_id).html("Add to Cart");
            }
        </script>
        <script type="text/javascript">
            function block()
            {
                $.blockUI({css: {
                        border: '4px solid gray',
                        padding: '0px',
                        backgroundColor: '#fff',
                        '-webkit-border-radius': '5px',
                        '-moz-border-radius': '5px',
                        'border-radius': '5px',
                        opacity: .8,
                        color: '#000'
                    }});
            }
            $(document).ready(function()
            {
                //hide bubble
                $(".bubble").hide();
                getProduct(1,<?php echo $_GET['q'] ?>);
            });
            function getProduct(page_id, sub_id)
            {
                block();
                var formData = {page: page_id, sub_id: sub_id};
                $.ajax({
                    url: "ajax-get-gallery-product.php",
                    type: "POST",
                    data: formData,
                    success: function(data, textStatus, jqXHR)
                    {
                        $("#gallery-result").html(data);
                        $.unblockUI();
                        $("a[rel=example_group]").fancybox({
                            'transitionIn': 'fade',
                            'transitionOut': 'fade',
                            'titlePosition': 'over',
                            'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
                                return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                            }
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        $.unblockUI();
                    }
                });
            }
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
                $sub_cat_id = $_GET['q'];
                $q = "select name from tbl_sub_category where id=" . $sub_cat_id;
                $result = mysql_query($q);
                $array = mysql_fetch_array($result);
                $name = $array["name"];
                ?>
                <h1>Products of <?php echo $name; ?>
                    <div style="float:right"><a href="javascript:history.back(-1);">Back</a></div>
                </h1>
                <?php
                $q = "SELECT c.id as 'c_id',c.name as 'c_name',sc.id as 'sub_id',sc.name as 'sub_name',pro.name as 'pro_name',pro.image_path as 'path' FROM tbl_category c inner join tbl_sub_category sc on c.id=sc.category_id inner join tbl_product pro on sc.id = pro.sub_category_id where c.id in (select category_id from tbl_sub_category where id=" . $sub_cat_id . ") group by sub_name";
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
            <div id="gallery-result"></div>
            <div class="bubble">
                <input type="hidden" id="current-item" value="-1"/>
                <table align="center" style="margin:10px">
                    <tr>
                        <td>
                            Quantity
                        </td>
                        <td>
                            <input type="text" name="txtQty" id="txtQty"/>
                        </td>
                    </tr>            
                    <tr>
                        <td>
                            Description
                        </td>
                        <td>
                            <textarea name="txtDesc" id="txtDesc" rows="3" style="width:100%"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input onclick="addToCart()" type="button" id="btnAddToCart" value="Add to cart"/>
                            <br/>
                        </td>        
                    </tr>    
                </table>
            </div>
        </div>

        <!--right-content-->
        <?php include_once 'includes/footer.php'; ?>
        <script type="text/javascript">
            //code for the tooltip and add to cart
            $("#gallery-result a.add-to-cart-link").live("click", function(event) {
                $(".bubble").css({"top": event.pageY - 190 - 2, "left": event.pageX - 395});
                $(".bubble").hide();
                $(".bubble").fadeIn('slow');
                $("#txtQty,#txtDesc").val("");
                $("#txtQty").focus();
                //set pro id in hidden variable
                var pro_id = $(this).attr('href').split('#')[1];
                $("#current-item").val(pro_id);
            });
            $(document).click(function(e) {
                if (!$(e.target).is('#gallery-result .add-to-cart-link')) {
                    $(".bubble").fadeOut('slow');
                }
            });
            $(".bubble").click(function(e) {
                e.stopPropagation();
                return false;
            });
        </script>

    </body>
</html>
