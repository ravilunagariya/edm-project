<?php
session_start();

if(!isset($_SESSION['admin_email'])){
	echo "<script>window.open('login.php','_self')</script>";
}else{
	include 'dbconnect.php';
	$sql = "SELECT * FROM orginzation  WHERE id='1'";
	$result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
	$row = mysqli_fetch_assoc($result);
	$logo = $row["logo"];
	$onamename = $row["orginzationname"];
	$icon = $row["icon"];

	?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TD Shop's</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="assets/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/lib/summernote/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="assets/lib/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="assets/lib/chart-c3/c3.min.css" rel="stylesheet">
    <link href="assets/lib/chartjs/chartjs-sass-default.css" rel="stylesheet">
    <link href="assets/lib/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="assets/lib/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/lib/toast/jquery.toast.min.css" rel="stylesheet">
    <link href="assets/lib/datatables/buttons.dataTables.css" rel="stylesheet" type="text/css">
    <link href="assets/scss/style.css" rel="stylesheet">
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <link rel="icon" type="image/png" sizes="16x16" href="../Master/img/logo/<?php echo $icon ?>">
</head>

<body>
    <!-- ============================================================== -->
    <!-- 						Topbar Start 							-->
    <!-- ============================================================== -->
    <div class="top-bar primary-top-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <a class="admin-logo" href="index.php">
                        <h1>
                            <!-- <img alt="" style="height: 20px;width: 45px;" src="../Master/img/logo/<?php # echo $icon ?>"
                                class="logo-icon margin-r-10"> -->
                            <img alt="" style="height: 30px;width: 130px; background-color: dodgerblue;"
                                src="../Master/img/logo/<?php echo $logo ?>" class="toggle-none hidden-xs">
                        </h1>
                    </a>
                    <div class="left-nav-toggle">
                        <a href="#" class="nav-collapse"><i class="fa fa-bars"></i></a>
                    </div>
                    <div class="left-nav-collapsed">
                        <a href="#" class="nav-collapsed"><i class="fa fa-bars"></i></a>
                    </div>
                    <div class="search-form hidden-xs">
                        <!-- <form>
								<input class="form-control" placeholder="Search for..." type="text"> <button class="btn-search" type="button"><i class="fa fa-search"></i></button>
							</form> -->
                    </div>
                    <ul class="list-inline top-right-nav">

                        <li class="dropdown avtar-dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <img alt="" class="rounded-circle" src="assets/img/avtar-2.png" width="30">
                            </a>
                            <ul class="dropdown-menu top-dropdown">
                                <li>
                                    <a class="dropdown-item" href="logout.php"><i class="icon-logout"></i> Logout</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!--                        Topbar End                              -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- 						Navigation Start 						-->
    <!-- ============================================================== -->
    <div class="main-sidebar-nav default-navigation">
        <div class="nano">
            <div class="nano-content sidebar-nav">
                <div class="card-body border-bottom text-center nav-profile">
                    <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span></div>
                    <img alt="profile" class="margin-b-10  " src="assets/img/avtar-2.png" width="80">
                    <?php
						// echo "<pre>";
						// print_r($_SESSION['admin_email']);
						// die();
						$loginuser = $_SESSION['admin_email'];
						$user = mysqli_query($conn,"select * from admin where phone='".$loginuser."' OR email='".$loginuser."'") or die("Query Failed");
						$users = mysqli_fetch_array($user);
						$username = $users['name'];
						?>
                    <p class="lead margin-b-0 toggle-none"><?php echo $username; ?></p>
                    <p class="text-muted mv-0 toggle-none">Welcome</p>
                </div>
                <ul class="metisMenu nav flex-column" id="menu">
                    <li class="nav-heading"><span>MAIN</span></li>
                    <li class="nav-item active"><a class="nav-link" href="index.php"><i class="fa fa-dashboard"></i>
                            <span class="toggle-none">Dashboard </span></a></li>
                    <li class="nav-item"><a class="nav-link" href="orginzation.php"><i class="fa fa-edit"></i> <span
                                class="toggle-none">Orginzation</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="sociallink.php"><i class="fa icon-link"></i> <span
                                class="toggle-none">Social Media Links</span></a></li>
                    <!-- <li class="nav-item">
							<a class="nav-link"  href="javascript: void(0);" aria-expanded="false"><i class="fa fa-user"></i> <span class="toggle-none">Users <span class="fa arrow"></span></span></a>
							<ul class="nav-second-level nav flex-column " aria-expanded="false">
								<li class="nav-item"><a class="nav-link" href="adduser.php"><i class="fa fa-plus-square"></i>  ADD Users</a></li>
								<li class="nav-item"><a class="nav-link" href="show-user.php"><i class="fa fa-eye"></i>  Show Users</a></li>
							</ul>
						</li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i
                                class="fa fa-sitemap"></i> <span class="toggle-none">Category <span
                                    class="fa arrow"></span></span></a>
                        <ul class="nav-second-level nav flex-column " aria-expanded="false">
                            <li class="nav-item"><a class="nav-link" href="add-category.php"><i
                                        class="fa fa-plus-square"></i> ADD Categorys</a></li>
                            <li class="nav-item"><a class="nav-link" href="show-category.php"><i class="fa fa-eye"></i>
                                    Show Categorys</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i
                                class="fa fa-sitemap"></i> <span class="toggle-none">Sub-Category <span
                                    class="fa arrow"></span></span></a>
                        <ul class="nav-second-level nav flex-column " aria-expanded="false">
                            <li class="nav-item"><a class="nav-link" href="add-subcategory.php"><i
                                        class="fa fa-plus-square"></i> ADD Sub-Categorys</a></li>
                            <li class="nav-item"><a class="nav-link" href="show-subcategory.php"><i
                                        class="fa fa-eye"></i> Show Sub-Categorys</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i
                                class="fa fa-sitemap"></i> <span class="toggle-none">Child-Category <span
                                    class="fa arrow"></span></span></a>
                        <ul class="nav-second-level nav flex-column " aria-expanded="false">
                            <li class="nav-item"><a class="nav-link" href="add-childcategory.php"><i
                                        class="fa fa-plus-square"></i> ADD Child-Categorys</a></li>
                            <li class="nav-item"><a class="nav-link" href="show-childcategory.php"><i
                                        class="fa fa-eye"></i> Show Child-Categorys</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i
                                class="fa  fa-info-circle"></i> <span class="toggle-none">Brand <span
                                    class="fa arrow"></span></span></a>
                        <ul class="nav-second-level nav flex-column " aria-expanded="false">
                            <li class="nav-item"><a class="nav-link" href="add-brand.php"><i
                                        class="fa fa-plus-square"></i> ADD Brand</a></li>
                            <li class="nav-item"><a class="nav-link" href="show-brand.php"><i class="fa fa-eye"></i>
                                    Show Brand</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i
                                class="fa fa-shopping-cart"></i> <span class="toggle-none">Product <span
                                    class="fa arrow"></span></span></a>
                        <ul class="nav-second-level nav flex-column " aria-expanded="false">
                            <li class="nav-item"><a class="nav-link" href="add-product.php"><i
                                        class="fa fa-plus-square"></i> ADD Product</a></li>
                            <li class="nav-item"><a class="nav-link" href="show-product.php"><i class="fa fa-eye"></i>
                                    Show Product</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i
                                class="fa fa-ticket"></i> <span class="toggle-none">Offer <span
                                    class="fa arrow"></span></span></a>
                        <ul class="nav-second-level nav flex-column " aria-expanded="false">
                            <li class="nav-item"><a class="nav-link" href="add-offer.php"><i
                                        class="fa fa-plus-square"></i> ADD Product Offer</a></li>
                            <li class="nav-item"><a class="nav-link" href="show-offer.php"><i class="fa fa-eye"></i>
                                    Show Offer</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i
                                class="fa fa-ticket"></i> <span class="toggle-none">Banner Offer <span
                                    class="fa arrow"></span></span></a>
                        <ul class="nav-second-level nav flex-column " aria-expanded="false">
                            <li class="nav-item"><a class="nav-link" href="carousel.php"><i
                                        class="fa fa-plus-square"></i> Carousel Offer</a></li>
                            <li class="nav-item"><a class="nav-link" href="view-carousel.php"><i class="fa fa-eye"></i>
                                    View-Carousel</a></li>
                            <li class="nav-item"><a class="nav-link" href="banner.php"><i class="fa fa-plus-square"></i>
                                    Banners</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i class="fa fa-bank"></i>
                            <span class="toggle-none">Income <span class="fa arrow"></span></span></a>
                        <ul class="nav-second-level nav flex-column " aria-expanded="false">
                            <li class="nav-item"><a class="nav-link" href="income.php"><i class="fa fa-eye"></i> Show
                                    Income</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function() {
        $(".nav-item li").click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        });
    });
    </script>
    <!-- ============================================================== -->
    <!-- 						Navigation End	 						-->
    <!-- ============================================================== -->
    <?php } ?>