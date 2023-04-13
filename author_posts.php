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
                if (isset($_GET["post_id"])) {
                    $post_id =  $_GET["post_id"];
                }

                $query = "SELECT * FROM posts WHERE post_id ='{$post_id}'";
                $select_post_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_post_query)) {
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
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
                        <?php echo "$post_content"; ?>
                    </p>

                    <hr>
                    <!-- Blog Comments -->
                    <?php
                    if (isset($_POST["create_comment"])) {
                        $post_id = $_GET["post_id"];

                        $comment_author = $_POST["comment_author"];
                        $comment_email = $_POST["comment_email"];
                        $comment_content = $_POST["comment_content"];

                        $query = "INSERT INTO comments(comment_post_id, comment_date, comment_content, comment_author, comment_status, comment_email) VALUES({$post_id}, now(), '{$comment_content}', '{$comment_author}', 'unapprouved', '{$comment_email}')";
                        $create_comment_query = mysqli_query($connection, $query);

                        confirm($create_comment_query);

                        $query = "UPDATE posts SET post_comments_count=post_comments_count + 1 WHERE post_id={$post_id}";
                        $update_post_comments_count_query = mysqli_query($connection, $query);

                        confirm($update_post_comments_count_query);
                    } ?>
                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form role="form" method="POST">
                            <div class="form-group">
                                <label for="comment_author">Author</label>
                                <input type="text" name="comment_author" id="comment_author" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="comment_email">Email</label>
                                <input type="email" name="comment_email" id="comment_email" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label for="comment_content">Your Comment</label>
                                <textarea name="comment_content" id="summernote" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <hr>

                    <!-- Posted Comments -->
                    <?php
                    if (isset($_GET["post_id"])) {
                        $post_id = $_GET["post_id"];

                        $query = "SELECT * FROM comments WHERE comment_post_id={$post_id} AND comment_status='approved' ORDER BY comment_id DESC";
                        $select_approved_comments_by_post_id_query = mysqli_query($connection, $query);

                        confirm($select_approved_comments_by_post_id_query);

                        while ($row = mysqli_fetch_assoc($select_approved_comments_by_post_id_query)) {
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content'];

                    ?>
                            <!-- Comment -->
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="https://via.placeholder.com/64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $comment_author ?>
                                        <small><?php echo $comment_date ?></small>
                                    </h4>
                                    <?php echo $comment_content ?>
                                </div>
                            </div>

                    <?php }
                    }
                    ?>

                <?php } ?>



            </div>

            <!-- Blog Sidebar Widgets Column -->

            <?php
            include "includes/sidebar.php";
            ?>
        </div>
        <!-- /.row -->

        <hr>

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <div class="row">
                    <h2>Posts related to: <?php echo $_GET['author'] ?></h2>
                </div>
                <!-- First Blog Post -->
                <?php
                if (isset($_GET["author"])) {
                    $post_author =  $_GET["author"];
                    $post_id =  $_GET["post_id"];
                }

                //QUERY ALL POSTS OF AUTHOR EXCEPT THE DISPLAYED POST
                $query = "SELECT * FROM posts WHERE post_author ='{$post_author}' AND NOT post_id='{$post_id}'";
                $select_all_posts_author_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_all_posts_author_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                ?>

                    <h3 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h3>

                    <h4>
                        <a href="post.php?post_id=<?php echo $post_id; ?>"><?php echo "$post_title"; ?></a>
                    </h4>
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
                    <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>

                <?php }

                ?>



            </div>

        </div>
        <!-- /.row -->
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