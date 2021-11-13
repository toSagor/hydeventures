<?php
include '../../../config/config.php';
checkAdminLogin();

// Current Admin User
$current_user_id = getSession('admin_id');

// Admin Information Show
$sql = "SELECT * FROM admin" . " WHERE admin_id='$current_user_id'";
$result = mysqli_query($con, $sql) or die(mysqli_error($con));

// Change Password
if (isset($_POST['changePass'])) {
    extract($_POST);
    $admin_password = securedPass($admin_password);

    // Redirect URL if admin id not found
    if ($current_user_id == '') {
        $link = baseUrl() . "views/user/add.php";
        redirect($link);
    } else {
        if ($flag == 0) {

            $customArray = '';
            $customArray .= 'admin_password = "' . $admin_password . '"';
            
            //Updated admin data
            $sqlUpdateAdminPass = "UPDATE admin SET $customArray WHERE admin_id=$current_user_id";
            $resultUpdateAdminPass = mysqli_query($con, $sqlUpdateAdminPass);
            if ($resultUpdateAdminPass) {
                $success = "Admin Password Updated Successfully. Please Re-Login Once !";
            } else {
                $error = "Admin Password Update Failed For " . mysqli_error($con);
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
        <title>TradeMart - Admin Profile</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Admin Profile</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <table class="table">
                                                    <?php while ($adminInfo = mysqli_fetch_array($result)): ?>
                                                        <thead style="font-size: 16px;">
                                                            <tr>
                                                                <th>Name</th>
                                                                <th><?php echo $adminInfo['admin_name']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <th><?php echo $adminInfo['admin_email']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Phone Number</th>
                                                                <th><?php echo $adminInfo['admin_phone']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Address</th>
                                                                <th><?php echo $adminInfo['admin_address']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Action</th>
                                                                <th>
                                                                    <button class="btn btn-info btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $adminInfo['admin_id']; ?>">Change Password</button>
                                                                    <a href="list.php" class="btn btn-warning btn-sm">All Users</a>
                                                        <div id="deleteModal<?php echo $adminInfo['admin_id']; ?>" class="modal fade" role="dialog">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <form method="POST">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title">Change User Password !</h4>
                                                                            <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $adminInfo['admin_id']; ?>" />
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="admin_password">Password&nbsp;<span id="mark">*</span></label>
                                                                                        <input type="password" id="admin_password" name="admin_password" class="form-control" placeholder="New Password .." required/>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <label for="admin_conform_password">Conform Password&nbsp;<span id="mark">*</span></label>
                                                                                        <input type="password" id="admin_conform_password" name="admin_conform_password" class="form-control" placeholder="Conform New Password .." required/>
                                                                                    </div>
                                                                                </div>    
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                            <button type="submit" id="changePass" name="changePass" class="btn btn-info">Yes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </th>
                                                        </tr>
                                                        </thead>
                                                    <?php endwhile; ?>
                                                </table>
                                            </div>
                                        </div>
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
            var password = document.getElementById("admin_password");
            var confirm_password = document.getElementById("admin_conform_password");
            function validatePassword() {
                if (password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                } else {
                    confirm_password.setCustomValidity('');
                }
            }
            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
        </script>
    </body>
</html>