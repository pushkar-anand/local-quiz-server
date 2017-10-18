<?php
function test_input(string $data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function RandomCode(int $length)
{
    // Create connection
    //$conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    /*if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }*/

    $characters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789';
    $string = '';
    for ($i = 0; $i <$length; $i++)
    {
          $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $string;
}
?>
