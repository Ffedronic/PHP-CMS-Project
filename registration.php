<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <?php
                        if (isset($_POST["registration_submit"])) {
                            $user_username = $_POST["user_username"];
                            $user_email = $_POST["user_email"];
                            $user_password = $_POST["user_password"];

                            $user_email = mysqli_real_escape_string($connection, $user_email);
                            $user_username = mysqli_real_escape_string($connection, $user_username);
                            $user_password = mysqli_real_escape_string($connection, $user_password);

                            $hashed_user_password = crypt($user_password, "cms_project");

                            if (!empty($user_email) && !empty($user_username) && !empty($user_password) && filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

                                $query = "INSERT INTO users(user_username, user_password, user_firstname, user_lastname, user_email, user_role, user_image, randsalt) 
                                VALUES('${user_username}', '{$hashed_user_password}', 'null', 'null', '{$user_email}', 'subscriber', 'null', 'cms_project' ) ";

                                $register_user_query = mysqli_query($connection, $query);

                                confirm($register_user_query);

                                header("Location: index.php");
                            } else {
                                echo "Fields cannot be empty!";
                            }
                        }
                        ?>
                        <h1>Register</h1>
                        <form role="form" action="" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="user_username" id="username" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="registration_submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>