<?php
    require "./config.php";
    require "./common.php";
?>

<?php //read and result
$result = 0;
if (isset($_POST['Filter'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    session_start();
    $param = array(
      "username"   => $_SESSION['username'],
      "movName"   => $_POST['movie_name'],
      "minMovDur"   => $_POST['duration_lower'],
      "maxMovDur"   => $_POST['duration_upper'],
      "minMoveRel"   => $_POST['release_lower'],
      "maxMovRel"   => $_POST['release_upper'],
      "minMovePlay"   => $_POST['play_lower'],
      "maxMovePlay"   => $_POST['play_upper'],
      "notPlayed"   => $_POST['not_played_movie'],
    );

    $args = implode("','", $param);
    $sql = "CALL manager_filter_th('$args')";

    echo $sql;
    $statement = $connection->prepare($sql);
    $statement->execute();

    $sql = "SELECT * FROM ManFilterTh";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>

<!DOCTYPE html>
<html>
<body>

<h1>Theater Overview</h1>

<form action="" method="post" id="filter_form">
   Movie Name <input type="text" name="movie_name">
<br><br>
  # Movie Duration:  <input type="text" name="duration_lower" maxlength="4" size="4">&nbsp;
  -- <input type="text" name="duration_upper" maxlength="4" size="4">&nbsp;
<br><br>
  # Movie Release Date:  <input type="date" name="release_lower">&nbsp;
  -- <input type="date" name="release_upper">&nbsp;
<br><br>
  # Movie Play Date:  <input type="date" name="play_lower">&nbsp;
  -- <input type="date" name="play_upper">&nbsp;
<br><br>
<input name="not_played_movie" type="hidden" value=0>
<input type="checkbox" name="not_played_movie" value=1> Only Include Not Played Movie
<br><br>

<input type="submit" value="Filter" name="Filter" style="height:80px; width:80px">
</form>
<br>
<hr>
<table>
    <thead>
  <tr>
    <th>Movie Name </th>
    <th>Duration </th>
    <th>Release Date </th>
    <th>Play Date </th>
  </tr>
</thead>
<tbody>
        <?php if ($result) {?>
        <?php foreach ($result as $row) { ?>
          <tr>
            <td><?php echo escape($row["username"]); ?></td>
            <td><?php echo escape($row["creditCardCount"]); ?></td>
            <td><?php echo escape($row["userType"]); ?></td>
            <td><?php echo escape($row["status"]); ?></td>
          </tr>
        <?php } ?>
      <?php } ?>
</tbody>
</table>
<hr>
<br>
&nbsp;&nbsp;<button type="button" onclick="history.back();" name="back_btn" style="height:40px; width:40px">Back</button>

</body>
</html>
