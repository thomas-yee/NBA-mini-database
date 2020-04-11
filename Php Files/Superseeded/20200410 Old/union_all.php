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

    <p>
      <b>Example of a UNION ALL Database Query</b><br><br>
      Find all teams with FG% within selected range or 3P% within selected range or both in any season.<br>
      Includes any redundancies.<br>
    </p>

    <section class="row" action="union_all.php">
      <form method="post">
        <label>FG% between: </label>
        <input type="text" name="fgmin" size = "3" maxlength="4" value="<?php echo isset($_POST['fgmin']) ? $_POST['fgmin'] : '' ?>" />
          <label> and </label>
        <input type="text" name="fgmax" size = "3" maxlength="4" value="<?php echo isset($_POST['fgmax']) ? $_POST['fgmax'] : '' ?>" /><br>
        <label>3P% between: </label>
        <input type="text" name="p3min" size = "3" maxlength="4" value="<?php echo isset($_POST['p3min']) ? $_POST['p3min'] : '' ?>" />
        <label> and </label>
        <input type="text" name="p3max" size = "3" maxlength="4" value="<?php echo isset($_POST['p3max']) ? $_POST['p3max'] : '' ?>" /><br><br>
        <input type="submit"><br><br>
      </form>
    </section>

    <section class="display-stats">
      <div id = "row">
        <table>
          <!-- add column headers -->
          <?php
            if (isset($_POST['fgmin']) && isset($_POST['p3min'])) {
              echo "<tr> <th>Team Name</th> <th>Season</th> <th>FG%</th> <th>3P%</th> </tr>";
              // convert string inputs to float
              $fgmin = $_POST['fgmin'];
              $fgmin = floatval($fgmin);
              $fgmax = $_POST['fgmax'];
              $fgmax = floatval($fgmax);
              $p3min = $_POST['p3min'];
              $p3min = floatval($p3min);
              $p3max = $_POST['p3max'];
              $fp3max = floatval($p3max);

              // formulate the query
              $sql = "SELECT TeamName, Season, `FG%`, `3P%`
                      FROM team_stats
                      WHERE `FG%` BETWEEN '$fgmin' AND '$fgmax'
                      UNION ALL
                      SELECT TeamName, Season, `FG%`, `3P%`
                      FROM team_stats
                      WHERE `3P%` BETWEEN '$p3min' AND '$p3max'
                      ORDER BY TeamName, Season";
              $result = mysqli_query($conn, $sql);
              if ($result) {
                // populate the rows in the table
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>".$row['TeamName']."</td>
                          <td>".$row['Season']."</td>
                          <td>".$row['FG%']."</td>
                          <td>".$row['3P%']."</td>
                        </tr>";
                }
              }
              $conn->close();
            }
          ?>
        </table>
      </div>
    </section>

  </body>

</html>
