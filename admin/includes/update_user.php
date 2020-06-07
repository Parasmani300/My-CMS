<?php
    if(isset($_GET['u_id'])){
        $u_id = $_GET['u_id'];
    }
    if(isset($_POST['update_user'])){
    //$username = $_POST['user_name'];
    $password = $_POST['password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    //$username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);
    $user_firstname = mysqli_real_escape_string($connection,$user_firstname);
    $user_lastname= mysqli_real_escape_string($connection,$user_lastname);
    $user_image = mysqli_real_escape_string($connection,$user_image);
    $user_email = mysqli_real_escape_string($connection,$user_email);
    $user_role = mysqli_real_escape_string($connection,$user_role);


    move_uploaded_file($user_image_temp, "../images/users/$user_image");
    
    if(empty($user_image)){
        $query = "SELECT * from users WHERE user_id = $u_id";
        $uimg = mysqli_query($connection,$query);
 

    if(!$uimg){
        die("Query Failed" . mysqli_error($connection));
    }
    

    while($r = mysqli_fetch_assoc($uimg)){
        $user_image = $r['user_image'];
    }
}

    $getsalt_query = "SELECT randSalt from users";
    $salt_query = mysqli_query($connection,$getsalt_query);

    if(!$salt_query){
        die("Query Failed" . mysqli_error($connection));
    }

    $row = mysqli_fetch_array($salt_query);
    $salt = $row['randSalt'];
    $hsahed_password = crypt($password,$salt);

    $edited_update = "UPDATE users SET ";
    $edited_update .= "user_password = '{$hsahed_password}',";
    $edited_update .= "user_firstname = '{$user_firstname}',";
    $edited_update .= "user_lastname = '{$user_lastname}',";
    $edited_update .= "user_image = '{$user_image}',";
    $edited_update .= "user_email = '{$user_email}',";
    $edited_update .= "user_role = '{$user_role}' ";
    $edited_update .= "WHERE user_id = $u_id";

        $user_publish_query = mysqli_query($connection,$edited_update);

        if(!$user_publish_query){
            die("Query Failed Here" . mysqli_error($connection));
        }
    }
?>

<?php 
   
        $query = "SELECT * FROM users where user_id = $u_id";
        $select_query = mysqli_query($connection,$query);

        if(!$select_query){
            die("Query Failed" . mysqli_error($connection));
        }

        while($row = mysqli_fetch_assoc($select_query)){
            $username = $row['username'];
            $password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];

            $user_image = $row['user_image'];

            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
        }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_name">User Alias</label>
       <!-- <input type="text" value="<?php //echo $username; ?>" class="form-control" name="user_name"> -->
       <h4 name="user_name"><?php echo $username; ?></h4>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" value="<?php echo $password; ?>" class="form-control" name="password"> 
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>
    <div class="form-group">
        <label for="image">Image</label><br>
        <img src="../images/users/<?php echo $user_image;  ?>" style="margin: 2px"; width="90" height="30"><br>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label>
       <!-- <input type="text" value="<?php //echo $user_role; ?>" name="user_role" class="form-control"> -->
       <?php if($user_role == 'Admin'){?>
       <select class="form-control" name="user_role" id="" value="<?php echo $user_role ?>">
            <option value="Admin">Admin</option>
            <option value="Subscriber">Subscriber</option>
        </select>
        <?php 
        }else{ ?>
            <select class="form-control" name="user_role" id="">
            <option value="Subscriber">Subscriber</option>
        </select>
        <?php
        }
        ?> 

    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User">
    </div>
</form>