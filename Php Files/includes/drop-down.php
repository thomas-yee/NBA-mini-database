<?php
//PERFORMS SELECT BASED ON DROP DOWN MENU
    include 'databaseHandler.php'; //Can use to grab variable $conn
    //Used to grab the variable from jQuery
    $teamName = $_POST['teamName'];
    //SQL Query
    $sql = "SELECT * FROM team_stats WHERE TeamName LIKE '$teamName%';";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result); //Check for a result above 0

    if ($resultCheck > 0) {
        //Prints the header of the table
        echo "<tr>";
        echo "<th>Team Name</th>";
        echo "<th>Season</th>";
        echo "<th>Rank</th>";
        echo "<th>Games Played</th>";
        echo "<th>FG%</th>";
        echo "<th>3P%</th>";
        echo "<th>FT%</th>";
        echo "</tr>";
        //$row is an array of all the data
        while ($row = mysqli_fetch_assoc($result)) {
            //Prints row
            echo "<tr><td>". $row['TeamName'] ."</td><td>". $row['Season']. "</td><td>
            ". $row['Rank'] ."</td><td>". $row['GamesPlayed']."</td><td>". $row['FG%']."</td><td>". $row['3P%']."</td><td>". $row['FT%']."</td></tr>";
        }
    }
    else{
        echo "ERROR";
    }
    $conn-> close();
?>