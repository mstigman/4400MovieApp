<?php
    require "./config.php";
    require "./common.php";
?>

<?php //read and result
    session_start();
    try {
        $comName = $_SESSION['comName'];
        // get employee details
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "CALL admin_view_comDetail_emp('$comName')";
        $statement = $connection->prepare($sql);
        $statement->execute();

        $sql = "SELECT * FROM AdComDetailEmp";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $employeeDetail = $statement->fetchAll();

        // get theater details
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "CALL admin_view_comDetail_th('$comName')";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $sql = "SELECT * FROM AdComDetailTh";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $theaterDetail = $statement->fetchAll();

    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
?>

<!DOCTYPE html>
<html>
<body>

<h1>Company Detail</h1>
<h3>Name</h3>
<?php echo $comName ?>
<h3>Employees</h3>
<?php
    $temp = array();
    foreach($employeeDetail as $employee)
    {   
        $mystring = $employee['EmpFirstname'] .' '. $employee['EmpLastname'];
        array_push($temp, $mystring);
    }
    $new = implode(", ", $temp);
    echo $new;
?>

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
    <?php if ($theaterDetail) { ?>
        <?php foreach ($theaterDetail as $row) { ?>
        <tr>
            <td><?php echo escape($row["thName"]); ?>
            <td><?php echo escape($row["thManagerUsername"]); ?></td>
            <td><?php echo escape($row["thCity"]); ?></td>
            <td><?php echo escape($row["thState"]); ?></td>
            <td><?php echo escape($row["thCapacity"]); ?></td>
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
