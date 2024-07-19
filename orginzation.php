<?php require 'topbar.php';
?>
<?php
if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
  $showalert = false;
  $showerror = false;
  $orginzationname = $_POST["orginzationname"];
  $address = $_POST["address"];
  $email = $_POST["email"];
  $phone1 = $_POST["phone1"];
  $phone2 = $_POST["phone2"];
  if(isset($_FILES['logo'])){
    $logo = $_FILES["logo"]['name'];
    $logo_type = $_FILES["logo"]['type'];
    $logo_size = $_FILES["logo"]['size'];
    $logo_tmp = $_FILES["logo"]['tmp_name'];
    move_uploaded_file($logo_tmp, "../Master/img/logo/".$logo);

  }
  if(isset($_FILES['icon'])){
    $icon = $_FILES["icon"]['name'];
    $icon_type = $_FILES["icon"]['type'];
    $icon_size = $_FILES["icon"]['size'];
    $icon_tmp = $_FILES["icon"]['tmp_name'];
    move_uploaded_file($icon_tmp, "../Master/img/logo/".$icon);

  }
  if (!isset($orginzationname) || !isset($email) || !isset($address) || empty($email) || empty($phone1) ||  empty($orginzationname) ||  !isset($phone1) || empty($address) || !isset($phone2) || empty($phone2) || !isset($logo) || empty($logo) || !isset($icon) || empty($icon)){
    $showerror = "Please Enter Valid Details";
  }else{
    $sql = "UPDATE orginzation SET `orginzationname`='".$orginzationname."',`address`='".$address."',`email`='".$email."',`phone1`='".$phone1."',`phone2`='".$phone2."',`logo`='".$logo."',`icon`='".$icon."' WHERE `id`='1'";
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
    echo '<div class="alert bg-success alert-dismissible " role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Success!</strong> Change Orginzation Successfully. </div>'; 
  }
  if($showerror){
    echo '<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
    <strong>Error !</strong> '.$showerror.'</div>'; 
  }


  $sql = "SELECT * FROM orginzation  WHERE id='1'";
  $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
  $row = mysqli_fetch_assoc($result);
  $oname = $row["orginzationname"];
  $oaddress = $row["address"];
  $oemail = $row["email"];
  $ophone1 = $row["phone1"];
  $ophone2 = $row["phone2"];
  $ologo = $row["logo"];
  $oicon = $row["icon"];

  ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header card-default">
          <h1 class="text-center">Edit Orginzation</h1>
        </div>
        <div class="card-body">
          <form class="form-horizontal"  novalidate="novalidate" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="orginzationname">Orginzation Name</label>
              <input type="text" class="form-control"  name="orginzationname" value="<?php echo $oname ?>"  />
            </div>

            <div class="form-group">
              <label for="address">address</label>
              <textarea class="form-control" name="address"><?php echo $oaddress ?></textarea>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control"  name="email" value="<?php echo $oemail ?>" />
            </div>

            <div class="form-group">
              <label for="phone1">Phone1</label>
              <input type="text" maxlength="10" minlength="10" class="form-control"  name="phone1" value="<?php echo $ophone1 ?>" />
            </div>

            <div class="form-group">
              <label for="phone2">Phone2</label>
              <input type="text" maxlength="10" minlength="10" class="form-control" name="phone2" value="<?php echo $ophone2 ?>" />
            </div>



            <div class="form-group">
              <label>Logo</label>
              <div class="fileinput-exists" data-provides="fileinput">
                <div class="fileinput-preview" data-trigger="fileinput" style="width: 200px; height:150px;">
                  <img class="img-fluid" src="../Master/img/logo/<?php echo $ologo ?>">
                </div>
                <span class="btn btn-primary  btn-file">
                  <span class="fileinput-new">Select</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" id="logo" name="logo" value="<?php echo $ologo ?>">
                </span>
                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
            <div class="form-group">
              <label>Icon</label>
              <div class="fileinput-exists" data-provides="fileinput">
                <div class="fileinput-preview" data-trigger="fileinput" style="width: 200px; height:150px;">
                  <img class="img-fluid" src="../Master/img/logo/<?php echo $oicon ?>">
                </div>
                <span class="btn btn-primary  btn-file">
                  <span class="fileinput-new">Select</span>
                  <span class="fileinput-exists">Change</span>
                  <input type="file" id="icon" name="icon" value="<?php echo $oicon ?>">
                </span>
                <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>

            <div class="form-group">

              <button type="submit" class="btn btn-primary"  name="submit" value="submit">Submit</button>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require 'footer.php';
?>