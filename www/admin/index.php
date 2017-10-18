<?php
require_once '../../includes/session-functions.php';
secure_session('quiz_user');
require_once '../../includes/site-config.php';
require_once '../../includes/functions.php';
require_once '../../includes/db-config.php';
$stmt = $conn->prepare('SELECT count(*) FROM admin');
$stmt->execute();
if ( !($stmt->fetchColumn() > 0) )
{
  //no admin user found
  $code = RandomCode(10);
  $_SESSION['admin-config'] = $code;
  $url="admin-config.php?access=".$code;
  header('Location: '.$url);
  exit();
}
else
{
?>
<form name="admin" method="post" action="#" >
  <input type="text" placeholder="Name" name="name" value="" required autofocus pattern="[A-Za-z-0-9]+\s[A-Za-z-'0-9]+"  title="Firstname Lastname"/>
  <input type="email" placeholder="Email" name="email" value="" required/>
  <button class="hidden" type="submit" name="continue"><span class="text">Continue</span></button>
</form>
<?php
}
?>
