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
                var tableCount = 0; //initial variable
                $("button").click(function() {
                    tableCount = tableCount + 2;
                    $("#row").load("includes/load-data.php", { //row is where the data will be shown, load is the php file to do the select
                        tableNewCount: tableCount //php file will grab the tableNewCount argument
                    });
                })
            });
            
            //Used when user selects a team from the drop down menu
            $(document).ready(function() {
                //notification of when team is selected
                //teamName holds the name when it is selected
                $("select").change(function() {
                    var teamName = $(this).val();
                    $.ajax({
                        url:"includes/drop-down.php", //the php file where it occurs
                        method:"POST", //sends POST request
                        data:{teamName:teamName}, //data to submit 
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
                        <li><a href="game_intersect.php">Home Dominators</a></li> <!--Links to game_intersect page-->
                        <li><a href="miami_heat_no_guards.php">Miami Heat</a></li> <!--Links to miami heat no guards page-->
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
                <form action = "" method = "post">
                    <p>Please make a selection:</p>
                    <input type = "radio" id = "info" name = "playerStats" value = "info", checked> <!--Name = group name of all the radio buttons, 
                    value = name of each individual button" -->
                    <label for = "info">Personal Information</label>
                    <input type = "radio" id = "playerStats" name = "playerStats" value = "playerStats">
                    <label for = "info">Player Stats</label>
                </form>
            </div>
            <div class = "row">
            Team List:              
            <select name ="Team" id="Team">
                <?php
                    //Displays Select a Team in the drop down menu
                    echo "<option value=''>Select a Team</option>";
                    //Used to display teams in the drop down menu alphabetically
                     $sql = "SELECT TeamName FROM team ORDER BY TeamName;";
                     $result = mysqli_query($conn, $sql);
                     $resultCheck = mysqli_num_rows($result); //Check for a result above 0
 
                     if ($resultCheck > 0) {
                         //$row is an array of all the data
                         while ($row = mysqli_fetch_assoc($result)) {
                             //Adds the teams to the drop down menu
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

            </table>
        </div>
    </section>
    </body>
</html>
