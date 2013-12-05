<?php
session_start();
if (!isset($_GET['id']) || $_GET['id'] == "") {
    header("location:cart.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Edit Cart Product:: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
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
                $("#about-us").addClass("active");
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
        <!--about-us-->   
        <div class="right-content">
            <div class="pro-name">
                <h1>Edit Cart Product</h1>
                <?php
                $pro_name = $_GET['name'];
                $pro_id = $_GET['id'];
                $pro_qty = $_GET['qty'];
                $pro_desc = $_GET['desc'];
                ?>
                <?php
                $message = "";
                if (isset($_POST['btnEdit'])) {
                    $qty = $_POST["txtQty"];
                    $desc = $_POST["txtDesc"];
                    if ($qty == "") {
                        $message = "Provide quantity.";
                    } else if ($desc == "") {
                        $message = "Provide description.";
                    } else {
                        foreach ($_SESSION['cart'] as $key => $value) {
                            if ($value["id"] == $pro_id) {
                                $_SESSION['cart'][$key]["qty"] = $qty;
                                $_SESSION['cart'][$key]["desc"] = $desc;
                                $message = "Item edited successfully.";
                                break;
                            }
                        }
                    }
                }
                if (isset($_POST['btnCancel'])) {
                    ?>
                    <script type="text/javascript">
                        window.location = "cart.php";
                    </script>
                    <?php
                }
                if (isset($_POST['btnBack'])) {
                    ?>
                    <script type="text/javascript">
                        window.location = "cart.php";
                    </script>
                    <?php
                }
                ?>
                <div class="content" style="min-height: 512px">                    
                    <form method="post">
                        <table style="margin:10px">
                            <tr>
                                <td>
                                    Name
                                </td>
                                <td>
                                    <?php echo $pro_name ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Quantity
                                </td>
                                <td>
                                    <input type="text" name="txtQty" value="<?php echo (isset($_POST['txtQty']))?$_POST['txtQty']:$pro_qty ?>"/>                                    
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top">
                                    Description
                                </td>
                                <td>
                                    <textarea name="txtDesc" rows="5" cols="30"><?php echo (isset($_POST['txtDesc']))?$_POST['txtDesc']:trim(htmlspecialchars($pro_desc)) ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <?php echo $message; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="submit" name="btnEdit" value="Edit"/>
                                    <input type="submit" name="btnCancel" value="Cancel"/>
                                    <input type="submit" name="btnBack" value="Back"/>
                                </td>                               
                            </tr>
                        </table>
                    </form>                
                </div>
            </div>
        </div>
        <!--endo-of-about-us-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>