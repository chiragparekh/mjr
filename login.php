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
            #divLogin,#divRegister{
                margin:20px;
            }
            #divLogin{
                
            }
            #divRegister{
                
            }
        </style>

    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>
        <!--search-->   
        <div class="right-content">
            <div class="pro-name">
                <h1>Login</h1>
                <div class="content">
                    <div id="divLogin">
                        <table style="float: left">
                            <caption>
                                Login
                            </caption>
                            <tr>
                                <td>
                                    Email
                                </td>
                                <td>
                                    <input type="text" name="txtEmail" />
                                </td>
                            </tr>
                            <tr>
                                <td>
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
                        <table style="float: right">
                            <caption>
                                Register
                            </caption>                            
                            <tr>
                                <td>
                                    Email
                                </td>
                                <td>
                                    <input type="text" name="txtEmail" />
                                </td>
                            </tr>
                            <tr>
                                <td>
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
                    <div style="clear: both"></div>
                </div>
            </div>
        </div>
        <!--endo-of-search-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
