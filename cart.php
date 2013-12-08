<?php include_once './includes/checksession.php'; ?>
<?php error_reporting(0) ?>
<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Order Cart :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/table.css" media="screen"/>        
        <script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
        <script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />
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
                $("a[rel=example_group]").fancybox({
                    'transitionIn': 'fade',
                    'transitionOut': 'fade',
                    'titlePosition': 'over',
                    'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
                        return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                    }
                });
            });
        </script>
        <script type="text/javascript">
            function printDiv() {
                var divToPrint = document.getElementById('csstable');
                newWin = window.open("");
                newWin.document.write("<center><h1>MJR Jewels</h1></center>");
                newWin.document.write("<center><p>12-Panna Manek Complex,shapura Temple, Palace Road,Rajkot<br/>Email: manojranpara@ymail.com</p></center>");
                var d = new Date();
                newWin.document.write("<center><h2>My selected items for order/inquiry dated on  " + d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear() + "</h2></center>");
                newWin.document.write(divToPrint.outerHTML);
                newWin.print();
            }
        </script>
    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>
        <!--cart-->   
        <div class="right-content">
            <div class="pro-name">
                <h1>Order / Inquiry Cart
                    <div style="float:right"><a href="javascript:history.back(-1);">Back</a></div>
                </h1><div class="clear"></div>
                <!--<div style="float: right;margin-right: 55px;margin-top: 5px;">
                    <a style="font-weight: bold;color: #DBCBFF;" href="order-log.php">View Order History</a>
                </div>-->
                <div class="content">
                    <?php
                    if (isset($_POST['btnClear'])) {
                        $_SESSION['cart'] = array_diff($_SESSION['cart'], $_SESSION['cart']);
                    }
                    if (isset($_GET['o']) && $_GET['o'] == 'delete') {
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $value) {
                                if ($value["id"] == $_GET["q"]) {
                                    unset($_SESSION['cart'][$key]);
                                    break;
                                }
                            }
                        }
                    }
                    if (isset($_POST['btnConfirm'])) {
                        $message = "";
                        if (isset($_SESSION['cart'])) {
                            $items = $_SESSION['cart'];
                            if (count($items) == 0 || $items == null) {
                                $message = "No items found in your order.";
                            } else {
                                include_once 'includes/connection.php';
                                $con = new MySQL();
                                $ic = 0;
                                $date = date("Y-m-d H:i:s");
                                foreach ($items as $item) {
                                    $q = "select p.id as p_id,p.name as name,sc.name as sub_name,p.weight as weight,p.image_path as path from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where p.id in (" . $item["id"] . ")";
                                    $result = mysql_query($q);
                                    while ($r = mysql_fetch_array($result)) {
                                        $q = "insert into tbl_order(user_id,product_id,product_qty,product_desc,order_date) values(".$_SESSION['userid']."," . $r["p_id"] . "," . $item["qty"] . ",'" . trim($item["desc"]) . "','" . $date . "')";
                                        mysql_query($q);
                                    }
                                }
                                $_SESSION['cart'] = array_diff($_SESSION['cart'], $_SESSION['cart']);
                                $message = "Your order is confirmed successfully.";
                            }
                        } else {
                            $message = "No items found in your order.";
                        }
                    }
                    ?>


                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <div class="CSSTableGenerator" id="csstablediv">
                            <table align="center" cellpadding="5" border="1" rules="all" id="csstable">
                                <tr class="heading">
                                    <td style="width:130px">Product Name</td>
                                    <td>Weight</td>
                                    <td>Quantity</td>
                                    <td style="width:200px">Description</td>
                                    <td style="width: 70px;">Image</td>
                                    <td style="width: 100px;">Edit</td>
                                </tr>
                                <?php
                                if (isset($_SESSION['cart'])) {
                                    $items = $_SESSION['cart'];
                                    if ((count($items) == 0 || $items == null) && $message == "") {
                                        ?>
                                        <tr>
                                            <td colspan="6" align="center">
                                                No items found in your order.
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        $ic = 0;
                                        foreach ($items as $item) {
                                            $q = "select p.name as name,sc.name as sub_name,p.weight as weight,p.image_path as path from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where p.id in (" . $item["id"] . ")";
                                            $result = mysql_query($q);
                                            while ($r = mysql_fetch_array($result)) {
                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo $r["name"]; ?></td>
                                                    <td align="center"><?php echo $r["weight"]; ?></td>
                                                    <td align="center"><?php echo trim($item['qty']) == 0 ? "<span style='color:gray;'>---</span>" : trim($item['qty']); ?></td>
                                                    <td align="center"><?php echo trim($item['desc']) == "" ? "<i style='color:gray'>Not Provided</i>" : trim($item['desc']); ?></td>
                                                    <td align="center">
                                                        <a rel="example_group" href="manager/uploads/original/<?php echo $r["sub_name"]; ?>/<?php echo $r['path']; ?>" title="">
                                                            <img src="manager/uploads/thumbs/<?php echo $r["sub_name"]; ?>/<?php echo $r['path']; ?>" width="80" height="80" alt="" />
                                                        </a>
                                                        <!--<img width="80" height="80" src="<?php echo "manager/uploads/thumbs/" . $r["sub_name"] . "/" . $r["path"] ?>" />-->
                                                    </td>
                                                    <td align="center"><a href="edit-cart.php?id=<?php echo $item["id"] ?>&name=<?php echo $r["name"] ?>&qty=<?php echo $item["qty"] ?>&desc=<?php echo $item["desc"] ?>"><img src="images/edit.png" width="25" height="25" alt="Edit Cart Item"/></a> <a onclick="javascript:return confirm('Are you sure you want to delete?')" href="cart.php?q=<?php echo $item["id"] ?>&o=delete"><img src="images/delete.png" width="25" height="25" lt="Delete Cart Item"/></a></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    }
                                } else if ($message == "") {
                                    ?>
                                    <tr>
                                        <td colspan="6" align="center" style="text-align: center">
                                            No items found in your order.
                                        </td>
                                    </tr>
                                    <?php
                                }
                                if (isset($message) || $message != "") {
                                    ?>
                                    <tr>
                                        <td colspan="6" align="center" style="text-align: center">
                                            <?php
                                            echo $message;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="6">
                                        <div align="center" style="text-align: center;">                     
                                            <input value="Confirm" type="submit" name="btnConfirm" id="btnConfirm" onclick="javascript:return confirm('Are you sure to confirm this order?');"  />
                                            <input value="Delete All" onclick="javascript:return confirm('Are you sure to clear your order?');" type="submit" name="btnClear" id="btnClear" />
                                            <input value="Print" onclick="printDiv()" type="button" name="btnPrint" id="btnPrint" />                       
                                            <input value="View order history" onclick="javascript:location.href = 'order-log.php'" type="button" name="btnOrderHistory" id="btnOrderHistory" />                        
                                        </div> 
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--endo-of-cart-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
