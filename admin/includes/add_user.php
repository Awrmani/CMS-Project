<?php
if (isset($_POST['user_create'])) {
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

    $query = "INSERT INTO users(
              user_firstname, user_lastname, user_role, username, user_email, user_password) 
              VALUES('{$userFirstName}', '{$userLastName}', '{$userRole}', '{$username}', 
              '{$userEmail}', '{$userPassword}') ";

    $createUser = mysqli_query($connection, $query);

    confirmQuery($createUser);
}


?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <select class="form-select" name="user_role" id="user_role">
            <option value="admin">Admin</option>
            <option selected value="viewer">Viewer</option>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-gorup">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="user_create" value="Create User">
    </div>
</form>