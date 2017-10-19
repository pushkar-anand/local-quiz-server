<?php
require_once '../../includes/session-functions.php';
secure_session('quiz_user');
require_once '../../includes/site-config.php';
require_once '../../includes/functions.php';
require_once '../../includes/db-config.php';
if(isset($_POST['login']))
{
  if( isset($_POST['user']) && isset($_POST['pwd']) )
  {
    $username = test_input($_POST['user']);
    $pwd = test_input($_POST['pwd']);

    $sel = $conn->prepare("SELECT count(*) FROM admin WHERE user = :u");
    $sel->bindParam(':u',$username);
    $sel->execute();
    if($sel->fetchColumn()>0)
    {
      $sel = $conn->prepare("SELECT * FROM admin WHERE user = :u");
      $sel->bindParam(':u',$username);
      $sel->execute();
      $result = $sel->fetch(PDO::FETCH_ASSOC);
      $password = $result["password"];
      var_dump($password);
      $id = $result["id"];
      if( password_verify ($pwd, $password) == true )
      {
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $user_id = preg_replace("/[^0-9]+/", "", $id);

        $login_hash = hash('sha512',$user_browser.$password.$user_ip);

        $_SESSION['admin']=true;
        $_SESSION['login_hash'] = $login_hash;
		 		$_SESSION['user'] = $id;
        $_SESSION['admin-name'] = $username;
        header('Location: dashboard.php');
        exit();
      }
      else
      {
        echo "Incorrect Password";
      }
    }
    else
    {
      echo "No such user";
    }
  }
  else
  {
    echo "Complete the form";
  }
}
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
  <input type="text" placeholder="Username" name="user" value="" required autofocus pattern="[A-Za-z-0-9]+"  title="usename"/>
  <input type="password" placeholder="Password" name="pwd" value="" required/>
  <button type="submit" name="login"><span class="text">Continue</span></button>
</form>
<?php
}
?>
