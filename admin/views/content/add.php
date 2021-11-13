<?php
include '../../../config/config.php';
checkAdminLogin();

$title = '';
$details = '';
$type = '';
$banner = '';
$link = '';
$category = '';
$is_featured = '';
$status = '1';
$company_created_on = date('Y-m-d H:i:s');

// Save product information
if (isset($_POST['addSocialImpact'])) {
    extract($_POST);
    $title = validateInput($title);
    $details = validateInput($details);
    $type = validateInput($type);
    $link = validateInput($link);
    $category = validateInput($category);
    $is_featured = validateInput($is_featured);
    $status = validateInput($status);

    if (empty($title) || $title === '') {
        $error = "Content Title is Required";
    } else {
        // Check duplicate entry using Content title.
        $sqlCheck = "SELECT * FROM content"
                 . " WHERE title='$title'";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $error = "A content item already exists with the same title";
        } else {            
            // Banner image upload code
            if ($_FILES['banner']['name']) { // Check if image file posted or not
                $targetDirectory_1 = $config['IMAGE_UPLOAD_PATH'] . '/content/'; // Target directory where image will save or store
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
                        $renameFile_1 = "SI_BAN" . date('YmdHis') . '.' . $fileType_1; // Rename the file name
                        $targetFile_1 = $targetDirectory_1 . $renameFile_1; // Target image file
                        move_uploaded_file($_FILES['banner']['tmp_name'], $targetFile_1);
                        $flag2 = 0;
                    }
                }
            }

            // Image upload code end
            if ($flag == 0 && $flag2 == 0) {
                $customArray = '';
                $customArray .= 'title = "' . $title . '"';
                $customArray .= ',detail = "' . $detail . '"';
                $customArray .= ',type = "' . $type . '"';
                $customArray .= ',banner = "' . $renameFile_1 . '"';
                $customArray .= ',link = "' . $link . '"';
                $customArray .= ',category = "' . $category . '"';
                $customArray .= ',is_featured = "' . $is_featured . '"';
                $customArray .= ',status = "' . $status . '"';
                $customArray .= ',created_at = "' . $company_created_on . '"';

                // save / insert value in table and show a message
                $sqlInsertContent = "INSERT INTO content SET $customArray";
                $resultInsertContent = mysqli_query($con, $sqlInsertContent);
                if ($resultInsertContent) {
                    $success = "Content information saved successfully";
                    $title = $detail = $link = '';
                } else {
                    $error = "Content information addition failed for " . mysqli_error($con);
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hydeventures - Add Content</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-globe"></i>&nbsp;Add New Content</div>
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Banner Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="banner" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Site Link&nbsp;<span id="mark">*</span></label>
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
                                                            <option value="">Choose a Category..</option>
                                                            <option value="1">Leadership</option>
                                                            <option value="2">Productivity</option>
                                                            <option value="3">Culture</option>
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
                                                            <option value="0">No</option>
                                                            <option value="1">Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addSocialImpact" class="btn btn-primary">Submit</button>
                                                        <button type="reset" class="btn btn-danger">Reset</button>
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
        <script type="text/javascript">
            $("#addContentActive").addClass("active");
            $("#addContentActive").parent().parent().addClass("treeview active");
            $("#addContentActive").parent().addClass("in");
        </script>
    </body>
</html> 