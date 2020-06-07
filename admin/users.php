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
                            <small>Author</small>
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
                    case 'add_user': include "includes/add_user.php";
                            break;      
                    case 'view_all_users' : include "includes/view_all_users.php";
                        break;
                    case 'update_user' : include "includes/update_user.php";
                    break;

                    default : 
                                include "includes/view_all_users.php";
                    break;

            }
           ?>

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php" ?>
