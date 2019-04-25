//Connection with MySQL Database

<?php
$MyUsername = "root";  // mysql username
$MyPassword = "";  // mysql password
$MyHostname = "localhost";      // Your Host
$Database = "arduinodb";    // Name of your database
$con = mysqli_connect($MyHostname , $MyUsername, $MyPassword, $Database);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

