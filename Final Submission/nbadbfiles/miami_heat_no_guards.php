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
                    <th><a href='miami_heat_no_guards.php?sort=firstName&order=<?php echo $asc_or_desc;?>'>First Name</a></th>
                    <th><a href='miami_heat_no_guards.php?sort=lastName&order=<?php echo $asc_or_desc;?>'>Last Name</a></th>
                    <th><a href='miami_heat_no_guards.php?sort=teamName&order=<?php echo $asc_or_desc;?>'>Team Name</a></th>
                    <th><a href='miami_heat_no_guards.php?sort=position&order=<?php echo $asc_or_desc;?>'>Position</a></th>
                    <th><a href='miami_heat_no_guards.php?sort=jerseyNo&order=<?php echo $asc_or_desc;?>'>Jersey No</a></th>
                    <th><a href='miami_heat_no_guards.php?sort=height&order=<?php echo $asc_or_desc;?>'>Height</a></th>
                    <th><a href='miami_heat_no_guards.php?sort=weight&order=<?php echo $asc_or_desc;?>'>Weight</a></th>
                    <th><a href='miami_heat_no_guards.php?sort=birthDate&order=<?php echo $asc_or_desc;?>'>Birth Date</a></th>
                    <th><a href='miami_heat_no_guards.php?sort=college&order=<?php echo $asc_or_desc;?>'>College</a></th>
                </tr>
            <?php
                //Original SQL query to show all stats
                $sql = "SELECT FirstName, LastName, TeamName, tableB.Position, tableB.JerseyNo, tableB.Height, tableB.Weight, tableB.BirthDate, tableB.College
                        FROM member as tableA
                        RIGHT OUTER JOIN (SELECT *
                                        FROM player
                                        WHERE NOT player.Position='G'
                                        ) as tableB
                        ON tableA.MemberID=tableB.MemberID
                        WHERE TeamName='Miami Heat'";
                
                //If a column is clicked, sort will be added to the query
                if (isset($_GET['sort'])) {
                    if ($_GET['sort'] == 'firstName') {
                        $sql .= " ORDER BY FirstName $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'lastName') {
                        $sql .= " ORDER BY LastName $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'teamName') {
                        $sql .= " ORDER BY TeamName $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'position') {
                        $sql .= " ORDER BY Position $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'jerseyNo') {
                        $sql .= " ORDER BY JerseyNo $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'height') {
                        $sql .= " ORDER BY Height $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'weight') {
                        $sql .= " ORDER BY Weight $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'birthDate') {
                        $sql .= " ORDER BY BirthDate $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'college') {
                        $sql .= " ORDER BY College $asc_or_desc";
                    }
                }
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result); //Check for a result above 0
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>". $row['FirstName'].
                        "</td><td>". $row['LastName'].
                        "</td><td>". $row['TeamName'].
                        "</td><td>". $row['Position'].
                        "</td><td>". $row['JerseyNo'].
                        "</td><td>". $row['Height'].
                        "</td><td>". $row['Weight'].
                        "</td><td>". $row['BirthDate'].
                        "</td><td>". $row['College'].
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
