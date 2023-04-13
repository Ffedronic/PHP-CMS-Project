<?php

function isAdmin($username)
{
    global $connection;

    $query = "SELECT user_role FROM users WHERE user_username = '$username'";

    $selected_user_role = mysqli_query($connection, $query);
    confirm($selected_user_role);

    $row = mysqli_fetch_assoc($selected_user_role);

    if ($row['user_role'] == "admin") {
        return true;
    } else {
        return false;
    }
}

function confirm($result)
{
    global $connection;

    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function display_online_users()
{

    global $connection;

    $session_id = session_id();
    $time = time();
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM users_online WHERE user_online_session = '$session_id' ";
    $select_user_online_query = mysqli_query($connection, $query);

    $count = mysqli_num_rows($select_user_online_query);
    if ($count == NULL) {
        $query = "INSERT INTO users_online (user_online_session, user_online_time) VALUES('$session_id', $time)";
        $insert_user_online_query = mysqli_query($connection, $query);
        confirm($insert_user_online_query);
    } else {
        $query = "UPDATE users_online SET user_online_time = $time WHERE user_online_session = '$session_id' ";
        $update_user_online_query = mysqli_query($connection, $query);
        confirm($update_user_online_query);
    }

    $query = "SELECT * FROM users_online WHERE user_online_time > $time_out ";
    $select_users_online_query = mysqli_query($connection, $query);
    echo $users_online_count = mysqli_num_rows($select_users_online_query);
}

function add_categories()
{
    global $connection;

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat-title'];

        if ($cat_title = "" || empty($cat_title)) {
            echo "this field should not be empty!";
        } else {
            $cat_title = $_POST['cat-title'];
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";

            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
        }
    }
}

function edit_category()
{
    global $connection;

    if (isset($_GET['edit'])) {
        $edit_cat_id = $_GET['edit'];

        $query = "SELECT * FROM categories WHERE cat_id={$edit_cat_id}";
        $edit_category = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($edit_category)) {
            $cat_title = $row['cat_title'];

?>
            <label for="cat-title-edit">Edit Category</label>
            <input type="text" class="form-control" name="cat-title-edit" value="<?php echo "$cat_title"; ?>">
            <div class="form-group">
                <input type="submit" name="edit" class="btn btn-primary" value="Edit Category" />
            </div>

        <?php }
    }
}

function update_category()
{
    global $connection;

    if (isset($_POST["edit"])) {
        $edited_cat_title = $_POST["cat-title-edit"];
        $edited_cat_id = $_GET["edit"];
        $query = "UPDATE categories SET cat_title='{$edited_cat_title}' WHERE cat_id='{$edited_cat_id}' ";
        $edit_category_title = mysqli_query($connection, $query);

        if (!$edit_category_title) {
            die("QUERY FAILED!" . mysqli_error($connection));
        }

        header("location: categories.php");
    }
}

function select_categories()
{
    global $connection;

    $query = "SELECT * FROM categories";
    $select_all_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_categories)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        ?>

        <tr>
            <td><?php echo $cat_id; ?></td>
            <td><?php echo $cat_title; ?></td>
            <td><?php echo "<a href='categories.php?delete={$cat_id}'>Delete</a>" ?></td>
            <td><?php echo "<a href='categories.php?edit={$cat_id}'>Edit</a>" ?></td>
        </tr>
<?php }
}

function delete_category()
{
    global $connection;

    if (isset($_GET["delete"])) {
        $delete_cat_id = $_GET["delete"];

        $query = "DELETE FROM categories WHERE cat_id = {$delete_cat_id}";
        $delete_category = mysqli_query($connection, $query);

        if (!$delete_category) {
            die("QUERY FAILED!" . mysqli_error($connection));
        }

        header("location: categories.php");
    }
}
?>