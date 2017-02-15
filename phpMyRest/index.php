<?php

/*
 * phpMyRest is a PHP + MySQL RESTful API, developed by Sulata iSoft - www.sulata.com.pk
 * It has been kept as simple as possible to use and supports SQL input.
 * The only thing you need to change in the script is database configurations and API Key below.
 * The variables used are $_POST['do'],$_POST['sql'], $_POST['api_key'], $_POST['debug']
 * Creating date: January 19, 2016
 */

#############################################
#############################################
/* DATABASE CONFIGURATIONS */
define('DB_NAME', 'r24'); //Database name
define('DB_USER', 'root'); //Database user
define('DB_PASSWORD', 'root'); //Database password
define('DB_HOST', 'localhost'); //Database host, leave unchanged if in doubt
define('DB_PORT', '3306'); //Database port, leave unchanged if in doubt
/* API KEY */
define('API_KEY', 'uLMXrY4RWuVnWqf8LgkG4ptYXHt5vrEV'); //API Key, must be at least 32 characters
#############################################
#############################################

/* * * DO NOT EDIT BELOW THIS LINE * * */

/* SET/INCREASE SERVER TIMEOUT TIME */
set_time_limit(0);

/* ERROR REPORTING */
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

if (isset($_POST['debug'])) {
    $debug = strtolower($_POST['debug']);
    if (($debug == 'true') || (($debug == '1'))) {
        $debug = TRUE;
    } else {
        $debug = FALSE;
    }
} else {
    $debug = FALSE;
}


/* VARIABLES */
//API KEY
if (isset($_POST['api_key'])) {
    $apiKey = $_POST['api_key'];
} else {
    $apiKey = '';
}
//Action
if (isset($_POST['do'])) {
    $do = strtolower($_POST['do']);
} else {
    $do = '';
}
//SQL query
if (isset($_POST['sql'])) {
    $sql = $_POST['sql'];
} else {
    $sql = '';
}

$response = array(); //Error, result, record count, message

/* TEST CODE */
//$apiKey = 'aeiou12345';
//$do = 'select';
//$sql = "SELECT category__ID,category__Category FROM sulata_categories";
/* * *** */

/* ERROR MESSAGES */
define('INVALID_API_KEY', 'Invalid API Key.');
define('INVALID_API_KEY_LENGTH', 'The API Key must be at least 32 characters.');

/* CHECK AND VALIDATE API KEY */
if (strlen(API_KEY) < 32) {
    exit(INVALID_API_KEY_LENGTH);
}

if (!isset($apiKey) || ($apiKey != API_KEY)) {
    exit(INVALID_API_KEY);
} else {

    /* CONNECTION STRING */
    $cn = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);

    /* CONNECTION ERRORS */
    if ($debug == TRUE) {
        $response['connect_error'] = mysqli_connect_error();
        $response['connect_errno'] = mysqli_connect_errno();
    } else {
        $response['connect_errno'] = mysqli_connect_errno();
    }
    @mysqli_query($cn, "SET NAMES utf8");
    @mysqli_select_db($cn, DB_NAME);

    /* SELECT CODE */
    if ($do == 'select') {

        $result = @mysqli_query($cn, $sql);
        if ($debug == TRUE) {
            $response['error'] = @mysqli_error($cn);
            $response['errno'] = @mysqli_errno($cn);
        } else {
            $response['errno'] = @mysqli_errno($cn);
        }
        $response['num_rows'] = @mysqli_num_rows($result);

        //Return result
        while ($row = @mysqli_fetch_assoc($result)) {
            $response['result'][] = $row;
        }

        @mysqli_free_result($result);
    }
    /* INSERT CODE */
    if ($do == 'insert') {
        @mysqli_query($cn, $sql);
        if ($debug == TRUE) {
            $response['error'] = @mysqli_error($cn);
            $response['errno'] = @mysqli_errno($cn);
        } else {
            $response['errno'] = @mysqli_errno($cn);
        }
        //Get duplicate errors
        if (@mysqli_errno($cn) == 1062) {
            $response['errno'] = @mysqli_errno($cn);
        }
        //Get insert ID
        $response['insert_id'] = @mysqli_insert_id($cn);
    }
    /* UPDATE CODE */
    if ($do == 'update') {
        @mysqli_query($cn, $sql);
        if ($debug == TRUE) {
            $response['error'] = @mysqli_error($cn);
            $response['errno'] = @mysqli_errno($cn);
        } else {
            $response['errno'] = @mysqli_errno($cn);
        }
        //Get duplicate errors
        if (@mysqli_errno($cn) == 1062) {
            $response['errno'] = @mysqli_errno($cn);
        }
        //Get affected rows
        $response['affected_rows'] = @mysqli_affected_rows($cn);
    }
    /* DELETE CODE */
    if ($do == 'delete') {
        @mysqli_query($cn, $sql);
        if ($debug == TRUE) {
            $response['error'] = @mysqli_error($cn);
            $response['errno'] = @mysqli_errno($cn);
        } else {
            $response['errno'] = @mysqli_errno($cn);
        }
        $response['affected_rows'] = @mysqli_affected_rows($cn);
    }

    /* OUTPUT JSON */
    header('Content-Type: application/json');
    echo json_encode($response);
}
