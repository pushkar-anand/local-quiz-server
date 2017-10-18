<?php
require_once '../includes/session-functions.php';
secure_session('quiz_user');
require_once '../includes/site-config.php';
require_once '../includes/functions.php';

$name = null;
$email = null;
$error = null;

if(isset($_POST['continue']))
{
  if ( isset($_POST['name']) && isset($_POST['email']) )
  {
    $name = test_input($_POST['name']);

    if (!preg_match("/^[a-zA-Z ]*$/",$name))
    {
      $error = "Only letters and white space allowed";
    }

    $email = test_input($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $error = "Invalid email format";
    }

    if($error==null)
    {
      $_SESSION['name']=$name;
      $_SESSION['email']=$email;

      $code = hashRandomCode(28);

      $url = "quiz.php?user=".$code;
      header('Location: '.$url);
    }
    else
    {
      echo $error.'<a href="/">. Go Back</a>';
    }

  }
  else
  {
    # code...
  }
}
else
{
$html = <<<HTML
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>$siteName</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css' />
  <link rel="stylesheet" href="css/style.css" />
  <meta name="theme-color" content="#5E2E91" />

</head>
<body>
<div class="app">
  <div class="content backgroud">
    <h1 class="head">$siteTitle</h1>
    <div class="error" id="error">$error</div>
    <div class="button">
      <div class="sign-up">Start</div>
      <form class="hidden form" name="regform" method="post" action="#" onsubmit="return validateForm()">
        <input type="text" placeholder="Name" name="name" value="$name" required autofocus pattern="[A-Za-z-0-9]+\s[A-Za-z-'0-9]+"  title="Firstname Lastname"/>
        <input type="email" placeholder="Email" name="email" value="$email" required/>
        <button class="hidden" type="submit" name="continue"><span class="text">Continue</span></button>
      </form>
    </div>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="js/index.js"></script>
<script>
function validateForm()
{
    var x = document.forms["regform"]["name"].value;
    if (x == "")
    {
      document.getElementById("error").innerHTML = "Name must be filled out";
        return false;
    }

    var x = document.forms["regform"]["email"].value;
    if (x == "")
    {
      document.getElementById("error").innerHTML = "Email must be filled out";
        return false;
    }
}
</script>
</body>
</html>
HTML;
}
echo $html;
?>
