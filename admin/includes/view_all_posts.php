                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Categories</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Date</th>
                                <th>Images</th>
                                <!-- <th>Contents</th> -->
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>




                            <?php
                            $query = "SELECT * FROM posts";
                            $select_posts = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_posts)) {
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


                                echo "<tr>";
                                echo "<td>$post_id</td>";


                                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
                                $selec_category_id = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_assoc($selec_category_id)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];


                                    echo "<td>{$cat_title}</td>";
                                    
                                }

                                
                                echo "<td>$title</td>";
                                echo "<td>$post_author</td>";
                                echo "<td>$post_date</td>";
                                echo "<td> <img src='../images/$post_image' alt='img' width='100'> </td>";
                                // echo "<td>$post_content</td>";
                                echo "<td>$post_tags</td>";
                                echo "<td>$post_comment</td>";
                                echo "<td>$post_status</td>";
                                echo "<td><a href=' posts.php?source=edit_post&p_id={$post_id}' class='btn btn-info'>Edit</a></td>";
                                echo "<td><a href=' posts.php?delete={$post_id}' class='btn btn-danger'>Delete</a></td>";
                                echo "</tr>";
                            }




                            ?>
                            <!-- <td>01</td>
                                <td>Ibrahim</td>
                                <td>Zed Shaws</td>
                                <td>OOP</td>
                                <td>Available</td>
                                <td><img src="./" alt="Thumb.jpg"></td>
                                <td>oop, new, free</td>
                                <td>this is very cool thing you know!</td>
                                <td>1/05/2024</td> -->


                        </tbody>
                    </table>

                    <!-- ////////////  Delete post /////////////// -->

                    <?php
                    if (isset($_GET['delete'])) {
                        $the_post_id = $_GET['delete'];

                        $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
                        $delete_query = mysqli_query($connection, $query);

                        header("Location: posts.php");
                    }
                    ?>

                    <!-- ////////////  Edit post /////////////// -->


        