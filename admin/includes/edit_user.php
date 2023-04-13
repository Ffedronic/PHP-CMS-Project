<?php
if (isset($_POST['update_user'])) {
    $update_user_id = $_GET['user_id'];
    $update_user_username = $_POST['user_username'];
    $update_user_firstname = $_POST['user_firstname'];
    $update_user_lastname = $_POST['user_lastname'];
    $update_user_email = $_POST['user_email'];
    $update_user_role = $_POST['select_role'];
    $update_user_image = $_FILES['user_image']['name'];
    $update_user_image_temp = $_FILES['user_image']['tmp_name'];
    $update_user_password = $_POST['user_password'];
    
    $query = "SELECT * FROM users WHERE user_id=$update_user_id";
    $select_user_query = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_user_query)){
        $user_password = $row["user_password"];
    }

    if($user_password !== $update_user_password){
        $update_user_password = crypt($update_user_password, "cms_project");
    }

    if (empty($update_user_image)) {
        $query = "SELECT * FROM users WHERE user_id={$update_user_id}";

        $user_image_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($user_image_query)) {
            $user_image = $row["user_image"];
        }


        $query = "UPDATE users SET 
            user_username='{$update_user_username}',
            user_firstname='{$update_user_firstname}',  
            user_lastname='{$update_user_lastname}', 
            user_email='{$update_user_email}',
            user_role='{$update_user_role}',
            user_password='{$update_user_password}'  
            WHERE user_id = {$update_user_id} ";
        $update_user_query = mysqli_query($connection, $query);

        confirm($update_user_query);

        header("Location: users.php");
    } else {
        $query = "UPDATE users SET 
            user_username='{$update_user_username}',  
            user_firstname='{$update_user_firstname}',  
            user_lastname='{$update_user_lastname}', 
            user_email='{$update_user_email}', 
            user_image='{$update_user_image}', 
            user_role='{$update_user_role}',
            user_password='{$update_user_password}'    
            WHERE user_id = {$update_user_id} ";
        $update_user_query = mysqli_query($connection, $query);

        confirm($update_user_query);

        move_uploaded_file($update_user_image_temp, "../images/$update_user_image");

        header("Location: users.php");
    }
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <?php
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        $query = "SELECT * FROM users WHERE user_id={$user_id}";
        $select_edit_user_query = mysqli_query($connection, $query);

        confirm($select_edit_user_query);

        while ($row = mysqli_fetch_assoc($select_edit_user_query)) {
            $user_username = $row['user_username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];
            $user_password= $row['user_password'];

            ?>
            <div class="form-group">
                <label for="user_username">Your Username</label>
                <input value="<?php echo $user_username; ?>" type="text" name="user_username" id="user_username" class="form-control">
            </div>
            <div class="form-group">
                <label for="user_firstname">Your Firstname</label>
                <input value="<?php echo $user_firstname; ?>" type="text" name="user_firstname" id="user_firstname" class="form-control">
            </div>
            <div class="form-group">
                <label for="user_lastname">Your Lastname</label>
                <input value="<?php echo $user_lastname; ?>" type="text" name="user_lastname" id="user_lastname" class="form-control">
            </div>
            <div class="form-group">
                <label for="user_email">Your Email</label>
                <input value="<?php echo $user_email; ?>" type="email" class="form-control" name="user_email" id="user_email">
            </div>
            <div class="form-group">
                <label for="user_image">Your Image</label>
                <img src="../images/<?php echo $user_image; ?>" class="img-responsive" alt="image">
                <input type="file" name="user_image" id="user_image" class="form-control">
            </div>
            <div class="form-group">
                <label for="select_role">Your Role</label>
                <select class="form-control" name="select_role" id="select_role">
                    <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
                    <?php
                    if($user_role == "admin"){
                        echo "<option value='subscriber'>subscriber</option>" ;
                    }else{
                        echo "<option value='admin'>admin</option>" ; 
                    }
                    
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="user_password">Change Your Password</label>
                <input value="<?php echo $user_password; ?>" type="password" class="form-control" name="user_password" id="user_password">
            </div>
            <div class="form-group">
                <input type="submit" name="update_user" id="update_user" class="btn btn-primary" value="Update User">
            </div>

    <?php }
    } else {
        header("location: users.php");
    }

    ?>

</form>