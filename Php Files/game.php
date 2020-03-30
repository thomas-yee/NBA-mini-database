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
                $sql = "SELECT * FROM game;";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result); //Check for a result above 0

                if ($resultCheck > 0) {
                    //Column headers
                    echo "<tr>";
                    echo "<th>Game Date</th>";
                    echo "<th>Start Time</th>";
                    echo "<th>Visitor Team</th>";
                    echo "<th>Visitor Points</th>";
                    echo "<th>Home Team</th>";
                    echo "<th>Home Points</th>";
                    echo "<th>Attendance</th>";
                    echo "<th>Arena Name</th>";
                    echo "</tr>";
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
