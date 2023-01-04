<?php
function confirmQuery($query)
{
    global $connection;
    $result = True;
    if (!$query) {
        $result = False;
        die("QUERY FAILED" . mysqli_error($connection));
    }

    return $result;
}

function insertCategories()
{
    global $connection;

    if (isset($_POST['submit'])) {
        $cat = $_POST['cat_title'];

        if ($cat == "" || empty($cat)) {
            print("This field should not be empty");
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE ('{$cat}') ";

            $createCatQuery = mysqli_query($connection, $query);

            confirmQuery($createCatQuery);
        }
    }
}

function findAllCategories()
{
    global $connection;

    $query = "SELECT * FROM categories";
    $allCats = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($allCats)) {
        $catId = $row['cat_id'];
        $catTitle = $row['cat_title'];

        print("<tr>");
        print("<td>{$catId}</td>");
        print("<td>{$catTitle}</td>");
        print("<td><a href='categories.php?delete={$catId}'>Delete</a></td>");
        print("<td><a href='categories.php?edit={$catId}'>Edit</a></td>");
        print("</tr>");
    }
}

function deleteCategories()
{
    global $connection;

    if (isset($_GET['delete'])) {
        $catId = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$catId} ";
        $deleteCat = mysqli_query($connection, $query);

        header("Location: categories.php");
    }
}
