<?php include_once './includes/checksession.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Order Cart :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
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
        <!--cart-->   
        <div class="right-content">
            <div class="pro-name">
                <h1>Order / Inquiry Cart</h1><div class="clear"></div>
                <div style="float: right;margin-right: 55px;margin-top: 5px;">
                    <a style="font-weight: bold;color: #DBCBFF;" href="order-log.php">View Order History</a>
                </div>
                <div class="content">
                    <table cellpadding="5" border="1" rules="all" style="margin:10px 10px">
                        <tr class="heading">
                            <th style="width:130px">Product Name</th>
                            <th>Weight</th>
                            <th>Quantity</th>
                            <th style="width:200px">Description</th>
                            <th style="width: 70px;">Image</th>
                            <th style="width: 100px;">Edit</th>
                        </tr>
                        <?php
                        if (isset($_SESSION['cart'])) {
                            $items = $_SESSION['cart'];
                            $str_items = implode(",", $items);
                            include_once "includes/connection.php";
                            $con = new MySQL();
                            $q = "select p.name as name,sc.name as sub_name,p.weight as weight,p.image_path as path from tbl_product p inner join tbl_sub_category sc on p.sub_category_id=sc.id where p.id in (" . $str_items . ")";
                            $result = mysql_query($q);
                            while ($r = mysql_fetch_array($result)) {
                                ?>
                                <tr>
                                    <td align="center"><?php echo $r["name"]; ?></td>
                                    <td align="center"><?php echo $r["weight"]; ?></td>
                                    <td><?php echo ""; ?></td>
                                    <td><?php echo ""; ?></td>
                                    <td align="center"><img width="80" height="80" src="<?php echo "manager/uploads/thumbs/".$r["sub_name"]."/".$r["path"] ?>" /></td>
                                    <td>Edit | Delete</td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6" align="center">
                                    No items found in your order.
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td colspan="6">
                                <div align="center" style="text-align: center;">                     
                                    <input value="Confirm" type="submit" name="btnConfirm" id="btnConfirm" />
                                    <input value="Delete All" type="submit" name="btnClear" id="btnClear" />
                                    <input value="Print" onclick="printDiv()" type="button" name="btnPrint" id="btnPrint" />                        
                                </div> 
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!--endo-of-cart-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
