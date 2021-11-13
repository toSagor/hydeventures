<?php

/* change when upload to different domain 
 * setting site hosting  data 
 */

$host = $_SERVER['HTTP_HOST'];

//$domain = str_replace('www.', '', str_replace('https://', '', $host));
$domain = str_replace('www.', '', str_replace('http://', '', $host));

if ($domain == 'hydeventures.com') {
    $config['SITE_NAME'] = 'HYDE Ventures';
    $config['BASE_URL'] = 'http://hydeventures.com/';
    $config['ROOT_DIR'] = '/home/tnvu0qb72m73/public_html/';
    $config['DB_TYPE'] = 'mysql';
    $config['DB_HOST'] = 'localhost';
    $config['DB_NAME'] = 'hydeventures_db';
    $config['DB_USER'] = 'hydeventures_user';
    $config['DB_PASSWORD'] = 'DqiV)!eEPI%3';
} else if ($domain == 'projects.freedomitsolution.com') {
    $config['SITE_NAME'] = 'HYDE Ventures';
    $config['BASE_URL'] = 'http://projects.freedomitsolution.com/hydeventures/';
    $config['ROOT_DIR'] = '/home/muktyvlt/projects.freedomitsolution.com/hydeventures/';
    $config['DB_TYPE'] = 'mysql';
    $config['DB_HOST'] = 'localhost';
    $config['DB_NAME'] = 'muktyvlt_hydeventures';
    $config['DB_USER'] = 'muktyvlt_development_db';
    $config['DB_PASSWORD'] = 'N9%z&AdA1JHQ';
} else {
    $config['SITE_NAME'] = 'Hydeventures';
    $config['BASE_URL'] = 'http://localhost/hydeventures/';
    $config['ROOT_DIR'] = '/hydeventures/';
    $config['DB_TYPE'] = 'mysql';
    $config['DB_HOST'] = 'localhost';
    $config['DB_NAME'] = 'hydeventures_db';
    $config['DB_USER'] = 'root';
    $config['DB_PASSWORD'] = '';
}
date_default_timezone_set('Asia/Dhaka');
$config['MASTER_ADMIN_EMAIL'] = "aminrahat420@gmail.com";
$config['PASSWORD_KEY'] = "#tg#";
$config['ADMIN_PASSWORD_LENGTH_MAX'] = 15;
$config['ADMIN_PASSWORD_LENGTH_MIN'] = 5;
$config['ADMIN_COOKIE_EXPIRE_DURATION'] = (60 * 60 * 24 * 30);

$config['IMAGE_UPLOAD_PATH'] = $config['BASE_DIR'] . '/upload';
$config['IMAGE_UPLOAD_URL'] = $config['BASE_URL'] . 'upload';
?>