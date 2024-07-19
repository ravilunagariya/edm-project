<?php
include 'dbconnect.php';
$productname = str_replace("'","`",mysqli_real_escape_string($conn,$_POST['productname']));
$cat_id = mysqli_real_escape_string($conn,$_POST['cat_id']);
$subcat_id = mysqli_real_escape_string($conn,$_POST['subcat_id']);
$childcat_id = mysqli_real_escape_string($conn,$_POST['childcat_id']);
$color = mysqli_real_escape_string($conn,$_POST["color"]);
$cur_price = mysqli_real_escape_string($conn,$_POST['cur_price']);
$prev_price = mysqli_real_escape_string($conn,$_POST['prev_price']);
$Stock = mysqli_real_escape_string($conn,$_POST['Stock']);
$tag = mysqli_real_escape_string($conn,$_POST['tag']);
$off = mysqli_real_escape_string($conn,$_POST['off']);
$description =str_replace("'","`", mysqli_real_escape_string($conn,$_POST["description"]));
$image = mysqli_real_escape_string($conn,$_POST["edit_img"]);
if(isset($_FILES['image'])){
	$image = $_FILES["image"]['name'];
	$image_type = $_FILES["image"]['type'];
	$image_size = $_FILES["image"]['size'];
	$image_tmp = $_FILES["image"]['tmp_name'];
	move_uploaded_file($image_tmp, "../Master/img/".$image);

}
$stock_status = mysqli_real_escape_string($conn,$_POST['stock_status']);
$pro_id = mysqli_real_escape_string($conn,$_POST['pro_id']);

if(isset($_POST['productname']) || isset($_POST['cat_id']) || isset($_POST['subcat_id'])|| isset($_POST['childcat_id']) || isset($_POST["color"]) || isset($_POST['cur_price']) || isset($_POST['prev_price']) || isset($_POST['Stock']) || isset($_POST['tag']) ||  isset($_POST['off']) || isset($_POST["description"]) ||  isset($_POST["image"]) || isset($_POST['stock_status'])){
	$query =mysqli_query($conn, "UPDATE tbl_product SET `category_id`='".$cat_id."',`sub_category_id`='".$subcat_id."',`child_category_id`='".$childcat_id."',`name`='".$productname."',`tag`='".$tag."',`color`='".$color."',`off`='".$off."',`stock`='".$Stock."',`stock_status`='".$stock_status."',`description`='".$description."',`curr_price`='".$cur_price."',`prev_price`='".$prev_price."',`image`='".$image."' WHERE `id`='".$pro_id."'") or die("SQL Query Failed.");
	if($query){
		echo $success = true;
	  }else{
		 $showerror = "SQL Query Failed.";
	  }
}
?>