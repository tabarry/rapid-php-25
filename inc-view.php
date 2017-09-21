<?php

//View code starts
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
$pdfHeaders = "";
$fieldsArray = "";
for ($i = 0; $i <= sizeof($_POST['frmShow']) - 1; $i++) {
    if ($_POST['frmShow'][$i] != $_POST['primary']) {
        if (strstr($_POST['frmShow'][$i], '_Date')) {
            $fieldsToShow .= "<th style=\"width:" . $colSize . "%\">" . makeFieldLabel($_POST['frmShow'][$i]) . "</th>\n";
            $colData .= "<td><?php echo suUnstrip(\$row['" . $_POST['frmShow'][$i] . "2']);?></td>\n";
        } elseif (strstr($_POST['frmShow'][$i], '_Picture')) {
            $fieldsToShow .= "<th style=\"width:" . $colSize . "%\">" . makeFieldLabel($_POST['frmShow'][$i]) . "</th>\n";
            $colData .= "<td><?php
                                                if ((isset(\$row['" . $_POST['frmShow'][$i] . "']) && \$row['" . $_POST['frmShow'][$i] . "'] != '') && (file_exists(ADMIN_UPLOAD_PATH . \$row['" . $_POST['frmShow'][$i] . "']))) {
                                                    \$defaultImage = BASE_URL . 'files/' . \$row['" . $_POST['frmShow'][$i] . "'];
                                                } else {
                                                    \$defaultImage = BASE_URL . 'files/default-image.png';
                                                }
                                                ?>
                                            <div class=\"imgThumb\" style=\"background-image:url(<?php echo \$defaultImage; ?>);\"></div></td>\n";
        } else {
            if ($_POST['frmType'][$i] == 'Currency') {
                $fieldsToShow .= "<th class=\"right\" style=\"width:" . $colSize . "%\">" . makeFieldLabel($_POST['frmShow'][$i]) . " <sup><?php echo \$getSettings['site_currency'];?></sup></th>\n";
            } elseif ($_POST['frmType'][$i] == 'Float' || $_POST['frmType'][$i] == 'Integer' || $_POST['frmType'][$i] == 'Double') {
                $fieldsToShow .= "<th class=\"right\" style=\"width:" . $colSize . "%\">" . makeFieldLabel($_POST['frmShow'][$i]) . "</th>\n";
            } else {
                $fieldsToShow .= "<th style=\"width:" . $colSize . "%\">" . makeFieldLabel($_POST['frmShow'][$i]) . "</th>\n";
            }

            if ($_POST['frmType'][$i] == 'Integer') {
                $colData .= "<td class=\"right\"><?php echo number_format(suUnstrip(\$row['" . $_POST['frmShow'][$i] . "']));?></td>\n";
            } elseif ($_POST['frmType'][$i] == 'Double' || $_POST['frmType'][$i] == 'Float' || $_POST['frmType'][$i] == 'Currency') {

                $colData .= "<td class=\"right\"><?php echo number_format(suUnstrip(\$row['" . $_POST['frmShow'][$i] . "']),2);?></td>\n";
            } else {
                $colData .= "<td><?php echo suUnstrip(\$row['" . $_POST['frmShow'][$i] . "']);?></td>\n";
            }
        }
        $fieldsArray.="'" . $_POST['frmShow'][$i] . "',";
        $csvHeaders .= "'" . makeFieldLabel($_POST['frmShow'][$i]) . "',";
        $pdfHeaders .= "'" . $_POST['frmShow'][$i] . "',";
    }


    if (strstr($_POST['frmShow'][$i], '_Date')) {
        $fieldsToShowRemote .= $_POST['frmShow'][$i] . ",";
        $fieldsToShowRemote .= " DATE_FORMAT(" . $_POST['frmShow'][$i] . ", '%b %d, %y') AS " . $_POST['frmShow'][$i] . "2,";
    } else {
        $fieldsToShowRemote .= $_POST['frmShow'][$i] . ",";
    }
}
$csvHeaders = substr($csvHeaders, 0, -1);
$pdfHeaders = substr($pdfHeaders, 0, -1);

$colData.="
    <?php if ((\$editAccess == TRUE) || (\$deleteAccess == TRUE)) { ?>
    <td style=\"text-align: center;\">
    <?php if (\$editAccess == TRUE) { ?>
                                                <a title=\"<?php echo EDIT; ?>\" id=\"card_<?php echo \$row['" . $_POST['primary'] . "']; ?>_edit\" href=\"<?php echo ADMIN_URL;?>" . $_POST['frmFormsetvalue'] . "-update<?php echo PHP_EXTENSION;?>/<?php echo \$row['" . $_POST['primary'] . "'];?>/\"><i class=\"fa fa-edit\"></i></a>
                                                    
<?php } ?>
                                                    
<?php if (\$duplicateAccess == TRUE) { ?>
                                                <a title=\"<?php echo DUPLICATE; ?>\" id=\"card_<?php echo \$row['" . $_POST['primary'] . "']; ?>_duplicate\" href=\"<?php echo ADMIN_URL;?>" . $_POST['frmFormsetvalue'] . "-update<?php echo PHP_EXTENSION;?>/<?php echo \$row['" . $_POST['primary'] . "'];?>/duplicate/\"><i class=\"fa fa-copy\"></i></a>
                  <?php } ?>                                  
<?php if (\$deleteAccess == TRUE) { ?>
                                                <a title=\"<?php echo DELETE; ?>\" id=\"card_<?php echo \$row['" . $_POST['primary'] . "']; ?>_del\" onclick=\"return delById('card_<?php echo \$row['" . $_POST['primary'] . "']; ?>', '<?php echo CONFIRM_DELETE_RESTORE; ?>')\" href=\"<?php echo ADMIN_URL; ?>" . $_POST['frmFormsetvalue'] . "-remote<?php echo PHP_EXTENSION;?>/delete/<?php echo \$row['" . $_POST['primary'] . "']; ?>/\" target=\"remote\"><i class=\"fa fa-trash\"></i></a>
                                                    <?php } ?>
<?php if (\$restoreAccess == TRUE) { ?>
                                                <a title=\"<?php echo RESTORE; ?>\" id=\"card_<?php echo \$row['" . $_POST['primary'] . "']; ?>_restore\" href=\"<?php echo ADMIN_URL; ?>" . $_POST['frmFormsetvalue'] . "-remote<?php echo PHP_EXTENSION;?>/restore/<?php echo \$row['" . $_POST['primary'] . "']; ?>/\" target=\"remote\" style=\"display:none\"><i class=\"fa fa-undo\"></i></a>
                                                    <?php } ?>                                                    


                                            </td>
                                            <?php } ?>
                                            
";
/* $fieldsToShow .= "
  edit: {title: '',width: '2%',sorting:false,list:<?php echo \$editAccess; ?>},"; */

$fieldsToShow .= "<?php if ((\$editAccess == TRUE) || (\$deleteAccess == TRUE)) { ?>"
        . "\n<th style=\"width:10%\">&nbsp;</th>\n"
        . "<?php } ?>";

//$fieldsToShow = substr($fieldsToShow, 0, -1);


$fieldsToShowRemote = substr($fieldsToShowRemote, 0, -1);
$fieldsArray = substr($fieldsArray, 0, -1);


$viewPath = $appPath . $_POST['frmSubFolder'] . '/' . $_POST['frmFormsetvalue'] . '.php';
$viewCode = "
                                <form class=\"form-horizontal\" name=\"searchForm\" id=\"searchForm\" method=\"get\" action=\"\">
                                    <fieldset id=\"search-area1\">
                                        <label class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\"><i class=\"fa fa-search blue\"></i> Search by " . makeFieldLabel($_POST['frmSearchby']) . "</label>
                                        <div class=\"col-xs-7 col-sm-10 col-md-10 col-lg-10\">
                                        <input id=\"q\" type=\"search\" value=\"\" name=\"q\" class=\"form-control\" autocomplete=\"off\" autofocus=\"autofocus\">
                                        </div>
                                        <div class=\"col-xs-5 col-sm-2 col-md-2 col-lg-2\">
                                        <input id=\"Submit\" type=\"submit\" value=\"Search\" name=\"Submit\" class=\"btn btn-primary pull-right\">
                                        </div>
                                        <?php if(\$_GET['q']){?>
                                        <div class=\"lineSpacer clear\"></div>
                                         <div class=\"pull-right\"><a style=\"text-decoration:underline !important;\" href=\"<?php echo ADMIN_URL;?>" . $_POST['frmFormsetvalue'] . "<?php echo PHP_EXTENSION;?>/\">Clear search.</a></div>
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
<!-- TABLE -->

   <table width=\"100%\" class=\"table table-hover table-bordered tbl\">
                                    <thead>
                                        <tr>
                                            <th style=\"width:5%\">
                                                Sr.
                                            </th>
                                          
                                           $fieldsToShow
                                        </tr>
                                    </thead>
                                    <tbody>
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
    \$sort = \" ORDER BY " . $_POST['frmOrderby'] . "\";
} else {
    \$sort = \" ORDER BY \" . \$_GET['f'] . \" \" . \$_GET['sort'];
} 
//Get records from database
    
    \$sql = \"\$sql \$where \$sort LIMIT \" . \$_GET['start'] . \",\" . \$getSettings['page_size'];

    \$result = suQuery(\$sql);
    \$numRows = \$result['num_rows'];
    foreach (\$result['result'] as \$row) {
    
?>
                                        <tr id=\"card_<?php echo \$row['" . $_POST['primary'] . "']; ?>\">
                                            <td>
                                                <?php echo \$sr = \$sr + 1; ?>.
                                            </td>
                                            $colData
                                           
                                        </tr>
    <?php } ?>

                                    </tbody>
                                </table>
<!-- /TABLE -->
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
\$sql = \$sqlSelect . \$sqlFrom;

//Download CSV
if (suSegment(1) == 'stream-csv' && \$downloadAccessCSV == TRUE) {
    \$outputFileName = '" . $_POST['frmFormsetvalue'] . ".csv';
    \$headerArray = array(" . $csvHeaders . ");
    suSqlToCSV(\$sql, \$headerArray, \$outputFileName);
    exit;
}
//Download PDF
if (suSegment(1) == 'stream-pdf' && \$downloadAccessPDF == TRUE) {
    \$outputFileName = '" . $_POST['frmFormsetvalue'] . ".pdf';
    \$fieldsArray = array(" . $pdfHeaders . ");
    \$headerArray = array(" . $csvHeaders . ");
    suSqlToPDF(\$sql, \$headerArray, \$fieldsArray, \$outputFileName);
    exit;
}
";
$switchToCardView = "<div class=\"pull-right\">
    <?php if(\$getSettings['card_view']==1){ ?>
                                    <a href=\"<?php echo ADMIN_URL; ?>" . $_POST['frmFormsetvalue'] . "-cards<?php echo PHP_EXTENSION;?>/\"><i class=\"fa fa-th-large\"></i></a>
                                </div>
<?php } ?>                                
";
//Write view code
$viewCode = str_replace('[RAPID-CODE]', $viewCode, $template);
$viewCode = str_replace("/* rapidSql */", $pageTitle . "\n" . $csvDownloadCode, $viewCode);
$viewCode = str_replace("<!-- SWITCH-VIEW-CODE -->", $switchToCardView, $viewCode);

suWrite($viewPath, $viewCode);
//View code ends
?>
