<?php

$thisVal = "''";
if ($doUpdate == TRUE) {
    $thisVal = " suUnstrip(\$row['" . $_POST['frmField'][$i] . "'])";
} else {
    $thisVal = "'" . $_POST['frmDefaultvalue'][$i] . "'";
}
$addCode .="
<div class=\"form-group\">
<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">        
<label><?php echo \$dbs_" . $_POST['table'] . "['" . $_POST['frmField'][$i] . "_req']; ?>" . $_POST['frmLabel'][$i] . ":</label>
                                <?php
                                \$options = \$dbs_" . $_POST['table'] . "['" . $_POST['frmField'][$i] . "_array'];
                                    \$js = \"class='form-control'\";
                                echo suDropdown('" . $_POST['frmField'][$i] . "', \$options, " . $thisVal . ",\$js)
                                ?>
</div>
</div>
";
?>