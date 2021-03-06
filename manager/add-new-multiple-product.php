<?php include_once "includes/checksession.php"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <title>Add New Multiple Products</title>

        <?php include_once "includes/common-css-js.php"; ?>

        <style type="text/css">
            #photogal{
                background-position: 0 -86px;
                border-top: 1px solid #657D92;}
            </style>

        </head>

        <body>

            <?php include_once "includes/leftside.php"; ?>



            <?php include_once "includes/rightside.php"; ?>    
            <!-- Title area -->
            <div class="titleArea">
            <div class="wrapper">
                <div class="pageTitle">
                    <h5>Add New Multiple Products</h5>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="line"></div>

        <!-- Main content wrapper -->
        <div class="wrapper">
            <br />
            <a style="margin: 5px;" class="button blueB" title="" href="product.php">
                <img class="icon" alt="" src="images/icons/light/view.png" />
                <span>View</span>
            </a>
            <?php
            include_once "includes/connection.php";
            include_once "includes/image.php";
            $con = new MySQL();
            if (isset($_POST['btnSubmit'])) {
                $pcount = count($_FILES['fileImage']['name']);
                $proflg = array();

                for ($i = 0; $i < $pcount; $i++) {
                    $cat = $_POST['lstCategory'];
                    $subCat = $_POST['lstSubCategory'];

                    $sel = "SHOW TABLE STATUS LIKE 'tbl_product'";
                    $crs = mysql_query($sel);
                    $cr = mysql_fetch_array($crs);
                    $count = intval($cr['Auto_increment']);
                    mysql_free_result($crs);

                    $sel = "select name from tbl_sub_category where id=" . $subCat;
                    $crs = mysql_query($sel);
                    $cr = mysql_fetch_array($crs);
                    $prodName = $cr[0] . " - " . $count;

                    $desc = $_POST['txtDesc'];

                    if (!is_dir("uploads")) {
                        mkdir("uploads");
                    }
                    if (!is_dir("uploads/thumbs")) {
                        mkdir("uploads/thumbs");
                    }
                    if (!is_dir("uploads/thumbs/" . $cr[0])) {
                        mkdir("uploads/thumbs/" . $cr[0]);
                    }
                    if (!is_dir("uploads/original")) {
                        mkdir("uploads/original");
                    }
                    if (!is_dir("uploads/original/" . $cr[0])) {
                        mkdir("uploads/original/" . $cr[0]);
                    }
                    $img_name = $_FILES['fileImage']['name'][$i];
                    $img_tmp_name = $_FILES['fileImage']['tmp_name'][$i];
                    $img_type = $_FILES['fileImage']['type'][$i];

                    $weight = substr($img_name, 0, strrpos($img_name, "."));

                    //$rs=mysql_query("select name from tbl_category where id=".$cat);
                    //$r=mysql_fetch_array($rs);
                    date_default_timezone_set('Asia/Calcutta');
                    $prod_img_path = str_replace(' ', '', $cr['name']) . '_' . str_replace(' ', '', $weight) . '_' . date('dmYHis') . '_' . $i;
                    $ext = "";
                    switch ($img_type) {
                        case "image/gif":
                            $ext = ".gif";
                            break;
                        case "image/bmp":
                            $ext = ".bmp";
                            break;
                        case "image/jpeg":
                            $ext = ".jpg";
                            break;
                        case "image/png":
                            $ext = ".png";
                            break;
                    }
                    $p = "uploads/original/" . $cr[0] . "/" . $prod_img_path . $ext;


                    if ($img_type == "image/gif" or $img_type == "image/bmp" or $img_type == "image/jpeg" or $img_type == "image/png") {
                        if ($cat != "-1" && $subCat != "-1" && $img_name != "") { //&& trim($weight)!=""
                            if (mysql_query("insert into tbl_product(sub_category_id,name,weight,description,image_path) values($subCat,'" . ucwords($prodName) . "',$weight,'$desc','" . $prod_img_path . $ext . "')")) {
                                move_uploaded_file($img_tmp_name, "uploads/original/" . $cr[0] . "/" . $prod_img_path . $ext);
                                $image = new SimpleImage();
                                /* original resize */
                                $image->load($p);
                                $image->resize(1024, 768);
                                $image->save("uploads/original/" . $cr[0] . "/" . $prod_img_path . $ext);
                                /* end of original resize */
                                $image->load($p);
                                $image->resize(150, 150);
                                $image->save("uploads/thumbs/" . $cr[0] . "/" . $prod_img_path . $ext);

                                $proflg[$i] = "1";
                                ?>
                                <div class="nNote nSuccess hideit">
                                    <p><strong>SUCCESS: </strong>New product saved successfully. :<?php echo $img_name ?></p>
                                </div>
                                <?php
                            } else {
                                $proflg[$i] = "0";
                                ?>
                                <div class="nNote nFailure hideit">
                                    <p><strong>FAILURE: </strong>Oops sorry. We are unable to save product. Please try again. :<?php echo $img_name ?></p>
                                </div>
                                <?php
                            }
                        } else {
                            $proflg[$i] = "0";
                            ?>
                            <div class="nNote nWarning hideit">
                                <p><strong>WARNING: </strong>Please provide all of the fields. :<?php echo $img_name ?></p>
                            </div>
                            <?php
                        }
                    } else {
                        $proflg[$i] = "0";
                        ?>
                        <div class="nNote nWarning hideit">
                            <p><strong>WARNING: </strong>Please select valid image. :<?php echo $img_name ?></p>
                        </div>
                        <?php
                    }
                }
                $flgcnt = 0;
                for ($i = 0; $i < $pcount; $i++) {
                    if ($proflg[$i] == 1)
                        $flgcnt++;
                }
                if ($flgcnt > 0) {
                    $useremailrs = mysql_query("select email from tbl_user where type like 'user'");
                    $useremails = "";
                    while ($row = mysql_fetch_array($useremailrs)) {
                        $useremails.=$row['email'] . ",";
                    }
                    $useremails = substr($useremails, 0, strlen($useremails) - 1);
                    $header = 'MIME-Version: 1.0' . "\r\n";
                    $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $header .= 'From: MJR Jewellers<manojranpara@ymail.com>' . "\r\n" .
                            'BCC: '.$useremails. "\r\n" .
                            'Reply-To: manojranpara@ymail.com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion() . "\r\n";
                    if ($flgcnt == 1) {
                        $message = "A new product is recently added in " . $cr['name'] . " category. Click this link to see this product <a href=\"http://www.mjrjewels.com/gallery.php?q=" . $subCat . "\">http://www.mjrjewels.com/gallery.php?q=" . $subCat . "</a>";
                    } else {
                        $message = "New products are recently added in " . $cr['name'] . " category. Click this link to see this product <a href=\"http://www.mjrjewels.com/gallery.php?q=" . $subCat . "\">http://www.mjrjewels.com/gallery.php?q=" . $subCat . "</a>";
                    }
                    if (!mail(null, "Notification about new product arrival in MJR Jewels website (www.mjrjewels.com)", $message, $header)) {
                        ?>
                        <div class="nNote nFailure hideit">
                            <p><strong>FAILURE: </strong>Oops sorry. We are unable to send notification mail to users.</p>
                        </div>
                        <?php
                    }
                }
            }
            $con->CloseConnection();
            ?>
            <form enctype="multipart/form-data" style="margin-top:20px;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form" id="validate">
                <fieldset>
                    <div class="widget" style="margin-top: 20px;">
                        <div class="title">
                            <img class="titleIcon" alt="" src="images/icons/dark/add.png" />
                            <h6>Add Multiple Products</h6>
                        </div>
                        <div class="formRow">
                            <label>Select Category:&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <select name="lstCategory" onchange="javascript:document.forms[0].submit();">
                                    <option selected="" value="-1">- - Select Category - -</option>
                                    <?php
                                    include_once "includes/connection.php";
                                    $con = new MySQL();
                                    $rs = mysql_query("select id,name from tbl_category");
                                    if (mysql_num_rows($rs) > 0) {
                                        while ($r = mysql_fetch_array($rs)) {
                                            if ((isset($_REQUEST['lstCategory']) && $_REQUEST['lstCategory'] != "-1" && $r['id'] == $_REQUEST['lstCategory']))
                                                $s = "selected=\"\"";
                                            else
                                                $s = "";
                                            ?>
                                            <option <?php echo $s; ?> value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
                                            <?php
                                        }
                                    }
                                    $con->CloseConnection();
                                    ?>
                                </select>
                                <a style="margin-left: 10px;" class="button blueB" title="" href="add-new-main-category.php">
                                    <img class="icon" alt="" src="images/icons/light/add.png" />
                                    <span>Add New Category</span>
                                </a>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Select Sub Category:&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <select name="lstSubCategory" >
                                    <option selected="" value="-1">- - Select Sub Category - -</option>
                                    <?php
                                    include_once "includes/connection.php";
                                    $con = new MySQL();
                                    $rs = mysql_query("select id,name from tbl_sub_category where category_id=" . $_REQUEST['lstCategory']);
                                    if (mysql_num_rows($rs) > 0) {
                                        while ($r = mysql_fetch_array($rs)) {
                                            if ((isset($_REQUEST['lstSubCategory']) && $_REQUEST['lstSubCategory'] != "-1" && $r['id'] == $_REQUEST['lstSubCategory']))
                                                $s = "selected=\"\"";
                                            else
                                                $s = "";
                                            ?>
                                            <option <?php echo $s; ?> value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
                                            <?php
                                        }
                                    }
                                    $con->CloseConnection();
                                    ?>
                                </select>
                                <a style="margin-left: 10px;" class="button blueB" title="" href="add-new-category.php">
                                    <img class="icon" alt="" src="images/icons/light/add.png" />
                                    <span>Add New Sub Category</span>
                                </a>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Description:</label>
                            <div class="formRight">
                                <textarea name="txtDesc" id="txtDesc" ></textarea>
                                <span style="color: red;">This will be common description for all products</span>
                            </div><div class="clear"></div>
                        </div>
                        <div class="formRow">
                            <label>Select Image(s):&nbsp;<span class="req">*</span></label>
                            <div class="formRight">
                                <input accept="image/*" multiple="" type="file" id="fileImage" name="fileImage[]" class="validate[required]" />
                                <br />
                                <span style="color: red;">Weight for each product will be taken from selected image(s)</span>
                            </div><div class="clear"></div>
                        </div>

                        <div class="formSubmit" style="float: left">
                            <input type="submit" class="redB" name="btnSubmit" value="save" />
                        </div>
                        <div class="clear"></div>
                    </div>
                </fieldset>
            </form>
        </div>

        <?php include_once "includes/footer.php"; ?>   

    </body>
</html>