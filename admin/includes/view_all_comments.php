<?php if($_SESSION['user_role'] != 'Admin'){
    header("Location: index.php");
} ?>
<table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Comment</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>In Response to</th>
                        <th>Date</th>
                        <th>Approve</th>
                        <th>Unapprove</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $query = "SELECT * FROM comments";
                        $posts_query = mysqli_query($connection,$query);

                        while($row = mysqli_fetch_assoc($posts_query)){
                            $comment_id = $row['comment_id'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_author = $row['comment_author'];
                            $comment_email = $row['comment_email'];
                            $comment_content = $row['comment_content'];
                            $comment_status = $row['comment_status'];
                            $comment_date = $row['comment_date'];
                    ?>
                    <tr>
                        <td><?php echo $comment_id; ?></td>
                        <td><?php echo $comment_author; ?></td>
                        <td><?php echo $comment_content; ?></td>
                        
                        <!-- This whole php code is to get category title from category id To DO -->
                        

                        <td><?php echo $comment_email; ?></td>
                        <td><?php echo $comment_status; ?></td>
                        <td><a href="../post.php?p_id=<?php echo $comment_post_id ?>">
                            <?php 
                                 $query2 = "SELECT * from posts where post_id = $comment_post_id";
                                 $ex_query = mysqli_query($connection,$query2);
    
                                 if(!$ex_query){
                                     die("Query Failed" . mysqli_error($connection));
                                 }
    
                                 while($r = mysqli_fetch_assoc($ex_query)){
                                     $comment_post_title = $r['post_title'];
                                     echo $comment_post_title;
                                 }
                            ?>
                        </a></td>
                        <td><?php echo $comment_date; ?></td>
                        <td><a href="comments.php?approve=<?php echo $comment_id; ?>">Approve</a></td>
                        <td><a href="comments.php?unapprove=<?php echo $comment_id; ?>">Unapprove</a></td>
                        <td><a href="comments.php?delete=<?php echo $comment_id; ?>">Delete</a></td>
                    </tr>
                        <?php } ?>
                </tbody>
            
            </table>

    <?php 
        if(isset($_GET['delete'])){
            $delete_post_id = $_GET['delete'];

            $query = "DELETE from comments where comment_id = $delete_post_id";
            $delete_query = mysqli_query($connection,$query);

            if(!$delete_query){
                die("Query Failed" . mysqli_error($connection));
            }else{
                header("Location: comments.php");
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