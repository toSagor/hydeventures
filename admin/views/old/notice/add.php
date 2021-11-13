<?php
include '../../../config/config.php';
checkAdminLogin();

$notice_detail = '';
$notice_status = '1';
$created_at = date('Y-m-d H:i:s');

// Save notice information
if (isset($_POST['addNotice'])) {
    extract($_POST);
    $notice_detail = validateInput($notice_detail);
    $notice_status = validateInput($notice_status);

    if (empty($notice_detail) || $notice_detail === '') {
        $error = "Notice detail required";
    } else {
        // Check duplicate entry using notice name.
        $sqlCheck = "SELECT * FROM notice"
                . " WHERE notice_detail='$notice_detail'";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $flag++;
            $error = "A same notice exists with the same name";
        }

        if ($flag == 0) {
            $customArray = '';
            $customArray .= 'notice_detail = "' . $notice_detail . '"';
            $customArray .= ',notice_status = "' . $notice_status . '"';
            $customArray .= ',created_at = "' . $created_at . '"';

            // save / insert value in table and show a message
            $sqlInsertBlogCategory = "INSERT INTO notice SET $customArray";
            $resultInsertBlogCategory = mysqli_query($con, $sqlInsertBlogCategory);
            if ($resultInsertBlogCategory) {
                $success = "Notice information saved successfully";
                $notice_detail = $notice_status = '';
            } else {
                $error = "Notice information addition failed for " . mysqli_error($con);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Add Notice</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Add Category</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="notice_detail">Notice Detail&nbsp;<span id="mark">*</span></label>
                                                        <textarea class="form-control" id="notice_detail" name="notice_detail" rows="2" placeholder="Type Notice Detail .." required>
                                                            <?php echo $notice_detail; ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addNotice" class="btn btn-primary">Submit</button>
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
            $("#noticeAddActive").addClass("active");
            $("#noticeAddActive").parent().parent().addClass("treeview active");
            $("#noticeAddActive").parent().addClass("in");
        </script>
    </body>
</html>
