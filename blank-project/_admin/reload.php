<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');

//Check to stop page opening outside iframe
//Check referrer
suCheckRef();
if ($_GET['type'] == 'chk') {
    $tbl = suDecrypt($_GET['tbl']);
    $f1 = suDecrypt($_GET['f1']);
    $f2 = suDecrypt($_GET['f2']);
    $tblb = suDecrypt($_GET['tblb']);
    $f1b = suDecrypt($_GET['f1b']);
    $f2b = suDecrypt($_GET['f2b']);
    $id = suDecrypt($_GET['id']);

    //Get entered data
    $sql = "SELECT " . $f1b . " FROM " . $tblb . " WHERE " . $f2b . "='" . $id . "'";
    $result = suQuery($sql);
    $chkArr = array();

    foreach ($result['result'] as $row) {
        array_push($chkArr, $row[$f1b]);
    }


//Build checkboxes
    //State field
    $stateField = explode('__', $f1);
    $stateField = $stateField[0] . '__dbState';

    $sql = "SELECT $f1 AS f1, $f2 AS f2 FROM $tbl WHERE $stateField='Live' ORDER BY $f2";
    $result = suQuery($sql);

    foreach ($result['result'] as $row) {
        $chkUid = $row['f1'];
        if (in_array($row['f1'], $chkArr)) {
            $display = "style='display:none'";
        } else {
            $display = '';
        }
        ?>
        <a <?php echo $display; ?> id="chk<?php echo $chkUid; ?>" href="javascript:;" class="underline" onclick="loadCheckbox('<?php echo $chkUid; ?>', '<?php echo addslashes(suUnstrip($row['f2'])); ?>', '<?php echo $f2; ?>')" onmouseover="toggleCheckboxClass('over', '<?php echo $chkUid; ?>');" onmouseout="toggleCheckboxClass('out', '<?php echo $chkUid; ?>');"><i id="fa<?php echo $chkUid; ?>" class="fa fa-square-o"></i> <?php echo suUnstrip($row['f2']); ?>.</a>
        <?php
    }
    echo '
        </ul>
        </div>';
} else {
    $dd = "<option value='^'>Select..</option>";
    $tbl = suDecrypt($_GET['tbl']);
    $f1 = suDecrypt($_GET['f1']);
    $f2 = suDecrypt($_GET['f2']);
    $stateField = explode('__', $f1);
    $stateField = $stateField[0] . '__dbState';
    $sql = "SELECT $f1 AS f1, $f2 AS f2 FROM $tbl WHERE $stateField='Live' ORDER BY $f2";
    $result = suQuery($sql);
    foreach ($result['result'] as $row) {
        $dd.="<option value='" . $row['f1'] . "'>" . suUnstrip($row['f2']) . "</option>";
    }
    echo $dd;
}
?>