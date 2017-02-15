<?php

//Card code starts
//Get fields to show
$fieldsToShow = "";
$fieldsToShowRemote = "";
$setSql = "";
//$colSize = sizeof($_POST['frmShow']) - 1;

for ($i = 0; $i <= sizeof($_POST['frmShow']) - 1; $i++) {
    if (strstr($_POST['frmShow'][$i], '_Date')) {
        //$colSize = $colSize + 2;
    } else {
        //$colSize = $colSize + 1;
    }
    $colSize = $colSize + 1;
}

$colSize = round(85 / ($colSize - 1));
$colData = "";
$csvHeaders = "";
$fieldsArray = "";
$fieldsToLoop = "";
for ($i = 0; $i <= sizeof($_POST['frmShow']) - 1; $i++) {
    if ($_POST['frmShow'][$i] != $_POST['primary']) {
        if (strstr($_POST['frmShow'][$i], '_Date')) {

            $fieldsToLoop .= "\$" . $_POST['frmShow'][$i] . "[\$key] = \$value['" . $_POST['frmShow'][$i] . "'];\n";
            if ($_POST['frmShow'][$i] == $_POST['frmOrderby']) {
                $tag = "h1";
                $suSubstr = "echo suSubstr(suUnstrip(\$row['" . $_POST['frmShow'][$i] . "2']));";
            } else {
                $tag = "p";
                $suSubstr = "echo suSubstr(suUnstrip(\$row['" . $_POST['frmShow'][$i] . "2']));";
            }
            $fieldsToShow .= "<label>" . makeFieldLabel($_POST['frmShow'][$i]) . "</label>\n
                              <{$tag}>
                              <?php
                                if (!isset(\$row['" . $_POST['frmShow'][$i] . "']) || (\$row['" . $_POST['frmShow'][$i] . "'] == '')) {
                                    echo \"-\";
                                } else {
                                    {$suSubstr}
                                }
                                ?>
                                </{$tag}>\n";
        } elseif (strstr($_POST['frmShow'][$i], '_Picture')) {

            $fieldsToLoop .= "\$" . $_POST['frmShow'][$i] . "[\$key] = \$value['" . $_POST['frmShow'][$i] . "'];\n";
            
            $fieldsToShow .= "<label>" . makeFieldLabel($_POST['frmShow'][$i]) . "</label>\n";
            $fieldsToShow .= "<?php
                                                if ((isset(\$row['".$_POST['frmShow'][$i]."']) && \$row['".$_POST['frmShow'][$i]."'] != '') && (file_exists(ADMIN_UPLOAD_PATH . \$row['".$_POST['frmShow'][$i]."']))) {
                                                    \$defaultImage = BASE_URL . 'files/' . \$row['".$_POST['frmShow'][$i]."'];
                                                } else {
                                                    \$defaultImage = BASE_URL . 'files/default-image.png';
                                                }
                                                ?>
                                            <div class=\"imgThumb\" style=\"background-image:url(<?php echo \$defaultImage; ?>);\"></div>";
        } else {
            if ($_POST['frmShow'][$i] == $_POST['frmOrderby']) {
                $tag = "h1";
                $suSubstr = "echo suSubstr(suUnstrip(\$row['" . $_POST['frmShow'][$i] . "']));";
            } else {
                $tag = "p";
                $suSubstr = "echo suSubstr(suUnstrip(\$row['" . $_POST['frmShow'][$i] . "']));";
            }
            $fieldsToShow .= "<label>" . makeFieldLabel($_POST['frmShow'][$i]) . "</label>\n
                              <{$tag}>
                              <?php
                                if (!isset(\$row['" . $_POST['frmShow'][$i] . "']) || (\$row['" . $_POST['frmShow'][$i] . "'] == '')) {
                                    echo \"-\";
                                } else {
                                    {$suSubstr}
                                }
                                ?>
                                </{$tag}>\n";
            $fieldsToLoop .= "\$" . $_POST['frmShow'][$i] . "[\$key] = \$value['" . $_POST['frmShow'][$i] . "'];\n";
        }
        $fieldsArray.="'" . $_POST['frmShow'][$i] . "',";
        $csvHeaders .= "'" . makeFieldLabel($_POST['frmShow'][$i]) . "',";
    }


    if (strstr($_POST['frmShow'][$i], '_Date')) {
        $fieldsToShowRemote .= $_POST['frmShow'][$i] . ",";
        $fieldsToShowRemote .= " DATE_FORMAT(" . $_POST['frmShow'][$i] . ", '%b %d, %y') AS " . $_POST['frmShow'][$i] . "2,";
    } else {
        $fieldsToShowRemote .= $_POST['frmShow'][$i] . ",";
    }
}
$csvHeaders = substr($csvHeaders, 0, -1);
$colData.="
    <?php if ((\$editAccess == TRUE) || (\$deleteAccess == TRUE)) { ?>
    <td style=\"text-align: center;\">
    <?php if (\$editAccess == TRUE) { ?>
                                                <a href=\"<?php echo ADMIN_URL;?>" . $_POST['frmFormsetvalue'] . "-update<?php echo PHP_EXTENSION;?>/<?php echo \$row['" . $_POST['primary'] . "'];?>/\"><img border=\"0\" src=\"<?php echo BASE_URL; ?>sulata/images/edit.png\" title=\"<?php echo EDIT_RECORD; ?>\"/></a>
                                                    <?php } ?>
<?php if (\$deleteAccess == TRUE) { ?>
                                                <a onclick=\"return delRecord(this, '<?php echo CONFIRM_DELETE; ?>')\" href=\"<?php echo ADMIN_URL; ?>" . $_POST['frmFormsetvalue'] . "-remote<?php echo PHP_EXTENSION;?>/delete/<?php echo \$row['" . $_POST['primary'] . "']; ?>/\" target=\"remote\"><img border=\"0\" src=\"<?php echo BASE_URL; ?>sulata/images/delete.png\" title=\"<?php echo DELETE_RECORD; ?>\"/></a>
                                                    <?php } ?>
                                            </td>
                                            <?php } ?>
                                            
";


$fieldsToShow .= "<?php if ((\$editAccess == TRUE) || (\$deleteAccess == TRUE)) { ?>"
        . "\n<th style=\"width:10%\">&nbsp;</th>\n"
        . "<?php } ?>";

//$fieldsToShow = substr($fieldsToShow, 0, -1);


$fieldsToShowRemote = substr($fieldsToShowRemote, 0, -1);
$fieldsArray = substr($fieldsArray, 0, -1);


$cardPath = $appPath . $_POST['frmSubFolder'] . '/' . $_POST['frmFormsetvalue'] . '-cards.php';
$cardCode = "
                                <form class=\"form-horizontal\" name=\"searchForm\" id=\"searchForm\" method=\"get\" action=\"\">
                                    <fieldset id=\"search-area1\">
                                        <label class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><i class=\"fa fa-search blue\"></i> Search by " . makeFieldLabel($_POST['frmSearchby']) . "</label>
                                        <div class=\"col-xs-7 col-sm-10 col-md-10 col-lg-10\">
                                        <input id=\"q\" type=\"text\" value=\"\" name=\"q\" class=\"form-control\" autocomplete=\"off\">
                                        </div>
                                        <div class=\"col-xs-5 col-sm-2 col-md-2 col-lg-2\">
                                        <input id=\"Submit\" type=\"submit\" value=\"Search\" name=\"Submit\" class=\"btn btn-primary pull-right\">
                                        </div>
                                        <?php if(\$_GET['q']){?>
                                        <div class=\"lineSpacer clear\"></div>
                                         <div class=\"pull-right\"><a style=\"text-decoration:underline !important;\" href=\"<?php echo ADMIN_URL;?>" . $_POST['frmFormsetvalue'] . "-cards<?php echo PHP_EXTENSION;?>/\">Clear search.</a></div>
                                        </div>
                                        <?php } ?>
                                    </fieldset>
                                </form>
                               
                                
                    <div class=\"lineSpacer clear\"></div>
                    <?php if (\$addAccess == 'true') { ?>
                    <div id=\"table-area\"><a href=\"<?php echo ADMIN_URL;?>" . $_POST['frmFormsetvalue'] . "-add<?php echo PHP_EXTENSION;?>/\" class=\"btn btn-black\">Add new..</a></div>
                        <?php } ?>
                        <?php
                                    \$fieldsArray = array(" . $fieldsArray . ");
                                    suSort(\$fieldsArray);
                                    ?>
                                    
<?php
if (\$_GET['q'] != '') {
        \$where .= \" AND " . $_POST['frmSearchby'] . " LIKE '%\" . suStrip(\$_GET['q']) . \"%' \";
    }
    
if (!\$_GET['start']) {
    \$_GET['start'] = 0;
}
if (!\$_GET['sr']) {
    \$sr = 0;
} else {
    \$sr = \$_GET['sr'];
}
if (!\$_GET['sort']) {
    \$sort = \" ORDER BY " . $_POST['uniqueField'] . "\";
} else {
    \$sort = \" ORDER BY \" . \$_GET['f'] . \" \" . \$_GET['sort'];
} 
//Get records from database
    
    \$sql = \"\$sql \$where \$sort LIMIT \" . \$_GET['start'] . \",\" . \$getSettings['page_size'];

    \$result = suQuery(\$sql);
    \$numRows = suNumRows(\$result);

    while(\$row=  suFetch(\$result)){
    
?>
                                        <!-- CARDS START -->
                                        <div class=\"col-xs-12 col-sm-4 col-md-4 col-lg-4\" id=\"card_<?php echo \$row['" . $_POST['primary'] . "']; ?>\">
                                            <div class=\"card\">
                                            <?php if ((\$editAccess == TRUE) || (\$deleteAccess == TRUE)) { ?>

                                                    <header>
                                                        <?php if (\$editAccess == TRUE) { ?>

                                                            <a href=\"<?php echo ADMIN_URL; ?>" . $_POST['frmFormsetvalue'] . "-update<?php echo PHP_EXTENSION;?>/<?php echo \$row['" . $_POST['primary'] . "']; ?>/\"><i class=\"fa fa-edit\"></i></a>
                                                        <?php } ?>

                                                        <?php if (\$deleteAccess == TRUE) { ?>

                                                            <a onclick=\"return delById('card_<?php echo \$row['" . $_POST['primary'] . "']; ?>', '<?php echo CONFIRM_DELETE; ?>')\" href=\"<?php echo ADMIN_URL; ?>" . $_POST['frmFormsetvalue'] . "-remote<?php echo PHP_EXTENSION;?>/delete/<?php echo \$row['" . $_POST['primary'] . "']; ?>/\" target=\"remote\"><i class=\"fa fa-trash\"></i></a>
                                                        <?php } ?>

                                                    </header>
                                                <?php } ?>
                                            $fieldsToShow
                                           
                                        <div class=\"right\"><label><?php echo \$sr = \$sr + 1; ?></label></div>

                                        </div>

                                    </div>
                                    <!-- CARDS END -->
    <?php }suFree(\$result) ?>
<div class=\"clearfix\"></div>
                                   
                    <?php
                                \$sqlP = \"SELECT COUNT(" . $_POST['primary'] . ") AS totalRecs \$sqlFrom \$where\";
                                    

                                suPaginate(\$sqlP);
                                ?>
                                <?php if (\$downloadAccessCSV == TRUE && \$numRows > 0) { ?>
                                    <p>&nbsp;</p>
                                    <p><a target=\"remote\" href=\"<?php echo ADMIN_URL; ?>" . $_POST['frmFormsetvalue'] . "<?php echo PHP_EXTENSION;?>/stream-csv/\" class=\"btn btn-black pull-right\"><i class=\"fa fa-download\"></i> Download CSV</a></p>
                                    <p>&nbsp;</p>
                                    <div class=\"clearfix\"></div>
                                <?php } ?>
                                <?php if (\$downloadAccessPDF == TRUE && \$numRows > 0) { ?>
                                    <p>&nbsp;</p>
                                    <p><a target=\"remote\" href=\"<?php echo ADMIN_URL; ?>" . $_POST['frmFormsetvalue'] . "<?php echo PHP_EXTENSION;?>/stream-pdf/\" class=\"btn btn-black pull-right\"><i class=\"fa fa-download\"></i> Download PDF</a></p>
                                    <p>&nbsp;</p>
                                    <div class=\"clearfix\"></div>
                                <?php } ?>
                    
";

$pageTitle = 'Manage ' . ucwords(str_replace('-', ' ', $_POST['frmFormsetvalue']));
$pageTitle = "\$pageName='" . $pageTitle . "';\$pageTitle='" . $pageTitle . "';";
$csvDownloadCode = "
//Make select statement. The \$SqlFrom is also used in \$sqlP below.    
\$sqlSelect = \"SELECT " . $fieldsToShowRemote . " \";
\$sqlFrom = \" FROM " . $_POST['table'] . " WHERE " . $fieldPrefix . "__dbState='Live'\";
\$sql = \$sqlSelect . \$sqlFrom;";

$switchtoToTableView = "<div class=\"pull-right\">
                                    <a href=\"<?php echo ADMIN_URL; ?>" . $_POST['frmFormsetvalue'] . "<?php echo PHP_EXTENSION;?>/\"><i class=\"fa fa-table\"></i></a>
                                </div>";
//Write card code
$cardCode = str_replace('[RAPID-CODE]', $cardCode, $template);
$cardCode = str_replace("/* rapidSql */", $pageTitle . "\n" . $csvDownloadCode, $cardCode);
$cardCode = str_replace("<!-- SWITCH-VIEW-CODE -->", $switchtoToTableView, $cardCode);


suWrite($cardPath, $cardCode);
//card code ends
?>
