
<?php
  if (isset($_POST['Submit'])) { // might be lowercase
    require "./config.php";
    require "./common.php";

    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $new_user = array(
        "movie_name"   => $_POST['movie_name'],
        "release_date"  => $_POST['release_date'],
        "play_date"  => $_POST['play_date'],
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
