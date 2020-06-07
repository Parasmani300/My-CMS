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
                    if(isset($_POST["submit"])){
                        $search =  $_POST["search"];
            
                        $search_query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
                        $select_all_search_query = mysqli_query($connection,$search_query);
            
                        if(!$select_all_search_query){
                            die("Query Failed" . mysqli_error($connection));
                        }
            
                        $count = mysqli_num_rows($select_all_search_query);
                        if($count == 0){
                            echo "<h1>No Result</h1>";
                        }else{
                            while($row = mysqli_fetch_assoc($select_all_search_query)){
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
                <img class="img-responsive" src="images/<?php echo "{$post_image}"; ?>" alt="">
                <hr>
                <p><?php echo "{$post_content}"; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php 
                    }
                }
            
            } ?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>
