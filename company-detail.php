<?php

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

<!DOCTYPE html>
<html>
<body>

<h1>Company Detail</h1>

<h3>Name</h3>
--- query and output company name here ---
<h3>Employees</h3>
--- query and output list of managers of this company here ---
<br><br>
<h3>Theaters</h3>
<hr>
<table style="width:40%">
    <thead>
  <tr>
    <th>Name </th>
    <th>Manager </th>
    <th>City </th>
    <th>State </th>
    <th>Capacity </th>
  </tr>
</thead>
<tbody>
  <tr>
    <td>The Only Theater</td>
    <td>Smith</td>
    <td>50</td>
    <td>pending</td>
    <th>12 </th>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>
    <td>94</td>
    <td>pending</td>
    <th>12 </th>
  </tr>
</tbody>
</table>
<hr>

<br>
&nbsp;&nbsp;<button type="button" onclick="history.back();" name="back_btn" style="height:40px; width:40px">Back</button>

</body>
</html>
