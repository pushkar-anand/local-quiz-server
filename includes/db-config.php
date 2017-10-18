<?php
//database details
$servername = "localhost"; //database server
$username = "quiz_server_user"; //database username
$password = 'N2ZSgXk$zl#KwwvAnF4Mp0M%Q'; //database username's password
$database = "quiz_server_database"; //database name

$conn=null;
try
{
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e)
{
    error_log("Connection failed: " . $e->getMessage());
    echo "Database connection Failed";
    die();
}
?>
