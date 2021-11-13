<?php
include '../../../../config/config.php';
checkAdminLogin();

$i = 1;
$blog_comment = '';
$blog_comment_is_admin = '1';
$blog_comment_publish_status = '0';
$blog_comment_created_on = date('Y-m-d H:i:s');
$blog_comment_created_by = getSession('admin_id');

if (isset($_GET['post_id'])) {
    $blog_post_id = $_GET['post_id'];
}

// Save post information
if (isset($_POST['commentblogPost'])) {
    extract($_POST);
    $blog_post_id = validateInput($blog_post_id);
    $blog_comment_is_admin = validateInput($blog_comment_is_admin);
    $blog_comment = validateInput($blog_comment);
    $blog_comment_created_by = validateInput($blog_comment_created_by);
    
    $customArray = '';
    $customArray .= 'blog_post_id = "' . $blog_post_id . '"';
    $customArray .= ',blog_comment = "' . $blog_comment . '"';
    $customArray .= ',blog_comment_is_admin = "' . $blog_comment_is_admin . '"';
    $customArray .= ',blog_comment_created_on = "' . $blog_comment_created_on . '"';
    $customArray .= ',blog_comment_created_by = "' . $blog_comment_created_by . '"';
    $customArray .= ',blog_comment_publish_status = "' . $blog_comment_publish_status . '"';
    
    // save / insert value in table and show a message
    $sqlInsertPostComment = "INSERT INTO blog_comments SET $customArray";
    $resultInsertPostComment = mysqli_query($con, $sqlInsertPostComment);
    if ($resultInsertPostComment) {
        $success = "Post comment saved successfully";
        $link = baseUrl() . 'admin/views/blog/post/list.php';
        redirect($link);
    } else {
        $error = "Blog Post Saved Successfully" . mysqli_error($con);
    }
}

// Get post data
$sqlGetData = "SELECT * FROM blog_post WHERE blog_post_id=$blog_post_id";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $blog_category_id = $objGetData->blog_category_id;
    $blog_post_title = $objGetData->blog_post_title;
    $blog_post_slag = $objGetData->blog_post_slag;
    $blog_post_summery = $objGetData->blog_post_summery;
    $blog_post_details = $objGetData->blog_post_details;
    $blog_post_image = $objGetData->blog_post_image;
    $blog_post_created_on = $objGetData->blog_post_created_on;
    
}

// Comments All
//categoryList Show
$sql_comments = "SELECT * FROM blog_comments WHERE blog_post_id='$blog_post_id'";
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
        <title>Comments - <?php echo $blog_post_title; ?></title>
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
                            <?php include basePath('admin/message.php'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-group">
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-style"><i class="fa fa-desktop"></i> Post Preview</div>
                                    <div class="panel-body">
                                       <div class="well">
                                            <div class="media">
                                                <a class="pull-left" href="#">
                                                    <img style="height: 200px; width: 250px;" class="media-object" src="<?php echo baseUrl(); ?>upload/blog_post_image/<?php echo $blog_post_image; ?>">
                                                </a>
                                                <div class="media-body">
                                                    <a href="#"><h4 class="media-heading"><?php echo $blog_post_title; ?></h4></a>
                                                    <p><?php echo $blog_post_summery; ?></p>
                                                    <ul class="list-inline list-unstyled">
                                                        <li><span><i class="glyphicon glyphicon-calendar"></i> 
                                                            <?php
                                                                $date=date_create($blog_post_created_on);
                                                                echo date_format($date,"l, jS \of F Y, h:i A");
                                                            ?>
                                                        </span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel-group">
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-style"><i class="fa fa-pencil-square"></i>&nbsp; Write a Comment</div>
                                    <div class="panel-body">
                                        <form method="POST" action="">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="blog_comment">Comment</label>
                                                        <textarea class="form-control" style="resize: vertical" name="blog_comment" id="blog_comment" rows="3" placeholder="Write a comment for this post .."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <button type="submit" id="commentblogPost" name="commentblogPost" class="btn btn-primary">Comment Now</button>
                                                    </div>
                                                </div>
                                            </div>    
                                            <br>
                                        </form>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-group">
                                <div class="panel panel-primary">
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp; All Comments of this post</div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="categoryList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                    <thead style="background: #E4E3E2;">
                                                        <tr>
                                                            <th style="width: 10%;">SL</th>
                                                            <th style="width: 40%;">Comment</th>
                                                            <th style="width: 10%;">Created by</th>
                                                            <th style="width: 10%;">Status</th>
                                                            <th style="width: 15%;">Created On</th>
                                                            <th style="width: 15%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                            <?php if ($result_comments): ?>
                                                            <?php while ($commentList = mysqli_fetch_array($result_comments)): ?>
                                                            <tr>
                                                                <td style="width: 10%;"><?php echo $i; ?></td>
                                                                <td style="width: 40%;"><?php echo $commentList['blog_comment']; ?></td>
                                                                <th style="width: 10%;">
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
                                                                <th style="width: 10%;">
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
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $commentList['comment_id']; ?>"><i class="fa fa-trash-o"></i></button>
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
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#show_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#blog_post_image").change(function () {
                readURL(this);
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#categoryList').DataTable();
            });
        </script>
        <script type="text/javascript">
            $("#blogSetting").append("<li id='commentBlogPostActive'><a href=''><i class='fa fa-circle-o'></i>Comments</a></li>");
            $("#commentBlogPostActive").addClass("active");
            $("#commentBlogPostActive").parent().parent().addClass("treeview active");
            $("#commentBlogPostActive").parent().addClass("in");
        </script>
        <script>
            $(document).ready(function () {
                $("#blog_post_details").kendoEditor({
                    tools: [
                        "bold", "italic", "underline", "strikethrough", "justifyLeft", "justifyCenter", "justifyRight", "justifyFull",
                        "insertUnorderedList", "insertOrderedList", "indent", "outdent", "createLink", "unlink", "insertImage",
                        "insertFile", "subscript", "superscript", "createTable", "addRowAbove", "addRowBelow", "addColumnLeft",
                        "addColumnRight", "deleteRow", "deleteColumn", "viewHtml", "formatting", "cleanFormatting",
                        "fontName", "fontSize", "foreColor", "backColor"
                    ]
                });
            });
        </script>
    </body>
</html>


