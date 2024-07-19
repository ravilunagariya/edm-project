<?php require 'topbar.php'?>
<?php
if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
 $success = false;
 $showerror = false;
 $cat_id = $_POST['cat_id'];
 $subcat_name = $_POST['subcategoryname'];

 $sql = mysqli_query($conn,"SELECT * FROM sub_category WHERE name='".$subcat_name."' AND  category_id = '".$cat_id."'") or die("SQL Query Failed.");
 $existnumrows = mysqli_num_rows($sql);
 if($existnumrows > 0){
  $showerror = "Sub-Category already Exist.";
}elseif (!isset($cat_id) || empty($cat_id)){
  $showerror = "Please Enter Category";
}elseif (!isset($subcat_name) || empty($subcat_name)){
  $showerror = "Please Enter Sub-Category";
}else{
  $sql= mysqli_query($conn,"INSERT INTO `sub_category` ( `category_id`, `name`) VALUES ('".$cat_id."', '".$subcat_name."')")or die("SQL Query Failed.");
  if($sql){
    $success = true;
  }else{
    $showerror = "SQL Query Failed.";
  }
}
}else{
 $success = "";
 $showerror = "";
}
?>
<!-- ============================================================== -->
<!--            Content Start             -->
<!-- ============================================================== -->
<div class="row page-header"><div class="col-lg-6 align-self-center ">
  <h2>Add Product</h2>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a href="add-childcategory.php">ADD-Sub-Category</a></li>
  </ol></div></div>

  <section class="main-content">
    <?php 
    
    if($success){
      echo '<div class="alert bg-success alert-dismissible " role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Success!</strong> childcategory successfully added. </div>';
    }
    if($showerror){
      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> '.$showerror.'
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>'; 
    }

    ?>

    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header card-default">
            Add Sub-Category
            <p class="text-muted">Main Sub-Category</p>
          </div>
        </div>
      </div>
    </div>

    <form class="form-horizontal" method="POST">
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
        <label>Sub-Category Name</label>
        <input type="text" placeholder="Sub-Category name" id="subcategoryname" name="subcategoryname" class="form-control form-control-rounded">
      </div>
      <div class="buttons margin-b-20">
       <input name="submit" type="submit" class="btn btn-primary btn-border " value="submit">
     </div>

   </form>
 </section>




 <?php require 'footer.php'?>