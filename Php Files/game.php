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
        <script>
        //Used when user selects a team from the drop down menu
        $(document).ready(function() {
                //notification of when team is selected
                //Changes the drop down menu to the most recent selection
                var stadiumName = localStorage.getItem("Arena");
                if (stadiumName != null) {
                    $("select").val(stadiumName);
                }
                $("select").change(function() {
                    var stadiumName = $(this).val();
                    //sets local storage to the selection made
                    localStorage.setItem("Arena", $(this).val())
                    $.ajax({
                        url:"includes/drop-down-stadium.php", //the file where you want to reach with the Ajax call
                        method:"POST", //sends POST request
                        data:{stadiumName:stadiumName}, //data to submit 
                        success:function(data) { // What to do in the case of success
                            //#row - where the data will be shown
                            $('#row').html(data);
                        }
                    })
                })
            });
        </script>
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
    <section class = "display-games-stadium">
        <div class = "row">
            Arena List:             
            <select name ="Arena" id="Arena">
                <?php
                    //Displays Select a Team in the drop down menu
                    echo "<option value=''>Select an Arena</option>";
                    //Used to display teams in the drop down menu alphabetically
                     $sql = "SELECT DISTINCT ArenaName FROM game ORDER BY ArenaName;";
                     $result = mysqli_query($conn, $sql);
                     $resultCheck = mysqli_num_rows($result); //Check for a result above 0
 
                     if ($resultCheck > 0) {
                         //$row is an array of all the data
                         while ($row = mysqli_fetch_assoc($result)) {
                             //Adds the teams to the drop down menu
                             echo "<option value=".$row['ArenaName'].">".$row['ArenaName']."</option>";
                         }
                     }
                ?>
            </select>
        </div>
    </section>
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
                    //Get the stadium name when column is clicked from url
                    if (isset($_GET['stadiumName'])) {
                        $stadiumName = $_GET['stadiumName'];
                    }
                    else {
                        //When page is initialized, stadiumName will be blank so all the games will be listed
                        $stadiumName = "";
                    }
                ?>
                    <!--Column Links, when clicked, calls the same page but changes the
                    variable ?sort based on the column the user wants to sort by 
                    order variable set based on whether the column is sorted -->
                    <th><a href='game.php?sort=season&stadiumName=<?php echo $stadiumName;?>&order=<?php echo $asc_or_desc;?>'>Season</a></th>
                    <th><a href='game.php?sort=gameDate&stadiumName=<?php echo $stadiumName;?>&order=<?php echo $asc_or_desc;?>'>Game Date</a></th>
                    <th><a href='game.php?sort=startTime&stadiumName=<?php echo $stadiumName;?>&order=<?php echo $asc_or_desc;?>'>Start Time</a></th>
                    <th><a href='game.php?sort=visitorTeam&stadiumName=<?php echo $stadiumName;?>&order=<?php echo $asc_or_desc;?>'>Visitor Team</a></th>
                    <th><a href='game.php?sort=visitorPoints&stadiumName=<?php echo $stadiumName;?>&order=<?php echo $asc_or_desc;?>'>Visitor Points</a></th>
                    <th><a href='game.php?sort=homeTeam&stadiumName=<?php echo $stadiumName;?>&order=<?php echo $asc_or_desc;?>'>Home Team</a></th>
                    <th><a href='game.php?sort=homePoints&stadiumName=<?php echo $stadiumName;?>&order=<?php echo $asc_or_desc;?>'>Home Points</a></th>
                    <th><a href='game.php?sort=attendance&stadiumName=<?php echo $stadiumName;?>&order=<?php echo $asc_or_desc;?>'>Attendance </a></th>
                    <th><a href='game.php?sort=arenaName&stadiumName=<?php echo $stadiumName;?>&order=<?php echo $asc_or_desc;?>'>Arena Name</a></th>
                </tr>
            <?php
                // //Original SQL query to show all stats
                $sql = "SELECT d.Season, g.GameDate, g.GameStartET, g.VisitorTeamName, g.VisitorPoints, g.HomeTeamName, g.HomePoints, g.Attendance, g.ArenaName   
                        FROM `date` AS d LEFT JOIN game AS g ON (g.DateId = d.Id) 
                        WHERE (g.ArenaName LIKE '$stadiumName%')\n"
                        . "UNION ALL\n" // "." means to add this line
                        . "SELECT d.Season, g.GameDate, g.GameStartET, g.VisitorTeamName, g.VisitorPoints, g.HomeTeamName, g.HomePoints, g.Attendance, g.ArenaName
                        FROM `date` AS d RIGHT JOIN game AS g ON (g.DateId = d.Id) 
                        WHERE (g.ArenaName LIKE '$stadiumName%' AND d.Id is null)\n";
                //If a column is clicked, sort will be added to the query
                if (isset($_GET['sort'])) {
                    if ($_GET['sort'] == 'season') {
                        $sql .= " ORDER BY Season $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'gameDate') {
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
                        echo "<tr><td>". $row['Season'].
                        "</td><td>". $row['GameDate'].
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
