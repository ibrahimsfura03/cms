<table class="table table-striped table-hover table-dark table-borderd">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>   
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];


            echo "<tr>";

            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_role</td>";


            // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            // $select_comment_query = mysqli_query($connection, $query);

            // while ($row = mysqli_fetch_assoc($select_comment_query)) {
            //     $post_id = $row['post_id'];
            //     $post_title = $row['post_title'];

            //     echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            // }

            // echo "<td>$comment_date</td>";

            echo "<td><a href='comments.php?approve='>Aproved</a></td>";
            echo "<td><a href='comments.php?unapprove='>Unaproved</a></td>";
            echo "<td><a href='comments.php?delete='>Delete</a></td>";

            echo "</tr>";
        }
        ?>


    </tbody>
</table>

<?php
//////////////////////////  UNAPPROVE //////////////////////
if (isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$the_comment_id} ";
    $unapprove_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

/////////////////////////// APPROVE ///////////////////////////
if (isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$the_comment_id} ";
    $approve_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}
//////////////////////////// DELETE /////////////////////////////
if (isset($_GET['delete'])) {
    $the_comment_id = $_GET['delete'];

    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
    $delete_query = mysqli_query($connection, $query);

    header("Location: comments.php");
}
?>