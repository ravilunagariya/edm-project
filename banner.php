<?php require 'topbar.php'?>
<?php
if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
	$showalert = false;
	$showerror = false;
	$bannername = str_replace("'","`",$_POST["bannername"]);
	$offer =str_replace("'","`", $_POST["offer"]);
	 // Upload file
	if(isset($_FILES['banner1'])){
		$banner1 = $_FILES["banner1"]['name'];
		$banner1_type = $_FILES["banner1"]['type'];
		$banner1_size = $_FILES["banner1"]['size'];
		$banner1_tmp = $_FILES["banner1"]['tmp_name'];
		move_uploaded_file($banner1_tmp, "../Master/img/carousel/".$banner1);

	}
	if(isset($_FILES['banner2'])){
		$banner2 = $_FILES["banner2"]['name'];
		$banner2_type = $_FILES["banner2"]['type'];
		$banner2_size = $_FILES["banner2"]['size'];
		$banner2_tmp = $_FILES["banner2"]['tmp_name'];
		move_uploaded_file($banner2_tmp, "../Master/img/carousel/".$banner2);

	}
	if(isset($_FILES['banner3'])){
		$banner3 = $_FILES["banner3"]['name'];
		$banner3_type = $_FILES["banner3"]['type'];
		$banner3_size = $_FILES["banner3"]['size'];
		$banner3_tmp = $_FILES["banner3"]['tmp_name'];
		move_uploaded_file($banner3_tmp, "../Master/img/carousel/".$banner3);

	}

	
	if (!isset($bannername) || !isset($offer)  || !isset($banner1)||  !isset($banner2) ||  !isset($banner3) || empty($bannername) || empty($offer) || empty($banner1)  ||  empty($banner2) || empty($banner3) ){
		$showerror = "Please Enter Details";
	}else{
		
		$sql = "UPDATE banners SET `banner_1`='".$banner1."',`banner_2`='".$banner2."',`banner_3`='".$banner3."',`name`='".$bannername."',`offer`='".$offer."' WHERE `id`='1'";

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
	<h2>Add Banner</h2>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="home.php">Home</a></li>
		<li class="breadcrumb-item active">Add Banner</li>
	</ol></div></div>
	<section class="main-content">
		<?php 
		if($showalert){
			echo '<div class="alert alert-success alert-dismissible margin-b-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Success !</strong> Banner successfully added.</div>'; 
		}
		if($showerror){
			echo '<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
			<strong>Error !</strong> '.$showerror.'</div>'; 
		}

		$bannersql = "SELECT * FROM banners  WHERE id='1'";
		$bannerresult = mysqli_query($conn,$bannersql) or die("SQL Query Failed.");
		$bannerrow = mysqli_fetch_assoc($bannerresult);
		$banner1 = $bannerrow["banner_1"];
		$banner2 = $bannerrow["banner_2"];
		$banner3 = $bannerrow["banner_3"];
		$bannername = $bannerrow["name"];
		$offer = $bannerrow["offer"];
		?>

		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header card-default">
						Add Banner
						<p class="text-muted">Add New Banner Here</p>
					</div>
					<div class="card-body">

						<form method="POST"  class="form-horizontal" enctype="multipart/form-data">
							<div class="form-group">
								<label>Banner 1</label>
								<div class="fileinput-exists" data-provides="fileinput">
									<div class="fileinput-preview" data-trigger="fileinput" style="width: 200px; height:150px;">
										<img class="img-fluid" src="../Master/img/banner/<?php echo $banner1 ?>">
									</div>
									<span class="btn btn-primary  btn-file">
										<span class="fileinput-new">Select</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" class="banner1" name="banner1">
									</span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
							<div class="form-group">
								<label>Banner 2</label>
								<div class="fileinput-exists" data-provides="fileinput">
									<div class="fileinput-preview" data-trigger="fileinput" style="width: 200px; height:150px;">
										<img class="img-fluid" src="../Master/img/banner/<?php echo $banner2 ?>">
									</div>
									<span class="btn btn-primary  btn-file">
										<span class="fileinput-new">Select</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" class="banner2" name="banner2">
									</span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>

							<div class="form-group">
								<label>Banner 3</label>
								<div class="fileinput-exists" data-provides="fileinput">
									<div class="fileinput-preview" data-trigger="fileinput" style="width: 200px; height:150px;">
										<img class="img-fluid" src="../Master/img/banner/<?php echo $banner3 ?>">
									</div>
									<span class="btn btn-primary  btn-file">
										<span class="fileinput-new">Select</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" class="banner3" name="banner3">
									</span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>

							<div class="form-group">
								<label>Banner Name</label>
								<textarea class="summernote" style="display: none;"  name="bannername" ><?php echo $bannername; ?></textarea>
							</div>

							<div class="form-group">
								<label>Offer</label>
								<textarea class="summernote" style="display: none;"  name="offer"  id="offer"><?php echo $offer; ?></textarea>
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
			
		});
	</script>
	<?php require 'footer.php'?>