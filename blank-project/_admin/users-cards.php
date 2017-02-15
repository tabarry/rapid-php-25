<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();
$sql = "SELECT user__ID,user__Name,user__Phone,user__Email,user__Status FROM sulata_users WHERE user__dbState='Live'";

$pageName = 'Manage Users';
$pageTitle = 'Manage Users';
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
                                    <a href="<?php echo ADMIN_URL; ?>users<?php echo PHP_EXTENSION;?>/"><i class="fa fa-table"></i></a>
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
                                        <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><i class="fa fa-search blue"></i> Search by Name, Phone or Email</label>
                                        <div class="col-xs-7 col-sm-10 col-md-10 col-lg-10">
                                            <input id="q" type="text" value="" name="q" class="form-control" autocomplete="off">
                                        </div>
                                        <div class="col-xs-5 col-sm-2 col-md-2 col-lg-2">
                                            <input id="Submit" type="submit" value="Search" name="Submit" class="btn btn-primary pull-right">
                                            <?php if (isset($_GET['q'])) { ?>
                                                <div class="lineSpacer clear"></div>
                                                <div class="pull-right"><a class="underline" href="<?php echo ADMIN_URL; ?>users-cards<?php echo PHP_EXTENSION;?>/">Clear search.</a></div>
                                            <?php } ?>
                                        </div>
                                    </fieldset>
                                </form>
                                <div class="lineSpacer clear"></div>
                                <?php if ($addAccess == 'true') { ?>
                                    <div id="table-area"><a href="<?php echo ADMIN_URL; ?>users-add<?php echo PHP_EXTENSION;?>/" class="btn btn-black">Add new..</a></div>
                                <?php } ?>
                                <?php
                                $fieldsArray = array('user__Name', 'user__Phone', 'user__Email', 'user__Status');
                                suSort($fieldsArray);
                                ?>

                                <?php
                                if ($_GET['q'] != '') {
                                    $where .= " AND (user__Name LIKE '%" . suStrip($_GET['q']) . "%' OR user__Phone LIKE '%" . $_GET['q'] . "%' OR user__Email LIKE '%" . $_GET['q'] . "%' )";
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
                                    $sort = " ORDER BY user__Name";
                                } else {
                                    $sort = " ORDER BY " . $_GET['f'] . " " . $_GET['sort'];
                                }
                                $sql = "$sql $where $sort LIMIT " . $_GET['start'] . "," . $getSettings['page_size'];

                                $result = suQuery($sql);
                                $numRows = suNumRows($result);
                                while ($row = suFetch($result)) {
                                    ?>
                                    <!-- CARDS START -->
                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4" id="card_<?php echo $row['user__ID']; ?>">
                                        <div class="card">
                                            <?php if (($editAccess == TRUE) || ($deleteAccess == TRUE)) { ?>

                                                <header>
                                                    <?php if ($editAccess == TRUE) { ?>

                                                        <a href="<?php echo ADMIN_URL; ?>users-update<?php echo PHP_EXTENSION;?>/<?php echo $row['user__ID']; ?>/"><i class="fa fa-edit"></i></a>
                                                    <?php } ?>

                                                    <?php if ($deleteAccess == TRUE) { ?>
                                                        <?php if ($row['user__ID'] != $_SESSION[SESSION_PREFIX . 'user__ID']) { ?>
                                                            <a onclick="return delById('card_<?php echo $row['user__ID']; ?>', '<?php echo CONFIRM_DELETE; ?>')" href="<?php echo ADMIN_URL; ?>users-remote<?php echo PHP_EXTENSION;?>/delete/<?php echo $row['user__ID']; ?>/" target="remote"><i class="fa fa-trash"></i></a>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </header>
                                            <?php } ?>

                                            <label>Name</label>
                                            <h1><?php
                                                if (suUnstrip($row['user__Name']) == '') {
                                                    echo "-";
                                                } else {
                                                    echo suSubstr(suUnstrip($row['user__Name']));
                                                }
                                                ?></h1>

                                            <label>Phone</label>
                                            <p><?php
                                                if (suUnstrip($row['user__Phone']) == '') {
                                                    echo "-";
                                                } else {
                                                    echo suSubstr(suUnstrip($row['user__Phone']));
                                                }
                                                ?></p>
                                            <label>Email</label>
                                            <p><?php
                                                if (suUnstrip($row['user__Email']) == '') {
                                                    echo "-";
                                                } else {
                                                    echo suSubstr(suUnstrip($row['user__Email']));
                                                }
                                                ?></p>
                                            <label>Status</label>
                                            <p><?php
                                                if (suUnstrip($row['user__Status']) == '') {
                                                    echo "-";
                                                } else {
                                                    echo suSubstr(suUnstrip($row['user__Status']));
                                                }
                                                ?></p>
                                            <div class="right"><label><?php echo $sr = $sr + 1; ?></label></div>

                                        </div>

                                    </div>
                                    <!-- CARDS END -->

                                <?php }suFree($result) ?>
                                <div class="clearfix"></div>

                                <?php
                                $sqlP = "SELECT COUNT(user__ID) AS totalRecs FROM sulata_users WHERE user__dbState='Live' $where ";

                                suPaginate($sqlP);
                                ?>
                                <?php if ($downloadAccessCSV == TRUE && $numRows > 0) { ?>
                                    <p>&nbsp;</p>
                                    <p><a target="remote" href="<?php echo ADMIN_URL; ?>users<?php echo PHP_EXTENSION;?>/stream-csv/" class="btn btn-black pull-right"><i class="fa fa-download"></i> Download CSV</a></p>
                                    <p>&nbsp;</p>
                                    <div class="clearfix"></div>
                                <?php } ?>
                                <?php if ($downloadAccessPDF == TRUE && $numRows > 0) { ?>
                                    <p>&nbsp;</p>
                                    <p><a target="remote" href="<?php echo ADMIN_URL; ?>users<?php echo PHP_EXTENSION;?>/stream-pdf/" class="btn btn-black pull-right"><i class="fa fa-file-pdf-o"></i> Download PDF</a></p>
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