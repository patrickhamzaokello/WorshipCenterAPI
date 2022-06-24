<?php
$hostName = "localhost";
$userName = "rgxszumy_worshipcentre_user";
$password = "h12sxr3!h12sxr34Ht56xyz";
$databaseName = "rgxszumy_worshipcenter";
 $conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

