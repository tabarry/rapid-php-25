<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');
include('../sulata/includes/db-structure.php');
$pageName = 'Add Pages';
$pageTitle = 'Add Pages';
checkLogin();
$id = suSegment(1);
$sql = "SELECT page__ID,page__Name,page__Heading,page__Permalink,page__Title,page__Keyword,page__Description,page__Header,page__Short_Text,page__Long_Text,page__Link_Position,page__Parent,page__Sequence FROM sulata_pages WHERE page__ID='" . $id . "' AND page__dbState='Live'";
$result = suQuery($sql);
if (suNumRows($result) == 0) {
    suExit(INVALID_RECORD);
}
$row = suFetch($result);
suFree($result);
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
                                    <a href="<?php echo ADMIN_URL; ?>pages-cards<?php echo PHP_EXTENSION;?>/"><i class="fa fa-th-large"></i></a>
                                    <a href="<?php echo ADMIN_URL; ?>pages<?php echo PHP_EXTENSION;?>/"><i class="fa fa-table"></i></a>
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
                                <form class="form-horizontal" action="<?php echo ADMIN_SUBMIT_URL; ?>pages-remote<?php echo PHP_EXTENSION;?>/update/" accept-charset="utf-8" name="suForm" id="suForm" method="post" target="remote" >			
                                    <div class="gallery clearfix">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <label>
                                                    <?php echo $dbs_sulata_pages['page__Name_req']; ?>Name:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_pages['page__Name_html5_type'], 'name' => 'page__Name', 'id' => 'page__Name', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_pages['page__Name_max'], $dbs_sulata_pages['page__Name_html5_req'] => $dbs_sulata_pages['page__Name_html5_req'], 'class' => 'form-control', 'value' => suUnstrip($row['page__Name']));
                                                echo suInput('input', $arg);
                                                ?>

                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <label><?php echo $dbs_sulata_pages['page__Heading_req']; ?>Heading:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_pages['page__Heading_html5_type'], 'name' => 'page__Heading', 'id' => 'page__Heading', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_pages['page__Heading_max'], $dbs_sulata_pages['page__Heading_html5_req'] => $dbs_sulata_pages['page__Heading_html5_req'], 'class' => 'form-control', 'value' => suUnstrip($row['page__Heading']));
                                                echo suInput('input', $arg);
                                                ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <label><?php echo $dbs_sulata_pages['page__Permalink_req']; ?>Permalink:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_pages['page__Permalink_html5_type'], 'name' => 'page__Permalink', 'id' => 'page__Permalink', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_pages['page__Permalink_max'], $dbs_sulata_pages['page__Permalink_html5_req'] => $dbs_sulata_pages['page__Permalink_html5_req'], 'class' => 'form-control', 'value' => suUnstrip($row['page__Permalink']));
                                                echo suInput('input', $arg);
                                                ?>
                                            </div>


                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <label><?php echo $dbs_sulata_pages['page__Title_req']; ?>Title:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_pages['page__Title_html5_type'], 'name' => 'page__Title', 'id' => 'page__Title', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_pages['page__Title_max'], $dbs_sulata_pages['page__Title_html5_req'] => $dbs_sulata_pages['page__Title_html5_req'], 'class' => 'form-control', 'value' => suUnstrip($row['page__Title']));
                                                echo suInput('input', $arg);
                                                ?>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <label><?php echo $dbs_sulata_pages['page__Keyword_req']; ?>Keyword:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_pages['page__Keyword_html5_type'], 'name' => 'page__Keyword', 'id' => 'page__Keyword', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_pages['page__Keyword_max'], $dbs_sulata_pages['page__Keyword_html5_req'] => $dbs_sulata_pages['page__Keyword_html5_req'], 'class' => 'form-control', 'value' => suUnstrip($row['page__Keyword']));
                                                echo suInput('input', $arg);
                                                ?>

                                            </div>

                                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                                <label><?php echo $dbs_sulata_pages['page__Description_req']; ?>Description:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_pages['page__Description_html5_type'], 'name' => 'page__Description', 'id' => 'page__Description', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_pages['page__Description_max'], $dbs_sulata_pages['page__Description_html5_req'] => $dbs_sulata_pages['page__Description_html5_req'], 'class' => 'form-control', 'value' => suUnstrip($row['page__Description']));
                                                echo suInput('input', $arg);
                                                ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label><?php echo $dbs_sulata_pages['page__Header_req']; ?>Header:
                                                    <?php if ($addAccess == 'true') { ?>    
                                                        <a title="Add new record.." rel="prettyPhoto[iframes]" href="<?php echo ADMIN_URL; ?>headers-add<?php echo PHP_EXTENSION;?>/?overlay=yes&iframe=true&width=50%&height=100%"><img border='0' src='<?php echo BASE_URL; ?>sulata/images/add-icon.png'/></a>

                                                        <a onclick="suReload('page__Header', '<?php echo ADMIN_URL; ?>', '<?php echo suCrypt('sulata_headers'); ?>', '<?php echo suCrypt('header__ID'); ?>', '<?php echo suCrypt('header__Title'); ?>');" href="javascript:;"><img border='0' src='<?php echo BASE_URL; ?>sulata/images/reload-icon.png'/></a>    
                                                    <?php } ?>    
                                                </label>
                                                <?php
                                                $sql = "SELECT header__ID AS f1, header__Title AS f2 FROM sulata_headers WHERE header__dbState='Live' ORDER BY f2";
                                                $options = suFillDropdown($sql);
                                                $js = "class=\"form-control\"";
                                                echo suDropdown('page__Header', $options, suUnstrip($row['page__Header']), $js)
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label><?php echo $dbs_sulata_pages['page__Short_Text_req']; ?>Short Text:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_pages['page__Short_Text_html5_type'], 'name' => 'page__Short_Text', 'id' => 'page__Short_Text', $dbs_sulata_pages['page__Short_Text_html5_req'] => $dbs_sulata_pages['page__Short_Text_html5_req'], 'class' => 'form-control');
                                                echo suInput('textarea', $arg, suUnstrip($row['page__Short_Text']), TRUE);
                                                ?>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <label><?php echo $dbs_sulata_pages['page__Long_Text_req']; ?>Long Text:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_pages['page__Long_Text_html5_type'], 'name' => 'page__Long_Text', 'id' => 'page__Long_Text');
                                                echo suInput('textarea', $arg, suUnstrip($row['page__Long_Text']), TRUE);
                                                suCKEditor('page__Long_Text');
                                                ?>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                                <label><?php echo $dbs_sulata_pages['page__Link_Position_req']; ?>Link Position:</label>
                                                <?php
                                                $options = $dbs_sulata_pages['page__Link_Position_array'];
                                                $js = "class=\"form-control\"";
                                                echo suDropdown('page__Link_Position', $options, suUnstrip($row['page__Link_Position']), $js)
                                                ?>
                                            </div>

                                            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">
                                                <label><?php echo $dbs_sulata_pages['page__Parent_req']; ?>Parent:
                                                    <?php if ($addAccess == 'true') { ?>    
                                                        <a title="Add new record.." rel="prettyPhoto[iframes]" href="<?php echo ADMIN_URL; ?>pages-add<?php echo PHP_EXTENSION;?>/?overlay=yes&iframe=true&width=50%&height=100%"><img border='0' src='<?php echo BASE_URL; ?>sulata/images/add-icon.png'/></a>

                                                        <a onclick="suReload('page__Parent', '<?php echo ADMIN_URL; ?>', '<?php echo suCrypt('sulata_pages'); ?>', '<?php echo suCrypt('page__ID'); ?>', '<?php echo suCrypt('page__Name'); ?>');" href="javascript:;"><img border='0' src='<?php echo BASE_URL; ?>sulata/images/reload-icon.png'/></a>    
                                                    <?php } ?>    
                                                </label>
                                                <?php
                                                
                                                $sql = "SELECT page__ID AS f1, page__Name AS f2 FROM sulata_pages  WHERE page__dbState='Live' ORDER BY f2";

                                                $options = suFillDropdown($sql);
                                                $js = "class=\"form-control\"";
                                                echo suDropdown('page__Parent', $options, suUnstrip($row['page__Parent']), $js)
                                                ?>
                                            </div>

                                            <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                                <label><?php echo $dbs_sulata_pages['page__Sequence_req']; ?>Sequence:</label>
                                                <?php
                                                $arg = array('type' => $dbs_sulata_pages['page__Sequence_html5_type'], 'name' => 'page__Sequence', 'id' => 'page__Sequence', 'autocomplete' => 'off', 'maxlength' => $dbs_sulata_pages['page__Sequence_max'], $dbs_sulata_pages['page__Sequence_html5_req'] => $dbs_sulata_pages['page__Sequence_html5_req'], 'class' => 'form-control', 'value' => suUnstrip($row['page__Sequence']));
                                                echo suInput('input', $arg);
                                                ?>
                                            </div>
                                        </div>
                                        <div class="lineSpacer clear"></div>
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
                                        $arg = array('type' => 'hidden', 'name' => 'page__ID', 'id' => 'page__ID', 'value' => $id);
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