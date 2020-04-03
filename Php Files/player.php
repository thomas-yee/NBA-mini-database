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
                    <ul class="main-nav"> <!--ul means unordered list-->
                        <li><a href="nba.php">Home</a></li> <!--Links to home page-->
                        <li><a href="team.php">Teams</a></li>
                        <li><a href="game.php">Games</a></li>
                        <li><a href="player.php">Player Stats</a></li> <!--Links to players page-->
                        <li><a href="playerInformation.php">Player Information</a></li> <!--Links to players information page -->
                    </ul>
                </div>
                <div class = "header-row">
                    <img src="resources/nba-logo-png-transparent.png" alt="Nba Logo" class="logo">
                    <h1>NBA Mini-Database</h1>
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
                    <th><a href='player.php?sort=firstName&order=<?php echo $asc_or_desc;?>'>First Name</a></th>
                    <th><a href='player.php?sort=lastName&order=<?php echo $asc_or_desc;?>'>Last Name</a></th>
                    <th><a href='player.php?sort=season&order=<?php echo $asc_or_desc;?>'>Season</a></th>
                    <th><a href='player.php?sort=gamesPlayed&order=<?php echo $asc_or_desc;?>'>Games Played</a></th>
                    <th><a href='player.php?sort=gamesStarted&order=<?php echo $asc_or_desc;?>'>Games Started</a></th>
                    <th><a href='player.php?sort=min&order=<?php echo $asc_or_desc;?>'>MIN</a></th>
                    <th><a href='player.php?sort=fg&order=<?php echo $asc_or_desc;?>'>FG</a></th>
                    <th><a href='player.php?sort=fg%&order=<?php echo $asc_or_desc;?>'>FG%</a></th>
                    <th><a href='player.php?sort=3pt&order=<?php echo $asc_or_desc;?>'>3PT</a></th>
                    <th><a href='player.php?sort=3pt%&order=<?php echo $asc_or_desc;?>'>3PT%</a></th>
                    <th><a href='player.php?sort=ft&order=<?php echo $asc_or_desc;?>'>FT</a></th>
                    <th><a href='player.php?sort=ft%&order=<?php echo $asc_or_desc;?>'>FT%</a></th>
                    <th><a href='player.php?sort=or&order=<?php echo $asc_or_desc;?>'>OR</a></th>
                    <th><a href='player.php?sort=dr&order=<?php echo $asc_or_desc;?>'>DR</a></th>
                    <th><a href='player.php?sort=reb&order=<?php echo $asc_or_desc;?>'>REB</a></th>
                    <th><a href='player.php?sort=ast&order=<?php echo $asc_or_desc;?>'>AST</a></th>
                    <th><a href='player.php?sort=blk&order=<?php echo $asc_or_desc;?>'>BLK</a></th>
                    <th><a href='player.php?sort=stl&order=<?php echo $asc_or_desc;?>'>STL</a></th>
                    <th><a href='player.php?sort=pf&order=<?php echo $asc_or_desc;?>'>PF</a></th>
                    <th><a href='player.php?sort=to&order=<?php echo $asc_or_desc;?>'>TO</a></th>
                    <th><a href='player.php?sort=ppg&order=<?php echo $asc_or_desc;?>'>PPG</a></th>
                </tr>
            <?php
                //Original SQL query to show all stats
                $sql = "SELECT * FROM player_stats\n";
                //If a column is clicked, sort will be added to the query
                if (isset($_GET['sort'])) {
                    if ($_GET['sort'] == 'firstName') {
                        $sql .= " ORDER BY FirstName $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'lastName') {
                        $sql .= " ORDER BY LastName $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'season') {
                        $sql .= " ORDER BY Season $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'gamesPlayed') {
                        $sql .= " ORDER BY GP $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'gamesStarted') {
                        $sql .= " ORDER BY GS $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'min') {
                        $sql .= " ORDER BY MIN $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'fg') {
                        $sql .= " ORDER BY FG $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'fg%') {
                        $sql .= " ORDER BY `FG%` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == '3pt') {
                        $sql .= " ORDER BY 3PT $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == '3pt%') {
                        $sql .= " ORDER BY `3P%` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'ft') {
                        $sql .= " ORDER BY FT $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'ft%') {
                        $sql .= " ORDER BY `FT%` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'or') {
                        $sql .= " ORDER BY `OR` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'dr') {
                        $sql .= " ORDER BY DR $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'reb') {
                        $sql .= " ORDER BY REB $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'ast') {
                        $sql .= " ORDER BY AST $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'blk') {
                        $sql .= " ORDER BY BLK $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'stl') {
                        $sql .= " ORDER BY STL $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'pf') {
                        $sql .= " ORDER BY PF $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'to') {
                        $sql .= " ORDER BY `TO` $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'ppg') {
                        $sql .= " ORDER BY PPG $asc_or_desc";
                    }
                }
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result); //Check for a result above 0
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>". $row['FirstName'].
                        "</td><td>". $row['LastName']. 
                        "</td><td>". $row['Season'].
                        "</td><td>". $row['GP'].
                        "</td><td>". $row['GS'].
                        "</td><td>". $row['MIN'].
                        "</td><td>". $row['FG'].
                        "</td><td>". $row['FG%'].
                        "</td><td>". $row['3PT'].
                        "</td><td>". $row['3P%'].
                        "</td><td>". $row['FT'].
                        "</td><td>". $row['FT%'].
                        "</td><td>". $row['OR'].
                        "</td><td>". $row['DR'].
                        "</td><td>". $row['REB'].
                        "</td><td>". $row['AST'].
                        "</td><td>". $row['BLK'].
                        "</td><td>". $row['STL'].
                        "</td><td>". $row['PF'].
                        "</td><td>". $row['TO'].
                        "</td><td>". $row['PPG'].
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
