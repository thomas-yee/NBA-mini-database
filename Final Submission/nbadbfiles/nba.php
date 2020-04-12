<?php
    include_once 'includes/databaseHandler.php'; //Can use to grab variable $conn
?>

<!DOCTYPE html>
<html>
    <head>
        <!--Link css file -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
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
    </body>
</html>
