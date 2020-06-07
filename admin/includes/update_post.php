<?php 
     if(isset($_GET['p_id'])){
        $p_id = $_GET['p_id'];
    }

    if(isset($_POST['update_post'])){
    $post_category_id = $_POST['post_category_id'];
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_date = date('d-m-y');
    $post_comment_count = 4;
    $post_content = $_POST['post_contents'];
    $post_status = $_POST['post_status'];

    $post_category_id = mysqli_real_escape_string($connection,$post_category_id);
    $post_title = mysqli_real_escape_string($connection,$post_title);
    $post_author = mysqli_real_escape_string($connection,$post_author);
    $post_image = mysqli_real_escape_string($connection,$post_image);
    $post_tags = mysqli_real_escape_string($connection,$post_tags);
    $post_comment_count = mysqli_real_escape_string($connection,$post_comment_count);
    $post_content = mysqli_real_escape_string($connection,$post_content);
    $post_status = mysqli_real_escape_string($connection,$post_status);
    

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)){
        $query = "SELECT * from posts WHERE post_id = $p_id";
        $pimg = mysqli_query($connection,$query);

        if(!$pimg){
            die("Query Failed" . mysqli_error($connection));
        }

        while($r = mysqli_fetch_assoc($pimg)){
            $post_image = $r['post_image'];
        }
    }

        $edited_update = "UPDATE posts SET ";
        $edited_update .= "post_title = '{$post_title}',";
        $edited_update .= "post_category_id = {$post_category_id},";
        $edited_update .= "post_author = '{$post_author}',";
        $edited_update .= "post_status = '{$post_status}',";
        $edited_update .= "post_image = '{$post_image}',";
        $edited_update .= "post_tags = '{$post_tags}',";
        $edited_update .= "post_content = '{$post_content}',";
        $edited_update .= "post_date = now() ";
        $edited_update .= "WHERE post_id = $p_id";


        
        $update_query = mysqli_query($connection,$edited_update);

        if(!$update_query){
            die("Query Failed for update" . mysqli_error($connection));
        }

    }
?>

<?php 
   
        $query = "SELECT * FROM posts where post_id = $p_id";
        $select_query = mysqli_query($connection,$query);

        if(!$select_query){
            die("Query Failed" . mysqli_error($connection));
        }

        while($row = mysqli_fetch_assoc($select_query)){
            $post_category_id = $row['post_category_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
    

            $post_image = $row['post_image'];

            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_content = $row['post_content'];
            $post_status = $row['post_status'];
        }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title;?>" type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_category_id">Post Cateegory Id</label>
       <!-- <input type="text" value="" class="form-control" name="post_category_id"> -->
        <select class="form-control" name="post_category_id" id="">
            <?php
                $query = "SELECT * FROM categories";
                $show_query = mysqli_query($connection,$query);

                if(!$show_query){
                    die("Query Failed" . mysqli_error($connection));
                }

                while($row = mysqli_fetch_assoc($show_query)){
                    echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" value="<?php echo $post_author;?>" class="form-control" name="author">
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <!--<input type="text" value="" class="form-control" name="post_status">-->
        <select class="form-control" name="post_status" id="">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Image</label><br>
        <img src="../images/<?php echo $post_image; ?>" width="90" height="30"><br>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags;?>" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_contents">Post Contents</label>
        <textarea class="form-control" name="post_contents" id="body" cols="30" rows="10"><?php echo $post_content;?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>
</form>

