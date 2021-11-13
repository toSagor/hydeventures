<?php
include '../../../config/config.php';
checkAdminLogin();

$gallery_title = '';
$gallery_image = '';
$gallery_created_on = date('Y-m-d H:i:s');
$gallery_created_by = getSession('admin_id');
$count = 0;
$flag = 0;


// Save gallery information
if (isset($_POST['addGallery'])) {
    extract($_POST);

    $gallery_title = validateInput($gallery_title);
    $count = count($_FILES['gallery_image']['name']);

    if ($_FILES['gallery_image']['name'] == "") {
        $error = "Gallery image required";
    } else {

        if ($count > 0) {
            
            $insertArray = '';
            $insertArray .= 'gallery_title = "' . $gallery_title . '"';
            $insertArray .= ',gallery_created_on = "' . $gallery_created_on . '"';
            $insertArray .= ',gallery_created_by = "' . $gallery_created_by . '"';

            $sqlInsert = "INSERT INTO gallery SET $insertArray";
            $resultInsert = mysqli_query($con, $sqlInsert);
            if ($resultInsert) {
                $lastID = mysqli_insert_id($con);
                for ($i = 0; $i < $count; $i++) {

                    if ($_FILES['gallery_image']['name'][$i]) { // Check if image file posted or not
                        $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/gallery_image/'; // Target directory where image will save or store
                        $targetFile = '';
                        $fileType = pathinfo(basename($_FILES['gallery_image']['name'][$i]), PATHINFO_EXTENSION);
                        // File type such as .jpg, .png, .jpeg, .gif
                        if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif' && $fileType != 'JPG') { // Check file is in mentioned format or not
                            $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
                        } else {
                            if ($_FILES['gallery_image']['size'][$i] > (1024000)) { // Check file size. File size must be less than 1MB
                                $error = 'Image size is too large. Must be less than 1MB';
                            } else {
                                $renameFile = "GI" . $i . rand(0, 10) . date('YmdHis') . '.' . $fileType; // Rename the file name
                                $targetFile = $targetDirectory . $renameFile; // Target image file
                                move_uploaded_file($_FILES['gallery_image']['tmp_name'][$i], $targetFile);

                                $customArray = '';
                                $customArray .= 'gallery_image_id = "' . $lastID . '"';
                                $customArray .= ',gallery_image = "' . $renameFile . '"';

                                $sqlInsertPost = "INSERT INTO gallery_image SET $customArray";
                                $resultInsertPost = mysqli_query($con, $sqlInsertPost);
                                if (!$resultInsertPost) {
                                    $flag++;
                                } else {
                                    $flag = 0;
                                }
                            }
                        }
                    }
                }
            }
            if ($flag === 0) {
                $success = "Gallery information saved successfully";
                $gallery_title = '';
                $link = baseUrl() . 'admin/views/gallery/list.php';
                redirect($link);
            } else {
                $error = "Gallery Post Saved Successfully" . mysqli_error($con);
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
        <title>Add Gallery</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp; Add Gallery</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="gallery_title">Gallery Title</label>
                                                        <input type="text" id="gallery_title" name="gallery_title" value="<?php echo $gallery_title; ?>" class="form-control" placeholder="Write a Gallery Title .." />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="gallery_image">Upload Gallery Images&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="gallery_image[]" id="gallery_image" multiple="multiple"/>
                                                    </div>
                                                </div>
                                                <!--   <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label></label>
                                                <?php if ($gallery_image): ?>
                                                                                                                                                        <img src="<?php echo baseUrl(); ?>upload/gallery_image/<?php echo $gallery_image; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                <?php else: ?>
                                                                                                                                                        <img src="<?php echo baseUrl('images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                <?php endif; ?>                              
                                                    </div>
                                                </div>  -->
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addGallery" class="btn btn-primary">Submit</button>
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
            $("#gallery_image").change(function () {
                readURL(this);
            });
        </script>
        <script type="text/javascript">
            $("#addGalleryActive").addClass("active");
            $("#addGalleryActive").parent().parent().addClass("treeview active");
            $("#addGalleryActive").parent().addClass("in");
        </script>
    </body>
</html>