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
                    <th><a href='team.php?sort=teamName&order=<?php echo $asc_or_desc;?>'>Team Name</a></th>
                    <th><a href='team.php?sort=season&order=<?php echo $asc_or_desc;?>'>Season</a></th>
                    <th><a href='team.php?sort=rank&order=<?php echo $asc_or_desc;?>'>Rank</a></th>
                    <th><a href='team.php?sort=gp&order=<?php echo $asc_or_desc;?>'>Games Played</a></th>
                    <th><a href='team.php?sort=fg%&order=<?php echo $asc_or_desc;?>'>FG%</a></th>
                    <th><a href='team.php?sort=3p%&order=<?php echo $asc_or_desc;?>'>3P%</a></th>
                    <th><a href='team.php?sort=ft%&order=<?php echo $asc_or_desc;?>'>FT%</a></th>
                    <th><a href='team.php?sort=oreb&order=<?php echo $asc_or_desc;?>'>OREB</a></th>
                    <th><a href='team.php?sort=dreb&order=<?php echo $asc_or_desc;?>'>DREB</a></th>
                    <th><a href='team.php?sort=ppg&order=<?php echo $asc_or_desc;?>'>PPG</a></th>
                    <th><a href='team.php?sort=rpg&order=<?php echo $asc_or_desc;?>'>RPG</a></th>
                    <th><a href='team.php?sort=apg&order=<?php echo $asc_or_desc;?>'>APG</a></th>
                    <th><a href='team.php?sort=to&order=<?php echo $asc_or_desc;?>'>TO</a></th>
                    <th><a href='team.php?sort=spg&order=<?php echo $asc_or_desc;?>'>SPG</a></th>
                    <th><a href='team.php?sort=bpg&order=<?php echo $asc_or_desc;?>'>BPG</a></th>
                    <th><a href='team.php?sort=pf&order=<?php echo $asc_or_desc;?>'>PF</a></th>
                </tr>
            <?php
                //Original SQL query to show all stats
                $sql = "SELECT * FROM team_stats\n";
                //If a column is clicked, sort will be added to the query
                if (isset($_GET['sort'])) {
                    if ($_GET['sort'] == 'teamName') {
                        $sql .= " ORDER BY TeamName $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'season') {
                        $sql .= " ORDER BY Season $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'rank') {
                        $sql .= " ORDER BY Rank $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'gp') {
                        $sql .= " ORDER BY GamesPlayed $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'fg%') {
                        $sql .= " ORDER BY `FG%` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == '3p%') {
                        $sql .= " ORDER BY `3P%` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'ft%') {
                        $sql .= " ORDER BY `FT%` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'oreb') {
                        $sql .= " ORDER BY OREB $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'dreb') {
                        $sql .= " ORDER BY DREB $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'ppg') {
                        $sql .= " ORDER BY PPG $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'rpg') {
                        $sql .= " ORDER BY RPG $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'apg') {
                        $sql .= " ORDER BY APG $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'to') {
                        $sql .= " ORDER BY `TO` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'spg') {
                        $sql .= " ORDER BY SPG $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'bpg') {
                        $sql .= " ORDER BY BPG $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'pf') {
                        $sql .= " ORDER BY PF $asc_or_desc";
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
