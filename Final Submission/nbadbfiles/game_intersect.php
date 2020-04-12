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
        <!-- Used when the user selects a team from the drop down menu
        <script>
            $(document).ready(function() {
                // Changes the drop down menu to the most recent selection
                var teamName = localStorage.getItem("Team");
                if(teamName != null) {
                        $("select").val(teamName);
                }
                // Notification of when team is selected
                $("select").change(function() {
                    var teamName = $(this).val();
                    // Sets local storage to the selection made
                    localStorage.setItem("Team", $(this).val())
                    $.ajax({
                        url : "includes/drop-down-team.php", // The file where you want to reach with the ajax call
                        method : "POST", // POST so it doesn't explicitly show up in the url
                        data : { teamName : teamName }, // Data to submit
                        success : function(data) { // What to do in the case of success
                            // #row - where the data will be shown
                            $('#row').html(data);
                        }
                    })
                })
            });
        </script> -->
        <title>NBA Mini-Database</title>
    </head>
    <body>
    <header>
        <nav>
            <div class="row">
                    <ul class="main-nav"> <!--ul means unordered list-->
                        <li><a href="nba.php">Home</a></li> <!--Links to home page-->
                        <li><a href="inner_join_on.php">Height Search<br>(Inner Join)</a></li> <!-- Demonstrates Inner Join -->
                        <li><a href="left_outer_join.php">Team Schedule Search<br>(Left Outer Join)</a></li> <!-- Demonstrates Left Outer Join -->
                        <li><a href="union_all.php">Team Shooting Search<br>(Union All)</a></li> <!-- Demonstrates Union All -->
                        <li><a href="team.php">Teams<br>(Select)</a></li> <!-- Demonstrates Select -->
                    </ul>
                </div>
                <div class="row">
                    <ul class="main-nav"> <!--ul means unordered list-->
                        <li><a href="game.php">Games<br>(Full Outer Join)</a></li> <!-- Demonstrates Full Outer Join (via Left & Right Join) -->
                        <li><a href="game_intersect.php">Home Dominators<br>(Intersect)</a></li> <!-- Demonstrates Intersect-->
                        <li><a href="miami_heat_no_guards.php">Miami Heat<br>(Minus)</a></li> <!-- Demonstrates Minus (i.e. Right Outer Join) -->
                        <li><a href="player.php">Player Stats<br>(Right Join & Natural Join)</a></li> <!-- Demonstrates Right Join & Natural Join-->
                        <li><a href="playerInformation.php">Player Information<br>(Right Outer Join)</a></li> <!-- Demonstrates Right Outer Join -->
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
                    <!-- <?php
                        // //If order == DESC is true then use DESC otherwise use ASC
                        // //Since order hasn't been set, it will default ASC
                        // //After clicked, it will be set to DESC since statement is true
                        // //isset() used to get rid of error
                        // $sort_order = isset($_GET['order']) && $_GET['order'] == 'DESC' ? 'DESC' : 'ASC';
                        // //if sort_order is ASC, it will set asc_or_desc to DESC
                        // //After clicked, it will be sent to ASC since statement will be false
                        // $asc_or_desc = $sort_order == 'ASC' ? 'DESC' : 'ASC';
                        // // Get the team name when column is clicked from url
                        // if(isset($_GET['teamName'])) {
                        //     $teamName = $_GET['teamName'];
                        // }
                        // else {
                        //     // When page is initialized, teamName will be blank so all the players will be listed
                        //     $teamName = "";
                        // }
                    ?> -->
                    <!-- Column Links, when clicked, calls the same page but changes the
                    variable ?sort based on the column the user wants to sort by 
                    order variable set based on whether the column is sorted -->
                    <th><a href='game_intersect.php?sort=gameDate&order=<?php echo $asc_or_desc;?>'>Game Date</a></th>
                    <th><a href='game_intersect.php?sort=gameStartET&order=<?php echo $asc_or_desc;?>'>Game Start</a></th>
                    <th><a href='game_intersect.php?sort=visitorTeamName&order=<?php echo $asc_or_desc;?>'>Visitor Team Name</a></th>
                    <th><a href='game_intersect.php?sort=visitorPoints&order=<?php echo $asc_or_desc;?>'>Visitor Points</a></th>
                    <th><a href='game_intersect.php?sort=homeTeamName&order=<?php echo $asc_or_desc;?>'>Home Team Name</a></th>
                    <th><a href='game_intersect.php?sort=homePoints&order=<?php echo $asc_or_desc;?>'>Home Points</a></th>
                    <th><a href='game_intersect.php?sort=overtime&order=<?php echo $asc_or_desc;?>'>Overtime</a></th>
                    <th><a href='game_intersect.php?sort=attendance&order=<?php echo $asc_or_desc;?>'>Attendance</a></th>
                    <th><a href='game_intersect.php?sort=arenaName&order=<?php echo $asc_or_desc;?>'>Arena Name</a></th>
                </tr>
            <?php
                //Original SQL query to show all stats
                $sql = "SELECT tableA.GameDate, tableA.GameStartET, tableA.VisitorTeamName, tableA.VisitorPoints, tableA.HomeTeamName, tableA.HomePoints, tableA.Overtime, tableA.Attendance, tableA.ArenaName
                        FROM game as tableA
                        INNER JOIN (SELECT *
                                    FROM game
                                    WHERE HomePoints>=100) as tableB
                        ON tableA.GameDate=tableB.GameDate AND tableA.HomeTeamName=tableB.HomeTeamName
                        WHERE tableA.VisitorPoints<=80";
                
                //If a column is clicked, sort will be added to the query
                if (isset($_GET['sort'])) {
                    if ($_GET['sort'] == 'gameDate') {
                        $sql .= " ORDER BY GameDate $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'gameStartET') {
                        $sql .= " ORDER BY GameStartET $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'visitorTeamName') {
                        $sql .= " ORDER BY VisitorTeamName $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'visitorPoints') {
                        $sql .= " ORDER BY VisitorPoints $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'homeTeamName') {
                        $sql .= " ORDER BY HomeTeamName $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'homePoints') {
                        $sql .= " ORDER BY HomePoints $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'overtime') {
                        $sql .= " ORDER BY Overtime $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'attendance') {
                        $sql .= " ORDER BY Attendance $asc_or_desc";
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
                        "</td><td>". $row['Overtime'].
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
