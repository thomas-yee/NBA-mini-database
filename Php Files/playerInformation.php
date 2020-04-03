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
        <section class = "choose-data">
            <div class = "row">
                <!-- Links to the same page but stores the letter the user chooses -->
                <li><a href="playerInformation.php?letter=A">A</a></li>
                <li><a href="playerInformation.php?letter=B">B</a></li>
                <li><a href="playerInformation.php?letter=C">C</a></li>
                <li><a href="playerInformation.php?letter=D">D</a></li>
                <li><a href="playerInformation.php?letter=E">E</a></li>
                <li><a href="playerInformation.php?letter=F">F</a></li>
                <li><a href="playerInformation.php?letter=G">G</a></li>
                <li><a href="playerInformation.php?letter=H">H</a></li>
                <li><a href="playerInformation.php?letter=I">I</a></li>
                <li><a href="playerInformation.php?letter=J">J</a></li>
                <li><a href="playerInformation.php?letter=K">K</a></li>
                <li><a href="playerInformation.php?letter=M">M</a></li>
                <li><a href="playerInformation.php?letter=N">N</a></li>
                <li><a href="playerInformation.php?letter=O">O</a></li>
                <li><a href="playerInformation.php?letter=P">P</a></li>
                <li><a href="playerInformation.php?letter=Q">Q</a></li>
                <li><a href="playerInformation.php?letter=R">R</a></li>
                <li><a href="playerInformation.php?letter=S">S</a></li>
                <li><a href="playerInformation.php?letter=T">T</a></li>
                <li><a href="playerInformation.php?letter=U">U</a></li>
                <li><a href="playerInformation.php?letter=V">V</a></li>
                <li><a href="playerInformation.php?letter=W">W</a></li>
                <li><a href="playerInformation.php?letter=X">X</a></li>
                <li><a href="playerInformation.php?letter=Y">Y</a></li>
                <li><a href="playerInformation.php?letter=Z">Z</a></li>
            </div>
            <div class = "row">
        </section>
        <section class = "display-stats">
            <div id = "row">
                <table>
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
                    //Get the letter when column is clicked from list
                    if (isset($_GET['letter'])) {
                        $letter = $_GET['letter'];
                    }
                    else {
                        //When page is initialized, letter will be blank so all the players will be listed
                        $letter = "";
                    }
                ?>
                    <!--Column Links, when clicked, calls the same page but changes the
                    variable ?sort based on the column the user wants to sort by 
                    order variable set based on whether the column is sorted -->
                    <th><a href='playerInformation.php?sort=lastName&letter=<?php echo $letter;?>&order=<?php echo $asc_or_desc;?>'>Last Name</a></th>
                    <th><a href='playerInformation.php?sort=firstName&letter=<?php echo $letter;?>&order=<?php echo $asc_or_desc;?>'>First Name</a></th>
                    <th><a href='playerInformation.php?sort=team&letter=<?php echo $letter;?>&order=<?php echo $asc_or_desc;?>'>Team</a></th>
                    <th><a href='playerInformation.php?sort=position&letter=<?php echo $letter;?>&order=<?php echo $asc_or_desc;?>'>Position</a></th>
                    <th><a href='playerInformation.php?sort=jerseyNo&letter=<?php echo $letter;?>&order=<?php echo $asc_or_desc;?>'>Jersey Number</a></th>
                    <th><a href='playerInformation.php?sort=height&letter=<?php echo $letter;?>&order=<?php echo $asc_or_desc;?>'>Height</a></th>
                    <th><a href='playerInformation.php?sort=weight&letter=<?php echo $letter;?>&order=<?php echo $asc_or_desc;?>'>Weight</a></th>
                    <th><a href='playerInformation.php?sort=birthDate&letter=<?php echo $letter;?>&order=<?php echo $asc_or_desc;?>'>Birth Date</a></th>
                    <th><a href='playerInformation.php?sort=college&letter=<?php echo $letter;?>&order=<?php echo $asc_or_desc;?>'>College</a></th>
                </tr>
                <?php
                //Original SQL query to show all stats
                $sql = "SELECT * FROM `member` AS `t1` RIGHT JOIN `player` AS `t2` ON `t2`.`LastName` = `t1`.`LastName` AND `t2`.`FirstName` = `t1`.`FirstName` WHERE `t2`.`LastName` LIKE '$letter%'\n";
                //If a column is clicked, sort will be added to the query
                if (isset($_GET['sort'])) {
                    if ($_GET['sort'] == 'lastName') {
                        $sql .= " ORDER BY LastName $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'firstName') {
                        $sql .= " ORDER BY FirstName $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'team') {
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
                    elseif ($_GET['sort'] == 'BirthDate') {
                        $sql .= " ORDER BY birthDate $asc_or_desc";
                    }
                    elseif ($_GET['sort'] == 'college') {
                        $sql .= " ORDER BY College $asc_or_desc";
                    }
                    
                }
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result); //Check for a result above 0

                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>". $row['LastName'].
                        "</td><td>". $row['FirstName'].
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
