<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
$pageName = 'Add Media Files';
$pageTitle = 'Add Media Files';
checkLogin();
/* rapidSql */
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
                                <h3 class="pull-left"><i class="fa fa-desktop purple"></i> <?php echo $pageTitle; ?></h3>
                                <div class="pull-right">
                                    <a href="<?php echo ADMIN_URL; ?>media-files-cards<?php echo PHP_EXTENSION;?>/"><i class="fa fa-th-large"></i></a>
                                    <a href="<?php echo ADMIN_URL; ?>media-files<?php echo PHP_EXTENSION;?>/"><i class="fa fa-table"></i></a>
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
                                <form class="form-horizontal" action="<?php echo ADMIN_SUBMIT_URL; ?>media-files-remote<?php echo PHP_EXTENSION;?>/add/" accept-charset="utf-8" name="suForm" id="suForm" method="post" target="remote" enctype="multipart/form-data">			
                                    <div class="gallery clearfix">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <label><?php echo $dbs_sulata_media_files['mediafile__Category_req']; ?>Category:
                                                    <?php if ($addAccess == 'true') { ?>    
                                                        <a title="Add new record.." rel="prettyPhoto[iframes]" href="<?php echo ADMIN_URL; ?>media-categories-add<?php echo PHP_EXTENSION;?>/?overlay=yes&iframe=true&width=50%&height=100%"><img border='0' src='<?php echo BASE_URL; ?>sulata/images/add-icon.png'/></a>

                                                        <a onclick="suReload('mediafile__Category', '<?php echo ADMIN_URL; ?>', '<?php echo suCrypt('sulata_media_categories'); ?>', '<?php echo suCrypt('mediacat__ID'); ?>', '<?php echo suCrypt('mediacat__Name'); ?>');" href="javascript:;"><img border='0' src='<?php echo BASE_URL; ?>sulata/images/reload-icon.png'/></a>    
                                                    <?php } ?>    
                                                </label>
                                                <?php
                                                $sql = "SELECT mediacat__ID AS f1, mediacat__Name AS f2 FROM sulata_media_categories WHERE mediacat__dbState='Live' ORDER BY f2";
                                                $options = suFillDropdown($sql);
                                                $js = "class=\"form-control\"";
                                                echo suDropdown('mediafile__Category', $options, '', $js)
                                                ?>

                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <label><?php echo $dbs_sulata_media_files['mediafile__Title_req']; ?>Title:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_media_files['mediafile__Title_html5_type'], 'name' => 'mediafile__Title', 'id' => 'mediafile__Title', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_media_files['mediafile__Title_max'], $dbs_sulata_media_files['mediafile__Title_html5_req'] => $dbs_sulata_media_files['mediafile__Title_html5_req'], 'class' => 'form-control');
                                                echo suInput('input', $arg);
                                                ?>


                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label><?php echo $dbs_sulata_media_files['mediafile__File_req']; ?>File:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_media_files['mediafile__File_html5_type'], 'name' => 'mediafile__File', 'id' => 'mediafile__File', $dbs_sulata_media_files['mediafile__File_html5_req'] => $dbs_sulata_media_files['mediafile__File_html5_req']);
                                                echo suInput('input', $arg);
                                                ?>

                                                <div><?php echo $getSettings['allowed_file_formats']; ?></div>


                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label><?php echo $dbs_sulata_media_files['mediafile__Short_Description_req']; ?>Short Description:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_media_files['mediafile__Short_Description_html5_type'], 'name' => 'mediafile__Short_Description', 'id' => 'mediafile__Short_Description', $dbs_sulata_media_files['mediafile__Short_Description_html5_req'] => $dbs_sulata_media_files['mediafile__Short_Description_html5_req'], 'class' => 'form-control');
                                                echo suInput('textarea', $arg, '', TRUE);
                                                ?>

                                            </div>
                                        </div>
                                        <div class="small-12 medium-12 large-12 columns">
                                            <label><?php echo $dbs_sulata_media_files['mediafile__Long_Description_req']; ?>Long Description:</label>
                                            <?php
                                            $arg = array('type' => $dbs_sulata_media_files['mediafile__Long_Description_html5_type'], 'name' => 'mediafile__Long_Description', 'id' => 'mediafile__Long_Description');
                                            echo suInput('textarea', $arg, '', TRUE);
                                            suCKEditor('mediafile__Long_Description');
                                            ?>


                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                <label><?php echo $dbs_sulata_media_files['mediafile__Sequence_req']; ?>Sequence:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_media_files['mediafile__Sequence_html5_type'], 'name' => 'mediafile__Sequence', 'id' => 'mediafile__Sequence', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_media_files['mediafile__Sequence_max'], $dbs_sulata_media_files['mediafile__Sequence_html5_req'] => $dbs_sulata_media_files['mediafile__Sequence_html5_req'], 'class' => 'form-control');
                                                echo suInput('input', $arg);
                                                ?>

                                            </div>
                                            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">


                                                <label>
                                                    <?php echo $dbs_sulata_media_files['mediafile__Date_req']; ?>Date:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_media_files['mediafile__Date_html5_type'], 'name' => 'mediafile__Date', 'id' => 'mediafile__Date', 'autocomplete' => 'off', 'class' => 'dateBox', 'maxlength' => $dbs_sulata_media_files['mediafile__Date_max'], $dbs_sulata_media_files['mediafile__Date_html5_req'] => $dbs_sulata_media_files['mediafile__Date_html5_req'], 'class' => 'form-control dateBox');
                                                echo suInput('input', $arg);
                                                ?>
                                                <script>
                                                    $(function() {
                                                        $('#mediafile__Date').datepicker({
                                                            changeMonth: true,
                                                            changeYear: true
                                                        });
                                                        $('#mediafile__Date').datepicker('option', 'yearRange', 'c-100:c+10');
                                                        $('#mediafile__Date').datepicker('option', 'dateFormat', '<?php echo DATE_FORMAT; ?>');
                                                        $('#mediafile__Date').datepicker('setDate', '<?php echo $today ?>');
                                                    });

                                                </script>     
                                            </div>
                                        </div>
                                        <div class="lineSpacer clear"></div>
                                        <p>
                                            <?php
                                            $arg = array('type' => 'submit', 'name' => 'Submit', 'id' => 'Submit', 'value' => 'Submit', 'class' => 'btn btn-primary pull-right');
                                            echo suInput('input', $arg);
                                            ?>                              
                                        </p>
                                    </div>
                                </form>
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