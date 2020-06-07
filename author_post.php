<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
<?php session_start(); ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <?php
                $the_post_author = $_GET['post_author'];
                $query = "SELECT * FROM USERS WHERE username = '{$_GET['post_author']}'";
                $author_detais = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($author_detais)){
                    $firstname = $row['user_firstname'];
                    $lastname = $row['user_lastname'];
                    $image = $row['user_image'];
                }
            ?>

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <td>
                        <h1 class="page-header">
                            <?php echo $firstname . " " . $lastname; ?>
                            <small><?php echo $the_post_author; ?></small>
                        </h1>
                        </td>

                        <td style="width: 100px; height: 100px;">
                            <img src="images/users/<?php echo $image; ?>" style="display:block; width: 120px; height: 120px;" alt="No Image">
                        </td>
                    </tr>
                </table>

             

                <!-- First Blog Post -->
                <?php
                    $the_post_author = $_GET['post_author'];
$query = "SELECT * FROM POSTS where post_author = '{$the_post_author}'";
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
                    by <a href="#"><?php echo "{$post_author}"; ?></a>
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
