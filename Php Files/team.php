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
                        <li><a href="team.php">Teams</a></li> <!--Links to team page-->
                        <li><a href="game.php">Games</a></li> <!--Links to game page-->
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
                    <!-- Column Links, when clicked, calls the same page but changes the
                    variable ?sort based on the column the user wants to sort by -->
                    <th><a href='team.php?sort=teamName'>Team Name</a></th>
                    <th><a href='team.php?sort=season'>Season</a></th>
                    <th><a href='team.php?sort=rank'>Rank</a></th>
                    <th><a href='team.php?sort=gp'>Games Played</a></th>
                    <th><a href='team.php?sort=fg%'>FG%</a></th>
                    <th><a href='team.php?sort=3p%'>3P%</a></th>
                    <th><a href='team.php?sort=ft%'>FT%</a></th>
                    <th><a href='team.php?sort=oreb'>OREB</a></th>
                    <th><a href='team.php?sort=dreb'>DREB</a></th>
                    <th><a href='team.php?sort=ppg'>PPG</a></th>
                    <th><a href='team.php?sort=rpg'>RPG</a></th>
                    <th><a href='team.php?sort=apg'>APG</a></th>
                    <th><a href='team.php?sort=to'>TO</a></th>
                    <th><a href='team.php?sort=spg'>SPG</a></th>
                    <th><a href='team.php?sort=bpg'>BPG</a></th>
                    <th><a href='team.php?sort=pf'>PF</a></th>
                    </tr>
            <?php
                //Original SQL query to show all stats
                $sql = "SELECT * FROM team_stats\n";
                //If a column is clicked, sort will be added to the query
                if (isset($_GET['sort']) == 'teamName') {
                    if ($_GET['sort'] == 'teamName') {
                        $sql .= " ORDER BY TeamName";
                    }
                    elseif ($_GET['sort'] == 'season') {
                        $sql .= " ORDER BY Season";
                    }
                    elseif ($_GET['sort'] == 'rank') {
                        $sql .= " ORDER BY Rank";
                    }
                    elseif ($_GET['sort'] == 'gp') {
                        $sql .= " ORDER BY GamesPlayed";
                    }
                    elseif ($_GET['sort'] == 'fg%') {
                        $sql .= " ORDER BY `FG%` DESC";
                    }
                    elseif ($_GET['sort'] == '3p%') {
                        $sql .= " ORDER BY `3P%` DESC";
                    }
                    elseif ($_GET['sort'] == 'ft%') {
                        $sql .= " ORDER BY `FT%` DESC";
                    }
                    elseif ($_GET['sort'] == 'oreb') {
                        $sql .= " ORDER BY OREB";
                    }
                    elseif ($_GET['sort'] == 'dreb') {
                        $sql .= " ORDER BY DREB";
                    }
                    elseif ($_GET['sort'] == 'ppg') {
                        $sql .= " ORDER BY PPG";
                    }
                    elseif ($_GET['sort'] == 'rpg') {
                        $sql .= " ORDER BY RPG";
                    }
                    elseif ($_GET['sort'] == 'apg') {
                        $sql .= " ORDER BY APG";
                    }
                    elseif ($_GET['sort'] == 'to') {
                        $sql .= " ORDER BY `TO` DESC";
                    }
                    elseif ($_GET['sort'] == 'spg') {
                        $sql .= " ORDER BY SPG";
                    }
                    elseif ($_GET['sort'] == 'bpg') {
                        $sql .= " ORDER BY BPG";
                    }
                    elseif ($_GET['sort'] == 'pf') {
                        $sql .= " ORDER BY PF";
                    }
                }
            
                //Prints the results
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result); //Check for a result above 0
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>". $row['TeamName'].
                        "</td><td>". $row['Season']. 
                        "</td><td>". $row['Rank'].
                        "</td><td>". $row['GamesPlayed'].
                        "</td><td>". $row['FG%'].
                        "</td><td>". $row['3P%'].
                        "</td><td>". $row['FT%'].
                        "</td><td>". $row['OREB'].
                        "</td><td>". $row['DREB'].
                        "</td><td>". $row['PPG'].
                        "</td><td>". $row['RPG'].
                        "</td><td>". $row['APG'].
                        "</td><td>". $row['TO'].
                        "</td><td>". $row['SPG'].
                        "</td><td>". $row['BPG'].
                        "</td><td>". $row['PF'].
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
