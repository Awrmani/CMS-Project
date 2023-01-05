<?php include "includes/admin_header.php"; ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <h1 class="page-header">
                    Welcome to the Admin page
                    <small>Author</small>
                </h1>

                <?php
                if (isset($_GET['source'])) {
                    $source = $_GET['source'];

                } else {
                    $source = '';
                }

                switch($source) {
                    case 'add_user';
                    include "includes/add_user.php";
                    break;

                    case 'edit_user';
                    include "includes/edit_user.php";
                    break;

                    default:
                    include "includes/view_users.php";


                }
                ?>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<?php include "includes/admin_footer.php"; ?>