<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Change to Admin</th>
            <th>Change to Viewer</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $query = "SELECT * FROM users";
        $allUsers = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($allUsers)) {
            $userId = $row['user_id'];
            $username = $row['username'];
            $userPassword = $row['user_password'];
            $userFirstName = $row['user_firstname'];
            $userLastName = $row['user_lastname'];
            $userEmail = $row['user_email'];
            $userImage = $row['user_image'];
            $userRole = $row['user_role'];

            print("<tr>");
            print("<td>{$userId}</td>");
            print("<td>{$username}</td>");
            print("<td>{$userFirstName}</td>");


            // $query = "SELECT * FROM categories WHERE cat_id = {$postCatId}";
            // $selectCatId = mysqli_query($connection, $query);
            // confirmQuery($selectCatId);
            // $catTitle;
            // while ($row = mysqli_fetch_assoc($selectCatId)) {
            //     $catId = $row['cat_id'];
            //     $catTitle = $row['cat_title'];
            //     print("<td>{$catTitle}</td>");
            // }

            print("<td>{$userLastName}</td>");
            print("<td>{$userEmail}</td>");
            print("<td>{$userRole}</td>");

            // $query = "SELECT * FROM posts WHERE post_id = {$commentPostId}";
            // $commentPost = mysqli_query($connection, $query);
            // while($row = mysqli_fetch_assoc($commentPost)) {
            //     $postId = $row['post_id'];
            //     $postTitle = $row['post_title'];
            //     print("<td><a href='../post.php?p_id={$postId}'>{$postTitle}</a></td>");
            // }


            //print("<td><a href='posts.php?source=edit_post&p_id={$commentId}'>Approve</a></td>");
            if ($userRole === "viewer") {
                print("<td><a href='users.php?makeadmin={$userId}'>Admin</a></td>");
                print("<td></td>");
            } else {
                print("<td></td>");
                print("<td><a href='users.php?makeviewer={$userId}'>Viewer</a></td>");
            }
            print("<td><a href='users.php?source=edit_user&u_id={$userId}'>Edit</a></td>");
            print("<td><a href='users.php?delete={$userId}'>Delete</a></td>");
            print("</tr>");
        }
        ?>

    </tbody>
</table>

<?php
if (isset($_GET['makeadmin'])) {
    $userId = $_GET['makeadmin'];

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$userId} ";
    $adminUser = mysqli_query($connection, $query);

    confirmQuery($adminUser);

    header("Location: users.php");
}

if (isset($_GET['makeviewer'])) {
    $userId = $_GET['makeviewer'];

    $query = "UPDATE users SET user_role = 'viewer' WHERE user_id = {$userId} ";
    $viewerUser = mysqli_query($connection, $query);

    confirmQuery($viewerUser);

    header("Location: users.php");
}

if (isset($_GET['delete'])) {
    $userId = $_GET['delete'];

    $query = "DELETE FROM users WHERE user_id = {$userId} ";
    $deleteUser = mysqli_query($connection, $query);

    confirmQuery($deleteUser);

    header("Location: users.php");
}

?>