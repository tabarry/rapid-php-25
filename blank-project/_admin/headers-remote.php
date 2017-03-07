<?php

include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();

//Validation array
$validateAsArray = array('header__Title_validateas' => 'required', 'header__Picture_validateas' => 'image',);
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
//Validate
    $vError = array();

//
//Validate entire form in one go using the DB Structure
//To skip validation set '*' to '' like: $dbs_sulata_headers['header__ID_req']=''   
    suProcessForm($dbs_sulata_headers, $validateAsArray);


//Print validation errors on parent
    suValdationErrors($vError);


//add record
    $extraSql = '';

    //for picture
    if ($_FILES['header__Picture']['name'] != '') {
        $uid = uniqid();
        $header__Picture = suSlugify($_FILES['header__Picture']['name'], $uid);
        $extraSql.=" ,header__Picture='{$header__Picture}' ";
    }

    //build query for file  uploads
    $sql = "INSERT INTO sulata_headers SET header__Title='" . suStrip($_POST['header__Title']) . "'
,header__Last_Action_On ='" . date('Y-m-d H:i:s') . "',header__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'	        
" . $extraSql;
    suQuery($sql);

    if ($result['errno'] > 0) {
        if ($result['errno'] == 1062) {
            $error = sprintf(DUPLICATION_ERROR, 'Title');
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
        $max_id = $result['insert_id'];
        //Upload files
        // picture
        if ($_FILES['header__Picture']['name'] != '') {
            @unlink(ADMIN_UPLOAD_PATH . $header__Picture);
            @unlink(ADMIN_UPLOAD_PATH . $_POST['previous_header__Picture']);
            suResize($defaultWidth, $defaultHeight, $_FILES['header__Picture']['tmp_name'], ADMIN_UPLOAD_PATH . $header__Picture);
        }

        /* POST INSERT PLACE */
        if ($_POST['referrer'] == '') {
            $_POST['referrer'] = ADMIN_URL . 'headers-cards' . PHP_EXTENSION . '/';
        }
        if ($_POST['duplicate'] == 1) {
            $doJs = "parent.suReset(\"suForm\");parent.window.location.href='" . $_POST['referrer'] . "';
";
        } else {
            $doJs = 'parent.suForm.reset();';
        }
        suPrintJs('
            parent.suToggleButton(0);
            parent.$("#error-area").hide();
            parent.$("#message-area").show();
            parent.$("#message-area").html("' . SUCCESS_MESSAGE . '");
            parent.$("html, body").animate({ scrollTop: parent.$("html").offset().top }, "slow");
            ' . $doJs . '
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
//To skip validation set '*' to '' like: $dbs_sulata_headers['header__ID_req']=''   
    //Reset optional

    $dbs_sulata_headers['header__Picture_req'] = '';


    $dbs_sulata_headers['header__Picture_req'] = '';



    suProcessForm($dbs_sulata_headers, $validateAsArray);

//Print validation errors on parent
    suValdationErrors($vError);
//update record
    $extraSql = '';

    //for picture
    if ($_FILES['header__Picture']['name'] != '') {
        $uid = uniqid();
        $header__Picture = suSlugify($_FILES['header__Picture']['name'], $uid);
        $extraSql.=" ,header__Picture='{$header__Picture}' ";
    }

    $sql = "UPDATE sulata_headers SET header__Title='" . suStrip($_POST['header__Title']) . "'
,header__Last_Action_On ='" . date('Y-m-d H:i:s') . "',header__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql . " WHERE header__ID='" . $_POST['header__ID'] . "'";
    suQuery($sql);

    if ($result['errno'] > 0) {
        if ($result['errno'] == 1062) {
            $error = sprintf(DUPLICATION_ERROR, 'Title');
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
        $max_id = $_POST['header__ID'];
        //Upload files
        // picture
        if ($_FILES['header__Picture']['name'] != '') {
            @unlink(ADMIN_UPLOAD_PATH . $header__Picture);
            @unlink(ADMIN_UPLOAD_PATH . $_POST['previous_header__Picture']);
            suResize($defaultWidth, $defaultHeight, $_FILES['header__Picture']['tmp_name'], ADMIN_UPLOAD_PATH . $header__Picture);
        }

        /* POST UPDATE PLACE */
        if ($_POST['referrer'] == '') {
            $_POST['referrer'] = ADMIN_URL . 'headers-cards' . PHP_EXTENSION . '/';
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
    $sql = "UPDATE sulata_headers SET header__Title=CONCAT('" . $uid . "',header__Title), header__Last_Action_On ='" . date('Y-m-d H:i:s') . "',header__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', header__dbState='Deleted' WHERE header__ID = '" . $id . "'";
    $result = suQuery($sql);
}
//Restore record
if ($do == "restore") {
//Check referrer
    suCheckRef();
    $id = suSegment(2);

    $sql = "UPDATE sulata_headers SET header__Title=SUBSTR(header__Title," . (UID_LENGTH + 1) . "), header__Last_Action_On ='" . date('Y-m-d H:i:s') . "',header__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', header__dbState='Live' WHERE header__ID = '" . $id . "'";
    $result = suQuery($sql);
    if ($result['errno'] > 0) {
        if ($result['errno'] == 1062) {
            $error = sprintf(DUPLICATION_ERROR_ON_UPDATE, 'Title');
        } else {
            $error = MYSQL_ERROR;
        }

        suPrintJs('
            parent.$("#message-area").hide();
            parent.$("#error-area").show();
            parent.$("#error-area").html("<ul><li>' . $error . '</li></ul>");
            parent.$("html, body").animate({ scrollTop: parent.$("html").offset().top }, "slow");
        ');
    } else {
        suPrintJs('
            parent.restoreById("card_' . $id . '");
            parent.$("#error-area").hide();
            parent.$("#message-area").show();
            parent.$("#message-area").html("' . RECORD_RESTORED . '");
            parent.$("html, body").animate({ scrollTop: parent.$("html").offset().top }, "slow");
        ');
    }
}
?>
