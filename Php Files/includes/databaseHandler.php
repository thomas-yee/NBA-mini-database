

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "nba";

//Create the connection
$conn = mysqli_connect($servername, $username, $password, $dbName);

//Check connection
if ($conn -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//if it is connected successfully --> website will show up
//echo "Connected successfully";
?>