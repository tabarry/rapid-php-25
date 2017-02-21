<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();

//Validation array
$validateAsArray = array('testimonial__Name_validateas' => 'required', 'testimonial__Location_validateas' => 'required', 'testimonial__Testimonial_validateas' => 'required', 'testimonial__Date_validateas' => 'required', 'testimonial__Status_validateas' => 'enum',);
//---------
//Check to stop page opening outside iframe
//Deliberately disabled for list and delete conditions
$do = suSegment(1);
if (($_GET["do"] != "check") && ($_GET["do"] != "autocomplete")) {
    suFrameBuster();
}
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
//To skip validation set '*' to '' like: $dbs_sulata_testimonials['testimonial__ID_req']=''   
    suProcessForm($dbs_sulata_testimonials, $validateAsArray);


//Print validation errors on parent
    suValdationErrors($vError);

//Get autocomplete insert ids
//add record
    $extraSql = '';

    //build query for file  uploads
    $sql = "INSERT INTO sulata_testimonials SET testimonial__Name='" . suStrip($_POST['testimonial__Name']) . "',testimonial__Location='" . suStrip($_POST['testimonial__Location']) . "',testimonial__Testimonial='" . suStrip($_POST['testimonial__Testimonial']) . "',testimonial__Date='" . suDate2Db($_POST['testimonial__Date']) . "',testimonial__Status='" . suStrip($_POST['testimonial__Status']) . "', testimonial__Last_Action_On ='" . date('Y-m-d H:i:s') . "',testimonial__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', testimonial__dbState='Live' " . $extraSql;
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
            $_POST['referrer'] = ADMIN_URL . 'testimonials-cards' . PHP_EXTENSION . '/';
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
//To skip validation set '*' to '' like: $dbs_sulata_testimonials['testimonial__ID_req']=''   
    //Reset optional


    suProcessForm($dbs_sulata_testimonials, $validateAsArray);

//Print validation errors on parent
    suValdationErrors($vError);

//Get autocomplete insert ids
//update record
    $extraSql = '';

    $sql = "UPDATE sulata_testimonials SET testimonial__Name='" . suStrip($_POST['testimonial__Name']) . "',testimonial__Location='" . suStrip($_POST['testimonial__Location']) . "',testimonial__Testimonial='" . suStrip($_POST['testimonial__Testimonial']) . "',testimonial__Date='" . suDate2Db($_POST['testimonial__Date']) . "',testimonial__Status='" . suStrip($_POST['testimonial__Status']) . "', testimonial__Last_Action_On ='" . date('Y-m-d H:i:s') . "',testimonial__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', testimonial__dbState='Live' " . $extraSql . " WHERE testimonial__ID='" . $_POST['testimonial__ID'] . "'";
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
        $max_id = $_POST['testimonial__ID'];
        //Upload files

        /* POST UPDATE PLACE */

        if ($_POST['referrer'] == '') {
            $_POST['referrer'] = ADMIN_URL . 'testimonials-cards' . PHP_EXTENSION . '/';
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

    $sql = "UPDATE sulata_testimonials SET testimonial__Name=CONCAT('" . $uid . "',testimonial__Name), testimonial__Last_Action_On ='" . date('Y-m-d H:i:s') . "',testimonial__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', testimonial__dbState='Deleted' WHERE testimonial__ID = '" . $id . "'";
    $result = suQuery($sql);
}

//Restore record
if ($do == "restore") {
//Check referrer
    suCheckRef();
    $id = suSegment(2);

    $sql = "UPDATE sulata_testimonials SET testimonial__Name=SUBSTR(testimonial__Name," . (UID_LENGTH + 1) . "), testimonial__Last_Action_On ='" . date('Y-m-d H:i:s') . "',testimonial__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', testimonial__dbState='Live' WHERE testimonial__ID = '" . $id . "'";
    $result = suQuery($sql);
    if ($result['errno'] > 0) {
        if ($result['errno'] == 1062) {
            $error = sprintf(DUPLICATION_ERROR_ON_UPDATE, 'Name');
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
?>    
