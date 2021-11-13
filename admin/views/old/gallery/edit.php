<?php
include '../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$gallery_title = '';
$gallery_image = '';
$gallery_updated_on = date('Y-m-d H:i:s');
$gallery_updated_by = getSession('admin_id');
$renameFile = '';
$flag = 0;


if (isset($_GET['id'])) {
    $gallery_id = $_GET['id'];
}

// Save gallery information
if (isset($_POST['updateGallery'])) {
    extract($_POST);

    $gallery_title = validateInput($gallery_title);
    $gallery_id = validateInput($gallery_id);

    // Redirect URL if blog id not found
    if ($gallery_id == '') {
        $link = baseUrl() . "views/gallery/events/add.php";
        redirect($link);
    } else {
        // Image upload code
        if ($_FILES['gallery_image']['name']) { // Check if image file posted or not
            $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/gallery_image/'; // Target directory where image will save or store
            $targetFile = '';
            $fileType = pathinfo(basename($_FILES['gallery_image']['name']), PATHINFO_EXTENSION);
            // File type such as .jpg, .png, .jpeg, .gif
            if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif' && $fileType != 'JPG') { // Check file is in mentioned format or not
                $flag++;
                $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
            } else {
                if ($_FILES['gallery_image']['size'] > (1024000)) { // Check file size. File size must be less than 1MB
                    $flag++;
                    $error = 'Image size is too large. Must be less than 1MB';
                } else {
                    $renameFile = "GI" . date('YmdHis') . '.' . $fileType; // Rename the file name
                    $targetFile = $targetDirectory . $renameFile; // Target image file
                    move_uploaded_file($_FILES['gallery_image']['tmp_name'], $targetFile);
                    $flag = 0;
                }
            }
        }
        // Image upload code end
        if ($flag == 0) {
            $customArray = '';
            $customArray .= 'gallery_title = "' . $gallery_title . '"';
            $customArray .= ',gallery_id = "' . $gallery_id . '"';
            $customArray .= ',gallery_updated_on = "' . $gallery_updated_on . '"';
            $customArray .= ',gallery_updated_by = "' . $gallery_updated_by . '"';
            if ($_FILES["gallery_image"]["tmp_name"] != '') {
            $customArray .= ', gallery_image = "' . $renameFile . '"';

                //Image delete query when updated rows and set new image
                $sqlImage = "SELECT * FROM gallery WHERE gallery_id=$gallery_id";
                $resultImage = mysqli_query($con, $sqlImage);
                $dataImage = mysqli_fetch_array($resultImage);
                @unlink($config['IMAGE_UPLOAD_PATH'] . '/gallery_image/' . $dataImage["gallery_image"]);
            }

            //Updated gallery data
           $sqlUpdateBlogPost = "UPDATE gallery SET $customArray WHERE gallery_id=$gallery_id";
          
            $resultUpdateBlogPost = mysqli_query($con, $sqlUpdateBlogPost);
            if ($resultUpdateBlogPost) {
                $success = "Gallery information updated successfully";
            } else {
                $error = "Gallery information update failed for " . mysqli_error($con);
            }
        }
    }
}

// Get gallery data
$sqlGetData = "SELECT * FROM gallery WHERE gallery_id=$gallery_id";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $gallery_title = $objGetData->gallery_title;
    $gallery_cat_id = $objGetData->gallery_cat_id;
    $gallery_image = $objGetData->gallery_image;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Edit Gallery</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Edit Gallery</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form role="form" method="POST" action="<?php echo baseUrl(); ?>admin/views/gallery/events/edit.php?id=<?php echo $gallery_id; ?>" enctype="multipart/form-data">
                                            <div class="row">
                                                <input type="hidden" id="gallery_id" name="gallery_id" value="<?php echo $gallery_id; ?>" />
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="gallery_title">Title &nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="gallery_title" name="gallery_title" value="<?php echo $gallery_title; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="events_category_id">Galllery Category Select&nbsp;<span id="mark">*</span></label>
                                                        <select name="events_category_id" id="events_category_id" class="form-control">
                                                            <?php if (count($arrayGalleryCategory) > 0): ?>
                                                                <?php foreach ($arrayGalleryCategory AS $category): ?>
                                                                    <option value="<?php echo $category->events_category_id; ?>"<?php
                                                                    if ($events_category_id == $category->events_category_id) {
                                                                        echo "selected = selected";
                                                                    }
                                                                    ?>><?php echo $category->events_category_title; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="gallery_image">Feature Image</label>
                                                        <input type="file" name="gallery_image" id="gallery_image" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($gallery_image): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/gallery_image/<?php echo $gallery_image; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 200px;width: 400px;" />
                                                        <?php else: ?>
                                                            <img src="<?php echo baseUrl('images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 200px;width: 400px;" />
                                                        <?php endif; ?>                              
                                                    </div>
                                                </div>
                                                <div class="col-md-4"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" id="updateGallery" name="updateGallery" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>    
                                            <br>
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
            $("#gallerySetting").append("<li id='editGalleryActive'><a href=''><i class='fa fa-circle-o'></i>Edit Gallery</a></li>");
            $("#editGalleryActive").addClass("active");
            $("#editGalleryActive").parent().parent().addClass("treeview active");
            $("#editGalleryActive").parent().addClass("in");
        </script>

    </body>
</html>


