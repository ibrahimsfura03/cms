  <?php include "includes/admin_header.php" ?>
  <?php include "functions.php" ?>
  <?php ob_start(); ?>

  <div id="wrapper">

      <!-- Navigation -->

      <?php include "includes/admin_navigation.php" ?>

      <div id="page-wrapper">

          <div class="container-fluid">

              <!-- Page Heading -->
              <div class="row">
                  <div class="col-lg-12">
                      <!-- Page Heading -->
                      <div class="row">
                          <div class="col-lg-12">
                              <h1 class="page-header">
                                  Welcome to Admin
                                  <small>Ibrahim</small>
                              </h1>
                              <ol class="breadcrumb">
                                  <li>
                                      <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                                  </li>
                                  <li class="active">..
                                      <i class="fa fa-file"></i> Blank Page
                                  </li>
                              </ol>
                          </div>
                      </div>
                      <!-- /form -->




                      <?php

                        if (isset($_POST['createPost'])) {
                            $post_title = $_POST['post_title'];
                            $post_author = $_POST['post_author'];
                            $post_category_id = $_POST['post_category_id'];
                            $post_status = $_POST['post_status'];

                            $post_image = $_FILES['image']['name'];
                            $post_image_temp = $_FILES['image']['tmp_name'];

                            $post_tags = $_POST['post_tags'];
                            $post_content = $_POST['post_content'];
                            $post_date = date('Y-m-d H:i:s');

                            // Move the uploaded file
                            move_uploaded_file($post_image_temp, "../images/$post_image");

                            // Prepare the SQL statement
                            $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image,
              post_content, post_tags, post_status) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                            // Initialize a prepared statement
                            $stmt = mysqli_prepare($connection, $query);

                            // Bind parameters to the prepared statement (types: i=int, s=string)
                            mysqli_stmt_bind_param(
                                $stmt,
                                "issssss",
                                $post_category_id,
                                $post_title,
                                $post_author,
                                $post_date,
                                $post_image,
                                $post_content,
                                $post_tags,
                                $post_status
                            );

                            // Execute the prepared statement
                            $success = mysqli_stmt_execute($stmt);

                            // Check for query execution success
                            if ($success) {
                                echo "Post created successfully.";
                                header("Location: posts.php");
                                exit();
                            } else {
                                echo "Error creating post: " . mysqli_error($connection);
                            }

                            // Close the prepared statement
                            mysqli_stmt_close($stmt);
                        }

                        // if (isset($_POST['createPost'])) {
                        //     $post_title = $_POST['post_title'];
                        //     $post_author = $_POST['post_author'];
                        //     $post_category_id = $_POST['post_category_id'];
                        //     $post_status = $_POST['post_status'];

                        //     $post_image = $_FILES['image']['name'];
                        //     $post_image_temp = $_FILES['image']['tmp_name'];

                        //     $post_tags = $_POST['post_tags'];
                        //     $post_content = $_POST['post_content'];
                        //     $post_date = date('d-m-y');
                        //     $post_comment_count = 4;

                        //     move_uploaded_file($post_image_temp, "../images/$post_image" );

                        //     $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image,
                        //     post_content, post_tags, post_comment_count, post_status) ";

                        //     $query .= "VALUES({'$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_date}', '{$post_image}',
                        //     '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}') ";

                        //     $create_post_query = mysqli_query($connection, $query);

                        //     if(!$create_post_query){
                        //         die("Query FAILED!") . mysqli_error($connection);
                        //     }

                        // }
                        ?>








                      <form action="" method="POST" enctype="multipart/form-data" class="">
                          <div class="form-group">
                              <label for="postTitle">Post Title</label>
                              <input type="text" class="form-control w-100" name="post_title">
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
                              <input type="text" class="form-control w-100" name="post_author">
                          </div>
                          <div class="form-group">
                              <label for="postStatus">Post Status</label>
                              <input type="text" value="<?php echo $post_status; ?>" class="form-control w-100" name="post_status">

                          </div>
                          <!-- <div class="form-group">

                              <select name="post_status" class="form-control" id="">
                                  <option value="">Post Status</option>
                                  <option value="">Published</option>
                                  <option value="">Draft</option>
                                  <option value="">Void</option>
                              </select>
                          </div> -->
                          <div class="form-group">
                              <label for="postImage">Post Image</label>
                              <input type="file" class="" name="image">
                          </div>
                          <div class="form-group">
                              <label for="postTags">Post Tags</label>
                              <input type="text" class="form-control w-100" name="post_tags">
                          </div>
                          <div class="form-group">
                              <label for="postContent">Post Content</label> <br>
                              <textarea name="post_content" rows="7" cols="150"> </textarea>
                          </div>
                          <div class="form-group">
                              <input type="submit" value="Publish Post" name="createPost" class="btn btn-primary">
                          </div>


                      </form>


                  </div>
              </div>
              <!-- /.row -->

          </div>
          <!-- /.container-fluid -->

      </div>
  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/admin_footer.php" ?>