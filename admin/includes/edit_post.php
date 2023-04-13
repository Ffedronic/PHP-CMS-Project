<?php
if (isset($_POST['update_post'])) {
    $update_post_id = $_GET['post_id'];
    $update_post_title = $_POST['post_title'];
    $update_post_category_id = $_POST['select_category'];
    $update_post_author = $_POST['post_author'];
    $update_post_status = $_POST['post_status'];
    $update_post_tags = $_POST['post_tags'];
    $update_post_content = $_POST['post_content'];
    $update_post_image = $_FILES['post_image']['name'];
    $update_post_image_temp = $_FILES['post_image']['tmp_name'];


    if (empty($update_post_image)) {
        $query = "SELECT * FROM posts WHERE post_id='{$update_post_id}'";

        $post_image_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($post_image_query)) {
            $post_image = $row["post_image"];
        }
        
        $query = "UPDATE posts SET 
            post_title='{$update_post_title}',  
            post_category_id={$update_post_category_id},  
            post_author='{$update_post_author}', 
            post_status='{$update_post_status}', 
            post_tags='{$update_post_tags}', 
            post_content='{$update_post_content}', 
            post_date = now()  
            WHERE post_id='{$update_post_id}' ";
        $update_post_query = mysqli_query($connection, $query);

        confirm($update_post_query);

        echo "<p>Post updated! <a href='../post.php?post_id={$update_post_id}'>View it!</a></p>";

    } else {
        $query = "UPDATE posts SET 
            post_title='{$update_post_title}',  
            post_category_id={$update_post_category_id},  
            post_author='{$update_post_author}', 
            post_status='{$update_post_status}', 
            post_tags='{$update_post_tags}', 
            post_content='{$update_post_content}', 
            post_image='{$update_post_image}', 
            post_date = now()  
            WHERE post_id='{$update_post_id}' ";
        $update_post_query = mysqli_query($connection, $query);

        confirm($update_post_query);

        move_uploaded_file($update_post_image_temp, "../images/$update_post_image");

        echo "<p>Post updated! <a href='../post.php?post_id={$update_post_id}'>View it!</a></p>";
    }
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <?php
    if (isset($_GET['post_id'])) {
        $the_post_id = $_GET['post_id'];

        $query = "SELECT * FROM posts WHERE post_id={$the_post_id}";
        $select_edit_post_query = mysqli_query($connection, $query);

        confirm($select_edit_post_query);

        while ($row = mysqli_fetch_assoc($select_edit_post_query)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_author = $row['post_author'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];

    ?>
            <div class="form-group">
                <label for="post_title">Post Title</label>
                <input value="<?php echo $post_title; ?>" type="text" name="post_title" id="post_title" class="form-control">
            </div>
            <div class="form-group">
                <label for="post_category_id">Post Category</label>
                <select class="form-control" name="select_category" id="select_category">
                    <?php
                    $query = "SELECT * FROM categories";
                    $select_all_categories = mysqli_query($connection, $query);

                    confirm($select_all_categories);

                    while ($row = mysqli_fetch_assoc($select_all_categories)) {
                        $cat_title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                    ?>
                        <option value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
                    <?php }

                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="post_author">Post Author</label>
                <input value="<?php echo $post_author; ?>" type="text" name="post_author" id="post_author" class="form-control">
            </div>
            <div class="form-group">
                <label for="post_status">Post Status</label>
                <select class="form-control" name="post_status" id="post_status">
                    <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
                    <?php
                    if($post_status == "draft"){
                        echo "<option value='published'>published</option>" ;
                    }else{
                        echo "<option value='draft'>draft</option>" ; 
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="post_image">Post Image</label>
                <img src="../images/<?php echo $post_image; ?>" class="img-responsive" alt="image">
                <input type="file" name="post_image" id="post_image" class="form-control">
            </div>
            <div class="form-group">
                <label for="post_tags">Post Tags</label>
                <input value="<?php echo $post_tags; ?>" type="text" name="post_tags" id="post_tags" class="form-control">
            </div>
            <div class="form-group">
                <label for="post_content">Post Content</label>
                <textarea class="form-control" name="post_content" id="summernote" cols="30" rows="10"><?php echo $post_content; ?></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="update_post" id="update_post" class="btn btn-primary" value="Update Post">
            </div>

    <?php }
    } else {
        header("location: posts.php");
    }

    ?>

</form>