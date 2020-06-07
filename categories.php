<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php session_start() ?>

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
                
                $query = "SELECT * from posts";
                $page_count_query = mysqli_query($connection,$query);

                if(!$page_count_query){
                    die("Query Failed" . mysqli_error($connection));
                }

                $page_count = mysqli_num_rows($page_count_query);
                $page_count = ceil($page_count/5);

                //echo "<h1>$page_count</h1>";
            
            ?>


                <!-- First Blog Post -->
                <?php
                     if(isset($_GET['page'])){
                        $page_no = $_GET['page'];
                        }else{
                            $page_no = 1;
                        }
                    $start_post = ($page_no - 1)*5;
                    $end_post = $page_no*5+1;


                    $the_cat_id = $_GET['cat_id'];
                    $query = "SELECT * FROM POSTS where post_category_id = $the_cat_id LIMIT $start_post,$end_post";
                    $SELECT_ALL_POST_QUERY = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($SELECT_ALL_POST_QUERY)){
                        $post_id = $row['post_id'];
                        $post_category_id = $row['post_category_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_content = substr($row['post_content'],0,100);
                        $post_image = $row['post_image'];

                ?>
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id?>" ><?php echo "{$post_title}"; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?post_author=<?php echo $post_author; ?>"><?php echo "{$post_author}"; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo "Posted on {$post_date}"; ?></p>
                <hr>
                <img class="img-responsive" width="900px" height="300px" src="images/<?php echo "{$post_image}"; ?>" alt="">
                <hr>
                <p><?php echo "{$post_content}"; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <?php } ?>

                <!-- Pager -->
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <ul class="pager">
            <?php

                for($i=1;$i<=$page_count;$i++){
                    echo "<li><a href='index.php?page=$i'>$i</a></li>";
                }
            ?>
        </ul>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>
