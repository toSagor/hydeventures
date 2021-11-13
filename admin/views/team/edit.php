<?php
include '../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$name = '';
$email = '';
$phone = '';
$image = '';
$facebook_link = '';
$twitter_link = '';
$linkedin_link = '';
$designation = '';
$detail = '';
$status = '';
$renameFile = '';
$member_update_on = date('Y-m-d H:i:s');
$flag = 0;

if (isset($_GET['id'])) {
    $member_id = $_GET['id'];
}

// Save member information
if (isset($_POST['updateMember'])) {
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

    // Redirect URL if member id not found
    if ($member_id == '') {
        $link = baseUrl() . "views/team/add.php";
        redirect($link);
    } else {
        // Member image upload code
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

        if ($flag == 0) {
            $customArray = '';
            $customArray .= 'name = "' . $name . '"';
            $customArray .= ',email = "' . $email . '"';
            $customArray .= ',phone = "' . $phone . '"';
            $customArray .= ',facebook_link = "' . $facebook_link . '"';
            $customArray .= ',twitter_link = "' . $twitter_link . '"';
            $customArray .= ',linkedin_link = "' . $linkedin_link . '"';
            $customArray .= ',designation = "' . $designation . '"';
            $customArray .= ',detail = "' . $detail . '"';
            $customArray .= ',status = "' . $status . '"';
            $customArray .= ',created_at = "' . $member_update_on . '"';
            
            if ($_FILES["image"]["tmp_name"] != '') {
                $customArray .= ', image = "' . $renameFile . '"';
                //Image delete query when updated rows and set new image
                $sqlImage = "SELECT * FROM team WHERE id=$member_id";
                $resultImage = mysqli_query($con, $sqlImage);
                $dataImage = mysqli_fetch_array($resultImage);
                @unlink($config['IMAGE_UPLOAD_PATH'] . '/team_member/' . $dataImage["image"]);
            }
            
            //Updated member data
            $sqlUpdateMember = "UPDATE team SET $customArray WHERE id=$member_id";
            $resultUpdateMember = mysqli_query($con, $sqlUpdateMember);
            if ($resultUpdateMember) {
                $success = "Member information updated successfully";
            } else {
                $error = "Member information update failed for " . mysqli_error($con);
            }
        }
    }
}

// Get member data
$sqlGetData = "SELECT * FROM team WHERE id=$member_id";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $name = $objGetData->name;
    $email = $objGetData->email;
    $phone = $objGetData->phone;
    $image = $objGetData->image;
    $facebook_link = $objGetData->facebook_link;
    $twitter_link = $objGetData->twitter_link;
    $linkedin_link = $objGetData->linkedin_link;
    $designation = $objGetData->designation;
    $detail = $objGetData->detail;
    $status = $objGetData->status;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hydeventures - Edit Team Member</title>
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
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($image): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/team_member/<?php echo $image; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php else: ?>
                                                            <img src="<?php echo baseUrl('admin/images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php endif; ?>                              
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Member Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="image"/>
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
                                                        <button type="submit" name="updateMember" class="btn btn-primary">Update</button>
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