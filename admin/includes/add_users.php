<?php
if (isset($_POST['create_user'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['select_role'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
   
    $hashed_user_password = crypt($user_password, "cms_project");
    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "INSERT INTO users(user_username, user_password, user_firstname, user_lastname, user_email, user_role, user_image, randsalt) 
    VALUES('${user_username}', '{$hashed_user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}', '{$user_image}', 'cms_project' ) ";

    $create_user_query = mysqli_query($connection, $query);

    confirm($create_user_query);

    header("Location: users.php");
}

?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_username">Your Username</label>
        <input type="text" name="user_username" id="user_username" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_password">Your Password</label>
        <input type="password" name="user_password" id="user_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_firstname">Your Firstname</label>
        <input type="text" name="user_firstname" id="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_lastname">Your Lastname</label>
        <input type="text" name="user_lastname" id="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <label for="user_email">Your Email</label>
        <input type="email" class="form-control" name="user_email" id="user_email">
    </div>
    <div class="form-group">
        <label for="user_email">Your Image</label>
        <input type="file" name="user_image" id="user_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="select_role">Your Role</label>
        <select class=" form-control" name="select_role" id="select _role">
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="create_user" id="create_user" class="btn btn-primary" value="Add User">
    </div>
</form>