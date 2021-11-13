<?php
include '../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$title = '';
$details = '';
$type = '';
$banner = '';
$link = '';
$category = '';
$is_featured = '';
$status = '';
$renameFile = '';
$content_update_on = date('Y-m-d H:i:s');
$flag = 0;

if (isset($_GET['id'])) {
    $content_id = $_GET['id'];
}

// Save member information
if (isset($_POST['updateContent'])) {
    extract($_POST);
    
    $title = validateInput($title);
    $details = validateInput($details);
    $type = validateInput($type);
    $link = validateInput($link);
    $category = validateInput($category);
    $is_featured = validateInput($is_featured);
    $status = validateInput($status);

    // Redirect URL if member id not found
    if ($content_id == '') {
        $link = baseUrl() . "views/content/add.php";
        redirect($link);
    } else {

        // Banner image upload code
        if ($_FILES['banner']['name']) { // Check if image file posted or not
            $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/content/'; // Target directory where image will save or store
            $targetFile = '';
            $fileType = pathinfo(basename($_FILES['banner']['name']), PATHINFO_EXTENSION);
            // File type such as .jpg, .png, .jpeg, .gif
            if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif' && $fileType != 'JPG') { // Check file is in mentioned format or not
                $flag2++;
                $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
            } else {
                if ($_FILES['banner']['size'] > (1024000)) { // Check file size. File size must be less than 1MB
                    $flag2++;
                    $error = 'Image size is too large. Must be less than 1MB';
                } else {
                    $renameFile = "SI_BAN" . date('YmdHis') . '.' . $fileType; // Rename the file name
                    $targetFile = $targetDirectory . $renameFile; // Target image file
                    move_uploaded_file($_FILES['banner']['tmp_name'], $targetFile);
                    $flag2 = 0;
                }
            }
        }
        
        if ($flag == 0) {
            $customArray = '';
            $customArray .= 'title = "' . $title . '"';
            $customArray .= ',detail = "' . $detail . '"';
            $customArray .= ',type = "' . $type . '"';
            $customArray .= ',link = "' . $link . '"';
            $customArray .= ',category = "' . $category . '"';
            $customArray .= ',is_featured = "' . $is_featured . '"';
            $customArray .= ',status = "' . $status . '"';
            $customArray .= ',created_at = "' . $content_update_on . '"';
            
            
            if ($_FILES["banner"]["tmp_name"] != '') {
                $customArray .= ', banner = "' . $renameFile . '"';
                //Image delete query when updated rows and set new image
                $sqlImage = "SELECT * FROM content WHERE id=$content_id";
                $resultImage = mysqli_query($con, $sqlImage);
                $dataImage = mysqli_fetch_array($resultImage);
                @unlink($config['IMAGE_UPLOAD_PATH'] . '/content/' . $dataImage["banner"]);
            }

            //Updated content data
            $sqlUpdateContent = "UPDATE content SET $customArray WHERE id=$content_id";
            $resultUpdateContent = mysqli_query($con, $sqlUpdateContent);
            if ($resultUpdateContent) {
                $success = "Content information updated successfully";
            } else {
                $error = "Content information update failed for " . mysqli_error($con);
            }
        }
    }
}

// Get member data
$sqlGetData = "SELECT * FROM content WHERE id=$content_id";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $title = $objGetData->title;
    $detail = $objGetData->detail;
    $type = $objGetData->type;
    $banner = $objGetData->banner;
    $link = $objGetData->link;
    $category = $objGetData->category;
    $is_featured = $objGetData->is_featured;
    $status = $objGetData->status;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hydeventures - Edit Content</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-files-o"></i>&nbsp;Edit Content Information</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Title&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="title" value="<?php echo $title; ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Details<span id="mark">*</span></label>
                                                        <textarea class="form-control" style="resize: vertical" name="detail" rows="3" required><?php echo $detail; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Type&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="type" value="<?php echo $type; ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($banner): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/content/<?php echo $banner; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php else: ?>
                                                            <img src="<?php echo baseUrl('admin/images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php endif; ?>                              
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Banner Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="banner" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Link&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="link" value="<?php echo $link; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Category</label>
                                                        <select class="form-control" name="category" required>
                                                            <option value="1" <?php if($category == '1') { echo "selected"; } ?>>Leadership</option>
                                                            <option value="2" <?php if($category == '2') { echo "selected"; } ?>>Productivity</option>
                                                            <option value="3" <?php if($category == '3') { echo "selected"; } ?>>Culture</option>
                                                        </select>
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
                                                        <label>Company Status</label>
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
                                                        <button type="submit" name="updateContent" class="btn btn-primary">Update</button>
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