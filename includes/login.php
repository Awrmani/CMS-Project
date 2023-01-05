<?php include "db.php"; ?>
<?php include "../admin/functions.php"; ?>
<?php session_start(); ?>

<?php
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $user = mysqli_query($connection, $query);
    confirmQuery($user);

    while($row = mysqli_fetch_array($user)) {
        $dbUserId = $row['user_id'];
        $dbUsername = $row['username'];
        $dbUserPassword = $row['user_password'];
        $dbUserFirstName = $row['user_firstName'];
        $dbUserLastName = $row['user_lastName'];
        $dbUserRole = $row['user_role'];
    }

    if ($username === $dbUsername && $password === $dbUserPassword) {
        $_SESSION['username'] = $dbUsername;
        $_SESSION['first_name'] = $dbUserFirstName;
        $_SESSION['last_name'] = $dbUserLastName;
        $_SESSION['user_role'] = $dbUserRole;

        header("Location: ../admin");
    } else {
        header("Location: ../index.php");
    }
}
?>