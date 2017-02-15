<?php

include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();

//Validation array
$validateAsArray = array('setting__ID_validateas' => 'int', 'setting__Setting_validateas' => 'required', 'setting__Key_validateas' => 'required', 'setting__Value_validateas' => 'required', 'setting__Type_validateas' => 'enum',);
//==
//Check to stop page opening outside iframe
$do = suSegment(1);
suFrameBuster();
?>
<?php

//Add record
if ($do == "add") {
//Check referrer
    suCheckRef();
//Validate
    $vError = array();

//
//Validate entire form in one go using the DB Structure
//To skip validation set '*' to '' like: $dbs_sulata_settings['setting__ID_req']=''   
    suProcessForm($dbs_sulata_settings, $validateAsArray);


//Print validation errors on parent
    suValdationErrors($vError);


//add record
    $extraSql = '';

    //build query for file  uploads
    $sql = "INSERT INTO sulata_settings SET setting__Setting='" . suStrip($_POST['setting__Setting']) . "',setting__Key='" . suStrip($_POST['setting__Key']) . "',setting__Value='" . suStrip($_POST['setting__Value']) . "',setting__Type='" . suStrip($_POST['setting__Type']) . "'
,setting__Last_Action_On ='" . date('Y-m-d H:i:s') . "',setting__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql;
    suQuery($sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
            $error = sprintf(DUPLICATION_ERROR, 'Key');
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


        /* POST INSERT PLACE */
        //Clear settings session
        $_SESSION[SESSION_PREFIX . 'getSettings'] = '';

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


    suProcessForm($dbs_sulata_users, $validateAsArray);

//Print validation errors on parent
    suValdationErrors($vError);
//update record
    $extraSql = '';

    $sql = "UPDATE sulata_settings SET setting__Setting='" . suStrip($_POST['setting__Setting']) . "',setting__Key='" . suStrip($_POST['setting__Key']) . "',setting__Value='" . suStrip($_POST['setting__Value']) . "',setting__Type='" . suStrip($_POST['setting__Type']) . "'
,setting__Last_Action_On ='" . date('Y-m-d H:i:s') . "',setting__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql . " WHERE setting__ID='" . $_POST['setting__ID'] . "'";
    suQuery($sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
            $error = sprintf(DUPLICATION_ERROR, 'Key');
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
        $max_id = $_POST['setting__ID'];

        //Upload files

        /* POST UPDATE PLACE */
        //Clear settings session
        $_SESSION[SESSION_PREFIX . 'getSettings'] = '';
        if ($_POST['referrer'] == '') {
            $_POST['referrer'] = ADMIN_URL . 'settings-cards' . PHP_EXTENSION . '/';
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
//Delete from database by updating just the state
    //make a unique id attach to previous unique field
    $uid = uniqid() . '-';
    $sql = "UPDATE sulata_settings SET setting__Setting=CONCAT('" . $uid . "',setting__Setting),setting__Key=CONCAT('" . $uid . "',setting__Key), setting__Last_Action_On ='" . date('Y-m-d H:i:s') . "',setting__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', setting__dbState='Deleted' WHERE setting__ID = '" . $id . "'";
    $result = suQuery($sql);
}
?>
