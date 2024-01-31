
<?php
if (isset($_GET['edit_admin_account'])) {
    $admin_session_name = $_SESSION['admin_username'];
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_session_name'";
    $result_query = mysqli_query($conn, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $admin_id = $row_fetch['admin_id'];
    $admin_name = $row_fetch['admin_name'];
    $admin_email = $row_fetch['admin_email'];
    $admin_image = $row_fetch['admin_image'];
}

if (isset($_POST['admin_update'])) {
    $update_id = $admin_id;
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
 
    $admin_image = $_FILES['admin_image']['name'];
    $admin_image_tmp = $_FILES['admin_image']['tmp_name'];
    
    move_uploaded_file($admin_image_tmp, "admin_images/$admin_image");

    //update query
    $update_data = "UPDATE `admin_table` SET admin_name='$admin_name', admin_email='$admin_email', admin_image='$admin_image' WHERE admin_id=$update_id";
    $result_query_update = mysqli_query($conn, $update_data);
    if ($result_query_update) {
        echo "<script>alert('Data Updated Successfully')</script>";
        echo "<script>window.open('setting.php','_self')</script>";
    } else {
        echo "Error updating data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <link rel="stylesheet" href="adduser.css">
    
</head>

<body>
    <h3 class="text-center mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="input-field">
                        <label for="username">Username</label>
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $admin_name ?>" name="admin_name">
        </div>
        <br>
        <div class="input-field">
                        <label for="username">Email</label>
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $admin_email ?>" name="admin_email">
        </div><br>
          
        <div class="input-field">
                <label for="image">Profile Image</label>            
                <input type="file" class="form-control w-50 m-auto" name="admin_image">
            <img src="admin_images/<?php echo $admin_image ?>" class="edit_img" alt="">
        </div><br>


        <div class="col-12 mb-5 text-center">
            <button type="submit" class="sumbit" name="admin_update">Update <i class="fa-solid fa-person-circle-plus"></i></button>

        </div>
    </form>
</body>

</html>
