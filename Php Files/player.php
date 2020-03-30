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
                        <li><a href="player.php">Players</a></li>
                    </ul>
                </div>
            </nav>
        </header>
    <section class = "display-stats">
        <div id = "row">
            <table>
            <?php
                $sql = "SELECT * FROM player_stats;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result); //Check for a result above 0

                if ($resultCheck > 0) {
                    //Column headers
                    echo "<tr>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Season</th>";
                    echo "<th>Games Played</th>";
                    echo "<th>Games Started</th>";
                    echo "<th>MIN</th>";
                    echo "<th>FG</th>";
                    echo "<th>FG%</th>";
                    echo "<th>3PT</th>";
                    echo "<th>3PT%</th>";
                    echo "<th>FT</th>";
                    echo "<th>FT%</th>";
                    echo "<th>OR</th>";
                    echo "<th>DR</th>";
                    echo "<th>REB</th>";
                    echo "<th>AST</th>";
                    echo "<th>BLK</th>";
                    echo "<th>STL</th>";
                    echo "<th>PF</th>";
                    echo "<th>TO</th>";
                    echo "<th>PPG</th>";
                    echo "</tr>";
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
