<?php
include "delete_modal.php";
?>

<table class="table table-bordered table-hover table-responsive">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Post_Views_Count</th>
            <th>View</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM posts";
        $select_all_posts = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($select_all_posts)) {
            $post_id =  $row['post_id'];
            $post_category =  $row['post_category_id'];
            $post_author =  $row['post_author'];
            $post_title =  $row['post_title'];
            $post_status =  $row['post_status'];
            $post_image =  $row['post_image'];
            $post_tags =  $row['post_tags'];
            $post_comments =  $row['post_comments_count'];
            $post_views_count = $row['post_views_count'];
            $post_date =  $row['post_date'];

        ?>
            <tr>
                <td><?php echo $post_id; ?></td>
                <td><?php echo $post_author; ?></td>
                <td><?php echo $post_title; ?></td>
                <td>
                    <?php
                    $query = "SELECT * FROM categories WHERE cat_id='{$post_category}'";
                    $select_category_title = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_array($select_category_title)) {
                        echo $row['cat_title'];
                    }
                    ?>
                </td>
                <td><?php echo $post_status; ?></td>
                <td>
                    <img src="../images/<?php echo $post_image; ?>" class="img-responsive" alt="image" width="100">
                </td>
                <td><?php echo $post_tags; ?></td>
                <td><?php echo $post_comments; ?></td>
                <td><?php echo $post_date; ?></td>
                <td><?php echo $post_views_count; ?></td>
                <td><a href="../post.php?post_id=<?php echo $post_id; ?>">View the post</a></td>
                <td><a href="posts.php?source=edit_post&post_id=<?php echo $post_id; ?>">Edit</a></td>
                <td><a href="" class="delete_link" data-postId="<?php echo $post_id; ?>" >Delete</a></td>
                <!--<td><a onclick='javascript: return confirm("Are you sure you want to delete the post ?")' href="posts.php?delete=<?php //echo $post_id; ?>"  class="delete_link">Delete</a></td>-->

            </tr>
        <?php }
        //
        ?>

    </tbody>
</table>
<?php
if (isset($_GET['delete'])) {
    $post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id='{$post_id}' ";
    $delete_post = mysqli_query($connection, $query);
    confirm($delete_post);
    header("location: posts.php");
}
?>

<script>
    $(document).ready(() => {
        $(".delete_link").on('click', (event)=>{
            event.preventDefault();
            var post_id = event.target.dataset.postid;
            var delete_url = `posts.php?delete=${post_id}`;
            $(".modal_delete_link").attr("href", delete_url);
            $("#myModal").modal("show");
        })
    })
</script>