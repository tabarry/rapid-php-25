<?php

include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();

//Validation array
$validateAsArray = array('mediacat__Name_validateas' => 'required', 'mediacat__Picture_validateas' => 'image', 'mediacat__Description_validateas' => 'required', 'mediacat__Type_validateas' => 'enum', 'mediacat__Thumbnail_Width_validateas' => 'int', 'mediacat__Thumbnail_Height_validateas' => 'int', 'mediacat__Image_Width_validateas' => 'int', 'mediacat__Image_Height_validateas' => 'int', 'mediacat__Sequence_validateas' => 'double',);
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
//Validate image fields
    if ($_POST['mediacat__Type'] == 'Image') {
        if ($_POST['mediacat__Thumbnail_Width'] == '') {
            $vError[] = sprintf(REQUIRED_FIELD, THUMBNAIL_WIDTH);
        }
        if ($_POST['mediacat__Thumbnail_Height'] == '') {
            $vError[] = sprintf(REQUIRED_FIELD, THUMBNAIL_HEIGHT);
        }
        if ($_POST['mediacat__Image_Width'] == '') {
            $vError[] = sprintf(REQUIRED_FIELD, IMAGE_WIDTH);
        }
        if ($_POST['mediacat__Image_Height'] == '') {
            $vError[] = sprintf(REQUIRED_FIELD, IMAGE_HEIGHT);
        }
    }

//
//Validate entire form in one go using the DB Structure
//To skip validation set '*' to '' like: $dbs_sulata_media_categories['mediacat__ID_req']=''   
    suProcessForm($dbs_sulata_media_categories, $validateAsArray);


//Print validation errors on parent
    suValdationErrors($vError);


//add record
    $extraSql = '';
    //for picture
    if ($_FILES['mediacat__Picture']['name'] != '') {
        $uid = uniqid();
        $mediacat__Picture = suSlugify($_FILES['mediacat__Picture']['name'], $uid);
        $extraSql.=" ,mediacat__Picture='{$mediacat__Picture}' ";
    }

    //build query for file  uploads
    $sql = "INSERT INTO sulata_media_categories SET mediacat__Name='" . suStrip($_POST['mediacat__Name']) . "',mediacat__Description='" . suStrip($_POST['mediacat__Description']) . "',mediacat__Type='" . suStrip($_POST['mediacat__Type']) . "',mediacat__Thumbnail_Width='" . suStrip($_POST['mediacat__Thumbnail_Width']) . "',mediacat__Thumbnail_Height='" . suStrip($_POST['mediacat__Thumbnail_Height']) . "',mediacat__Image_Width='" . suStrip($_POST['mediacat__Image_Width']) . "',mediacat__Image_Height='" . suStrip($_POST['mediacat__Image_Height']) . "',mediacat__Sequence='" . suStrip($_POST['mediacat__Sequence']) . "'
,mediacat__Last_Action_On ='" . date('Y-m-d H:i:s') . "',mediacat__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql;
    suQuery($sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
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
        $max_id = suInsertId();
        //Upload files
        // picture
        if ($_FILES['mediacat__Picture']['name'] != '') {
            @unlink(ADMIN_UPLOAD_PATH . $mediacat__Picture);
            @unlink(ADMIN_UPLOAD_PATH . $_POST['previous_mediacat__Picture']);
            suResize($defaultWidth, $defaultHeight, $_FILES['mediacat__Picture']['tmp_name'], ADMIN_UPLOAD_PATH . $mediacat__Picture);
        }


        /* POST INSERT PLACE */

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
//Validate image fields
    if ($_POST['mediacat__Type'] == 'Image') {
        if ($_POST['mediacat__Thumbnail_Width'] == '') {
            $vError[] = sprintf(REQUIRED_FIELD, THUMBNAIL_WIDTH);
        }
        if ($_POST['mediacat__Thumbnail_Height'] == '') {
            $vError[] = sprintf(REQUIRED_FIELD, THUMBNAIL_HEIGHT);
        }
        if ($_POST['mediacat__Image_Width'] == '') {
            $vError[] = sprintf(REQUIRED_FIELD, IMAGE_WIDTH);
        }
        if ($_POST['mediacat__Image_Height'] == '') {
            $vError[] = sprintf(REQUIRED_FIELD, IMAGE_HEIGHT);
        }
    }

//Validate entire form in one go using the DB Structure
//To skip validation set '*' to '' like: $dbs_sulata_media_categories['mediacat__ID_req']=''   
    //Reset optional
    $dbs_sulata_media_categories['mediacat__Picture_req'] = '';



    suProcessForm($dbs_sulata_media_categories, $validateAsArray);

//Print validation errors on parent
    suValdationErrors($vError);
//update record
    $extraSql = '';
    //for picture
    if ($_FILES['mediacat__Picture']['name'] != '') {
        $uid = uniqid();
        $mediacat__Picture = suSlugify($_FILES['mediacat__Picture']['name'], $uid);
        $extraSql.=" ,mediacat__Picture='{$mediacat__Picture}' ";
    }

    $sql = "UPDATE sulata_media_categories SET mediacat__Name='" . suStrip($_POST['mediacat__Name']) . "',mediacat__Description='" . suStrip($_POST['mediacat__Description']) . "',mediacat__Type='" . suStrip($_POST['mediacat__Type']) . "',mediacat__Thumbnail_Width='" . suStrip($_POST['mediacat__Thumbnail_Width']) . "',mediacat__Thumbnail_Height='" . suStrip($_POST['mediacat__Thumbnail_Height']) . "',mediacat__Image_Width='" . suStrip($_POST['mediacat__Image_Width']) . "',mediacat__Image_Height='" . suStrip($_POST['mediacat__Image_Height']) . "',mediacat__Sequence='" . suStrip($_POST['mediacat__Sequence']) . "'
,mediacat__Last_Action_On ='" . date('Y-m-d H:i:s') . "',mediacat__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql . " WHERE mediacat__ID='" . $_POST['mediacat__ID'] . "'";
    suQuery($sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
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
        $max_id = $_POST['mediacat__ID'];
        //Upload files
        // picture
        if ($_FILES['mediacat__Picture']['name'] != '') {
            @unlink(ADMIN_UPLOAD_PATH . $mediacat__Picture);
            @unlink(ADMIN_UPLOAD_PATH . $_POST['previous_mediacat__Picture']);
            suResize($defaultWidth, $defaultHeight, $_FILES['mediacat__Picture']['tmp_name'], ADMIN_UPLOAD_PATH . $mediacat__Picture);
        }


        /* POST UPDATE PLACE */
        if ($_POST['referrer'] == '') {
            $_POST['referrer'] = ADMIN_URL . 'media-categories-cards' . PHP_EXTENSION . '/';
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
    $sql = "UPDATE sulata_media_categories SET mediacat__Name=CONCAT('" . $uid . "',mediacat__Name), mediacat__Last_Action_On ='" . date('Y-m-d H:i:s') . "',mediacat__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', mediacat__dbState='Deleted' WHERE mediacat__ID = '" . $id . "'";
    $result = suQuery($sql);
}
?>
