<?php
if (isset($_POST['post_create'])) {
    $postTitle = $_POST['post_title'];
    $postCatId = $_POST['post_category'];
    $postAuthor = $_POST['post_author'];
    $postStatus = $_POST['post_status'];

    $postImage = $_FILES['post_image']['name'];
    $postImageTemp = $_FILES['post_image']['tmp_name'];

    $postTags = $_POST['post_tags'];
    $postContent = $_POST['post_content'];
    $postDate = date('d-m-y');
    $postCommentCNT = 0;

    move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "INSERT INTO posts(
              post_category_id, post_title, post_author, post_date, post_image, 
              post_content, post_tags, post_comment_count, post_status) 
              VALUES('{$postCatId}', '{$postTitle}', '{$postAuthor}', now(), '{$postImage}', 
              '{$postContent}', '{$postTags}', '{$postCommentCNT}', '{$postStatus}') ";

    $createPost = mysqli_query($connection, $query);

    confirmQuery($createPost);
}


?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <!-- <div class="form-group">
        <label for="post_cat_id">Post Category Id</label>
        <input type="text" class="form-control" name="post_cat_id">
    </div> -->

    <div class="form-group">
        <select class="form-select" name="post_category" id="post_category">
            <?php
            $query = "SELECT * FROM categories ";
            $selectCat = mysqli_query($connection, $query);

            confirmQuery($selectCat);

            while ($row = mysqli_fetch_assoc($selectCat)) {
                $catId = $row['cat_id'];
                $catTitle = $row['cat_title'];

                print("<option value='{$catId}'>{$catTitle}</option>");
            }
            ?>

        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>

    <div class="form-gorup">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="post_create" value="Publish Post">
    </div>
</form>