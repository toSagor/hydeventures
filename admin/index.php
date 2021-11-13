<?php
include '../config/config.php';
$admin_email = '';
$admin_password = '';

if (isset($_POST['adminLogin'])) {
    extract($_POST);
    
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    
    $admin_email = validateInput($admin_email);
    $admin_password = validateInput($admin_password);
    $securePassword = securedPass($admin_password);
    
    if (empty($admin_email)) {
        $error = "Enter email address";
    } elseif (empty($admin_password)) {
        $error = "Enter password";
    } else {
        // Check admin information exists or not
        $sqlCheck = "SELECT * FROM admin WHERE admin_email='$admin_email' "
                . "AND admin_password='$securePassword' AND admin_status='Active'";
        $resultCheck = $con->query($sqlCheck);
        $countRow = $resultCheck->num_rows;
        if ($countRow > 0) {
            $obj = $resultCheck->fetch_object();
            setSession("admin_id", $obj->admin_id);
            setSession("admin_email", $obj->admin_email);
            setSession("admin_name", $obj->admin_name);
            
            $link = baseUrl() . "admin/views/dashboard.php";
            redirect($link);
        } else {
            $error = "Invalid username or password";
        }
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php include basePath('admin/header_script.php'); ?>
    </head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <h1>Hydeventures - Login</h1>
            </div>
            <form method="POST" action="">
                <div class="login-box-body">
                    <?php include basePath('admin/message.php'); ?>
                    <div class="form-group has-feedback">
                        <input type="email" class="form-control" id="admin_email" name="admin_email" value="<?php echo $admin_email; ?>" placeholder="Enter email address" required />
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password"  id="admin_password" name="admin_password" class="form-control" placeholder="Enter password" value="<?php echo $admin_password; ?>" required />
                    </div>
                    <div style="height: 20px;"></div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button name="adminLogin" type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <?php include basePath('admin/footer_script.php'); ?>
    </body>
</html>
