<?php
include '../../../config/config.php';
checkAdminLogin();

$slider_id = '';

if (isset($_POST['DeleteSlider'])) {
    extract($_POST);
    
    $sqlImage = "SELECT * FROM slider WHERE slider_id=$slider_id";
    $resultImage = mysqli_query($con, $sqlImage);
    $dataImage = mysqli_fetch_array($resultImage);
    @unlink($config['IMAGE_UPLOAD_PATH'] . '/slider_image/' . $dataImage["slider_image"]);
    $sql = "DELETE FROM slider WHERE slider_id=$slider_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $success = "Information deleted successfully";
    } else {
        $error = "Something went wrong. Please try again.";
    }
}

//sliderList Show
$sql = "SELECT * FROM slider";
$result = mysqli_query($con, $sql)or die(mysqli_error($con));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Slider List</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Slider list</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <div class="row">
                                            <div class="col-md-12" style="background-color: #E4E3E2">
                                                <table id="sliderList" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                                    <thead style="background: #E4E3E2;">
                                                        <tr>
                                                            <th style="width: 30%;">Title</th>
                                                            <th style="width: 30%;">Details</th>
                                                            <th style="width: 10%;">Image</th>
                                                            <th style="width: 20%;">Created On</th>
                                                            <th style="width: 10%;">Action</th>
                                                        </tr>
                                                    </thead>
                                                        <tbody>
                                                            <?php if ($result): ?>
                                                            <?php while ($sliderList = mysqli_fetch_array($result)): ?>
                                                            <tr>
                                                                <td style="width: 30%;"><?php echo $sliderList['slider_title']; ?></td>
                                                                <td style="width: 30%;"><?php echo $sliderList['slider_details']; ?></td>
                                                                <td style="width: 10%;"><img src="<?php echo baseUrl(); ?>upload/slider_image/<?php echo $sliderList['slider_image']; ?>" height="60px" width="100px"></td>
                                                                <td style="width: 20%;"><?php echo $sliderList['slider_created_on']; ?></td>
                                                                <td style="width: 10%;">
                                                                    <a href="edit.php?id=<?php echo $sliderList['slider_id']; ?>"> 
                                                                        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-edit"></i></button>
                                                                    </a>
                                                                    <a href="javascript:void(0);"> 
                                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" type="button" data-target="#deleteModal<?php echo $sliderList['slider_id']; ?>"><i class="fa fa-trash-o"></i></button>
                                                                    </a>

                                                                </td>
                                                                <div id="deleteModal<?php echo $sliderList['slider_id']; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog modal-sm">
                                                                        <div class="modal-content">
                                                                            <form method="POST">
                                                                                <div class="modal-header">
                                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                    <h4 class="modal-title">Are you sure you want to delete?</h4>
                                                                                    <input type="hidden" name="slider_id" id="slider_id" value="<?php echo $sliderList['slider_id']; ?>" />
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                    <button type="submit" id="DeleteSlider" name="DeleteSlider" class="btn btn-danger">Yes</button>
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
            $("#listSliderActive").addClass("active");
            $("#listSliderActive").parent().parent().addClass("treeview active");
            $("#listSliderActive").parent().addClass("in");
        </script>

    </body>
</html>