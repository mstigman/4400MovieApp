
<?php
    require "./config.php";
    require "./common.php";
?>

<!--LOGIC FOR LOGGING IN-->
<?php
    if (isset($_POST['submit'])) { // might be lowercase
        if($_POST['password'] !="" && $_POST['username'] != "") {
          try {
            $connection = new PDO($dsn, $username, $password, $options);
            $loginInfo = array(
              "username"      => $_POST['username'],
              "password"      => $_POST['password'],
            );

            $loginData = implode("','", $loginInfo);
            $sql = "CALL user_login('$loginData')";

            $statement = $connection->prepare($sql);

            // Not sure what i should fill in here as the argument
            $statement->execute();

            $sql = "SELECT * FROM team63.userLogin";


            $statement = $connection->prepare($sql);

            // Not sure what i should fill in here as the argument
            $statement->execute();
            $result = $statement->fetchAll();

            $row = $result[0];
            $isCustomer = $row['isCustomer'];
            $isAdmin = $row['isAdmin'];
            $isManager = $row['isManager'];
            $GLOBALS['user'] = $_POST['username'];
            if ($isCustomer && $isAdmin) {
                header("Location:admin-customer-func.php");
            } else if ($isCustomer && $isManager) {
                header("Location:manager-customer-func.php");
            } else if ($isAdmin) {
                header("Location:admin-func.php");
            } else if ($isManager) {
                header("Location:manager-func.php");
            } else {
                header("Location:customer-func.php");
            }

          } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
          }
      }
    }

?>

</script>
</body>




<!DOCTYPE html>
<html>
<body>

<h1>Atlanta Movie Login</h1>

<form action="" method="post" id="login_form">
  Username: <input type="text" name="username"><br><br>
  Password: <input type="text" name="password"><br><br>
  <button type="submit" form="login_form" value="1" name="submit">Login</button>

</form>
<br>
<button type="button" onclick="location.href = 'reg-nav.php';">Register</button>


</body>
</html>
