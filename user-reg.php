<?php
  if (isset($_POST['Submit'])) { // might be lowercase
    console.log("yeet");
    require "./config.php";
    require "./common.php";

    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $new_user = array(
        "fname"     => $_POST['fname'],
        "lname"     => $_POST['lname'],
        "username"  => $_POST['username'],
        "password"  => $_POST['password'],
        "password1" => $_POST['password1'], // check ??
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

<h1>User Registration</h1>

<form method="post" id="user_form">
  First Name: <input type="text" name="fname"><br><br>
  Last Name: <input type="text" name="lname"><br><br>
  Username: <input type="text" name="username"><br><br>
  Password: <input type="text" name="password"><br><br>
  Confirm Password: <input type="text" name="password1"><br><br>
</form>
<br>
<button type="submit" form="user_form" value="Submit" name="Submit">Submit</button>
<button type="button" onclick="location.href = 'reg-nav.php';">Back</button>

</body>
</html>
