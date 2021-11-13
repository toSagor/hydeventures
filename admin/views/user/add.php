<?php
include '../../../config/config.php';
checkAdminLogin();

$admin_name = '';
$admin_email = '';
$admin_password = '';
$admin_phone = '';
$admin_address = '';
$admin_status = '';

// Save admin information
if (isset($_POST['addAdmin'])) {
    extract($_POST);
    $admin_name = validateInput($admin_name);
    $admin_email = validateInput($admin_email);
    $admin_password = securedPass($admin_password);
    $admin_phone = validateInput($admin_phone);
    $admin_address = validateInput($admin_address);
    $admin_status = validateInput($admin_status);
    
    if (empty($admin_email) || $admin_email === '') {
        $error = "Email ID required";
    } else if (empty($admin_password) || $admin_password === '') {
        $error = "Password required";
    } else {
        // Check duplicate entry using name title.
        $sqlCheck = "SELECT * FROM admin"
                . " WHERE admin_email='$admin_email'";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $error = "A User already exists with the same Email ID";
        } else {
            if ($flag == 0) {
                $customArray = '';
                $customArray .= 'admin_name = "' . $admin_name . '"';
                $customArray .= ',admin_email = "' . $admin_email . '"';
                $customArray .= ',admin_password = "' . $admin_password . '"';
                $customArray .= ',admin_phone = "' . $admin_phone . '"';
                $customArray .= ',admin_address = "' . $admin_address . '"';
                $customArray .= ',admin_status = "Active"';
                
                // save / insert value in table and show a message
                $sqlInsertAdmin = "INSERT INTO admin SET $customArray";
                $resultInsertAdmin = mysqli_query($con, $sqlInsertAdmin);
                if ($resultInsertAdmin) {
                    $success = "Admin saved successfully";
                } else {
                    $error = "Admin addition failed for " . mysqli_error($con);
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
        <title>Hydeventures - Add System Admin</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Add System User</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="admin_name">User Name&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="admin_name" name="admin_name" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="admin_email">Email&nbsp;<span id="mark">*</span></label>
                                                        <input type="email" id="admin_email" name="admin_email" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="admin_password">Password&nbsp;<span id="mark">*</span></label>
                                                        <input type="password" id="admin_password" name="admin_password" class="form-control" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="admin_phone">Phone&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="admin_phone" name="admin_phone" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="admin_address">Address</label>
                                                        <textarea class="form-control" style="resize: vertical" name="admin_address" id="admin_address" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addAdmin" class="btn btn-primary">Submit</button>
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
            $("#addUserActive").addClass("active");
            $("#addUserActive").parent().parent().addClass("treeview active");
            $("#addUserActive").parent().addClass("in");
        </script>
    </body>
</html>