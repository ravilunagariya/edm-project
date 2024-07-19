<?php include 'dbconnect.php'; ?>
<?php
$tbl_name = $_GET['tbl'];
$id = $_GET['id'];


$sql = mysqli_query($conn,"UPDATE $tbl_name SET is_deleted='1' WHERE id=$id");

switch ($tbl_name) {
	case 'category':
		echo '<script>window.location="show-category.php"</script>';
	case 'sub_category':
		echo '<script>window.location="show-subcategory.php"</script>';
	case 'child_category':
		echo '<script>window.location="show-childcategory.php"</script>';
	case 'users':
		echo '<script>window.location="show-user.php"</script>';
	case 'tbl_product':
		echo '<script>window.location="show-product.php"</script>';
	case 'offer':
		echo '<script>window.location="show-offer.php"</script>';
	case 'carousel':
		echo '<script>window.location="view-carousel.php"</script>';
	
	default:
		echo $sql;
		break;
}

?>