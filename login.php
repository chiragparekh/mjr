<?php session_start(); ?>
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
        <script src="js/jquery.validate.min.js"></script>
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

                $("#login-form").validate({
                    // Specify the validation rules
                    rules: {
                        txtLoginEmail: {
                            required: true,
                            email: true
                        },
                        txtLoginPassword: {
                            required: true
                        }
                    },
                    // Specify the validation error messages
                    messages: {
                        txtLoginPassword: {
                            required: "<br/>Password required"
                        },
                        txtLoginEmail: "<br/>Invalid email address"
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });

                $("#reg-form").validate({
                    // Specify the validation rules
                    rules: {
                        txtCompName: "required",
                        txtContPerson: "required",
                        txtEmail: {
                            required: true,
                            email: true
                        },
                        txtPassword: "required",
                        txtRepeatPassword: {
                            required: true,
                            equalTo: "#txtPassword"
                        },
                        txtContNumber: "required",
                        txtAddr: "required",
                        txtState: "required",
                        txtCity: "required",
                        txtZipCode: "required"
                    },
                    // Specify the validation error messages
                    messages: {
                        txtCompName: "<br/>Company Name required",
                        txtContPerson: "<br/>Contact Perosn required",
                        txtPassword: "<br/>Password required",
                        txtEmail: {required: "<br/>Email required", email:"<br/>Invalid email"},
                        txtRepeatPassword: {equalTo: "<br/>Passwords must be match.", required: "<br/>Repeat Passowrd required"},
                        txtContNumber: "<br/>Contact Number required",
                        txtAddr: "<br/>Address required",
                        txtState: "<br/>State required",
                        txtCity: "<br/>City required",
                        txtZipCode: "<br/>Zip Code required"
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
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
                        <form id="login-form" onsubmit="javascript:validateLoginForm()" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <table cellpadding="5">
                                <caption class="tbl-caption">
                                    Login
                                </caption>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Email
                                    </td>
                                    <td>
                                        <input type="text" name="txtLoginEmail" id="txtLoginEmail" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Password
                                    </td>
                                    <td>
                                        <input type="password" name="txtLoginPassword" id="txtLoginPassword" />
                                    </td>
                                </tr>                        
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="submit" name="btnLogin" value="Login" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <div id="loginmsg">
                                            <?php
                                            if (isset($_POST['btnLogin'])) {

                                                $email = trim($_POST['txtLoginEmail']);
                                                $password = md5(trim($_POST['txtLoginPassword']));

                                                if ($email == "" || $password == "") {
                                                    echo "Please provide email and password";
                                                } else {
                                                    include_once './includes/connection.php';
                                                    $con = new MySQL();
                                                    $sel = "select id from tbl_user where email like '$email' and password like '$password' and type='user'";
                                                    $rs = mysql_query($sel);
                                                    if (mysql_num_rows($rs) > 0) {
                                                        $r = mysql_fetch_array($rs);
                                                        $id = $r['id'];
                                                        $sel = "select is_confirm from tbl_user where id=" . $id;
                                                        $rs = mysql_query($sel);
                                                        $r = mysql_fetch_array($rs);
                                                        if (intval($r['is_confirm']) == 1) {

                                                            $sel = "select is_approve,company_name from tbl_user where id=" . $id;
                                                            $rs = mysql_query($sel);
                                                            $r = mysql_fetch_array($rs);
                                                            if (intval($r['is_approve']) == 1) {
                                                                echo "Logged in successfully. Please wait...";
                                                                $_SESSION['userid'] = $id;
                                                                $_SESSION['company'] = $r['company_name'];
                                                                echo '<script> window.location="index.php"; </script>';
                                                            } else {
                                                                echo "Your approval is still pending.";
                                                            }
                                                        }
                                                        else{
                                                            echo "Please confirm your account.";
                                                        }
                                                    } else {
                                                        echo "Invalid email or password. Please try again";
                                                    }
                                                    $con->CloseConnection();
                                                }
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div id="divRegister">
                        <form id="reg-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <table cellpadding="5">
                                <caption class="tbl-caption">
                                    Register
                                </caption>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Company Name
                                    </td>
                                    <td>
                                        <input value="<?php echo (isset($_POST['txtCompName'])) ? $_POST['txtCompName'] : "" ?>" type="text" name="txtCompName" id="txtCompName" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Contact Person
                                    </td>
                                    <td>
                                        <input value="<?php echo (isset($_POST['txtContPerson'])) ? $_POST['txtContPerson'] : "" ?>" type="text" name="txtContPerson" id="txtContPerson" />
                                    </td>
                                </tr>                        
                                <tr>
                                    <td class="pull-right valign-top">
                                        Email
                                    </td>
                                    <td>
                                        <input value="<?php echo (isset($_POST['txtEmail'])) ? $_POST['txtEmail'] : "" ?>" type="text" name="txtEmail" id="txtEmail" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Password
                                    </td>
                                    <td>
                                        <input value="<?php echo (isset($_POST['txtPassword'])) ? $_POST['txtPassword'] : "" ?>" type="password" name="txtPassword" id="txtPassword" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Repeat Password
                                    </td>
                                    <td>
                                        <input value="<?php echo (isset($_POST['txtRepeatPassword'])) ? $_POST['txtRepeatPassword'] : "" ?>" type="password" name="txtRepeatPassword" id="txtRepeatPassword" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Contact Number
                                    </td>
                                    <td>
                                        <input value="<?php echo (isset($_POST['txtContNumber'])) ? $_POST['txtContNumber'] : "" ?>" type="text" name="txtContNumber" id="txtContNumber" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Address
                                    </td>
                                    <td>
                                        <textarea name="txtAddr" id="txtAddr" style="min-width: 150px;max-width: 150px;width: 150px;"><?php echo (isset($_POST['txtAddr'])) ? $_POST['txtAddr'] : "" ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        State
                                    </td>
                                    <td>
                                        <input value="<?php echo (isset($_POST['txtState'])) ? $_POST['txtState'] : "" ?>" type="text" name="txtState" id="txtState" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        City
                                    </td>
                                    <td>
                                        <input value="<?php echo (isset($_POST['txtCity'])) ? $_POST['txtCity'] : "" ?>" type="text" name="txtCity" id="txtCity" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pull-right valign-top">
                                        Zip Code
                                    </td>
                                    <td>
                                        <input value="<?php echo (isset($_POST['txtZipCode'])) ? $_POST['txtZipCode'] : "" ?>" type="text" name="txtZipCode" id="txtZipCode" />
                                    </td>
                                </tr>                        
                                <tr>
                                    <td colspan="2" align="center">
                                        <input type="submit" name="btnRegister" value="Register" />
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <div id="regmsg">
                                            <?php
                                            if (isset($_POST['btnRegister'])) {
                                                $compName = trim($_POST['txtCompName']);
                                                $contPerson = trim($_POST['txtContPerson']);
                                                $email = trim($_POST['txtEmail']);
                                                $password = trim($_POST['txtPassword']);
                                                $repeatPassword = trim($_POST['txtRepeatPassword']);
                                                $contNumber = trim($_POST['txtContNumber']);
                                                $address = trim($_POST['txtAddr']);
                                                $city = trim($_POST['txtCity']);
                                                $state = trim($_POST['txtState']);
                                                $zipCode = trim($_POST['txtZipCode']);

                                                if ($compName == "" || $contPerson == "" || $email == "" || $password == "" || $repeatPassword == "" || $contNumber == "" || $address == "" || $city == "" || $state == "" || $zipCode == "") {
                                                    echo "Please fill compelete form";
                                                } else {
                                                    if ($password == $repeatPassword) {
                                                        include_once './includes/connection.php';
                                                        $con = new MySQL();
                                                        $rs = mysql_query("select id from tbl_user where email like '$email'");
                                                        if (mysql_num_rows($rs) > 0) {
                                                            echo "This email is already registered.";
                                                        } else {
                                                            $random = md5(rand());
                                                            $md5password = md5($password);
                                                            $ins = "insert into tbl_user(company_name,contact_person,email,password,contact_no,address,city,state,zip_code,type,random)"
                                                                    . " values('$compName','$contPerson','$email','$md5password','$contNumber','$address','$city','$state','$zipCode','user','$random')";
                                                            if (mysql_query($ins)) {
                                                                $id = md5(mysql_insert_id());
                                                                $subject = 'Manojkumar Jayntilal Ranpara Jewels - Confirmation link';
                                                                $message = 'Click this link to confirm your account : ';
                                                                //$message .= 'http://www.mjrjewels.com/confirm-account.php?auth='. $random.'&id='.$id;
                                                                $message .= 'http://localhost/mjr/confirm-account.php?auth=' . $random . '&id=' . $id;
                                                                $headers = "From: admin@mjrjewels.com" . "\r\n";
                                                                $message = stripslashes($message);
                                                                mail($email, $subject, $message, $headers);
                                                                mail("manojranpara@ymail.com", "New User Registration", "A new user has registered recently.Please go to admin panel and approve as per condition. Please note that user may or may not have confirmed his/her email", $headers);
                                                                echo "You are registered.<br/>A confirmation link is sent to your email address.<br/>Please confirm your account from there.";
                                                            } else {
                                                                echo "Unable to register";
                                                            }
                                                            $con->CloseConnection();
                                                        }
                                                    } else {
                                                        echo "Passwords must be match";
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <!--endo-of-search-->
        <?php include_once 'includes/footer.php'; ?>
    </body>
</html>
