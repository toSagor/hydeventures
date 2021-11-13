<?php
include '../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$slider_id = '';
$slider_title = '';
$service_image = '';
$slider_details = '';
$renameFile = '';
$flag = 0;

if (isset($_GET['id'])) {
    $slider_id = $_GET['id'];
}

// Save slider information
if (isset($_POST['updateSlider'])) {
    extract($_POST);
    
    $slider_id = validateInput($slider_id);
    $slider_title = validateInput($slider_title);
    $slider_details = validateInput($slider_details);

    // Redirect URL if slider id not found
    if ($slider_id == '') {
        $link = baseUrl() . "views/slider/add.php";
        redirect($link);
    } else {
        // Checking slider already exists or not
        $sqlCheck = "SELECT * FROM slider"
                . " WHERE slider_title='$slider_title' AND slider_id NOT IN (" . $slider_id . ")";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $error = "A slider already exists with the same title";
        } else {
            // Image upload code
            if ($_FILES['slider_image']['name']) { // Check if image file posted or not
                $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/slider_image/'; // Target directory where image will save or store
                $targetFile = '';
                $fileType = pathinfo(basename($_FILES['slider_image']['name']), PATHINFO_EXTENSION);
                // File type such as .jpg, .png, .jpeg, .gif
                if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif' && $fileType != 'JPG') { // Check file is in mentioned format or not
                    $flag++;
                    $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
                } else {
                    if ($_FILES['slider_image']['size'] > (1024000)) { // Check file size. File size must be less than 1MB
                        $flag++;
                        $error = 'Image size is too large. Must be less than 1MB';
                    } else {
                        $renameFile = "SI" . date('YmdHis') . '.' . $fileType; // Rename the file name
                        $targetFile = $targetDirectory . $renameFile; // Target image file
                        move_uploaded_file($_FILES['slider_image']['tmp_name'], $targetFile);
                        $flag = 0;
                    }
                }
            }
            // Image upload code end
            if ($flag == 0) {
                $customArray = '';
                $customArray .= 'slider_title = "' . $slider_title . '"';
                $customArray .= ',slider_details = "' . $slider_details . '"';
                if ($_FILES["slider_image"]["tmp_name"] != '') {
                    $customArray .= ', slider_image = "' . $renameFile . '"';
                    
                //Image delete query when updated rows and set new image
                $sqlImage = "SELECT * FROM slider WHERE slider_id=$slider_id";
                $resultImage = mysqli_query($con, $sqlImage);
                $dataImage = mysqli_fetch_array($resultImage);
                @unlink($config['IMAGE_UPLOAD_PATH'] . '/slider_image/' . $dataImage["slider_image"]);
                }
                
                //Updated slider data
                $sqlUpdateSlider = "UPDATE slider SET $customArray WHERE slider_id=$slider_id";
                $resultUpdateSlider = mysqli_query($con, $sqlUpdateSlider);
                if ($resultUpdateSlider) {
                    $success = "Slider information updated successfully";
                } else {
                    $error = "Slider information update failed for " . mysqli_error($con);
                }
            }
        }
    }
}

// Get slider data
$sqlGetData = "SELECT * FROM slider WHERE slider_id=$slider_id";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $slider_title = $objGetData->slider_title;
    $slider_details = $objGetData->slider_details;
    $slider_image = $objGetData->slider_image;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Edit Service</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Edit Slider</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form role="form" method="POST" action="<?php echo baseUrl(); ?>admin/views/slider/edit.php?id=<?php echo $slider_id; ?>" enctype="multipart/form-data">
                                            <div class="row">
                                                <input type="hidden" id="slider_id" name="slider_id" value="<?php echo $slider_id; ?>" />
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="slider_title">Slider Title&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="slider_title" name="slider_title" value="<?php echo $slider_title; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="slider_details">Slider Details</label>
                                                        <textarea class="form-control" style="resize: vertical" name="slider_details" id="slider_details" rows="5"><?php echo $slider_details; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($slider_image): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/slider_image/<?php echo $slider_image; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php else: ?>
                                                            <img src="<?php echo baseUrl('images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php endif; ?>                              
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="slider_image">Slider Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="slider_image" id="slider_image" value="<?php echo $slider_image; ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" id="updateSlider" name="updateSlider" class="btn btn-primary">Update</button>
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
            $("#slider_image").change(function () {
                readURL(this);
            });
        </script>
        <script type="text/javascript">
            $("#sliderSetting").append("<li id='editSliderActive'><a href=''><i class='fa fa-circle-o'></i>Edit Slider</a></li>");
            $("#editSliderActive").addClass("active");
            $("#editSliderActive").parent().parent().addClass("treeview active");
            $("#editSliderActive").parent().addClass("in");
        </script>

    </body>
</html>