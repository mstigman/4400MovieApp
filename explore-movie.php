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
      "moveName"  =>  $_POST['movie_name'],
      "comName"  =>  $_POST['company_name'],
      "city"  =>  $_POST['city'],
      "state"  =>  $_POST['state'],
      "minMovPlay"  =>  $_POST['play_date_lower'],
      "maxMovPlay"  =>  $_POST['play_date_upper'],
    );

    $args = implode("','", $param);
    $sql = "CALL customer_filter_mov('$args')";


    $statement = $connection->prepare($sql);
    $statement->execute();

    $sql = "SELECT * From CosFilterMovie";

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
    FROM movie";


    $statement = $connection->prepare($sql);
    $statement->execute();

    $movies = $statement->fetchAll();
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

    session_start();
    $name = $_SESSION['username'];
    $sql = "SELECT *
    FROM creditcard
    WHERE username = '$name'";


    $statement = $connection->prepare($sql);
    $statement->execute();

    $credit_cards = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
?>
<!DOCTYPE html>
<html>
<body>

<h1>Explore Movie</h1>
<form action="" method="post" id="filter_form">

Movie Name: <select name="movie_name" form="filter_form">
  <?php foreach($movies as $movies): ?>
     <option value="<?= $movies['movName']; ?>"><?= $movies['movName']; ?></option>
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
  # Movie Play Date:  <input type="date" name="play_date_lower">&nbsp;
  -- <input type="date" name="play_date_upper">&nbsp;
<br><br>
<input type="submit" value="Filter" name="Filter" style="height:80px; width:80px">
</form>

<hr>

<form action="" method="" id="view_movie">
<table class="table">
    <thead>
        <tr>
            <th>Movie</th>
            <th>Theater</th>
            <th>Address</th>
            <th>Company</th>
            <th>Play Date</th>
        </tr>
     </thead>
  <tbody>
    <?php if ($result) { ?>
    <?php foreach ($result as $row) { ?>
      <tr>
        <td><?php echo escape($row["movName"]); ?>
        <td><?php echo escape($row["thName"]); ?></td>
        <td><?php echo escape($row["comName"]); ?></td>
        <td><?php echo escape($row["creditCardNum"]); ?></td>
        <td><?php echo escape($row["movPlayDate"]); ?></td>
      </tr>
    <?php } ?>
  <?php } ?>
  </tbody>
 </table>

<br>
Card Number:  <select name="card_number" form="view_movie">
  <?php foreach($credit_cards as $credit_cards): ?>
     <option value="<?= $credit_cards['creditCardNum']; ?>"><?= $credit_cards['creditCardNum']; ?></option>
  <?php endforeach; ?>
</select>

<br><br>

<input type="submit" value="View" name="click_view" style="height:80px; width:80px">
</form>

<hr>

&nbsp;&nbsp;<button type="button" onclick="history.back();" name="back_btn" style="height:40px; width:40px">Back</button>

</body>
</html>
