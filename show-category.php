<?php require 'topbar.php'?>
<section class="main-content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header card-default">
					Category Tables
				</div>
				<div class="card-body">
					<table id="datatable2" class="table table-striped dt-responsive nowrap">
						<thead>
							<tr>
								<th>Category Id</th>
								<th>Category Name</th>
								<th>Category Status</th>
								<th>Category Action</th>
							</tr>
						</thead>

						<?php
						$sql = "SELECT * FROM category  WHERE is_deleted='0'";
						$result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
						while($row = mysqli_fetch_assoc($result)){
							$id = $row['id'];
							$name = $row['name'];
							$status = $row['status'];
							?>
							<tbody>
								<tr>

									<td><?php echo $id; ?></td>
									<td> 
										<div contentEditable='true' class='edit ' id='Category-name-<?php echo $id; ?>'>
											<?php echo $name; ?> 
										</div> 
									</td>
									<td><?php echo $status; ?></td>
									<td>
										<a class="btn btn-info" onclick="edit_data('<?php echo $id; ?>')">Edit</a>
										<a class="btn btn-danger" href="delete.php?tbl=category&id=<?php echo $row['id']; ?>">Delete</a>
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
</section>

<script>
	function edit_data(id){
		var id = id;
 	var name=$('#Category-name-'+id).text().trim();
 	var formdata = { id:id, name:name }; 
  	// console.log(formdata);

 	$.ajax({
 		url: 'show-category.php',
 		type: 'post',
 		data: formdata,
 		success:function(data){
        if(data == "" || data == null){
            console.log("Not saved.");
        }else{
          console.log('Save successfully');
      }
  }
 	});

	}
	$(document).ready(function () {
		$('#datatable').dataTable();

		$('#datatable2').DataTable({
			dom: 'Bfrtip',
			buttons: [
			'copyHtml5',
			'excelHtml5',
			'csvHtml5',
			'pdfHtml5'
			]
		});

		$('#datatable3').DataTable( {
			"scrollY":        "400px",
			"scrollCollapse": true,
			"paging":         false
		} );

		$('.edit').click(function(){
			$(this).addClass('editMode');
		});

 // Save data
 $(".edit").focusout(function(){
 	$(this).removeClass("editMode");
 	
 });


});

</script>
<?php require 'footer.php'?>
<?php
if(isset($_POST['id']) && isset($_POST['name'])){
	$id = mysqli_real_escape_string($conn,$_POST['id']);
	$name = mysqli_real_escape_string($conn,$_POST['name']);
	$query =mysqli_query($conn, "UPDATE category SET  name='".$name."' WHERE id='".$id."'")or die("SQL Query Failed.");
	mysqli_query($conn,$query);
	echo 1;
}else{
	echo 0;
}
mysqli_close($conn);
?> 