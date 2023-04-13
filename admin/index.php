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
                            <small><?php echo $_SESSION['user_username'] ?></small>
                        </h1>
                    </div>
                </div>

                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php
                                            $query = "SELECT * FROM posts";
                                            $select_all_posts = mysqli_query($connection, $query);
                                            confirm($select_all_posts);
                                            $num_posts = mysqli_num_rows($select_all_posts);
                                            echo $num_posts;
                                            ?>
                                        </div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php
                                            $query = "SELECT * FROM comments";
                                            $select_all_comments = mysqli_query($connection, $query);
                                            confirm($select_all_comments);
                                            $num_comments = mysqli_num_rows($select_all_comments);
                                            echo $num_comments;
                                            ?>
                                        </div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php
                                            $query = "SELECT * FROM users";
                                            $select_all_users = mysqli_query($connection, $query);
                                            confirm($select_all_users);
                                            $num_users = mysqli_num_rows($select_all_users);
                                            echo $num_users;
                                            ?>
                                        </div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'>
                                            <?php
                                            $query = "SELECT * FROM categories";
                                            $select_all_categories = mysqli_query($connection, $query);
                                            confirm($select_all_categories);
                                            $num_categories = mysqli_num_rows($select_all_categories);
                                            echo $num_categories;
                                            ?>
                                        </div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!--Query published posts-->
                    <?php
                    $query = "SELECT * FROM posts WHERE post_status = 'published' ";
                    $select_all_published_posts = mysqli_query($connection, $query);
                    confirm($select_all_published_posts);
                    $num_published_posts = mysqli_num_rows($select_all_published_posts);
                    ?>
                    <!--Query draft posts-->
                    <?php
                    $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
                    $select_all_draft_posts = mysqli_query($connection, $query);
                    confirm($select_all_draft_posts);
                    $num_draft_posts = mysqli_num_rows($select_all_draft_posts);
                    ?>
                    <!--Query Unapproved comments-->
                    <?php
                    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                    $select_all_unapproved_comments = mysqli_query($connection, $query);
                    confirm($select_all_unapproved_comments);
                    $num_unapproved_comments = mysqli_num_rows($select_all_unapproved_comments);
                    ?>
                    <!-- Query Subscriber users-->
                    <?php
                    $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
                    $select_all_subscriber_users = mysqli_query($connection, $query);
                    confirm($select_all_subscriber_users);
                    $num_subscriber_users = mysqli_num_rows($select_all_subscriber_users);
                    ?>
                    <?php
                    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
                    $select_all_unapproved_comments = mysqli_query($connection, $query);
                    confirm($select_all_unapproved_comments);
                    $num_unapproved_comments = mysqli_num_rows($select_all_unapproved_comments);
                    ?>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['bar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Data', 'Count'],
                                <?php
                                $element_data = ["All_Posts", "published_Posts", "Draft_Posts", "Categories", "Subscriber_users", "Users", "Unapproved_Comments", "Comments"];
                                $element_counts = [$num_posts, $num_published_posts, $num_draft_posts, $num_categories, $num_subscriber_users, $num_users, $num_unapproved_comments, $num_comments];

                                for ($i = 0; $i < 8; $i++) {
                                    echo "['{$element_data[$i]}',{$element_counts[$i]}],";
                                }
                                ?>
                            ]);

                            var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        }
                    </script>
                </div>

                <div class="row">
                    <div id="columnchart_material" style="width: 900px; height: 500px;"></div>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php include "includes/footer.php"; ?>
</body>

</html>