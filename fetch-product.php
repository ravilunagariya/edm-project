<?php
include "dbconnect.php";
$childcategory_id = $_POST["childcategory_id"];
$childresult = mysqli_query($conn,"select * from tbl_product WHERE child_category_id='".$childcategory_id."'");
while($childrow = mysqli_fetch_array($childresult)) {
	?>
	<option value="<?php echo $childrow['id'];?>"><?php echo $childrow['name'];?></option>
	<?php
}
mysqli_close($conn);
?>
