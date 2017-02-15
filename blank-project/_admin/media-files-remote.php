<?php

include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();

//Validation array
$validateAsArray = array('mediafile__Category_validateas' => 'required', 'mediafile__Title_validateas' => 'required', 'mediafile__File_validateas' => 'file', 'mediafile__Short_Description_validateas' => 'required', 'mediafile__Long_Description_validateas' => 'required', 'mediafile__Sequence_validateas' => 'double', 'mediafile__Date_validateas' => 'required',);
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
//To skip validation set '*' to '' like: $dbs_sulata_media_files['mediafile__ID_req']=''   
    suProcessForm($dbs_sulata_media_files, $validateAsArray);


//Print validation errors on parent
    suValdationErrors($vError);


//add record
    $extraSql = '';

    //for file
    if ($_FILES['mediafile__File']['name'] != '') {
        $uid = uniqid();
        $mediafile__File = suSlugify($_FILES['mediafile__File']['name'], $uid);
        $extraSql.=" ,mediafile__File='{$mediafile__File}' ";
    }

    //build query for file  uploads
    $sql = "INSERT INTO sulata_media_files SET mediafile__Category='" . suStrip($_POST['mediafile__Category']) . "',mediafile__Title='" . suStrip($_POST['mediafile__Title']) . "',mediafile__Short_Description='" . suStrip($_POST['mediafile__Short_Description']) . "',mediafile__Long_Description='" . suStrip($_POST['mediafile__Long_Description']) . "',mediafile__Sequence='" . suStrip($_POST['mediafile__Sequence']) . "',mediafile__Date='" . suDate2Db($_POST['mediafile__Date']) . "'
,mediafile__Last_Action_On ='" . date('Y-m-d H:i:s') . "',mediafile__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql;
    suQuery($sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
            $error = sprintf(DUPLICATION_ERROR, 'Title in this category');
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
        //Get file type and image dimensions if image
        $sql = "SELECT mediacat__Type, mediacat__Thumbnail_Width, mediacat__Thumbnail_Height, mediacat__Image_Width, mediacat__Image_Height FROM sulata_media_categories WHERE mediacat__ID='" . $_POST['mediafile__Category'] . "'";
        $result = suQuery($sql);
        $row = suFetch($result);
        if ($row['mediacat__Thumbnail_Width'] == '0') {
            $row['mediacat__Thumbnail_Width'] = $defaultWidth;
        }
        if ($row['mediacat__Thumbnail_Height'] == '0') {
            $row['mediacat__Thumbnail_Width'] = $defaultHeight;
        }
        if ($row['mediacat__Image_Width'] == '0') {
            $row['mediacat__Image_Width'] = $defaultWidth;
        }
        if ($row['mediacat__Image_Height'] == '0') {
            $row['mediacat__Image_Height'] = $defaultHeight;
        }

        suFree($result);
        //If file
        if ($row['mediacat__Type'] == 'File') {
            // file
            if ($_FILES['mediafile__File']['name'] != '') {
                @unlink(ADMIN_UPLOAD_PATH . $mediafile__File);
                @unlink(ADMIN_UPLOAD_PATH . $_POST['previous_mediafile__File']);
                copy($_FILES['mediafile__File']['tmp_name'], ADMIN_UPLOAD_PATH . $mediafile__File);
            }
        } else {
            if ($_FILES['mediafile__File']['name'] != '') {
                @unlink(ADMIN_UPLOAD_PATH . $mediafile__File);
                @unlink(ADMIN_UPLOAD_PATH . $_POST['previous_mediafile__File']);
                @unlink(ADMIN_UPLOAD_PATH . 'th-' . $mediafile__File);
                @unlink(ADMIN_UPLOAD_PATH . 'th-' . $_POST['previous_mediafile__File']);
                //Upload Thumb
                suResize($row['mediacat__Thumbnail_Width'], $row['mediacat__Thumbnail_Height'], $_FILES['mediafile__File']['tmp_name'], ADMIN_UPLOAD_PATH . 'th-' . $mediafile__File);
                //Upload Image
                suResize($row['mediacat__Image_Width'], $row['mediacat__Image_Height'], $_FILES['mediafile__File']['tmp_name'], ADMIN_UPLOAD_PATH . $mediafile__File);
            }
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

//Validate entire form in one go using the DB Structure
//To skip validation set '*' to '' like: $dbs_sulata_media_files['mediafile__ID_req']=''   
    //Reset optional

    $dbs_sulata_media_files['mediafile__File_req'] = '';


    $dbs_sulata_media_files['mediafile__File_req'] = '';



    suProcessForm($dbs_sulata_media_files, $validateAsArray);

//Print validation errors on parent
    suValdationErrors($vError);
//update record
    $extraSql = '';

    //for file
    if ($_FILES['mediafile__File']['name'] != '') {
        $uid = uniqid();
        $mediafile__File = suSlugify($_FILES['mediafile__File']['name'], $uid);
        $extraSql.=" ,mediafile__File='{$mediafile__File}' ";
    }

    $sql = "UPDATE sulata_media_files SET mediafile__Category='" . suStrip($_POST['mediafile__Category']) . "',mediafile__Title='" . suStrip($_POST['mediafile__Title']) . "',mediafile__Short_Description='" . suStrip($_POST['mediafile__Short_Description']) . "',mediafile__Long_Description='" . suStrip($_POST['mediafile__Long_Description']) . "',mediafile__Sequence='" . suStrip($_POST['mediafile__Sequence']) . "',mediafile__Date='" . suDate2Db($_POST['mediafile__Date']) . "'
,mediafile__Last_Action_On ='" . date('Y-m-d H:i:s') . "',mediafile__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql . " WHERE mediafile__ID='" . $_POST['mediafile__ID'] . "'";
    suQuery($sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
            $error = sprintf(DUPLICATION_ERROR, '');
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
        $max_id = $_POST['mediafile__ID'];
        //Upload files
        //Get file type and image dimensions if image
        $sql = "SELECT mediacat__Type, mediacat__Thumbnail_Width, mediacat__Thumbnail_Height, mediacat__Image_Width, mediacat__Image_Height FROM sulata_media_categories WHERE mediacat__ID='" . $_POST['mediafile__Category'] . "'";
        $result = suQuery($sql);
        $row = suFetch($result);
        if ($row['mediacat__Thumbnail_Width'] == '0') {
            $row['mediacat__Thumbnail_Width'] = $defaultWidth;
        }
        if ($row['mediacat__Thumbnail_Height'] == '0') {
            $row['mediacat__Thumbnail_Width'] = $defaultHeight;
        }
        if ($row['mediacat__Image_Width'] == '0') {
            $row['mediacat__Image_Width'] = $defaultWidth;
        }
        if ($row['mediacat__Image_Height'] == '0') {
            $row['mediacat__Image_Height'] = $defaultHeight;
        }

        suFree($result);
        //If file
        if ($row['mediacat__Type'] == 'File') {
            // file
            if ($_FILES['mediafile__File']['name'] != '') {
                @unlink(ADMIN_UPLOAD_PATH . $mediafile__File);
                @unlink(ADMIN_UPLOAD_PATH . $_POST['previous_mediafile__File']);
                copy($_FILES['mediafile__File']['tmp_name'], ADMIN_UPLOAD_PATH . $mediafile__File);
            }
        } else {
            if ($_FILES['mediafile__File']['name'] != '') {
                @unlink(ADMIN_UPLOAD_PATH . $mediafile__File);
                @unlink(ADMIN_UPLOAD_PATH . $_POST['previous_mediafile__File']);
                @unlink(ADMIN_UPLOAD_PATH . 'th-' . $mediafile__File);
                @unlink(ADMIN_UPLOAD_PATH . 'th-' . $_POST['previous_mediafile__File']);

                //Upload Thumb
                suResize($row['mediacat__Thumbnail_Width'], $row['mediacat__Thumbnail_Height'], $_FILES['mediafile__File']['tmp_name'], ADMIN_UPLOAD_PATH . 'th-' . $mediafile__File);
                //Upload Image
                suResize($row['mediacat__Image_Width'], $row['mediacat__Image_Height'], $_FILES['mediafile__File']['tmp_name'], ADMIN_UPLOAD_PATH . $mediafile__File);
            }
        }

        /* POST UPDATE PLACE */
        if ($_POST['referrer'] == '') {
            $_POST['referrer'] = ADMIN_URL . 'media-files-cards' . PHP_EXTENSION . '/';
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
    $sql = "UPDATE sulata_media_files SET mediafile__Title=CONCAT('" . $uid . "',mediafile__Title), mediafile__Last_Action_On ='" . date('Y-m-d H:i:s') . "',mediafile__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', mediafile__dbState='Deleted' WHERE mediafile__ID = '" . $id . "'";
    $result = suQuery($sql);
}
?>
