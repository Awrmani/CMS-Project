<table class="table table-bordered table-hover">
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
        </tr>
    </thead>
    <tbody>

        <?php
        $query = "SELECT * FROM posts";
        $allPosts = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($allPosts)) {
            $postId = $row['post_id'];
            $postAuthor = $row['post_author'];
            $postTitle = $row['post_title'];
            $postCatId = $row['post_category_id'];
            $postStatus = $row['post_status'];
            $postImage = $row['post_image'];
            $postTags = $row['post_tags'];
            $postCommentCNT = $row['post_comment_count'];
            $postDate = $row['post_date'];

            print("<tr>");
            print("<td>{$postId}</td>");
            print("<td>{$postAuthor}</td>");
            print("<td>{$postTitle}</td>");


            $query = "SELECT * FROM categories WHERE cat_id = {$postCatId}";
            $selectCatId = mysqli_query($connection, $query);
            confirmQuery($selectCatId);
            $catTitle;
            while ($row = mysqli_fetch_assoc($selectCatId)) {
                $catId = $row['cat_id'];
                $catTitle = $row['cat_title'];
                print("<td>{$catTitle}</td>");
            }

            print("<td>{$postStatus}</td>");
            print("<td><img class='img-responsive' width='100' src='../images/{$postImage}' alt='image'></td>");
            print("<td>{$postTags}</td>");
            print("<td>{$postCommentCNT}</td>");
            print("<td>{$postDate}</td>");
            print("<td><a href='posts.php?source=edit_post&p_id={$postId}'>Edit</a></td>");
            print("<td><a href='posts.php?delete={$postId}'>Delete</a></td>");
            print("</tr>");
        }
        ?>

    </tbody>
</table>

<?php
if (isset($_GET['delete'])) {
    $postId = $_GET['delete'];

    $query = "DELETE FROM posts WHERE post_id = {$postId} ";
    $deletePost = mysqli_query($connection, $query);

    confirmQuery($deletePost);

    header("Location: posts.php");
}

?>