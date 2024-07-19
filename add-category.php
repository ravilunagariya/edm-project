<?php
 require 'topbar.php';
 
 if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
   $success = false;
   $showerror = false;
   $cat_name = $_POST['category'];
   $sql = mysqli_query($conn,"SELECT * FROM category WHERE name='$cat_name'") or die("SQL Query Failed.");
   $existnumrows = mysqli_num_rows($sql);
   if($existnumrows > 0){
    $showerror = "Category already Exist.";
  }elseif (empty($cat_name)) {
    $showerror = "Please Enter Category";
  }else{
   if (isset($cat_name)) {
     $sql= mysqli_query($conn,"INSERT INTO category(name) VALUES('".$cat_name."')");
     if($sql){
       $success = true;
     }
   }else{
     $showerror = "Please Enter Category ";
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
    <li class="breadcrumb-item"><a href="add-category.php">ADD-Category</a></li>
  </ol></div></div>

  <section class="main-content">
    <?php 
    
    if($success){
      echo '<div class="alert bg-success alert-dismissible " role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Success!</strong> Product successfully added. </div>';
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
            Add Category
            <p class="text-muted">Main Category</p>
          </div>
        </div>
      </div>
    </div>

    <form class="form-horizontal" method="POST">

      <div class="form-group">
        <label>Category Name</label>
        <input type="text" placeholder="New Category name" id="category" name="category" class="form-control form-control-rounded">
      </div>
      <div class="buttons margin-b-20">
       <input name="submit" type="submit" class="btn btn-primary btn-border " value="submit">
     </div>

   </form>
 </section>


 <?php require 'footer.php'; ?>