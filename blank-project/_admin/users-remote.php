<?php

include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();

//Validation array
$validateAsArray = array('user__Name_validateas' => 'required', 'user__Phone_validateas' => '', 'user__Email_validateas' => 'email', 'user__Password_validateas' => 'password', 'user__Status_validateas' => 'enum', 'user__Picture_validateas' => 'image',);
//---------
//Check to stop page opening outside iframe
$do = suSegment(1);
suFrameBuster();
?>
<?php

//Add record
if ($do == "add") {
//Check referrer
    suCheckRef();
    //If Google Login then set password
    if ($getSettings['google_login'] == 1) {
        $_POST['user__Password'] = '0123456789';
        $_POST['user__Password2'] = '0123456789';
    }
//Validate
    $vError = array();

//
//Validate entire form in one go using the DB Structure
//To skip validation set '*' to '' like: $dbs_sulata_users['user__ID_req']=''   
    suProcessForm($dbs_sulata_users, $validateAsArray);


//Print validation errors on parent
    suValdationErrors($vError);


//add record
    $extraSql = '';

    //for picture
    if ($_FILES['user__Picture']['name'] != '') {
        $uid = uniqid();
        $user__Picture = suSlugify($_FILES['user__Picture']['name'], $uid);
        $uploadPath = suMakeUploadPath(ADMIN_UPLOAD_PATH);
        $extraSql.=" ,user__Picture='" . $uploadPath . $user__Picture . "' ";
    }

    //build query for file  uploads
    $sql = "INSERT INTO sulata_users SET user__Name='" . suStrip($_POST['user__Name']) . "',user__Phone='" . suStrip($_POST['user__Phone']) . "',user__Email='" . suStrip($_POST['user__Email']) . "',user__Password='" . suCrypt(suStrip($_POST['user__Password'])) . "',user__Status='" . suStrip($_POST['user__Status']) . "'
,user__Last_Action_On ='" . date('Y-m-d H:i:s') . "',user__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql;
    suQuery($sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
            $error = sprintf(DUPLICATION_ERROR, 'Email');
        } else {
            $error = MYSQL_ERROR;
        }

        suPrintJs('
            parent.suToggleButton(0);
            parent.$("#message-area").hide();
            parent.$("#error-area").show();
            parent.$("#error-area").html("<ul><li>' . $error . '</li></ul>");
            parent.$("html, body").animate({ scrollTop: parent.$("html").offset().top }, "slow");
        ');
    } else {
        $max_id = suInsertId();
        //Upload files
        // picture
        if ($_FILES['user__Picture']['name'] != '') {
            @unlink(ADMIN_UPLOAD_PATH . $uploadPath . $user__Picture);
            @unlink(ADMIN_UPLOAD_PATH . $_POST['previous_user__Picture']);
            suResize($defaultWidth, $defaultHeight, $_FILES['user__Picture']['tmp_name'], ADMIN_UPLOAD_PATH . $uploadPath . $user__Picture);
        }


        /* POST INSERT PLACE */
        //Send login details to user
        if ($_POST['send_to_user'] == 'Yes') {
            if ($getSettings['google_login'] == 1) {
                $email = file_get_contents('../sulata/mails/new-user-gmail.html');
            } else {
                $email = file_get_contents('../sulata/mails/new-user.html');
            }
            $email = str_replace('#NAME#', $_POST['user__Name'], $email);
            $email = str_replace('#SITE_NAME#', $getSettings['site_name'], $email);
            $email = str_replace('#EMAIL#', $_POST['user__Email'], $email);
            $email = str_replace('#USER#', $_SESSION[SESSION_PREFIX . 'user__Name'], $email);
            $email = str_replace('#PASSWORD#', $_POST['user__Password'], $email);
            $subject = sprintf(LOST_PASSWORD_SUBJECT, $getSettings['site_name']);
            //Send mails

            suMail($_POST['user__Email'], $subject, $email, $getSettings['site_name'], $getSettings['site_email'], TRUE);
        }
        suPrintJs('
            parent.suToggleButton(0);
            parent.$("#error-area").hide();
            parent.$("#message-area").show();
            parent.$("#message-area").html("' . SUCCESS_MESSAGE . '");
            parent.$("html, body").animate({ scrollTop: parent.$("html").offset().top }, "slow");
            parent.suForm.reset();
        ');
    }
}
//Update record
if ($do == "update") {
//Check referrer
    suCheckRef();
//Validate
    $vError = array();

//Validate entire form in one go using the DB Structure
//To skip validation set '*' to '' like: $dbs_sulata_users['user__ID_req']=''   
    //Reset optional

    $dbs_sulata_users['user__Picture_req'] = '';


    $dbs_sulata_users['user__Picture_req'] = '';



    suProcessForm($dbs_sulata_users, $validateAsArray);

//Print validation errors on parent
    suValdationErrors($vError);
//update record
    $extraSql = '';

    //for picture
    if ($_FILES['user__Picture']['name'] != '') {
        $uid = uniqid();
        $user__Picture = suSlugify($_FILES['user__Picture']['name'], $uid);
        $uploadPath = suMakeUploadPath(ADMIN_UPLOAD_PATH);
        $extraSql.=" ,user__Picture='" . $uploadPath . $user__Picture . "' ";
    }

    if ($getSettings['google_login'] == 1) {//If google login enabled
        $sql = "UPDATE sulata_users SET user__Name='" . suStrip($_POST['user__Name']) . "',user__Phone='" . suStrip($_POST['user__Phone']) . "',user__Email='" . suStrip($_POST['user__Email']) . "',user__Status='" . suStrip($_POST['user__Status']) . "'
,user__Last_Action_On ='" . date('Y-m-d H:i:s') . "',user__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql . " WHERE user__ID='" . $_POST['user__ID'] . "'";
    } else {//If google login disabled
        $sql = "UPDATE sulata_users SET user__Name='" . suStrip($_POST['user__Name']) . "',user__Phone='" . suStrip($_POST['user__Phone']) . "',user__Email='" . suStrip($_POST['user__Email']) . "',user__Password='" . suCrypt(suStrip($_POST['user__Password'])) . "',user__Status='" . suStrip($_POST['user__Status']) . "'
,user__Last_Action_On ='" . date('Y-m-d H:i:s') . "',user__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql . " WHERE user__ID='" . $_POST['user__ID'] . "'";
    }



    suQuery($sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
            $error = sprintf(DUPLICATION_ERROR, 'Email');
        } else {
            $error = MYSQL_ERROR;
        }

        suPrintJs('
            parent.suToggleButton(0);
            parent.$("#message-area").hide();
            parent.$("#error-area").show();
            parent.$("#error-area").html("<ul><li>' . $error . '</li></ul>");
            parent.$("html, body").animate({ scrollTop: parent.$("html").offset().top }, "slow");
        ');
    } else {
        $max_id = $_POST['user__ID'];
        //Upload files
        // picture
        if ($_FILES['user__Picture']['name'] != '') {
            @unlink(ADMIN_UPLOAD_PATH . $uploadPath . $user__Picture);
            @unlink(ADMIN_UPLOAD_PATH . $_POST['previous_user__Picture']);
            suResize($defaultWidth, $defaultHeight, $_FILES['user__Picture']['tmp_name'], ADMIN_UPLOAD_PATH . $uploadPath . $user__Picture);
            //Reset picture session
            if ($_SESSION[SESSION_PREFIX . 'user__ID'] == $_POST['user__ID']) {
                $_SESSION[SESSION_PREFIX . 'user__Picture'] = $uploadPath . $user__Picture;
            }
        }

        /* POST UPDATE PLACE */
        if ($_POST['referrer'] == '') {
            $_POST['referrer'] = ADMIN_URL . 'users-cards' . PHP_EXTENSION . '/';
        }
        suPrintJs("
            parent.window.location.href='" . $_POST['referrer'] . "';
        ");
    }
}

//Delete record
if ($do == "delete") {
//Check referrer
    suCheckRef();
    $id = suSegment(2);

    //Stop from deleting self user as well
//Delete from database by updating just the state
    //make a unique id attach to previous unique field
    $uid = uniqid() . '-';
    $sql = "UPDATE sulata_users SET user__Email=CONCAT('" . $uid . "',user__Email), user__Last_Action_On ='" . date('Y-m-d H:i:s') . "',user__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', user__dbState='Deleted' WHERE user__ID = '" . $id . "' AND user__ID != '" . $_SESSION[SESSION_PREFIX . 'user__ID'] . "'";
    $result = suQuery($sql);
}
?>
