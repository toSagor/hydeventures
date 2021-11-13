<?php
include '../../../config/config.php';
checkAdminLogin();

$appointment_id = '';

// Delete Appointment
if (isset($_POST['DeleteAppointment'])) {
    extract($_POST);

    $sql = "DELETE FROM appointment WHERE appointment_id=$appointment_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $success = "Information deleted successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

// Conform Appointment
if (isset($_POST['ConformAppointment'])) {
    extract($_POST);

    $sql = "UPDATE appointment SET appointment_status='2' WHERE appointment_id=$appointment_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $success = "This appointment has been conformed successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

// Complete / Done Appointment
if (isset($_POST['DoneAppointment'])) {
    extract($_POST);

    $sql = "UPDATE appointment SET appointment_status='1' WHERE appointment_id=$appointment_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $success = "This appointment has been completed successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

//appointmentList Show
$sql = "SELECT * FROM appointment";
$result = mysqli_query($con, $sql)or die(mysqli_error($con));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Appointment List</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Appointment list</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="appointmentList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                    <thead style="background: #E4E3E2;">
                                                        <tr>
                                                            <th style="width: 15%;">Company/Institute Name</th>
                                                            <th style="width: 10%;">Email</th>
                                                            <th style="width: 10%;">Phone</th>
                                                            <th style="width: 10%;">Expected Date</th>
                                                            <th style="width: 10%;">Expected Time</th>
                                                            <th style="width: 20%;">Reason</th>
                                                            <th style="width: 5%;">Status</th>
                                                            <th style="width: 10%;">Created On</th>
                                                            <th style="width: 10%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                            <?php if ($result): ?>
                                                            <?php while ($appointmentList = mysqli_fetch_array($result)): ?>
                                                            <tr>
                                                                <td style="width: 15%;"><?php echo $appointmentList['appointment_ci_name']; ?></td>
                                                                <td style="width: 10%;"><?php echo $appointmentList['company_email']; ?></td>
                                                                <td style="width: 10%;"><?php echo $appointmentList['company_phone']; ?></td>
                                                                <td style="width: 10%;"><?php echo $appointmentList['appointment_date']; ?></td>
                                                                <td style="width: 10%;"><?php echo $appointmentList['appointment_time']; ?></td>
                                                                <td style="width: 20%;"><?php echo $appointmentList['appointment_reason']; ?></td>
                                                                <td style="width: 5%;">
                                                                    <?php
                                                                        if($appointmentList['appointment_status'] == '1') {
                                                                            echo "<span class='label label-success'>Meeting Done</span>";
                                                                        } else if ($appointmentList['appointment_status'] == '2') {
                                                                            echo "<span class='label label-primary'>Meeting Comformed</span>";
                                                                        } else {
                                                                            echo "<span class='label label-warning'>Ongoing / Pending Decision</span>";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td style="width: 10%;"><?php echo $appointmentList['created_at']; ?></td>
                                                                <td style="width: 10%;">
                                                                    <?php if($appointmentList['appointment_status'] == '0') { ?>
                                                                    <a href="javascript:void(0);" title="Click to make the appointment conformed"> 
                                                                        <button class="btn btn-primary btn-sm" data-toggle="modal" type="button" data-target="#conformModal<?php echo $appointmentList['appointment_id']; ?>"><i class="fa fa-calendar-check-o"></i></button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" title="Click to make the appointment done"> 
                                                                        <button class="btn btn-success btn-sm" data-toggle="modal" type="button" data-target="#doneModal<?php echo $appointmentList['appointment_id']; ?>"><i class="fa fa-check-circle-o"></i></button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" title="Click to delete the appointment"> 
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $appointmentList['appointment_id']; ?>"><i class="fa fa-trash-o"></i></button>
                                                                    </a>
                                                                    <?php } else if ($appointmentList['appointment_status'] == '1') { ?>
                                                                    <a href="javascript:void(0);" title="Click to delete the appointment"> 
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $appointmentList['appointment_id']; ?>"><i class="fa fa-trash-o"></i></button>
                                                                    </a>
                                                                    <?php } else { ?>
                                                                    <a href="javascript:void(0);" title="Click to make the appointment done"> 
                                                                        <button class="btn btn-success btn-sm" data-toggle="modal" type="button" data-target="#doneModal<?php echo $appointmentList['appointment_id']; ?>"><i class="fa fa-check-circle-o"></i></button>
                                                                    </a>
                                                                    <a href="javascript:void(0);" title="Click to delete the appointment"> 
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $appointmentList['appointment_id']; ?>"><i class="fa fa-trash-o"></i></button>
                                                                    </a>
                                                                    <?php } ?>
                                                                </td>
                                                                <!-- Conform Modal -->
                                                                <div id="conformModal<?php echo $appointmentList['appointment_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to make it meeting conformed ?</h4>
                                                                                    <input type="hidden" name="appointment_id" id="appointment_id" value="<?php echo $appointmentList['appointment_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="ConformAppointment" name="ConformAppointment" class="btn btn-danger">Yes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Done Modal -->
                                                                <div id="doneModal<?php echo $appointmentList['appointment_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to make it meeting done ?</h4>
                                                                                    <input type="hidden" name="appointment_id" id="appointment_id" value="<?php echo $appointmentList['appointment_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="DoneAppointment" name="DoneAppointment" class="btn btn-danger">Yes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Delete Modal -->
                                                                <div id="deleteModal<?php echo $appointmentList['appointment_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to delete?</h4>
                                                                                    <input type="hidden" name="appointment_id" id="appointment_id" value="<?php echo $appointmentList['appointment_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="DeleteAppointment" name="DeleteAppointment" class="btn btn-danger">Yes</button>
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
                $('#appointmentList').DataTable({
                    "aaSorting": [[1, "asc"]]
                });
            });
        </script>
        <script type="text/javascript">
            $("#appointmentListActive").addClass("active");
            $("#appointmentListActive").parent().parent().addClass("treeview active");
            $("#appointmentListActive").parent().addClass("in");
        </script>

    </body>
</html>