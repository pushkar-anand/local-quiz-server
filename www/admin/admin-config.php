<?php
require_once '../../includes/session-functions.php';
secure_session('quiz_user');
require_once '../../includes/site-config.php';
require_once '../../includes/functions.php';
require_once '../../includes/db-config.php';
if ( isset($_GET['access']) )
{
  if( $_GET['access'] == $_SESSION['admin-config'])
  {
    $html = <<<HTML
    <h1>Add an admin info</h2>
    <form name="admin-reg" method="post" action="complete-config.php" >
      <input type="text" placeholder="username" name="uname" value="" required autofocus pattern="[A-Za-z-0-9]+"  title="username"/>
      <input type="password" placeholder="Password" name="pwd" value="" required/>
      <input type="password" placeholder="Retype Password" name="rpwd" value="" required/>
      <button type="submit" name="continue"><span class="text">Continue</span></button>
    </form>
HTML;
echo $html;
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
