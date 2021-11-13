<?php
include '../../../config/config.php';
checkAdminLogin();

$id = '';

if (isset($_POST['DeleteTeam'])) {
    extract($_POST);
    
    $data_sql = "SELECT * FROM team WHERE id=$id";
    $data_sql_result = mysqli_query($con, $data_sql)->fetch_assoc();
    unlink('../../../upload/team_member/' . $data_sql_result['image']);
    
    $sql = "DELETE FROM team WHERE id=$id";
    $result = mysqli_query($con, $sql);
    
    if ($result) {
        $success = "Information deleted successfully.";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

// Information Show
$sql = "SELECT * FROM team";
$result = mysqli_query($con, $sql)or die(mysqli_error($con));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hydeventures - All Team</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-users"></i>&nbsp;Company list</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="memberList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                    <thead style="background: #E4E3E2;">
                                                        <tr>
                                                            <th style="width: 10%;">Logo</th>
                                                            <th style="width: 15%;">Name</th>
                                                            <th style="width: 15%;">Email</th>
                                                            <th style="width: 15%;">Phone</th>
                                                            <th style="width: 15%;">FB Link</th>
                                                            <th style="width: 10%;">Designation</th>
                                                            <th style="width: 10%;">Status</th>
                                                            <th style="width: 10%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if ($result): ?>
                                                            <?php while ($teamList = mysqli_fetch_array($result)): ?>
                                                                <tr>
                                                                    <td style="width: 10%;"><img style="width:50px; height: auto;" src="<?php echo baseUrl(); ?>upload/team_member/<?php echo $teamList['image']; ?>" alt="<?php echo $teamList['name']; ?>" /></td>
                                                                    <td style="width: 15%;"><?php echo $teamList['name']; ?></td>
                                                                    <td style="width: 15%;"><?php echo $teamList['email']; ?></td>
                                                                    <td style="width: 15%;"><?php echo $teamList['phone']; ?></td>
                                                                    <td style="width: 15%;"><a href="<?php echo $teamList['facebook_link']; ?>" target="_blank"><span class='badge badge-info'>Facebook Link</span></a></td>
                                                                    <td style="width: 10%;"><?php echo $teamList['designation']; ?></td>
                                                                    <td style="width: 10%;">
                                                                        <?php 
                                                                            if($teamList['status'] == '0') {
                                                                                echo "<span class='badge badge-danger'>Inactive</span>";
                                                                            } else {
                                                                                echo "<span class='badge badge-success'>Active</span>";
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td style="width: 10%;">
                                                                        <a href="" data-toggle="modal" data-target="#viewModal<?php echo $teamList['id']; ?>" title="See full detail of the member">
                                                                            <button class="btn btn-info btn-sm" type="button"><i class="fa fa-info-circle"></i></button>
                                                                        </a>
                                                                        <a href="edit.php?id=<?php echo $teamList['id']; ?>"> 
                                                                            <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-edit"></i></button>
                                                                        </a>
                                                                        <a href="javascript:void(0);"> 
                                                                            <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $teamList['id']; ?>"><i class="fa fa-trash-o"></i></button>
                                                                        </a>
                                                                    </td>
                                                                    <div id="viewModal<?php echo $teamList['id']; ?>" class="modal fade" role="dialog">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title"><?php echo $teamList['name']; ?></h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-3">
                                                                                            <img style="width:100%; height: auto;" src="<?php echo baseUrl(); ?>upload/team_member/<?php echo $teamList['image']; ?>" alt="<?php echo $teamList['name']; ?>" />
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <ul class="list-group">
                                                                                                <li class="list-group-item">Name <span class="badge"><?php echo $teamList['name']; ?></span></li>
                                                                                                <li class="list-group-item">Email <span class="badge"><?php echo $teamList['email']; ?></span></li>
                                                                                                <li class="list-group-item">Phone <span class="badge"><?php echo $teamList['phone']; ?></span></li>
                                                                                                <li class="list-group-item">Designation <span class="badge"><?php echo $teamList['designation']; ?></span></li>
                                                                                                <li class="list-group-item">Facebook Link <span class="badge"><?php echo $teamList['facebook_link']; ?></span></li>
                                                                                                <li class="list-group-item">Twitter Link <span class="badge"><?php echo $teamList['twitter_link']; ?></span></li>
                                                                                                <li class="list-group-item">Linkedin Link <span class="badge"><?php echo $teamList['linkedin_link']; ?></span></li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <h3>Member Detail</h3>
                                                                                            <p style="text-align: justify; line-height: 26px; font-size: 17px;"><?php echo $teamList['detail']; ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="deleteModal<?php echo $teamList['id']; ?>" class="modal fade" role="dialog">
                                                                        <div class="modal-dialog modal-sm">
                                                                            <div class="modal-content">
                                                                                <form method="POST">
                                                                                    <div class="modal-header">
                                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                        <h4 class="modal-title">Are you sure you want to delete?</h4>
                                                                                        <input type="hidden" name="id" value="<?php echo $teamList['id']; ?>" />
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                        <button type="submit" name="DeleteTeam" class="btn btn-danger">Yes</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </tr>
                                                        <?php endwhile; ?>
                                                    <?php endif; ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="text-center" colspan="7"></td>
                                                            <td class="text-left" colspan="1">
                                                                <a href="add.php">
                                                                    <button class="btn btn-primary">
                                                                        <i class="fa fa-plus"></i>&nbsp;Add
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
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
                $('#memberList').DataTable({
                    "aaSorting": [[1, "asc"]]
                });
            });
        </script>
        <script type="text/javascript">
            $("#listTeamActive").addClass("active");
            $("#listTeamActive").parent().parent().addClass("treeview active");
            $("#listTeamActive").parent().addClass("in");
        </script>
    </body>
</html>