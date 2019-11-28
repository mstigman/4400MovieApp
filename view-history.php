
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

<h1>View History</h1>

<hr>
<table>
    <thead>
  <tr>
    <th>Movie </th>
    <th>Theater </th>
    <th>Company </th>
    <th>Card# </th>
    <th>View Date </th>
  </tr>
</thead>
<tbody>
  <tr>
    <td>The Only Theater</td>
    <td>Smith</td>
    <td>50</td>
    <td>pending</td>
    <td>value here</td>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>
    <td>94</td>
    <td>pending</td>
    <td>value here</td>
</tbody>
</table>
<hr>
<br>
&nbsp;&nbsp;<button type="button" onclick="history.back();" name="back_btn" style="height:40px; width:40px">Back</button>

</body>
</html>
