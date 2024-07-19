<?php
require 'topbar.php';
$carousel_id = $_GET['edit_product'];
$sql = "SELECT * FROM carousel  WHERE id='".$carousel_id."'";
$result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
$row = mysqli_fetch_assoc($result);
$product_id = $row["product_id"];
$tagname =$row["tagname"];
$name =$row["name"];
$description =$row["description"];
$images = $row["images"];

?>
<div class="row page-header"><div class="col-lg-6 align-self-center ">
	<h2>Update Carousel</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="home.php">Home</a></li>
		<li class="breadcrumb-item active">Update Carousel</li>
	</ol></div></div>
	<section class="main-content">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header card-default">
						Update Carousel
						<p class="text-muted">Update New Carousel Here</p>
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
									<?php
									$proresult = mysqli_query($conn,"select * from tbl_product WHERE id='".$product_id."'");
									$prorow = mysqli_fetch_array($proresult)
									?>
									<option value="<?php echo $prorow['id'];?>"><?php echo $prorow['name'];?></option>
									
								</select>
								<small class="text-muted">Select Product Id.</small>
							</div>
							<div class="form-group">
								<label>Tage Name</label>
								<input type="text" id="tagname" value="<?php echo $tagname;?>" class="form-control form-control-rounded">
							</div>

							<div class="form-group">
								<label>Carousel Name</label>
								<textarea class="summernote" style="display: none;"   id="carouselname" ><?php echo $name;?></textarea>
							</div>

							<div class="form-group">
								<label>Description</label>
								<textarea class="summernote" style="display: none;"  id="description" ><?php echo $description;?></textarea>
							</div>

							<div class="form-group">
								<label>Product Image</label>
								<div class="fileinput-exists" data-provides="fileinput">
									<div class="fileinput-preview" data-trigger="fileinput" style="width: 200px; height:150px;">
										<img class="img-fluid" src="../Master/img/<?php echo $images; ?>">
									</div>
									<span class="btn btn-primary  btn-file">
										<span class="fileinput-new">Select</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" id="image" name="image">
									</span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>

							<button type="button" id="update" value="submit" class="btn btn-success btn-icon"><i class="fa fa-floppy-o "></i>Save</button>
							<button data-dismiss="fileinput" class="btn btn-danger btn-icon"><a href="view-carousel.php"></a><i class="fa fa-times"></i>Cancel</button>		

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
		$("#update").on("click",function(){
			var carouselid = '<?php echo $carousel_id; ?>';
			var productid =$('#product-dropdown').val().trim();
			var tagname=$('#tagname').val().trim();
			var name=$('#carouselname').val().trim();
			var description=$('#description').val().trim();
			var image=$('#image').attr('value');
			var formdata = {carouselid:carouselid,productid:productid,tagname:tagname,name:name,description:description,image:image};
			console.log(formdata);
			$.ajax({
				url:'edit-carousel.php',
				type:'POST',
				data:formdata,
				success:function(data){
					if(data == "" || data == null){
						console.log("Not saved.");
					}else{
						console.log(data);
						alert('Product has been updated successfully');
						window.open('view-carousel.php','_self');
					}
				}
			});
		});
	</script>
	<?php require 'footer.php'?>
	<?php
	if(isset($_FILES['image'])){
		$image = $_FILES["image"]['name'];
		$image_type = $_FILES["image"]['type'];
		$image_size = $_FILES["image"]['size'];
		$image_tmp = $_FILES["image"]['tmp_name'];
		move_uploaded_file($image_tmp, "../Master/img/".$image);

		echo $image;
		die();

	}
	if(isset($_POST['productid']) && isset($_POST['tagname'])&& isset($_POST['name'])&& isset($_POST['description'])&& isset($_POST['image'])&& isset($_POST['carouselid'])){
		$carouselid = mysqli_real_escape_string($conn,$_POST['carouselid']);
		$productid = mysqli_real_escape_string($conn,$_POST['productid']);
		$tagname = mysqli_real_escape_string($conn,$_POST['tagname']);
		$name = mysqli_real_escape_string($conn,$_POST['name']);
		$description = mysqli_real_escape_string($conn,$_POST['description']);
		$image = mysqli_real_escape_string($conn,$_POST['image']);
		$query =mysqli_query($conn, "UPDATE carousel SET product_id='".$productid."',tagname='".$tagname."',images='".$image."',name='".$name."',description='".$description."' WHERE id='".$carouselid."'")or die("SQL Query Failed.");
		mysqli_close($conn);
	}
	?> 
