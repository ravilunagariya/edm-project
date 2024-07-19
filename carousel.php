<?php require 'topbar.php'?>
<?php
if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
	$showalert = false;
	$showerror = false;
	$product_id = $_POST['product_id'];
	$tagname = $_POST["tagname"];
	$carouselname = str_replace("'","`",$_POST["carouselname"]);
	$description =str_replace("'","`", $_POST["description"]);
	 // Upload file
	if(isset($_FILES['image'])){
		$image = $_FILES["image"]['name'];
		$image_type = $_FILES["image"]['type'];
		$image_size = $_FILES["image"]['size'];
		$image_tmp = $_FILES["image"]['tmp_name'];
		move_uploaded_file($image_tmp, "../Master/img/carousel/".$image);

	}

	
	if (!isset($carouselname) || !isset($product_id)  || !isset($description)||  !isset($image) || empty($carouselname) || empty($product_id) || empty($tagname)  ||  empty($description) || empty($image) ){
		$showerror = "Please Enter Details";
	}else{
		$sql = "INSERT INTO `carousel` (`product_id`,`tagname`,`name`, `description`,`images`) VALUES ('".$product_id."','".$tagname."','".$carouselname."','".$description."','".$image."')";

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
	<h2>Add Carousel</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="home.php">Home</a></li>
		<li class="breadcrumb-item active">Add Carousel</li>
	</ol></div></div>
	<section class="main-content">
		<?php 
		if($showalert){
			echo '<div class="alert alert-success alert-dismissible margin-b-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Success !</strong> Carousel successfully added.</div>'; 
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
						Add Carousel
						<p class="text-muted">Add New Carousel Here</p>
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
								<small class="text-muted">Select Category Of Product.</small>
							</div>

							<div class="form-group">
								<label for="SUBCATEGORY-DROPDOWN">Sub-Category</label>
								<select class="form-control" id="subcategory-dropdown" name="subcat_id">
									<option value="">Select Sub-Category</option>

								</select>
								<small class="text-muted">Select Sub Category Of Product.</small>
							</div>
							<div class="form-group">
								<label for="CHILD-CATEGORY-DROPDOWN">Child-Category</label>
								<select class="form-control" id="childcategory-dropdown" name="childcat_id">
									<option value="">Select Child-Category</option>
									
								</select>
								<small class="text-muted">Select Child Category Of Product.</small>
							</div>
							<div class="form-group">
								<label for="PRODUCT-DROPDOWN">Product Id</label>
								<select class="form-control" id="product-dropdown" name="product_id">
									<option value="">Select Product Id</option>
									
								</select>
								<small class="text-muted">Select Product Id.</small>
							</div>
							<div class="form-group">
								<label>Tage Name</label>
								<input type="text" name="tagname" placeholder="New Tag name" class="form-control form-control-rounded">
							</div>

							<div class="form-group">
								<label>Carousel Name</label>
								<textarea class="summernote" style="display: none;"  name="carouselname" ></textarea>
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
				$('#childcategory-dropdown').on('change', function() {
					var childcategory_id = this.value;
					console.log(childcategory_id);
					$.ajax({
						url: "fetch-product.php",
						type: "POST",
						data: {
							childcategory_id: childcategory_id
						},
						cache: false,
						success: function(result){
  // console.log(result);
  $("#product-dropdown").html(result);
}
});
});
			});
		</script>
		<?php require 'footer.php'?>