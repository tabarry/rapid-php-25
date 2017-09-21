<?php include('includes/include.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php include('inc-head.php'); ?>
    </head>
    <body>
        <div id="wrapper">
            <!--HEADER-->
            <?php include('inc-header.php'); ?>
            <!--CONTENT-->
            <div id="content">
                <h2>Create Project</h2>
                <form id="form1" name="form1" method="post" action="create-project2.php" onsubmit="return validateProject();" target="remote">
                    <label>*Project Directory:</label>
                    <input type="text" name="directory" id="directory" value=""/>
                    <label>*Database Name:</label>
                    <input type="text" name="db" id="db" value=""/>
                    <label>*Database User:</label>
                    <input type="text" name="db_user" id="db_user" value=""/>
                    <label>Database Password:</label>
                    <input type="text" name="db_password" id="db_password" value=""/>

                    <label>Type 'DROP' below to drop previous database:</label>
                    <input type="text" name="db_drop" id="db_drop" value="" autocomplete="off"/>
                    <h3>Check below to drop any of the default tables</h3>

                    <p><a href="javascript:;" onclick="doCheck(1)">Check all</a> <a href="javascript:;" onclick="doCheck(0)">Uncheck all</a> </p>
                    <label>
                        <input type="checkbox" name="sulata_faqs" value="drop"/>
                        sulata_faqs                        </label>

                    <label>
                        <input type="checkbox" name="sulata_media_files" value="drop"/>
                        sulata_media_files                        </label>
                    <label>
                        <input type="checkbox" name="sulata_pages" value="drop"/>
                        sulata_pages                        </label>
                    <label>
                        <input type="checkbox" name="sulata_testimonials" value="drop"/>
                        sulata_testimonials                        </label>

                    <p>
                        <input type="submit" name="Submit" value="Create" />
                    </p>
                    <p id="result"></p>
                </form>
                <?php suIframe(); ?>
            </div>
            <!--FOOTER-->
            <?php include('inc-footer.php'); ?>
        </div>
    </body>
</html>
