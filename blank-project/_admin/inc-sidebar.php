<?php if ($_GET['overlay'] != 'yes') { ?>
    <div class="sidebar">

        <div class="sidey">
            <!-- Logo -->
            <!-- Sidebar navigation starts -->

            <!-- Responsive dropdown -->
            <div class="sidebar-dropdown"><a href="#" class="br-red"><i class="fa fa-bars"></i></a></div>

            <div class="side-nav">

                <div class="side-nav-block">
                    <!-- Sidebar heading -->
                    <!-- Sidebar links -->
                    <ul class="list-unstyled">
                        <?php if ($_SESSION[SESSION_PREFIX . 'user__ID'] == '') { ?>
                            <li><a href="<?php echo ADMIN_URL; ?>login.php" class="btn sideLink"><i class="fa fa-key"></i> Log In</a></li>
                        <?php } ?>
                        <?php if ($_SESSION[SESSION_PREFIX . 'user__ID'] != '') { ?>
                            <li><a href="<?php echo ADMIN_URL; ?>" class="btn sideLinkReverse"><i class="fa fa-home"></i> Home</a></li>   
                            <li><a href="<?php echo ADMIN_URL; ?>notes<?php echo PHP_EXTENSION;?>/" class="btn sideLink"><i class="fa fa-pencil"></i> Free Notes</a></li>


                            <li><a href="<?php echo ADMIN_URL; ?>settings<?php echo $tableCardLink; ?><?php echo PHP_EXTENSION;?>/" class="btn sideLink"><i class="fa fa-cogs"></i> Settings</a></li>
                            <li><a href="<?php echo ADMIN_URL; ?>themes<?php echo PHP_EXTENSION;?>/" class="btn sideLink"><i class="fa fa-photo"></i> Themes</a></li>
                            <li><a href="<?php echo ADMIN_URL; ?>users-update<?php echo PHP_EXTENSION;?>/" class="btn sideLink"><i class="fa fa-user"></i> Update Profile</a></li>
                            <li><a href="<?php echo ADMIN_URL; ?>login<?php echo PHP_EXTENSION;?>/?do=logout" target="remote" class="btn sideLinkReverse"><i class="fa fa-power-off"></i> Log Out</a></li>   
                            <li class="divider"></li>
                        <?php } ?>
                        <?php
                        if ($getSettings['sidebar_links'] == 1) {
                            if ($_SESSION[SESSION_PREFIX . 'user__ID'] != '') {
                                ?>

                                <h4>&nbsp;</h4>

                                <?php
                                $dir = './';
                                $dir = scandir($dir);
                                $exclude = array(
                                    '.',
                                    '..',
                                    'index.html',
                                    'index.php',
                                    'login.php',
                                    'reload.php',
                                    'settings.php',
                                    'template.php',
                                    'logout.php',
                                    'message.php',
                                    'lost-password.php',
                                    'notes.php',
                                    'themes.php',
                                    'modules.php',
                                    'css',
                                    'scss',
                                    'fonts',
                                    'img',
                                    'js',
                                    'less'
                                );
                                foreach ($dir as $file) {
                                    if ((!in_array($file, $exclude)) && ($file[0] != '.')) {
                                        if ((!stristr($file, '-add')) && (!stristr($file, '-remote')) && (!stristr($file, '-update')) && (!stristr($file, 'inc-')) && (!stristr($file, '-cards'))) {
                                            $fileNameActual = str_replace('.php', '', $file);
                                            $fileName = str_replace('-', ' ', $fileNameActual);

                                            $fileNameShow = str_replace('_', ' ', $fileName);
                                            if (stristr($fileNameShow, 'faqs')) {
                                                $fileNameShow = 'FAQs';
                                            }
                                            $fileLink = str_replace('.php', $tableCardLink . PHP_EXTENSION.'/', $file);
                                            ?>    
                                            <li><a href="<?php echo ADMIN_URL . $fileLink; ?>" class="btn sideLink"><i class="fa fa-minus"></i> <?php echo ucwords($fileNameShow); ?></a></li>
                                            <?php
                                        }
                                    }
                                }
                                ?>         

                                <?php
                            }
                        }
                        ?>
                        <?php
                        if ($getSettings['sidebar_links'] == 0) {
                            if ($_SESSION[SESSION_PREFIX . 'user__ID'] != '') {
                                ?>

                                <h4>&nbsp;</h4>


                                <li><a href="<?php echo ADMIN_URL; ?>modules<?php echo PHP_EXTENSION;?>/" class="btn sideLink"><i class="fa fa-ellipsis-h pull-right"></i></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>

            </div>

            <!-- Sidebar navigation ends -->

        </div>
    </div>
<?php } else { ?>
    <style>
        .mainbar{
            margin-left:0px;
        }
    </style>
<?php } ?>