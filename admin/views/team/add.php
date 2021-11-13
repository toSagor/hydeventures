<?php
include '../../../config/config.php';
checkAdminLogin();

$name = '';
$email = '';
$phone = '';
$image = '';
$facebook_link = '';
$twitter_link = '';
$linkedin_link = '';
$designation = '';
$detail = '';
$status = '1';

// Save product information
if (isset($_POST['addMember'])) {
    extract($_POST);
    
    $name = validateInput($name);
    $email = validateInput($email);
    $phone = validateInput($phone);
    $facebook_link = validateInput($facebook_link);
    $twitter_link = validateInput($twitter_link);
    $linkedin_link = validateInput($linkedin_link);
    $designation = validateInput($designation);
    $detail = validateInput($detail);
    $status = validateInput($status);

    if (empty($name) || $name === '') {
        $error = "Member Name is Required";
    } else {
        // Check duplicate entry using Slider title.
        $sqlCheck = "SELECT * FROM team"
                 . " WHERE name='$name'";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $error = "A member already exists with the same name";
        } else {
            // Logo image upload code
            if ($_FILES['image']['name']) { // Check if image file posted or not
                $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/team_member/'; // Target directory where image will save or store
                $targetFile = '';
                $fileType = pathinfo(basename($_FILES['image']['name']), PATHINFO_EXTENSION);
                // File type such as .jpg, .png, .jpeg, .gif
                if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif' && $fileType != 'JPG') { // Check file is in mentioned format or not
                    $flag++;
                    $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
                } else {
                    if ($_FILES['image']['size'] > (1024000)) { // Check file size. File size must be less than 1MB
                        $flag++;
                        $error = 'Image size is too large. Must be less than 1MB';
                    } else {
                        $renameFile = "MEMBER" . date('YmdHis') . '.' . $fileType; // Rename the file name
                        $targetFile = $targetDirectory . $renameFile; // Target image file
                        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
                        $flag = 0;
                    }
                }
            }
            
            // Image upload code end
            if ($flag == 0 && $flag2 == 0) {
                $customArray = '';
                $customArray .= 'name = "' . $name . '"';
                $customArray .= ',email = "' . $email . '"';
                $customArray .= ',phone = "' . $phone . '"';
                $customArray .= ',image = "' . $renameFile . '"';
                $customArray .= ',facebook_link = "' . $facebook_link . '"';
                $customArray .= ',twitter_link = "' . $twitter_link . '"';
                $customArray .= ',linkedin_link = "' . $linkedin_link . '"';
                $customArray .= ',designation = "' . $designation . '"';
                $customArray .= ',detail = "' . $detail . '"';
                $customArray .= ',status = "' . $status . '"';

                // save / insert value in table and show a message
                $sqlInsertTeam = "INSERT INTO team SET $customArray";
                $resultInsertTeam = mysqli_query($con, $sqlInsertTeam);
                if ($resultInsertTeam) {
                    $success = "Member information saved successfully";
                    $name = $email = $phone = $facebook_link = $twitter_link = $linkedin_link = $designation = $detail = '';
                } else {
                    $error = "Member information addition failed for " . mysqli_error($con);
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
        <title>Hydeventures - Add Team Member</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-users"></i>&nbsp;Add New Team Member</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Member Name&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Member Email&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Member Phone&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Member Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="image" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Facebook Link&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="facebook_link" value="<?php echo $facebook_link; ?>" class="form-control" />
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
                                                        <label>Linkedin Link&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="linkedin_link" value="<?php echo $linkedin_link; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Member Designation&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" name="designation" value="<?php echo $designation; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Member Details<span id="mark">*</span></label>
                                                        <textarea class="form-control" style="resize: vertical" name="detail" rows="3" required><?php echo $detail; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addMember" class="btn btn-primary">Submit</button>
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
            $("#addTeamActive").addClass("active");
            $("#addTeamActive").parent().parent().addClass("treeview active");
            $("#addTeamActive").parent().addClass("in");
        </script>
    </body>
</html>