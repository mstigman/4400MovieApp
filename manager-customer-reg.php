<?php
  if (isset($_POST['Submit'])) { // might be lowercase
    require "./config.php";
    require "./common.php";

    try {
      $connection = new PDO($dsn, $username, $password, $options);

      $new_user = array(
        "fname"         => $_POST['fname'],
        "lname"         => $_POST['lname'],
        "username"      => $_POST['username'],
        "password"      => $_POST['password'],
        "password1"     => $_POST['password1'],
        "company"       => $_POST['company'],
        "streetaddress" => $_POST['streetaddress'],
        "city"          => $_POST['city'],
        "zipcode"       => $_POST['zipcode'],
        "state"         => $_POST['state'],
        "card1"         => $_POST['card1'],
        "card2"         => $_POST['card2'],
        "card3"         => $_POST['card3'],
        "card4"         => $_POST['card4'],
        "card5"         => $_POST['card5'],
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
    header("Location:manager-customer-func.php");
  }

?>

<?php
  // get companies here!!!!
?>

<!DOCTYPE html>
<html>
<body>

<h1>Manager-Customer Registration</h1>

<form method="post" id="user_form">
  First Name: <input type="text" name="fname"><br><br>
  Last Name: <input type="text" name="lname"><br><br>
  Username: <input type="text" name="username"><br><br>
  Password: <input type="text" name="password"><br><br>
  Confirm Password: <input type="text" name="password1"><br><br>

  Company:
  <select name="company">
    <?php foreach($companies as $companies): ?>
        <option value="<?= $companies['id']; ?>"><?= $companies['name']; ?></option>
    <?php endforeach; ?>
  </select>
  <br><br>

  Street Address: <input type="text" name="streetaddress"><br><br>
  City: <input type="text" name="city"><br><br>
  Zipcode: <input type="text" name="zipcode"><br><br>

  State:
  <select name="state">
    <option value="AL">Alabama (AL)</option>
    <option value="AK">Alaska (AK)</option>
    <option value="AZ">Arizona (AZ)</option>
    <option value="AR">Arkansas (AR)</option>
    <option value="CA">California (CA)</option>
    <option value="CO">Colorado (CO)</option>
    <option value="CT">Connecticut (CT)</option>
    <option value="DE">Delaware (DE)</option>
    <option value="DC">District Of Columbia (DC)</option>
    <option value="FL">Florida (FL)</option>
    <option value="GA">Georgia (GA)</option>
    <option value="HI">Hawaii (HI)</option>
    <option value="ID">Idaho (ID)</option>
    <option value="IL">Illinois (IL)</option>
    <option value="IN">Indiana (IN)</option>
    <option value="IA">Iowa (IA)</option>
    <option value="KS">Kansas (KS)</option>
    <option value="KY">Kentucky (KY)</option>
    <option value="LA">Louisiana (LA)</option>
    <option value="ME">Maine (ME)</option>
    <option value="MD">Maryland (MD)</option>
    <option value="MA">Massachusetts (MA)</option>
    <option value="MI">Michigan (MI)</option>
    <option value="MN">Minnesota (MN)</option>
    <option value="MS">Mississippi (MS)</option>
    <option value="MO">Missouri (MO)</option>
    <option value="MT">Montana (MT)</option>
    <option value="NE">Nebraska (NE)</option>
    <option value="NV">Nevada (NV)</option>
    <option value="NH">New Hampshire (NH)</option>
    <option value="NJ">New Jersey (NJ)</option>
    <option value="NM">New Mexico (NM)</option>
    <option value="NY">New York (NY)</option>
    <option value="NC">North Carolina (NC)</option>
    <option value="ND">North Dakota (ND)</option>
    <option value="OH">Ohio (OH)</option>
    <option value="OK">Oklahoma (OK)</option>
    <option value="OR">Oregon (OR)</option>
    <option value="PA">Pennsylvania (PA)</option>
    <option value="RI">Rhode Island (RI)</option>
    <option value="SC">South Carolina (SC)</option>
    <option value="SD">South Dakota (SD)</option>
    <option value="TN">Tennessee (TN)</option>
    <option value="TX">Texas (TX)</option>
    <option value="UT">Utah (UT)</option>
    <option value="VT">Vermont (VT)</option>
    <option value="VA">Virginia (VA)</option>
    <option value="WA">Washington (WA)</option>
    <option value="WV">West Virginia (WV)</option>
    <option value="WI">Wisconsin (WI)</option>
    <option value="WY">Wyoming (WY)</option>
</select>
  <br><br>
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
