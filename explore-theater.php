
<?php
 require "./config.php";
    require "./common.php";
?>

<?php //read and result
$result = 0;
if (isset($_POST['Filter'])) {
  try {

    $connection = new PDO($dsn, $username, $password, $options);

    $param = array(
      "thName"  =>  $_POST['theater_name'],
      "comName"  =>  $_POST['company_name'],
      "city"  =>  $_POST['city'],
      "state"  =>  $_POST['state'],
    );

    $args = implode("','", $param);
    $sql = "CALL user_filter_th('$args')";


    $statement = $connection->prepare($sql);
    $statement->execute();

    $sql = "SELECT * From UserFilterTh";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php

/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */

  try {

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM company";


    $statement = $connection->prepare($sql);
    $statement->execute();

    $companies = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
?>

<?php

/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */

  try {

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM theater";


    $statement = $connection->prepare($sql);
    $statement->execute();

    $theaters = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
?>

<!DOCTYPE html>
<html>
<body>

<h1>Explore Theater</h1>
<form action="" method="post" id="filter_form">
Theater Name: <select name="theater_name" form="filter_form">
  <?php foreach($theaters as $theaters): ?>
     <option value="<?= $theaters['thName']; ?>"><?= $theaters['thName']; ?></option>
  <?php endforeach; ?>
</select>

<br><br>

Company Name: <select name="company_name" form="filter_form">
    <?php foreach($companies as $company): ?>
        <option value="<?= $company['comName']; ?>"><?= $company['comName']; ?></option>
    <?php endforeach; ?>
</select>

<br><br>



  City <input type="text" name="city" >
<br><br>
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
    <option value="VT">Vermont</option>
    <option value="VA">Virginia</option>
    <option value="WA">Washington</option>
    <option value="WV">West Virginia</option>
    <option value="WI">Wisconsin</option>
    <option value="WY">Wyoming</option>
</select>
<br><br>
<input type="submit" value="Filter" name="Filter" style="height:80px; width:80px">
</form>

<hr>
<form action="" method="" id="log_visit">
<table class="table">
    <thead>
        <tr>
            <th>Theater</th>
            <th>Address</th>
            <th>Company</th>
        </tr>
     </thead>
  <tbody>
    <?php if ($result) { ?>
    <?php foreach ($result as $row) { ?>
      <tr>
        <td><?php echo escape($row["thName"]); ?>
        <td><?php echo escape($row["thStreet"]); ?></td>
        <td><?php echo escape($row["thState"]); ?></td>
        <td><?php echo escape($row["thZipCode"]); ?></td>
        <td><?php echo escape($row["comName"]); ?></td>
      </tr>
    <?php } ?>
  <?php } ?>
  </tbody>
 </table>

<br>
Visit Date: <input type="text" name="visit_date" maxlength="11" size="11">&nbsp;

<br><br>

<input type="submit" value="Log Visit" name="log" style="height:80px; width:80px">
</form>

<hr>

&nbsp;&nbsp;<button type="button" onclick="history.back();" name="back_btn" style="height:40px; width:40px">Back</button>

</body>
</html>
