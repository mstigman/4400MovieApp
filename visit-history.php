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

<h1>Visit History</h1>

<form id="filter_form">
Company Name: <select name="company_name" form="filter_form">
  <?php foreach($companies as $companies): ?>
     <option value="<?= $companies['id']; ?>"><?= $companies['name']; ?></option>
  <?php endforeach; ?>
</select>
<br><br>

# Visit Date:  <input type="text" name="visit_date_lower" maxlength="11" size="11">&nbsp;
  -- <input type="text" name="visit_date_upper" maxlength="11" size="11">&nbsp;
<br><br>
<input type="submit" value="Filter" name="submit_filters" style="height:80px; width:80px">
</form>

<hr>

<table class="table">
    <thead>
        <tr>
            <th>Theater</th>
            <th>Address</th>
            <th>Company</th>
            <th>Visit Date</th>
        </tr>
     </thead>
     <tbody>
        <tr>
            <td>Value </td>
            <td>Value </td>
            <td>Value </td>
            <td>Value </td>
         </tr>
     </tbody>
</table>

<hr>

&nbsp;&nbsp;<button type="button" onclick="history.back();" name="back_btn" style="height:40px; width:40px">Back</button>

</body>
</html>
