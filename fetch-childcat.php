<?php
include "dbconnect.php";
$subcategory_id = $_POST["subcategory_id"];
$result = mysqli_query($conn,"select * from child_category WHERE sub_category_id='".$subcategory_id."'");
while($row = mysqli_fetch_array($result)) {
	?>
	<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
	<?php
}
?>