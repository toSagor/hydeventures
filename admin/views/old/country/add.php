<?php
include '../../../config/config.php';
checkAdminLogin();

$country_name = '';
$country_image = '';

// Save product information
if (isset($_POST['addCountry'])) {
    extract($_POST);
    $country_name = validateInput($country_name);

    if (empty($country_name) || $country_name === '') {
        $error = "Country title required";
    } else {
        // Check duplicate entry using Slider title.
        $sqlCheck = "SELECT * FROM country"
                . " WHERE country_name='$country_name'";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $error = "A country already exists with the same name";
        } else {

            // Image upload code
            if ($_FILES['country_image']['name']) { // Check if image file posted or not
                $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/country_image/'; // Target directory where image will save or store
                $targetFile = '';
                $fileType = pathinfo(basename($_FILES['country_image']['name']), PATHINFO_EXTENSION);
                // File type such as .jpg, .png, .jpeg, .gif
                if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif' && $fileType != 'JPG') { // Check file is in mentioned format or not
                    $flag++;
                    $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
                } else {
                    if ($_FILES['country_image']['size'] > (1024000)) { // Check file size. File size must be less than 1MB
                        $flag++;
                        $error = 'Image size is too large. Must be less than 1MB';
                    } else {
                        $renameFile = "SI" . date('YmdHis') . '.' . $fileType; // Rename the file name
                        $targetFile = $targetDirectory . $renameFile; // Target image file
                        move_uploaded_file($_FILES['country_image']['tmp_name'], $targetFile);
                        $flag = 0;
                    }
                }
            }

            // Image upload code end
            if ($flag == 0) {
                $customArray = '';
                $customArray .= 'country_name = "' . $country_name . '"';
                $customArray .= ',country_image = "' . $renameFile . '"';

                // save / insert value in table and show a message
                $sqlInsertCountry = "INSERT INTO country SET $customArray";
                $resultInsertCountry = mysqli_query($con, $sqlInsertCountry);
                if ($resultInsertCountry) {
                    $success = "Country information saved successfully";
                } else {
                    $error = "Country information addition failed for " . mysqli_error($con);
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
        <title>Add Country</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Add Country</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="country_name">Country Title&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="country_name" name="country_name" value="<?php echo $country_name; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="country_image">Country Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="country_image" id="country_image" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addCountry" class="btn btn-primary">Submit</button>
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
            $("#addCountryActive").addClass("active");
            $("#addCountryActive").parent().parent().addClass("treeview active");
            $("#addCountryActive").parent().addClass("in");
        </script>

    </body>
</html>