<?php

session_start();

include 'dbconnect.php';

?>
<!DOCTYPE HTML>
<html>

<head>

    <title>Admin Login</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="stylesheet" href="css/login.css">

</head>

<body>
    <!-- 
<div class="container" >

<form class="form-login" action="" method="post" >

<h2 class="form-login-heading" >Admin Login</h2>

<input type="text" class="form-control" name="admin_email" placeholder="Email Address" required >

<input type="password" class="form-control" name="admin_pass" placeholder="Password" required >

<button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login" >

Log in

</button>


</form>

</div>
 -->

    <div class="login-box">
        <h2>Admin Login</h2>
        <form class="form-login" action="" method="post">
            <div class="user-box">
                <input type="text" name="admin_email" autocomplete="off" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="admin_pass" autocomplete="off" required>
                <label>Password</label>
            </div>
            <button type="submit" name="admin_login">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Submit
            </button>
        </form>
    </div>

</body>

</html>

<?php

if (isset($_POST['admin_login'])) {

    $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);

    $admin_pass = mysqli_real_escape_string($conn, $_POST['admin_pass']);

    $get_admin = "select * from admin where email='$admin_email' AND password='$admin_pass'";

    $run_admin = mysqli_query($conn, $get_admin);

    $count = mysqli_num_rows($run_admin);

    if ($count == 1) {

        $_SESSION['admin_email'] = $admin_email;
        echo "<script>alert('You Are Logged In Successfully')</script>";
        header('location:index.php');
    } else {

        echo "<script>alert('Email or Password is Wrong')</script>";
    }
}

?>