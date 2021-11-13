<?php
include '../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$member_user_name = '';
$member_fname = '';
$member_mname = '';
$member_lname = '';
$member_dob = '';
$member_gender = '';
$member_website = '';
$member_mobile = '';
$member_email = '';
$member_image = '';
$member_updated_on = date('Y-m-d H:i:s');
$member_updated_by = getSession('admin_id');
$renameFile = '';
$flag = 0;

if (isset($_GET['id'])) {
    $member_id = $_GET['id'];
}

// Save member information
if (isset($_POST['updateMember'])) {
    extract($_POST);

    $member_user_name = validateInput($member_user_name);
    $member_fname = validateInput($member_fname);
    $member_mname = validateInput($member_mname);
    $member_lname = validateInput($member_lname);
    $member_dob = validateInput($member_dob);
    $member_gender = validateInput($member_gender);
    $member_website = validateInput($member_website);
    $member_mobile = validateInput($member_mobile);
    $member_email = validateInput($member_email);

    // Redirect URL if member id not found
    if ($member_id == '') {
        $link = baseUrl() . "views/member/add.php";
        redirect($link);
    } else {
        // Image upload code
        if ($_FILES['member_image']['name']) { // Check if image file posted or not
            $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/member_image/'; // Target directory where image will save or store
            $targetFile = '';
            $fileType = pathinfo(basename($_FILES['member_image']['name']), PATHINFO_EXTENSION);
            // File type such as .jpg, .png, .jpeg, .gif
            if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif' && $fileType != 'JPG') { // Check file is in mentioned format or not
                $flag++;
                $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
            } else {
                if ($_FILES['member_image']['size'] > (1024000)) { // Check file size. File size must be less than 1MB
                    $flag++;
                    $error = 'Image size is too large. Must be less than 1MB';
                } else {
                    $renameFile = "PI" . date('YmdHis') . '.' . $fileType; // Rename the file name
                    $targetFile = $targetDirectory . $renameFile; // Target image file
                    move_uploaded_file($_FILES['member_image']['tmp_name'], $targetFile);
                    $flag = 0;
                }
            }
        }
        // Image upload code end
        if ($flag == 0) {
            $customArray = '';
            $customArray .= 'member_user_name = "' . $member_user_name . '"';
            $customArray .= ',member_fname = "' . $member_fname . '"';
            $customArray .= ',member_mname = "' . $member_mname . '"';
            $customArray .= ',member_lname = "' . $member_lname . '"';
            $customArray .= ',member_dob = "' . $member_dob . '"';
            $customArray .= ',member_gender = "' . $member_gender . '"';
            $customArray .= ',member_website = "' . $member_website . '"';
            $customArray .= ',member_mobile = "' . $member_mobile . '"';
            $customArray .= ',member_email = "' . $member_email . '"';
            $customArray .= ',member_updated_on = "' . $member_updated_on . '"';
            $customArray .= ',member_updated_by = "' . $member_updated_by . '"';
            
            if ($_FILES["member_image"]["tmp_name"] != '') {
                $customArray .= ', member_image = "' . $renameFile . '"';
                
                //Image delete query when updated rows and set new image
                $sqlImage = "SELECT * FROM member WHERE member_id=$member_id";
                $resultImage = mysqli_query($con, $sqlImage);
                $dataImage = mysqli_fetch_array($resultImage);
                @unlink($config['IMAGE_UPLOAD_PATH'] . '/member_image/' . $dataImage["member_image"]);
            }

            //Updated member data
            $sqlUpdateMember = "UPDATE member SET $customArray WHERE member_id=$member_id";
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
$sqlGetData = "SELECT * FROM member WHERE member_id=$member_id";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $member_user_name = $objGetData->member_user_name;
    $member_fname = $objGetData->member_fname;
    $member_mname = $objGetData->member_mname;
    $member_lname = $objGetData->member_lname;
    $member_dob = $objGetData->member_dob;
    $member_gender = $objGetData->member_gender;
    $member_email = $objGetData->member_email;
    $member_website = $objGetData->member_website;
    $member_mobile = $objGetData->member_mobile;
    $member_image = $objGetData->member_image;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Edit User</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Edit User</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form role="form" method="POST" action="<?php echo baseUrl(); ?>admin/views/member/edit.php?id=<?php echo $member_id; ?>" enctype="multipart/form-data">
                                            <div class="row">
                                                <input type="hidden" id="member_id" name="member_id" value="<?php echo $member_id; ?>" />
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_user_name">User Name&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="member_user_name" name="member_user_name" value="<?php echo $member_user_name; ?>" class="form-control" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_fname">First Name</label>
                                                        <input type="text" id="member_fname" name="member_fname" value="<?php echo $member_fname; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_mname">Middle Name</label>
                                                        <input type="text" id="member_mname" name="member_mname" value="<?php echo $member_mname; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_lname">Last Name</label>
                                                        <input type="text" id="member_lname" name="member_lname" value="<?php echo $member_lname; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_dob">Date of Birth</label>
                                                        <input type="text" id="member_dob" name="member_dob" value="<?php echo $member_dob; ?>" class="form-control date" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_mobile">Mobile</label>
                                                        <input type="text" id="member_mobile" name="member_mobile" value="<?php echo $member_mobile; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_email">Email&nbsp;<span id="mark">*</span></label>
                                                        <input type="email" id="member_email" name="member_email" value="<?php echo $member_email; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_gender">Select Gender <span id="mark">*</span></label>
                                                        <select class="form-control" id="member_gender" name="member_gender" required>
                                                            <option value="1" <?php if($member_gender == '1') { echo "selected"; } ?>>Male</option>
                                                            <option value="2" <?php if($member_gender == '2') { echo "selected"; } ?>>Female</option>
                                                            <option value="3" <?php if($member_gender == '3') { echo "selected"; } ?>>Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_website">Website</label>
                                                        <input type="text" id="member_mobile" name="member_website" value="<?php echo $member_website; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="member_image">User Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="member_image" id="member_image" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($member_image): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/member_image/<?php echo $member_image; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php else: ?>
                                                            <img src="<?php echo baseUrl('admin/images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php endif; ?>                              
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" id="updateMember" name="updateMember" class="btn btn-primary">Update</button>
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
            $("#member_image").change(function () {
                readURL(this);
            });
        </script>
        <script type="text/javascript">
            $("#memberSetting").append("<li id='editMemberActive'><a href=''><i class='fa fa-circle-o'></i>Edit Member</a></li>");
            $("#editMemberActive").addClass("active");
            $("#editMemberActive").parent().parent().addClass("treeview active");
            $("#editMemberActive").parent().addClass("in");
        </script>

    </body>
</html>
