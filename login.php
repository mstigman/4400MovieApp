
<?php
  if (isset($_POST['Submit'])) { // might be lowercase
    console.log("yeet");
    require "./config.php";
    require "./common.php";

    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $new_user = array(
        "username"  => $_POST['username'],
        "password"  => $_POST['password'],
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
    header("Location:user-func.php");
}
?>

<!DOCTYPE html>
<html>
<body>

<h1>Atlanta Movie Login</h1>

<form action="" method="post" id="login_form">
  Username: <input type="text" name="username"><br><br>
  Password: <input type="text" name="password"><br><br>

</form>
<br>
<button type="submit" form="login_form" value="Submit">Login</button>
<button type="button" onclick="location.href = 'reg-nav.php';">Register</button>

</body>
</html>
