<?php
    require "./config.php";
    require "./common.php";
?>
<?php
  if (isset($_POST['Submit'])) { // might be lowercase
      try {
        $connection = new PDO($dsn, $username, $password, $options);
        $movie = array(
          "movName"      => $_POST['movName'],
          "movReleaseDate"      => $_POST['movReleaseDate'],
          "duration"         => $_POST['duration'],
        );

        $movieData = implode("','", $movie);
        $sql = "CALL admin_create_mov('$movieData')";
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

<h1>Create Theater</h1>

<form action="" method="post" id="movie_form">
  Name: <input type="text" name="movName"><br><br>
  Duration: <input type="text" name="duration" maxlength="4" size="4"><br><br>
  Release Date (YYYY/MM/DD): <input type="text" name="movReleaseDate" maxlength="10" size="11">
</form>
<br>

<button type="submit" form="movie_form" value="Submit" name="Submit">Create</button>
<button type="button" onclick="history.back();">Back</button>

</body>
</html>
