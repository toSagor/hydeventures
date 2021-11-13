<aside class="main-sidebar">
    <section class="sidebar">

        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            
            <li class="treeview" id="dashActive">
                <a href="<?php echo baseUrl(); ?>admin/views/dashboard.php">
                    <i class="fa fa-dashboard"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="treeview" id="GeneralSettingsActive">
                <a href="<?php echo baseUrl(); ?>admin/views/general_settings/general_settings.php">
                    <i class="fa fa-cogs"></i>
                    <span>General Settings</span>
                </a>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building"></i>
                    <span>Company</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" id="categorySetting">
                    <li id="addCompanyActive"><a href="<?php echo baseUrl(); ?>admin/views/company/add.php"><i class="fa fa-circle-o"></i> Add Company</a></li>
                    <li id="listCompanyActive"><a href="<?php echo baseUrl(); ?>admin/views/company/list.php"><i class="fa fa-circle-o"></i>Company List</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Team</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" id="countrySetting">
                    <li id="addTeamActive"><a href="<?php echo baseUrl(); ?>admin/views/team/add.php"><i class="fa fa-circle-o"></i> Add Member</a></li>
                    <li id="listTeamActive"><a href="<?php echo baseUrl(); ?>admin/views/team/list.php"><i class="fa fa-circle-o"></i>Member List</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-globe"></i>
                    <span>Social Impact</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" id="buyerReqSetting">
                    <li id="addSIActive"><a href="<?php echo baseUrl(); ?>admin/views/social_impact/add.php"><i class="fa fa-circle-o"></i>Add Social Item</a></li>
                    <li id="listSIActive"><a href="<?php echo baseUrl(); ?>admin/views/social_impact/list.php"><i class="fa fa-circle-o"></i>All Social Items</a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Content</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" id="buyerReqSetting">
                    <li id="addContentActive"><a href="<?php echo baseUrl(); ?>admin/views/content/add.php"><i class="fa fa-circle-o"></i>Add Content</a></li>
                    <li id="listContentActive"><a href="<?php echo baseUrl(); ?>admin/views/content/list.php"><i class="fa fa-circle-o"></i>Content List</a></li>
                </ul>
            </li>
            
            <li class="treeview" id="ContactInformationActive">
                <a href="<?php echo baseUrl(); ?>admin/views/contact_information/contact_information.php">
                    <i class="fa fa-envelope-o"></i>
                    <span>Mail Information</span>
                </a>
            </li>
            
            <hr>
            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>User Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" id="memberSetting">
                    <li id="addUserActive"><a href="<?php echo baseUrl(); ?>admin/views/user/add.php"><i class="fa fa-circle-o"></i> Add User</a></li>
                    <li id="listUserActive"><a href="<?php echo baseUrl(); ?>admin/views/user/list.php"><i class="fa fa-circle-o"></i> User List</a></li>
                </ul>
            </li>
            
            <li class="treeview" id="privacy_toc_Active">
                <a href="<?php echo baseUrl(); ?>" target="_blank">
                    <i class="fa fa-external-link"></i>
                    <span>View Site</span>
                </a>
            </li>

        </ul>
    </section>
</aside>