<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
$pageName = 'Manage Headers';
$pageTitle = 'Manage Headers';
checkLogin();
$sql = "SELECT header__ID,header__Title FROM sulata_headers WHERE header__dbState='Live'";
//Download CSV
if (suSegment(1) == 'stream-csv' && $downloadAccessCSV == TRUE) {
    $outputFileName = 'headers.csv';
    $headerArray = array('Title');
    suSqlToCSV($sql, $headerArray, $outputFileName);
    exit;
}
//Download PDF
if (suSegment(1) == 'stream-pdf' && $downloadAccessPDF == TRUE) {
    $outputFileName = 'headers.pdf';
    $fieldsArray = array('header__Title');
    $headerArray = array('Title');
    suSqlToPDF($sql, $headerArray, $fieldsArray, $outputFileName);
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include('inc-head.php'); ?>
        <script type="text/javascript">
            $(document).ready(function() {
                //Keep session alive
                $(function() {
                    window.setInterval("suStayAlive('<?php echo PING_URL; ?>')", 300000);
                });
                //Disable submit button
                suToggleButton(1);
            });</script>
    </head>

    <body>

        <div class="outer">

            <!-- Sidebar starts -->

            <?php include('inc-sidebar.php'); ?>
            <!-- Sidebar ends -->

            <!-- Mainbar starts -->
            <div class="mainbar">
                <?php include('inc-heading.php'); ?>
                <!-- Mainbar head starts -->
                <div class="main-head">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <!-- Bread crumbs -->
                                <?php include('inc-breadcrumbs.php'); ?>
                            </div>

                            <div class="col-md-3 col-sm-4 col-xs-6">
                                <!-- Search block -->

                            </div>

                            <div class="col-md-3 col-sm-4 hidden-xs">
                                <!-- Notifications -->
                                <div class="head-noty text-center">

                                </div>
                                <div class="clearfix"></div>
                            </div>


                            <div class="col-md-3 hidden-sm hidden-xs">
                                <!-- Head user -->

                                <?php include('inc-header.php'); ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Mainbar head ends -->

                <div class="main-content">
                    <div class="container">

                        <div class="page-content">

                            <!-- Heading -->
                            <div class="single-head">
                                <!-- Heading -->
                                <h3 class="pull-left"><i class="fa fa-table red"></i> <?php echo $pageTitle; ?></h3>
                                <div class="pull-right">
                                    <a href="<?php echo ADMIN_URL; ?>headers-cards<?php echo PHP_EXTENSION; ?>/"><i class="fa fa-th-large"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div id="content-area">

                                <div id="error-area">
                                    <ul></ul>
                                </div>
                                <div id="message-area">
                                    <p></p>
                                </div>
                                <!--SU STARTS-->

                                <form class="form-horizontal" name="searchForm" id="searchForm" method="get" action="">
                                    <fieldset id="search-area1">
                                        <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><i class="fa fa-search blue"></i> Search by Title</label>
                                        <div class="col-xs-7 col-sm-10 col-md-10 col-lg-10">
                                            <input id="q" type="search" value="" name="q" class="form-control" autocomplete="off" autofocus="autofocus">
                                        </div>
                                        <div class="col-xs-5 col-sm-2 col-md-2 col-lg-2">
                                            <input id="Submit" type="submit" value="Search" name="Submit" class="btn btn-primary pull-right">
                                            <?php if (isset($_GET['q'])) { ?>
                                                <div class="lineSpacer clear"></div>
                                                <div class="pull-right"><a class="underline" href="<?php echo ADMIN_URL; ?>headers/">Clear search.</a></div>
                                            <?php } ?>
                                        </div>
                                    </fieldset>
                                </form>
                                <div class="lineSpacer clear"></div>
                                <?php if ($addAccess == 'true') { ?>
                                    <div id="table-area"><a href="<?php echo ADMIN_URL; ?>headers-add<?php echo PHP_EXTENSION; ?>/" class="btn btn-black">Add new..</a></div>
                                <?php } ?>
                                <?php
                                $fieldsArray = array('header__Title');
                                suSort($fieldsArray);
                                ?>
                                <table width="100%" class="table table-hover table-bordered tbl">
                                    <thead>
                                        <tr>
                                            <th style="width:5%">
                                                Sr.
                                            </th>

                                            <th style="width:85%">
                                                Title
                                            </th>
                                            <?php if (($editAccess == TRUE) || ($deleteAccess == TRUE)) { ?>
                                                <th style="width:10%">
                                                    &nbsp;
                                                </th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($_GET['q'] != '') {
                                            $where .= " AND header__Title LIKE '%" . suStrip($_GET['q']) . "%' ";
                                        }
                                        if (!$_GET['start']) {
                                            $_GET['start'] = 0;
                                        }
                                        if (!$_GET['sr']) {
                                            $sr = 0;
                                        } else {
                                            $sr = $_GET['sr'];
                                        }
                                        if (!$_GET['sort']) {
                                            $sort = " ORDER BY header__Title";
                                        } else {
                                            $sort = " ORDER BY " . $_GET['f'] . " " . $_GET['sort'];
                                        }
                                        $sql = "$sql $where $sort LIMIT " . $_GET['start'] . "," . $getSettings['page_size'];
                                        $result = suQuery($sql);
                                        $numRows = $result['num_rows'];
                                        foreach ($result['result'] as $row) {
                                            ?>
                                            <tr id="card_<?php echo $row['header__ID']; ?>">
                                                <td>
                                                    <?php echo $sr = $sr + 1; ?>.
                                                </td>
                                                <td>
                                                    <?php echo suUnstrip($row['header__Title']); ?>
                                                </td>
                                                <?php if (($editAccess == TRUE) || ($deleteAccess == TRUE)) { ?>
                                                    <td style="text-align: center;">
                                                        <?php if ($editAccess == TRUE) { ?>

                                                            <a title="<?php echo EDIT; ?>" id="card_<?php echo $row['header__ID']; ?>_edit" href="<?php echo ADMIN_URL; ?>headers-update<?php echo PHP_EXTENSION; ?>/<?php echo $row['header__ID']; ?>/"><i class="fa fa-edit"></i></a>
                                                        <?php } ?>
                                                        <?php if ($duplicateAccess == TRUE) { ?>
                                                            <a title="<?php echo DUPLICATE; ?>" id="card_<?php echo $row['header__ID']; ?>_duplicate" href="<?php echo ADMIN_URL; ?>headers-update<?php echo PHP_EXTENSION; ?>/<?php echo $row['header__ID']; ?>/duplicate/"><i class="fa fa-copy"></i></a>
                                                        <?php } ?>
                                                        <?php if ($deleteAccess == TRUE) { ?>

                                                            <a title="<?php echo DELETE; ?>" id="card_<?php echo $row['header__ID']; ?>_del" onclick="return delById('card_<?php echo $row['header__ID']; ?>', '<?php echo CONFIRM_DELETE_RESTORE; ?>')" href="<?php echo ADMIN_URL; ?>headers-remote<?php echo PHP_EXTENSION; ?>/delete/<?php echo $row['header__ID']; ?>/" target="remote"><i class="fa fa-trash"></i></a>
                                                        <?php } ?>

                                                        <?php if ($restoreAccess == TRUE) { ?>

                                                            <a title="<?php echo RESTORE; ?>" id="card_<?php echo $row['header__ID']; ?>_restore" href="<?php echo ADMIN_URL; ?>headers-remote<?php echo PHP_EXTENSION; ?>/restore/<?php echo $row['header__ID']; ?>/" target="remote" style="display:none"><i class="fa fa-undo"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                                <?php
                                ?>

                                <?php
                                $sqlP = "SELECT COUNT(header__ID) AS totalRecs FROM sulata_headers WHERE header__dbState='Live' $where";
                                suPaginate($sqlP);
                                ?>
                                <?php if ($downloadAccessCSV == TRUE && $numRows > 0) { ?>
                                    <p>&nbsp;</p>
                                    <p><a target="remote" href="<?php echo ADMIN_URL; ?>headers<?php echo PHP_EXTENSION; ?>/stream-csv/" class="btn btn-black pull-right"><i class="fa fa-download"></i> Download CSV</a></p>
                                    <p>&nbsp;</p>
                                    <div class="clearfix"></div>
                                <?php } ?>
                                <?php if ($downloadAccessPDF == TRUE && $numRows > 0) { ?>
                                    <p>&nbsp;</p>
                                    <p><a target="remote" href="<?php echo ADMIN_URL; ?>headers<?php echo PHP_EXTENSION; ?>/stream-pdf/" class="btn btn-black pull-right"><i class="fa fa-file-pdf-o"></i> Download PDF</a></p>
                                    <p>&nbsp;</p>
                                    <div class="clearfix"></div>
                                <?php } ?>
                                <!--SU ENDS-->
                            </div>
                        </div>
                        <?php include('inc-site-footer.php'); ?>
                    </div>
                </div>

            </div>

            <!-- Mainbar ends -->

            <div class="clearfix"></div>
        </div>
        <?php include('inc-footer.php'); ?>
        <?php suIframe(); ?>
    </body>
    <!--PRETTY PHOTO-->
    <?php include('inc-pretty-photo.php'); ?>
</html>