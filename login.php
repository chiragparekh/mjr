<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
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
                    $(this).css({backgroundImage:"url(down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
                    $(this).siblings().css({backgroundImage:"url(left.png)"});
                });
                //slides the element with class "menu_body" when mouse is over the paragraph
                $("#secondpane p.menu_head").mouseover(function()
                {
                    $(this).css({backgroundImage:"url(down.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
                    $(this).siblings().css({backgroundImage:"url(left.png)"});
                });
            });
        </script>
        <style>
            #divLogin{
                background-image: url("images/div-bg.png");
                border-radius: 4px;
                -moz-border-radius: 4px;
                -webkit-border-radius: 4px;
                border: 1px solid transparent;
                float: left;
                padding: 10px;
            }
            #divRegister{
                background-image: url("images/div-bg.png");
                border-radius: 4px;
                -moz-border-radius: 4px;
                -webkit-border-radius: 4px;
                border: 1px solid transparent;
                float: right;
                padding: 10px;
            }
        </style>

    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>
        <!--search-->   
        <div class="right-content">
            <div class="pro-name">
                <h1>Login / Register</h1>
                <div class="content" style="background-color: transparent;">
                    <div id="divLogin">
                        <table cellpadding="5">
                            <caption class="tbl-caption">
                                Login
                            </caption>
                            <tr>
                                <td class="pull-right">
                                    Email
                                </td>
                                <td>
                                    <input type="text" name="txtEmail" />
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    Password
                                </td>
                                <td>
                                    <input type="password" name="txtPassword" />
                                </td>
                            </tr>                        
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="submit" name="btnLogin" value="Login" />
                                </td>
                            </tr>                        
                        </table>
                    </div>
                    <div id="divRegister">
                        <table cellpadding="5">
                            <caption class="tbl-caption">
                                Register
                            </caption>
                            <tr>
                                <td class="pull-right">
                                    Company Name
                                </td>
                                <td>
                                    <input type="text" name="txtEmail" />
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    Contact Person
                                </td>
                                <td>
                                    <input type="text" name="txtEmail" />
                                </td>
                            </tr>                        
                            <tr>
                                <td class="pull-right">
                                    Email
                                </td>
                                <td>
                                    <input type="text" name="txtEmail" />
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    Password
                                </td>
                                <td>
                                    <input type="password" name="txtPassword" />
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    Repeat Password
                                </td>
                                <td>
                                    <input type="password" name="txtPassword" />
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    Contact Number
                                </td>
                                <td>
                                    <input type="text" name="txtEmail" />
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right valign-top">
                                    Address
                                </td>
                                <td>
                                    <textarea name="txtAddr" style="min-width: 150px;max-width: 150px;width: 150px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    State
                                </td>
                                <td>
                                    <input type="text" name="txtEmail" />
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    City
                                </td>
                                <td>
                                    <input type="text" name="txtEmail" />
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    Zip Code
                                </td>
                                <td>
                                    <input type="text" name="txtEmail" />
                                </td>
                            </tr>                        
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="submit" name="btnLogin" value="Register" />
                                </td>
                            </tr>                        
                        </table>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <!--endo-of-search-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
