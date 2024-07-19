<?php
	require 'topbar.php';
	$countsql="SELECT COUNT(*) FROM tbl_product";
	$countresult = mysqli_query($conn, $countsql);
	$count = mysqli_fetch_array($countresult);
	$users="SELECT COUNT(*) FROM customer WHERE is_deleted=0";
	$userresult = mysqli_query($conn, $users);
	$user = mysqli_fetch_array($userresult);
	$orders="SELECT COUNT(*) FROM tbl_orders";
	$orderresult = mysqli_query($conn, $orders);
	$order = mysqli_fetch_array($orderresult);
	$payment="SELECT COUNT(*) FROM tbl_orders WHERE order_status='Paid'";
	$saleresult = mysqli_query($conn, $payment);
	$sale = mysqli_fetch_array($saleresult);
	?>
	<!-- ============================================================== -->
	<!-- 						Content Start	 						-->
	<!-- ============================================================== -->
	<div class="row page-header">
		<div class="col-lg-6 align-self-center ">
			<h2>Dashboard</h2>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</div>
	</div>
	<section class="main-content">
		<div class="row w-no-padding margin-b-30">
			<div class="col-md-3">
				<div class="widget  bg-light">
					<div class="row row-table ">
						<div class="margin-b-30">
							<h2 class="margin-b-5">Product</h2>
							<p class="text-muted">Total Product</p>
							<span class="float-right text-primary widget-r-m"><?php echo $count[0];?></span>
						</div>
						<div class="progress margin-b-10  progress-mini">
							<div style="width:<?php echo $count[0];?>px;" class="progress-bar bg-primary"></div>
						</div>
						<p class="text-muted float-left margin-b-0">Total Product</p>
						<p class="text-muted float-right margin-b-0"><?php echo $count[0];?>%</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="widget  bg-light">
					<div class="row row-table ">
						<div class="margin-b-30">
							<h2 class="margin-b-5">Payment</h2>
							<p class="text-muted">Total Payment</p>
							<span class="float-right text-indigo widget-r-m"><?php echo $sale[0];?></span>
						</div>
						<div class="progress margin-b-10 progress-mini">
							<div style="width:<?php echo $sale[0];?>px;" class="progress-bar bg-indigo"></div>
						</div>
						<p class="text-muted float-left margin-b-0">Change</p>
						<p class="text-muted float-right margin-b-0"><?php echo $sale[0];?>%</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="widget  bg-light">
					<div class="row row-table ">
						<div class="margin-b-30">
							<h2 class="margin-b-5">Orders</h2>
							<p class="text-muted">Total Orders</p>
							<span class="float-right text-success widget-r-m"><?php echo $order[0];?></span>
						</div>
						<div class="progress margin-b-10 progress-mini">
							<div style="width:<?php echo $order[0];?>px;" class="progress-bar bg-success"></div>
						</div>
						<p class="text-muted float-left margin-b-0">Change</p>
						<p class="text-muted float-right margin-b-0"><?php echo $order[0];?>%</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="widget  bg-light">
					<div class="row row-table ">
						<div class="margin-b-30">
							<h2 class="margin-b-5">Visitors</h2>
							<p class="text-muted">Total Visitors</p>
							<span class="float-right text-warning widget-r-m"><?php echo $user[0];?></span>
						</div>
						<div class="progress margin-b-10 progress-mini">
							<div style="width:<?php echo $user[0];?>px;" class="progress-bar bg-warning"></div>
						</div>
						<p class="text-muted float-left margin-b-0">Total Visitors</p>
						<p class="text-muted float-right margin-b-0"><?php echo $user[0];?>%</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-default">
						Users Table
					</div>
					<div class="card-body">
						<table  class="table datatable2 table-striped dt-responsive nowrap">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
								</tr>
							</thead>
							<?php
							$sql = "SELECT * FROM customer WHERE is_deleted='0'";
							$result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
							while($row = mysqli_fetch_assoc($result)){
								$id = $row["id"];
								$name = $row["name"];
								$email = $row["email"];
								$phone = $row["phone"];
								?>
								<tbody>
									<tr>
										<td id="id"><?php echo $id; ?></td>
										<td>
											<?php echo $name; ?> 
										</td>
										<td>
											<?php echo $email; ?> 
										</td>
										<td>
											<?php echo $phone; ?> 
										</td>               
									</tr>
								</tbody>
								<?php
							}
							?>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header card-default">
						Products Tables
					</div>

					<div class="card-body">
						<table  class="table datatable2 table-striped dt-responsive nowrap table-hover">
							<thead>
								<tr>
									<th class="text-center">
										<strong>ID</strong>
									</th>
									<th class="text-center">
										<strong>Image</strong>
									</th>
									<th class="text-center">
										<strong>Name</strong>
									</th>
									<th class="text-center">
										<strong>Tag</strong>
									</th>
									<th class="text-center">
										<strong>Description</strong>
									</th>
									<th class="text-center">
										<strong>Price</strong>
									</th>
									<th class="text-center">
										<strong>Stock</strong>
									</th>
									<th class="text-center">
										<strong>Stock Status</strong>
									</th>
									<th class="text-center">
										<strong>Color</strong>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql = "SELECT * FROM tbl_product  WHERE is_deleted='0'";
								$result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
								while($row = mysqli_fetch_assoc($result)){
									$id = $row["id"];
									$productname =$row["name"];
									$cur_price =$row["curr_price"];
									$description =$row["description"];
									$stock =$row["stock"];
									$Stock_status =$row["stock_status"];
									$image = $row["image"];
									$color = $row["color"];
									$tag = $row["tag"];
									?>
									<tr>
										<td><?php echo $id; ?></td>
										<td><img src="../Master/img/<?php echo $image; ?>" width="60" height="60"></td>
										<td><?php echo $productname; ?></td>
										<td><?php echo $tag; ?></td>
										<td><?php echo $description; ?></td>
										<td><?php echo $cur_price; ?></td>
										<td><?php echo $stock; ?></td>
										<td><?php echo $Stock_status; ?></td>
										<td><input type="checkbox" width="16px" height="16px" style="-webkit-appearance: none; -moz-appearance: none; appearance: none; width: 40px; height: 40px; background-color:<?php echo $color; ?>;" disabled></td>
									</tr>
									<?php
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
<script type="text/javascript">
	$(document).ready(function () {

		$('.datatable2').DataTable({
			dom: 'Bfrtip',
			buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdfHtml5'
			]
		});
	});
</script>
<?php require 'footer.php'; ?>
