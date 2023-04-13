<?php
if (isset($_POST['create_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['select_category'];
    $post_status = $_POST['post_status'];
    $post_content = $_POST['post_content'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_date = date('y-m-d');
    $post_comments_count = 0;

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comments_count, post_status) 
    VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comments_count}', '{$post_status}' ) ";

    $create_post_query = mysqli_query($connection, $query);

    confirm($create_post_query);
    
    //bind the last inserted post id
    $last_post_id = mysqli_insert_id($connection);

    echo "<p>Post created! <a href='../post.php?post_id={$last_post_id}'>View it!</a></p>";

}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" id="post_title" class="form-control">
    </div>
    <div class="form-group">
        <label for="select_category">Post Category</label>
        <select class=" form-control" name="select_category" id="select_category">
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
        <input type="text" name="post_author" id="post_author" class="form-control">
    </div>
    <div class="form-group">
    <label for="post_status">Post Status</label>
        <select class="form-control" name="post_status" id="post_status">
            <option value="draft">draft</option>
            <option value="published">published</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" id="post_image" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" name="post_tags" id="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="summernote"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="create_post" id="create_post" class="btn btn-primary" value="Publish Post">
    </div>
</form>