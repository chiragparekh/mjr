<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Contact Us :: Manojkumar Jayantilal Ranpara - mjrjewels.com</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            #address
            {
                float:left;
                margin-left: 20px;
            }
            #feedback
            {
                float: right;
                margin-right: 20px;
            }
            .contact-us-content
            {
                background: none repeat scroll 0 0 #DECEFD;
                float: left;
                margin: 15px 0 15px 15px;
                width: 685px;
            }
            #feedback-form input[type=text],#feedback-form textarea
            {
                min-width:160px;
                width: 160px;
                max-width: 160px;
            }
        </style>
        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <script>
            !window.jQuery && document.write('<script src="jquery-1.4.3.min.js"><\/script>');
        </script>
        <script src="js/jquery.validate.min.js"></script>
        <script type="text/javascript">
            <!--//---------------------------------+
        //  Developed by Roshan Bhattarai 
            //  Visit http://roshanbh.com.np for this script and more.
            //  This notice MUST stay intact for legal use
            // --------------------------------->
            $(document).ready(function()
            {
                $("#contact-us").addClass("active");
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

                $("#feedback-form").validate({
                    // Specify the validation rules
                    rules: {
                        name: "required",
                        email: {
                            required: true,
                            email: true
                        },
                        mobile: "required",
                        description: "required",
                        captcha: "required"
                    },
                    // Specify the validation error messages
                    messages: {
                        name: "",
                        email: {required: "", email: "<br/>Invalid email"},
                        mobile: "",
                        description: "",
                        captcha: ""
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            });
        </script>


    </head>
    <body>
        <?php include_once 'includes/header.php'; ?>
        <?php include_once 'includes/sidebar.php'; ?>
        <!--contact-us-->   
        <div class="right-content">
            <div class="pro-name">
                <h1>Contact Us</h1>
                <div class="contact-us-content">
                    <br />
                    <div id="address">
                        <table cellpadding="5px">
                            <caption class="tbl-caption"><u>Address</u></caption>
                            <tr>
                                <td style="color: #654E9D;line-height: 160%;font-weight: bold">
                                    12-Panna Manek Complex,<br />
                                    Opp. Ashapura Temple, Palace Road,<br />
                                    Rajkot<br /> 
                                    Ph:0281-2220075<br />
                                    email: <a style="color:#654E9D" href="mailto:manojranpara@ymail.com">manojranpara@ymail.com</a><br />
                                    website: <a style="color: #654E9D" href="http://www.mjrjewels.com">www.mjrjewels.com</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id="feedback">
                        <form id="feedback-form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <table cellpadding="5">
                                <caption class="tbl-caption"><u>Feedback</u></caption>
                                <tr>
                                    <td colspan="2" align="right" ><span class="required">*</span> - fields are required</td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Name 
                                    </td>
                                    <td>
                                        <input type="text" name="name"  /><span class="required">*</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Email 
                                    </td>
                                    <td>
                                        <input type="text" name="email" /><span class="required">*</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Mobile
                                    </td>
                                    <td>
                                        <input type="text" name="mobile" /><span class="required">*</span>
                                    </td>
                                </tr>   
                                <tr>
                                    <td class="pull-right valign-top">
                                        Description 
                                    </td>
                                    <td>
                                        <textarea name="description" ></textarea><span class="required">*</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        <span >Enter Image Text</span>
                                    </td>
                                    <td>
                                        <input name="captcha" type="text" style="margin-bottom:  5px;" /><span class="required">*</span><br />
                                        <img src="captcha.php" />
                                    </td>      
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center;" align="center">
                                        <?php
                                        if (isset($_POST['btnSubmit'])) {
                                            include_once './includes/connection.php';
                                            $con = new MySQL();
                                            $name = mysql_real_escape_string(trim($_POST['name']));
                                            $email = mysql_real_escape_string(trim($_POST['email']));
                                            $mobile = mysql_real_escape_string(trim($_POST['mobile']));
                                            $description = mysql_real_escape_string(trim($_POST['description']));
                                            $code = mysql_real_escape_string(trim($_POST['captcha']));

                                            if ($name == "") {
                                                echo "<span class=\"required\">Name required</span>";
                                            } else if ($email == "") {
                                                echo "<span class=\"required\">Email required</span>";
                                            } else if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
                                                echo "<span class=\"required\">Invalid email</span>";
                                            } else if ($description == "") {
                                                echo "<span class=\"required\">Description required</span>";
                                            } else if ($code == "") {
                                                echo "<span class=\"required\">Image Text required</span>";
                                            } else if ($_SESSION["code"] != $code) {
                                                echo "<span class=\"required\">Incorrect Image Text</span>";
                                            } else {
                                                $q = "insert into tbl_feedback(name,email,mobile,content) values('$name','$email','$mobile','$description')";
                                                if (mysql_query($q) > 0) {
                                                    echo "<span style=\"color:green;font-weight:bold;font-size:13px\">Thank you for your valuable feedback</span>";
                                                    $headers = "From: " . $name . "<" . $email . ">" . "\r\n" .
                                                            'Reply-To: ' . $email . "\r\n";
                                                    if (!mail("manojranpara@ymail.com", "Feedback is given in MJR Jewel website", "Following is detail for this feedback.\n\nName: $name\nEmail: $email\nMobile.: $mobile\nDescription: $description", $headers)) {
                                                        ?>
                                                        <span class="required">Unable to send feedback mail.</span>
                                                        <?php
                                                    }
                                                }
                                            }
                                            $con->CloseConnection();
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="submit" name="btnSubmit" value="Send" />
                                    </td>                              
                                </tr>            
                            </table>
                        </form>
                    </div>
                    <div class="clear">

                    </div>
                </div>
            </div>
        </div>
        <!--endo-of-contact-us-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
