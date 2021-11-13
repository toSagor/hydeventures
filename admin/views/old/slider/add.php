<?php
include '../../../config/config.php';
checkAdminLogin();

$slider_title = '';
$slider_image = '';
$slider_details = '';
$slider_created_on = date('Y-m-d H:i:s');

// Save product information
if (isset($_POST['addSlider'])) {
    extract($_POST);
    $slider_title = validateInput($slider_title);

    if (empty($slider_title) || $slider_title === '') {
        $error = "Slider title required";
    } else if ($_FILES['slider_image']['name'] == "") {
        $error = "Slider image required";
    } else {
        // Check duplicate entry using Slider title.
        $sqlCheck = "SELECT * FROM slider"
                . " WHERE slider_title='$$slider_title'";
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
                $customArray .= ',slider_image = "' . $renameFile . '"';
                $customArray .= ',slider_details = "' . $slider_details . '"';
                $customArray .= ',slider_created_on = "' . $slider_created_on . '"';

                // save / insert value in table and show a message
                $sqlInsertSlider = "INSERT INTO slider SET $customArray";
                $resultInsertSlider = mysqli_query($con, $sqlInsertSlider);
                if ($resultInsertSlider) {
                    $success = "Slider information saved successfully";
                    $slider_title = $slider_details = '';
                } else {
                    $error = "Slider information addition failed for " . mysqli_error($con);
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
        <title>Add Slider</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Add Slider</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="row">
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
                                                        <textarea class="form-control" style="resize: vertical" name="slider_details" id="slider_details" rows="3"><?php echo $slider_details; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="slider_image">Slider Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="slider_image" id="slider_image" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addSlider" class="btn btn-primary">Submit</button>
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
            $("#addSliderActive").addClass("active");
            $("#addSliderActive").parent().parent().addClass("treeview active");
            $("#addSliderActive").parent().addClass("in");
        </script>

    </body>
</html>