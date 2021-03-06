<div id="wrapper">
    <div id="header">
        <div class="header-top">
            <div class="logo"><a href="index.php"><img src="images/Logo.png" height="104" width="103" alt="" /></a></div>
            <div class="logo-name"><a href="index.php"><img src="images/Logo-name.png" height="35" width="378" alt="" /></a></div>
            <div class="login">
                <span>
                    <?php
                    if (isset($_SESSION['userid'])) {
                        ?>
                    
                        Welcome, <?php echo $_SESSION['company'] ?> ! | 
                        <a onmouseover="javascript:this.style.color='white'" onmouseout="javascript:this.style.color='#DBCBFF'" style="font-weight: bold;color: #DBCBFF;" href="logout.php">Logout</a>
                        <a title="View Order Cart" href="cart.php">                            
                            <div class="cart">                                
                                <span style="color: white;font-family: verdana;font-size: 12px;margin-top: 13px;">&nbsp;&nbsp;Selected Items</span>
                                <img src="images/cart.png" width="36" height="40" alt="" />
                            </div>
                        </a>
                        <div style="margin-top: 6px;">
                            <a onmouseover="javascript:this.style.color='white'" onmouseout="javascript:this.style.color='#DBCBFF'" style="font-weight: bold;color: #DBCBFF;" href="order-log.php">View Order History</a>
                        </div>
                        <?php
                    } else {
                        ?>
                        <a style="font-weight: bold;color: #DBCBFF;"onmouseover="javascript:this.style.color='white'" onmouseout="javascript:this.style.color='#DBCBFF'" href="login.php">Login | Register</a>    
                        <?php
                    }
                    ?>

                </span>
            </div>
        </div>
        <!--Navigation-->
        <div class="menu">
            <ul>
                <li><a id="home" href="index.php">Home</a></li>
                <li><a id="about-us" href="about-us.php">About Us</a></li>
                <li><a id="gallery" href="category.php">Gallery</a></li>
                <li><a id="latest-arrivals" href="latest-arrivals.php">Latest Arrivals</a></li>                
                <li><a id="advance-search" href="search.php">Advance Search</a></li>
                <li><a id="contact-us" href="contact-us.php">Contact Us</a></li>
                <li><a id="sitemap" href="sitemap.php">Sitemap</a></li>    
            </ul>
        </div>
        <!--Navigation-->
    </div>
    <div id="content-area">