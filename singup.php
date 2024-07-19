<?php require 'topbar.php'?>
<?php
if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST"){
    $showalert = false;
    $showerror = false;
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $existsql = "SELECT * FROM customer WHERE email='".$email."'";
    $result = mysqli_query($conn,$existsql) or die("SQL Query Failed.");
    $existnumrows = mysqli_num_rows($result);
    if($existnumrows > 0){
        $showerror = "Sub-Category already Exist.";
  }elseif (!isset($fullname) || !isset($email) || !isset($password) || empty($email) || empty($phone) ||  empty($fullname) ||  !isset($phone) || empty($password)){
        $showerror = "Please Enter Category";
  }else{
       if(($password == $confirm_password)){
            $has = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `customer` ( `username`,`phone`,`email`, `password`) VALUES ('$fullname','$phone','$email', '$has')";
            $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
            if($result){
                $showalert = true;
          }
    }else{
      $showerror = "Please Enter Correct Details";
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
          echo '<div class="alert alert-success alert-dismissible margin-b-0" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Success !</strong> Your Account is Created now and you can Login.</div>'; 
    }
    if($showerror){
          echo '<div class="alert alert-danger alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
          <strong>Error !</strong> '.$showerror.'</div>'; 
    }
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header card-default">
                    <h1 class="text-center">ADD USERS</h1>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" id="signupForm1" novalidate="novalidate" method="POST">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                placeholder="Full name" />
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" />
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" />
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" />
                        </div>

                        <div class="form-group">
                            <label for="confirm_password1">Confirm password</label>
                            <input type="password" class="form-control " id="confirm_password" name="confirm_password"
                                placeholder="Confirm password" />
                        </div>

                        <div class="form-group">

                            <button type="submit" class="btn btn-primary" name="submit" value="submit">ADD USER</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'footer.php'; ?>