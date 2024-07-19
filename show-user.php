<?php
require 'topbar.php';
// session_start();
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {

?>
    <section class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-default">
                        Users Table
                    </div>
                    <div class="card-body">
                        <table id="datatable2" class="table table-striped dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <?php
                            $sql = "SELECT * FROM customer  WHERE is_deleted='0'";
                            $result = mysqli_query($conn, $sql) or die("SQL Query Failed.");
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row["id"];
                                $name = $row["username"];
                                $email = $row["email"];
                                $phone = $row["phone"];
                            ?>
                                <tbody>
                                    <tr>
                                        <td id="id"><?php echo $id; ?></td>
                                        <td>
                                            <div contentEditable='true' id="name" class='edit '>
                                                <?php echo $name; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div contentEditable='true' id="email" class='edit '>
                                                <?php echo $email; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div contentEditable='true' id="phone" class='edit '>
                                                <?php echo $phone; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-info" onclick="edit_data('<?php echo $id; ?>')">Edit</a>
                                            <a class="btn btn-danger" href="delete.php?tbl=users&id=<?php echo $row['id']; ?>">Delete</a>
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
        function edit_data(id) {
            var id = id;
            var name = $('#name').text().trim();
            var email = $('#email').text().trim();
            var phone = $('#phone').text().trim();
            var formdata = {
                id: id,
                name: name,
                email: email,
                phone: phone
            };
            console.log(formdata);

            $.ajax({
                url: 'show-user.php',
                type: 'post',
                data: formdata,
                success: function(response) {
                    if (response == 1) {
                        console.log('Save successfully');
                    } else {
                        console.log("Not saved.");
                    }
                }
            });

        }
        $(document).ready(function() {

            $('#datatable2').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
            $('.edit').click(function() {
                $(this).addClass('editMode');
            });

            $(".edit").focusout(function() {
                $(this).removeClass("editMode");

            });


        });
    </script>
    <?php require 'footer.php'; ?>
<?php } ?>
<?php
if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $query = mysqli_query($conn, "UPDATE customer SET `username`='" . $name . "',`phone`='" . $phone . "',`email`='" . $email . "' WHERE `id`='" . $id . "'") or die("SQL Query Failed.");
    mysqli_query($conn, $query);
    echo 1;
} else {
    echo 0;
}
mysqli_close($conn);
?>
<!-- UPDATE category SET  name='".$name."' WHERE id='".$id."' -->