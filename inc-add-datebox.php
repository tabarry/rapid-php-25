<?php

$thisVal = "\$today";
if ($doUpdate == TRUE) {
    $thisVal = "suDateFromDb(\$row['" . $_POST['frmField'][$i] . "'])";
}
$addCode .="
<div class=\"form-group\">
<div class=\"col-xs-12 col-sm-12 col-md-12 col-lg-12\">    
<label><?php echo \$dbs_" . $_POST['table'] . "['" . $_POST['frmField'][$i] . "_req']; ?>" . $_POST['frmLabel'][$i] . ":</label>
                                <?php
                                \$arg = array('type' => \$dbs_" . $_POST['table'] . "['" . $_POST['frmField'][$i] . "_html5_type'], 'name' => '" . $_POST['frmField'][$i] . "', 'id' => '" . $_POST['frmField'][$i] . "', 'autocomplete' => 'off', 'class' => 'form-control dateBox', 'maxlength' => \$dbs_" . $_POST['table'] . "['" . $_POST['frmField'][$i] . "_max'],\$dbs_" . $_POST['table'] . "['" . $_POST['frmField'][$i] . "_html5_req'] => \$dbs_" . $_POST['table'] . "['" . $_POST['frmField'][$i] . "_html5_req']);
                                echo suInput('input', \$arg);
                                ?>
</div>
</div>
                                <script>
                                    \$(function() {
                                        \$( '#" . $_POST['frmField'][$i] . "' ).datepicker({
                                            changeMonth: true,
                                            changeYear: true
                                        });
                                        \$( '#" . $_POST['frmField'][$i] . "' ).datepicker( 'option', 'yearRange', 'c-100:c+10' );
                                        \$( '#" . $_POST['frmField'][$i] . "' ).datepicker( 'option', 'dateFormat', '<?php echo DATE_FORMAT; ?>' );
                                        \$('#" . $_POST['frmField'][$i] . "').datepicker('setDate', '<?php echo  " . $thisVal . " ?>' );                
                                    });
		
                                </script>                                  
    
";
?>