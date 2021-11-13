<?php
include '../../../config/config.php';
checkAdminLogin();

$id = '';

if (isset($_POST['DeleteCompany'])) {
    extract($_POST);
    
    $data_sql = "SELECT * FROM company WHERE id=$id";
    $data_sql_result = mysqli_query($con, $data_sql)->fetch_assoc();
    unlink('../../../upload/company_image/logo/' . $data_sql_result['logo']);
    unlink('../../../upload/company_image/banner/' . $data_sql_result['banner']);
    
    $sql = "DELETE FROM company WHERE id=$id";
    $result = mysqli_query($con, $sql);
    
    if ($result) {
        $success = "Information deleted successfully.";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

// Information Show
$sql = "SELECT * FROM company";
$result = mysqli_query($con, $sql)or die(mysqli_error($con));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hydeventures - All Companies</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-building"></i>&nbsp;Company list</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="companyList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                    <thead style="background: #E4E3E2;">
                                                        <tr>
                                                            <th style="width: 20%;">Title</th>
                                                            <th style="width: 10%;">Logo</th>
                                                            <th style="width: 10%;">Banner</th>
                                                            <th style="width: 10%;">Detail</th>
                                                            <th style="width: 20%;">Site Link</th>
                                                            <th style="width: 10%;">Is Featured ?</th>
                                                            <th style="width: 10%;">Status</th>
                                                            <th style="width: 10%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if ($result): ?>
                                                            <?php while ($companyList = mysqli_fetch_array($result)): ?>
                                                                <tr>
                                                                    <td style="width: 20%;"><?php echo $companyList['title']; ?></td>
                                                                    <td style="width: 10%;"><img style="width:50px; height: auto;" src="<?php echo baseUrl(); ?>upload/company_image/logo/<?php echo $companyList['logo']; ?>" alt="<?php echo $companyList['title']; ?>" /></td>
                                                                    <td style="width: 10%;"><img style="width:60px; height: auto;" src="<?php echo baseUrl(); ?>upload/company_image/banner/<?php echo $companyList['banner']; ?>" alt="<?php echo $companyList['title']; ?>" /></td>
                                                                    <td style="width: 10%;"><a href="" data-toggle="modal" data-target="#viewModal<?php echo $companyList['id']; ?>"><i class="fa fa-eye"></i>&nbsp;View</a></td>
                                                                    <td style="width: 20%;"><?php echo $companyList['site_link']; ?></td>
                                                                    <td style="width: 10%;">
                                                                        <?php 
                                                                            if($companyList['is_featured'] == '0') {
                                                                                echo "<span class='badge badge-default'>No</span>";
                                                                            } else {
                                                                                echo "<span class='badge badge-success'>Yes</span>";
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td style="width: 10%;">
                                                                        <?php 
                                                                            if($companyList['status'] == '0') {
                                                                                echo "<span class='badge badge-danger'>Inactive</span>";
                                                                            } else {
                                                                                echo "<span class='badge badge-success'>Active</span>";
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td style="width: 10%;">
                                                                        <a href="edit.php?id=<?php echo $companyList['id']; ?>"> 
                                                                            <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-edit"></i></button>
                                                                        </a>
                                                                        <a href="javascript:void(0);"> 
                                                                            <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $companyList['id']; ?>"><i class="fa fa-trash-o"></i></button>
                                                                        </a>

                                                                    </td>
                                                                    <div id="viewModal<?php echo $companyList['id']; ?>" class="modal fade" role="dialog">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Message Details : <?php echo $companyList['title']; ?></h4>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p style="text-align: justify; line-height: 26px; font-size: 17px;"><?php echo $companyList['detail']; ?></p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="deleteModal<?php echo $companyList['id']; ?>" class="modal fade" role="dialog">
                                                                        <div class="modal-dialog modal-sm">
                                                                            <div class="modal-content">
                                                                                <form method="POST">
                                                                                    <div class="modal-header">
                                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                        <h4 class="modal-title">Are you sure you want to delete?</h4>
                                                                                        <input type="hidden" name="id" value="<?php echo $companyList['id']; ?>" />
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                        <button type="submit" id="DeleteCompany" name="DeleteCompany" class="btn btn-danger">Yes</button>
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
                $('#companyList').DataTable({
                    "aaSorting": [[1, "asc"]]
                });
            });
        </script>
        <script type="text/javascript">
            $("#listCompanyActive").addClass("active");
            $("#listCompanyActive").parent().parent().addClass("treeview active");
            $("#listCompanyActive").parent().addClass("in");
        </script>
    </body>
</html>