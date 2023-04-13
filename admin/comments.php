<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                        <div class="col-xs-12">
                            <table class="table table-bordered table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Comment</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>In response to</th>
                                        <th>Date</th>
                                        <th>Approved</th>
                                        <th>Unapproved</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM comments";
                                    $select_all_comments = mysqli_query($connection, $query);
                                    while ($row = mysqli_fetch_assoc($select_all_comments)) {
                                        $comment_id =  $row['comment_id'];
                                        $comment_post_id =  $row['comment_post_id'];
                                        $comment_author =  $row['comment_author'];
                                        $comment_content =  $row['comment_content'];
                                        $comment_date =  $row['comment_date'];
                                        $comment_status =  $row['comment_status'];
                                        $comment_email =  $row['comment_email'];
                                    ?>
                                        <tr>
                                            <td><?php echo $comment_id; ?></td>
                                            <td><?php echo $comment_author; ?></td>
                                            <td><?php echo $comment_content; ?></td>
                                            <td><?php echo $comment_email; ?></td>
                                            <td><?php echo $comment_status; ?></td>
                                            <td>
                                                <?php
                                                $query = "SELECT * FROM posts WHERE post_id='{$comment_post_id}'";
                                                $select_post = mysqli_query($connection, $query);
                                                while ($row = mysqli_fetch_array($select_post)) {
                                                    $post_title = $row['post_title'];
                                                    $post_id = $row['post_id'];
                                                }

                                                echo "<a href='../post.php?post_id={$post_id}'>{$post_title}</a>";
                                                ?>
                                            </td>
                                            <td><?php echo $comment_date; ?></td>

                                            <td><a href="comments.php?approve&comment_id=<?php echo $comment_id; ?>">Approve</a></td>
                                            <td><a href="comments.php?unapprove&comment_id=<?php echo $comment_id; ?>">Unapprove</a></td>
                                            <td><a onclick='javascript: return confirm("Are you sure you want to delete this comment ?")' href="comments.php?delete=<?php echo $comment_id; ?>">Delete</a></td>
                                        </tr>
                                    <?php }
                                    ?>

                                </tbody>
                            </table>
                            <?php
                            if (isset($_GET['delete'])) {
                                $comment_id = $_GET['delete'];
                                $query = "DELETE FROM comments WHERE comment_id='{$comment_id}' ";
                                $delete_comment = mysqli_query($connection, $query);
                                confirm($delete_comment);
                                header("location: comments.php");
                            }
                            ?>
                            <?php
                            if (isset($_GET['approve'])) {
                                $comment_id = $_GET['comment_id'];
                                $query = "UPDATE comments SET comment_status='approved' WHERE comment_id='{$comment_id}' ";
                                $update_comment_status_query = mysqli_query($connection, $query);
                                confirm($update_comment_status_query);
                                header("location: comments.php");
                            }
                            ?>
                            <?php
                            if (isset($_GET['unapprove'])) {
                                $comment_id = $_GET['comment_id'];
                                $query = "UPDATE comments SET comment_status='unapproved' WHERE comment_id='{$comment_id}' ";
                                $update_comment_status_query = mysqli_query($connection, $query);
                                confirm($update_comment_status_query);
                                header("location: comments.php");
                            }
                            ?>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include "includes/footer.php"; ?>
</body>

</html>