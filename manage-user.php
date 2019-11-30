<?php
    require "./config.php";
    require "./common.php";
?>


<?php //read and result
$result = 0;
if (isset($_POST['Filter'])) {

  try {
    $connection = new PDO($dsn, $username, $password, $options);
    session_start();
    $filter = array(
      "username"   =>$_POST['username'],
      "status"     => $_POST['status'],
      "sortBy"     => 'username',
      "sortDirect" => 'ASC',
    );

    $param = implode("','", $filter);
    $sql = "Call admin_filter_user('$param')";

    $location = $_POST['location'];

    $statement = $connection->prepare($sql);
    $statement->execute();

    //$result = $statement->fetchAll();
    echo "test";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>


<?php //insert and update
if (isset($_POST['submit'])) {
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

<form action="" method="post" id="find_by_username">
  Username:  <input type="text" name="username">&nbsp;
  <input type="submit" value="Find">

    Status: <select name="status">
        <option value="All">All</option>
        <option value="Pending">Pending</option>
        <option value="Declined">Declined</option>
        <option value="Approved">Approved</option>
    </select>&nbsp;
  <input type="submit" value="Filter" name="Filter">
</form>
<form action="" method="post" id="table">
<br>
<table style="width:40%">
  <thead>
  <tr>
    <th>Username <button type="submit" name="sort_by_username_ASC" value="sort_by_username">Sort ASC</button><button type="submit" name="sort_by_username_DESC" value="sort_by_username">Sort DESC</button></th>
    <th>Credit Card Count <button type="submit" name="sort_by_card_ASC">Sort ASC</button><button type="submit" name="sort_by_card_DESC">Sort DESC</button></th>
    <th>User Type <button type="submit" name="sort_by_usertype_ASC">Sort ASC</button><button type="submit" name="sort_by_usertype_DESC" value="sort_by_username">Sort DESC</button></th>
    <th>Status <button type="submit" name="status_ASC">Sort ASC</button><button type="submit" name="status_DESC">Sort DESC</button></th>
  </tr>
</thead>
<tbody>
        <?php if ($result) {?>
        <?php foreach ($result as $row) { ?>
          <tr>
            <td><?php echo escape($row["username"]); ?><input type="checkbox"/></td>
            <td><?php echo escape($row["creditCardCount"]); ?></td>
            <td><?php echo escape($row["userType"]); ?></td>
            <td><?php echo escape($row["status"]); ?></td>
          </tr>
        <?php } ?>
      <?php } ?>
</tbody>
</table>

<br>
</form>
<form action="" method="post" id="asdfkjagslku">


<button type="button" name="approve" onclick="">Approve</button>&nbsp;
<button type="button" onclick="">Decline</button>
<br><br>
<button type="button" onclick="history.back();">Back</button>
</form>
</body>
</html>
