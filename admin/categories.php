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

                        <div class="col-xs-6">
                            <?php 
                                if(isset($_POST['submit'])){
                                    $title1 = $_POST['cat_title'];

                                    if($title1 == "" || empty($title1)){
                                        echo "Field cannot be left empty";
                                    }else{

                                        $query_add = "INSERT INTO categories(cat_title)";
                                        $query_add .= "VALUES ('{$title1}')";

                                        $category_add_query = mysqli_query($connection,$query_add);

                                        if(!$query_add){
                                            die('Query failed' . mysqli_error($connection));
                                        }
                                        
                                    }
                                   

                                }
                            ?>
                        <form action="categories.php" method="POST">
                            <div class="form-group">
                            <label for="cat_title">Add Category</label>
                                <input type="text" class="form-control" name="cat_title">
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                            </div>
                        
                        </form>

                        <?php 
                            if(isset($_GET['edit'])){
                                $cat_id = $_GET['edit']; 
                                include "includes/update_categories.php";
                            }
                        ?>


                        </div> <!-- Add Category Form -->

                        <div class="col-xs-6">
                            <?php 
                                 $query = "SELECT * FROM categories";
                                 $select_all_from_categories = mysqli_query($connection,$query);
                 
                                 
                            ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        while($row = mysqli_fetch_assoc($select_all_from_categories)){
                                            $cat_title = $row['cat_title'];
                                            $cat_id = $row['cat_id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $cat_id ?></td>
                                        <td><?php echo $cat_title ?></td>
                                        <?php
                                            if($_SESSION['user_role'] == 'Admin'){
                                           echo "<td><a href='categories.php?delete= $cat_id'>Delete</a></td>";
                                           echo "<td><a href='categories.php?edit= $cat_id;'>Edit</a></td>";
                                            }
                                        ?>
                                    </tr>
                                        <?php }
                                            //Deleting element from categories
                                            if(isset($_GET['delete'])){
                                                $the_cat_id = $_GET['delete'];
                                                $del_query = "DELETE FROM categories WHERE cat_id = $the_cat_id";
                                                $delete_final_query = mysqli_query($connection,$del_query);
                                                header("Location: categories.php");
                                            }
                                        
                                        ?>

                                      
                                </tbody>
                            </table>
                        </div>

                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/footer.php" ?>
