<?php
//Decided if parent needs to be reoloaded or reset
$addReloadParent = "parent.suForm.reset();";

//Build validation type array
for ($i = 1; $i <= sizeof($_POST['frmType']) - 1; $i++) {
    if ($_POST['frmType'][$i] == 'Textbox') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'required', ";
    }
    if ($_POST['frmType'][$i] == 'Email') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'email', ";
    }
    if ($_POST['frmType'][$i] == 'Password') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'password', ";
    }
    if ($_POST['frmType'][$i] == 'Textarea') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'required', ";
    }
    if ($_POST['frmType'][$i] == 'HTML Area') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'required', ";
        //Decided if parent needs to be reoloaded or reset
        $addReloadParent = "parent.window.location.href=\"'.ADMIN_URL.'".$_POST['frmFormsetvalue'] . "-add<?php echo PHP_EXTENSION;?>/\";";
    }
    if ($_POST['frmType'][$i] == 'Integer') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'int', ";
    }

    if ($_POST['frmType'][$i] == 'Double') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'double', ";
    }

    if ($_POST['frmType'][$i] == 'Float') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'float', ";
    }
    if ($_POST['frmType'][$i] == 'Date') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'required', ";
    }
    if ($_POST['frmType'][$i] == 'Enum') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'enum', ";
    }
    if ($_POST['frmType'][$i] == 'Dropdown from DB') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'required', ";
    }
     if ($_POST['frmType'][$i] == 'Searchable Dropdown') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'required', ";
        //Decided if parent needs to be reoloaded or reset
        $addReloadParent = "parent.window.location.href=\"'.ADMIN_URL.'".$_POST['frmFormsetvalue'] . "-add<?php echo PHP_EXTENSION;?>/\";";
    }
    if ($_POST['frmType'][$i] == 'File field') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'file', ";
    }
    if ($_POST['frmType'][$i] == 'Picture field') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'image', ";
    }
    if ($_POST['frmType'][$i] == 'Attachment field') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'attachment', ";
    }
    if ($_POST['frmType'][$i] == 'URL') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'url', ";
    }
    if ($_POST['frmType'][$i] == 'IP') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'ip', ";
    }
    if ($_POST['frmType'][$i] == 'Credit Card') {
        $validateAs .= " '" . $_POST['frmField'][$i] . "_validateas'" . "=>'cc', ";
    }
}
$validateAs = "\$validateAsArray=array(" . $validateAs . ");";

//if auto complete///////
if ($_POST['frmType'][$i] == 'Autocomplete') {
    $setInsertAutocompleteSql = " \$sql = \"SELECT " . $fieldId . " AS f1, " . $fieldText . " AS f2 FROM " . $table . " WHERE ".$fieldPrefix1."__dbState='Live' AND  " . $fieldText . " LIKE '%\" . suUnstrip(\$_REQUEST['term']) . \"%' ORDER BY f2\";
     ";
    
}
//Remote code starts
for ($i = 0; $i <= sizeof($_POST['frmField']) - 1; $i++) {
    if ($_POST['frmField'][$i] != $_POST['primary']) {
        if (!strstr($_POST['frmType'][$i], 'field')) {
            if ($_POST['frmType'][$i] == 'Date') {
                $setInsertSql.=$_POST['frmField'][$i] . "='\".suDate2Db(\$_POST['" . $_POST['frmField'][$i] . "']).\"',";
            } else {
                $setInsertSql.=$_POST['frmField'][$i] . "='\".suStrip(\$_POST['" . $_POST['frmField'][$i] . "']).\"',";
            }
        }
    }
}

$fieldPrefix = explode('__', $_POST['frmField'][0]);
$fieldPrefix = $fieldPrefix[0];
$setInsertSql .= " {$fieldPrefix}__Last_Action_On ='\" . date('Y-m-d H:i:s') . \"',{$fieldPrefix}__Last_Action_By='\" . \$_SESSION[SESSION_PREFIX . 'user__Name'] . \"', {$fieldPrefix}__dbState='Live' \"";

//$setInsertSql = substr($setInsertSql, 0, -1) . '"';
$setInsertSql = $setInsertSql . '';



$remotePath = $appPath . $_POST['frmSubFolder'] . '/' . $_POST['frmFormsetvalue'] . '-remote.php';
$fieldsToShowRemote .="
, CONCAT('<button class=\'jtable-command-button jtable-edit-command-button\' onclick=\\\"window.location.href=\'" . $_POST['frmFormsetvalue'] . "-update.php/'," . $_POST['primary'] . ",'/\'\\\"','-',' title=\'Edit Record\'><span>Edit Record</span></button>') AS edit    
";
$remoteCode = "<?php    
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();

//Validation array
$validateAs
//---------

//Check to stop page opening outside iframe
//Deliberately disabled for list and delete conditions
\$do = suSegment(1);
if ((\$_GET[\"do\"] != \"check\") && (\$_GET[\"do\"] != \"autocomplete\") ".$autoCompleteFrameBuster.") {
    suFrameBuster();
}
?>
<?php


//Add record
if (\$do == \"add\") {
//Check referrer
    suCheckRef();
//Validate
    \$vError = array();

//
//Validate entire form in one go using the DB Structure
//To skip validation set '*' to '' like: \$dbs_" . $_POST['table'] . "['" . $_POST['primary'] . "_req']=''   
    suProcessForm(\$dbs_" . $_POST['table'] . ",\$validateAsArray);
" . $validateAddRemote . "
        
//Print validation errors on parent
    suValdationErrors(\$vError);

//Get autocomplete insert ids
".
    $remoteCodeAutoInsert    
        ."
    
//add record
    \$extraSql = '';
" . $extraSqlx1 . $extraSqlx2 . $extraSqlx3 . "
    //build query for file  uploads
    \$sql = \"INSERT INTO " . $_POST['table'] . " SET " . $setInsertSql . " .\$extraSql;
    suQuery(\$sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
            \$error = sprintf(DUPLICATION_ERROR, '" . $_POST['unique'] . "');
        } else {
            \$error = MYSQL_ERROR;
        }

        suPrintJs('
            parent.suToggleButton(0);
            parent.\$(\"#message-area\").hide();
            parent.\$(\"#error-area\").show();
            parent.\$(\"#error-area\").html(\"<ul><li>' . \$error . '</li></ul>\");
            parent.\$(\"html, body\").animate({ scrollTop: parent.\$(\"html\").offset().top }, \"slow\");
        ');
    } else {
        \$max_id = suInsertId();
        //Upload files
        " . $uploadCheck . "
            
        /*POST INSERT PLACE*/
        " . $addCheckBoxRemote . "
    suPrintJs('
            parent.suToggleButton(0);
            parent.\$(\"#error-area\").hide();
            parent.\$(\"#message-area\").show();
            parent.\$(\"#message-area\").html(\"' . SUCCESS_MESSAGE . '\");
            parent.\$(\"html, body\").animate({ scrollTop: parent.\$(\"html\").offset().top }, \"slow\");
            $addReloadParent

        ');
    }
}
//Update record
if (\$do == \"update\") {
//Check referrer
    suCheckRef();
//Validate
    \$vError = array();

//Validate entire form in one go using the DB Structure
//To skip validation set '*' to '' like: \$dbs_" . $_POST['table'] . "['" . $_POST['primary'] . "_req']=''   

    //Reset optional
   " . $resetUploadValidation . "
    
    suProcessForm(\$dbs_" . $_POST['table'] . ",\$validateAsArray);
    " . $validateAddRemote . "
//Print validation errors on parent
    suValdationErrors(\$vError);
    
//Get autocomplete insert ids
".
    $remoteCodeAutoInsert    
        ."
            
//update record
    \$extraSql = '';
" . $extraSqlx1 . $extraSqlx2 . $extraSqlx3 . "
    \$sql = \"UPDATE " . $_POST['table'] . " SET " . $setInsertSql . " .\$extraSql.\" WHERE " . $_POST['primary'] . "='\" . \$_POST['" . $_POST['primary'] . "'] . \"'\";
    suQuery(\$sql, FALSE);

    if (suErrorNo() > 0) {
        if (suErrorNo() == 1062) {
            \$error = sprintf(DUPLICATION_ERROR, '" . $_POST['unique'] . "');
        } else {
            \$error = MYSQL_ERROR;
        }

        suPrintJs('
            parent.suToggleButton(0);
            parent.\$(\"#message-area\").hide();
            parent.\$(\"#error-area\").show();
            parent.\$(\"#error-area\").html(\"<ul><li>' . \$error . '</li></ul>\");
            parent.\$(\"html, body\").animate({ scrollTop: parent.\$(\"html\").offset().top }, \"slow\");
        ');
    } else {
        \$max_id = \$_POST['" . $_POST['primary'] . "'];
        //Upload files
        " . $uploadCheck . "
        /*POST UPDATE PLACE*/
        " . $updateCheckBoxRemote . "
        if (\$_POST['referrer'] == '') {
            \$_POST['referrer'] = ADMIN_URL . '".$_POST['frmFormsetvalue']."-cards/';
        }
        suPrintJs(\"
            parent.window.location.href='\" . \$_POST['referrer'] . \"';
        \");
    }
}

//Delete record
if (\$do == \"delete\") {
//Check referrer
    suCheckRef();
    \$id = suSegment(2);
//Delete from database by updating just the state
    //make a unique id attach to previous unique field
    \$uid = uniqid() . '-';
    
        \$sql = \"UPDATE " . $_POST['table'] . " SET " . $_POST['uniqueField'] . "=CONCAT('\" . \$uid . \"'," . $_POST['uniqueField'] . "), " . $fieldPrefix . "__Last_Action_On ='\" . date('Y-m-d H:i:s') . \"'," . $fieldPrefix . "__Last_Action_By='\" . \$_SESSION[SESSION_PREFIX . 'user__Name'] . \"', " . $fieldPrefix . "__dbState='Deleted' WHERE " . $_POST['primary'] . " = '\" . \$id . \"'\";
    \$result = suQuery(\$sql);
" . $deleteCheckBoxRemote . "

}


";
$remoteCode = $remoteCode . $remoteCodeAutoComplete;
$remoteCode .="
?>    
";
//Write remote code
suWrite($remotePath, $remoteCode);
//Remote code ends
?>