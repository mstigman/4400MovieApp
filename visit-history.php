<?php
    require "./config.php";
    require "./common.php";
?>

<?php
// Initial data for the table without filters   
    $result = 0; 
    try {
        session_start();

        $connection = new PDO($dsn, $username, $password, $options);
        $username = $_SESSION['username'];
        $sql = "SELECT thName, thStreet, thCity, thState, thZipcode, comName, visitDate
        FROM uservisit NATURAL JOIN theater
        WHERE (username = $username)";

        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    
?>


<?php
    $result = 0;
    if (isset($_POST['Submit'])) {
        try {
            session_start();

            $connection = new PDO($dsn, $username, $password, $options);
            $param = array(
            "user"            => $_SESSION['username'],
            "visit_date_lower" => $_POST['visit_date_lower'],
            "visit_date_upper" => $_POST['visit_date_upper']
            );
            $args = implode("','", $param);

            $sql = "CALL user_filter_visitHistory('$args')";


            $statement = $connection->prepare($sql);
            $statement->execute();

            $result = $statement->fetchAll();
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
?>

<?php
/**
  * Function to query information based on
  * a parameter: in this case, company.
  *
  */
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT * FROM company";
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

<h1>Visit History</h1>

<form id="filter_form" method="post">
Company Name: <select name="company" form="filter_form">
    <?php foreach($companies as $company): ?>
        <option value="<?= $company['comName']; ?>"><?= $company['comName']; ?></option>
    <?php endforeach; ?>
</select>
<br><br>

# Visit Date:  <input type="text" name="visit_date_lower" maxlength="11" size="11">&nbsp;
  -- <input type="text" name="visit_date_upper" maxlength="11" size="11">&nbsp;
<br><br>
<input type="submit" value="Filter" name="Submit" style="height:80px; width:80px">
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
    <?php if ($result) { ?>
    <?php foreach ($result as $row) { ?>
      <tr>
        <td><?php echo escape($row["thName"]); ?>
        <td><?php echo $row["thStreet"], ', ', $row['thCity'], ', ', $row['thState'], ' ', $row['thZipcode']; ?></td>
        <td><?php echo escape($row["comName"]); ?></td>
        <td><?php echo escape($row["visitDate"]); ?></td>
      </tr>
    <?php } ?>
  <?php } ?>
  </tbody>
</table>

<hr>

&nbsp;&nbsp;<button type="button" onclick="history.back();" name="back_btn" style="height:40px; width:40px">Back</button>

</body>
</html>
