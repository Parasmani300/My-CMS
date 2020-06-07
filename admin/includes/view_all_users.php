<table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>User Id</th>
                        <th>User Name</th>
                        <!-- <th>Password</th> -->
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>User Image</th>
                        <th>User Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        if($_SESSION['user_role'] == 'Admin'){
                            $permission = "WHERE 1";
                        }else{
                            $permission = "WHERE user_id = {$_SESSION['user_id']}";
                        }
                        $query = "SELECT * FROM users ";
                        $query = $query . $permission;
                        
                        $posts_query = mysqli_query($connection,$query);

                        while($row = mysqli_fetch_assoc($posts_query)){
                            $user_id = $row['user_id'];
                            $username = $row['username'];
                            $user_password = $row['user_password'];
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_email = $row['user_email'];
                            $user_image = $row['user_image'];
                            $user_role = $row['user_role'];
                    ?>
                    <tr>
                        <td><?php echo $user_id; ?></td>
                        <td><?php echo $username; ?></td>
                        <!-- <td><?php //echo $user_password; ?></td> -->
                        
                        <!-- This whole php code is to get category title from category id To DO -->
                        

                        <td><?php echo $user_firstname; ?></td>
                        <td><?php echo $user_lastname; ?></td>
                        <!--
                        <td><a href="../post.php?p_id=<?php //echo $comment_post_id ?>">
                            <?php
                                /* 
                                 $query2 = "SELECT * from posts where post_id = $comment_post_id";
                                 $ex_query = mysqli_query($connection,$query2);
    
                                 if(!$ex_query){
                                     die("Query Failed" . mysqli_error($connection));
                                 }
    
                                 while($r = mysqli_fetch_assoc($ex_query)){
                                     $comment_post_title = $r['post_title'];
                                     echo $comment_post_title;
                                 }
                                 */
                            ?>
                        </a></td> -->
                        <td><?php echo $user_email; ?></td>
                        <td>
                        <img class="img-responsive" width="100px" height="100px" src="../images/users/<?php echo $user_image; ?>">
                        </td>
                        <td><?php echo $user_role; ?></td>
                        <td><a href="users.php?source=update_user&u_id=<?php echo $user_id; ?>">Edit</a></td>
                        <td><a href="users.php?delete=<?php echo $user_id; ?>">Delete</a></td>
                    </tr>
                        <?php } ?>
                </tbody>
            
            </table>

    <?php 
        if(isset($_GET['delete'])){
            $the_user_id = $_GET['delete'];

            $query = "DELETE from users where user_id = $the_user_id";
            $delete_query = mysqli_query($connection,$query);

            if(!$delete_query){
                die("Query Failed" . mysqli_error($connection));
            }else{
                header("Location: users.php");
            }
            
        }
    ?>

<?php 
        if(isset($_GET['approve'])){
            $the_comment_id = $_GET['approve'];

        $query = "UPDATE comments set comment_status = 'approved' where comment_id = $the_comment_id";
        $approve_query = mysqli_query($connection,$query);

            if(!$approve_query){
                die("Query Failed" . mysqli_error($connection));
            }else{
                header("Location: comments.php");
            }
            
        }
    ?>

<?php 
        if(isset($_GET['unapprove'])){
            $the_comment_id = $_GET['unapprove'];

        $query = "UPDATE comments set comment_status = 'unapproved' where comment_id = $the_comment_id";
        $unapprove_query = mysqli_query($connection,$query);

            if(!$unapprove_query){
                die("Query Failed" . mysqli_error($connection));
            }else{
                header("Location: comments.php");
            }
            
        }
    ?>