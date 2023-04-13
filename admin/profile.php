<?php session_start() ?>
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
                            <small>
                                <?php
                                if (isset($_SESSION["user_username"])) {
                                    echo $_SESSION["user_username"];
                                } ?>
                            </small>
                        </h1>
                        <?php
                        if (isset($_POST['update_profile'])) {
                            $update_user_username = $_POST['user_username'];
                            $update_user_firstname = $_POST['user_firstname'];
                            $update_user_lastname = $_POST['user_lastname'];
                            $update_user_email = $_POST['user_email'];
                            $update_user_role = $_POST['select_role'];
                            $update_user_image = $_FILES['user_image']['name'];
                            $update_user_image_temp = $_FILES['user_image']['tmp_name'];


                            if (empty($update_user_image)) {
                                $query = "SELECT * FROM users WHERE user_username='{$_SESSION["user_username"]}'";

                                $user_image_query = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_assoc($user_image_query)) {
                                    $user_image = $row["user_image"];
                                }


                                $query = "UPDATE users SET 
                                user_username='{$update_user_username}',
                                user_firstname='{$update_user_firstname}',  
                                user_lastname='{$update_user_lastname}', 
                                user_email='{$update_user_email}',
                                user_role='{$update_user_role}'  
                                WHERE user_username = '{$_SESSION["user_username"]}' ";
                                $update_user_query = mysqli_query($connection, $query);

                                confirm($update_user_query);

                                header("Location: index.php");
                            } else {
                                $query = "UPDATE users SET 
                                user_username='{$update_user_username}',  
                                user_firstname='{$update_user_firstname}',  
                                user_lastname='{$update_user_lastname}', 
                                user_email='{$update_user_email}', 
                                user_image='{$update_user_image}', 
                                user_role='{$update_user_role}'  
                                WHERE user_username = '{$_SESSION["user_username"]}' ";
                                $update_user_query = mysqli_query($connection, $query);

                                confirm($update_user_query);

                                move_uploaded_file($update_user_image_temp, "../images/$update_user_image");

                                header("Location: index.php");
                            }
                        }
                        ?>
                        <div class="col-xs-12">
                            <form action="" method="POST" enctype="multipart/form-data">
                                <?php
                                if (isset($_SESSION["user_username"])) {
                                    $session_user_username = $_SESSION["user_username"];
                                    $query = "SELECT * FROM users WHERE user_username='{$session_user_username}'";
                                    $select_user_query = mysqli_query($connection, $query);

                                    confirm($select_user_query);

                                    while ($row = mysqli_fetch_assoc($select_user_query)) {
                                        $user_username = $row['user_username'];
                                        $user_firstname = $row['user_firstname'];
                                        $user_lastname = $row['user_lastname'];
                                        $user_email = $row['user_email'];
                                        $user_role = $row['user_role'];
                                        $update_user_image = $row['user_image'];
                                ?>

                                        <div class="form-group">
                                            <label for="user_username">Your Username</label>
                                            <input type="text" name="user_username" id="user_username" class="form-control" value="<?php echo $user_username; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="user_firstname">Your Firstname</label>
                                            <input type="text" name="user_firstname" id="user_firstname" class="form-control" value="<?php echo $user_firstname; ?>">
                                        </div>
                                        <div class=" form-group">
                                            <label for="user_lastname">Your Lastname</label>
                                            <input type="text" name="user_lastname" id="user_lastname" class="form-control" value="<?php echo $user_lastname;  ?>">
                                        </div>
                                        <div class=" form-group">
                                            <label for="user_email">Your Email</label>
                                            <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $user_email;  ?>">
                                        </div>

                                        <div class=" form-group">
                                            <label for="user_image">Your Image</label>
                                            <input type="file" name="user_image" id="user_image" class="form-control">
                                            <img src="../images/<?php echo $user_image; ?>" alt="user_image">
                                        </div>
                                        <div class="form-group">
                                            <label for="select_role">Your Role</label>
                                            <select class=" form-control" name="select_role" id="select_role" value="<?php echo $user_role;  ?>">
                                                <option value="admin">Admin</option>
                                                <option value="subscriber">Subscriber</option>
                                            </select>
                                        </div>
                                <?php }
                                } ?>
                                <div class="form-group">
                                    <input type="submit" name="update_profile" id="update_profile" class="btn btn-primary" value="Update Profile">
                                </div>
                            </form>
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