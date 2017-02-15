<?php

include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();

//Validation array
$validateAsArray = array('faq__Question_validateas' => 'required', 'faq__Answer_validateas' => 'required', 'faq__Sequence_validateas' => 'double', 'faq__Status_validateas' => 'enum',);
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
//To skip validation set '*' to '' like: $dbs_sulata_faqs['faq__ID_req']=''   
    suProcessForm($dbs_sulata_faqs, $validateAsArray);


//Print validation errors on parent
    suValdationErrors($vError);


//add record
    $extraSql = '';

    //build query for file  uploads
    $sql = "INSERT INTO sulata_faqs SET faq__Question='" . suStrip($_POST['faq__Question']) . "',faq__Answer='" . suStrip($_POST['faq__Answer']) . "',faq__Sequence='" . suStrip($_POST['faq__Sequence']) . "',faq__Status='" . suStrip($_POST['faq__Status']) . "'
,faq__Last_Action_On ='" . date('Y-m-d H:i:s') . "',faq__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql;
    suQuery($sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
            $error = sprintf(DUPLICATION_ERROR, 'Question');
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
//To skip validation set '*' to '' like: $dbs_sulata_faqs['faq__ID_req']=''   
    //Reset optional


    suProcessForm($dbs_sulata_faqs, $validateAsArray);

//Print validation errors on parent
    suValdationErrors($vError);
//update record
    $extraSql = '';

    $sql = "UPDATE sulata_faqs SET faq__Question='" . suStrip($_POST['faq__Question']) . "',faq__Answer='" . suStrip($_POST['faq__Answer']) . "',faq__Sequence='" . suStrip($_POST['faq__Sequence']) . "',faq__Status='" . suStrip($_POST['faq__Status']) . "'
,faq__Last_Action_On ='" . date('Y-m-d H:i:s') . "',faq__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "'        
" . $extraSql . " WHERE faq__ID='" . $_POST['faq__ID'] . "'";
    suQuery($sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
            $error = sprintf(DUPLICATION_ERROR, 'Question');
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
        $max_id = $_POST['faq__ID'];
        //Upload files

        /* POST UPDATE PLACE */
        if ($_POST['referrer'] == '') {
            $_POST['referrer'] = ADMIN_URL . 'faqs-cards' . PHP_EXTENSION . '/';
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
    $sql = "UPDATE sulata_faqs SET faq__Question=CONCAT('" . $uid . "',faq__Question), faq__Last_Action_On ='" . date('Y-m-d H:i:s') . "',faq__Last_Action_By='" . $_SESSION[SESSION_PREFIX . 'user__Name'] . "', faq__dbState='Deleted' WHERE faq__ID = '" . $id . "'";
    $result = suQuery($sql);
}
?>
