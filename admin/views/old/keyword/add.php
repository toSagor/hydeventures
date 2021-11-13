<?php
include '../../../config/config.php';
checkAdminLogin();

$keyword_name = '';
$keyword_image = '';
$keyword_popularity = '2';

// Save product information
if (isset($_POST['addKeyword'])) {
    extract($_POST);
    $keyword_name = validateInput($keyword_name);
    $keyword_popularity = validateInput($keyword_popularity);

    if (empty($keyword_name) || $keyword_name === '') {
        $error = "Keyword title required";
    } else {
        // Check duplicate entry using Slider title.
        $sqlCheck = "SELECT * FROM keyword"
                . " WHERE keyword_name='$keyword_name'";
        $resultCheck = mysqli_query($con, $sqlCheck);
        $countRow = mysqli_num_rows($resultCheck);

        if ($countRow > 0) {
            $error = "A keyword data already exists with the same name";
        } else {

            // Image upload code
            if ($_FILES['keyword_image']['name']) { // Check if image file posted or not
                $targetDirectory = $config['IMAGE_UPLOAD_PATH'] . '/keyword_image/'; // Target directory where image will save or store
                $targetFile = '';
                $fileType = pathinfo(basename($_FILES['keyword_image']['name']), PATHINFO_EXTENSION);
                // File type such as .jpg, .png, .jpeg, .gif
                if ($fileType != 'jpg' && $fileType != 'png' && $fileType != 'jpeg' && $fileType != 'gif' && $fileType != 'JPG') { // Check file is in mentioned format or not
                    $flag++;
                    $error = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
                } else {
                    if ($_FILES['keyword_image']['size'] > (1024000)) { // Check file size. File size must be less than 1MB
                        $flag++;
                        $error = 'Image size is too large. Must be less than 1MB';
                    } else {
                        $renameFile = "SI" . date('YmdHis') . '.' . $fileType; // Rename the file name
                        $targetFile = $targetDirectory . $renameFile; // Target image file
                        move_uploaded_file($_FILES['keyword_image']['tmp_name'], $targetFile);
                        $flag = 0;
                    }
                }
            }

            // Image upload code end
            if ($flag == 0) {
                $customArray = '';
                $customArray .= 'keyword_name = "' . $keyword_name . '"';
                $customArray .= ',keyword_image = "' . $renameFile . '"';
                $customArray .= ',keyword_popularity = "' . $keyword_popularity . '"';

                // save / insert value in table and show a message
                $sqlInsertKeyword = "INSERT INTO keyword SET $customArray";
                $resultInsertKeyword = mysqli_query($con, $sqlInsertKeyword);
                if ($resultInsertKeyword) {
                    $success = "Keyword information saved successfully";
                } else {
                    $error = "Keyword information addition failed for " . mysqli_error($con);
                }
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
        <title>Add Keyword</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Add Keyword</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="keyword_name">Keyword Title&nbsp;<span id="mark">*</span></label>
                                                        <input type="text" id="keyword_name" name="keyword_name" value="<?php echo $keyword_name; ?>" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="keyword_image">Slider Image&nbsp;<span id="mark">*</span></label>
                                                        <input type="file" name="keyword_image" id="keyword_image" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="addKeyword" class="btn btn-primary">Submit</button>
                                                        <button type="reset" class="btn btn-danger">Reset</button>
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
            $("#addKeywordActive").addClass("active");
            $("#addKeywordActive").parent().parent().addClass("treeview active");
            $("#addKeywordActive").parent().addClass("in");
        </script>

    </body>
</html>