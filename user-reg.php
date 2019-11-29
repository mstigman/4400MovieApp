<?php
    require "./config.php";
    require "./common.php";
?>
<?php
  if (isset($_POST['Submit'])) { // might be lowercase
    if($_POST['password'] == $_POST['password1']) {
      try {
        $connection = new PDO($dsn, $username, $password, $options);

        $register = array(
          "username"      => $_POST['username'],
          "password"      => $_POST['password'],
          "fname"         => $_POST['fname'],
          "lname"         => $_POST['lname'],
        );
        $registerData = implode("','", $register);
        $sql = "CALL user_register('$registerData')";

        $statement = $connection->prepare($sql);
        $statement->execute();
        header("Location:login.php");
      } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
      }
    } else {
      echo "passwords do not match!";
    }
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
