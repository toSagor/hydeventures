<?php
include '../../../../config/config.php';
checkAdminLogin();

$blog_category_name = '';
$blog_category_desc = '';
$blog_category_created_on = date('Y-m-d H:i:s');
$blog_category_created_by = getSession('admin_id');

// Save category information
if (isset($_POST['addBlogCategory'])) {
    extract($_POST);
    $blog_category_name = validateInput($blog_category_name);
    $blog_category_desc = validateInput($blog_category_desc);

    if (empty($blog_category_name) || $blog_category_name === '') {
        $error = "Category name required";
    } else {
        // Check duplicate entry using category name.
        $sqlCheck = "SELECT * FROM blog_category"
                . " WHERE blog_category_name='$blog_category_name'";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $flag++;
            $error = "A category already exists with the same name";
        }

        if ($flag == 0) {
            $customArray = '';
            $customArray .= 'blog_category_name = "' . $blog_category_name . '"';
            $customArray .= ',blog_category_desc = "' . $blog_category_desc . '"';
            $customArray .= ',blog_category_created_on = "' . $blog_category_created_on . '"';
            $customArray .= ',blog_category_created_by = "' . $blog_category_created_by . '"';

            // save / insert value in table and show a message
            $sqlInsertBlogCategory = "INSERT INTO blog_category SET $customArray";
            $resultInsertBlogCategory = mysqli_query($con, $sqlInsertBlogCategory);
            if ($resultInsertBlogCategory) {
                $success = "Category information saved successfully";
                $blog_category_name = $blog_category_desc = '';
            } else {
                $error = "Category information addition failed for " . mysqli_error($con);
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
        <title>Add Blog Category</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Add Blog Category</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="blog_category_name">Blog Category Name&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="blog_category_name" name="blog_category_name" value="<?php echo $blog_category_name; ?>" class="form-control" />
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="blog_category_desc">Category Details</label>
                                                        <textarea class="form-control" style="resize: vertical" name="blog_category_desc" id="blog_category_desc" rows="3"><?php echo html_entity_decode($blog_category_desc, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addBlogCategory" class="btn btn-primary">Submit</button>
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
        <script type="text/javascript">
            $("#addBlogCatActive").addClass("active");
            $("#addBlogCatActive").parent().parent().addClass("treeview active");
            $("#addBlogCatActive").parent().addClass("in");
        </script>
        <script>
            $(document).ready(function () {
                $("#blog_category_desc").kendoEditor({
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
