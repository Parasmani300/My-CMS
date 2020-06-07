<?php 
    if(isset($_POST['create_post'])){
    $post_category_id = $_POST['post_category_id'];
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_date = date('d-m-y');
    $post_comment_count = 0;
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

        $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_comment_count,post_status)";
        $query .= "VALUES($post_category_id,'$post_title','$post_author',now(),'$post_image','$post_content','$post_tags','$post_comment_count','$post_status')";

        $post_publish_query = mysqli_query($connection,$query);

        if(!$post_publish_query){
            die("Query Failed" . mysqli_error($connection));
        }
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
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
        <input type="text" value="<?php echo $_SESSION['username'] ?>" class="form-control" name="author" readonly>
    </div>
    <div class="form-group">
        <label for="post_status">Post Status</label>
        <!--<input type="text" class="form-control" name="post_status"> -->
        <select class="form-control" name="post_status" id="">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="post_contents">Post Contents</label>
        <textarea class="form-control" name="post_contents" id="body" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>
</form>
