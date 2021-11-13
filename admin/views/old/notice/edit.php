<?php
include '../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$notice_id = '';
$notice_detail = '';
$notice_status = '';
$flag = 0;

if (isset($_GET['id'])) {
    $notice_id = $_GET['id'];
}

// Save notice information
if (isset($_POST['updateNotice'])) {
    extract($_POST);

    $notice_id = validateInput($notice_id);
    $notice_detail = validateInput($notice_detail);
    $notice_status = validateInput($notice_status);
    
    // Redirect URL if notice id not found
    if ($notice_id == '') {
        $link = baseUrl() . "views/notice/list.php";
        redirect($link);
    } else {
        // Checking notice already exists or not
        $sqlCheck = "SELECT * FROM notice"
                . " WHERE notice_detail='$notice_detail' AND notice_id NOT IN (" . $notice_id . ")";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $error = "A notice is already exists with the same name";
        }
            if ($flag == 0) {
            $customArray = '';
            $customArray .= 'notice_detail = "' . $notice_detail . '"';
            $customArray .= ',notice_status = "' . $notice_status . '"';

            //Updated category data
            $sqlUpdateCategory = "UPDATE notice SET $customArray WHERE notice_id=$notice_id";
            $resultUpdateCategory = mysqli_query($con, $sqlUpdateCategory);
            if ($resultUpdateCategory) {
                $success = "Notice information updated successfully";
            } else {
                $error = "Notice information update failed for " . mysqli_error($con);
            }
        }
    }
}

// Get category data
$sqlGetData = "SELECT * FROM notice WHERE notice_id=$notice_id";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $notice_detail = $objGetData->notice_detail;
    $notice_status = $objGetData->notice_status;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Edit Notice</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Edit Notice</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form role="form" method="POST" action="<?php echo baseUrl(); ?>admin/views/notice/edit.php?id=<?php echo $notice_id; ?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="notice_detail">Notice Detail&nbsp;<span id="mark">*</span></label>
                                                        <textarea class="form-control" style="resize: vertical" name="notice_detail" id="notice_detail" rows="3"><?php echo stripslashes($notice_detail); ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="notice_status">Notice Status</label>
                                                        <select class="form-control" id="notice_status" name="notice_status" required>
                                                            <option value="1" <?php if($notice_status == '1') { echo "selected"; } ?>>Active</option>
                                                            <option value="0" <?php if($notice_status == '0') { echo "selected"; } ?>>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" id="updateNotice" name="updateNotice" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                        </form>
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
                $("#notice_detail").kendoEditor({
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
        <script type="text/javascript">
            $("#blogcatSetting").append("<li id='editBlogCatActive'><a href=''><i class='fa fa-circle-o'></i>Edit Blog Category</a></li>");
            $("#editBlogCatActive").addClass("active");
            $("#editBlogCatActive").parent().parent().addClass("treeview active");
            $("#editBlogCatActive").parent().addClass("in");
        </script>
    </body>
</html>