<!DOCTYPE html>
<html lang="en">

<?php include "includes/header.php"; ?>
<?php if (!isAdmin($_SESSION['user_username'])) {
    header("Location: index.php");
} ?>

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
                            <?php
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = "";
                            }

                            switch ($source) {
                                case "add_users":
                                    include "includes/add_users.php";
                                    break;
                                case "edit_user":
                                    include "includes/edit_user.php";
                                    break;
                                default:
                                    include "includes/view_all_users.php";
                                    break;
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