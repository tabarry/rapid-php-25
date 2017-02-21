<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
checkLogin();
$pageName = 'Add Testimonials';
$pageTitle = 'Add Testimonials';
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
                                    <a href="<?php echo ADMIN_URL; ?>testimonials-cards<?php echo PHP_EXTENSION; ?>/"><i class="fa fa-th-large"></i></a>
                                    <a href="<?php echo ADMIN_URL; ?>testimonials<?php echo PHP_EXTENSION; ?>/"><i class="fa fa-table"></i></a>
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

                                <form class="form-horizontal" action="<?php echo ADMIN_SUBMIT_URL; ?>testimonials-remote<?php echo PHP_EXTENSION; ?>/add/" accept-charset="utf-8" name="suForm" id="suForm" method="post" target="remote" >

                                    <div class="gallery clearfix">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                
                                                <label><?php echo $dbs_sulata_testimonials['testimonial__Name_req']; ?>Name:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_testimonials['testimonial__Name_html5_type'], 'name' => 'testimonial__Name', 'id' => 'testimonial__Name', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_testimonials['testimonial__Name_max'], 'value' => '', $dbs_sulata_testimonials['testimonial__Name_html5_req'] => $dbs_sulata_testimonials['testimonial__Name_html5_req'], 'class' => 'form-control', 'placeholder' => TESTIMONIAL_PLACEHOLDER);
                                                echo suInput('input', $arg);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                
                                                <label><?php echo $dbs_sulata_testimonials['testimonial__Location_req']; ?>Location:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_testimonials['testimonial__Location_html5_type'], 'name' => 'testimonial__Location', 'id' => 'testimonial__Location', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_testimonials['testimonial__Location_max'], 'value' => '', $dbs_sulata_testimonials['testimonial__Location_html5_req'] => $dbs_sulata_testimonials['testimonial__Location_html5_req'], 'class' => 'form-control');
                                                echo suInput('input', $arg);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                
                                                <label><?php echo $dbs_sulata_testimonials['testimonial__Testimonial_req']; ?>Testimonial:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_testimonials['testimonial__Testimonial_html5_type'], 'name' => 'testimonial__Testimonial', 'id' => 'testimonial__Testimonial', $dbs_sulata_testimonials['testimonial__Testimonial_html5_req'] => $dbs_sulata_testimonials['testimonial__Testimonial_html5_req'], 'class' => 'form-control');
                                                echo suInput('textarea', $arg, '', TRUE);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">    
                                                <label><?php echo $dbs_sulata_testimonials['testimonial__Date_req']; ?>Date:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_testimonials['testimonial__Date_html5_type'], 'name' => 'testimonial__Date', 'id' => 'testimonial__Date', 'autocomplete' => 'off', 'class' => 'form-control dateBox', 'maxlength' => $dbs_sulata_testimonials['testimonial__Date_max'], $dbs_sulata_testimonials['testimonial__Date_html5_req'] => $dbs_sulata_testimonials['testimonial__Date_html5_req']);
                                                echo suInput('input', $arg);
                                                ?>
                                            </div>
                                        </div>
                                        <script>
                                            $(function() {
                                                $('#testimonial__Date').datepicker({
                                                    changeMonth: true,
                                                    changeYear: true
                                                });
                                                $('#testimonial__Date').datepicker('option', 'yearRange', 'c-100:c+10');
                                                $('#testimonial__Date').datepicker('option', 'dateFormat', '<?php echo DATE_FORMAT; ?>');
                                                $('#testimonial__Date').datepicker('setDate', '<?php echo $today ?>');
                                            });

                                        </script>                                  


                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">        
                                                <label><?php echo $dbs_sulata_testimonials['testimonial__Status_req']; ?>Status:</label>
                                                <?php
                                                $options = $dbs_sulata_testimonials['testimonial__Status_array'];
                                                $js = "class='form-control'";
                                                echo suDropdown('testimonial__Status', $options, '', $js)
                                                ?>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="lineSpacer clear"></div>
                                    <p>
                                        <?php
                                        $arg = array('type' => 'submit', 'name' => 'Submit', 'id' => 'Submit', 'value' => 'Submit', 'class' => 'btn btn-primary pull-right');
                                        echo suInput('input', $arg);
                                        ?>                              
                                    </p>
                                    <p>&nbsp;</p>
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