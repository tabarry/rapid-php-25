<?php if ($_SESSION[SESSION_PREFIX . 'user__ID'] != '') { ?>
    <div class="head-user dropdown pull-right">
        <a href="#" data-toggle="dropdown" id="profile">
            <!-- Icon 
            <i class="fa fa-user"></i>  -->
            <?php
            if ((isset($_SESSION[SESSION_PREFIX . 'user__Picture']) && $_SESSION[SESSION_PREFIX . 'user__Picture'] != '') && (file_exists(ADMIN_UPLOAD_PATH . $_SESSION[SESSION_PREFIX . 'user__Picture']))) {
                $userImage = BASE_URL . 'files/' . $_SESSION[SESSION_PREFIX . 'user__Picture'];
            } else {
                $userImage = BASE_URL . 'files/default-user.png';
            }
            ?>
            <img src="<?php echo $userImage; ?>" alt="" class="img-responsive img-circle"/>

            <!-- User name -->
            <?php echo $_SESSION[SESSION_PREFIX . 'user__Name']; ?> 
            <i class="fa fa-caret-down"></i> 
        </a>
        <!-- Dropdown -->
        <ul class="dropdown-menu" aria-labelledby="profile">
            <li><a href="<?php echo ADMIN_URL; ?>users-update<?php echo PHP_EXTENSION;?>/"><i class="fa fa-user"></i> Update Profile</a></li>
            <li><a href="<?php echo ADMIN_URL; ?>settings<?php echo $tableCardLink; ?><?php echo PHP_EXTENSION;?>/"><i class="fa fa-cogs"></i> Change Settings</a></li>
            <li><a href="<?php echo ADMIN_URL; ?>login<?php echo PHP_EXTENSION;?>/?do=logout" target="remote"><i class="fa fa-power-off"></i> Log Out</a></li>
        </ul>
    </div>
<?php } ?>