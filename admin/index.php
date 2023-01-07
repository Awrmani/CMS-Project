<?php include "includes/admin_header.php"; ?>

<div id="wrapper">



    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to the Admin page

                        <small><?php print($_SESSION['username']); ?></small>
                    </h1>
                </div>
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM posts ";
                                    $allPosts = mysqli_query($connection, $query);
                                    if (confirmQuery($allPosts)) {
                                        $postCount = mysqli_num_rows($allPosts);
                                        print("<div class='huge'>{$postCount}</div>");
                                    } else {
                                        $postCount = -1;
                                    }
                                    ?>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments ";
                                    $allComments = mysqli_query($connection, $query);
                                    if (confirmQuery($allComments)) {
                                        $commentCount = mysqli_num_rows($allComments);
                                        print("<div class='huge'>{$commentCount}</div>");
                                    } else {
                                        $commentCount = -1;
                                    }
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users ";
                                    $allUsers = mysqli_query($connection, $query);
                                    if (confirmQuery($allUsers)) {
                                        $userCount = mysqli_num_rows($allUsers);
                                        print("<div class='huge'>{$userCount}</div>");
                                    } else {
                                        $userCount = -1;
                                    }
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM categories ";
                                    $allCategories = mysqli_query($connection, $query);
                                    if (confirmQuery($allCategories)) {
                                        $categoryCount = mysqli_num_rows($allCategories);
                                        print("<div class='huge'>{$categoryCount}</div>");
                                    } else {
                                        $categoryCount = -1;
                                    }
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php
            $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
            $draftPosts = mysqli_query($connection, $query);
            if (confirmQuery($draftPosts)) {
                $draftPostCount = mysqli_num_rows($draftPosts);
            }

            $query = "SELECT * FROM comments WHERE comment_status = 'rejected' ";
            $RejectedComments = mysqli_query($connection, $query);
            if (confirmQuery($RejectedComments)) {
                $RejectedCommentCount = mysqli_num_rows($RejectedComments);
            }

            $query = "SELECT * FROM users WHERE user_role = 'viewer' ";
            $viewerUsers = mysqli_query($connection, $query);
            if (confirmQuery($viewerUsers)) {
                $viewerUserCount = mysqli_num_rows($viewerUsers);
            }
            ?>

            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                            $elements = ['Active Post', 'Draft Posts', 'Comments', 'Rejected Comments', 'Users', 'Viewers', 'Categories'];
                            $count = [$postCount, $draftPostCount, $commentCount, $RejectedCommentCount, $userCount, $viewerUserCount, $categoryCount];

                            for ($i = 0; $i < 7; $i++) {
                                print("['{$elements[$i]}', {$count[$i]}], ");
                            }
                            ?>
                         ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<?php include "includes/admin_footer.php"; ?>