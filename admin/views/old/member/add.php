<?php
include '../../../config/config.php';
checkAdminLogin();

$member_name = '';
$member_username = '';
$member_password = '';
$member_conf_password = '';
$member_image = '';
$member_company = '';
$member_address = '';
$member_dob = '';
$member_gender = '';
$member_state = '';
$member_city = '';
$member_zip = '';
$member_country = '';
$member_phone = '';
$member_fax = '';
$member_email = '';
$member_website = '';
$member_contact_person = '';
$member_designation = '';
$member_year_est = '';
$member_primary_business = '';
$member_services = '';
$member_is_agreed_tc = '';
$member_status = '1';
$member_plan = '1';

$arrayCountry= array();
$sql_country = "SELECT * FROM country";
$result_country = mysqli_query($con, $sql_country);
if ($result_country) {
    while ($obj_country = mysqli_fetch_object($result_country)) {
        $arrayCountry[] = $obj_country;
    }
}

// Save member information
if (isset($_POST['addMember'])) {
    extract($_POST);

    $member_name = validateInput($member_name);
    $member_username = validateInput($member_username);
    $member_password = securedPass($member_password);
    $member_company = validateInput($member_company);
    $member_address = validateInput($member_address);
    $member_dob = validateInput($member_dob);
    $member_gender = validateInput($member_gender);
    $member_state = validateInput($member_state);
    $member_city = validateInput($member_city);
    $member_zip = validateInput($member_zip);
    $member_country = validateInput($member_country);
    $member_phone = validateInput($member_phone);
    $member_fax = validateInput($member_fax);
    $member_email = validateInput($member_email);
    $member_website = validateInput($member_website);
    $member_contact_person = validateInput($member_contact_person);
    $member_designation = validateInput($member_designation);
    $member_year_est = validateInput($member_year_est);
    $member_primary_business = validateInput($member_primary_business);
    $member_services = addslashes($member_services);
    $member_is_agreed_tc = validateInput($member_is_agreed_tc);
    $member_status = validateInput($member_status);
    $member_plan = validateInput($member_plan);

    // Check duplicate entry using post type.
    $sqlCheck = "SELECT * FROM member"
            . " WHERE  member_user_name='$member_username' AND member_email='$member_email'";
    $resultCheck = mysqli_query($con, $sqlCheck);
    $countRow = mysqli_num_rows($resultCheck);

    if ($countRow > 0) {
        $error = "An application is already placed with same username or email, Thanks !";
    } else {
        if (empty($member_name) || $member_name === '') {
            $error = "Member full name required";
        } else if (empty($member_username) || $member_username === '') {
            $error = "Member user name required";
        } else if (empty($member_password) || $member_password === '') {
            $error = "Member password required";
        } else if (empty($member_email) || $member_email === '') {
            $error = "Member email required";
        } else if (empty($member_phone) || $member_phone === '') {
            $error = "Member phone number required";
        } else if (empty($member_country) || $member_country === '') {
            $error = "Member contry information required";
        } else if (empty($member_contact_person) || $member_contact_person === '') {
            $error = "Please type your responsible contact person";
        } else if (empty($member_primary_business) || $member_primary_business === '') {
            $error = "Please choose your promary business type";
        } else if (empty($member_services) || $member_services === '') {
            $error = "Describe your service in detail";
        } else if (empty($member_is_agreed_tc) || $member_is_agreed_tc === '') {
            $error = "Please check to accept terms and condition";
        } else if ($_FILES['member_image']['name'] == "") {
            $error = "Member image in passport size required";
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
                        $renameFile = "MI" . date('YmdHis') . '.' . $fileType; // Rename the file name
                        $targetFile = $targetDirectory . $renameFile; // Target image file
                        move_uploaded_file($_FILES['member_image']['tmp_name'], $targetFile);
                        $flag = 0;
                    }
                }
            }

            // Image upload code end
            if ($flag == 0) {
                $customArray = '';
                $customArray .= 'member_name = "' . $member_name . '"';
                $customArray .= ',member_username = "' . $member_username . '"';
                $customArray .= ',member_password = "' . $member_password . '"';
                $customArray .= ',member_image = "' . $renameFile . '"';
                $customArray .= ',member_company = "' . $member_company . '"';
                $customArray .= ',member_address = "' . $member_address . '"';
                $customArray .= ',member_dob = "' . $member_dob . '"';
                $customArray .= ',member_gender = "' . $member_gender . '"';
                $customArray .= ',member_state = "' . $member_state . '"';
                $customArray .= ',member_city = "' . $member_city . '"';
                $customArray .= ',member_zip = "' . $member_zip . '"';
                $customArray .= ',member_country = "' . $member_country . '"';
                $customArray .= ',member_phone = "' . $member_phone . '"';
                $customArray .= ',member_fax = "' . $member_fax . '"';
                $customArray .= ',member_email = "' . $member_email . '"';
                $customArray .= ',member_website = "' . $member_website . '"';
                $customArray .= ',member_contact_person = "' . $member_contact_person . '"';
                $customArray .= ',member_designation = "' . $member_designation . '"';
                $customArray .= ',member_year_est = "' . $member_year_est . '"';
                $customArray .= ',member_primary_business = "' . $member_primary_business . '"';
                $customArray .= ',member_services  = "' . $member_services . '"';
                $customArray .= ',member_is_agreed_tc = "' . $member_is_agreed_tc . '"';
                $customArray .= ',member_status = "' . $member_status . '"';
                $customArray .= ',member_plan = "' . $member_plan . '"';

                // save / insert value in table and show a message
                $sqlInsertMember = "INSERT INTO member SET $customArray";
                $resultInsertMember = mysqli_query($con, $sqlInsertMember);
                if ($resultInsertMember) {
                    $success = "Member information saved successfully";
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
        <title>Add Member</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Add Member (Buyer or Seller)</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_name">Member Name <span id="mark">*</span></label>
                                                        <input type="text" id="member_name" name="member_name" value="<?php echo $member_name; ?>" class="form-control" placeholder="Member Name" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_username">User Name&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="member_username" name="member_username" value="<?php echo $member_username; ?>" class="form-control" placeholder="Member Username" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_password">Password &nbsp;<span id="mark">*</span></label>
                                                        <input type="password" id="member_password" name="member_password" value="<?php echo $member_conf_password; ?>" class="form-control" placeholder="Type your Password" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_conf_password">Conform Password &nbsp;<span id="mark">*</span></label>
                                                        <input type="password" id="member_conf_password" name="member_conf_password" value="<?php echo $member_conf_password; ?>" class="form-control" placeholder="Conform your password" required/>
                                                        <span id='message'></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="member_image">Upload your image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="member_image" id="member_image" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($member_image): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/member_image/<?php echo $member_image; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php else: ?>
                                                            <img src="<?php echo baseUrl('admin/images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php endif; ?>                              
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_company">Member Company Name<span id="mark">*</span></label>
                                                        <input type="text" id="member_company" name="member_company" value="<?php echo $member_company; ?>" class="form-control" placeholder="Type Company Name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_dob">Date of Birth&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="member_username" name="member_dob" value="<?php echo $member_dob; ?>" class="form-control date" placeholder="Ex, 1993/11/23" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_country">You are&nbsp;<span id="mark">*</span></label>
                                                        <div class="form-group">
                                                            <select class="form-control" id="member_gender" name="member_gender" required>
                                                                <option value="1">Male</option>
                                                                <option value="2">Female</option>
                                                                <option value="3">Other</option>
                                                            </select>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_address">Member Address</label>
                                                        <textarea class="form-control" id="member_address" name="member_address" rows="2" placeholder="Type official Address" required>
                                                            <?php echo $member_address; ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_country">Member Country&nbsp;<span id="mark">*</span></label>
                                                        <div class="form-group">
                                                            <select class="form-control select2" id="member_country" name="member_country" required>
                                                                <?php if (count($arrayCountry) > 0): ?>
                                                                    <?php foreach ($arrayCountry AS $country): ?>
                                                                        <option value="<?php echo $country->country_name; ?>"><?php echo $country->country_name; ?></option>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_state">Member State&nbsp;</label>
                                                        <input type="text" id="member_state" name="member_state" value="<?php echo $member_state; ?>" class="form-control" placeholder="Type member state" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_city">Member City&nbsp;</label>
                                                        <input type="text" id="member_city" name="member_city" value="<?php echo $member_city; ?>" class="form-control" placeholder="Type member city"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_zip">Member Zip&nbsp;</label>
                                                        <input type="text" id="member_zip" name="member_zip" value="<?php echo $member_zip; ?>" class="form-control" placeholder="Type member zip"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_phone">Member Phone&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="member_phone" name="member_phone" value="<?php echo $member_phone; ?>" class="form-control" placeholder="Type member phone" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_fax">Member Fax&nbsp;</label>
                                                        <input type="text" id="member_fax" name="member_fax" value="<?php echo $member_fax; ?>" class="form-control" placeholder="Type member fax"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_email">User Email <span id="mark">*</span></label>
                                                        <input type="email" id="member_email" name="member_email" value="<?php echo $member_email; ?>" class="form-control" placeholder="Type member email" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_website">Website</label>
                                                        <input type="text" id="member_website" name="member_website" value="<?php echo $member_website; ?>" class="form-control" placeholder="Type member website"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_contact_person">Contact Person&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="member_contact_person" name="member_contact_person" value="<?php echo $member_contact_person; ?>" class="form-control" placeholder="Type member contact person name" required/>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_designation">Contact Person Designation&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="member_designation" name="member_designation" value="<?php echo $member_designation; ?>" class="form-control" placeholder="Type member contact person designation" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="member_year_est">Year Established &nbsp;</label>
                                                        <input type="text" id="member_year_est" name="member_year_est" value="<?php echo $member_year_est; ?>" class="form-control" placeholder="Company Startup year"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="member_primary_business">Primary Business Activity &nbsp;<span id="mark">*</span></label>
                                                        <label class="radio-inline"><input type="radio" name="member_primary_business" value="1" required>Buying / Importer</label>
                                                        <label class="radio-inline"><input type="radio" name="member_primary_business" value="2" required>Selling / Exporter</label>
                                                        <label class="radio-inline"><input type="radio" name="member_primary_business" value="3" required>Both Buying and Selling</label> 
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="member_services">Products / Services<span id="mark">*</span></label>
                                                        <textarea class="form-control" id="member_services" name="member_services" rows="5" required>
                                                            <?php echo $member_address; ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" name="member_is_agreed_tc" value="1" required>I agree Terms And Service
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addMember" class="btn btn-primary">Submit</button>
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
            $(document).ready(function () {
                var password = document.getElementById("member_password")
                        , confirm_password = document.getElementById("member_conf_password");

                function validatePassword() {
                    if (password.value != confirm_password.value) {
                        confirm_password.setCustomValidity("Passwords Don't Match");
                    } else {
                        confirm_password.setCustomValidity('');
                    }
                }

                password.onchange = validatePassword;
                confirm_password.onkeyup = validatePassword;
            });
        </script>
        <script>
            $(document).ready(function () {
                $("#member_services").kendoEditor({
                    tools: [
                        "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                        "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                        "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                        "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                        "fontName", "fontSize", "foreColor", "backColor"
                    ]
                });
            });
        </script>
        <script type="text/javascript">
            $("#addMemberActive").addClass("active");
            $("#addMemberActive").parent().parent().addClass("treeview active");
            $("#addMemberActive").parent().addClass("in");
        </script>
    </body>
</html>