

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>
<body>
    <h4 class="text-center mt-4 mb-4">Delete Account?</h4>
    <form action="" method="post" >
   
    <div class="col-12 mb-3 text-center">
        <input type="submit" value="Delete" name="delete"  class="btn btn-red" >
                                </div>
       
        <div class="col-12 mb-5 text-center">
        <input type="submit" value="Cancel" name="dont_delete"  class="btn btn-info" >
                                </div>
    </form>

    <?php
    $username_session=$_SESSION['username'];
    if(isset($_POST['delete'])){
        $delete_query="Delete from `user_table` where username='$username_session'";
        $result=mysqli_query($conn,$delete_query);
        if($result){
            session_destroy();
            echo"<script>alert('Account Deleted Successfully')</script>";
            echo"<script>window.open('index.php','_self')</script>";
        }
    }

    if(isset($_POST['dont_delete'])){
        echo"<script>window.open('profile.php','_self')</script>";

    }

    ?>
</body>
</html>