<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php session_start(); ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1> -->

                <!-- First Blog Post -->
                <?php
                    if(isset($_GET['p_id'])){
                        $the_post_id = $_GET['p_id'];
                    }
                    $query = "SELECT * FROM POSTS where post_id = $the_post_id";
                    $SELECT_ALL_POST_QUERY = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($SELECT_ALL_POST_QUERY)){
                        $post_id = $row['post_id'];
                        $post_category_id = $row['post_category_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_content = $row['post_content'];
                        $post_image = $row['post_image'];



                ?>
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id?>"><?php echo "{$post_title}"; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?post_author=<?php echo $post_author; ?>"><?php echo "{$post_author}"; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo "Posted on {$post_date}"; ?></p>
                <hr>
                <img class="img-responsive" width="900px" height="300px" src="images/<?php echo "{$post_image}"; ?>" alt="">
                <hr>
                <p><?php echo "{$post_content}"; ?></p>
                <!--<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>
                <?php } ?>

                   <!-- Blog Comments -->

                <!-- Comments Form -->
                <?php 
                    if(isset($_POST['post_comment'])){
                        $the_comment_author = $_POST['comment_author'];
                        $the_comment_email = $_POST['comment_email'];
                        $the_comment_content = $_POST['comment_content'];
                        $the_comment_date = date('d-m-y');
                        $the_comment_post_id = $the_post_id;
                        
                        if(!empty($the_comment_author) && !empty($the_comment_email) && !empty($the_comment_content))
                        {
                        $query = "INSERT into comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date) values";
                        $query .= "($the_comment_post_id,'$the_comment_author','$the_comment_email','$the_comment_content','approved',now())";

                        $query_post_comment = mysqli_query($connection,$query);

                        if(!$query_post_comment){
                            die("Query Failed" . mysqli_error($connection));
                        }

                        $query = "UPDATE posts set post_comment_count = post_comment_count + 1 where post_id = $the_post_id";
                        $update_comment_count_query = mysqli_query($connection,$query);

                    }else{
                        echo "<script>alert('Filelds cannot be left empty'); </script>";
                    }



                    }
                
                ?>
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="POST">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" name="comment_author" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" name="post_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php
                    
                    $query = "SELECT * FROM comments where comment_status = 'approved' and comment_post_id = $the_post_id order by comment_id desc";
                    $comment_post_query = mysqli_query($connection,$query);

                    if(!$comment_post_query){
                        die("Query Failed" . mysqli_error($connection));
                    }

                    while($row = mysqli_fetch_assoc($comment_post_query)){
                        $comment_author = $row['comment_author'];
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                ?>


                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" height="40px" width="40px" src="images/im1.JPG" alt="image here">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content;?>
                    </div>
                </div>

                    <?php } ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>
