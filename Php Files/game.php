<?php
    include_once 'includes/databaseHandler.php'; //Can use to grab variable $conn
?>

<!DOCTYPE html>
<html>
    <head>
        <!--Link css file -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!--jQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>NBA Mini-Database</title>
    </head>
    <body>
        <header>
            <nav>
                <div class="row">
                    <img src="resources/nba-logo-png-transparent.png" alt="Nba Logo" class="logo">
                    <h1>NBA Mini-Database</h1>
                    <ul class="main-nav"> <!--ul means unordered list-->
                        <li><a href="nba.php">Home</a></li> <!--Links to home page-->
                        <li><a href="team.php">Teams</a></li> <!--Links to teams page-->
                        <li><a href="game.php">Games</a></li> <!--Links to games page-->
                        <li><a href="player.php">Players</a></li> <!--Links to players page-->
                    </ul>
                </div>
            </nav>
        </header>
    <section class = "display-stats">
        <div id = "row">
            <table>
            <!--Column headers-->
                <tr>
                <?php
                    //If order == DESC is true then use DESC otherwise use ASC
                    //Since order hasnt been set, it will default ASC
                    //After clicked, it will be set to DESC since statement is true
                    //isset() used to get rid of error
                    $sort_order = isset($_GET['order']) && $_GET['order'] == 'DESC' ? 'DESC' : 'ASC';
                    //if sort_order is ASC, it will set asc_or_desc to DESC
                    //After clicked, it will be sent to ASC since statement will be false
                    $asc_or_desc = $sort_order == 'ASC' ? 'DESC' : 'ASC';
                ?>
                    <!-- Column Links, when clicked, calls the same page but changes the
                    variable ?sort based on the column the user wants to sort by 
                    order variable set based on whether the column is sorted -->
                    <th><a href='game.php?sort=gameDate&order=<?php echo $asc_or_desc;?>'>Game Date</a></th>
                    <th><a href='game.php?sort=startTime&order=<?php echo $asc_or_desc;?>'>Start Time</a></th>
                    <th><a href='game.php?sort=visitorTeam&order=<?php echo $asc_or_desc;?>'>Visitor Team</a></th>
                    <th><a href='game.php?sort=visitorPoints&order=<?php echo $asc_or_desc;?>'>Visitor Points</a></th>
                    <th><a href='game.php?sort=homeTeam&order=<?php echo $asc_or_desc;?>'>Home Team</a></th>
                    <th><a href='game.php?sort=homePoints&order=<?php echo $asc_or_desc;?>'>Home Points</a></th>
                    <th><a href='game.php?sort=attendance&order=<?php echo $asc_or_desc;?>'>Attendance </a></th>
                    <th><a href='game.php?sort=arenaName&order=<?php echo $asc_or_desc;?>'>Arena Name</a></th>
                </tr>
            <?php
                //Original SQL query to show all stats
                $sql = "SELECT * FROM game\n";
                //If a column is clicked, sort will be added to the query
                if (isset($_GET['sort'])) {
                    if ($_GET['sort'] == 'gameDate') {
                        $sql .= " ORDER BY GameDate $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'startTime') {
                        $sql .= " ORDER BY GameStartET $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'visitorTeam') {
                        $sql .= " ORDER BY VisitorTeamName $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'visitorPoints') {
                        $sql .= " ORDER BY VisitorPoints $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'homeTeam') {
                        $sql .= " ORDER BY `HomeTeamName` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'homePoints') {
                        $sql .= " ORDER BY `HomePoints` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'attendance') {
                        $sql .= " ORDER BY `Attendance` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'arenaName') {
                        $sql .= " ORDER BY ArenaName $asc_or_desc";
                    }
                    
                }
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result); //Check for a result above 0

                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>". $row['GameDate'].
                        "</td><td>". $row['GameStartET']. 
                        "</td><td>". $row['VisitorTeamName'].
                        "</td><td>". $row['VisitorPoints'].
                        "</td><td>". $row['HomeTeamName'].
                        "</td><td>". $row['HomePoints'].
                        "</td><td>". $row['Attendance'].
                        "</td><td>". $row['ArenaName'].
                        "</td></tr>";
                    }
                }
                else {
                    echo "ERROR";
                }
                $conn-> close();
            ?>
            </table>
        </div>
    </section>
    </body>
</html>
