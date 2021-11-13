<?php
include '../../../config/config.php';
checkAdminLogin();

$buy_requirement_id = '';

if (isset($_POST['DeleteBuyReq'])) {
    extract($_POST);
    $sqlImage = "SELECT * FROM buy_requirement WHERE buy_requirement_id=$buy_requirement_id";
    $resultImage = mysqli_query($con, $sqlImage);
    $dataImage = mysqli_fetch_array($resultImage);
    @unlink($config['IMAGE_UPLOAD_PATH'] . '/buy_requirement_image/' . $dataImage["buy_requirement_image"]);
    $sql = "DELETE FROM buy_requirement WHERE buy_requirement_id=$buy_requirement_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $success = "Buy requirement post has been deleted successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

//Pending buyer request list show
$sql = "SELECT buy_requirement.*, category.*, country.*, keyword.*, member.* FROM buy_requirement "
        . "LEFT JOIN category ON buy_requirement.category_id = category.category_id "
        . "LEFT JOIN country ON buy_requirement.buy_requirement_country = country.country_id "
        . "LEFT JOIN keyword ON buy_requirement.keyword_id = keyword.keyword_id "
        . "LEFT JOIN member ON buy_requirement.member_id = member.member_id "
        . "WHERE buy_requirement_status = '1'";
$result = mysqli_query($con, $sql)or die(mysqli_error($con));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Active Buyer Request Post List</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp; All Active Buyer Requirement Post List</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="buyRequirmentList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                        <thead style="background: #E4E3E2;">
                                                            <tr>
                                                                <th style="width: 10%;">Avater</th>
                                                                <th style="width: 10%;">Title</th>
                                                                <th style="width: 15%;">Category</th>
                                                                <th style="width: 10%;">Keyword</th>
                                                                <th style="width: 10%;">Member</th>
                                                                <th style="width: 10%;">Date</th>
                                                                <th style="width: 10%;">Country</th>
                                                                <th style="width: 5%;">Status</th>
                                                                <th style="width: 20%;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if ($result): ?>
                                                            <?php while ($buyRequirmentList = mysqli_fetch_array($result)): ?>
                                                            <tr>
                                                                <td style="width: 10%;"><img style="width: 100%; height: auto;" src="<?php echo baseUrl(); ?>upload/buy_requirement_image/<?php if($buyRequirmentList['buy_requirement_image']) { echo $buyRequirmentList['buy_requirement_image']; } else { echo 'no_preview.jpg'; } ?>" height="50px" width="50px"></td>
                                                                <td style="width: 10%;"><?php echo $buyRequirmentList['buy_requirement_title']; ?></td>
                                                                <td style="width: 15%;"><?php echo $buyRequirmentList['category_name']; ?></td>
                                                                <td style="width: 10%;"><?php echo $buyRequirmentList['keyword_name']; ?></td>
                                                                <td style="width: 10%;"><?php echo $buyRequirmentList['member_name']; ?></td>
                                                                <td style="width: 10%;"><?php echo $buyRequirmentList['buy_requirement_date']; ?></td>
                                                                <td style="width: 10%;"><?php echo $buyRequirmentList['country_name']; ?></td>
                                                                <td style="width: 5%;">
                                                                  <?php
                                                                    if($buyRequirmentList['buy_requirement_status'] == '0') {
                                                                      echo "<span class='label label-danger'>Pending Conformation</span>";
                                                                    } else {
                                                                      echo "<span class='label label-success'>Published</span>";
                                                                    }
                                                                  ?>
                                                                </td>
                                                                
                                                                <td style="width: 20%;">
                                                                    <a href="javascript:void(0);">
                                                                        <button class="btn btn-info btn-sm" data-toggle="modal" type="button" data-target="#detailModal<?php echo $buyRequirmentList['buy_requirement_id']; ?>" title="User Detail"><i class="fa fa-info-circle"></i> Detail</button>
                                                                    </a>
                                                                    <a href="javascript:void(0);">
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $buyRequirmentList['buy_requirement_id']; ?>" title="Delete User Detail"><i class="fa fa-trash-o"></i> Delete</button>
                                                                    </a>
                                                                </td>
                                                                
                                                                <!-- Post Detail Modal -->
                                                                <div id="detailModal<?php echo $buyRequirmentList['buy_requirement_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-md">
                                                                        <div class="modal-content">
                                                                          <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                            <h4 class="modal-title"><?php echo $buyRequirmentList['buy_requirement_title']; ?></h4>
                                                                          </div>
                                                                          <div class="modal-body">
                                                                              <div style="margin: 0 0 10px 0;" class="row">
                                                                                <div class="col-md-12 text-center">
                                                                                    <img style="width: 100%; height: 300px;" src="<?php echo baseUrl(); ?>upload/buy_requirement_image/<?php echo $buyRequirmentList['buy_requirement_image']; ?>" class="img-rounded" alt="No Image ToBe Shown">
                                                                                </div>
                                                                              </div>
                                                                              <div class="row">
                                                                                <div class="col-md-12">
                                                                                  <ul class="list-group">
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $buyRequirmentList['buy_requirement_title']; ?></span>
                                                                                      Title
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $buyRequirmentList['member_name']; ?></span>
                                                                                      Member Name
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $buyRequirmentList['category_name']; ?></span>
                                                                                      Category
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $buyRequirmentList['keyword_name']; ?></span>
                                                                                      Keyword
                                                                                    </li>
                                                                                    <li class="list-group-item">
                                                                                      <span class="badge"><?php echo $buyRequirmentList['buy_requirement_date']; ?></span>
                                                                                      Date of Post
                                                                                    </li>
                                                                                  </ul>
                                                                                </div>
                                                                              </div>
                                                                              <div class="panel panel-info">
                                                                                <div class="panel-heading">Requirement Post Detail</div>
                                                                                <div class="panel-body">
                                                                                    <?php echo html_entity_decode($buyRequirmentList['buy_requirement_detail']); ?>
                                                                                </div>
                                                                              </div>

                                                                          </div>
                                                                          <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                          </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        
                                                                <!-- Active Post Modal -->
                                                                <div id="activeUser<?php echo $buyRequirmentList['buy_requirement_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-md">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to publish the post ?</h4>
                                                                                    <input type="hidden" name="buy_requirement_id" id="buy_requirement_id" value="<?php echo $buyRequirmentList['buy_requirement_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="ActiveBuyReqPost" name="ActiveBuyReqPost" class="btn btn-danger">Yes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        
                                                                <!-- Member Delete Modal -->
                                                                <div id="deleteModal<?php echo $buyRequirmentList['buy_requirement_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to delete the post ?</h4>
                                                                                    <input type="hidden" name="buy_requirement_id" id="buy_requirement_id" value="<?php echo $buyRequirmentList['buy_requirement_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="DeleteBuyReq" name="DeleteBuyReq" class="btn btn-danger">Yes</button>
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
                $('#buyRequirmentList').DataTable({
                    "aaSorting": [[1, "asc"]]
                });
            });
        </script>
        <script type="text/javascript">
            $("#plistBuyerReqActive").addClass("active");
            $("#plistBuyerReqActive").parent().parent().addClass("treeview active");
            $("#plistBuyerReqActive").parent().addClass("in");
        </script>

    </body>
</html>
