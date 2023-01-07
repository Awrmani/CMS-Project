<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php
            if (isset($_GET['p_id'])) {
                $postId = $_GET['p_id'];
            }

            $query = "SELECT * FROM posts WHERE post_id = $postId ";

            $allPosts = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($allPosts)) {
                $postTitle = $row['post_title'];
                $postAuthor = $row['post_author'];
                $postDate = $row['post_date'];
                $postImage = $row['post_image'];
                $postContent = $row['post_content'];
            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php print($postTitle); ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php print($postAuthor); ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php print($postDate); ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php print($postImage); ?>" alt="PHP Logo">
                <hr>
                <p><?php print($postContent); ?></p>

                <hr>

            <?php
            }
            ?>

            <!-- Blog Comments -->
            <?php
            if (isset($_POST['comment_create'])) {
                $commentPostId = $_GET['p_id'];
                echo "<h1>Works</h1>";
                $commentAuthor = $_POST['comment_author'];
                $commentEmail = $_POST['comment_email'];
                $commentContent = $_POST['comment_content'];

                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, 
                                                comment_content, comment_status, comment_date) 
                          VALUES ($commentPostId, '{$commentAuthor}', '{$commentEmail}', 
                          '{$commentContent}', 'waiting', now()) ";

                $createComment = mysqli_query($connection, $query);
                confirmQuery($createComment);

                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 
                          WHERE post_id = {$postId}";
                $commentCount = mysqli_query($connection, $query);
                confirmQuery($commentCount);
            }


            ?>

            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <label for="comment_author">Author</label>
                        <input type="text" class="form-control" name="comment_author">
                    </div>

                    <div class="form-group">
                        <label for="comment_email">Email</label>
                        <input type="email" class="form-control" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="comment_content">Your Comment</label>
                        <textarea class="form-control" rows="3" name="comment_content"></textarea>
                    </div>
                    <button type="submit" name="comment_create" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->

            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id = {$postId} 
                      AND comment_status = 'approved' 
                      ORDER BY comment_date DESC ";
            $showComment = mysqli_query($connection, $query);
            confirmQuery($showComment);

            while ($row = mysqli_fetch_array($showComment)) {
                $commentDate = $row['comment_date'];
                $commentContent = $row['comment_content'];
                $commentAuthor = $row['comment_author'];
            ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php print($commentAuthor); ?>
                            <small><?php print($commentDate); ?></small>
                        </h4>
                        <?php print($commentContent); ?>
                    </div>
                </div>
            <?php
            }
            ?>


        </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>

    </html>