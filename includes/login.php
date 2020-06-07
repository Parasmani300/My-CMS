<?php include "db.php"; ?>
<?php session_start(); ?>

<?php 

if(isset($_POST['login'])){
    
    $username =  $_POST['username'];
    $password =  $_POST['password'];

    $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);

    $query = "SELECT * FROM users where username = '{$username}'";
    $select_user_query = mysqli_query($connection,$query);

    if(!$select_user_query){
        die("Query Failed" . mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($select_user_query)){
        $db_id =  $row['user_id'];
        $db_username = $row['username'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_password = $row['user_password'];
        $db_role = $row['user_role'];
    }

    $password = crypt($password,$db_password);

    if($db_username === $username && $password === $db_password){

        $_SESSION['username'] = $db_username;
        $_SESSION['user_id'] = $db_id;
        $_SESSION['user_firstname'] = $db_firstname;
        $_SESSION['user_lastname'] = $db_lastname;
        $_SESSION['user_role'] = $db_role;
        
        header("Location: ../admin");
    }else{
        header("Location: ../index.php");
    }

}

?>