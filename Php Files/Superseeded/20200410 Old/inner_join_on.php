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
                        <li><a href="miami_heat_no_guards.php">Player Stats</a></li> <!--Links to miami heat no guards page-->
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
      <b>Example of an INNER JOIN ON Database Query</b><br><br>
      Retrieve players from a specified team and having a specified height.<br>
      If field is left blank, all players will be selected.<br>
    </p>

    <section class="row" action="inner_join_on.php">
      <form method="post">
        <label>Team Name: </label>
        <input type="text" name="teamName" value="<?php echo isset($_POST['teamName']) ? $_POST['teamName'] : '' ?>" />
         (Partial string is accepted.)<br>
        <label>Height: </label>
        <input type="text" name="height" value="<?php echo isset($_POST['height']) ? $_POST['height'] : '' ?>" />
         (Partial string is accepted. format e.g.: 6 ft 4 in,  7 ft, etc.)<br><br>
        <input type="submit"><br><br>
      </form>
    </section>

    <section class="display-stats">
      <div id = "row">
        <table>
          <!-- add column headers -->
          <?php
            if (isset($_POST['teamName']) && isset($_POST['teamName'])) {
              echo "<tr> <th>First Name</th> <th>Last Name</th> <th>Team Name</th> <th>Height</th> </tr>";
              $team = $_POST['teamName'];
              $height = $_POST['height'];
              // formulate the query
              $sql = "SELECT m.FirstName, m.LastName, m.TeamName, p.Height
                      FROM member AS m INNER JOIN player AS p ON (m.MemberID = p.MemberID)
                      WHERE (p.height LIKE '%$height%' AND m.TeamName LIKE '%$team%')";
              $result = mysqli_query($conn, $sql);
              if ($result) {
                // populate the rows in the table
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>".$row['FirstName']."</td>
                          <td>".$row['LastName']."</td>
                          <td>".$row['TeamName']."</td>
                          <td>".$row['Height']."</td>
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
