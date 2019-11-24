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

<h1>Manage User</h1>

<form action="" method="" id="find_by_username">
  Username:  <input type="text" name="username">&nbsp;
  <input type="submit" value="Find">
</form>

<form action="" method="" id="filter_by_status">
    Status: <select name="status">
        <option value="All">All</option
>        <option value="Pending">Pending</option>
        <option value="Declined">Declined</option>
        <option value="Approved">Approved</option>
    </select>&nbsp;
  <input type="submit" value="Filter">
</form>

<br>
<table style="width:40%">
  <thead>
  <tr>
    <th>Username <button type="button" name="sort_by_username">Sort</button></th>
    <th>Credit Card Count <button type="button" name="sort_by_card">Sort</button></th>
    <th>User Type <button type="button" name="sort_by_usertype">Sort</button></th>
    <th>Status <button type="button" name="status">Sort</th>
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

<br>

<button type="button" onclick="">Approve</button>&nbsp;
<button type="button" onclick="">Decline</button>
<br><br>
<button type="button" onclick="history.back();">Back</button>




</body>
</html>
