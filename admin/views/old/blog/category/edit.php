<?php
include '../../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$blog_category_id = '';
$blog_category_name = '';
$blog_category_desc = '';
$flag = 0;

if (isset($_GET['id'])) {
    $blog_category_id = $_GET['id'];
}


// Save category information
if (isset($_POST['updateBlogCategory'])) {
    extract($_POST);

    $blog_category_id = validateInput($blog_category_id);
    $blog_category_name = validateInput($blog_category_name);
    $blog_category_desc = validateInput($blog_category_desc);
    
    // Redirect URL if category id not found
    if ($blog_category_id == '') {
        $link = baseUrl() . "views/blog/category/list.php";
        redirect($link);
    } else {
        // Checking category already exists or not
        $sqlCheck = "SELECT * FROM blog_category"
                . " WHERE blog_category_name='$blog_category_name' AND blog_category_id NOT IN (" . $blog_category_id . ")";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $error = "A category already exists with the same name";
        }
            if ($flag == 0) {
            $customArray = '';
            $customArray .= 'blog_category_name = "' . $blog_category_name . '"';
            $customArray .= ',blog_category_desc = "' . $blog_category_desc . '"';

            //Updated category data
            $sqlUpdateCategory = "UPDATE blog_category SET $customArray WHERE blog_category_id=$blog_category_id";
            $resultUpdateCategory = mysqli_query($con, $sqlUpdateCategory);
            if ($resultUpdateCategory) {
                $success = "Category information updated successfully";
            } else {
                $error = "Category information update failed for " . mysqli_error($con);
            }
        }
    }
}

// Get category data
$sqlGetData = "SELECT * FROM blog_category WHERE blog_category_id=$blog_category_id";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $blog_category_name = $objGetData->blog_category_name;
    $blog_category_desc = $objGetData->blog_category_desc;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Add Category</title>
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
                                        <form role="form" method="POST" action="<?php echo baseUrl(); ?>admin/views/blog/category/edit.php?id=<?php echo $blog_category_id; ?>">
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
                                                        <button type="submit" id="updateBlogCategory" name="updateBlogCategory" class="btn btn-primary">Submit</button>
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
            $("#blogcatSetting").append("<li id='editBlogCatActive'><a href=''><i class='fa fa-circle-o'></i>Edit Blog Category</a></li>");
            $("#editBlogCatActive").addClass("active");
            $("#editBlogCatActive").parent().parent().addClass("treeview active");
            $("#editBlogCatActive").parent().addClass("in");
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