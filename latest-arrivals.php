<?php include_once './includes/checksession.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Latest Arrivals :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <script>
            !window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
        </script>
        <script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />


        <!--<link rel="stylesheet" type="text/css" href="css/pagination-style.css" media="screen"/>-->
        <script type="text/javascript" src="js/jquery.blockUI.js"></script>

        <link rel="stylesheet" type="text/css" href="css/bubble-tooltip.css" media="screen"/>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#latest-arrivals").addClass("active");
                $("a[rel=example_group]").fancybox({
                    'transitionIn': 'fade',
                    'transitionOut': 'fade',
                    'titlePosition': 'over',
                    'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
                        return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                    }
                });
                //getLatestProduct(1);
                $(".bubble").hide();
            });
            function block()
            {
                $.blockUI(
                        {
                            css: {
                                border: '2px solid #654E9D',
                                padding: '4px',
                                backgroundColor: '#fff',
                                '-webkit-border-radius': '5px',
                                '-moz-border-radius': '5px',
                                'border-radius': '5px',
                                opacity: .8,
                                color: '#000',
                            },
                            message: "<img alt='Please Wait...' src='images/loader.gif'/>"
                        }
                );
            }
            function addToCart(pro_id) {
                //logic of add to cart           
                var pro_id = $("#current-item").val();
                var qty = document.getElementById("txtQty").value;
                var desc = document.getElementById("txtDesc").value;
                if (qty.trim() == "") {
                    qty = 0;
                }
                if (desc.trim() == "") {
                    desc = "";
                }
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

                return false;
            }
            function changeAddToCartLink() {
                var pro_id = $("#current-item").val();
                $("#add-to-cart-link-" + pro_id).attr("href", "javascript:void(0)");
                $("#add-to-cart-link-" + pro_id).attr("class", "");

                /*$("#add-to-cart-link-" + pro_id).css({"background-color": "#E4D5FF", "border-radius": "5px", "color": "#322453", "width": "75px", "text-align": "center", "height": "14px", "padding": "5px", "text-decoration": "none", "margin-top": "5px", "-webkit-border-radius": "5px", "-moz-border-radius": "5px"});*/
                $("#add-to-cart-link-" + pro_id).css({"color": "#d8c6ff", "font-weight": "bold"});
                $("#add-to-cart-link-" + pro_id).html("Item added");
            }
            /*function getLatestProduct(page_id)
             {
             block();
             var formData = {page: page_id};
             $.ajax({
             url: "ajax-get-latest-arrival.php",
             type: "POST",
             data: formData,
             success: function(data, textStatus, jqXHR)
             {
             $("#latest-product-result").html(data);
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
             */
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
                <h1>Latest Arrivals</h1>    
            </div>
            <div id="latest-arrival-result">

                <?php

                function in_array_r($needle, $haystack, $strict = false) {
                    foreach ($haystack as $item) {
                        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
                            return true;
                        }
                    }
                    return false;
                }

                include_once './includes/connection.php';
                $con = new MySQL();
                $rs = mysql_query("select p.id as pid,p.name as name, p.image_path as image_path,p.weight as weight,p.description as description,sc.name as sub_cat_name from  tbl_sub_category sc inner join tbl_product p on p.sub_category_id=sc.id order by p.id desc limit 15");
                if (mysql_num_rows($rs) > 0) {
                    while ($row = mysql_fetch_array($rs)) {
                        ?>
                        <div class="product">
                            <div class="pro-heading"><h1 class="center"><?php echo ucwords($row['name']); ?></h1></div>
                            <div class="pro-img"><a rel="example_group" href="manager/uploads/original/<?php echo $row["sub_cat_name"]; ?>/<?php echo $row["image_path"]; ?>" title=""><img src="manager/uploads/thumbs/<?php echo $row["sub_cat_name"]; ?>/<?php echo $row["image_path"]; ?>" width="180" height="160" alt="" /></a></div>
                            <div class="pro-detail">
                                <a href="product.php?q=<?php echo $row["pid"] ?>">View Detail</a>
                                <?php
                                if (!isset($_SESSION['cart'])) {
                                    ?>
                                    <a class="add-to-cart-link" id="add-to-cart-link-<?php echo $row["pid"] ?>" href="#<?php echo $row["pid"] ?>">Add to Cart</a>
                                    <?php
                                } else {
                                    if (!in_array_r($row['pid'], $_SESSION['cart'])) {
                                        ?>
                                        <a class="add-to-cart-link" id="add-to-cart-link-<?php echo $row["pid"] ?>" href="#<?php echo $row["pid"] ?>">Add to Cart</a>
                                        <?php
                                    } else {
                                        ?>
                                        <a id="add-to-cart-link-<?php echo $row["pid"] ?>" href="javascript:void(0)" style="color:#d8c6ff;font-weight:bold">Item added</a>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="clear"></div>
                    <div class="custom-message">No Product Found</div>
                    <?php
                }
                $con->CloseConnection();
                ?>
            </div>
            <div class="bubble">
                <input type="hidden" id="current-item" value="-1"/>
                <table align="center" style="margin:10px">
                    <tr>                        
                        <td>
                            <input type="text" name="txtQty" id="txtQty" placeholder="Enter quantity" style="width:100%"/>
                        </td>
                    </tr>            
                    <tr>                        
                        <td>
                            <textarea name="txtDesc" id="txtDesc" rows="3" style="width:100%;font-family:verdana;font-size: 12px" placeholder="Enter description"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <input onclick="addToCart()" type="button" id="btnAddToCart" value="Add to cart"/>
                            <input onclick="javascript:$('.bubble').fadeOut('slow')" type="button" id="btnAddToCart" value="Close"/>
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
            $("#latest-arrival-result a.add-to-cart-link").live("click", function(event) {
                var left = $(this).position().left;
                var top = $(this).position().top;
                //$(".bubble").css({"top": event.pageY - 190 - 2, "left": event.pageX - 321});
                $(".bubble").css({'top': top - 165, 'left': left - 100});
                $(".bubble").hide();
                $(".bubble").fadeIn('slow');
                $("#txtQty,#txtDesc").val("");
                $("#txtQty").focus();
                //set pro id in hidden variable                
                var pro_id = $(this).attr('href').split('#')[1];
                $("#current-item").val(pro_id);
            });
            $(document).click(function(e) {
                if (!$(e.target).is('#latest-arrival-result .add-to-cart-link')) {
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
