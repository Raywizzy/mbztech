

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link rel="stylesheet" href="adduser.css">

</head>
<body>
    <h3 class="text-center mt-4 mb-4">Delete Account?</h3>
    <form action="" method="post" >
   
    <div class="col-12 mb-3 text-center">
    <button type="submit" class="delete" name="delete">Delete <i class="fa-solid fa-person-circle-plus"></i></button>

    <button type="submit" class="sumbit" name="dont_delete">Cancel <i class="fa-solid fa-person-circle-plus"></i></button>
    
    </form>

    <?php
$admin_username_session = $_SESSION['admin_username'];

if (isset($_POST['delete'])) {
    $delete_query = "DELETE FROM `admin_table` WHERE admin_name='$admin_username_session'";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        session_destroy();
        echo "<script>alert('Account Deleted Successfully')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}

if (isset($_POST['dont_delete'])) {
    echo "<script>window.open('setting.php','_self')</script>";
}
?>

</body>
</html>