<form action="" method="post">
    <div class="form-group">
        <label for="cat-title">Edit Category</label>

        <?php
        
            $catId = $_GET['edit'];

            $query = "SELECT * FROM categories WHERE cat_id = $catId";
            $allCatsId = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($allCatsId)) {
                $catId = $row['cat_id'];
                $catTitle = $row['cat_title'];
        ?>
                <input class="form-control" type="text" name="cat_title" value="<?php if(isset($catTitle)) {print($catTitle);} ?>">
        <?php
            }

            // Update Query
            if (isset($_POST['update'])) {
                $catUpdateTitle = $_POST['cat_title'];

                $query = "UPDATE categories SET cat_title = '{$catUpdateTitle}' WHERE cat_id = {$catId} ";
                $updateCat = mysqli_query($connection, $query);

                if (confirmQuery($updateCat)) {
                    header("Location: ./categories.php");
                }
            }
        ?>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update">
    </div>

</form>