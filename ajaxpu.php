<?php
require("inc/config.php");
require(MYSQL);
$ward_id = $_POST["ward_id"];


$q = "SELECT pu_id,  pu_name FROM polling_unit where pu_id LIKE '%$ward_id-%'";
$result = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
?>
<option value="">Select Polling Unit</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["pu_id"];?>"><?php echo $row["pu_name"];?></option>
<?php
}
?>