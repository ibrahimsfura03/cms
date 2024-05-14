<?php
    
function confirmQuery($result){
    global $connection;
    if(!$result){
        die("QUERY FAILED!" . mysqli_error($connection));
    }

}


function insert_category(){

    global $connection;

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo '<b  style="float: right;" class="text-danger float-right">Invalid Inputs!</b>';
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUE('{$cat_title}')";

            $create_cat_query  = mysqli_query($connection, $query);

            if (!$create_cat_query) {
                die('Query Failed!' . mysqli_error($connection));
            }
        }
    }
}

function findAllCategories(){
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Update</a></td>";
        echo "<tr>";
    }
}

function deleteCategory(){
    global $connection;

    if (isset($_GET['delete'])) {
        $del_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$del_cat_id} ";
        $delete_cat_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}

?>