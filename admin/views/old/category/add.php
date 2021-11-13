<?php
include '../../../config/config.php';
checkAdminLogin();

$category_name = '';
$category_section = '';
$created_at = date('Y-m-d H:i:s');

// Save category information
if (isset($_POST['addCategory'])) {
    extract($_POST);
    $category_name = validateInput($category_name);
    $category_section = validateInput($category_section);

    if (empty($category_name) || $category_name === '') {
        $error = "Category name required";
    } else {
        // Check duplicate entry using category name.
        $sqlCheck = "SELECT * FROM category"
                . " WHERE category_name='$category_name'";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $flag++;
            $error = "A category already exists with the same name";
        }

        if ($flag == 0) {
            $customArray = '';
            $customArray .= 'category_name = "' . $category_name . '"';
            $customArray .= ',category_section = "' . $category_section . '"';
            $customArray .= ',created_at = "' . $created_at . '"';

            // save / insert value in table and show a message
            $sqlInsertBlogCategory = "INSERT INTO category SET $customArray";
            $resultInsertBlogCategory = mysqli_query($con, $sqlInsertBlogCategory);
            if ($resultInsertBlogCategory) {
                $success = "Category information saved successfully";
                $category_name = $category_section = '';
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
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="category_name">Category Name&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="category_name" name="category_name" value="<?php echo $category_name; ?>" class="form-control" required/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="category_section">Select a category section <span id="mark">*</span></label>
                                                        <select class="form-control" id="member_gender" name="category_section" required>
                                                            <option value="">Select Any ..</option>
                                                            <option value="1">Agricultural & Food products</option>
                                                            <option value="2">Personal & Entertainment</option>
                                                            <option value="3">Computers & Electronics</option>
                                                            <option value="4">Household & Furnishing</option>
                                                            <option value="5">Industrial & Automotive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addCategory" class="btn btn-primary">Submit</button>
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
            $("#categoryAddActive").addClass("active");
            $("#categoryAddActive").parent().parent().addClass("treeview active");
            $("#categoryAddActive").parent().addClass("in");
        </script>
        <script>
            $(document).ready(function () {
                $("#category_section").kendoEditor({
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
