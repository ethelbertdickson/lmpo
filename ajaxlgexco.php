<?php
require("inc/config.php");
require(MYSQL);
$state_id = $_POST["state_id"];

$q = "SELECT lg_id,  lga_name FROM lga where state_id = $state_id";
$result = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
?>
<option value="">Select Polling Unit</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["lga_id"];?>"><?php echo $row["lga_name"];?></option>
<?php
}
?>