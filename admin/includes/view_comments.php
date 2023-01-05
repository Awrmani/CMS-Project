<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $query = "SELECT * FROM comments";
        $allComments = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($allComments)) {
            $commentId = $row['comment_id'];
            $commentPostId = $row['comment_post_id'];
            $commentAuthor = $row['comment_author'];
            $commentEmail = $row['comment_email'];
            $commentContent = $row['comment_content'];
            $commentStatus = $row['comment_status'];
            $commentDate = $row['comment_date'];

            print("<tr>");
            print("<td>{$commentId}</td>");
            print("<td>{$commentAuthor}</td>");
            print("<td>{$commentContent}</td>");


            // $query = "SELECT * FROM categories WHERE cat_id = {$postCatId}";
            // $selectCatId = mysqli_query($connection, $query);
            // confirmQuery($selectCatId);
            // $catTitle;
            // while ($row = mysqli_fetch_assoc($selectCatId)) {
            //     $catId = $row['cat_id'];
            //     $catTitle = $row['cat_title'];
            //     print("<td>{$catTitle}</td>");
            // }

            print("<td>{$commentEmail}</td>");
            print("<td>{$commentStatus}</td>");

            $query = "SELECT * FROM posts WHERE post_id = {$commentPostId}";
            $commentPost = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($commentPost)) {
                $postId = $row['post_id'];
                $postTitle = $row['post_title'];
                print("<td><a href='../post.php?p_id={$postId}'>{$postTitle}</a></td>");
            }


            print("<td>{$commentDate}</td>");
            //print("<td><a href='posts.php?source=edit_post&p_id={$commentId}'>Approve</a></td>");
            print("<td><a href='comments.php?approve={$commentId}'>Approve</a></td>");
            print("<td><a href='comments.php?reject={$commentId}'>Reject</a></td>");
            print("<td><a href='comments.php?delete={$commentId}'>Delete</a></td>");
            print("</tr>");
        }
        ?>

    </tbody>
</table>

<?php
if (isset($_GET['approve'])) {
    $commentId = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$commentId} ";
    $approveComment = mysqli_query($connection, $query);

    confirmQuery($approveComment);

    header("Location: comments.php");
}

if (isset($_GET['reject'])) {
    $commentId = $_GET['reject'];

    $query = "UPDATE comments SET comment_status = 'rejected' WHERE comment_id = {$commentId} ";
    $rejectComment = mysqli_query($connection, $query);

    confirmQuery($rejectComment);

    header("Location: comments.php");
}

if (isset($_GET['delete'])) {
    $commentId = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = {$commentId} ";
    $deleteComment = mysqli_query($connection, $query);

    confirmQuery($deleteComment);

    header("Location: comments.php");
}

?>