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
                $per_page = 3;

                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                    $page_1 = ($page * $per_page) - $per_page;
                } else {
                    $page_1 = 0;
                }


                $query = "SELECT * FROM posts WHERE post_status='published'";
                $select_all_published_posts_query = mysqli_query($connection, $query);
                confirm($select_all_published_posts_query);
                $pagination_count = mysqli_num_rows($select_all_published_posts_query);
                $pagination_count = ceil($pagination_count / $per_page);

                $query = "SELECT * FROM posts WHERE post_status='published' LIMIT $page_1, $per_page";
                $select_all_posts_query = mysqli_query($connection, $query);

                confirm($select_all_posts_query);

                $count = mysqli_num_rows($select_all_posts_query);
                if ($count == 0) {
                    echo "<h1>No post to display, sorry !</h1>";
                }

                while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 200);
                    $post_views_count = $row['post_views_count'];
                    $post_comments_count = $row['post_comments_count'];

                ?>

                    <h1 class="page-header">
                        Page Heading
                        <small>small text</small>
                    </h1>


                    <h2>
                        <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo "$post_title"; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo "$post_author"; ?>&post_id=<?php echo $post_id; ?>"><?php echo "$post_author"; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo "$post_date"; ?></p>
                    <hr>
                    <img class="img-responsive" src="./images/<?php echo "$post_image"; ?>" alt="">
                    <hr>
                    <p>
                        <?php echo "$post_content"; ?>...
                    </p>
                    <hr>
                    <p><strong><?php echo $post_views_count ?></strong> views</p>
                    <p><strong><?php echo $post_comments_count ?></strong> comments</p>
                    <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>



                <?php } ?>



            </div>

            <!-- Blog Sidebar Widgets Column -->

            <?php
            include "includes/sidebar.php";
            ?>
        </div>
        <!-- /.row -->
        <ul class="pager">
            <?php
            for ($i = 1; $i <= $pagination_count; $i++) {
                echo  "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
            ?>
        </ul>
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