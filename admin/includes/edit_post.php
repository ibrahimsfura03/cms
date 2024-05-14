<?php
if (isset($_GET['p_id'])) {
    $the_post_edit = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = $the_post_edit ";
$edit_query = mysqli_query($connection, $query);


while ($row = mysqli_fetch_assoc($edit_query)) {
    $post_id = $row['post_id'];
    $post_category_id = $row['post_category_id'];
    $title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comment = $row['post_comment_count'];
    $post_status = $row['post_status'];
}

if (isset($_POST['updatepost'])) {


    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('Y-m-d');
    $post_comment_count = 4;

//////////////////////////////////////////////////////////////////////////////////////////////////

    // $post_title = $_POST['post_title'];
    // $post_author = $_POST['post_author'];
    // $post_category_id = $_POST['post_category_id'];
    // $post_status = $_POST['post_status'];

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    // $post_tags = $_POST['post_tags'];
    // $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)){
        $query = "SELECT * FROM posts WHERE post_id = $the_post_edit ";
        $select_image = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_image)){
            $post_image = $row['post_image'];
        }

    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = '{$the_post_edit}' ";

    $update_post = mysqli_query($connection, $query);

    confirmQuery($update_post);

}

?>

<form action="" method="POST" enctype="multipart/form-data" class="">
    <div class="form-group">
        <label for="postTitle">Post Title</label>
        <input value="<?php echo $title; ?>" type="text" type="text" class="form-control w-100" name="post_title">
    </div>
    <div class="form-group">
        <select name="post_category_id" class="form-control" id="">
            <option value="">Choose Category</option>
            <?php
            $query = "SELECT * FROM categories";
            $select_categories_id = mysqli_query($connection, $query);

            findAllCategories($select_categories_id);

            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>


    </div>
    <div class="form-group">
        <label for="postAuthor">Post Author</label>
        <input type="text" value="<?php echo $post_author; ?>" class="form-control w-100" name="post_author">
    </div>
    <div class="form-group">
        <label for="postStatus">Post Status</label>
        <input type="text" value="<?php echo $post_status; ?>" class="form-control w-100" name="post_status">

    </div>
    <div class="form-group">
        <img src="../images/<?php echo $post_image; ?> " name="image" alt="postImg" width="100">
        <br>
        <br>
        <input type="file" class="" name="image">
    </div>
    <div class="form-group">
        <label for="postTags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags; ?>" class="form-control w-100" name="post_tags">
    </div>
    <div class="form-group">
        <label for="postContent">Post Content</label> <br>
        <textarea name="post_content" value="" rows="7" cols="150"><?php echo $post_content; ?>
        </textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Update Post" name="updatepost" class="btn btn-danger">
    </div>


</form>