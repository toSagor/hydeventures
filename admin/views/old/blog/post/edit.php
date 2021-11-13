<?php
include '../../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$blog_category_id = '';
$blog_post_title = '';
$blog_post_slag = '';
$blog_post_summery = '';
$blog_post_details = '';
$blog_post_image = '';
$blog_post_updated_on = date('Y-m-d H:i:s');
$blog_post_updated_by = getSession('admin_id');
$renameFile = '';
$flag = 0;

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

if (isset($_GET['id'])) {
    $blog_post_id = $_GET['id'];
}

// Save post information
if (isset($_POST['updateblogPost'])) {
    extract($_POST);

    $blog_category_id = validateInput($blog_category_id);
    $blog_post_title = validateInput($blog_post_title);
    $blog_post_slag = validateInput($blog_post_slag);
    $blog_post_summery = validateInput($blog_post_summery);
    $blog_post_details = addslashes($blog_post_details);

    // Redirect URL if blog id not found
    if ($blog_post_id == '') {
        $link = baseUrl() . "views/blog/post/add.php";
        redirect($link);
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
                    $renameFile = "BI" . date('YmdHis') . '.' . $fileType; // Rename the file name
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
            $customArray .= ',blog_category_id = "' . $blog_category_id . '"';
            $customArray .= ',blog_post_updated_on = "' . $blog_post_updated_on . '"';
            $customArray .= ',blog_post_updated_by = "' . $blog_post_updated_by . '"';
            if ($_FILES["blog_post_image"]["tmp_name"] != '') {
            $customArray .= ', blog_post_image = "' . $renameFile . '"';

                //Image delete query when updated rows and set new image
                $sqlImage = "SELECT * FROM blog_post WHERE blog_post_id=$blog_post_id";
                $resultImage = mysqli_query($con, $sqlImage);
                $dataImage = mysqli_fetch_array($resultImage);
                @unlink($config['IMAGE_UPLOAD_PATH'] . '/blog_post_image/' . $dataImage["blog_post_image"]);
            }

            //Updated member data
           $sqlUpdateBlogPost = "UPDATE blog_post SET $customArray WHERE blog_post_id=$blog_post_id";
          
            $resultUpdateBlogPost = mysqli_query($con, $sqlUpdateBlogPost);
            if ($resultUpdateBlogPost) {
                $success = "Blog Post information updated successfully";
            } else {
                $error = "Blog Post information update failed for " . mysqli_error($con);
            }
        }
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
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Edit Blog Post</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Edit Blog Post</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form role="form" method="POST" action="<?php echo baseUrl(); ?>admin/views/blog/post/edit.php?id=<?php echo $blog_post_id; ?>" enctype="multipart/form-data">
                                            <div class="row">
                                                <input type="hidden" id="blog_post_id" name="blog_post_id" value="<?php echo $blog_post_id; ?>" />
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="blog_post_title">Title &nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="blog_post_title" name="blog_post_title" value="<?php echo $blog_post_title; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="blog_post_slag">Slag &nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="blog_post_slag" name="blog_post_slag" value="<?php echo $blog_post_slag; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
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
<!--                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="blog_category_id">Post Category&nbsp;<span id="mark">*</span></label>
                                                        <select name="blog_category_id" id="blog_category_id" class="form-control">
                                                            <?php if (count($arrayBlogCatCategory) > 0): ?>
                                                                <?php foreach ($arrayBlogCatCategory AS $category): ?>
                                                                    <option value="<?php echo $category->blog_category_id; ?>"<?php
                                                                    if ($blog_category_id == $category->blog_category_id) {
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
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="blog_post_image">Feature Image</label>
                                                        <input type="file" name="blog_post_image" id="blog_post_image" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label></label>
                                                        <?php if ($blog_post_image): ?>
                                                            <img src="<?php echo baseUrl(); ?>upload/blog_post_image/<?php echo $blog_post_image; ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 200px;width: 400px;" />
                                                        <?php else: ?>
                                                            <img src="<?php echo baseUrl('admin/images/default.jpg'); ?>" class="img-responsive img-thumbnail" id="show_image" style="height: 200px;width: 400px;" />
                                                        <?php endif; ?>                              
                                                    </div>
                                                </div>
                                                <div class="col-md-4"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" id="updateblogPost" name="updateblogPost" class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>    
                                            <br>
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
            $("#blogSetting").append("<li id='editBlogPostActive'><a href=''><i class='fa fa-circle-o'></i>Edit Post</a></li>");
            $("#editBlogPostActive").addClass("active");
            $("#editBlogPostActive").parent().parent().addClass("treeview active");
            $("#editBlogPostActive").parent().addClass("in");
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


