<?php
require 'topbar.php';
if(isset($_GET['edit_product'])){
	$showalert = false;
	$showerror = false;
	$edit_id = $_GET['edit_product'];
	$get_product = "select * from tbl_product where id='$edit_id'";
	$product_edit = mysqli_query($conn,$get_product) or die("SQL Query Failed.");
	$rows = mysqli_fetch_assoc($product_edit);
	$edit_productname = $rows["name"];
	$edit_cat_id = $rows['category_id'];
	$edit_subcat_id = $rows['sub_category_id'];
	$edit_childcat_id = $rows["child_category_id"];
	$edit_color = $rows["color"];
	$edit_cur_price = $rows["curr_price"];
	$edit_prev_price = $rows["prev_price"];
	$edit_Stock = $rows["stock"];
	$edit_tag = $rows["tag"];
	$edit_off = $rows["off"];
	$edit_description =$rows["description"];	
	$stock_status = $rows["stock_status"];
	$edit_image = $rows["image"];
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

						<form method="POST"  class="form-horizontal" id="updatepro" enctype="multipart/form-data">
							<div class="form-group">
								<label for="CATEGORY-DROPDOWN">Category</label>
								<select class="form-control" name="cat_id" id="category-dropdown">
									<?php
									$catresult = mysqli_query($conn,"select * from category WHERE id='".$edit_cat_id."'");
									$catrow = mysqli_fetch_array($catresult);
									?>
									<option value="<?php echo $edit_cat_id; ?>"><?php echo $catrow['name'];?></option>
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
							<input type="hidden" name="pro_id" value="<?php echo $edit_id; ?>">

							<div class="form-group">
								<label for="SUBCATEGORY-DROPDOWN">Sub-Category</label>
								<select class="form-control" name="subcat_id" id="subcategory-dropdown" >
									<?php
									$subcatresult = mysqli_query($conn,"select * from sub_category WHERE id='".$edit_subcat_id."'");
									$subcatrow = mysqli_fetch_array($subcatresult);
									?>
									<option value="<?php echo $edit_subcat_id; ?>"><?php echo $subcatrow['name'];?></option>
								</select>
							</div>
							<div class="form-group">
								<label for="CHILD-CATEGORY-DROPDOWN">Child-Category</label>
								<select class="form-control" name="childcat_id" id="childcategory-dropdown" >
									<?php
									$childcatresult = mysqli_query($conn,"select * from child_category WHERE id='".$edit_childcat_id."'");
									$childcatrow = mysqli_fetch_array($childcatresult);
									?>
									<option value="<?php echo $edit_childcat_id; ?>"><?php echo $childcatrow['name'];?></option>
								</select>
								<small class="text-muted">Select Child Category Of Product.</small>
							</div>
							<div class="form-group">
								<label for="color-DROPDOWN">color</label>
								<input type="color" id="favcolor" name="color" value="<?php echo $edit_color; ?>">
								<small class="text-muted">Select color Of Product.</small>
							</div>
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" id="productname" name="productname" value="<?php echo $edit_productname; ?>" class="form-control form-control-rounded">
							</div>
							<div class="form-group">
								<label>Product Tag</label>
								<div class="row">
									<div class="radio radio-success">
										<input type="radio" name="tag" id="radio10" value="new" checked="">
										<label for="radio10"> New </label>
									</div>
									<div class="radio radio-danger">
										<input type="radio" name="tag" id="radio20" value="sale">
										<label for="radio20"> Sale </label>
									</div>
									<div class="radio radio-warning">
										<input type="radio" name="tag" id="radio30" value="hot">
										<label for="radio30"> Hot </label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Product Offer</label>
								<input type="text" value="<?php echo $edit_off; ?>" id="off" name="off" class="form-control form-control-rounded">
							</div>
							<div class="form-group">
								<label>Current Price</label>
								<div class="input-group col-md-4">
									<span class="input-group-addon"><i class="fa fa-inr"></i></span>
									<input type="text" value="<?php echo $edit_cur_price; ?>" name="cur_price"   id="cur_price" class="form-control">
									<span class="input-group-addon">.00</span>
								</div>     	
							</div>

							<div class="form-group">
								<label>Previous Price</label>
								<div class="input-group col-md-4">
									<span class="input-group-addon"><i class="fa fa-inr"></i></span>
									<input type="text" value="<?php echo $edit_prev_price; ?>" name="prev_price" id="prev_price"  class="form-control">
									<span class="input-group-addon">.00</span>
								</div>
							</div>

							<div class="form-group">
								<label>Stock</label>
								<input type="text" value="<?php echo $edit_Stock; ?>" name="Stock" id="stock" class="form-control form-control-rounded col-md-4">
							</div>

							<div class="form-group">
								<label>Description</label>
								<textarea class="summernote" style="display: none;"  name="description"  id="description"><?php echo $edit_description; ?></textarea>
							</div>
							<div class="form-group">
								<label>Product Image</label>
								<div class="fileinput-exists" data-provides="fileinput">
									<div class="fileinput-preview" data-trigger="fileinput" style="width: 200px; height:150px;">
										<img class="img-fluid" src="../Master/img/<?php echo $edit_image; ?>">
									</div>
									<span class="btn btn-primary  btn-file">
										<span class="fileinput-new">Select</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" class="image" id="image" name="image">
										<input type="hidden" id="edit_img" name="edit_img" value="<?php echo $edit_image; ?>">
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

							<button type="submit" id="update"  value="update" class="btn btn-success btn-icon"><!-- <a href="show-product.php"> --><i class="fa fa-floppy-o "></i>Save<!-- </a> --></button>
							<button data-dismiss="fileinput" class="btn btn-danger btn-icon"><i class="fa fa-times"></i>Cacnel</button>		

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

		$("#updatepro").on("submit",function(e){
			e.preventDefault();
			// var pro_id = '<?php echo $edit_id; ?>';
			// var productname = $("#productname").val();
			// var cat_id = $("#category-dropdown").val();
			// var subcat_id = $("#subcategory-dropdown").val();
			// var childcat_id = $("#childcategory-dropdown").val();
			// var color = $("#favcolor").val();
			// var cur_price = $("#cur_price").val();
			// var prev_price = $("#prev_price").val();
			// var Stock = $("#stock").val();
			// var tag = $('input[name="tag"]:checked').val();
			// var off = $("#off").val();
			// var description = $("#description").val();
			// var edit_img = $("#edit_img").val();
			// var image = $("#image").val();
			// var stock_status = $('input[name="stock_status"]:checked').val();
			// var productdata = {'pro_id':pro_id,'productname':productname,'cat_id':cat_id,'subcat_id':subcat_id,'childcat_id':childcat_id,'color':color,'cur_price':cur_price,'prev_price':prev_price,'Stock':Stock,'tag':tag,'off':off,'description':description,'edit_img':edit_img,'image':image,'stock_status':stock_status};
			// console.log(productdata);

			$.ajax({
				url:'update-product.php',
				type:'POST',
				data:new FormData(this),
				success:function(data){
					if(data == "" || data == null){
						console.log("Not saved.");
					}else{
						console.log(data);
						alert('Product has been updated successfully');
						window.open('show-product.php','_self');
					}
				},
				contentType: false,
				cache: false,
				processData:false,
			});

		});
	</script>
	<?php require 'footer.php'?>
	

