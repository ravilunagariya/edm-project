<?php require 'topbar.php'?>
<section class="main-content">
 <div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-default">
        Offer Tables
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
                <strong>Brand</strong>
              </th>
              <th class="text-center">
                <strong>Date</strong>
              </th>
              <th class="text-center">
                <strong>Description</strong>
              </th>
              <th class="text-center">
                <strong>Price</strong>
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

            $sql = "SELECT * FROM offer  WHERE is_deleted='0'";
            $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
            while($row = mysqli_fetch_assoc($result)){
              $id = $row["id"];
              $productname =$row["name"];
              $offer =$row["offer"];
              $date =$row["date"];
              $cur_price =$row["curr_price"];
              $description =$row["description"];
              $status =$row["status"];
              ?>
              <tr>
                <td><?php echo $id; ?></td>
                <td contentEditable='true' class='edit ' id='product-name-<?php echo $id; ?>'><?php echo $productname; ?></td>
                <td contentEditable='true' class='edit ' id='product-offer-<?php echo $id; ?>'><?php echo $offer; ?></td>
                <td contentEditable='true' class='edit ' id='product-date-<?php echo $id; ?>'><?php echo $date; ?></td>
                <td contentEditable='true' class='edit' id='description-<?php echo $id; ?>'><?php echo $description; ?></td>
                <td contentEditable='true' class='edit' id='cur_price-<?php echo $id; ?>'><?php echo $cur_price; ?></td>
                <td  class="text-center"><div>
                  <input type="checkbox" name="active" id="status-<?php echo $id; ?>" <?php if ($rows['status'] = 0){?> checked="checked" <?php } else { ?> checked="unchecked" <?php } ?> />
                </div>
              </td>

              <td class="text-center">
                <button type="button" class="btn btn-sm btn-success" onclick="edit_data('<?php echo $id; ?>')"><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-sm btn-danger"><a href="delete.php?tbl=offer&id=<?php echo $row['id']; ?>"><i class="fa fa-trash"></i></a></button>
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
  function edit_data(id)
  {     var id = id;
    var productname=$('#product-name-'+id).text().trim();
    var offer=$('#product-offer-'+id).text().trim();
    var date=$('#product-date-'+id).text().trim();
    var description=$('#description-'+id).text().trim();
    var cur_price=$('#cur_price-'+id).text().trim();
    var status = $('#status-'+id).is(':checked') ? 0 : 1;
    var formdata = {id:id,productname:productname,offer:offer,date:date,description:description,cur_price:cur_price,status:status};
    // console.log(formdata);
    $.ajax({
      url:'show-offer.php',
      type:'POST',
      data:formdata,
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

 $('input[name=onoffswitch]').click(function(){
  var id=$(this).attr('id');
  var status = $(this).val();
  if(status == 1) {
    status = 0; 
  } else {
    status = 1; 
  }
//alert(id);
$.ajax({
  type:'POST',
  url:'show-offer.php',
  data:'id= ' + id + '&status='+status
});
});

});

</script>

<?php require 'footer.php'?>
<?php
if(isset($_POST['id']) && isset($_POST['productname'])&& isset($_POST['offer'])&&isset($_POST['date'])&& isset($_POST['description'])&& isset($_POST['cur_price'])&& isset($_POST['status'])){
  $id = mysqli_real_escape_string($conn,$_POST['id']);
  $productname = mysqli_real_escape_string($conn,$_POST['productname']);
  $offer = mysqli_real_escape_string($conn,$_POST['offer']);
  $date = mysqli_real_escape_string($conn,$_POST['date']);
  $description = mysqli_real_escape_string($conn,$_POST['description']);
  $curr_price = mysqli_real_escape_string($conn,$_POST['cur_price']);
  $status = mysqli_real_escape_string($conn,$_POST['status']);
  $query =mysqli_query($conn, "UPDATE offer SET name='".$productname."',offer='".$offer."',date='".$date."',curr_price='".$curr_price."',description='".$description."',status='".$status."' WHERE id='".$id."'")or die("SQL Query Failed.");
  mysqli_query($conn,$query);
  echo 1;
}else{
  echo 0;
}
exit;
?>
<?php
mysqli_close($conn);
?> 
