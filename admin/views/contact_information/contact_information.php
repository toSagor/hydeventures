<?php
include '../../../config/config.php';
checkAdminLogin();

$notification_id = '';

if (isset($_POST['DeleteCotactInformation'])) {
    extract($_POST);

    $sql = "DELETE FROM notification WHERE id=$notification_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $success = "Information deleted successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

//notificationInformationList Show
$sql = "SELECT * FROM notification";
$result = mysqli_query($con, $sql)or die(mysqli_error($con));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Mail Information</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Mail Information</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="partnerList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                    <thead style="background: #E4E3E2;">
                                                        <tr>
                                                            <th style="width: 20%;">Name</th>
                                                            <th style="width: 20%;">Email</th>
                                                            <th style="width: 20%;">LinkedIn Link</th>
                                                            <th style="width: 15%;">Message</th>
                                                            <th style="width: 15%;">Created On</th>
                                                            <th style="width: 10%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if ($result): ?>
                                                            <?php while ($notificationInfoList = mysqli_fetch_array($result)): ?>
                                                                <tr>
                                                                    <td style="width: 20%;"><?php echo $notificationInfoList['first_name'] .' '. $notificationInfoList['last_name']; ?></td>
                                                                    <td style="width: 20%;"><?php echo $notificationInfoList['email']; ?></td>
                                                                    <td style="width: 20%;"><?php echo $notificationInfoList['linkedin_link']; ?></td>
                                                                    <td style="width: 15%;"><a href="" data-toggle="modal" data-target="#viewModal<?php echo $notificationInfoList['id']; ?>"><i class="fa fa-eye"></i>&nbsp;View</a></td>
                                                                    <td style="width: 15%;"><?php echo $notificationInfoList['created_at']; ?></td>
                                                                    <td style="width: 10%;">
                                                                        <a href="edit.php?id=<?php echo $notificationInfoList['notification_id']; ?>">
                                                                            <a href="javascript:void(0);"> 
                                                                                <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $notificationInfoList['id']; ?>"><i class="fa fa-trash-o"></i></button>
                                                                            </a>
                                                                    </td>
                                                                    <div id="viewModal<?php echo $notificationInfoList['id']; ?>" class="modal fade" role="dialog">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Message Details : <?php echo $notificationInfoList['first_name'] .' '. $notificationInfoList['last_name']; ?></h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p style="text-align: justify; line-height: 26px; font-size: 17px;"><?php echo $notificationInfoList['message']; ?></p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="deleteModal<?php echo $notificationInfoList['id']; ?>" class="modal fade" role="dialog">
                                                                        <div class="modal-dialog modal-sm">
                                                                            <div class="modal-content">
                                                                                <form method="POST">
                                                                                    <div class="modal-header">
                                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                        <h4 class="modal-title">Are you sure you want to delete?</h4>
                                                                                        <input type="hidden" name="notification_id" id="notification_id" value="<?php echo $notificationInfoList['id']; ?>" />
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                        <button type="submit" id="DeleteCotactInformation" name="DeleteCotactInformation" class="btn btn-danger">Yes</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </tr>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>
                                                    </tbody>
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
        <script>
            $(document).ready(function () {
                $('#partnerList').DataTable({
                    "aaSorting": [[1, "asc"]]
                });
            });
        </script>
        <script type="text/javascript">
            $("#ContactInformationActive").addClass("active");
            $("#ContactInformationActive").parent().parent().addClass("treeview active");
            $("#ContactInformationActive").parent().addClass("in");
        </script>

    </body>
</html>