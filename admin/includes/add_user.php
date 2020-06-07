<?php 
    if(isset($_POST['add_user'])){
    /* Checking if user name already exists*/
    $check_query = "SELECT * FROM users";
    $check_final_query = mysqli_query($connection,$check_query);
    if(!$check_final_query){
        die("Query Failed to check" . mysqli_error($connection));
    }
    $flag = 0;
    while($row = mysqli_fetch_assoc($check_final_query)){
        $username = $_POST['user_name'];
        if($username === $row['username']){
            $flag = 1;
            break;
        }
    }
    if($flag == 1){
        echo "<p class='bg-warning'>Username Already Exists Try with some other name<p>";
    }else{
    $username = $_POST['user_name'];
    $password = $_POST['password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];
    
    $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);
    $user_firstname = mysqli_real_escape_string($connection,$user_firstname);
    $user_lastname= mysqli_real_escape_string($connection,$user_lastname);
    $user_image = mysqli_real_escape_string($connection,$user_image);
    $user_email = mysqli_real_escape_string($connection,$user_email);
    $user_role = mysqli_real_escape_string($connection,$user_role);



        move_uploaded_file($user_image_temp, "../images/users/$user_image");

        $query = "INSERT INTO users(username,user_password,user_firstname,user_lastname,user_email,user_image,user_role)";
        $query .= "VALUES('$username','$password','$user_firstname','$user_lastname','$user_email','$user_image','$user_role')";

        $post_publish_query = mysqli_query($connection,$query);

        if(!$post_publish_query){
            die("Query Failed" . mysqli_error($connection));
        }

        header("Location: users.php?source=add_user");
    }}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_name">User Alias</label>
        <input type="text" class="form-control" name="user_name" value="<?php echo isset($_POST['username'])?$_POST['username']:''; ?>">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" value="<?php echo isset($_POST['password'])?$_POST['password']:''; ?>" class="form-control" name="password"> 
    </div>
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo isset($_POST['user_firstname'])?$_POST['user_firstname']:''; ?>">
    </div>
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo isset($_POST['user_lastname'])?$_POST['user_lastname']:''; ?>">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" value="<?php echo isset($_POST['image'])?$_POST['image']:''; ?>">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo isset($_POST['user_email'])?$_POST['user_email']:''; ?>">
    </div>
    <div class="form-group">
        <label for="user_role">User Role</label>
       <!-- <input type="text" name="user_role" class="form-control"> -->
       <select class="form-control" name="user_role" id="" value="<?php echo isset($_POST['user_role'])?$_POST['user_role']:''; ?>">
            <option value="Admin">Admin</option>
            <option value="Subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="add_user" value="Add User">
    </div>
</form>