<?php
    require "./config.php";
    require "./common.php";
?>

<?php //read and result
$result = 0;
if (isset($_POST['submit_filters'])) {
  try {

    $connection = new PDO($dsn, $username, $password, $options);

    $param = array(
      'comName' =>  '',
      'minCity' =>  $_POST['city_lower'],
      'maxCity' =>  $_POST['city_upper'],
      'minTheater' =>  $_POST['theater_lower'],
      'MaxTheater' =>  $_POST['theater_upper'],
      'MaxTheater' =>  $_POST['city_lower'],
      'minEmployee' =>  $_POST['employee_lower'],
      'maxEmployee' =>  $_POST['employee_upper'],
      'sortBy' =>  'comName',
      'sortDirect' =>  'ASC',

    );

    $args = implode("','", $param);
    $sql = "CALL admin_filter_company('$args')";


    $statement = $connection->prepare($sql);
    $statement->execute();
    echo $sql;
    $sql = "SELECT * FROM AdFilterCom";
    $statement = $connection->prepare($sql);
    $statement->execute();

    $result  = $statement->fetchAll();

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>

<?php
  if (isset($_POST['detail'])) {
    session_start();
    $_SESSION['comName'] = $_POST['company_name'];
    header("Location:company-detail.php");
  }
?>

<?php //insert and update
if (isset($_POST['submit'])) {
  require "./config.php";
  require "./common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_user = array(
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age'],
      "location"  => $_POST['location']
    );

    $sql = sprintf(
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


<!DOCTYPE html>
<html>
<body>

<h1>Manage Company</h1>
<form action="" method="post" id="filter_form">
&nbsp; Name: <select name="company_name" form="filter_form">
    <?php foreach($companies as $company): ?>
        <option value="<?= $company['comName']; ?>"><?= $company['comName']; ?></option>
    <?php endforeach; ?>
</select>


<br>
  # City Covered:  <input type="text" name="city_lower" maxlength="4" size="4">&nbsp;
  -- <input type="text" name="city_upper" maxlength="4" size="4">&nbsp;
<br><br>
  # Theaters:  <input type="text" name="theater_lower" maxlength="4" size="4">&nbsp;
  -- <input type="text" name="theater_upper" maxlength="4" size="4">&nbsp;
<br><br>
  # Employees:  <input type="text" name="employee_lower" maxlength="4" size="4">&nbsp;
  -- <input type="text" name="employee_upper" maxlength="4" size="4">&nbsp;
<br><br>
<input type="submit" value="Filter" name="submit_filters" style="height:80px; width:80px">


<hr>


<button type="button" name="create_theater" onclick="location.href = 'create-theater.php';" style="height:20px; width:130px">Create Theater</button>
&nbsp;
<button type="submit" name="detail" style="height:20px; width:80px">Detail</button>
<br><br>

<hr>
<table style="width:40%">
    <thead>
  <tr>
    <th>Name <button type="button" name="sort_by_company_name_ASC">Sort ASC</button><button type="button" name="sort_by_company_name_DESC">Sort DESC</button></th>
    <th>#CityCovered <button type="button" name="sort_by_ities_ASC">Sort ASC</button><button type="button" name="sort_by_cities_DESC">Sort DESC</button></th>
    <th>#Theaters <button type="button" name="sort_by_theaters_ASC">Sort ASC</button><button type="button" name="sort_by_theaters_DESC">Sort DESC</button></th>
    <th>#Employee <button type="button" name="sort_by_employee_ASC">Sort ASC</button><button type="button" name="sort_by_employee_DESC">Sort DESC</button></th>
  </tr>
</thead>
<tbody>
        <?php if ($result) {?>
        <?php foreach ($result as $row) { ?>
          <tr>
            <td><?php echo escape($row["comName"]); ?><input type="checkbox"/></td>
            <td><?php echo escape($row["numCityCover"]); ?></td>
            <td><?php echo escape($row["numTheater"]); ?></td>
            <td><?php echo escape($row["numEmployee"]); ?></td>
          </tr>
        <?php } ?>
      <?php } ?>
</tbody>
</table>
</form>
<hr>

<br>
&nbsp;&nbsp;<button type="button" onclick="history.back();" name="back_btn" style="height:40px; width:40px">Back</button>

</body>
</html>
