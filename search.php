<?php include_once './includes/checksession.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Search Product :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
<!--        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <script>
            !window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
        </script>-->
        <script src="js/jquery.1.7.1.min.js"></script>

        <style type="text/css">
            .lst
            {
                border-radius: 2px;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border: 1px solid white;                
                width: 100%;
            }
            .lst option
            {
                border-radius: 2px;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border: 1px solid gray;
                margin:2px;
            }
            .weightDiv
            {
                border-radius: 2px;
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                border: 1px solid white;
                background-color: white;color:black;padding: 4px;
            }
        </style>

        <script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="css/pagination-style.css" media="screen"/>

        <script type="text/javascript" src="js/jquery.blockUI.js"></script>
        <link rel="stylesheet" type="text/css" href="css/bubble-tooltip.css" media="screen"/>

        <script type="text/javascript">
            $(document).ready(function()
            {
                $("#advance-search").addClass("active");

                $("#lstCategory").change(function() {
                    //$("#loader").html('Please wait...');
                    block();
                    $.get('ajax-get-sub-category.php?cid=' + $(this).val(), function(data) {
                        $("#lstSubCategory").html(data);
                        //$('#loader').html('');
                        $.unblockUI();
                    });
                    searchProduct(1);
                });
                //searchProduct(1);
                $(".bubble").hide();
            });
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
                $("#add-to-cart-link-" + pro_id).css({"color": "#d8c6ff","font-weight":"bold"});
                $("#add-to-cart-link-" + pro_id).html("Item added");
            }
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
            function searchProduct(page_id)
            {
                //$("#loader").html('Please wait...');
                block();
                var formData = {minweight: $("#sliderMinWeight").val(), maxweight: $("#sliderMaxWeight").val(), category: $("#lstCategory").val(), subcategory: $("#lstSubCategory").val(), page: page_id};
                $.ajax({
                    url: "ajax-get-search-product.php",
                    type: "POST",
                    data: formData,
                    success: function(data, textStatus, jqXHR)
                    {

                        $("#search-result").html(data);
                        //$('#loader').html('');
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
        <div class="category">            
            <img src="images/search.png" width="160" height="25" alt="Search" style="margin-left: 40px;"/>
            <div class="clear"></div>
            <div style="margin: 10px 10px;">
                <?php
                include_once './includes/connection.php';
                $con = new MySQL();
                $maxweight = 1;
                $rs = mysql_query("select ceil(max(weight)) as max_weight from tbl_product");
                while ($row = mysql_fetch_array($rs)) {
                    $maxweight = intval($row['max_weight']);
                    $con->CloseConnection();
                }
                ?>
                <table style="color: #DBCBFF;margin-left:5px;margin-right:5px" cellpadding="4">
                    <tr>
                        <td class="pull-right" style="color: #DBCBFF">Min. Weight</td>
                        <td>
                            <div id="min-weight-val" class="weightDiv"></div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <div class="noUiSlider" id="sliderMinWeight"></div>
                            <script src="js/jquery.nouislider.min.js" type="text/javascript"></script>
                            <link href="css/jquery.nouislider.min.css" rel="stylesheet" />
                            <script>

            // Wait until the document is ready.
            $(function() {
                // Run noUiSlider
                $('.noUiSlider').noUiSlider({
                    range: [1, <?php echo $maxweight; ?>],
                    start: 1,
                    step: 1,
                    handles: 1,
                    behaviour: 'tap',
                    set: function() {
                        searchProduct(1);
                    },
                    slide: function() {
                        $("#min-weight-val").html($("#sliderMinWeight").val());
                        $("#max-weight-val").html($("#sliderMaxWeight").val());
                    }
                });
                $("#sliderMaxWeight").val(<?php echo $maxweight ?>);
                $("#min-weight-val").html($("#sliderMinWeight").val());
                $("#max-weight-val").html($("#sliderMaxWeight").val());
                searchProduct(1);
            });

                            </script>
                        </td>
                    </tr>
                    <tr>
                        <td class="pull-right" style="color: #DBCBFF">Max. Weight</td>
                        <td>
                            <div id="max-weight-val" class="weightDiv"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="noUiSlider" id="sliderMaxWeight"></div>

                        </td>
                    </tr>
                    <tr>
                        <td class="pull-right" style="color: #DBCBFF">
                            Category
                        </td>
                        <td>
                            <select class="lst" name="lstCategory" id="lstCategory">
                                <option value="-1">- - Select - -</option>
                                <?php
                                include_once './includes/connection.php';
                                $con = new MySQL();
                                $rs = mysql_query("select id,name from tbl_category");
                                while ($row = mysql_fetch_array($rs)) {
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                }
                                $con->CloseConnection();
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="pull-right" style="color: #DBCBFF">
                            Sub Category
                        </td>
                        <td>
                            <select class="lst" onchange="searchProduct(1)" name="lstSubCategory" id="lstSubCategory">
                                <option value="-1">- - Select - -</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center">
                            <div id="loader"></div>
                        </td>
                    </tr>
                </table>  
            </div>  <!--Code for menu ends here-->
        </div>
        <!--search-->   
        <!--right-content-->
        <div class="right-content">
            <div class="pro-name">
                <h1>Search Result</h1>
            </div>

            <div id="search-result">
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
        <!--endo-of-search-->
        <?php include_once 'includes/footer.php'; ?>
        <script type="text/javascript">
            //code for the tooltip and add to cart
            $("#search-result a.add-to-cart-link").live("click", function(event) {
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
                if (!$(e.target).is('#search-result .add-to-cart-link')) {
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
