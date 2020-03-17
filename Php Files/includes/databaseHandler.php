<?php
$servername = "localhost";
$username = "root";
$password = "";

//Create the connection
$conn = new mysqli($servername, $username, $password);

//Check connection
if ($conn -> connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//if it is connected successfully --> website will show up
//echo "Connected successfully";
?>