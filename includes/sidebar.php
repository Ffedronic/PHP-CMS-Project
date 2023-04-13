<?php include "includes/db.php" ?>

<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Login form -->
    <div class="well">
        <h4>Login</h4>
        <form action="includes/login.php" method="post">
            <?php
            if ($_SESSION) {
                if ($_SESSION['user_username']) {
                    echo  "<a class='btn btn-danger' href='includes/logout.php'>Log Out</a>";
                } else {
                    echo "<div class='form-group'>
                            <label for='user_username'>Your Username</label>
                            <input name='user_username' type='text' class='form-control' placeholder='Enter Username' required>
                        </div>
                        <div class='form-group'>
                            <label for='user_password'>Your Password</label>
                            <input name='user_password' type='password' class='form-control' placeholder='Enter Password' required>
                        </div>
                        <span class='input-group-btn'>
                            <input name='login_submit' class='btn btn-primary' type='submit' value='Submit'>
                        </span>";
                }
            } else {
                echo "<div class='form-group'>
                        <label for='user_username'>Your Username</label>
                        <input name='user_username' type='text' class='form-control' placeholder='Enter Username' required>
                    </div>
                    <div class='form-group'>
                        <label for='user_password'>Your Password</label>
                        <input name='user_password' type='password' class='form-control' placeholder='Enter Password' required>
                    </div>
                    <span class='input-group-btn'>
                        <input name='login_submit' class='btn btn-primary' type='submit' value='Submit'>
                    </span>";
            }

            ?>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    $query = "SELECT * FROM categories";
                    $select_categories_sidebar = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href='category-posts.php?cat_id={$cat_id}'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <?php include "includes/widget.php"; ?>
    </div>

</div>