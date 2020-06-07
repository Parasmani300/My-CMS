<?php include "includes/header.php" ?>
<?php include "includes/functions.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include "includes/navigation.php" ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php $_SESSION['username'] ?></small>
                        </h1>

                      <!-- Add Posts Table -->
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

           <?php 
            if(isset($_GET['source'])){
                $source  = $_GET['source'];
            }else{
                $source = '';
            }

                switch($source){
                    case 'add_post': include "includes/add_post.php";
                            break;      
                    case 'view_all_posts' : include "includes/view_all_posts.php";
                        break;
                    case 'update_post' : include "includes/update_post.php";
                    break;

                    default : 
                                include "includes/view_all_posts.php";
                    break;

            }
           ?>

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php" ?>
