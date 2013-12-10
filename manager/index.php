<?php session_start(); ?>

<?php

    if(isset($_SESSION['user_id']))

        header("location:home.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />

<title>Login</title>

<link href="css/main.css" rel="stylesheet" type="text/css" />



<?php //include_once "includes/common-css-js.php";?>



</head>



<body class="nobg loginPage">



<!-- Top fixed navigation -->

<div class="topNav">

    <div class="wrapper">

        <div class="userNav">

            <ul>

                <li><a href="http://www.mjrjewels.com/" title="MJR Jewellers"><img src="images/icons/topnav/mainWebsite.png" alt="" /><span>Main website</span></a></li>

            </ul>

        </div>

        <div class="clear"></div>

    </div>

</div>





<!-- Main content wrapper -->

<div class="loginWrapper">

    
    
    <?php

            if(!isset($_POST['submit'])){
    ?>
    <div class="loginLogo"><img src="images/mjr-logo-2.png" alt="MJR Jewel" /></div>
    <div class="widget">

        <div class="title"><img src="images/icons/dark/files.png" alt="" class="titleIcon" /><h6>Login panel</h6></div>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="validate" class="form">

            <fieldset>

                <div class="formRow">

                    <label for="login">Username:</label>

                    <div class="loginInput"><input type="text" name="login" class="validate[required]" id="login" /></div>

                    <div class="clear"></div>

                </div>

                

                <div class="formRow">

                    <label for="pass">Password:</label>

                    <div class="loginInput"><input type="password" name="password" class="validate[required]" id="pass" /></div>

                    <div class="clear"></div>

                </div>

                

                <div class="loginControl">

                    <input name="submit" type="submit" value="Log me in" class="dredB logMeIn" />

                    <div class="clear"></div>

                </div>

            </fieldset>

        </form>

        <div class="clear"></div>

        <?php
            }
            else if(isset($_POST['submit'])){

                include_once('includes/connection.php');

                $con = new MySQL();

                $username = $_POST['login'];
                $username=mysql_real_escape_string($username);

                $password = $_POST['password'];
                $password=mysql_real_escape_string($password);

                $q="select * from tbl_user where email='$username' and password='$password' and type='admin'";                

                $result = mysql_query($q);

                if(mysql_num_rows($result)>0){

                    while($r=mysql_fetch_array($result))

                    {

                        $_SESSION['user_id']=$r['id'];

                        //$_SESSION['user_fnm']=$r['company_name'];   

                    }

                    //header('location:index.html');

        ?>

                   <div class="nNote nSuccess hideit">

                        <p><strong>SUCCESS: </strong>Login Successfully. Redirecting...</p>

                    </div>

        <?php

                   echo "<script type=\"text/javascript\">window.location='home.php'</script>";

                }else{               

          ?>
          <a href="<?php echo $_SERVER['PHP_SELF']?>">
          <div class="nNote nFailure hideit">

            <p><strong>FAILURE: </strong>Oops sorry. Invalid Username or Password.<br /><strong>Click here to try again...</strong></p>

          </div>
          </a>
          <?php        

                }

                $con->CloseConnection();              

            }

            

        ?>

        

    </div>

    

    

</div>   

</body>

</html>