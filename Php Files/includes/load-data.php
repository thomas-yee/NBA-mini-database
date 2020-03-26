<?php
    include 'databaseHandler.php'; //Can use to grab variable $conn

    $tableNewCount = $_POST['tableNewCount'];

    $sql = "SELECT * FROM arena LIMIT $tableNewCount;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result); //Check for a result above 0

    if ($resultCheck > 0) {
        //$row is an array of all the data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>". $row['ArenaName'] ."</td><td>". $row['CityState']. "</td><td>
            ". $row['ArenaCapacity'] ."</td></tr>";
        }
    }
    else {
        echo "ERROR";
    }
    $conn-> close();
?>