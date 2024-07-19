<?php require 'topbar.php'; ?>
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
                <strong>Name</strong>
              </th>
              <th class="text-center">
                <strong>Qty</strong>
              </th>
              <th class="text-center">
                <strong>Price</strong>
              </th>
              <th class="text-center">
                <strong>Total Ammount</strong>
              </th>
              <th class="text-center">
                <strong>Order Status</strong>
              </th>
            </tr>
          </thead>
          <tbody>
            <?php

            $sql = "SELECT * FROM tbl_orders  WHERE is_deleted='0'";
            $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
            while($row = mysqli_fetch_assoc($result)){
              $id = $row["id"];
              $productname =$row["product_name"];
              $cur_price =$row["product_price"];
              $product_qty =$row["product_qty"];
              $order_status =$row["order_status"];
              ?>
              <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $productname; ?></td>
                <td><?php echo $product_qty; ?></td>
                <td>₹ <?php echo $cur_price; ?></td>
                <td>₹ <?php echo $cur_price * $product_qty; ?></td>
                <td><?php echo $order_status; ?></td>
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
    $('#datatable2').DataTable({
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

<?php require 'footer.php'?>

<?php
mysqli_close($conn);
?> 
