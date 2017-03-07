<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();
$pageName = 'Modules';
$pageTitle = 'Modules';
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
            });
        </script> 
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
                                <h3 class="pull-left"><i class="fa fa-th-large purple"></i> <?php echo $pageTitle; ?></h3>

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
                                <div class="clearfix">
                                    <?php
                                    $dir = './';
                                    $dir = scandir($dir);
                                    //$sidebarExclude comes from config.php
                                    foreach ($dir as $file) {
                                        if ((!in_array($file, $sidebarExclude)) && ($file[0] != '.')) {

                                            if ((!stristr($file, '-add')) && (!stristr($file, '-remote')) && (!stristr($file, '-update')) && (!stristr($file, 'inc-')) && (!stristr($file, '-cards'))) {

                                                $fileNameActual = str_replace('.php', '', $file);
                                                $fileName = str_replace('-', ' ', $fileNameActual);

                                                //Table view or card view
                                                if ($getSettings['table_or_card'] == 'card') {
                                                    if (PHP_EXTENSION == '') {
                                                        $file = str_replace('.php', '-cards/', $file);
                                                    } else {
                                                        $file = str_replace('.php', '-cards' . PHP_EXTENSION . '/', $file);
                                                    }
                                                } else {
                                                    $file = $file . '/';
                                                }

                                                $fileNameShow = str_replace('_', ' ', $fileName);

                                                if (stristr($fileNameShow, 'faqs')) {
                                                    $fileNameShow = 'FAQs';
                                                }
                                                ?>
                                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"> 
                                                    <div class="module">
                                                        <a href="<?php echo ADMIN_URL . $file; ?>" class="btn sideLinkReverse"><i class="fa fa-caret-right"></i> <?php echo ucwords($fileNameShow); ?></a>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>     
                                </div>
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