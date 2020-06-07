<?php 
        
            function usersOnline(){
            
            global $connection;
            if(!$connection){
               // session_start();
                include("../includes/db.php");
            }   
            
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 3;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online where session = '{$session}'";
            $send_query = mysqli_query($connection,$query);

            if(!$send_query){
                die("Query Failed" . mysqli_error($connection));
            }

            $count = mysqli_num_rows($send_query);
            if($count == NULL){
                $k = mysqli_query($connection,"INSERT into users_online(session,time) VALUES('$session','$time')");
                if(!$k){
                    die("<h1>Query Failed<h1>" . mysqli_error($connection));
                }
            }else{
                mysqli_query($connection,"UPDATE users_online SET time = $time where session = '$session'");
            }

            $users_online_query = "SELECT * from users_online where time < $time_out";
            $count_user_query = mysqli_query($connection,$users_online_query);
            if(!$count_user_query){
                die("Query Found" . mysqli_error($connection));
            }

             $count_user = mysqli_num_rows($count_user_query);
            //This count_user is being used in the navgation section of the admin directly
            return $count_user;
        
        

        }


        ?>