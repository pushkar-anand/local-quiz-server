<?php
require_once '../includes/session-functions.php';
secure_session('quiz_user');
require_once '../includes/site-config.php';
require_once '../includes/functions.php';

if (isset($_GET['user']))
{
  if ( isset($_SESSION['name']) && isset($_SESSION['email']) )
  {
    $user = test_input($_GET['user']);
    $name = test_input($_SESSION['name']);
    $email = test_input($_SESSION['email']);

  }
  else
  {
    header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
  }
}
else
{
  header($_SERVER["SERVER_PROTOCOL"]." 400 Bad Request");
}

?>
