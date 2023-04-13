<!DOCTYPE html>
<html lang="en">

<?php
include "includes/header.php"
?>
<?php
include "includes/db.php";
?>

<body>

    <!-- Navigation -->
    <?php
    include "includes/navigation.php";
    ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <!-- First Blog Post -->
                <?php
                if (isset($_GET['cat_id'])) {
                    $cat_id = $_GET['cat_id'];
                }

                $query = "SELECT * FROM posts WHERE post_category_id={$cat_id}";
                $select_all_posts_category_query = mysqli_query($connection, $query);

                confirm($select_all_posts_category_query);

                $count = mysqli_num_rows($select_all_posts_category_query);
                if ($count === 0) {
                    echo "<h1>No results for this category...</h1>";
                } else {
                    while ($row = mysqli_fetch_assoc($select_all_posts_category_query)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0, 200);
                ?>

                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <h2>
                            <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo "$post_title"; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="author_posts.php?author=<?php echo "$post_author"; ?>&post_id=<?php echo $post_id; ?>"><?php echo "$post_author"; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "$post_date"; ?></p>
                        <hr>
                        <img class="img-responsive" src="./images/<?php echo "$post_image"; ?>" alt="<?php echo "$post_image"; ?>">
                        <hr>
                        <p>
                            <?php echo "$post_content"; ?>...
                        </p>
                        <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>



                    <?php } ?>
                <?php } ?>



            </div>

            <!-- Blog Sidebar Widgets Column -->

            <?php
            include "includes/sidebar.php";
            ?>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php
        include "includes/footer.php";
        ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>