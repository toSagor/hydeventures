<?php
include '../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$generalsettings_id = '';
$title_slogan = '';
$logo_image = '';
$facebook_link = '';
$twitter_link = '';
$google_plus_link = '';
$linkedIn_link = '';
$help_line1 = '';
$email_address1 = '';
$renameFile = '';
$flag = 0;

// Save logo information
if (isset($_POST['updateSettings'])) {
    extract($_POST);

    $generalsettings_id = validateInput($generalsettings_id);
    $title_slogan = validateInput($title_slogan);
    $facebook_link = validateInput($facebook_link);
    $twitter_link = validateInput($twitter_link);
    $google_plus_link = validateInput($google_plus_link);
    $linkedIn_link = validateInput($linkedIn_link);
    $help_line1 = validateInput($help_line1);
    $email_address1 = validateInput($email_address1); {
        // Checking general settings already exists or not
        $sqlCheck = "SELECT * FROM generalsettings"
                . " WHERE title_slogan='$title_slogan'"
                . " AND facebook_link='$facebook_link'"
                . " AND twitter_link='$twitter_link'"
                . " AND google_plus_link='$google_plus_link'"
                . " AND linkedIn_link='$linkedIn_link'"
                . " AND help_line1='$help_line1'"
                . " AND email_address1='$email_address1'";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck); {
            // Image upload code
            if ($_FILES['logo_image']['name']) { // Check if image file posted or not
                $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/logo_image/'; // Target directory where image will save or store
                $targetFile = '';
                $fileType = pathinfo(basename($_FILES['logo_image']['name']), PATHINFO_EXTENSION);
                // File type such as .jpg, .png, .jpeg, .gif
                if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif' && $fileType != 'JPG') { // Check file is in mentioned format or not
                    $flag++;
                    $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
                } else {
                    if ($_FILES['logo_image']['size'] > (1024000)) { // Check file size. File size must be less than 1MB
                        $flag++;
                        $error = 'Image size is too large. Must be less than 1MB';
                    } else {
                        $renameFile = "LI" . date('YmdHis') . '.' . $fileType; // Rename the file name
                        $targetFile = $targetDirectory . $renameFile; // Target image file
                        move_uploaded_file($_FILES['logo_image']['tmp_name'], $targetFile);
                        $flag = 0;
                    }
                }
            }
            // Image upload code end
            if ($flag == 0) {
                $customArray = '';
                $customArray .= 'title_slogan = "' . $title_slogan . '"';
                $customArray .= ',facebook_link = "' . $facebook_link . '"';
                $customArray .= ',twitter_link = "' . $twitter_link . '"';
                $customArray .= ',google_plus_link = "' . $google_plus_link . '"';
                $customArray .= ',linkedIn_link = "' . $linkedIn_link . '"';
                $customArray .= ',help_line1 = "' . $help_line1 . '"';
                $customArray .= ',email_address1 = "' . $email_address1 . '"';
                if ($_FILES["logo_image"]["tmp_name"] != '') {
                    $customArray .= ', logo_image = "' . $renameFile . '"';

                    //Image delete query when updated rows and set new image
                    $sqlImage = "SELECT * FROM generalsettings";
                    $resultImage = mysqli_query($con, $sqlImage);
                    $dataImage = mysqli_fetch_array($resultImage);
                    @unlink($config['IMAGE_UPLOAD_PATH'] . '/logo_image/' . $dataImage["logo_image"]);
                }

                //Updated general settings data
                $sqlUpdateGeneralSettings = "UPDATE generalsettings SET $customArray";
                $resultUpdateGeneralSettings = mysqli_query($con, $sqlUpdateGeneralSettings);
                if ($resultUpdateGeneralSettings) {
                    $success = "General settings information updated successfully";
                } else {
                    $error = "General settings information update failed for " . mysqli_error($con);
                }
            }
        }
    }
}

// Get general settings data
$sqlGetData = "SELECT * FROM generalsettings";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $title_slogan = $objGetData->title_slogan;
    $logo_image = $objGetData->logo_image;
    $facebook_link = $objGetData->facebook_link;
    $twitter_link = $objGetData->twitter_link;
    $google_plus_link = $objGetData->google_plus_link;
    $linkedIn_link = $objGetData->linkedIn_link;
    $help_line1 = $objGetData->help_line1;
    $email_address1 = $objGetData->email_address1;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>All Settings</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;All Settings</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form role="form" method="POST" action="" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="hidden" id="generalsettings_id" name="generalsettings_id" value="<?php echo $generalsettings_id; ?>" />
                                                    <div class="form-group">
                                                        <label for="title_slogan">Title and Slogan&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="title_slogan" name="title_slogan" value="<?php echo $title_slogan; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($logo_image): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/logo_image/<?php echo $logo_image; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px; width: 300px;" />
                                                        <?php else: ?>
                                                            <img src="<?php echo baseUrl('images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px; width: 300px;" />
                                                        <?php endif; ?>                              
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="logo_image">Banner Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="logo_image" id="logo_image" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="facebook_link">Facebook Link&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="facebook_link" name="facebook_link" value="<?php echo $facebook_link; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="twitter_link">Twitter Link&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="twitter_link" name="twitter_link" value="<?php echo $twitter_link; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="google_plus_link">Google Plus&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="google_plus_link" name="google_plus_link" value="<?php echo $google_plus_link; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="linkedIn_link">LinkedIn&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="linkedIn_link" name="linkedIn_link" value="<?php echo $linkedIn_link; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="help_line1">Help Line &nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="help_line1" name="help_line1" value="<?php echo $help_line1; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email_address1">Email Address &nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="email_address1" name="email_address1" value="<?php echo $email_address1; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="updateSettings" class="btn btn-primary">Update</button>
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
            $("#logo_image").change(function () {
                readURL(this);
            });
        </script>
        <script type="text/javascript">
            $("#GeneralSettingsActive").addClass("active");
            $("#GeneralSettingsActive").parent().parent().addClass("treeview active");
            $("#GeneralSettingsActive").parent().addClass("in");
        </script>

    </body>
</html>
