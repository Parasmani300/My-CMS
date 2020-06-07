<?php
    if(isset($_POST['checkBoxArray'])){
        foreach($_POST['checkBoxArray'] as $checkBoxValue){
            $bulk_options =  $_POST['bulk_options'];
            switch($bulk_options){
                case 'published':
                $query = "UPDATE posts set post_status = '{$bulk_options}' where post_id = {$checkBoxValue}";
                //here checkBocValue is fetching the post_id
                $bulk_update_query = mysqli_query($connection,$query);

                if(!$bulk_update_query){
                    die("Query Failed" . mysqli_error($connection));
                }
                break;

                case 'draft':
                    $query = "UPDATE posts set post_status = '{$bulk_options}' where post_id = {$checkBoxValue}";
                    //here checkBocValue is fetching the post_id
                    $bulk_update_query = mysqli_query($connection,$query);
    
                    if(!$bulk_update_query){
                        die("Query Failed" . mysqli_error($connection));
                    }
                    break;

                case 'delete':

                $query = "DELETE FROM posts where post_id = {$checkBoxValue}";
                $bulk_delete_query = mysqli_query($connection,$query);

                if(!$bulk_delete_query){
                    die("Query Failed" . mysqli_error($connection));
                }

                break;
                
            }
        }
    }


?>

<form action="" method="POST">

<div id="bulkOptionContainer"  class="col-xs-4">
    <select name="bulk_options" id="" class="form-control">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
    </select>
</div>

<div class="col-xs-4">
    <input type="submit" name="submit" class="btn btnsuccess" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post" >Add New</a>
</div>
<table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAllBoxes"></th>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        if($_SESSION['user_role'] == 'Admin'){
                            $query = "SELECT * FROM posts";
                        }else{
                        $query = "SELECT * FROM posts where post_author = '{$_SESSION['username']}'";
                        }
                        $posts_query = mysqli_query($connection,$query);

                        while($row = mysqli_fetch_assoc($posts_query)){
                            $post_id = $row['post_id'];
                            $post_category_id = $row['post_category_id'];
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_tags = $row['post_tags'];
                            $post_comment_count = $row['post_comment_count'];
                            $post_status = $row['post_status'];
                    ?>
                    <tr>
                        <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
                        <td><?php echo $post_id; ?></td>
                        <td><?php echo $post_author; ?></td>
                        <td><a href="../post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></td>
                        <td><?php
                        //This whole php code is to get category title from category id
                        $q = "SELECT * FROM categories where cat_id = {$post_category_id}";
                        $sel_q = mysqli_query($connection,$q);
                        if(!$sel_q){
                            die("Query Failed" . mysqli_error($connection));
                        }
                        while($row = mysqli_fetch_assoc($sel_q)){
                        echo $row['cat_title']; }?></td>

                        <td><?php echo $post_status; ?></td>
                        <td><img class="img-responsive" width="100px" height="100px" src="../images/<?php echo $post_image; ?>"></td>
                        <td><?php echo $post_tags; ?></td>
                        <td><?php echo $post_comment_count; ?></td>
                        <td><?php echo $post_date; ?></td>
                        <td><a href="posts.php?source=update_post&p_id=<?php echo $post_id; ?>">Edit</a></td>
                        <td><a onclick= "return confirm('Are You sure to delete'); "  href="posts.php?delete=<?php echo $post_id; ?>">Delete</a></td>
                    </tr>
                        <?php } ?>
                </tbody>
            
            </table>
            </form>

    <?php 
        if(isset($_GET['delete'])){
            $delete_post_id = $_GET['delete'];

            $query = "DELETE from posts where post_id = $delete_post_id";
            $delete_query = mysqli_query($connection,$query);

            if(!$delete_query){
                die("Query Failed" . mysqli_error($connection));
            }else{
                header("Location: posts.php");
            }
            
        }
    ?>
    
