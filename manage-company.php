

<?php //read and result
if (isset($_POST['submit'])) {
  try {
    require "./config.php";
    require "./common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM users
    WHERE location = :location";

    $location = $_POST['location'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':location', $location, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
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

<!DOCTYPE html>
<html>
<body>

<h1>Manage Company</h1>

&nbsp; Name: <select name="company_name" form="filter_form">
  <?php foreach($companies as $companies): ?>
     <option value="<?= $companies['id']; ?>"><?= $companies['name']; ?></option>
  <?php endforeach; ?>
</select>

<form action="" method="" id="filter_form">
<br>
  # City Covered:  <input type="text" name="city_lower" maxlength="4" size="4">&nbsp;
  -- <input type="text" name="city_upper" maxlength="4" size="4">&nbsp;
<br><br>
  # Theaters:  <input type="text" name="theater_lower" maxlength="4" size="4">&nbsp;
  -- <input type="text" name="theater_upper" maxlength="4" size="4">&nbsp;
<br><br>
  # Employees:  <input type="text" name="theater_lower" maxlength="4" size="4">&nbsp;
  -- <input type="text" name="theater_upper" maxlength="4" size="4">&nbsp;
<br><br>
<input type="submit" value="Filter" name="submit_filters" style="height:80px; width:80px">
</form>

<hr>


<button type="button" name="create_theater" onclick="location.href = 'create-theater.php';" style="height:20px; width:130px">Create Theater</button>
&nbsp;
<button type="button" name="detail" onclick="location.href = 'company-detail.php';" style="height:20px; width:80px">Detail</button>
<br><br>

<hr>
<table style="width:40%">
    <thead>
  <tr>
    <th>Name <button type="button" name="sort_by_company_name">Sort</button></th>
    <th>#CityCovered <button type="button" name="sort_by_ities">Sort</button></th>
    <th>#Theaters <button type="button" name="sort_by_theaters">Sort</button></th>
    <th>#Employee <button type="button" name="sort_by_employee">Sort</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td>Jill</td>
    <td>Smith</td>
    <td>50</td>
    <td>pending</td>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>
    <td>94</td>
    <td>pending</td>
  </tr>
</tbody>
</table>
<hr>

<br>
&nbsp;&nbsp;<button type="button" onclick="history.back();" name="back_btn" style="height:40px; width:40px">Back</button>

</body>
</html>
