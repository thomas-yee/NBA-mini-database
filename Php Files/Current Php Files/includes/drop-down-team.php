<?php
//PERFORMS SELECT BASED ON DROP DOWN MENU
    include 'databaseHandler.php'; //Can use to grab variable $conn
    //Used to grab the variable from jQuery
    $teamName = $_POST['teamName'];
    // //If order == DESC is true then use DESC otherwise use ASC
    // //Since order hasn't been set, it will default ASC
    // //After clicked, it will be set to DESC since statement is true
    // //isset() used to get rid of error
    $sort_order = isset($_GET['order']) && $_GET['order'] == 'DESC' ? 'DESC' : 'ASC';
    // //if sort_order is ASC, it will set asc_or_desc to DESC
    // //After clicked, it will be sent to ASC since statement will be false
    $asc_or_desc = $sort_order == 'ASC' ? 'DESC' : 'ASC';

    // Column Links, when clicked, calls the same page but changes the
    //variable ?sort based on the column the user wants to sort by 
    //order variable set based on whether the column is sorted -->
    echo "<tr><th><a href='player.php?sort=firstName&teamName=$teamName&order=$asc_or_desc'>First Name</a></th>
    <th><a href='player.php?sort=lastName&teamName=$teamName&order=$asc_or_desc'>Last Name</a></th>
    <th><a href='player.php?sort=teamName&teamName=$teamName&order=$asc_or_desc'>Team Name</a></th>
    <th><a href='player.php?sort=season&teamName=$teamName&order=$asc_or_desc'>Season</a></th>
    <th><a href='player.php?sort=salary&teamName=$teamName&order=$asc_or_desc'>Salary</a></th>
    <th><a href='player.php?sort=gamesPlayed&teamName=$teamName&order=$asc_or_desc'>GP</a></th>
    <th><a href='player.php?sort=gamesStarted&order=<?php echo $asc_or_desc'>GS</a></th>
    <th><a href='player.php?sort=min&teamName=$teamName&order=$asc_or_desc'>MIN</a></th>
    <th><a href='player.php?sort=fg&teamName=$teamName&order=$asc_or_desc'>FG</a></th>
    <th><a href='player.php?sort=fg%&teamName=$teamName&order=$asc_or_desc'>FG%</a></th>
    <th><a href='player.php?sort=3pt&teamName=$teamName&order=$asc_or_desc'>3PT</a></th>
    <th><a href='player.php?sort=3pt%&teamName=$teamName&order=$asc_or_desc'>3PT%</a></th>
    <th><a href='player.php?sort=ft&teamName=$teamName&order=$asc_or_desc'>FT</a></th>
    <th><a href='player.php?sort=ft%&teamName=$teamName&order=$asc_or_desc'>FT%</a></th>
    <th><a href='player.php?sort=or&teamName=$teamName&order=$asc_or_desc'>OR</a></th>
    <th><a href='player.php?sort=dr&teamName=$teamName&order=$asc_or_desc'>DR</a></th>
    <th><a href='player.php?sort=reb&teamName=$teamName&order=$asc_or_desc'>REB</a></th>
    <th><a href='player.php?sort=ast&teamName=$teamName&order=$asc_or_desc'>AST</a></th>
    <th><a href='player.php?sort=blk&teamName=$teamName&order=$asc_or_desc'>BLK</a></th>
    <th><a href='player.php?sort=stl&teamName=$teamName&order=$asc_or_desc'>STL</a></th>
    <th><a href='player.php?sort=pf&teamName=$teamName&order=$asc_or_desc'>PF</a></th>
    <th><a href='player.php?sort=to&teamName=$teamName&order=$asc_or_desc'>TO</a></th>
    <th><a href='player.php?sort=ppg&teamName=$teamName&order=$asc_or_desc'>PPG</a></th></tr>";

    // // Original SQL query to show all stats
    // $sql = "SELECT d.Season, g.GameDate, g.GameStartET, g.VisitorTeamName, g.VisitorPoints, g.HomeTeamName, g.HomePoints, g.Attendance, g.ArenaName   
    //         FROM `date` AS d LEFT JOIN game AS g ON (g.DateId = d.Id) 
    //         WHERE (g.ArenaName LIKE '$stadiumName%')\n"
    //         . "UNION ALL\n" // "." means to add this line
    //         . "SELECT d.Season, g.GameDate, g.GameStartET, g.VisitorTeamName, g.VisitorPoints, g.HomeTeamName, g.HomePoints, g.Attendance, g.ArenaName
    //         FROM `date` AS d RIGHT JOIN game AS g ON (g.DateId = d.Id) 
    //         WHERE (g.ArenaName LIKE '$stadiumName%' AND d.Id is null)\n";
    // // If a column is clicked, sort will be added to the query
    // if (isset($_GET['sort'])) {
    //     if ($_GET['sort'] == 'season') {
    //         $sql .= " ORDER BY Season $asc_or_desc";
    //     }
    //     elseif ($_GET['sort'] == 'gameDate') {
    //         $sql .= " ORDER BY GameDate $asc_or_desc";
    //     }
    //     elseif ($_GET['sort'] == 'startTime') {
    //         $sql .= " ORDER BY GameStartET $asc_or_desc";
    //     }
    //     elseif ($_GET['sort'] == 'visitorTeam') {
    //         $sql .= " ORDER BY VisitorTeamName $asc_or_desc";
    //     }
    //     elseif ($_GET['sort'] == 'visitorPoints') {
    //         $sql .= " ORDER BY VisitorPoints $asc_or_desc";
    //     }
    //     elseif ($_GET['sort'] == 'homeTeam') {
    //         $sql .= " ORDER BY `HomeTeamName` $asc_or_desc";
    //     }
    //     elseif ($_GET['sort'] == 'homePoints') {
    //         $sql .= " ORDER BY `HomePoints` $asc_or_desc";
    //     }
    //     elseif ($_GET['sort'] == 'attendance') {
    //         $sql .= " ORDER BY `Attendance` $asc_or_desc";
    //     }
    //     elseif ($_GET['sort'] == 'arenaName') {
    //         $sql .= " ORDER BY ArenaName $asc_or_desc";
    //     }
        
    // }




    // Create query template
    $sql = "SELECT *
            FROM member as tableA
            NATURAL JOIN (SELECT *
                          FROM player_stats
                          WHERE Season='2017-2018'
                          ) AS tableB
            WHERE tableA.TeamName LIKE '$teamName%';";
    // Create a prepared statement using the template
    $result = mysqli_query($conn, $sql);
    // Check if any results returned
    $resultCheck = mysqli_num_rows($result); // # of rows returned
    if ($resultCheck <= 0) {
        echo "No results found";
    }
    else {
        // Print results
        while($row = mysqli_fetch_assoc($result)) {  
            echo "<tr><td>". $row['FirstName']."</td>
            <td>". $row['LastName']."</td>
            <td>". $row['TeamName']."</td> 
            <td>". $row['Season']."</td>
            <td>". $row['Salary']."</td>
            <td>". $row['GP']."</td>
            <td>". $row['GS']."</td>
            <td>". $row['MIN']."</td>
            <td>". $row['FG']."</td>
            <td>". $row['FG%']."</td>
            <td>". $row['3PT']."</td>
            <td>". $row['3P%']."</td>
            <td>". $row['FT']."</td>
            <td>". $row['FT%']."</td>
            <td>". $row['OR']."</td>
            <td>". $row['DR']."</td>
            <td>". $row['REB']."</td>
            <td>". $row['AST']."</td>
            <td>". $row['BLK']."</td>
            <td>". $row['STL']."</td>
            <td>". $row['PF']."</td>
            <td>". $row['TO']."</td>
            <td>". $row['PPG']."</td></tr>";
        } 
    }
    $conn->close();
?>