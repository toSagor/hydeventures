<?php
include '../../config/config.php';
checkAdminLogin();

//Admin Information Show
$sql = "SELECT * FROM admin";
$result = mysqli_query($con, $sql)or die(mysqli_error($con));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin Profile</title>
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
                                        <div class="row">
                                            <div class="col-md-10">
                                                <table class="table">
                                                    <?php while ($adminInfo = mysqli_fetch_array($result)): ?>
                                                        <thead style="font-size: 16px;">
                                                            <tr>
                                                                <th>Admin ID</th>
                                                                <th><?php echo $adminInfo['admin_id']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Admin Name</th>
                                                                <th><?php echo $adminInfo['admin_name']; ?></th>
                                                            </tr>
                                                            <tr>
                                                                <th>Admin Email</th>
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
                                                                <th>Admin Status</th>
                                                                <th><?php echo $adminInfo['admin_status']; ?></th>
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
            $("#dashActive").addClass("active");
            $("#dashActive").parent().parent().addClass("treeview active");
            $("#dashActive").parent().addClass("in");
        </script>
    </body>
</html>