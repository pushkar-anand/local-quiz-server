<?php
require_once '../../includes/session-functions.php';
secure_session('quiz_user');
require_once '../../includes/site-config.php';
require_once '../../includes/functions.php';
require_once '../../includes/db-config.php';
var_dump($_SESSION);
?>
