<?php
include '../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$title = '';
$details = '';
$logo = '';
$banner = '';
$link = '';
$is_featured = '';
$status = '';
$renameFile = '';
$renameFile_1 = '';
$social_impact_update_on = date('Y-m-d H:i:s');
$flag = 0;

if (isset($_GET['id'])) {
    $si_id = $_GET['id'];
}

// Save member information
if (isset($_POST['updateSocialImpact'])) {
    extract($_POST);

    $title = validateInput($title);
    $details = validateInput($details);
    $link = validateInput($link);
    $is_featured = validateInput($is_featured);
    $status = validateInput($status);

    // Redirect URL if member id not found
    if ($si_id == '') {
        $link = baseUrl() . "views/social_impact/add.php";
        redirect($link);
    } else {
        // Logo image upload code
            if ($_FILES['logo']['name']) { // Check if image file posted or not
                $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/social_impact/logo/'; // Target directory where image will save or store
                $targetFile = '';
                $fileType = pathinfo(basename($_FILES['logo']['name']), PATHINFO_EXTENSION);
                // File type such as .jpg, .png, .jpeg, .gif
                if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif' && $fileType != 'JPG') { // Check file is in mentioned format or not
                    $flag++;
                    $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
                } else {
                    if ($_FILES['logo']['size'] > (1024000)) { // Check file size. File size must be less than 1MB
                        $flag++;
                        $error = 'Image size is too large. Must be less than 1MB';
                    } else {
                        $renameFile = "CM_LOGO" . date('YmdHis') . '.' . $fileType; // Rename the file name
                        $targetFile = $targetDirectory . $renameFile; // Target image file
                        move_uploaded_file($_FILES['logo']['tmp_name'], $targetFile);
                        $flag = 0;
                    }
                }
            }
            
            // Banner image upload code
            if ($_FILES['banner']['name']) { // Check if image file posted or not
                $targetDirectory_1 = $config['IMAGE_UPLOAD_PATH'] . '/social_impact/banner/'; // Target directory where image will save or store
                $targetFile_1 = '';
                $fileType_1 = pathinfo(basename($_FILES['banner']['name']), PATHINFO_EXTENSION);
                // File type such as .jpg, .png, .jpeg, .gif
                if ($fileType_1 != 'jpg' && $fileType_1 != 'png' && $fileType_1 != 'jpeg' && $fileType_1 != 'gif' && $fileType_1 != 'JPG') { // Check file is in mentioned format or not
                    $flag2++;
                    $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
                } else {
                    if ($_FILES['banner']['size'] > (1024000)) { // Check file size. File size must be less than 1MB
                        $flag2++;
                        $error = 'Image size is too large. Must be less than 1MB';
                    } else {
                        $renameFile_1 = "CM_BAN" . date('YmdHis') . '.' . $fileType_1; // Rename the file name
                        $targetFile_1 = $targetDirectory_1 . $renameFile_1; // Target image file
                        move_uploaded_file($_FILES['banner']['tmp_name'], $targetFile_1);
                        $flag2 = 0;
                    }
                }
            }
        // Image upload code end
        if ($flag == 0) {
            $customArray = '';
            $customArray .= 'title = "' . $title . '"';
            $customArray .= ',detail = "' . $detail . '"';
            $customArray .= ',link = "' . $link . '"';
            $customArray .= ',is_featured = "' . $is_featured . '"';
            $customArray .= ',status = "' . $status . '"';
            $customArray .= ',created_at = "' . $social_impact_update_on . '"';
            
            if ($_FILES["logo"]["tmp_name"] != '') {
                $customArray .= ', logo = "' . $renameFile . '"';
                //Image delete query when updated rows and set new image
                $sqlImage = "SELECT * FROM social_impact WHERE id=$si_id";
                $resultImage = mysqli_query($con, $sqlImage);
                $dataImage = mysqli_fetch_array($resultImage);
                @unlink($config['IMAGE_UPLOAD_PATH'] . '/social_impact/logo/' . $dataImage["logo"]);
            }
            
            if ($_FILES["banner"]["tmp_name"] != '') {
                $customArray .= ', banner = "' . $renameFile_1 . '"';
                //Image delete query when updated rows and set new image
                $sqlImage = "SELECT * FROM social_impact WHERE id=$si_id";
                $resultImage = mysqli_query($con, $sqlImage);
                $dataImage = mysqli_fetch_array($resultImage);
                @unlink($config['IMAGE_UPLOAD_PATH'] . '/social_impact/banner/' . $dataImage["banner"]);
            }

            //Updated social_impact data
            $sqlUpdateSocialImpact = "UPDATE social_impact SET $customArray WHERE id=$si_id";
            $resultUpdateSocialImpact = mysqli_query($con, $sqlUpdateSocialImpact);
            if ($resultUpdateSocialImpact) {
                $success = "Social Impact information updated successfully";
            } else {
                $error = "Social Impact information update failed for " . mysqli_error($con);
            }
        }
    }
}

// Get member data
$sqlGetData = "SELECT * FROM social_impact WHERE id=$si_id";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $title = $objGetData->title;
    $detail = $objGetData->detail;
    $logo = $objGetData->logo;
    $banner = $objGetData->banner;
    $link = $objGetData->link;
    $is_featured = $objGetData->is_featured;
    $status = $objGetData->status;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hydeventures - Edit Social Impact Item</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php include basePath('admin/header_script.php'); ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php include basePath('admin/header.php'); ?>
            <?php include basePath('admin/sidebar.php'); ?>

            <div class="content-wrapper">
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-group">
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-style"><i class="fa fa-building"></i>&nbsp;Edit Company Information</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Company Title&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="title" value="<?php echo $title; ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Company Details<span id="mark">*</span></label>
                                                        <textarea class="form-control" style="resize: vertical" name="detail" rows="3" required><?php echo $detail; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($logo): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/social_impact/logo/<?php echo $logo; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php else: ?>
                                                            <img src="<?php echo baseUrl('admin/images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php endif; ?>                              
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Company Logo Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="logo"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($banner): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/social_impact/banner/<?php echo $banner; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php else: ?>
                                                            <img src="<?php echo baseUrl('admin/images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php endif; ?>                              
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Company Banner Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="banner"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Company Site Link&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="link" value="<?php echo $link; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Feature It ?</label>
                                                        <select class="form-control" name="is_featured" required>
                                                            <option value="0" <?php if($is_featured == '0') { echo "selected"; } ?>>No</option>
                                                            <option value="1" <?php if($is_featured == '1') { echo "selected"; } ?>>Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>SocialImpact Status</label>
                                                        <select class="form-control" name="status" required>
                                                            <option value="0" <?php if($status == '0') { echo "selected"; } ?>>Inactive</option>
                                                            <option value="1" <?php if($status == '1') { echo "selected"; } ?>>Active</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="updateSocialImpact" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php include basePath('admin/footer.php'); ?>
        </div>
        <?php include basePath('admin/footer_script.php'); ?>
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#show_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function () {
                readURL(this);
            });
        </script>
    </body>
</html>