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
            $(document).ready(function() {
                var tableCount = 2;
                $("button").click(function() {
                    tableCount = tableCount + 2;
                    $("#row").load("includes/load-data.php", {
                        tableNewCount: tableCount
                    });
                })
            });
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
            <select name="Team">
                <option value="hawks">Atlanta Hawks</option>
                <option value="celtics">Boston Celtics</option>
                <option value="nets">Brooklyn Nets</option>
                <option value="hornets">Charlotte Hornets</option>
                <option value="bulls">Chicago Bulls</option>
                <option value="cavaliers">Cleveland Cavaliers</option>
                <option value="mavericks">Dallas Mavericks</option>
                <option value="nuggets">Denver Nuggets</option>
                <option value="pistons">Detroit Pistons</option>
                <option value="warriors">Golden State Warriors</option>
                <option value="rockets">Houston Rockets</option>
                <option value="pacers">Indiana Pacers</option>
                <option value="clippers">Los Angeles Clippers</option>
                <option value="lakers">Los Angeles Lakers</option>
                <option value="grizzlies">Memphis Grizzlies</option>
                <option value="heat">Miami Heat</option>
                <option value="bucks">Milwaukee Bucks</option>
                <option value="timberwolves">Minnesota Timberwolves</option>
                <option value="pelicans">New Orleans Pelicans</option>
                <option value="knicks">New York Knicks</option>
                <option value="thunder">Oklahoma City Thunder</option>
                <option value="magic">Orlando Magic</option>
                <option value="76ers">Philadelphia 76ers</option>
                <option value="suns">Phoenix Suns</option>
                <option value="blazers">Portland Trail Blazers</option>
                <option value="kings">Sacramento Kings</option>
                <option value="spurs">San Antonio Spurs</option>
                <option value="raptors">Toronto Raptors</option>
                <option value="jazz">Utah Jazz</option>
                <option value="wizards">Washington Wizards</option>
            </select>
        </div>
        <button>Update</button>
    </section>
    <section class = "display-stats">
        <div id = "row">
            <table>
                <tr>
                    <th>Arena Name</th>
                    <th>City, State</th>
                    <th>Capacity</th>
                </tr>
                <!-- <tr>
                    <th>Team Name</th>
                    <th>Conference</th>
                    <th>Divison</th>
                    <th>Year Founded</th>
                    <th>Year Joined</th>
                </tr> -->
                <!-- Print arena data to a table -->
            
                <?php
                    $sql = "SELECT * FROM arena LIMIT 2;";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result); //Check for a result above 0

                    if ($resultCheck > 0) {
                        //$row is an array of all the data
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>". $row['ArenaName'] ."</td><td>". $row['CityState']. "</td><td>
                            ". $row['ArenaCapacity'] ."</td></tr>";
                        }
                    }
                    $conn-> close();
                ?>
            </table>
            <!-- <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Team</th>
                    <th>GP</th>
                    <th>GS</th>
                    <th>MIN</th>
                    <th>FG</th>
                    <th>FG%</th>
                    <th>3PT</th>
                    <th>3PT%</th>
                    <th>FT</th>
                    <th>FT%</th>
                    <th>OR</th>
                    <th>DR</th>
                    <th>REB</th>
                    <th>AST</th>
                    <th>BLK</th>
                    <th>STL</th>
                    <th>PF</th>
                    <th>TO</th>
                    <th>PTS</th>
                </tr>
            </table> -->
        </div>
    </section>
    </body>
</html>
