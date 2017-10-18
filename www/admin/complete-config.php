<?php
require_once '../../includes/session-functions.php';
secure_session('quiz_user');
require_once '../../includes/site-config.php';
require_once '../../includes/functions.php';
require_once '../../includes/db-config.php';
if (isset($_POST['uname']) && isset($_POST['pwd']) && isset($_POST['rpwd']) )
{
  $username = test_input($_POST['uname']);
  $pwd = test_input($_POST['pwd']);
  $rpwd = test_input($_POST['rpwd']);

  if($pwd==$rpwd)
  {
    if(true) //verify correct username
    {
      $ex = $conn->prepare("SELECT count(*) FROM admin WHERE user = :u");
				$ex->bindParam(':u',$username);
				$ex->execute();
				if($ex->fetchColumn()>0)
				{
					error_log("This user is already registered");
					echo "This mobile is already registered";
					$conn = null;
				}
        else
        {
          $options = ['cost' => 12];
					$hash = password_hash($pwd, PASSWORD_DEFAULT, $options);

          $stmt = $conn->prepare("INSERT INTO admin (user, password) VALUES (:u, :p)");
					$stmt->bindParam(':u',$username);
					$stmt->bindParam(':p',$hash);
          if($stmt->execute()==true)
          {
            echo "User Added.<a href='index.php'>Login Now</a>";
            unset($_SESSION['admin-config']);
          }
          else
          {
            echo "Some error occured";
          }
        }
    }
    else
    {
      echo "Incorrect username forward";
    }
  }
  else
  {
    echo "Password do not match";
  }
}
else
{

}

?>
