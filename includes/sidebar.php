<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <?php 
        
    ?>
    <h4>Blog Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input type="text" name="search" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" name="submit" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>

<!-- Login Form -->
<div class="well">
    <?php 
       if($_SESSION['user_id'] == null){
    
    echo "<h4>Login</h4>";
    echo "<form action='includes/login.php' method='post'>";
    echo "<div class='form-group'>";
        echo "<input type='text' name='username' class='form-control' placeholder='username'>";
    echo "</div>";
    echo "<div class='input-group'>";
        echo "<input type='password' name='password' class='form-control' placeholder='password'>";
        echo "<span class='input-group-btn'>";
            echo "<button class='btn btn-primary' name='login' type='submit'>Login</button>";
        echo "</span>";
    echo "</div>";
    echo "</form>";
     } ?>
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
            <?php 
                $query = "SELECT * FROM categories";
                $select_all_from_categories = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($select_all_from_categories)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                
            ?>
            <ul class="list-unstyled">
                <li><a href="categories.php?cat_id=<?php echo $cat_id; ?>" ><?php echo $cat_title; ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->
<!-- <div class="well">
    <h4>Side Widget Well</h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
</div> -->

</div>