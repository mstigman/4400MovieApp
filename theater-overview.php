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

<h1>Theater Overview</h1>

<form action="" method="" id="filter_form">
   Movie Name <input type="text" name="movie_name">
<br><br>
  # Movie Duration:  <input type="text" name="duration_lower" maxlength="4" size="4">&nbsp;
  -- <input type="text" name="duration_upper" maxlength="4" size="4">&nbsp;
<br><br>
  # Movie Release Date:  <input type="text" name="release_lower" maxlength="11" size="11">&nbsp;
  -- <input type="text" name="release_upper" maxlength="11" size="11">&nbsp;
<br><br>
  # Movie Play Date:  <input type="text" name="play_lower" maxlength="11" size="11">&nbsp;
  -- <input type="text" name="play_upper" maxlength="11" size="11">&nbsp;
<br><br>
<input type="radio" name="not_played_movie" value="male"> Only Include Not Played Movie
<br><br>

<input type="submit" value="Filter" name="submit_filters" style="height:80px; width:80px">
</form>
<br>
<hr>
<table>
    <thead>
  <tr>
    <th>Movie Name </th>
    <th>Duration </th>
    <th>Release Date </th>
    <th>Play Date </th>
  </tr>
</thead>
<tbody>
  <tr>
    <td>The Only Theater</td>
    <td>Smith</td>
    <td>50</td>
    <td>pending</td>
  </tr>
  <tr>
    <td>Eve</td>
    <td>Jackson</td>
    <td>94</td>
    <td>pending</td>
</tbody>
</table>
<hr>
<br>
&nbsp;&nbsp;<button type="button" onclick="history.back();" name="back_btn" style="height:40px; width:40px">Back</button>

</body>
</html>
