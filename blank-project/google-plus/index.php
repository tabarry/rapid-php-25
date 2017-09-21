<?php
include('../sulata/includes/config.php');
include('../sulata/includes/functions.php');
include('../sulata/includes/connection.php');
include('../sulata/includes/get-settings.php');

//Unset login sessions
$_SESSION[SESSION_PREFIX . 'user__ID'] = '';
$_SESSION[SESSION_PREFIX . 'user__Name'] = '';
$_SESSION[SESSION_PREFIX . 'user__Email'] = '';
$_SESSION[SESSION_PREFIX . 'user__Picture'] = '';
$_SESSION[SESSION_PREFIX . 'user__Status'] = '';
$_SESSION[SESSION_PREFIX . 'user__Theme'] = '';
?>
<html>

    <head>
        <title>Sign in with Google</title>
        <!-- Include the API client and Google+ client. -->
        <script src = "https://plus.google.com/js/client:plusone.js"></script>
        <style type="text/css">
            body{font-family: "Trebuchet MS",Verdana,Tahoma,Arial;text-align:center;}
            a{color:#333;}
        </style>
        <script type="text/javascript">
            function post(path, params, method) {
                method = method || "post"; // Set method to post by default if not specified.

                // The rest of this code assumes you are not using a library.
                // It can be made less wordy if you use one.
                var form = document.createElement("form");
                form.setAttribute("method", method);
                form.setAttribute("action", path);

                for (var key in params) {
                    if (params.hasOwnProperty(key)) {
                        var hiddenField = document.createElement("input");
                        hiddenField.setAttribute("type", "hidden");
                        hiddenField.setAttribute("name", key);
                        hiddenField.setAttribute("value", params[key]);

                        form.appendChild(hiddenField);
                    }
                }

                document.body.appendChild(form);
                form.submit();
            }
        </script>
    </head>

    <body>
        <!-- Container with the Sign-In button. -->
        <h1><?php echo $getSettings['site_name']; ?></h1>
        <div id="gConnect" class="button">
            <button class="g-signin"
                    data-scope="email"
                    data-clientid="762760263103-gjbte5t2gm491a049sn0f0p2rlf7t6fk.apps.googleusercontent.com"
                    data-callback="onSignInCallback"
                    data-theme="dark"
                    data-cookiepolicy="single_host_origin">
            </button>
            <p><small><a href="<?php echo BASE_URL ?>">Site Home</a></small></p>
        </div>
    </body>

    <script type="text/javascript">
        /**
         * Handler for the signin callback triggered after the user selects an account.
         */
        function onSignInCallback(resp) {
            gapi.client.load('plus', 'v1', apiClientLoaded);
        }

        /**
         * Sets up an API call after the Google API client loads.
         */
        function apiClientLoaded() {
            gapi.client.plus.people.get({userId: 'me'}).execute(handleEmailResponse);
        }

        /**
         * Response callback for when the API client receives a response.
         *
         * @param resp The API response object with the user email and profile information.
         */
        function handleEmailResponse(resp) {

            var primaryEmail;
            for (var i = 0; i < resp.emails.length; i++) {
                if (resp.emails[i].type === 'account')
                    primaryEmail = resp.emails[i].value;
            }
            // setcookie('cook_google_email',primaryEmail);
            //window.location.href = '<?php echo BASE_URL; ?>google-plus/login.php?email=' + primaryEmail;
            post('<?php echo BASE_URL; ?>google-plus/login.php', {email: primaryEmail});

            //document.writeln("<html><head>Google Log In</head><body><form name='suForm' action='login.php'><input type='hidden1' name='email' value='"+primaryEmail+"'/><input type='submit' value='Log In'/></form></body></html>");
            //document.suForm.submit();
            /*document.getElementById('responseContainer').value = 'Primary email: ' +
             primaryEmail + '\n\nFull Response:\n' + JSON.stringify(resp);*/
        }

    </script>

</html>
