<?php
include '../../../config/config.php';
checkAdminLogin();

$menuFlag = 1;
$id = '';
$privacy_policy = '';
$terms_of_services = '';
$flag = 0;

// Save logo information
if (isset($_POST['updateSettings'])) {
    extract($_POST);

    $id = validateInput($id);
    $privacy_policy = addslashes($privacy_policy);
    $terms_of_services = addslashes($terms_of_services);

    if ($flag == 0) {
        $customArray = '';
        $customArray .= 'privacy_policy = "' . $privacy_policy . '"';
        $customArray .= ',terms_of_services = "' . $terms_of_services . '"';

        //Updated legal data
        $sqlUpdateLegalInfoSettings = "UPDATE legal_information SET $customArray";
        $resultUpdateLegalInfoSettings = mysqli_query($con, $sqlUpdateLegalInfoSettings);
        if ($resultUpdateLegalInfoSettings) {
            $success = "Legal information updated successfully";
        } else {
            $error = "Legal information update failed for " . mysqli_error($con);
        }
    }
}
    
// Get general settings data
$sqlGetData = "SELECT * FROM legal_information";
$resultGetData = mysqli_query($con, $sqlGetData);
if ($resultGetData) {
    $objGetData = mysqli_fetch_object($resultGetData);
    $privacy_policy = $objGetData->privacy_policy;
    $terms_of_services = $objGetData->terms_of_services;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Privacy Policy And Terms of Use</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;All Settings</div>
                                    <div class="panel-body">
                                        <?php include basePath('admin/message.php'); ?>
                                        <form role="form" method="POST" action="">
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                                                    <div class="form-group">
                                                        <label for="privacy_policy">Privacy Policy&nbsp;<span id="mark">*</span></label>
                                                        <textarea id="privacy_policy" name="privacy_policy" rows="5" cols="10">
                                                            <?php echo stripslashes($privacy_policy); ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="terms_of_services">Terms of Service&nbsp;<span id="mark">*</span></label>
                                                        <textarea id="terms_of_services" name="terms_of_services" rows="5" cols="10">
                                                            <?php echo stripslashes($terms_of_services); ?>
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <br>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <button type="submit" name="updateSettings" class="btn btn-primary">Update</button>
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
            $("#logo_image").change(function () {
                readURL(this);
            });
        </script>
        <script>
            $(function () {
              CKEDITOR.replace('privacy_policy');
            });
        </script>
        <script>
            $(function () {
              CKEDITOR.replace('terms_of_services');
            });
        </script>
        <script type="text/javascript">
            $("#privacy_toc_Active").addClass("active");
            $("#privacy_toc_Active").parent().parent().addClass("treeview active");
            $("#privacy_toc_Active").parent().addClass("in");
        </script>

    </body>
</html>
