<?php
if (isset($_GET['p_id'])) {
    $postId = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = {$postId}";
$postEdit = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($postEdit)) {
    //$postId = $row['post_id'];
    $postAuthor = $row['post_author'];
    $postTitle = $row['post_title'];
    $postCatId = $row['post_category_id'];
    $postStatus = $row['post_status'];
    $postImage = $row['post_image'];
    $postContent = $row['post_content'];
    $postTags = $row['post_tags'];
    $postCommentCNT = $row['post_comment_count'];
    $postDate = $row['post_date'];
}

if (isset($_POST['post_update'])) {
    $postAuthor = $_POST['post_author'];
    $postTitle = $_POST['post_title'];
    $postCatId = $_POST['post_category'];
    $postStatus = $_POST['post_status'];
    $postImage = $_FILES['post_image']['name'];
    $postImageTemp = $_FILES['post_image']['tmp_name'];
    $postContent = $_POST['post_content'];
    $postTags = $_POST['post_tags'];

    move_uploaded_file($postImageTemp, "../images/{$postImage}");

    if (empty($postImage)) {
        $query = "SELECT * FROM posts WHERE post_id = {$postId} ";
        $selectImage = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($selectImage)) {
            $postImage = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET 
              post_title = '{$postTitle}', 
              post_category_id = '{$postCatId}', 
              post_date = now(), 
              post_author = '{$postAuthor}', 
              post_status = '{$postStatus}', 
              post_tags = '{$postTags}', 
              post_content = '{$postContent}', 
              post_image = '{$postImage}' 
              WHERE post_id = {$postId} ";

    $udpatePost = mysqli_query($connection, $query);

    if (confirmQuery($udpatePost)) {
        header("Location: posts.php");

    }
    
}



?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php print("$postTitle"); ?>" type="text" class="form-control" name="post_title">
    </div>

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
        <input value="<?php print("$postAuthor"); ?>" type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php print("$postStatus"); ?>" type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <img class="img-responsive" width="100" src="../images/<?php print($postImage); ?>" alt="Post Image">
        <input type="file" name="post_image">
    </div>

    <div class="form-gorup">
        <label for="post_tags">Post Tags</label>
        <input value="<?php print("$postTags"); ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php print("$postContent"); ?>"</textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="post_update" value="Update Post">
    </div>
</form>