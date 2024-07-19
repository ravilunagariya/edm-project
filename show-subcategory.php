<?php require 'topbar.php'; ?>
<section class="main-content">
      <div class="row">
            <div class="col-md-12">
                  <div class="card">
                        <div class="card-header card-default">
                              Sub-Category Tables
                        </div>
                        <div class="card-body">
                              <table id="datatable2" class="table table-striped dt-responsive nowrap">
                                    <thead>
                                          <tr>
                                                <th>Sub-Category Id</th>
                                                <th>Category_id</th>
                                                <th>Sub-Category Name</th>
                                                <th>Sub-Category Status</th>
                                                <th>Sub-Category Action</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                          
                                          $sql = "SELECT * FROM sub_category  WHERE is_deleted='0'";
                                          $result = mysqli_query($conn,$sql) or die("SQL Query Failed.");
                                          while($row = mysqli_fetch_assoc($result)){
                                                $id = $row['id'];
                                                $category_id = $row['category_id'];
                                                $name = $row['name'];
                                                $status = $row['status'];
                                                $results = mysqli_query($conn,"select * from category WHERE is_deleted='0'");
                                                ?>
                                                
                                                <tr>

                                                      <td><?php echo $id; ?></td>
                                                      <td>
                                                            <select class="form-control" id="category-id-<?php echo $id; ?>" name="cat_id">
                                                               <?php
                                                               $catresult = mysqli_query($conn,"select * from category WHERE id='".$category_id."'");
                                                               $catrow = mysqli_fetch_array($catresult);
                                                               ?>
                                                               <option value="<?php echo $category_id; ?>"><?php echo $catrow['name'];?></option>
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
                                                      <div contentEditable='true' class='edit ' id='subCategory-name-<?php echo $id; ?>'>
                                                            <?php echo $name; ?> 
                                                      </div> 
                                                </td>
                                                <td><?php echo $status; ?></td>
                                                <td>
                                                      <a class="btn btn-info" onclick="edit_data('<?php echo $id; ?>')">Edit</a>
                                                      <a class="btn btn-danger" href="delete.php?tbl=sub_category&id=<?php echo $row['id']; ?>">Delete</a>
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
            var category=$('#category-id-'+id).val();
            var sub_category=$('#subCategory-name-'+id).text().trim();
            console.log('id : ' + id);
            console.log('category : ' + category);
            console.log('sub_category : ' + sub_category);
            var formdata = {id:id,category:category,sub_category:sub_category};
            // console.log(formdata);
            $.ajax({
                  url:'show-subcategory.php',
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


});

</script>
<?php require 'footer.php'; ?>
<?php
if(isset($_POST['id']) && isset($_POST['category'])&& isset($_POST['sub_category'])){
      $id = mysqli_real_escape_string($conn,$_POST['id']);
      $category = mysqli_real_escape_string($conn,$_POST['category']);
      $sub_category = mysqli_real_escape_string($conn,$_POST['sub_category']);
      $query =mysqli_query($conn, "UPDATE sub_category SET category_id='".$category."',name='".$sub_category."' WHERE id='".$id."'")or die("SQL Query Failed.");
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
