<?php
function secure_session($name)
{
  error_log("IN secure_session function");
    $session_name = $name;   // Set a custom session name
    $secure = false; //set it to true for https connections
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE)
    {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $currentCookieParams = session_get_cookie_params();

    /*session_set_cookie_params(
        $currentCookieParams["lifetime"],
        $currentCookieParams["path"],
        $currentCookieParams["domain"],
        $secure,
        $httponly
    );*/
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session
    session_regenerate_id();    // regenerated the session, delete the old one.
}
function destroy_secure_session()
{
  session_destroy();
}
?>
