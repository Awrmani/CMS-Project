<?php
if (isset($_GET['u_id'])) {
    $userId = $_GET['u_id'];

    $query = "SELECT * FROM users WHERE user_id = {$userId} ";
    $userEdit = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($userEdit)) {
        $userId = $row['user_id'];
        $username = $row['username'];
        $userPassword = $row['user_password'];
        $userFirstName = $row['user_firstname'];
        $userLastName = $row['user_lastname'];
        $userEmail = $row['user_email'];
        $userImage = $row['user_image'];
        $userRole = $row['user_role'];
    }
}


if (isset($_POST['user_update'])) {
    $userFirstName = $_POST['user_firstname'];
    $userLastName = $_POST['user_lastname'];
    $userRole = $_POST['user_role'];
    $username = $_POST['username'];

    // $postImage = $_FILES['post_image']['name'];
    // $postImageTemp = $_FILES['post_image']['tmp_name'];

    $userEmail = $_POST['user_email'];
    $userPassword = $_POST['user_password'];
    // $postDate = date('d-m-y');

    //move_uploaded_file($postImageTemp, "../images/$postImage");

    // if (empty($postImage)) {
    //     $query = "SELECT * FROM posts WHERE post_id = {$postId} ";
    //     $selectImage = mysqli_query($connection, $query);

    //     while ($row = mysqli_fetch_array($selectImage)) {
    //         $postImage = $row['post_image'];
    //     }
    // }

    $query = "UPDATE users SET 
              user_firstname = '{$userFirstName}', 
              user_lastname = '{$userLastName}', 
              user_role = '{$userRole}', 
              username = '{$username}', 
              user_email = '{$userEmail}', 
              user_password = '{$userPassword}' 
              WHERE user_id = {$userId} ";

    $udpateUser = mysqli_query($connection, $query);
    confirmQuery($udpateUser);
    header("Location: users.php");
}


?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php print($userFirstName) ?>">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php print($userLastName) ?>">
    </div>

    <div class="form-group">
        <select class="form-select" name="user_role" id="user_role">
            <option <?php if ($userRole === "admin") {print("selected");} ?> value="admin">Admin</option>
            <option <?php if ($userRole === "viewer") {print("selected");} ?> value="viewer">Viewer</option>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php print($username) ?>">
    </div>

    <div class="form-gorup">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php print($userEmail) ?>">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" value="<?php print($userPassword) ?>">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="user_update" value="Update User">
    </div>
</form>