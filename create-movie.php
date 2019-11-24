
<?php
  if (isset($_POST['Submit'])) { // might be lowercase
    require "./config.php";
    require "./common.php";

    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $new_user = array(
        "movie_name"   => $_POST['movie_name'],
        "duration"  => $_POST['duration'],
        "release_date"  => $_POST['release_date'],
      );

      $sql = sprintf(                      // rewrite
  "INSERT INTO %s (%s) values (%s)",
  "users",
  implode(", ", array_keys($new_user)),
  ":" . implode(", :", array_keys($new_user))
      );

      $statement = $connection->prepare($sql);
      $statement->execute($new_user);
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
  Name: <input type="text" name="movie_name"><br><br>
  Duration: <input type="text" name="duration" maxlength="4" size="4"><br><br>
  Release Date (YYYY/MM/DD): <input type="text" name="release_date" maxlength="10" size="11">
</form>
<br>

<button type="submit" form="movie_form" value="Submit" name="Submit">Create</button>
<button type="button" onclick="history.back();">Back</button>

</body>
</html>
