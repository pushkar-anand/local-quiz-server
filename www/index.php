<?php
require_once '../includes/session-functions.php';
secure_session('quiz_user');
require_once '../includes/site-config.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="app">
  <div class="content backgroud">
    <h1 class="head">Title</h1>
    <div class="button">
      <div class="sign-up">Start</div>
      <form class="hidden form">
        <input type="text" placeholder="Name"/>
        <input type="email" placeholder="Email Id"/>
        <!--<input type="password" placeholder="Password"/>-->
        <button class="hidden"><span class="text">Continue</span></button>
      </form>
    </div>
  </div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="js/index.js"></script>
</body>
</html>
