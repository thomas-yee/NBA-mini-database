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
            //JQuery code
            //This means this jQuery code will run after the document loads
            //Used to update the list by 2 each time 
            $(document).ready(function() {
                var tableCount = 0;
                $("button").click(function() {
                    tableCount = tableCount + 2;
                    $("#row").load("includes/load-data.php", {
                        tableNewCount: tableCount
                    });
                })
            });
            
            //Used when user selects a team from the drop down menu
            $(document).ready(function() {
                $("Team").change(function() {
                    $("#row").load("includes/drop-down.php", {
                        teamName: $_POST['Team']
                    })
                })
            })
        </script> 
        <title>NBA Mini-Database</title>
    </head>
    <body>
        <header>
            <nav>
                <div class="row">
                    <img src="resources/nba-logo-png-transparent.png" alt="Nba Logo" class="logo">
                    <h1>NBA Mini-Database</h1>
                    <ul class="main-nav"> <!--ul means unordered list-->
                        <li><a href="a">Teams</a></li>
                        <li><a href="a">Games</a></li>
                        <li><a href="a">Players</a></li>
                        <li><a href="a">Contact us</a></li>
                    </ul>
                </div>
            </nav>
        </header>
        <section class = "team-list">
            <div class = "row">
            Team List:              
            <select name ="Team">
                <?php
                    echo "<option value=''>Select a Team</option>";
                    //Used to display teams in the drop down menu alphabetically
                     $sql = "SELECT TeamName FROM team ORDER BY TeamName;";
                     $result = mysqli_query($conn, $sql);
                     $resultCheck = mysqli_num_rows($result); //Check for a result above 0
 
                     if ($resultCheck > 0) {
                         //$row is an array of all the data
                         while ($row = mysqli_fetch_assoc($result)) {
                             echo "<option value=".$row['TeamName'].">".$row['TeamName']."</option>";
                         }
                     }
                     $conn-> close();
                ?>
            </select>
        </div>
        <button>Update</button>
    </section>
    <section class = "display-stats">
        <div id = "row">
            <table>
                <!-- <tr>
                    <th>Arena Name</th>
                    <th>City, State</th>
                    <th>Capacity</th>
                </tr>
                <?php
                    // $sql = "SELECT * FROM arena LIMIT 2;";
                    // $result = mysqli_query($conn, $sql);
                    // $resultCheck = mysqli_num_rows($result); //Check for a result above 0

                    // if ($resultCheck > 0) {
                    //     //$row is an array of all the data
                    //     while ($row = mysqli_fetch_assoc($result)) {
                    //         echo "<tr><td>". $row['ArenaName'] ."</td><td>". $row['CityState']. "</td><td>
                    //         ". $row['ArenaCapacity'] ."</td></tr>";
                    //     }
                    // }
                    // $conn-> close();
                ?> -->
            </table>
        </div>
    </section>
    </body>
</html>
