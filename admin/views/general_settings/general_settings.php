<?php
include '../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$generalsettings_id = '1';
$company_name = '';
$logo = '';
$twitter_link = '';
$linkedin_link = '';
$email = '';
$location = '';
$footer_info = '';
$renameFile = '';
$flag = 0;

// Save logo information
if (isset($_POST['updateSettings'])) {
    extract($_POST);

    $generalsettings_id = validateInput($generalsettings_id);
    $company_name = validateInput($company_name);
    $twitter_link = validateInput($twitter_link);
    $linkedin_link = validateInput($linkedin_link);
    $email = validateInput($email);
    $location = validateInput($location);
    $footer_info = validateInput($footer_info); {
        // Checking general settings already exists or not
        $sqlCheck = "SELECT * FROM general_info"
                . " WHERE company_name='$company_name'"
                . " AND twitter_link='$twitter_link'"
                . " AND linkedin_link='$linkedin_link'"
                . " AND email='$email'"
                . " AND location='$location'";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck); {
            // Image upload code
            if ($_FILES['logo']['name']) { // Check if image file posted or not
                $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/logo_image/'; // Target directory where image will save or store
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
                        $renameFile = "LI" . date('YmdHis') . '.' . $fileType; // Rename the file name
                        $targetFile = $targetDirectory . $renameFile; // Target image file
                        move_uploaded_file($_FILES['logo']['tmp_name'], $targetFile);
                        $flag = 0;
                    }
                }
            }
            // Image upload code end
            if ($flag == 0) {
                $customArray = '';
                $customArray .= 'company_name = "' . $company_name . '"';
                $customArray .= ',twitter_link = "' . $twitter_link . '"';
                $customArray .= ',linkedin_link = "' . $linkedin_link . '"';
                $customArray .= ',email = "' . $email . '"';
                $customArray .= ',location = "' . $location . '"';
                $customArray .= ',footer_info = "' . $footer_info . '"';
                if ($_FILES["logo"]["tmp_name"] != '') {
                    $customArray .= ', logo = "' . $renameFile . '"';

                    //Image delete query when updated rows and set new image
                    $sqlImage = "SELECT * FROM general_info";
                    $resultImage = mysqli_query($con, $sqlImage);
                    $dataImage = mysqli_fetch_array($resultImage);
                    @unlink($config['IMAGE_UPLOAD_PATH'] . '/logo_image/' . $dataImage["logo"]);
                }

                //Updated general settings data
                $sqlUpdateGeneralSettings = "UPDATE general_info SET $customArray";
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
$sqlGetData = "SELECT * FROM general_info";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $company_name = $objGetData->company_name;
    $logo = $objGetData->logo;
    $twitter_link = $objGetData->twitter_link;
    $linkedin_link = $objGetData->linkedin_link;
    $email = $objGetData->email;
    $location = $objGetData->location;
    $footer_info = $objGetData->footer_info;
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
                                                        <label>Company Name&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="company_name" value="<?php echo $company_name; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($logo): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/logo_image/<?php echo $logo; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px; width: 300px;" />
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
                                                        <label>Logo Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="logo" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Twitter Link&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="twitter_link" value="<?php echo $twitter_link; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>LinkedIn Link&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="linkedin_link" value="<?php echo $linkedin_link; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Email Address &nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Location &nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="location" value="<?php echo $location; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Footer Info<span id="mark">*</span></label>
                                                        <textarea class="form-control" style="resize: vertical" name="footer_info" rows="3" required><?php echo $footer_info; ?></textarea>
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
