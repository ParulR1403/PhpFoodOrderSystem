<?php include('partials/header.php'); ?>

    <!-----Menu Section Starts ---->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br/>
            <?php 
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];  //Displaying Session Message
                    unset($_SESSION['add']); //Removing Session Message
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];  //Displaying Session Message
                    unset($_SESSION['delete']); //Removing Session Message
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];  //Displaying Session Message
                    unset($_SESSION['update']); //Removing Session Message
                }
                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];  //Displaying Session Message
                    unset($_SESSION['user-not-found']); //Removing Session Message
                }
                if(isset($_SESSION['pwd-not-match'])){
                    echo $_SESSION['pwd-not-match'];  //Displaying Session Message
                    unset($_SESSION['pwd-not-match']); //Removing Session Message
                }
                if(isset($_SESSION['change-pwd'])){
                    echo $_SESSION['change-pwd'];  //Displaying Session Message
                    unset($_SESSION['change-pwd']); //Removing Session Message
                }
            ?>

            <br/><br/>
            <!-- Button to Add Admin -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br/><br/>
        
            <table class="table-full">
                <tr>
                    <th>S.No.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php 
                    // Query to get all admin
                    $sql = "SELECT * FROM admin";
                    // Execute the query
                    $result = mysqli_query($con, $sql);

                    // Check whether the query is executed or not
                    if($result==TRUE)
                    {
                        // Count rows to check whether we have data in database or not
                        $count = mysqli_num_rows($result); //Function to get all the rows in database

                        $sn = 1; //create a variable and assign the value

                        // check the num of rows
                        if($count>0){
                            while ($rows = mysqli_fetch_assoc($result)) {
                                // Using while loop to get all the data from database. and while loop will run as long ass we have data in database.
                                // get individual data

                                $id = $rows['id'];
                                $full_name = $rows['full_name'];
                                $username = $rows['username'];

                                // display the values in table
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>
                                <?php

                            }
                        }
                        else{

                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <!----- Menu Section Ends ----->
<?php include('partials/footer.php')?>