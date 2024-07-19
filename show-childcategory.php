<?php require 'topbar.php'?>
<section class="main-content">
      <div class="row">
            <div class="col-md-12">
                  <div class="card">
                        <div class="card-header card-default">
                              Child-Category Tables
                        </div>
                        <div class="card-body">
                              <table id="datatable2" class="table table-striped dt-responsive nowrap">
                                    <thead>
                                          <tr>
                                                <th>Child-Category Id</th>
                                                <th>SubCategory_id</th>
                                                <th>Child-Category Name</th>
                                                <th>Child-Category Status</th>
                                                <th>Child-Category Action</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                          
                                          $sql = "SELECT * FROM child_category  WHERE is_deleted='0'";
                                          $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
                                          while($row = mysqli_fetch_assoc($result)){
                                                $id = $row['id'];
                                                $sub_category_id = $row['sub_category_id'];
                                                $name = $row['name'];
                                                $status = $row['status'];
                                                $results = mysqli_query($conn,"select * from sub_category WHERE is_deleted='0'");
                                                ?>
                                                
                                                <tr>

                                                      <td><?php echo $id; ?></td>
                                                      <td>
                                                            <select class="form-control" id="subcategory-id-<?php echo $id; ?>" name="cat_id">
                                                                <?php
                                                                $subcatresult = mysqli_query($conn,"select * from sub_category WHERE id='".$sub_category_id."'");
                                                                $subcatrow = mysqli_fetch_array($subcatresult);
                                                                ?>
                                                                <option value="<?php echo $sub_category_id; ?>"><?php echo $subcatrow['name'];?></option>
                                                                <?php
                                                                while($rows = mysqli_fetch_array($results))
                                                                {
                                                                  ?>
                                                                  <option value="<?php echo $rows['id'];?>"><?php echo $rows['name'];?></option>
                                                                  <?php
                                                            }
                                                            ?>
                                                      </select>

                                                </td>
                                                <td > 
                                                      <div contentEditable='true' class='edit ' id='childCategory-name-<?php echo $id; ?>'>
                                                            <?php echo $name; ?> 
                                                      </div> 
                                                </td>
                                                <td><?php echo $status; ?></td>
                                                <td>
                                                      <a class="btn btn-info" onclick="edit_data('<?php echo $id; ?>')">Edit</a>
                                                      <a class="btn btn-danger" href="delete.php?tbl=child_category&id=<?php echo $row['id']; ?>">Delete</a>
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
            var subcategory=$('#subcategory-id-'+id).val();
            var child_category=$('#childCategory-name-'+id).text().trim();
            console.log('id : ' + id);
            console.log('subcategory : ' + subcategory);
            console.log('child_category : ' + child_category);
            var formdata = {id:id,subcategory:subcategory,child_category:child_category};
            // console.log(formdata);
            $.ajax({
                  url:'show-childcategory.php',
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
if(isset($_POST['id']) && isset($_POST['subcategory'])&& isset($_POST['child_category'])){
      $id = mysqli_real_escape_string($conn,$_POST['id']);
      $subcategory = mysqli_real_escape_string($conn,$_POST['subcategory']);
      $child_category = mysqli_real_escape_string($conn,$_POST['child_category']);
      $query =mysqli_query($conn, "UPDATE child_category SET sub_category_id='".$subcategory."',name='".$child_category."' WHERE id='".$id."'")or die("SQL Query Failed.");
      echo $query;
      die();
      exit;
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
