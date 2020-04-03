<?php
//PERFORMS SELECT BASED ON DROP DOWN MENU
    include 'databaseHandler.php'; //Can use to grab variable $conn
    //Used to grab the variable from jQuery
    $stadiumName = $_POST['stadiumName'];
    //SQL Query
    // $sql = "SELECT * FROM team_stats WHERE TeamName LIKE '$teamName%';";
    // $result = mysqli_query($conn, $sql);
    // $resultCheck = mysqli_num_rows($result); //Check for a result above 0

    //If order == DESC is true then use DESC otherwise use ASC
    //Since order hasnt been set, it will default ASC
    //After clicked, it will be set to DESC since statement is true
    //isset() used to get rid of error
    $sort_order = isset($_GET['order']) && $_GET['order'] == 'DESC' ? 'DESC' : 'ASC';
    //if sort_order is ASC, it will set asc_or_desc to DESC
    //After clicked, it will be sent to ASC since statement will be false
    $asc_or_desc = $sort_order == 'ASC' ? 'DESC' : 'ASC';

    // Column Links, when clicked, calls the same page but changes the
    //variable ?sort based on the column the user wants to sort by 
    //order variable set based on whether the column is sorted -->
    echo "<tr><th><a href='game.php?sort=season&stadiumName=$stadiumName&order=$asc_or_desc'>Season</a></th>
    <tr><th><a href='game.php?sort=gameDate&stadiumName=$stadiumName&order=$asc_or_desc'>Game Date</a></th>
    <th><a href='game.php?sort=startTime&stadiumName=$stadiumName&order=$asc_or_desc'>Start Time</a></th>
    <th><a href='game.php?sort=visitorTeam&stadiumName=$stadiumName&order=$asc_or_desc'>Visitor Team</a></th>
    <th><a href='game.php?sort=visitorPoints&stadiumName=$stadiumName&order=$asc_or_desc'>Visitor Points</a></th>
    <th><a href='game.php?sort=homeTeam&stadiumName=$stadiumName&order=$asc_or_desc'>Home Team</a></th>
    <th><a href='game.php?sort=homePoints&stadiumName=$stadiumName&order=$asc_or_desc'>Home Points</a></th>
    <th><a href='game.php?sort=attendance&stadiumName=$stadiumName&order=$asc_or_desc'>Attendance </a></th>
    <th><a href='game.php?sort=arenaName&stadiumName=$stadiumName&order=$asc_or_desc'>Arena Name</a></th></tr>";

    //Original SQL query to show all stats
    $sql = "SELECT `date`.`Season`, `game`.`GameDate`, `game`.`GameStartET`, `game`.`VisitorTeamName`, `game`.`VisitorPoints`,
    `game`.`HomeTeamName`, `game`.`HomePoints`, `game`.`Attendance`, `game`.`ArenaName`, `game`.`VisitorPoints`
    FROM `date` RIGHT JOIN `game` ON `date`.`Id` = `game`.`DateId` WHERE ArenaName LIKE '$stadiumName%'\n";
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