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
                        if (isset($_POST["contact_submit"])) {
                            $user_username = $_POST["user_username"];
                            $user_email = $_POST["user_email"];
                            $user_message = $_POST["user_message"];

                            $user_email = mysqli_real_escape_string($connection, $user_email);
                            $user_username = mysqli_real_escape_string($connection, $user_username);
                            $user_message = mysqli_real_escape_string($connection, $user_message);

                            $to = 'felix.fedronic@orange.fr';
                            $subject = 'contact: '. $user_username;

                            mail($to, $subject, $message);

                            echo "username:  " . $user_username . "<br>";
                            echo "email:  " . $user_email . "<br>";
                            echo "message:  " . $user_message;


                        }
                        ?>
                        <h1>Contact</h1>
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
                                <label for="password" class="sr-only">Message</label>
                                <textarea name="user_message" class="form-control" rows="15"></textarea>
                            </div>

                            <input type="submit" name="contact_submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Message">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>