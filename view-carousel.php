<?php require 'topbar.php' ?>
<section class="main-content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-default">
          Carousel Tables
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
                  <strong>TagName</strong>
                </th>
                <th class="text-center">
                  <strong>Name</strong>
                </th>
                <th class="text-center">
                  <strong>Description</strong>
                </th>
                <th class="text-center">
                  <strong>Status</strong>
                </th>
                <th class="text-center">
                  <strong>Action</strong>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php

              $sql = "SELECT * FROM carousel  WHERE is_deleted='0'";
              $result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["id"];
                $tagname = $row["tagname"];
                $name = $row["name"];
                $description = $row["description"];
                $images = $row["images"];
              ?>
                <tr>
                  <td><?php echo $id; ?></td>
                  <td><img src="../Master/img/carousel/<?php echo $images; ?>" width="60" height="60"></td>
                  <td contentEditable='true' class='edit ' id='tag-name-<?php echo $id; ?>'>
                    <?php echo $tagname; ?></td>
                  <td contentEditable='true' class='edit' id='name-<?php echo $id; ?>'>
                    <?php echo $name; ?></td>
                  <td contentEditable='true' class='edit' id='description-<?php echo $id; ?>'>
                    <?php echo $description; ?></td>
                  <td class="text-center">
                    <div>
                      <input type="checkbox" name="active" id="status-<?php echo $id; ?>" <?php if ($rows['status'] = 0) { ?> checked="checked" <?php } else { ?> checked="unchecked" <?php } ?> />
                    </div>
                  </td>

                  <td class="text-center">
                    <button type="button" class="btn btn-sm btn-success"><a href="edit-carousel.php?edit_product=<?php echo $id; ?>"><i class="fa fa-edit"></i></a></button>
                    <button type="button" class="btn btn-sm btn-danger"><a href="delete.php?tbl=carousel&id=<?php echo $row['id']; ?>"><i class="fa fa-trash"></i></a></button>
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
  $(document).ready(function() {
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

  });
</script>

<?php require 'footer.php' ?>
<?php
mysqli_close($conn);
?>