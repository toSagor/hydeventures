<?php 
session_start();
include '../../config/config.php';
checkAdminLogin();

// Total Active Company
$totalActiveCompany = 0;
$sqlActiveCompany = "SELECT COUNT(*) AS totalActiveCompany FROM company WHERE status='1'";
$resultActiveCompany = mysqli_query($con, $sqlActiveCompany);
if($resultActiveCompany){
    $objActiveCompany = mysqli_fetch_object($resultActiveCompany);
    $totalActiveCompany = $objActiveCompany->totalActiveCompany; 
}

//Total Active Members
$totalActiveMember = 0;
$sqlActiveMember = "SELECT COUNT(*) AS totalActiveMember FROM team WHERE status='1'";
$resultActiveMember = mysqli_query($con, $sqlActiveMember);
if($resultActiveMember){
    $objActiveMember = mysqli_fetch_object($resultActiveMember);
    $totalActiveMember = $objActiveMember->totalActiveMember; 
}

//Total Active Social Impact Items
$totalActiveSocialImpact = 0;
$sqlActiveSocialImpact = "SELECT COUNT(*) AS totalActiveSocialImpact FROM social_impact WHERE status='1'";
$resultActiveSocialImpact = mysqli_query($con, $sqlActiveSocialImpact);
if($resultActiveSocialImpact){
    $objActiveSocialImpact = mysqli_fetch_object($resultActiveSocialImpact);
    $totalActiveSocialImpact = $objActiveSocialImpact->totalActiveSocialImpact; 
}

//Total Active Contents  
$totalActiveContant = 0;
$sqlActiveContant = "SELECT COUNT(*) AS totalActiveContant FROM content WHERE status='1'";
$resultActiveContant = mysqli_query($con, $sqlActiveContant);
if($resultActiveContant){
    $objActiveContant = mysqli_fetch_object($resultActiveContant);
    $totalActiveContant = $objActiveContant->totalActiveContant; 
}

//Total Active Webmails
$totalMail = 0;
$sqlMail = "SELECT COUNT(*) AS totalMail FROM notification";
$resultMail = mysqli_query($con, $sqlMail);
if($resultMail){
    $objMail = mysqli_fetch_object($resultMail);
    $totalMail = $objMail->totalMail; 
}

//Total Active Users
$totalActiveUsers = 0;
$sqlActiveUsers = "SELECT COUNT(*) AS totalActiveUsers FROM admin WHERE admin_status='Active'";
$resultActiveUsers = mysqli_query($con, $sqlActiveUsers);
if($resultActiveUsers){
    $objActiveUsers = mysqli_fetch_object($resultActiveUsers);
    $totalActiveUsers = $objActiveUsers->totalActiveUsers; 
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Dashboard</title>
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
                                    <div class="panel-heading panel-style"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</div>
                                    <div class="panel-body">
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-building fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div class="huge"><span class="badge badge-secondary"><?php echo $totalActiveCompany;?></span></div>
                                                                <div>Total Active Company</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="<?php echo baseUrl(); ?>admin/views/notice/list.php">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">More</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-users fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div class="huge"><span class="badge badge-secondary"><?php echo $totalActiveMember;?></span></div>
                                                                <div>Total Active Member</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="<?php echo baseUrl(); ?>admin/views/notice/list.php">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">More</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-globe fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div class="huge"><span class="badge badge-secondary"><?php echo $totalActiveSocialImpact;?></span></div>
                                                                <div>Total Active Social Impacts</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="<?php echo baseUrl(); ?>admin/views/appointments/list.php">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">More</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-files-o fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div class="huge"><span class="badge badge-secondary"><?php echo $totalActiveContant;?></span></div>
                                                                <div>Total Active Contents</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="<?php echo baseUrl(); ?>admin/views/appointments/list.php">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">More</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-envelope fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div class="huge"><span class="badge badge-secondary"><?php echo $totalMail;?></span></div>
                                                                <div>Web Mails</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="<?php echo baseUrl(); ?>admin/views/contact_information/contact_information.php">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">More</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-user-secret fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div class="huge"><span class="badge badge-secondary"><?php echo $totalActiveUsers;?></span></div>
                                                                <div>Total Active Users</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="<?php echo baseUrl(); ?>admin/views/appointments/list.php">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">More</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
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
        <script type="text/javascript">
            $("#dashActive").addClass("active");
            $("#dashActive").parent().parent().addClass("treeview active");
            $("#dashActive").parent().addClass("in");
        </script>
    </body>
</html>
