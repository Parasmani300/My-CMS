<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Social.log</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php
                    $query = "SELECT * FROM categories LIMIT 10";
                    $select_all_from_categories = mysqli_query($connection,$query);

                    while($row = mysqli_fetch_assoc($select_all_from_categories)){
                        $cat_title = $row['cat_title'];
                        $cat_id =$row['cat_id'];
                        echo "<li><a href='categories.php?cat_id={$cat_id}'>{$cat_title}</a></li>";
                    }
                ?>

                   <li style="float: right">
                        <?php
                            if(!isset($_SESSION['user_id'])){
                                $_SESSION['username'] = null;
                                $_SESSION['user_id'] = null;
                                $_SESSION['user_firstname'] = null;
                                $_SESSION['user_lastname'] = null;
                                $_SESSION['user_role'] = null;
                            }
                            if($_SESSION['user_id'] == null){
                                $admin = 'Admin';
                            }else{
                                $admin = $_SESSION['username'];
                            }
                        ?>
                        <a href="admin"><?php echo $admin; ?></a>
                    </li>
                    <li style="float: right">
                        <?php 
                        if($_SESSION['user_id'] == null){
                        echo "<a href='registration.php'>Register</a>";
                        }
                        ?>
                    </li>
                <!-- 
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>

                -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>