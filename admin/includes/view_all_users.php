<table class="table table-bordered table-hover table-responsive">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>User_Firstname</th>
            <th>User_Lastname</th>
            <th>User_Email</th>
            <th>User_Image</th>
            <th>User_Role</th>
            <th>Grant Admin Role</th>
            <th>Grant Subscriber Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $select_all_users_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_all_users_query)) {
            $user_id =  $row['user_id'];
            $user_username =  $row['user_username'];
            $user_firstname =  $row['user_firstname'];
            $user_lastname =  $row['user_lastname'];
            $user_email =  $row['user_email'];
            $user_image =  $row['user_image'];
            $user_role =  $row['user_role'];
        ?>
            <tr>
                <td><?php echo $user_id; ?></td>
                <td><?php echo $user_username; ?></td>
                <td><?php echo $user_firstname; ?></td>
                <td><?php echo $user_lastname; ?></td>
                <td><?php echo $user_email ?></td>
                <td>
                    <img src="../images/<?php echo $user_image; ?>" alt="user image" width="180" height="90">
                </td>
                <td><?php echo $user_role ?></td>
                <td><a href="users.php?change_to_admin&user_id=<?php echo $user_id; ?>">Change To Admin</a></td>
                <td><a href="users.php?change_to_subscriber&user_id=<?php echo $user_id; ?>">Change To Subscriber</a></td>
                <td><a href="users.php?source=edit_user&user_id=<?php echo $user_id; ?>">Edit</a></td>
                <td><a onclick='javascript: return confirm("Are you sure you want to delete this user ?")' href="users.php?delete=<?php echo $user_id; ?>">Delete</a></td>
            </tr>
        <?php }
        ?>

    </tbody>
</table>
<?php
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id='{$user_id}' ";
    $delete_user_query = mysqli_query($connection, $query);
    confirm($delete_user_query);
    header("location: users.php");
}
?>
<?php
if (isset($_GET['change_to_admin'])) {
    $user_id = $_GET['user_id'];
    $query = "UPDATE users SET user_role='admin' WHERE user_id='{$user_id}' ";
    $update_user_role_query = mysqli_query($connection, $query);
    confirm($update_user_role_query);
    header("location: users.php");
}
?>
<?php
if (isset($_GET['change_to_subscriber'])) {
    $user_id = $_GET['user_id'];
    $query = "UPDATE users SET user_role='subscriber' WHERE user_id='{$user_id}' ";
    $update_user_role_query = mysqli_query($connection, $query);
    confirm($update_user_role_query);
    header("location: users.php");
}
?>