
                        <form action="" method="POST">
                            <?php
                                if(isset($_GET['edit'])){
                                $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
                                $query_select_all = mysqli_query($connection,$query);
                            ?>
                            <div class="form-group">
                            <label for="cat_title">Edit Category</label>
                                <?php while($row = mysqli_fetch_assoc($query_select_all)){
                                    $cat_title = $row['cat_title'];
                                    $cat_id = $row['cat_id'];
                                    
                                ?>
                                <input type="text" value = "<?php echo $cat_title; ?>" class="form-control" name="cat_title">
                                <?php }} ?>
                                <?php 
                                
                                if(isset($_POST['update_category'])){
                                    $the_cat_title = $_POST['cat_title'];
                                    
                                $query = "UPDATE categories SET cat_title = '{$the_cat_title}' where cat_id = {$cat_id}";
                                $update_query = mysqli_query($connection,$query);

                                if(!$update_query){
                                    die("Query Failed" . mysqli_error($connection));
                                }else{
                                    header("Location: categories.php");
                                }

                                }    
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="update_category" value="Update Category">
                            </div>  
                        </form>