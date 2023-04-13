<!--Start the session to set the session variables-->
<?php session_start() ?>
<!--Include db connection-->
<?php include "db.php" ?>
<?php include "../admin/functions.php" ?>
<?php
//check if we have a login request
if (isset($_POST['login_submit'])) {
    $user_username =  $_POST['user_username'];
    $user_password =  $_POST['user_password'];

    $user_username = mysqli_real_escape_string($connection, $user_username);
    $user_password = mysqli_real_escape_string($connection, $user_password);

    $query = "SELECT * FROM users WHERE user_username='{$user_username}'";
    $select_user_query = mysqli_query($connection, $query);
    confirm($select_user_query);

    while ($row = mysqli_fetch_assoc($select_user_query)) {
        $selected_user_id = $row["user_id"];
        $selected_user_username = $row["user_username"];
        $selected_user_password = $row['user_password'];
        $selected_user_firstname = $row['user_firstname'];
        $selected_user_lastname = $row['user_lastname'];
        $selected_user_email = $row['user_email'];
        $selected_user_image = $row['user_image'];
        $selected_user_role = $row['user_role'];
    }

    if ( crypt($user_password, $selected_user_password) == $selected_user_password) {
        $_SESSION['user_username'] = $selected_user_username;
        $_SESSION['user_role'] = $selected_user_role;

        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
}
?>  