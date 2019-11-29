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
          "movName"      => $_POST['movName'],
          "movReleaseDate"      => $_POST['movReleaseDate'],
          "duration"         => $_POST['duration'],
          "thName" => $_SESSION['thName'],
          "comName" => $_SESSION['comName'],
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

<!DOCTYPE html>
<html>
<body>

<h1>Schedule Movie</h1>

Name: <select name="movie_name" form="add_form">
  <?php foreach($movies as $movies): ?>
     <option value="<?= $movies['id']; ?>"><?= $movies['name']; ?></option>
  <?php endforeach; ?>
</select>
<br><br>

<form action="" method="post" id="add_form">
  Release Date: <input type="text" name="release_date" maxlength="11" size="11"><br><br>
  Play Date: <input type="text" name="play_date" maxlength="11" size="11"><br><br>
  <button type="submit" form="movie_form" value="Submit" name="Submit">Create</button>
</form>
<br>

<button type="button" onclick="history.back();">Back</button>

</body>
</html>
