<?php

//Build details table checkbox section                    
if ($_POST['frmDetailsSourceText'] != 'Checkbox Text..') {
    $f2 = explode('.', $_POST['frmDetailsSourceText']);
    $f2 = end($f2);

    $f1 = explode('.', $_POST['frmDetailsSourceValue']);
    $f1 = end($f1);

    $t1 = explode('.', $_POST['frmDetailsSourceValue']);
    $t1 = current($t1);

    //id
    $f1a = explode('.', $_POST['frmDetailsDestValue']);
    $f1a = end($f1a);
    $t1a = explode('.', $_POST['frmDetailsDestValue']);
    $t1a = current($t1a);
    //text
    $f2a = explode('.', $_POST['frmDetailsDestText']);
    $f2a = end($f2a);
    $prefix = explode('__', $f2a);
    $prefix = $prefix[0];

    //Prefix1
    $prefix1 = explode('.', $_POST['frmDetailsSourceText']);
    $prefix1 = end($prefix1);
    $prefix1 = explode('__', $prefix1);
    $prefix1 = $prefix1[0];

    //Prefix2
    $prefix2 = explode('.', $_POST['frmDetailsDestText']);
    $prefix2 = end($prefix2);
    $prefix2 = explode('__', $prefix2);
    $prefix2 = $prefix2[0];

    $newPage = explodeExtract($t1, "_", 0);
    $newPage = str_replace('_', '-', $newPage);


    //Add sections        
    $addCheckBox = " 
<h2>" . strtoupper(str_replace('-', ' ', explodeExtract($t1, "_", 0))) . "</h2>
<?php if (\$addAccess == 'true') { ?>
<div>
    <a title=\"Add new record..\" rel=\"prettyPhoto[iframes]\" href=\"<?php echo ADMIN_URL; ?>" . $newPage . "-add<?php echo PHP_EXTENSION;?>/?overlay=yes&iframe=true&width=100%&height=100%\"><img border='0' src='<?php echo BASE_URL; ?>sulata/images/add-icon.png'/></a>

    <a onclick=\"suReload2('checkboxLinkArea','<?php echo ADMIN_URL; ?>','<?php echo suCrypt('" . $t1 . "'); ?>','<?php echo suCrypt('" . $f1 . "'); ?>','<?php echo suCrypt('" . $f2 . "'); ?>','<?php echo suCrypt('" . $t1a . "'); ?>','<?php echo suCrypt('" . $f1a . "'); ?>','<?php echo suCrypt('" . $f2a . "'); ?>','<?php echo suCrypt(\$id); ?>');\" href=\"javascript:;\"><img border='0' src='<?php echo BASE_URL; ?>sulata/images/reload-icon.png'/></a>    
</div> 
<?php } ?>  

<div id=\"checkboxArea\">

</div>                                
<p class=\"clearfix\">&nbsp;</p>                                
    <div id=\"checkboxLinkArea\">
<?php
//Build checkboxes

\$sql = \"SELECT " . $f1 . ", " . $f2 . " FROM " . $t1 . " WHERE " . $prefix1 . "__dbState ='Live' ORDER BY " . $f2 . "\";
\$result = suQuery(\$sql);

?>
<div class=\"widget tasks-widget col-xs-12 col-sm-12 col-md-6 col-lg-6\" style=\"padding:0px;margin:0px;\">


<?php
while (\$row = suFetch(\$result)) {
\$chkUid = \$row['" . $f1 . "'];
    ?>
<a id=\"chk<?php echo \$chkUid; ?>\" href=\"javascript:;\" class=\"underline\" onclick=\"loadCheckbox('<?php echo \$chkUid; ?>', '<?php echo addslashes(suUnstrip(\$row['" . $f2 . "'])); ?>', '" . $f2 . "')\" onmouseover=\"toggleCheckboxClass('over', '<?php echo \$chkUid; ?>');\" onmouseout=\"toggleCheckboxClass('out', '<?php echo \$chkUid; ?>');\"><i id=\"fa<?php echo \$chkUid; ?>\" class=\"fa fa-square-o\"></i> <?php echo suUnstrip(\$row['" . $f2 . "']); ?>.</a>
        

    <?php
}suFree(\$result);
?>

</div>
</div>
";
//Update code
    $updateCheckBox = "
<h2>" . strtoupper(str_replace('-', ' ', explodeExtract($t1, "_", 0))) . "</h2>
<?php if (\$addAccess == 'true') { ?>    
<div>
    <a title=\"Add new record..\" rel=\"prettyPhoto[iframes]\" href=\"<?php echo ADMIN_URL; ?>" . $newPage . "-add<?php echo PHP_EXTENSION;?>/?overlay=yes&iframe=true&width=100%&height=100%\"><img border='0' src='<?php echo BASE_URL; ?>sulata/images/add-icon.png'/></a>

    <a onclick=\"suReload2('checkboxLinkArea','<?php echo ADMIN_URL; ?>','<?php echo suCrypt('" . $t1 . "'); ?>','<?php echo suCrypt('" . $f1 . "'); ?>','<?php echo suCrypt('" . $f2 . "'); ?>','<?php echo suCrypt('" . $t1a . "'); ?>','<?php echo suCrypt('" . $f1a . "'); ?>','<?php echo suCrypt('" . $f2a . "'); ?>','<?php echo suCrypt(\$id); ?>');\" href=\"javascript:;\"><img border='0' src='<?php echo BASE_URL; ?>sulata/images/reload-icon.png'/></a>    
</div> 
<?php } ?>  

<div id=\"checkboxArea\">
<?php
\$chkArr = array();
//Get entered data
\$sql = \"SELECT " . $f1a . " FROM " . $t1a . " WHERE " . $prefix2 . "__dbState ='Live' AND " . $f2a . "='\" . \$id . \"'\";
\$result = suQuery(\$sql);
while (\$row = suFetch(\$result)) {
    array_push(\$chkArr, \$row['" . $f1a . "']);
}suFree(\$result);

\$sql = \"SELECT " . $f1 . ", " . $f2 . " FROM " . $t1 . " WHERE " . $prefix1 . "__dbState ='Live' ORDER BY " . $f2 . "\";
\$result = suQuery(\$sql);
                                            while (\$row = suFetch(\$result)) {
                                                \$chkUid = \$row['".$f1."'];
                                                if (in_array(\$row['".$f1."'], \$chkArr)) {
                                                    ?>

                                                    <table id=\"chkTbl<?php echo \$chkUid; ?>\" class=\"checkTable\"><tbody><tr><td class=\"checkTd\"><?php echo suUnstrip(\$row['".$f2."']); ?></td><td onclick=\"removeCheckbox('<?php echo \$row['".$f1."']; ?>')\" class=\"checkTdCancel\"><a onclick=\"removeCheckbox('<?php echo \$row['".$f1."']; ?>')\" href=\"javascript:;\">x</a></td></tr><input type=\"hidden\" name=\"".$f2."[]\" value=\"<?php echo \$row['".$f1."']; ?>\"></tbody></table>
                                           <?php
                                                }
                                            }suFree($result);
                                            ?>    
</div>                                
<p class=\"clearfix\">&nbsp;</p>                                
    <div id=\"checkboxLinkArea\">
<?php

\$sql = \"SELECT " . $f1 . ", " . $f2 . " FROM " . $t1 . " WHERE " . $prefix1 . "__dbState ='Live' ORDER BY " . $f2 . "\";
\$result = suQuery(\$sql);
?>
<div class=\"widget tasks-widget col-xs-12 col-sm-12 col-md-12 col-lg-12\" style=\"padding:0px;margin:0px;\">
    <?php
while (\$row = suFetch(\$result)) {
\$chkUid = \$row['".$f1."'];
if (in_array(\$row['".$f1."'], \$chkArr)) {
                                                        \$display = \"style='display:none'\";
                                                    } else {
                                                        \$display = '';
                                                    }
        ?>
     
<a  <?php echo \$display; ?> id=\"chk<?php echo \$chkUid; ?>\" href=\"javascript:;\" class=\"underline\" onclick=\"loadCheckbox('<?php echo \$chkUid; ?>', '<?php echo addslashes(suUnstrip(\$row['" . $f2 . "'])); ?>', '" . $f2 . "')\" onmouseover=\"toggleCheckboxClass('over', '<?php echo \$chkUid; ?>');\" onmouseout=\"toggleCheckboxClass('out', '<?php echo \$chkUid; ?>');\"><i id=\"fa<?php echo \$chkUid; ?>\" class=\"fa fa-square-o\"></i> <?php echo suUnstrip(\$row['" . $f2 . "']); ?>.</a>
        

    <?php
}suFree(\$result);
?>

</div>
</div>

";
//Validate remote
    $validateAddRemote = "
//Check if at least one checkbox is selected
if (sizeof(\$_POST['" . $f2 . "'])==0) {
    \$vError[]=VALIDATE_EMPTY_CHECKBOX;
}  
";

//Delete remote
    $deleteCheckBoxRemote = "
//Delete from child checkboxes table
\$sql = \"UPDATE " . $t1a . " SET " . $prefix . "__Last_Action_On='\".date('Y-m-d H:i:s').\"', " . $prefix . "__Last_Action_By='\".\$_SESSION[SESSION_PREFIX . 'user__Name'] .\" WHERE " . $f2a . "='\".\$_POST[\"" . $_POST['primary'] . "\"].\"'\";
suQuery(\$sql);
";


    //Add remote
    $addCheckBoxRemote = "
//Add details data
        for (\$i = 0; \$i <= sizeof(\$_POST['" . $f2 . "'])-1; \$i++) {
            \$sql = \"INSERT INTO " . $t1a . " SET " . $f2a . "='\".\$max_id.\"', $f1a='\".\$_POST['" . $f2 . "'][\$i].\"', " . $prefix . "__Last_Action_On='\".date('Y-m-d H:i:s').\"', " . $prefix . "__Last_Action_By='\".\$_SESSION[SESSION_PREFIX . 'user__Name'] .\"'\";
            suQuery(\$sql);
        }
        
";
    //update remote
    $updateCheckBoxRemote = "
//update details data
        //Delete privious data
        \$sql = \"DELETE FROM " . $t1a . " WHERE " . $f2a . "='\".\$max_id.\"'\";
        suQuery(\$sql);
       
        for (\$i = 0; \$i <= sizeof(\$_POST['" . $f2 . "'])-1; \$i++) {
            \$sql = \"INSERT INTO " . $t1a . " SET " . $f2a . "='\".\$max_id.\"', $f1a='\".\$_POST['" . $f2 . "'][\$i].\"', " . $prefix . "__Last_Action_On='\".date('Y-m-d H:i:s').\"', " . $prefix . "__Last_Action_By='\".\$_SESSION[SESSION_PREFIX . 'user__Name'] .\"'\";            
            suQuery(\$sql);
        }
        
";
}
?>