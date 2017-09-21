<?php

include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();

//Validation array
$validateAsArray = array('page__Name_validateas' => 'required', 'page__Heading_validateas' => 'required', 'page__Permalink_validateas' => 'required', 'page__Title_validateas' => 'required', 'page__Keyword_validateas' => 'required', 'page__Description_validateas' => 'required', 'page__Header_validateas' => 'required', 'page__Short_Text_validateas' => 'required', 'page__Long_Text_validateas' => 'required', 'page__Link_Position_validateas' => 'enum', 'page__Parent_validateas' => 'required', 'page__Sequence_validateas' => 'double',);
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
//To skip validation set '*' to '' like: $dbs_sulata_pages['page__ID_req']=''   
    suProcessForm($dbs_sulata_pages, $validateAsArray);


//Print validation errors on parent
    suValdationErrors($vError);


//add record
    $extraSql = '';

    //build query for file  uploads
    $sql = "INSERT INTO sulata_pages SET page__Name='" . suStrip($_POST['page__Name']) . "',page__Heading='" . suStrip($_POST['page__Heading']) . "',page__Permalink='" . suSlugifyName(suStrip($_POST['page__Permalink'])) . "',page__Title='" . suStrip($_POST['page__Title']) . "',page__Keyword='" . suStrip($_POST['page__Keyword']) . "',page__Description='" . suStrip($_POST['page__Description']) . "',page__Header='" . suStrip($_POST['page__Header']) . "',page__Short_Text='" . suStrip($_POST['page__Short_Text']) . "',page__Long_Text='" . suStrip($_POST['page__Long_Text']) . "',page__Link_Position='" . suStrip($_POST['page__Link_Position']) . "',page__Parent='" . suStrip($_POST['page__Parent']) . "',page__Sequence='" . suStrip($_POST['page__Sequence']) . "'
,page__Last_Action_On ='" . date('Y-m-d H:i:s') . "',page__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql;
    suQuery($sql);

    if ($result['errno'] > 0) {
        if ($result['errno'] == 1062) {
            $error = sprintf(DUPLICATION_ERROR, 'Name');
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

        /* POST INSERT PLACE */
        if ($_POST['referrer'] == '') {
            $_POST['referrer'] = ADMIN_URL . 'pages-cards' . PHP_EXTENSION . '/';
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
//To skip validation set '*' to '' like: $dbs_sulata_pages['page__ID_req']=''   
    //Reset optional


    suProcessForm($dbs_sulata_pages, $validateAsArray);

//Print validation errors on parent
    suValdationErrors($vError);
//update record
    $extraSql = '';

    $sql = "UPDATE sulata_pages SET page__Name='" . suStrip($_POST['page__Name']) . "',page__Heading='" . suStrip($_POST['page__Heading']) . "',page__Permalink='" . suSlugifyName(suStrip($_POST['page__Permalink'])) . "',page__Title='" . suStrip($_POST['page__Title']) . "',page__Keyword='" . suStrip($_POST['page__Keyword']) . "',page__Description='" . suStrip($_POST['page__Description']) . "',page__Header='" . suStrip($_POST['page__Header']) . "',page__Short_Text='" . suStrip($_POST['page__Short_Text']) . "',page__Long_Text='" . suStrip($_POST['page__Long_Text']) . "',page__Link_Position='" . suStrip($_POST['page__Link_Position']) . "',page__Parent='" . suStrip($_POST['page__Parent']) . "',page__Sequence='" . suStrip($_POST['page__Sequence']) . "'
,page__Last_Action_On ='" . date('Y-m-d H:i:s') . "',page__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql . " WHERE page__ID='" . $_POST['page__ID'] . "'";
    suQuery($sql);

    if ($result['errno'] > 0) {
        if ($result['errno'] == 1062) {
            $error = sprintf(DUPLICATION_ERROR, 'Name');
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
        $max_id = $_POST['page__ID'];
        //Upload files

        /* POST UPDATE PLACE */
        if ($_POST['referrer'] == '') {
            $_POST['referrer'] = ADMIN_URL . 'pages-cards' . PHP_EXTENSION . '/';
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
    $sql = "UPDATE sulata_pages SET page__Name=CONCAT('" . $uid . "',page__Name), page__Last_Action_On ='" . date('Y-m-d H:i:s') . "',page__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', page__dbState='Deleted' WHERE page__ID = '" . $id . "'";
    $result = suQuery($sql);
}
//Restore record
if ($do == "restore") {
//Check referrer
    suCheckRef();
    $id = suSegment(2);

    $sql = "UPDATE sulata_pages SET page__Name=SUBSTR(page__Name," . (UID_LENGTH + 1) . "), page__Last_Action_On ='" . date('Y-m-d H:i:s') . "',page__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', page__dbState='Live' WHERE page__ID = '" . $id . "'";
    $result = suQuery($sql);
    if ($result['errno'] > 0) {
        if ($result['errno'] == 1062) {
            $error = sprintf(DUPLICATION_ERROR_ON_UPDATE, 'Page');
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
