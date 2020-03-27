<?php
    include 'databaseHandler.php'; //Can use to grab variable $conn
    
    $teamName = $_POST['teamName'];

    $sql = "SELECT * FROM arena WHERE TeamName = $teamName;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result); //Check for a result above 0

    if ($resultCheck > 0) {
        //$row is an array of all the data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>". $row['TeamName'] ."</td><td>". $row['Conference']. "</td><td>
            ". $row['Division'] ."</td></tr>";
        }
    }
    $conn-> close();
?>