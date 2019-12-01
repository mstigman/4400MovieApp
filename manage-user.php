<?php
    require "./config.php";
    require "./common.php";
?>


<?php //read and result
session_start();
$result = 0;
function buildParams($arrayParam, $sortBy, $sortDirection) {
    $returnParam = $arrayParam;
    array_push($returnParam, $sortBy);
    array_push($returnParam, $sortDirection);
    return $returnParam;
}

if (isset($_POST['approve_btn'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $selectedUsername = $_POST['selectedUser'];
        $sql = "Select status from user where username = '$selectedUsername'";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $thisUser = $statement->fetchAll();
        if ($thisUser[0][0] == "Approved") {
            echo "Cannot approve APPROVED user.";
        } else {
    
            $sql = "Call admin_approve_user('$selectedUsername')";
            $statement = $connection->prepare($sql);
            $statement->execute();
            echo $sql . ' executed successfully';
        }

      } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
      }

} else if (isset($_POST['decline_btn'])){
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $selectedUsername = $_POST['selectedUser'];
        $sql = "Select status from user where username = '$selectedUsername'";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $thisUser = $statement->fetchAll();
        if ($thisUser[0][0] == "Pending") {
            $sql = "Call admin_decline_user('$selectedUsername')";
            $statement = $connection->prepare($sql);
            $statement->execute();
            echo $sql . ' executed successfully';
        } else {
            echo "Cannot decline APPROVED/DECLINED user.";
        }

      } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
      }

} else if (isset($_POST['Filter'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $buildFilter = array(
        "username"   => $_POST['username'],
        "status"     => 'ALL',
        );
        $_SESSION['buildFilter'] = $buildFilter;

        $filter = buildParams($buildFilter, 'username', 'ASC');
        $param = implode("','", $filter);
        $sql = "Call admin_filter_user('$param')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql = "SELECT * FROM AdFilterUser";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else if (isset($_POST['Find'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $filter = array(
        "username"   => $_POST['username'],
        "status"     => 'ALL',
        "sortBy"     => 'username',
        "sortDirect" => 'ASC',
        );
        $param = implode("','", $filter);
        $sql = "Call admin_filter_user('$param')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql = "SELECT * FROM AdFilterUser";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else if (isset($_POST['sort_by_username_ASC'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $buildFilter = $_SESSION['buildFilter'];
        $filter = buildParams($buildFilter, 'username', 'ASC');
        $param = implode("','", $filter);
        $sql = "Call admin_filter_user('$param')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql = "SELECT * FROM AdFilterUser";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

} else if (isset($_POST['sort_by_username_DESC'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $buildFilter = $_SESSION['buildFilter'];
        $filter = buildParams($buildFilter, 'username', 'DESC');
        $param = implode("','", $filter);
        $sql = "Call admin_filter_user('$param')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql = "SELECT * FROM AdFilterUser";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

} else if (isset($_POST['sort_by_card_ASC'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $buildFilter = $_SESSION['buildFilter'];
        $filter = buildParams($buildFilter, 'creditCardCount', 'ASC');
        $param = implode("','", $filter);
        $sql = "Call admin_filter_user('$param')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql = "SELECT * FROM AdFilterUser";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

} else if (isset($_POST['sort_by_card_DESC'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $buildFilter = $_SESSION['buildFilter'];
        $filter = buildParams($buildFilter, 'creditCardCount', 'DESC');
        $param = implode("','", $filter);
        $sql = "Call admin_filter_user('$param')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql = "SELECT * FROM AdFilterUser";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

} else if (isset($_POST['sort_by_usertype_ASC'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $buildFilter = $_SESSION['buildFilter'];
        $filter = buildParams($buildFilter, 'userType', 'ASC');
        $param = implode("','", $filter);
        $sql = "Call admin_filter_user('$param')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql = "SELECT * FROM AdFilterUser";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

} else if (isset($_POST['sort_by_usertype_DESC'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $buildFilter = $_SESSION['buildFilter'];
        $filter = buildParams($buildFilter, 'userType', 'DESC');
        $param = implode("','", $filter);
        $sql = "Call admin_filter_user('$param')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql = "SELECT * FROM AdFilterUser";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

} else if (isset($_POST['status_ASC'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $buildFilter = $_SESSION['buildFilter'];
        $filter = buildParams($buildFilter, 'status', 'ASC');
        $param = implode("','", $filter);
        $sql = "Call admin_filter_user('$param')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql = "SELECT * FROM AdFilterUser";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

} else if (isset($_POST['status_DESC'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $buildFilter = $_SESSION['buildFilter'];
        $filter = buildParams($buildFilter, 'status', 'DESC');
        $param = implode("','", $filter);
        $sql = "Call admin_filter_user('$param')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql = "SELECT * FROM AdFilterUser";
        $statement = $connection->prepare($sql);
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

<h1>Manage User</h1>

<form action="" method="post" id="find_by_username">
  Username:  <input type="text" name="username"> &nbsp;

  <input type="submit" value="Find" name="Find"> &nbsp; &nbsp;

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
    <th>Select</th>
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
            <td><input type="checkbox" name="selectedUser" value="<?php echo $row["username"]; ?>"/></td>
            <td><?php echo escape($row["username"]); ?></td>
            <td><?php echo escape($row["creditCardCount"]); ?></td>
            <td><?php echo escape($row["userType"]); ?></td>
            <td><?php echo escape($row["status"]); ?></td>
          </tr>
        <?php } ?>
      <?php } ?>
</tbody>
</table>
<hr>
<button type="submit" name="approve_btn">Approve</button>&nbsp;
<button type="submit" name="decline_btn">Decline</button>
<br><br>
<br>
</form>


<button type="button" onclick="history.back();">Back</button>
</body>
</html>
