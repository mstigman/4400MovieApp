<?php
    require "./config.php";
    require "./common.php";
?>

<?php //read and result
session_start();
function buildParams($arrayParam, $sortBy, $sortDirection) {
    $returnParam = $arrayParam;
    array_push($returnParam, $sortBy);
    array_push($returnParam, $sortDirection);
    return $returnParam;
}

$result = 0;
if (isset($_POST['sort_by_company_name_ASC'])) {
    try{
        $connection = new PDO($dsn, $username, $password, $options);
        $parameters = $_SESSION['comParameters'];
        $param = buildParams($parameters, 'comName', 'ASC');
        $args = implode("','", $param);
        $sql = "CALL admin_filter_company('$args')";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $sql = "SELECT * FROM AdFilterCom";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result  = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

} else if (isset($_POST['sort_by_company_name_DESC'])){
    try{
        $connection = new PDO($dsn, $username, $password, $options);
        $parameters = $_SESSION['comParameters'];
        $param = buildParams($parameters, 'comName', 'DESC');
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

} else if (isset($_POST['sort_by_cities_ASC'])){
    try{
        $connection = new PDO($dsn, $username, $password, $options);
        $parameters = $_SESSION['comParameters'];
        $param = buildParams($parameters, 'numCityCover', 'ASC');
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

} else if (isset($_POST['sort_by_cities_DESC'])){
    try{
        $connection = new PDO($dsn, $username, $password, $options);
        $parameters = $_SESSION['comParameters'];
        $param = buildParams($parameters, 'numCityCover', 'DESC');
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

} else if (isset($_POST['sort_by_theaters_ASC'])){
    try{
        $connection = new PDO($dsn, $username, $password, $options);
        $parameters = $_SESSION['comParameters'];
        $param = buildParams($parameters, 'numTheater', 'ASC');
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

} else if (isset($_POST['sort_by_theaters_DESC'])){
    try{
        $connection = new PDO($dsn, $username, $password, $options);
        $parameters = $_SESSION['comParameters'];
        $param = buildParams($parameters, 'numTheater', 'DESC');
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

} else if (isset($_POST['sort_by_employee_ASC'])){
    try{
        $connection = new PDO($dsn, $username, $password, $options);
        $parameters = $_SESSION['comParameters'];
        $param = buildParams($parameters, 'numEmployee', 'ASC');
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

} else if (isset($_POST['sort_by_employee_DESC'])){
    try{
        $connection = new PDO($dsn, $username, $password, $options);
        $parameters = $_SESSION['comParameters'];
        $param = buildParams($parameters, 'numEmployee', 'DESC');
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

} else if (isset($_POST['submit_filters'])) {
  
        try {

            $connection = new PDO($dsn, $username, $password, $options);
            $parameters = array(
            'comName' =>  $_POST['company_name'],
            'minCity' =>  $_POST['city_lower'],
            'maxCity' =>  $_POST['city_upper'],
            'minTheater' =>  $_POST['theater_lower'],
            'MaxTheater' =>  $_POST['theater_upper'],
            'minEmployee' =>  $_POST['employee_lower'],
            'maxEmployee' =>  $_POST['employee_upper'],
            //'sortBy' =>  'comName',
            //'sortDirect' =>  'ASC',
            );
            // Store the parameters in SESSION
            $_SESSION['comParameters'] = $parameters;

            $param = buildParams($parameters, 'comName', 'ASC');
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
} else {
    try {

        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "CALL admin_filter_company('','0','100','0','100','0','100','comName','ASC')";
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
    $_SESSION['comName'] = $_POST['selectedCom'];
    header("Location:company-detail.php");
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
Company Name: <select name="company_name" form="filter_form">
    <option value="">ALL</option>
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
    <th>Select</th>
    <th>Name <button type="submit" name="sort_by_company_name_ASC">Sort ASC</button><button type="submit" name="sort_by_company_name_DESC">Sort DESC</button></th>
    <th>#CityCovered <button type="submit" name="sort_by_cities_ASC">Sort ASC</button><button type="submit" name="sort_by_cities_DESC">Sort DESC</button></th>
    <th>#Theaters <button type="submit" name="sort_by_theaters_ASC">Sort ASC</button><button type="submit" name="sort_by_theaters_DESC">Sort DESC</button></th>
    <th>#Employee <button type="submit" name="sort_by_employee_ASC">Sort ASC</button><button type="submit" name="sort_by_employee_DESC">Sort DESC</button></th>
  </tr>
</thead>
<tbody>
        <?php if ($result) {?>
        <?php foreach ($result as $row) { ?>
          <tr>
            <td><input type="checkbox" name="selectedCom" value="<?php echo $row["comName"]; ?>"/></td>
            <td><?php echo escape($row["comName"]); ?></td>
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
