<?php
include '../../../../config/config.php';
checkAdminLogin();

$i=1;

// Comments All
$sql_comments = "SELECT * FROM blog_comments";
$result_comments = mysqli_query($con, $sql_comments)or die(mysqli_error($con));

// Comment Delete
if (isset($_POST['DeleteBlogComment'])) {
    extract($_POST);

    $sql = "DELETE FROM blog_comments WHERE comment_id=$comment_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $success = "Comment deleted successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

// Comment Publish
if (isset($_POST['publishBlogComment'])) {
    extract($_POST);

    $sql = "UPDATE blog_comments SET blog_comment_publish_status='1' WHERE comment_id=$comment_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
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
        <title>Category List</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp; All Comments</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="categoryList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                    <thead style="background: #E4E3E2;">
                                                        <tr>
                                                            <th style="width: 5%;">SL</th>
                                                            <th style="width: 10%;">Post Image</th>
                                                            <th style="width: 15%;">Post Title</th>
                                                            <th style="width: 30%;">Comment</th>
                                                            <th style="width: 5%;">Created by</th>
                                                            <th style="width: 5%;">Status</th>
                                                            <th style="width: 15%;">Created On</th>
                                                            <th style="width: 15%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                            <?php if ($result_comments): ?>
                                                            <?php while ($commentList = mysqli_fetch_array($result_comments)): ?>
                                                            <tr>
                                                                <td style="width: 5%;"><?php echo $i; ?></td>
                                                                <?php
                                                                    $blog_post_id = $commentList['blog_post_id'];
                                                                    $sqlGetPostData = "SELECT * FROM blog_post WHERE blog_post_id=$blog_post_id";
                                                                    $resultGetPostData = mysqli_query($con, $sqlGetPostData);
                                                                    if ($resultGetPostData) {
                                                                        $objGetPostData = mysqli_fetch_object($resultGetPostData);
                                                                        $blog_post_image = $objGetPostData->blog_post_image;
                                                                        $blog_post_title = $objGetPostData->blog_post_title;
                                                                ?>
                                                                <td style="width: 10%;">
                                                                   <img src="<?php echo baseUrl(); ?>upload/blog_post_image/<?php echo $blog_post_image; ?>" height="40px" width="60px">
                                                                </td>
                                                                <th style="width: 15%;">
                                                                    <?php echo $blog_post_title; ?>
                                                                </th>
                                                                <?php } ?>
                                                                <td style="width: 30%;"><?php echo $commentList['blog_comment']; ?></td>
                                                                <th style="width: 5%;">
                                                                    <?php
                                                                        if($commentList['blog_comment_is_admin'] == '0' && $commentList['blog_comment_is_guest'] == '0') {
                                                                            echo "<span class='badge'>Member</span>";
                                                                        } elseif($commentList['blog_comment_is_guest'] == '1') {
                                                                            echo "<span class='badge'>Guest Visitor</span>";
                                                                        } else {
                                                                            echo "<span class='badge'>Admin</span>";
                                                                        }
                                                                    ?>
                                                                </th>
                                                                <th style="width: 5%;">
                                                                    <?php
                                                                        if($commentList['blog_comment_publish_status'] == '1') {
                                                                            echo "<span class='label label-success'>Published</span>";
                                                                        } else {
                                                                            echo "<span class='label label-danger'>Pending Conformation</span>";
                                                                        }
                                                                    ?>
                                                                </th>
                                                                <td style="width: 15%;">
                                                                    <?php
                                                                        $date=date_create($commentList['blog_comment_created_on']);
                                                                        echo date_format($date,"l, jS \of F Y, h:i A");
                                                                    ?>
                                                                </td>
                                                                <td style="width: 15%;">
                                                                    <?php
                                                                        if($commentList['blog_comment_publish_status'] == '1') {
                                                                            echo "";
                                                                        } else { 
                                                                    ?>
                                                                    <a href="javascript:void(0);"> 
                                                                        <button class="btn btn-success btn-sm" data-toggle="modal" type="button" data-target="#publishModal<?php echo $commentList['comment_id']; ?>"><i class="fa fa-check-circle-o"></i></button>
                                                                    </a>
                                                                    <?php } ?>
                                                                    <a href="javascript:void(0);"> 
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $commentList['blog_category_id']; ?>"><i class="fa fa-trash-o"></i></button>
                                                                    </a>
                                                                </td>
                                                                <!--Publish Modal-->
                                                                <div id="publishModal<?php echo $commentList['comment_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-md">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to publish the post?</h4>
                                                                                    <input type="hidden" name="comment_id" id="comment_id" value="<?php echo $commentList['comment_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="publishBlogComment" name="publishBlogComment" class="btn btn-danger">Yes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!--Delete Modal-->
                                                                <div id="deleteModal<?php echo $commentList['comment_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to delete?</h4>
                                                                                    <input type="hidden" name="comment_id" id="comment_id" value="<?php echo $commentList['comment_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="DeleteBlogComment" name="DeleteBlogComment" class="btn btn-danger">Yes</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </tr>
                                                            <?php $i++; ?>
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
                $('#categoryList').DataTable();
            });
        </script>
        <script type="text/javascript">
            $("#listBlogCommentActive").addClass("active");
            $("#listBlogCommentActive").parent().parent().addClass("treeview active");
            $("#listBlogCommentActive").parent().addClass("in");
        </script>

    </body>
</html>