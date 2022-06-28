<?php include('../config/constants.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css"/>
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1>
        <br><br>

        <?php 

        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if(isset($_SESSION['no-login-msg'])){
            echo $_SESSION['no-login-msg'];
            unset($_SESSION['no-login-msg']);
        }
        ?>

        <br><br>
        <!-- Login Form Starts here -->

        <form action="" method="POST" class="text-center"> 
            Username : <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            
            Password : <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>

        </form>
        <!-- Login Form Ends here -->
        <p class="text-center">Created By - <a href="#">Parul Rathva</a></p>
    </div>
</body>
</html>

<?php 

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM admin WHERE username='$username'"; 

    $res = mysqli_query($con, $sql);

    if($res ==TRUE)
    {
        $count = mysqli_num_rows($res);

        if ($count>0){
            $fetch = mysqli_fetch_assoc($res);
            $hashedpassword = $fetch["password"];

            $sql2 = "SELECT * FROM admin WHERE username='$username' AND password='$hashedpassword' " ;

            $res2 = mysqli_query($con,$sql2);    

            if($res2 == TRUE)
            {
                $count = mysqli_num_rows($res2);
                if($count>0)
                {
                    if ( password_verify($password, $hashedpassword) ){
                        $_SESSION['login'] = "<div class='success text-center'>Logged in Successfully! </div>";
                        $_SESSION['user'] = $username;

                        header('location:'.SITEURL.'admin/');
                    }
                    else{
                        $_SESSION['login'] = "<div class='error text-center'>Failed to login.</div>";
                        header('location:'.SITEURL.'admin/login.php');            
                    }
                   
                }
            } 
            

        
        
        }
        


    }

   

   
}
?>



<!-- 
 $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password' " ;
    $res = mysqli_query($con,$sql);    


if($res == TRUE)
    {
        $count = mysqli_num_rows($res);
        if($count>0)
        {
            // $count = mysqli_num_rows($res3);
            $_SESSION['login'] = "<div class='success text-center'>Logged in Successfully! </div>";
            header('location:'.SITEURL.'admin/');
        }
        else{
            $_SESSION['login'] = "<div class='error text-center'>Failed to login.</div>";
            header('location:'.SITEURL.'admin/');

        }
    } 
-->