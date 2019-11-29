<?php
    require "./config.php";
    require "./common.php";
?>

<?php
  if (isset($_POST['Submit'])) { // might be lowercase
    if($_POST['password'] == $_POST['password1'] && $_POST['card1'] != "") {
      try {
        $connection = new PDO($dsn, $username, $password, $options);

        $register = array(
          "username"      => $_POST['username'],
          "password"      => $_POST['password'],
          "fname"         => $_POST['fname'],
          "lname"         => $_POST['lname'],
        );
        $creditCards = array($_POST['card1'], $_POST['card2'], $_POST['card3'], $_POST['card4'], $_POST['card5']);
        $registerData = implode("','", $register);
        $sql = "CALL customer_only_register('$registerData')";

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);

        $name = $_POST['username'];
        foreach ($creditCards as $creditCard) {
          if ($creditCard != "") {
            $sql = "CALL customer_add_creditcard('$name', '$creditCard')";
            $statement = $connection->prepare($sql);
            $statement->execute($new_user);
          }
        }
        header("Location:login.php");
      } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
      }
    } else {
      if ($_POST['password'] != $_POST['password1']) {
        echo "passwords do not match!";
      } else {
        echo "need a credit card!";
      }
    }
  }

?>

<!DOCTYPE html>
<html>
<body>

<h1>Customer Registration</h1>

<form method="post" id="user_form">
  First Name: <input type="text" name="fname"><br><br>
  Last Name: <input type="text" name="lname"><br><br>
  Username: <input type="text" name="username"><br><br>
  Password: <input type="text" name="password"><br><br>
  Confirm Password: <input type="text" name="password1"><br><br>
  Credit Card #1: <input type="text" name="card1" placeholder="Compulsory"><br>
  Credit Card #2: <input type="text" name="card2" placeholder="Optional"><br>
  Credit Card #3: <input type="text" name="card3" placeholder="Optional"><br>
  Credit Card #4: <input type="text" name="card4" placeholder="Optional"><br>
  Credit Card #5: <input type="text" name="card5" placeholder="Optional"><br>

</form>
<br>
<button type="submit" form="user_form" value="Submit" name="Submit">Submit</button>
<button type="button" onclick="location.href = 'reg-nav.php';">Back</button>

</body>
</html>
