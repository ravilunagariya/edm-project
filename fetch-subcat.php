<?php
include "dbconnect.php";
          $category_id = $_POST["category_id"];
          $subresults = mysqli_query($conn,"select * from sub_category WHERE category_id='".$category_id."'");
            ?><option value="">Select Sub-Category</option><?php
          while($subrows = mysqli_fetch_array($subresults)) {
            ?>
            <option value="<?php echo $subrows['id'];?>"><?php echo $subrows['name'];?></option>
            <?php
          }
          ?>