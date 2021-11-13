<?php 

session_start();
include "../config/config.php";
unsetSession($_SESSION['admin_id']);
unsetSession($_SESSION['admin_name']);
unsetSession($_SESSION['admin_email']);
session_destroy();
if ($admin_id < 0 || $admin_id == '') {
    header('Location:  ./index.php');
}
?>