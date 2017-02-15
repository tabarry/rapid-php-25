<?php

//Error reporting
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

define('VERSION', '22');
$version = "Rapid PHP " . VERSION; //If this is changed, please also change config.php in sulata/includes folder
$debug = FALSE;
$sitePath = '../' . $_POST['folder'] . '/sulata/';
$appPath = '../' . $_POST['folder'] . '/';
$backupPath = '../' . $_POST['folder'] . '/backup/';
/* --COMMON SETTINGS */
define('SITE_TITLE', $version);
define('TAG_LINE', 'RAD Tool for PHP Development with Bootstrap Framework');
define('SITE_FOOTER', 'Rapid PHP is a product of <a href="http://www.sulata.com.pk" target="_blank">Sulata iSoft</a>.');
?>