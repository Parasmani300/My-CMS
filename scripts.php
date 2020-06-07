<?php include "includes/db.php" ?>

<?php 
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_GET['username'];
        $password = $_GET['password'];

        $fetch_string = "SELECT * FROM users where username = '$username'";
        $fetch_query = mysqli_query($connection,$fetch_string);

        if(!$fetch_string){
            die($connection . mysqli_error($connection));
        }
        $data = "No";
        while($row = mysqli_fetch_assoc($fetch_query)){
            $data = $row['user_role'];
            $db_password = $row['user_password'];
            $db_username = $row['username'];
        }
        $password = crypt($password,$db_password);

        if($db_username == $username && $db_password == $password){
            echo $data;
        }else{
            echo "Login Failed";
        }


        //echo $data;
    }
?>