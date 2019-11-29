<?php
    require "./config.php";
    require "./common.php";
?>
<?php
  if (isset($_POST['Submit'])) { // might be lowercase
      try {
        session_start();
        $connection = new PDO($dsn, $username, $password, $options);
        $movie = array(
          "username"    => $_SESSION['username'],
          "movName"      => $_POST['movie_name'],
          "release_date"      => $_POST['release_date'],
          "play_date"         => $_POST['play_date'],

        );

        $movieData = implode("','", $movie);
        $sql = "CALL manager_schedule_mov('$movieData')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        echo "<br>" . "Movie successfully created.";

      } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
      }
  }
?>

<?php
  $connection = new PDO($dsn, $username, $password, $options);
  $sql = "SELECT movName FROM movie";
  $statement = $connection->prepare($sql);
  $statement->execute();

  $movies = $statement->fetchAll();
?>


<!DOCTYPE html>
<html>
<body>

<h1>Schedule Movie</h1>

Name: <select type="submit" name="movie_name" form="add_form">
  <?php foreach($movies as $movies): ?>
     <option value="<?= $movies['movName']; ?>"><?= $movies['movName']; ?></option>
  <?php endforeach; ?>
</select>
<br><br>

<form action="" method="post" id="add_form">
  Release Date: <input type="text" name="release_date" maxlength="11" size="11"><br><br>
  Play Date: <input type="text" name="play_date" maxlength="11" size="11"><br><br>
  <button type="submit" value="Submit" name="Submit">Create</button>
</form>
<br>

<button type="button" onclick="history.back();">Back</button>

</body>
</html>
