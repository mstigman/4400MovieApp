
<?php
    try {
      require "./config.php";
      require "./common.php";

      $connection = new PDO($dsn, $username, $password, $options);

      session_start();
      $user = $_SESSION['username'];
      echo $user;
      $sql = "CALL customer_view_history('$user')";


      $statement = $connection->prepare($sql);
      $statement->execute();
      $sql = "Select * from CosViewHistory";

      $statement = $connection->prepare($sql);
      $statement->execute();
      $result = $statement->fetchAll();
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
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
<hr>
<br>
&nbsp;&nbsp;<button type="button" onclick="history.back();" name="back_btn" style="height:40px; width:40px">Back</button>

</body>
</html>
