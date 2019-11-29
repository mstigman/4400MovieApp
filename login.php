
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

            if ($isCustomer && $isAdmin) {
                // Pass some variables to using SESSION for later use
                session_start();
                $_SESSION['username'] = $_POST['username'];
                header("Location:admin-customer-func.php");
            } else if ($isCustomer && $isManager) {
                // Get comName if manager
                $userName = $_POST['username'];
                $sql = "SELECT * FROM manager WHERE username = $userName";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $manager = $statement->fetchAll();
                // Get the theater managed by the manager
                $sql = "SELECT * FROM theater WHERE manUsername = $userName";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $theaterManaged = $statement->fetchAll();
                // Pass some variables to using SESSION for later use
                session_start();
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['comName'] = $manager['comName'];
                $_SESSION['thName'] = $theaterManaged['thName'];
                // Go to next page
                header("Location:manager-customer-func.php");
            } else if ($isAdmin) {
                session_start();
                $_SESSION['username'] = $_POST['username'];
                header("Location:admin-func.php");
            } else if ($isManager) {
                // Get comName if manager
                $userName = $_POST['username'];
                $sql = "SELECT * FROM manager WHERE username = $userName";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $manager = $statement->fetchAll();
                // Get the theater managed by the manager
                $sql = "SELECT * FROM theater WHERE manUsername = $userName";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $theaterManaged = $statement->fetchAll();
                // Pass some variables to using SESSION for later use
                session_start();
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['comName'] = $manager['comName'];
                $_SESSION['thName'] = $theaterManaged['thName'];
                // Go to next page
                header("Location:manager-func.php");
            } else {
                session_start();
                $_SESSION['username'] = $_POST['username'];
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
