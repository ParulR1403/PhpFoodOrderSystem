<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br/>

        <?php
            if (isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">
            <table class="table-60">
                <tr>
                    <td>Current Password :</td>
                    <td>
                       <input type="password" name="current_password" placeholder="Current Password"/> 
                    </td>
                </tr>
                <tr>
                    <td>New Password :</td>
                    <td>
                        <input type="password" name="new_password" placeholder="Enter New Password"/>
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password :</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>"/>
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary"/>
                    </td>
                </tr>
            </table>
            
        </form>
    </div>
</div>

<?php 

if (isset($_POST['submit'])){
    // echo "done"; 
    $id = $_POST['id'];
    $current_password =$_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $newhash_password = password_hash($_POST['new_password'],PASSWORD_DEFAULT);

    $sql = "SELECT * FROM admin WHERE id=$id"; 

    $res = mysqli_query($con, $sql);

    if($res ==TRUE)
    {
        $count = mysqli_num_rows($res);

        if ($count>0){
            $fetch = mysqli_fetch_assoc($res);
            $hashedpassword = $fetch["password"];
            // echo $hashedpassword;

            $sql2 = "SELECT * FROM admin WHERE id = $id AND password='$hashedpassword' ";
            // echo $sql2;

            $res2 = mysqli_query($con, $sql2);

            if($res2 ==TRUE)
            {
                $count = mysqli_num_rows($res2);

                if ($count>0)
                {
                    if ( password_verify($current_password, $hashedpassword) ) {
                        // echo "User Found";
                        if ($new_password==$confirm_password) {
                            // echo "Match";
                            $sql3 = "UPDATE admin SET password='$newhash_password' WHERE id=$id ";
                            $res3 = mysqli_query($con, $sql3);

                            if($res3 ==TRUE)
                            {
                                // $count = mysqli_num_rows($res3);
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully! </div>";
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else{
                                $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password </div>";
                                header('location:'.SITEURL.'admin/manage-admin.php');

                            }
                            
                        } 
                        else {
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not matched, Please enter correct Password! </div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else 
                    {
                    // echo "not";
                    $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

            }


        }

    }
}

?>
<?php include('partials/footer.php'); ?>