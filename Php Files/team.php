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
                        <li><a href="team.php">Teams</a></li>
                        <li><a href="game.php">Games</a></li>
                        <li><a href="a">Players</a></li>
                    </ul>
                </div>
            </nav>
        </header>
    <section class = "display-stats">
        <div id = "row">
            <table>
            <?php
                $sql = "SELECT * FROM team_stats;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result); //Check for a result above 0

                if ($resultCheck > 0) {
                    //Column headers
                    echo "<tr>";
                    echo "<th>Team Name</th>";
                    echo "<th>Season</th>";
                    echo "<th>Rank</th>";
                    echo "<th>Games Played</th>";
                    echo "<th>FG%</th>";
                    echo "<th>3P%</th>";
                    echo "<th>FT%</th>";
                    echo "<th>OREB</th>";
                    echo "<th>DREB</th>";
                    echo "<th>PPG</th>";
                    echo "<th>RPG</th>";
                    echo "<th>APG</th>";
                    echo "<th>TO</th>";
                    echo "<th>SPG</th>";
                    echo "<th>BPG</th>";
                    echo "<th>PF</th>";
                    echo "</tr>";
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
