<header class="main-header">
    <a href="<?php echo baseUrl(); ?>admin/views/dashboard.php" class="logo">
        <span class="logo-mini"><h3>MB</h3></span>
        <span class="logo-lg" style="font-size: 15px;"><b>HYDE<i>VENTURES</i></b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">    
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span><i class="fa fa-user"></i>&nbsp;<?php if(getSession('admin_name') != ''){ echo getSession('admin_name'); } ?></span>
                    </a>
                    <ul class="dropdown-menu" >                        
                        <li class="user-footer" style="background-color: white;">
                            <div class="pull-left">
                                <a href="<?php echo baseUrl(); ?>admin/views/admin.php" class="btn btn-default btn-flat" style="border: 1px solid #3C8DBC;">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo baseUrl(); ?>admin/logout.php" class="btn btn-default btn-flat" style="border: 1px solid #3C8DBC;">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>