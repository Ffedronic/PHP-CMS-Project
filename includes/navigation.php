<?php
include "includes/db.php"
?>

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
            <a class="navbar-brand" href="index.php">CMS Project</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling from the categories table of the database -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = "SELECT * FROM categories";
                $select_all_categories_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    echo "<li><a href='category-posts.php?cat_id={$cat_id}'>{$cat_title}</a></li>";
                }


                ?>
                <?php
                if ($_SESSION) {
                    if ($_SESSION['user_username']) {
                        echo  "<li><a href='admin/index.php'>Admin</a></li>";
                    } else {
                        echo "<li><a href='registration.php'>Registration</a></li>";
                    }
                } else {
                    echo "<li><a href='registration.php'>Registration</a></li>";
                }
                ?>
                <?php
                if (isset($_SESSION['user_role'])) {

                    if (isset($_GET["post_id"])) {
                        echo "<li><a href='admin/posts.php?source=edit_post&post_id={$_GET["post_id"]}'>Edit Post</a></li>";
                    }
                }
                ?>
                <li><a href='contact.php'>Contact</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>