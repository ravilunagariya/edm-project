<?php require 'topbar.php'?>
<?php
if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
	$showalert = false;
	$showerror = false;
	$productname = str_replace("'","`",$_POST["productname"]);
	$cat_id = $_POST['cat_id'];
	$subcat_id = $_POST['subcat_id'];
	$childcat_id = $_POST["childcat_id"];
	$color = $_POST["color"];
	$cur_price = $_POST["cur_price"];
	$prev_price = $_POST["prev_price"];
	$Stock = $_POST["Stock"];
	$tag = $_POST["tag"];
	$color = $_POST["color"];
	$off = $_POST["off"];
	$description =str_replace("'","`", $_POST["description"]);
	 // Upload file
	if(isset($_FILES['image'])){
		$image = $_FILES["image"]['name'];
		$image_type = $_FILES["image"]['type'];
		$image_size = $_FILES["image"]['size'];
		$image_tmp = $_FILES["image"]['tmp_name'];
		move_uploaded_file($image_tmp, "../Master/img/".$image);

	}
	if(isset($_FILES['multi_image'])){

		for ($i=0; $i <sizeof($_FILES['multi_image']['name']) ; $i++) { 
			$multi_image = $_FILES["multi_image"]['name'][$i];
			$multi_image_type = $_FILES["multi_image"]['type'][$i];
			$multi_image_size = $_FILES["multi_image"]['size'][$i];
			$multi_image_tmp = $_FILES["multi_image"]['tmp_name'][$i];
			move_uploaded_file($multi_image_tmp, "../Master/multi-img/".$multi_image);
		}
		$multiple_img=implode(',', $_FILES["multi_image"]['name']);
	}
	

	$stock_status = $_POST["stock_status"];
	
	if (!isset($productname) || !isset($childcat_id) || !isset($tag)|| !isset($off) || !isset($color)||  !isset($cur_price)  ||!isset($prev_price) || !isset($Stock) || !isset($description)||  !isset($image) || !isset($stock_status)|| !isset($multiple_img) || empty($multiple_img) || empty($productname) || empty($childcat_id) ||  empty($color) || empty($cur_price)|| empty($off)|| empty($prev_price)|| empty($tag) || empty($Stock) ||  empty($description) || empty($image)|| empty($stock_status)){
		$showerror = "Please Enter Details";
	}else{
		$sql = "INSERT INTO `tbl_product` (`name`,`category_id`,`sub_category_id`, `child_category_id`,`color`,`tag`,`off`,`curr_price`,`prev_price`,`stock`, `description`,`image`,`multi_img`,`stock_status`) VALUES ('".$productname."','".$cat_id."','".$subcat_id."','".$childcat_id."','".$color."','".$tag."','".$off."', '".$cur_price."', '".$prev_price."', '".$Stock."', '".$description."', '".$image."','".$multiple_img."', '".$stock_status."')";
		
		$result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
		if($result){
			$showalert = true;
		}
	}
}else{
	$showerror = "";
	$showalert = "";
}
?>

<div class="row page-header"><div class="col-lg-6 align-self-center ">
	<h2>Add Product</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="home.php">Home</a></li>
		<li class="breadcrumb-item active">Add Product</li>
	</ol></div></div>
	<section class="main-content">
		<?php 
		if($showalert){
			echo '<div class="alert alert-success alert-dismissible margin-b-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Success !</strong> Product successfully added.</div>'; 
		}
		if($showerror){
			echo '<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
			<strong>Error !</strong> '.$showerror.'</div>'; 
		}
		?>

		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header card-default">
						Add Products
						<p class="text-muted">Add New Product Here</p>
					</div>
					<div class="card-body">

						<form method="POST"  class="form-horizontal" enctype="multipart/form-data">
							<div class="form-group">
								<label for="CATEGORY-DROPDOWN">Category</label>
								<select class="form-control" id="category-dropdown" name="cat_id">
									<option value="">Select Category</option>
									<?php
									$result = mysqli_query($conn,"select * from category WHERE is_deleted='0'");
									while($row = mysqli_fetch_array($result)) {
										?>
										<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
										<?php
									}
									?>
								</select>
							</div>

							<div class="form-group">
								<label for="SUBCATEGORY-DROPDOWN">Sub-Category</label>
								<select class="form-control" id="subcategory-dropdown" name="subcat_id">
									<option value="">Select Sub-Category</option>

								</select>
							</div>
							<div class="form-group">
								<label for="CHILD-CATEGORY-DROPDOWN">Child-Category</label>
								<select class="form-control" id="childcategory-dropdown" name="childcat_id">
									<option value="">Select Child-Category</option>
									
								</select>
								<small class="text-muted">Select Child Category Of Product.</small>
							</div>
							<div class="form-group">
								<label for="color-DROPDOWN">color</label>
								<input type="color" id="favcolor" name="color" value="#ff0000">
								<small class="text-muted">Select color Of Product.</small>
							</div>
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" name="productname" placeholder="New product name" class="form-control form-control-rounded">
							</div>
							<div class="form-group">
								<label>Product Tag</label>
								<div class="row">
									<div class="radio radio-success">
										<input type="radio" name="tag" id="radio1" value="new" checked="">
										<label for="radio1"> New </label>
									</div>
									<div class="radio radio-danger">
										<input type="radio" name="tag" id="radio2" value="sale">
										<label for="radio2"> Sale </label>
									</div>
									<div class="radio radio-warning">
										<input type="radio" name="tag" id="radio3" value="hot">
										<label for="radio3"> Hot </label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Product Offer</label>
								<input type="text" name="off" placeholder="New product offer" class="form-control form-control-rounded">
							</div>
							<div class="form-group">
								<label>Current Price</label>
								<div class="input-group col-md-4">
									<span class="input-group-addon"><i class="fa fa-inr"></i></span>
									<input type="text" name="cur_price" class="form-control">
									<span class="input-group-addon">.00</span>
								</div>     	
							</div>

							<div class="form-group">
								<label>Previous Price</label>
								<div class="input-group col-md-4">
									<span class="input-group-addon"><i class="fa fa-inr"></i></span>
									<input type="text" name="prev_price" class="form-control">
									<span class="input-group-addon">.00</span>
								</div>
							</div>

							<div class="form-group">
								<label>Stock</label>
								<input type="text" name="Stock" class="form-control form-control-rounded col-md-4">
							</div>

							<div class="form-group">
								<label>Description</label>
								<textarea class="summernote" style="display: none;"  name="description"  id="description"></textarea>
							</div>

							<div class="form-group">
								<label>Product Image</label>
								<div class="fileinput-new" data-provides="fileinput">
									<div class="fileinput-preview" data-trigger="fileinput" style="width: 200px; height:150px;"></div>
									<span class="btn btn-primary  btn-file">
										<span class="fileinput-new">Select</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" id="image" name="image">
									</span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
							<div class="form-group">
								<label>Multipal Product Image</label>
								<div class="fileinput-new" data-provides="fileinput">
									<div class="fileinput-preview" data-trigger="fileinput" style="width: 200px; height:150px;"></div>
									<span class="btn btn-primary  btn-file">
										<span class="fileinput-new">Select</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" id="multi_image" name="multi_image[]" multiple>
									</span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
							<div class="form-group">
								<label>Stock Status</label>
								<div class="row">
									<div class="radio radio-success">
										<input type="radio" name="stock_status" id="radio1" value="stockin" checked="">
										<label for="radio1"> Stock </label>
									</div>
									<div class="radio radio-danger">
										<input type="radio" name="stock_status" id="radio2" value="removed">
										<label for="radio2"> Removed </label>
									</div>
									<div class="radio radio-warning">
										<input type="radio" name="stock_status" id="radio3" value="outofstock">
										<label for="radio3"> Out of Stock </label>
									</div>
								</div>
							</div>

							<button type="submit" name="submit" value="submit" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Save</button>
							<button data-dismiss="fileinput" class="btn btn-danger btn-icon"><i class="fa fa-times"></i>Cancel</button>		

						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$(document).ready(function() {
			$('.summernote').summernote({
				height:'300px',
				toolbar: [
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough', 'superscript', 'subscript']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']]

				]
			});
			$('button[data-event="showImageDialog"]').attr('data-toggle', 'image').removeAttr('data-event'); 
			$('#category-dropdown').on('change', function() {
				var category_id = this.value;
				console.log(category_id);
				$.ajax({
					url: "fetch-subcat.php",
					type: "POST",
					data: {
						category_id: category_id
					},
					cache: false,
					success: function(result){
  	// console.log(result);
  	$("#subcategory-dropdown").html(result);
  }
});
			});
			$('#subcategory-dropdown').on('change', function() {
				var subcategory_id = this.value;
				console.log(subcategory_id);
				$.ajax({
					url: "fetch-childcat.php",
					type: "POST",
					data: {
						subcategory_id: subcategory_id
					},
					cache: false,
					success: function(result){
  // console.log(result);
  $("#childcategory-dropdown").html(result);
}
});
			});
		});
	</script>
	<?php require 'footer.php'?>