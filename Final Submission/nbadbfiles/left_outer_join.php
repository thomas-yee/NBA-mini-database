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

    <p>
      <b>Example of a LEFT OUTER JOIN Database Query</b><br><br>
      For every day between start and end date where there was an NBA game, shows the visitor and home
      team names for <br> the selected team's game for that day, or shows null (blank)
      if the selected team didn't play on that day.<br>
    </p>

    <!-- Create the form for the inut data -->
    <section class="row" action="inner_join_on.php">
      <form method="post">
        <label>Start date: </label>
        <input type="date" name="startDate" value="<?php echo isset($_POST['startDate']) ? $_POST['startDate'] : '' ?>" /><br>
        <label>End date: </label>
        <input type="date" name="endDate" value="<?php echo isset($_POST['endDate']) ? $_POST['endDate'] : '' ?>" /><br>
        <label>Team name: </label>
        <input type="text" name="teamName" value="<?php echo isset($_POST['teamName']) ? $_POST['teamName'] : '' ?>" />
         (Partial string is accepted.)<br><br>
        <input type="submit"><br><br>
      </form>
    </section>

    <!-- Now display the results -->
    <section class="display-stats">
      <div id = "row">
        <table>
          <!-- add column headers -->
          <?php
            if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
                if (strlen($_POST['startDate']) == 10 && strlen($_POST['endDate']) == 10) {
                    echo "<tr> <th>Date</th> <th>Visitor Name</th> <th>Home Team Name</th> </tr>";
                    $startDate = $_POST['startDate'];
                    $endDate = $_POST['endDate'];
                    $teamName = $_POST['teamName'];
                    // formulate the query
                    $sql = "SELECT d.Date, g.VisitorTeamName, g.HomeTeamName
                            FROM date AS d LEFT OUTER JOIN (SELECT *
                                                            FROM game
                                                            WHERE (game.VisitorTeamName LIKE '%$teamName%' OR game.HomeTeamName LIKE '%$teamName%'))
                                                            AS g ON g.DateId = d.Id
                            WHERE d.Date BETWEEN '$startDate' AND '$endDate'
                            ORDER BY d.date";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                      // populate the rows in the table
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>".$row['Date']."</td>
                                <td>".$row['VisitorTeamName']."</td>
                                <td>".$row['HomeTeamName']."</td>
                              </tr>";
                      }
                    }
                    $conn->close();
                }
            }
          ?>
        </table>
      </div>
    </section>

  </body>

</html>
