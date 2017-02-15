<?php

include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();

$do = suSegment(1);
$newTheme = suSegment(2);
//Update record
if ($do == "change") {
//Check referrer
    suCheckRef();
//Validate

    $sql = "UPDATE sulata_users SET user__Theme='" . $newTheme . "' WHERE user__ID='" . $_SESSION[SESSION_PREFIX . 'user__ID'] . "'";
    suQuery($sql);

    $_SESSION[SESSION_PREFIX . 'user__Theme'] = $newTheme;
    suPrintJs('
            parent.document.getElementById("themeCss").setAttribute("href", "' . ADMIN_URL . 'css/themes/' . $newTheme . '/style.css");
        ');
}
?>    
