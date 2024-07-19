<?php
 require 'topbar.php'; 
 ?>
 <?php
 if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
  $showalert = false;
  $showerror = false;
  $facebook = $_POST["facebook"];
  $instagram = $_POST["instagram"];
  $youtube = $_POST["youtube"];
  $google = $_POST["google"];
  $pinterest = $_POST["pinterest"];
  if (!isset($facebook) || !isset($instagram) || !isset($youtube) || empty($facebook) || empty($instagram) ||  empty($youtube) ||  !isset($google) || empty($google) || !isset($pinterest) || empty($pinterest) ){
    $showerror = "Please Enter Valid Details";
  }else{
    $sql = "UPDATE sociallinks SET `facebook`='".$facebook."',`instagram`='".$instagram."',`youtube`='".$youtube."',`google`='".$google."',`pinterest`='".$pinterest."' WHERE `id`='1'";
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
<section class="main-content">
  <?php 
  if($showalert){
    echo '<div class="alert bg-success alert-dismissible " role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Success!</strong> Change Links Successfully. </div>'; 
  }
  if($showerror){
    echo '<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
    <strong>Error !</strong> '.$showerror.'</div>'; 
  }
  $sql = "SELECT * FROM sociallinks  WHERE id='1'";
  $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
  $row = mysqli_fetch_assoc($result);
  $facebook = $row["facebook"];
  $instagram = $row["instagram"];
  $youtube = $row["youtube"];
  $google = $row["google"];
  $pinterest = $row["pinterest"];
  ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header card-default">
          <h1 class="text-center">Social Follow List </h1>
        </div>
        <div class="card-body">
          <form  method="post" class="form-horizontal">
           <div class="form-group">
            <label>Facebook</label>
            <input type="text" class="form-control" name="facebook"  required="required" value="<?php echo $facebook ?>">
          </div>
          <div class="form-group">
            <label>Instagram</label>
            <input type="text" class="form-control" name="instagram" required="required" value="<?php echo $instagram ?>">
          </div>
          <div class="form-group">
            <label>Youtube</label>
            <input type="text" class="form-control" name="youtube"  required="required" value="<?php echo $youtube ?>">
          </div>
          <div class="form-group">
            <label>Google</label>
            <input type="text" class="form-control" name="google"  required="required" value="<?php echo $google ?>">
          </div>
          <div class="form-group">
            <label>Pinterest</label>
            <input type="text" class="form-control" name="pinterest"  required="required" value="<?php echo $pinterest ?>">
          </div>
          <div class="form-group">
            <div class="input-group col-lg-12 col-lg-offset-5 ">
              <input type="submit" class="btn btn-success" name="submit" id="submit">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</section>
<?php require 'footer.php'; ?>