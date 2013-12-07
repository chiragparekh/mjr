<?php include_once './includes/checksession.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Order History :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/table.css" media="screen"/>
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
                <h1>Order / Inquiry History</h1>
                <div class="content">
                    <div class="CSSTableGenerator" id="csstablediv">
                        <table cellpadding="5" border="1" rules="all" style="margin:10px auto;">
                            <tr class="heading">
                                <td style="width:130px">Product Name</td>
                                <td>Weight</td>
                                <td>Quantity</td>
                                <td style="width:170px">Description</td>
                                <td style="width: 100px;">Date</td>
                                <td style="width: 70px;">Image</td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <div align="center" style="text-align: center;">                     
                                        <input value="Export to Excel" type="submit" name="btnConfirm" id="btnConfirm" />                        
                                    </div> 
                                </td>
                            </tr>                            
                            <?php
                            include_once 'includes/connection.php';
                            $con = new MySQL();
                            $q = "select o.order_date as o_date,sc.name as sc_name,p.name as name,p.weight as weight,o.product_qty as qty,o.product_desc as descr,p.image_path as path from tbl_order o inner join tbl_product p on o.product_id=p.id inner join tbl_sub_category sc on p.sub_category_id=sc.id";
                            $result = mysql_query($q);
                            if (mysql_num_rows($result) > 0) {
                                while ($r = mysql_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $r["name"]; ?></td>
                                        <td><?php echo $r["weight"]; ?></td>
                                        <td><?php echo $r["qty"]; ?></td>
                                        <td><?php echo $r["descr"]; ?></td>
                                        <td><?php echo date('d-m-Y', strtotime($r["o_date"])); ?></td>
                                        <td><img width="80" height="80" src="<?php echo "manager/uploads/thumbs/" . $r["sc_name"] . "/" . $r["path"] ?>" /></td>                                        
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6" align="center">
                                        No products found in your order.
                                    </td>
                                </tr>       
                                <?php
                            }
                            ?>
                            <tr>
                                <td colspan="6">
                                    <div align="center" style="text-align: center;">                     
                                        <input value="Export to Excel" type="submit" name="btnConfirm" id="btnConfirm" />                        
                                    </div> 
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--endo-of-cart-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
