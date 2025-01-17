<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

<!-- Navigation -->

<?php include "includes/navigation.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

            if (isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];
            }


            $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
            $select_all_posts_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

            ?>




                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"> <?php echo $post_title ?> </a>
                </h2>
                <p class="lead">
                    by <a href="index.php"> <?php echo $post_author ?> </a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p> <?php echo $post_content ?> </p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php  } ?>



            <!-- Blog Comments -->

            <!-- Comments Form -->



            <?php

            if (isset($_POST['comment'])) {
                $the_post_id = $_GET['p_id'];

                $comment_author = mysqli_real_escape_string($connection, $_POST['comment_author']);
                $comment_email = mysqli_real_escape_string($connection, $_POST['comment_email']);
                $comment_content = mysqli_real_escape_string($connection, $_POST['comment_content']);
                $comment_date = date('Y-m-d H:i:s'); // Use consistent date format

                $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                $query .= " VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                $query_result = mysqli_query($connection, $query);

                if (!$query_result) {
                    die("QUERY FAILED: " . mysqli_error($connection));
                }


                $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $the_post_id";

                $update_query = mysqli_query($connection, $query);

                if(!$update_query){
                    die("Query Failed" . mysqli_error($connection));
                }


            }











            // if (isset($_POST['comment'])) {
            //     // $comment_id  = $_POST['comment_id'];
            //     // $comment_post_id  = $_POST['comment_post_id'];
            //     // $comment_status = $_POST['comment_staus'];
            //     $comment_author = $_POST['comment_author'];
            //     $comment_email = $_POST['comment_email'];
            //     $comment_content = $_POST['comment_content'];
            //     $comment_date = date('Y-m-d');

            //     $query = "INSERT INTO comments (comment_author, comment_email, comment_content, comment_date) ";
            //     $query .= " VALUES ('{$comment_author}', '{$comment_email}', '{$comment_content}', now(), '{$comment_date}') ";

            //     $query_result = mysqli_query($connection, $query);

            //     if (!$query_result) {
            //         die("QUERY FAILED!") . mysqli_error($connection);
            //     }


            // }
            ?>





            <div class="well">
                <h4>Leave a Comment:</h4>


                <form role="form" method="POST" action="">



                    <div class="forn-group">
                        <label for="author" class="">Author</label>
                        <input type="text" name="comment_author" class="form-control float-left" placeholder="Name">
                    </div>
                    <br>
                    <div class="forn-group">
                        <label for="email" class="">Email</label>
                        <input type="email" name="comment_email" class="form-control float-right" placeholder="Email">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="content">Your comment</label>
                        <textarea class="form-control" name="comment_content" rows="3" placeholder="enter comment..."></textarea>
                    </div>
                    <button type="submit" name="comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

            <!-- Posted Comments -->



            <?php
            $query = "SELECT * FROM comments WHERE comment_post_id  = {$the_post_id} ";
            $query .= "AND comment_status = 'Approved' ";
            $query .= "ORDER BY comment_id DESC ";
            $select_comments_query = mysqli_query($connection, $query);

            if (!$select_comments_query) {
                die('Query Failed' . mysqli_error($connection));
            }


            while ($row = mysqli_fetch_assoc($select_comments_query)) {
                $comment_author = $row['comment_author'];
                $comment_date = $row['comment_date'];
                $comment_content = $row['comment_content'];


            ?>




                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $comment_author ?>
                            <small><?php echo $comment_date ?></small>
                        </h4>
                        <?php echo $comment_content ?>
                    </div>
                </div>

                <!-- Comment -->
            <?php } ?>









            <!-- Third Blog Post -->

            <hr>



        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php include "includes/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php" ?>