<?php
    $sql = "SELECT * FROM arena LIMIT 2;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result); //Check for a result above 0

    if ($resultCheck > 0) {
        //$row is an array of all the data
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>". $row['ArenaName'] ."</td><td>". $row['CityState']. "</td><td>
            ". $row['ArenaCapacity'] ."</td></tr>";
        }
    }
    $conn-> close();
?>