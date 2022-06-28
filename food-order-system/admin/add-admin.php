<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/>

        <?php 
                if(isset($_SESSION['add']))  
                {
                    echo $_SESSION['add'];  //Displaying Session Message
                    unset($_SESSION['add']); //Removing Session Message
                }
            ?>

        <form action="" method="POST">
            <table class="table-30">
                <tr>
                    <td>Fullname :</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name"/></td>
                </tr>
                <tr>
                    <td>Username :</td>
                    <td><input type="text" name="username" placeholder="Enter Your Username"/></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type="password" name="password" placeholder="Enter Your Password"/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>


<?php include('partials/footer.php'); ?>

<?php 
// PRocee the value from form and save it in database
// check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    // button clicked

    //1. Get data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    // $password = md5($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //Password Encryption with md5

    //email validation
    $usernamevalq = "SELECT * FROM admin WHERE username='$username'";
    $usernameres = mysqli_query($con, $usernamevalq);
    $usernamecount = 0;
    $usernamecount = mysqli_num_rows($usernameres);
    if($usernamecount >= 1){
        $_SESSION['add'] = "<div class='error'>This username is already being used, Please enter unique username</div>";
        header("location:".SITEURL.'admin/add-admin.php');   
    }

    //2. sql query to save the data into database
    $sql = "INSERT INTO admin SET full_name='$full_name', username='$username', password='$password'";
    // echo $sql;

    //3. Execute Query and save data in database 
    $result = mysqli_query($con , $sql) or die(mysqli_error($con));

    //4. Check whether the (query is executed) data is inserted or not and display appropriate message
    if($result==TRUE){
        // Create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
        header("location:".SITEURL.'admin/manage-admin.php');
    }else {
        // Create a session variable to display message
        $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
        header("location:".SITEURL.'admin/add-admin.php');
    }

}
?>