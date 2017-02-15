<?php

include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');


//$email = suSegment(1);
$email = $_POST['email'];
//$email = $_COOKIE['cook_google_email'];
$sql = "SELECT user__ID, user__Name, user__Email, user__Picture,user__Status,user__Theme FROM sulata_users WHERE user__Email='" . suStrip($email) . "'";

$result = suQuery($sql);
if (suNumRows($result) == 1) {
    $row = suFetch($result);
    suFree($result);
//Set sessions
    $_SESSION[SESSION_PREFIX . 'user__ID'] = $row['user__ID'];
    $_SESSION[SESSION_PREFIX . 'user__Name'] = suUnstrip($row['user__Name']);
    $_SESSION[SESSION_PREFIX . 'user__Email'] = suUnstrip($row['user__Email']);
    $_SESSION[SESSION_PREFIX . 'user__Picture'] = $row['user__Picture'];
    $_SESSION[SESSION_PREFIX . 'user__Status'] = $row['user__Status'];
    $_SESSION[SESSION_PREFIX . 'user__Theme'] = $row['user__Theme'];
//Redirect

    suRedirect(ADMIN_URL);
} else {
    $msg = urlencode(GOOGLE_INVALID_USER);
    suRedirect(ADMIN_URL . "message.php?msg=" . $msg);
}
?>