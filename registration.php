<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
 <?php session_start(); ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>

    <?php 
        if(isset($_POST['submit'])){

            if(isset($_POST['username']) && $_POST['password'] && $_POST['email']){
                /* Checking if user name already exists*/
                    $check_query = "SELECT * FROM users";
                    $check_final_query = mysqli_query($connection,$check_query);
                    if(!$check_final_query){
                        die("Query Failed to check" . mysqli_error($connection));
                    }
                    $flag = 0;
                    while($row = mysqli_fetch_assoc($check_final_query)){
                        $username = $_POST['username'];
                        if($username === $row['username']){
                            $flag = 1;
                            break;
                        }
                    }
                    if($flag == 1){
                        echo "<p class='bg-warning center'>Username Already Exists Try with some other name<p>";
                    }else{

                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $password = $_POST['password'];
            
                        $username = mysqli_real_escape_string($connection,$username);
                        $email = mysqli_real_escape_string($connection,$email);
                        $password = mysqli_real_escape_string($connection,$password);
            
                        $query = "SELECT randSalt FROM users";
                        $fetch_rand_salt = mysqli_query($connection,$query);
                        
                        if(!$fetch_rand_salt){
                            die("Query Failed" . mysqli_error($connection));
                        }
            
                        while($row = mysqli_fetch_assoc($fetch_rand_salt)){
                            $salt = $row['randSalt'];
                        }

                        $password = crypt($password,$salt);
            
                        //echo $salt;
                        $query = "INSERT into users(username,user_email,user_password,user_role) VALUES('{$username}','{$email}','{$password}','Subscriber')";
                        $new_user_query = mysqli_query($connection,$query);
            
                        if(!$new_user_query){
                            die("Query Failed" . mysqli_error($connection));
                        }

                        echo "<p class='bg-success' >User Registered</p>";

                    }

            }else{
                echo "<script>alert('All Fields Manadatory'); </script>";
            }
            
        }
    
    ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" value="<?php echo isset($_POST['username'])?$_POST['username']:''; ?>">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" value="<?php echo isset($_POST['password'])?$_POST['password']:''; ?>">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
