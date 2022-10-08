<?php
require("inc/config.php");
require(MYSQL);
$lga_id = $_POST["lga_id"];
$q = "SELECT * FROM ward WHERE ward_id LIKE '%-$lga_id-%' ";
$result = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
?>
<option value="">Select Ward</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
<option value="<?php echo $row["ward_id"];?>"><?php echo $row["ward_name"];?></option>
<?php
}
?>