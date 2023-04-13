<?php include ob_start(); ?>

<?php include session_start(); ?>

<?php
if (isset($_SESSION['user_role'])) {
} else {
    header("location:../index.php");
}

?>