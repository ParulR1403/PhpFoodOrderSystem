<?php
include('../config/constants.php');

//1. get the ID of admin to be deleted
$id = $_GET['id'];

//2. Create SQL Query to Delete Admin
$sql = "DELETE FROM admin WHERE id=$id";

//3. Redirect to 
$res = mysqli_query($con, $sql);

//4. Check whether the query executed successfully or not
if($res==TRUE)
{
    //Query Executed Successfully and Admin Deleted
    // echo "Admin Deleted";
    $_SESSION ['delete'] = "<div class='success'>Admin Deleted Successfully!</div>";
    //Redirect to manage admin page
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else {
    //Failed to Delete Admin
    // echo "Failed to Delete Admin";
    $_SESSION ['delete'] = "<div class='error'>Failed to delete Admin, Try again Later.</div>";
    //Redirect to manage admin page
    header('localhost:'.SITEURL.'admin/manage-admin.php');
}
?>