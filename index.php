<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->
<?php include "includes/navigation.php" ?>
<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">


            <?php
            $query = "SELECT * FROM posts ";

            $allPosts = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($allPosts)) {
                $postId = $row['post_id'];
                $postTitle = $row['post_title'];
                $postAuthor = $row['post_author'];
                $postDate = $row['post_date'];
                $postImage = $row['post_image'];
                $postContent = substr($row['post_content'], 0, 200);
                $postStatus = $row['post_status'];

                if ($postStatus !== "published") {
                    print("<h1 class='text-center'>Sorry! There are no posts to display!</h1>");
                } else {
            ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php print($postId); ?>"><?php print($postTitle); ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php print($postAuthor); ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php print($postDate); ?></p>
                <hr>
                <a href="post.php?p_id=<?php print($postId); ?>">
                    <img class="img-responsive" src="images/<?php print($postImage); ?>" alt="PHP Logo">
                </a>
                <hr>
                <p><?php print($postContent); ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php
                }
            }
            ?>

            
        </div>

        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>

    </html>