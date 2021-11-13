<?php
include '../../../config/config.php';
checkAdminLogin();

$keyword_id = '';

if (isset($_POST['DeleteKeyword'])) {
    extract($_POST);
    
    $sqlImage = "SELECT * FROM keyword WHERE keyword_id=$keyword_id";
    $resultImage = mysqli_query($con, $sqlImage);
    $dataImage = mysqli_fetch_array($resultImage);
    @unlink($config['IMAGE_UPLOAD_PATH'] . '/keyword_image/' . $dataImage["keyword_image"]);
    $sql = "DELETE FROM keyword WHERE keyword_id=$keyword_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $success = "Information deleted successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

//sliderList Show
$sql = "SELECT * FROM keyword";
$result = mysqli_query($con, $sql)or die(mysqli_error($con));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Keyword List</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Keyword list</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="sliderList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                    <thead style="background: #E4E3E2;">
                                                        <tr>
                                                            <th style="width: 15%;">Image</th>
                                                            <th style="width: 35%;">Keyword Title</th>
                                                            <th style="width: 20%;">Popularity</th>
                                                            <th style="width: 20%;">Created On</th>
                                                            <th style="width: 10%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                            <?php if ($result): ?>
                                                            <?php while ($keywordList = mysqli_fetch_array($result)): ?>
                                                            <tr>
                                                                <td style="width: 15%;"><img src="<?php echo baseUrl(); ?>upload/keyword_image/<?php echo $keywordList['keyword_image']; ?>" height="50px" width="50px"></td>
                                                                <td style="width: 35%;"><?php echo $keywordList['keyword_name']; ?></td>
                                                                <td style="width: 20%;">
                                                                    <?php 
                                                                        if($keywordList['keyword_popularity'] == '1') {
                                                                            echo "<span class='label label-success'>Popular Keyword</span>";
                                                                        } else {
                                                                            echo "<span class='label label-primary'>General Keyword</span>";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td style="width: 20%;"><?php echo $keywordList['created_at']; ?></td>
                                                                <td style="width: 10%;">
                                                                    <a href="edit.php?id=<?php echo $keywordList['keyword_id']; ?>"> 
                                                                        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-edit"></i></button>
                                                                    </a>
                                                                    <a href="javascript:void(0);"> 
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $keywordList['keyword_id']; ?>"><i class="fa fa-trash-o"></i></button>
                                                                    </a>

                                                                </td>
                                                                <div id="deleteModal<?php echo $keywordList['keyword_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to delete?</h4>
                                                                                    <input type="hidden" name="keyword_id" id="keyword_id" value="<?php echo $keywordList['keyword_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="DeleteKayword" name="DeleteKayword" class="btn btn-danger">Yes</button>
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
                $('#sliderList').DataTable({
                    "aaSorting": [[1, "asc"]]
                });
            });
        </script>
        <script type="text/javascript">
            $("#listKeywordActive").addClass("active");
            $("#listKeywordActive").parent().parent().addClass("treeview active");
            $("#listKeywordActive").parent().addClass("in");
        </script>

    </body>
</html>