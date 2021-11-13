<?php
include '../../../../config/config.php';
checkAdminLogin();

$blog_post_is_admin = '1';
$blog_category_id = '';
$blog_post_title = '';
$blog_post_slag = '';
$blog_post_summery = '';
$blog_post_details = '';
$blog_post_image = '';
$blog_post_created_on = date('d/m/Y');
$blog_post_month = date('m');
$blog_post_year = date('Y');
$blog_publish_status = '1';
$blog_post_created_by = getSession('admin_id');

// Creating Slug
function create_slug($string){
   $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   return $slug;
}

/*
 * Getting blog category
 */
$arrayBlogCatCategory = array();
$sql = "SELECT * FROM blog_category";
$result = mysqli_query($con, $sql);
if ($result) {
    while ($obj = mysqli_fetch_object($result)) {
        $arrayBlogCatCategory[] = $obj;
    }
}

// Save blog post information
if (isset($_POST['addBlogPost'])) {
    extract($_POST);

    $blog_category_id = validateInput($blog_category_id);
    $blog_post_title = validateInput($blog_post_title);
    $blog_post_slag = create_slug($blog_post_title);
    $blog_post_summery = validateInput($blog_post_summery);
    $blog_post_details = addslashes($blog_post_details);
    $blog_post_month = validateInput($blog_post_month);
    $blog_post_year = validateInput($blog_post_year);
    $blog_publish_status = validateInput($blog_publish_status);


    if (empty($blog_post_title) || $blog_post_title === '') {
        $error = "Blog Title required";
    } else if (empty($blog_post_details) || $blog_post_details === '') {
        $error = "Blog Details required";
    } else {

        // Image upload code
        if ($_FILES['blog_post_image']['name']) { // Check if image file posted or not
            $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/blog_post_image/'; // Target directory where image will save or store
            $targetFile = '';
            $fileType = pathinfo(basename($_FILES['blog_post_image']['name']), PATHINFO_EXTENSION);
            // File type such as .jpg, .png, .jpeg, .gif
            if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif' && $fileType != 'JPG') { // Check file is in mentioned format or not
                $flag++;
                $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
            } else {
                if ($_FILES['blog_post_image']['size'] > (1024000)) { // Check file size. File size must be less than 1MB
                    $flag++;
                    $error = 'Image size is too large. Must be less than 1MB';
                } else {
                    $renameFile = "MI" . date('YmdHis') . '.' . $fileType; // Rename the file name
                    $targetFile = $targetDirectory . $renameFile; // Target image file
                    move_uploaded_file($_FILES['blog_post_image']['tmp_name'], $targetFile);
                    $flag = 0;
                }
            }
        }

        // Image upload code end
        if ($flag == 0) {
            $customArray = '';
            $customArray .= 'blog_post_title = "' . $blog_post_title . '"';
            $customArray .= ',blog_post_slag = "' . $blog_post_slag . '"';
            $customArray .= ',blog_post_summery = "' . $blog_post_summery . '"';
            $customArray .= ',blog_post_details = "' . $blog_post_details . '"';
            $customArray .= ',blog_post_image = "' . $renameFile . '"';
            $customArray .= ',blog_category_id = "' . $blog_category_id . '"';
            $customArray .= ',blog_post_is_admin = "' . $blog_post_is_admin . '"';
            $customArray .= ',blog_post_month = "' . $blog_post_month . '"';
            $customArray .= ',blog_post_year = "' . $blog_post_year . '"';
            $customArray .= ',blog_publish_status = "' . $blog_publish_status . '"';
            $customArray .= ',blog_post_created_on = "' . $blog_post_created_on . '"';
            $customArray .= ',blog_post_created_by = "' . $blog_post_created_by . '"';

            // save / insert value in table and show a message
            $sqlInsertPost = "INSERT INTO blog_post SET $customArray";
            $resultInsertPost = mysqli_query($con, $sqlInsertPost);
            if ($resultInsertPost) {
                $success = "Post information saved successfully";
            } else {
                $error = "Blog Post Saved Successfully" . mysqli_error($con);
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
        <title>Add Post</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp; Add Post</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="blog_post_is_admin" value="1" />
                                                        <label for="blog_post_title">Title &nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="blog_post_title" name="blog_post_title" value="<?php echo $blog_post_title; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <!--<div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="blog_post_slag">Slag &nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="blog_post_slag" name="blog_post_slag" value="<?php echo $blog_post_slag; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="blog_post_summery">Summery</label>
                                                        <textarea class="form-control" style="resize: vertical" name="blog_post_summery" id="blog_post_summery" rows="3"><?php echo $blog_post_summery; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="blog_post_details">Description&nbsp;<span id="mark">*</span></label>
                                                        <textarea class="form-control" style="resize: vertical" name="blog_post_details" id="blog_post_details" rows="3"><?php echo html_entity_decode($blog_post_details, ENT_QUOTES | ENT_IGNORE, "UTF-8"); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <!--<div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="blog_category_id">Post Category&nbsp;<span id="mark">*</span></label>
                                                        <select name="blog_category_id" id="blog_category_id" class="form-control">
                                                            <option value="">--</option>
                                                            <?php if (count($arrayBlogCatCategory) > 0): ?>
                                                                <?php foreach ($arrayBlogCatCategory AS $category): ?>
                                                                    <option value="<?php echo $category->blog_category_id; ?>"<?php
                                                                    if ($blog_category_id === $category->blog_category_id) {
                                                                        echo "selected = selected";
                                                                    }
                                                                    ?>><?php echo $category->blog_category_name; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>-->
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="blog_post_image">Feature Image</label>
                                                        <input type="file" name="blog_post_image" id="blog_post_image" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($blog_post_image): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/blog_post_image/<?php echo $blog_post_image; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php else: ?>
                                                            <img src="<?php echo baseUrl('admin/images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 100px;width: 100px;" />
                                                        <?php endif; ?>                              
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addBlogPost" class="btn btn-primary">Submit</button>
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
        <script type="text/javascript">
            $("#addPostActive").addClass("active");
            $("#addPostActive").parent().parent().addClass("treeview active");
            $("#addPostActive").parent().addClass("in");
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

