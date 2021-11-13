<?php
include '../../../../config/config.php';
checkAdminLogin();

$blog_post_id = '';

if (isset($_POST['confPublishBlog'])) {
    extract($_POST);
    $sql_publish = "UPDATE blog_post SET blog_publish_status='1' WHERE blog_post_id=$blog_post_id";
    $result_publish = mysqli_query($con, $sql_publish);
    if ($result_publish) {
        $success = "Blog published successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

if (isset($_POST['deleteBlog'])) {
    extract($_POST);
    $sqlImage = "SELECT * FROM blog_post WHERE blog_post_id=$blog_post_id";
    $resultImage = mysqli_query($con, $sqlImage);
    $dataImage = mysqli_fetch_array($resultImage);
    @unlink($config['IMAGE_UPLOAD_PATH'] . '/blog_post_image/' . $dataImage["blog_post_image"]);
    $sql = "DELETE FROM blog_post WHERE blog_post_id=$blog_post_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $success = "Information deleted successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

//post list show
$sql = "SELECT * FROM blog_post WHERE blog_publish_status='1' ORDER BY blog_post_id DESC";
$result = mysqli_query($con, $sql)or die(mysqli_error($con));

//post list show
$sql_1 = "SELECT * FROM blog_post WHERE blog_publish_status='0' ORDER BY blog_post_id DESC";
$result_1 = mysqli_query($con, $sql_1)or die(mysqli_error($con));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Blog Post List</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Active Blog Post List</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="blogPostList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                    <thead style="background: #E4E3E2;">
                                                        <tr>
                                                            <th style="width: 10%;">Title</th>
                                                            <th style="width: 10%;">Slag</th>
                                                            <th style="width: 15%;">Summery</th>
                                                            <th style="width: 15%;">Details</th>
                                                            <th style="width: 10%;">Image</th>
                                                            <th style="width: 10%;">Created On</th>
                                                            <th style="width: 10%;">Created By</th>
                                                            <th style="width: 20%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                            <?php if ($result): ?>
                                                            <?php while ($blogPostList = mysqli_fetch_array($result)): ?>
                                                            <tr>
                                                                <td style="width: 10%;"><?php echo shorten_string($blogPostList['blog_post_title'], 10); ?></td>
                                                                <td style="width: 10%;"><?php echo shorten_string($blogPostList['blog_post_slag'], 5); ?></td>
                                                                <td style="width: 15%;"><?php echo shorten_string($blogPostList['blog_post_summery'], 5); ?></td>
                                                                <td style="width: 15%;"><?php echo html_entity_decode(shorten_string($blogPostList['blog_post_details'], 5)); ?></td>
                                                                <td style="width: 10%;"><img src="<?php echo baseUrl(); ?>upload/blog_post_image/<?php echo $blogPostList['blog_post_image']; ?>" height="60px" width="100px"></td>
                                                                <td style="width: 10%;">
                                                                    <?php
                                                                        $date=date_create($blogPostList['blog_post_created_on']);
                                                                        echo date_format($date,"l, jS \of F Y, h:i A");
                                                                    ?> 
                                                                </td>
                                                                <th style="width: 10%;">
                                                                    <?php
                                                                        $created_by = $blogPostList['blog_post_is_admin'];
                                                                        if($created_by == '0') {
                                                                            echo "<span class='label label-info'>Member</span>";
                                                                        } else {
                                                                            echo "<span class='label label-primary'>Admin</span>";
                                                                        }
                                                                    ?>
                                                                </th>
                                                                <td class="text-center" style="width: 20%;">
                                                                    <a href="javascript:void(0);"> 
                                                                        <button class="btn btn-info btn-sm" data-toggle="modal" type="button" data-target="#detailModal<?php echo $blogPostList['blog_post_id']; ?>"><i class="fa fa-info-circle"></i></button>
                                                                    </a>
                                                                    <a href="comments.php?post_id=<?php echo $blogPostList['blog_post_id']; ?>"> 
                                                                        <button class="btn btn-success btn-sm" type="button"><i class="fa fa-comments"></i></button>
                                                                    </a>
                                                                    <a href="edit.php?id=<?php echo $blogPostList['blog_post_id']; ?>"> 
                                                                        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-edit"></i></button>
                                                                    </a>
                                                                    <a href="javascript:void(0);"> 
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $blogPostList['blog_post_id']; ?>"><i class="fa fa-trash-o"></i></button>
                                                                    </a>
                                                                </td>
                                                                <!--Detail Modal-->
                                                                <div id="detailModal<?php echo $blogPostList['blog_post_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-md">
                                                                        <div class="modal-content">
                                                                            <!-- Modal content-->
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title"><?php echo $blogPostList['blog_post_title']; ?></h4>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                <p><strong><?php echo $blogPostList['blog_post_summery']; ?></strong></p>
                                                                                <img style="width:100%; height: 300px;;" src="<?php echo baseUrl(); ?>upload/blog_post_image/<?php echo $blogPostList['blog_post_image']; ?>">
                                                                                <hr>
                                                                                <?php echo html_entity_decode($blogPostList['blog_post_details']); ?>
                                                                                <hr>
                                                                                <ul class="list-group">
                                                                                  <li class="list-group-item">Date of Publish 
                                                                                      <span class="badge">
                                                                                        <?php
                                                                                            $date=date_create($blogPostList['blog_post_created_on']);
                                                                                            echo date_format($date,"l, jS \of F Y, h:i A");
                                                                                        ?> 
                                                                                      </span>
                                                                                  </li>
                                                                                  <li class="list-group-item">Posted By 
                                                                                      <span class="badge">
                                                                                          <?php
                                                                                            if($blogPostList['blog_post_is_admin'] == '0') {
                                                                                                echo "<span class='badge'>Member</span>";
                                                                                            } else {
                                                                                                echo "<span class='badge'>Admin</span>";
                                                                                            }
                                                                                          ?>
                                                                                      </span>
                                                                                  </li>
                                                                                  <li class="list-group-item">Total Comments <span class="badge"><?php echo 0; ?></span></li>
                                                                                </ul> 
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                              </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- ./ Detail Modal-->
                                                                <!--Delete Modal-->
                                                                <div id="deleteModal<?php echo $blogPostList['blog_post_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to delete?</h4>
                                                                                    <input type="hidden" name="blog_post_id" id="blog_post_id" value="<?php echo $blogPostList['blog_post_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="deleteBlog" name="deleteBlog" class="btn btn-danger">Yes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- ./ Delete Modal-->
                                                            </tr>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                        </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td class="text-center" colspan="7"></td>
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
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-group">
                                <div class="panel panel-danger">
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Pending Blog Post List</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="blogPostList_pending" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                    <thead style="background: #E4E3E2;">
                                                        <tr>
                                                            <th style="width: 15%;">Image</th>
                                                            <th style="width: 20%;">Title</th>
                                                            <th style="width: 20%;">Summery</th>
                                                            <th style="width: 15%;">Created On</th>
                                                            <th style="width: 20%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                            <?php if ($result_1): ?>
                                                            <?php while ($blogPostList_pending = mysqli_fetch_array($result_1)): ?>
                                                            <tr>
                                                                <td style="width: 15%;"><img src="<?php echo baseUrl(); ?>upload/blog_post_image/<?php echo $blogPostList_pending['blog_post_image']; ?>" height="60px" width="100px"></td>
                                                                <td style="width: 20%;"><?php echo shorten_string($blogPostList_pending['blog_post_title'], 10); ?></td>
                                                                <td style="width: 20%;"><?php echo shorten_string($blogPostList_pending['blog_post_summery'], 5); ?></td>
                                                                <td style="width: 15%;">
                                                                    <?php
                                                                        $date=date_create($blogPostList_pending['blog_post_created_on']);
                                                                        echo date_format($date,"l, jS \of F Y, h:i A");
                                                                    ?> 
                                                                </td>
                                                                <td class="text-center" style="width: 20%;">
                                                                    <a href="javascript:void(0);"> 
                                                                        <button class="btn btn-info btn-sm" data-toggle="modal" type="button" data-target="#detailModal<?php echo $blogPostList_pending['blog_post_id']; ?>"><i class="fa fa-info-circle"></i></button>
                                                                    </a>
                                                                    <a href="javascript:void(0);"> 
                                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" type="button" data-target="#conformModal<?php echo $blogPostList_pending['blog_post_id']; ?>"><i class="fa fa-check-circle"></i></button>
                                                                    </a>
                                                                    <a href="edit.php?id=<?php echo $blogPostList_pending['blog_post_id']; ?>"> 
                                                                        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-edit"></i></button>
                                                                    </a>
                                                                    <a href="javascript:void(0);"> 
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $blogPostList_pending['blog_post_id']; ?>"><i class="fa fa-trash-o"></i></button>
                                                                    </a>
                                                                </td>
                                                                <!--Detail Modal-->
                                                                <div id="detailModal<?php echo $blogPostList_pending['blog_post_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-md">
                                                                        <div class="modal-content">
                                                                            <!-- Modal content-->
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title"><?php echo $blogPostList_pending['blog_post_title']; ?></h4>
                                                                              </div>
                                                                                <div style="max-width: 700px;" class="modal-body">
                                                                                <p><strong><?php echo $blogPostList_pending['blog_post_summery']; ?></strong></p>
                                                                                <img style="width:100%; height: 300px;;" src="<?php echo baseUrl(); ?>upload/blog_post_image/<?php echo $blogPostList_pending['blog_post_image']; ?>">
                                                                                <hr>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <?php echo html_entity_decode($blogPostList_pending['blog_post_details']); ?>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <ul class="list-group">
                                                                                  <li class="list-group-item">Category <span class="badge"><?php echo $blogPostList_pending['blog_category_name']; ?></span></li>
                                                                                  <li class="list-group-item">Date of Publish 
                                                                                      <span class="badge">
                                                                                        <?php
                                                                                            $date=date_create($blogPostList_pending['blog_post_created_on']);
                                                                                            echo date_format($date,"l, jS \of F Y, h:i A");
                                                                                        ?> 
                                                                                      </span>
                                                                                  </li>
                                                                                  <li class="list-group-item">Posted By 
                                                                                      <span class="badge">
                                                                                          <?php
                                                                                            if($blogPostList_pending['blog_post_is_admin'] == '0') {
                                                                                                echo "<span class='badge'>Member</span>";
                                                                                            } else {
                                                                                                echo "<span class='badge'>Admin</span>";
                                                                                            }
                                                                                          ?>
                                                                                      </span>
                                                                                  </li>
                                                                                </ul> 
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                              </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="conformModal<?php echo $blogPostList_pending['blog_post_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to conform the post to be publish ?</h4>
                                                                                    <input type="hidden" name="blog_post_id" id="blog_post_id" value="<?php echo $blogPostList_pending['blog_post_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="confPublishBlog" name="confPublishBlog" class="btn btn-danger">Yes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="deleteModal<?php echo $blogPostList_pending['blog_post_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to delete?</h4>
                                                                                    <input type="hidden" name="blog_post_id" id="blog_post_id" value="<?php echo $blogPostList_pending['blog_post_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="deleteBlog" name="deleteBlog" class="btn btn-danger">Yes</button>
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
                                                            <td class="text-center" colspan="4"></td>
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
                $('#blogPostList').DataTable({
                    "aaSorting": [[1, "asc"]]
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#blogPostList_pending').DataTable({
                    "aaSorting": [[1, "asc"]]
                });
            });
        </script>
        <script type="text/javascript">
            $("#listBlogActive").addClass("active");
            $("#listBlogActive").parent().parent().addClass("treeview active");
            $("#listBlogActive").parent().addClass("in");
        </script>

    </body>
</html>