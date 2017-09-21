<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');

checkLogin();

//Check if action is duplicate
if (suSegment(2) == 'duplicate') {
    $do = 'add';
    $pageName = 'Duplicate FAQ';
    $pageTitle = 'Duplicate FAQ';
} else {
    $do = 'update';
    $pageName = 'Update FAQ';
    $pageTitle = 'Update FAQ';
}

$id = suSegment(1);


$sql = "SELECT faq__ID,faq__Question,faq__Answer,faq__Sequence,faq__Status FROM sulata_faqs WHERE faq__ID='" . $id . "' AND faq__dbState='Live'";
$result = suQuery($sql);
$row = $result['result'][0];
if ($result['num_rows'] == 0) {
    suExit(INVALID_RECORD);
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
                                    <?php if ($getSettings['card_view'] == 1) { ?>
                                        <a href="<?php echo ADMIN_URL; ?>faqs-cards<?php echo PHP_EXTENSION; ?>/"><i class="fa fa-th-large"></i></a>
                                    <?php } ?>
                                    <a href="<?php echo ADMIN_URL; ?>faqs<?php echo PHP_EXTENSION; ?>/"><i class="fa fa-table"></i></a>
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


                                <form class="form-horizontal" action="<?php echo ADMIN_SUBMIT_URL; ?>faqs-remote<?php echo PHP_EXTENSION; ?>/<?php echo $do; ?>/" accept-charset="utf-8" name="suForm" id="suForm" method="post" target="remote" >			
                                    <div class="gallery clearfix">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label><?php echo $dbs_sulata_faqs['faq__Question_req']; ?>Question:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_faqs['faq__Question_html5_type'], 'value' => suUnstrip($row['faq__Question']), 'name' => 'faq__Question', 'id' => 'faq__Question', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_faqs['faq__Question_max'], $dbs_sulata_faqs['faq__Question_html5_req'] => $dbs_sulata_faqs['faq__Question_html5_req'], 'class' => 'form-control');
                                                echo suInput('input', $arg);
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label><?php echo $dbs_sulata_faqs['faq__Answer_req']; ?>Answer:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_faqs['faq__Answer_html5_type'], 'name' => 'faq__Answer', 'id' => 'faq__Answer');
                                                echo suInput('textarea', $arg, suUnstrip($row['faq__Answer']), TRUE);
                                                suCKEditor('faq__Answer');
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                <label><?php echo $dbs_sulata_faqs['faq__Sequence_req']; ?>Sequence:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_faqs['faq__Sequence_html5_type'], 'name' => 'faq__Sequence', 'id' => 'faq__Sequence', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_faqs['faq__Sequence_max'], 'value' => suUnstrip($row['faq__Sequence']), $dbs_sulata_faqs['faq__Sequence_html5_req'] => $dbs_sulata_faqs['faq__Sequence_html5_req'], 'class' => 'form-control');
                                                echo suInput('input', $arg);
                                                ?>
                                            </div>

                                            <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                                <label><?php echo $dbs_sulata_faqs['faq__Status_req']; ?>Status:</label>
                                                <?php
                                                $options = $dbs_sulata_faqs['faq__Status_array'];
                                                $js = "class=\"form-control\"";
                                                echo suDropdown('faq__Status', $options, suUnstrip($row['faq__Status']), $js)
                                                ?>
                                            </div>
                                        </div>
                                        <p>
                                            <?php
                                            $arg = array('type' => 'submit', 'name' => 'Submit', 'id' => 'Submit', 'value' => 'Submit', 'class' => 'btn btn-primary pull-right');
                                            echo suInput('input', $arg);
                                            ?>                              
                                        </p>
                                        <?php
                                        //Referrer field
                                        $arg = array('type' => 'hidden', 'name' => 'referrer', 'id' => 'referrer', 'value' => $_SERVER['HTTP_REFERER']);
                                        echo suInput('input', $arg);
                                        //Id field
                                        $arg = array('type' => 'hidden', 'name' => 'faq__ID', 'id' => 'faq__ID', 'value' => $id);
                                        echo suInput('input', $arg);

//If Duplicate
                                        if ($do == 'add') {
                                            $arg = array('type' => 'hidden', 'name' => 'duplicate', 'id' => 'duplicate', 'value' => '1');
                                        }
                                        echo suInput('input', $arg);
                                        ?>
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