<?php
include '../../../config/config.php';
checkAdminLogin();

$member_id = '';

if (isset($_POST['DeleteMember'])) {
    extract($_POST);
    $sqlImage = "SELECT * FROM member WHERE member_id=$member_id";
    $resultImage = mysqli_query($con, $sqlImage);
    $dataImage = mysqli_fetch_array($resultImage);
    @unlink($config['IMAGE_UPLOAD_PATH'] . '/member_image/' . $dataImage["member_image"]);
    $sql = "DELETE FROM member WHERE member_id=$member_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $success = "Information deleted successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

////member list show
//$sql = "SELECT member.*, member_category.* FROM member "
//        . "LEFT JOIN member_category ON member.member_cat_id = member_category.category_id";
//$result = mysqli_query($con, $sql)or die(mysqli_error($con));

//Member list show
$sql = "SELECT * FROM member WHERE member_primary_business='1' AND member_status='1' ORDER BY member_id DESC";
$result = mysqli_query($con, $sql)or die(mysqli_error($con));

// User Active
if (isset($_POST['ActiveMember'])) {
    extract($_POST);

    $sql = "UPDATE member SET member_status='1', member_type='1' WHERE member_id=$member_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script>location.reload();</script>";
        $success = "Comment published successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Buyer List</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp; All Buyer List</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="memberList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                        <thead style="background: #E4E3E2;">
                                                            <tr>
                                                                <th style="width: 10%;">Avater</th>
                                                                <th style="width: 10%;">Name</th>
                                                                <th style="width: 15%;">Company Name</th>
                                                                <th style="width: 10%;">Country</th>
                                                                <th style="width: 10%;">Mobile</th>
                                                                <th style="width: 10%;">Email</th>
                                                                <th style="width: 10%;">Website</th>
                                                                <th style="width: 5%;">Status</th>
                                                                <th style="width: 20%;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if ($result): ?>
                                                            <?php while ($memberList = mysqli_fetch_array($result)): ?>
                                                            <tr>
                                                                <td style="width: 10%;"><img src="<?php echo baseUrl(); ?>upload/member_image/<?php echo $memberList['member_image']; ?>" height="50px" width="50px"></td>
                                                                <td style="width: 10%;"><?php echo $memberList['member_name']; ?></td>
                                                                <td style="width: 15%;"><?php echo $memberList['member_company']; ?></td>
                                                                <td style="width: 10%;"><?php echo $memberList['member_country']; ?></td>
                                                                <td style="width: 10%;"><?php echo $memberList['member_phone']; ?></td>
                                                                <td style="width: 10%;"><?php echo $memberList['member_email']; ?></td>
                                                                <td style="width: 10%;"><?php echo $memberList['member_website']; ?></td>
                                                                <td style="width: 5%;">
                                                                  <?php
                                                                    if($memberList['member_status'] == '0') {
                                                                      echo "<span class='label label-danger'>Inactive</span>";
                                                                    } else {
                                                                      echo "<span class='label label-success'>Active</span>";
                                                                    }
                                                                  ?>
                                                                </td>
                                                                <td style="width: 20%;">
                                                                    <?php
                                                                        if($memberList['member_status'] == '1') {
                                                                          echo "";
                                                                        } else { 
                                                                    ?>
                                                                    <a href="javascript:void(0);">
                                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" type="button" data-target="#activeUser<?php echo $memberList['member_id']; ?>" title="Active User"><i class="fa fa-check-circle-o"></i></button>
                                                                    </a>
                                                                    <?php } ?>
                                                                    <a href="javascript:void(0);">
                                                                        <button class="btn btn-info btn-sm" data-toggle="modal" type="button" data-target="#detailModal<?php echo $memberList['member_id']; ?>" title="User Detail"><i class="fa fa-info-circle"></i></button>
                                                                    </a>
                                                                    <a href="edit.php?id=<?php echo $memberList['member_id']; ?>">
                                                                        <button class="btn btn-primary btn-sm" type="button" title="Edit User Detail"><i class="fa fa-edit"></i></button>
                                                                    </a>
                                                                    <a href="javascript:void(0);">
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $memberList['member_id']; ?>" title="Delete User Detail"><i class="fa fa-trash-o"></i></button>
                                                                    </a>
                                                                </td>
                                                                <!-- Active Member Modal -->
                                                                <div id="activeUser<?php echo $memberList['member_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-md">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to active user?</h4>
                                                                                    <input type="hidden" name="member_id" id="member_id" value="<?php echo $memberList['member_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="ActiveMember" name="ActiveMember" class="btn btn-danger">Yes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Member Detail Modal -->
                                                                <div id="detailModal<?php echo $memberList['member_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-md">
                                                                        <div class="modal-content">
                                                                          <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title"><?php echo $memberList['member_name']; ?></h4>
                                                                          </div>
                                                                          <div class="modal-body">
                                                                              <div style="margin: 0 0 10px 0;" class="row">
                                                                                <div class="col-md-12 text-center">
                                                                                    <img style="width: 200px; height: 150px;" src="<?php echo baseUrl(); ?>upload/member_image/<?php echo $memberList['member_image']; ?>" class="img-rounded" alt="<?php echo $memberList['member_fname'] .' '. $memberList['member_mname'] .' '. $memberList['member_lname']; ?>">
                                                                                </div>
                                                                              </div>
                                                                              <div class="row">
                                                                                <div class="col-md-12">
                                                                                  <ul class="list-group">
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_username']; ?></span>
                                                                                      Member Username
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_company']; ?></span>
                                                                                      Company Name
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_address']; ?></span>
                                                                                      Address
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_state']; ?></span>
                                                                                      State
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_city']; ?></span>
                                                                                      City
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_zip']; ?></span>
                                                                                      Zip
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_country']; ?></span>
                                                                                      Country
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_phone']; ?></span>
                                                                                      Phone
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_fax']; ?></span>
                                                                                      Fax
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_email']; ?></span>
                                                                                      Email
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_website']; ?></span>
                                                                                      Website
                                                                                    </li>
                                                                                    
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_contact_person']; ?></span>
                                                                                      Contact Person
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_designation']; ?></span>
                                                                                      Contact person Designation
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $memberList['member_year_est']; ?></span>
                                                                                      Established Year
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                        <span class="badge">
                                                                                            <?php
                                                                                                if($memberList['member_primary_business'] == '1') {
                                                                                                  echo "Buyer";
                                                                                                } else if($memberList['member_primary_business'] == '2') {
                                                                                                  echo "Supplier";
                                                                                                } else {
                                                                                                  echo "Buyer & Supplier Both";
                                                                                                }
                                                                                            ?>
                                                                                        </span>
                                                                                        Primary Business Type 
                                                                                    </li>
                                                                                    
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge">
                                                                                        <?php
                                                                                          if($memberList['member_status'] == '0') {
                                                                                            echo "Inactive";
                                                                                          } else {
                                                                                            echo "Active";
                                                                                          }
                                                                                        ?>
                                                                                      </span>
                                                                                      User Status
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge">
                                                                                        <?php
                                                                                          if($memberList['member_is_agreed_tc'] == '0') {
                                                                                            echo "No";
                                                                                          } else {
                                                                                            echo "Yes";
                                                                                          }
                                                                                        ?>
                                                                                      </span>
                                                                                      Is Terms and Condition Agreed ?
                                                                                    </li>
                                                                                  </ul>
                                                                                </div>
                                                                              </div>
                                                                              <div class="panel panel-info">
                                                                                <div class="panel-heading">Member Services</div>
                                                                                <div class="panel-body">
                                                                                    <?php echo html_entity_decode($memberList['member_services']); ?>
                                                                                </div>
                                                                              </div>

                                                                          </div>
                                                                          <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                          </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Member Delete Modal -->
                                                                <div id="deleteModal<?php echo $memberList['member_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to delete?</h4>
                                                                                    <input type="hidden" name="member_id" id="member_id" value="<?php echo $memberList['member_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="DeleteMember" name="DeleteMember" class="btn btn-danger">Yes</button>
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
                                                            <td class="text-center" colspan="8"></td>
                                                            <td class="text-left" colspan="1">
                                                                <a href="add.php">
                                                                    <button class="btn btn-primary btn-block">
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
            $("#listBuyerActive").addClass("active");
            $("#listBuyerActive").parent().parent().addClass("treeview active");
            $("#listBuyerActive").parent().addClass("in");
        </script>

    </body>
</html>
