<?php
include '../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$admin_name = '';
$admin_email = '';
$admin_phone = '';
$admin_address = '';
$admin_status = '';
$flag = 0;

if (isset($_GET['id'])) {
   $admin_id = $_GET['id'];
}

// Update admin information
if (isset($_POST['updateAdmin'])) {
    extract($_POST); 
    $admin_name = validateInput($admin_name);
    $admin_email = validateInput($admin_email);
    $admin_phone = validateInput($admin_phone);
    $admin_address = validateInput($admin_address);
    $admin_status = validateInput($admin_status);
    
    // Redirect URL if admin id not found
    if ($admin_id == '') {
        $link = baseUrl() . "views/user/add.php";
        redirect($link);
    } else {
        // Checking admin already exists or not
        $sqlCheck = "SELECT * FROM admin"
                . " WHERE admin_email='$admin_email' AND admin_id NOT IN (" . $admin_id . ")";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $error = "A admin already exists with the same email id.s";
        } else {
            if ($flag == 0) {
                
                $customArray = '';
                $customArray .= 'admin_name = "' . $admin_name . '"';
                $customArray .= ',admin_email = "' . $admin_email . '"';
                $customArray .= ',admin_phone = "' . $admin_phone . '"';
                $customArray .= ',admin_address = "' . $admin_address . '"';
                $customArray .= ',admin_status = "' . $admin_status . '"';
                
                //Updated admin data
                $sqlUpdateAdmin = "UPDATE admin SET $customArray WHERE admin_id=$admin_id";
                $resultUpdateAdmin = mysqli_query($con, $sqlUpdateAdmin);
                if ($resultUpdateAdmin) {
                    $success = "Admin information updated successfully";
                } else {
                    $error = "Admin information update failed for " . mysqli_error($con);
                }
            }
        }
    }
}

// Get testimonial data
$sqlGetData = "SELECT * FROM admin WHERE admin_id=$admin_id";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $admin_name = $objGetData->admin_name;
    $admin_email = $objGetData->admin_email;
    $admin_phone = $objGetData->admin_phone;
    $admin_address = $objGetData->admin_address;
    $admin_status = $objGetData->admin_status;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hydeventures - System Admin Edit</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Edit System Admin</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form role="form" method="POST" action="<?php echo baseUrl(); ?>admin/views/user/edit.php?id=<?php echo $admin_id; ?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="admin_name">User Name&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="admin_name" name="admin_name" class="form-control" value="<?php echo $admin_name; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="admin_email">Email&nbsp;<span id="mark">*</span></label>
                                                        <input type="email" id="admin_email" name="admin_email" class="form-control" value="<?php echo $admin_email; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="admin_phone">Phone&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="admin_phone" name="admin_phone" class="form-control" value="<?php echo $admin_phone; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="admin_address">Address</label>
                                                        <textarea class="form-control" style="resize: vertical" name="admin_address" id="admin_address" rows="3"><?php echo $admin_address; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="type">Admin Status&nbsp;<span id="mark">*</span></label>
                                                        <select id="type" name="admin_status" class="form-control">
                                                            <option value="<?php echo $admin_status; ?>">Current Status : <?php echo $admin_status; ?></option>
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" id="updateAdmin" name="updateAdmin" class="btn btn-primary">Update</button>
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