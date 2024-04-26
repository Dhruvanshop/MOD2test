<?php
require_once 'dashboard_db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="/style/dashboard.css">

  <title>Dashboard</title>
</head>

<body>
  <nav>
    <?php if ($_SESSION['loggedin'] == TRUE) {
      echo "<a href='logout.php'>logout</a>";
    } else {
      echo "<a href='login.php'>login</a>";
    }
    ?>

  </nav>

  <div class="add-player">
    <h3>Add Player</h3>
  </div>
  <form action="dashboard.php" method="post">
    <input type="text" name="name" placeholder="player name" required><br>
    <input type="number" name="run" placeholder="run scored" required><br>
    <input type="number" name="balls" placeholder="balls faced" required><br>
    <button type="submit" name="add">Add Player</button>
  </form>

  <table>
    <tr>
      <th>PLAYER</th>

      <th>RUNS</th>

      <th>BALLS</th>

      <th>STRIKE RATE</th>

      <?php if ($_SESSION['loggedin'] == TRUE) {

        echo " <th>Actions</th>";

      }
      ?>
    </tr>
    <?php
    foreach ($players as $player) {
      echo "<tr>";

      echo "<td>{$player->getName()}</td>";

      echo "<td>{$player->getrun()}</td>";

      echo "<td>{$player->getBalls()}</td>";

      echo "<td>{$player->getStrikeRate()}</td>";

      if ($_SESSION['loggedin'] == TRUE) {
        echo "<td>
        <form action='dashboard.php' method='post'>
            <input type='hidden' name='player_id' value='{$player->getId()}'>

            <input type='text' name='name' value='{$player->getName()}'>

            <input type='number' name='run' value='{$player->getrun()}'>

            <input type='number' name='balls' value='{$player->getBalls()}'>
            
            <button type='submit' name='edit'>Edit</button>

            <button type='submit' name='delete'>Delete</button>
        </form>
      </td>";
      }
      echo "</tr>";
    }
    ?>
  </table>
  <?php if ($_SESSION['loggedin'] != TRUE) { ?>
    <button id="mom">Man of the Match</button>
    <div id="momInfo"></div> 
  <?php } ?>
</body>

</html>
<script>
 $(document).ready(function() {
        $('#mom').click(function() {
            $.ajax({
                url: 'mom.php',
                method: 'GET',
                success: function(response) {
                    $('#momInfo').html("<p>Man of the Match: " + response.name + " AND STRIKE RATE " + response.strikeRate + "</p>");
                },
                error: function(response) {
                    console.error('Error:', response);
                }
            });
        });
    });
</script>