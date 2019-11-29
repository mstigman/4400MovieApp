  
<?php
    require "./config.php";
    require "./common.php";
?>

<!DOCTYPE html>
<html>
<body>

<h1>Create Theater</h1>

<form action="" method="post" id="theater_form">
  Name: <input type="text" name="thName"><br><br>
  Street Address: <input type="text" name="thStreet"><br><br>
  City: <input type="text" name="thCity"><br><br>
  Zipcode: <input type="text" name="thZipcode" maxlength="5" size="5"><br><br>
  State:
  <select name="thState">
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
</select><br><br>
Capacity: <input type="text" name="capacity" maxlength="5" size="5"><br><br>
</form>

<!-- SQL QUERIES for company dropdown -->
Company:
<?php
$sql = "select comName from team63.company;";
$result = $mysqli->query($sql);
echo "<select name='comName' form='theater_form'>";
while ($row=$result->fetch_assoc()) {
    echo "<option value='" . $row['comName'] . "'>" . $row['comName'] . "</option>";
}
echo "</select>";
?>
<br><br>

<!-- SQL QUERIES for manager dropdown -->
Manager:
<?php 
$sql = "select username from team63.manager where username not in (select manUsername in team63.theater);";
$result = $mysqli->query($sql);
echo "<select name='manUsername' form='theater_form'>";
while ($row=$result->fetch_assoc()) {
    echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
}
echo "</select>";
?>
<br><br>

<br>
<button type="submit" form="theater_form" value="Submit" name="Submit">Submit</button>
<button type="button" onclick="history.back();">Back</button>

<?php
  if (isset($_POST['Submit'])) { // might be lowercase
        try {
        $connection = new PDO($dsn, $username, $password, $options);
        $theaterInfo = array(
            "thName"  => $_POST['thName'],
            "comName" => $_POST['comName'],
            "capacity" => $_POST['capacity'],
            "thStreet" => $_POST['thStreet'],
            "thCity" => $_POST['thCity'],
            "thState" => $_POST['thState'],
            "thZipcode" => $_POST['thZipcode'],
            "manUsername" => $_POST['manUsername'],
        );
        $registerData = implode("','", $theaterInfo);
        $sql = "CALL admin_create_theater('$theaterInfo')";
        $statement = $connection->prepare($sql);
        $statement->execute();
        
        echo "<br>" . "The theater has been created."; 

        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
  }
?>


</body>
</html>
