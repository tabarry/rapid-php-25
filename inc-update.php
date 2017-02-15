<?php

$autoCompleteCount = "";
$remoteCodeAutoInsert = "";
$remoteCodeAutoComplete = "";
$addReloadParent = "";
//Update section starts
$extraSqlx1 = '';
$extraSqlx2 = '';
$extraSqlx3 = '';
$addCode = '';
$updatePath = $appPath . $_POST['frmSubFolder'] . '/' . $_POST['frmFormsetvalue'] . '-update.php';
$doUpdate = TRUE;

for ($i = 0; $i <= sizeof($_POST['frmField']) - 1; $i++) {
    $fieldsToUpdate .= $_POST['frmField'][$i] . ',';
    if ($_POST['frmType'][$i] == 'Textbox') {
        include('inc-add-textbox.php');
    }
    if ($_POST['frmType'][$i] == 'URL') {
        include('inc-add-textbox.php');
    }
    if ($_POST['frmType'][$i] == 'IP') {
        include('inc-add-textbox.php');
    }
    if ($_POST['frmType'][$i] == 'Credit Card') {
        include('inc-add-integerbox.php');
    }
    if ($_POST['frmType'][$i] == 'Password') {
        include('inc-add-passwordbox.php');
    }
    if ($_POST['frmType'][$i] == 'Email') {
        include('inc-add-textbox.php');
    }
    if ($_POST['frmType'][$i] == 'Date') {
        include('inc-add-datebox.php');
    }
    if ($_POST['frmType'][$i] == 'Integer') {
        include('inc-add-integerbox.php');
    }
    if ($_POST['frmType'][$i] == 'Double') {
        include('inc-add-integerbox.php');
    }
    if ($_POST['frmType'][$i] == 'Float') {
        include('inc-add-integerbox.php');
    }
    if ($_POST['frmType'][$i] == 'Textarea') {
        include('inc-add-textarea.php');
    }
    if ($_POST['frmType'][$i] == 'HTML Area') {
        include('inc-add-htmlarea.php');
    }
    if ($_POST['frmType'][$i] == 'Picture field') {
        include('inc-add-picturebox.php');
    }
    if ($_POST['frmType'][$i] == 'File field') {
        include('inc-add-filebox.php');
    }
    if ($_POST['frmType'][$i] == 'Attachment field') {
        include('inc-add-attachmentbox.php');
    }
    if ($_POST['frmType'][$i] == 'Enum') {
        include('inc-add-enumbox.php');
    }
    if ($_POST['frmType'][$i] == 'Dropdown from DB') {
        include('inc-add-dbdropdownbox.php');
    }
    if ($_POST['frmType'][$i] == 'Autocomplete') {
        include('inc-add-autocompletebox.php');
    }
    if ($_POST['frmType'][$i] == 'Searchable Dropdown') {
        include('inc-add-searchable-dropdown.php');
    }
}
if ($multipart == TRUE) {
    $multipart = 'enctype="multipart/form-data"';
} else {
    $multipart = '';
}

$pageTitle = 'Update ' . ucwords(str_replace('-', ' ', $_POST['frmFormsetvalue']));
$pageTitle = "\$pageName='" . $pageTitle . "';\$pageTitle='" . $pageTitle . "';";

/////////////////////////
$fieldPrefix = explode('__', $_POST['frmField'][0]);
$fieldPrefix = $fieldPrefix[0];

$fieldsToUpdate = substr($fieldsToUpdate, 0, -1);
$updateSql = "
\$id = suSegment(1);
if(!is_numeric(\$id)){
	suExit(INVALID_RECORD);
}
\$sql = \"SELECT " . $fieldsToUpdate . " FROM " . $_POST['table'] . " WHERE " . $fieldPrefix . "__dbState='Live' AND " . $_POST['primary'] . "='\" . \$id . \"'\";
\$result = suQuery(\$sql);
if (suNumRows(\$result) == 0) {
    suExit(INVALID_RECORD);
}
\$row = suFetch(\$result);
suFree(\$result);    
";
$updateCodeStart = '
        <form class="form-horizontal" action="<?php echo ADMIN_SUBMIT_URL; ?>' . $_POST['frmFormsetvalue'] . '-remote<?php echo PHP_EXTENSION;?>/update/" accept-charset="utf-8" name="suForm" id="suForm" method="post" target="remote" ' . $multipart . '>
            <div class="gallery clearfix">';

$updateCodeEnd = "
        <!--Child Table Place-->
        <p>
        <?php
        \$arg = array('type' => 'submit', 'name' => 'Submit', 'id' => 'Submit', 'value' => 'Submit', 'class' => 'btn btn-primary pull-right');
        echo suInput('input', \$arg);
        ?>                              
        </p>
        <?php
        //Referrer field
        \$arg = array('type' => 'hidden', 'name' => 'referrer', 'id' => 'referrer', 'value' => \$_SERVER['HTTP_REFERER']);
        echo suInput('input', \$arg);                       
        //Id field
        \$arg = array('type' => 'hidden', 'name' => '" . $_POST['primary'] . "', 'id' => '" . $_POST['primary'] . "', 'value' => \$id);
        echo suInput('input', \$arg);
        ?>
        <p>&nbsp;</p>
        </form>
";
$updateCode = $updateCodeStart . $addCode . $updateCodeEnd;
$switchView = "<div class=\"pull-right\">
                                    <a href=\"<?php echo ADMIN_URL; ?>" . $_POST['frmFormsetvalue'] . "-cards<?php echo PHP_EXTENSION;?>/\"><i class=\"fa fa-th-large\"></i></a>
                                    <a href=\"<?php echo ADMIN_URL; ?>" . $_POST['frmFormsetvalue'] . "<?php echo PHP_EXTENSION;?>/\"><i class=\"fa fa-table\"></i></a>
                                </div>";
//Write update code
$updateCode = str_replace('[RAPID-CODE]', $updateCode, $template);
$updateCode = str_replace("/* rapidSql */", $updateSql . "\n" . $pageTitle, $updateCode);
$updateCode = str_replace("<!--Child Table Place-->", $updateCheckBox, $updateCode);
$updateCode = str_replace("<!-- SWITCH-VIEW-CODE -->", $switchView, $updateCode);

suWrite($updatePath, $updateCode);
//Update section ends
?>
