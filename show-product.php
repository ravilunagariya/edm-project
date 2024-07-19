<?php require 'topbar.php'?>
<section class="main-content">
 <div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-default">
        Products Tables
      </div>

      <div class="card-body">
        <table id="datatable2" class="table table-striped dt-responsive nowrap table-hover">
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
              <br>
              <th class="text-center">
                <strong>Description</strong>
              </th>
              <th class="text-center">
                <strong>Price</strong>
              </th>
              <th class="text-center">
                <strong>Status</strong>
                <th class="text-center">
                  <strong>Action</strong>
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
                $Stock_status =$row["status"];
                $image = $row["image"];
                $results = mysqli_query($conn,"select * from tbl_brand WHERE is_deleted='0'");
                ?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><img src="../Master/img/<?php echo $image; ?>" width="60" height="60"></td>
                  <td><?php echo $productname; ?></td>
                  <td><?php echo $description; ?></td>
                  <td><?php echo $cur_price; ?></td>
                  <td class="text-center"><div>
                    <input type="checkbox" name="active" id="status-<?php echo $id; ?>" <?php if ($rows['status'] = 0){?> checked="checked" <?php } else { ?> checked="unchecked" <?php } ?> />
                  </div>
                </td>

                <td class="text-center">
                  <button type="button" class="btn btn-sm btn-success"><a href="edit-product.php?edit_product=<?php echo $id; ?>"><i class="fa fa-edit"></i></a></button>
                  <button type="button" class="btn btn-sm btn-danger" ><a href="delete.php?tbl=tbl_product&id=<?php echo $id; ?>"><i class="fa fa-trash"></i></a></button>
                </td>
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
<script>
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


  });

</script>

<?php require 'footer.php'?>

<?php
mysqli_close($conn);
?> 
