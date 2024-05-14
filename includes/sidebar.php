     <div class="col-md-4">

         <!-- Blog Search Well -->
         <div class="well">
             <h4>Blog Search</h4>
             <form action="search.php" method="post">
                 <div class="input-group">
                     <input name="search" type="text" class="form-control">
                     <span class="input-group-btn">
                         <button name="submit" class="btn btn-default" type="submit">
                             <span class="glyphicon glyphicon-search"></span>
                         </button>
                     </span>
                 </div>
             </form>
             <!-- search form -->
             <!-- /.input-group -->
         </div>



         <h1 class="page-header">
             Page Heading
             <small>Secondary Text</small>
         </h1>

         <!-- First Blog Post -->
         <!-- <h2>
             <a href="#"> <?php echo $post_title ?> </a>
         </h2>
         <p class="lead">
             by <a href="index.php"> <?php echo $post_author ?> </a>
         </p>
         <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?> </p>
         <hr>
         <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
         <hr>
         <p> <?php echo $post_content ?> </p> -->
         <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

         <hr>

         <!-- Third Blog Post -->

         <hr>

         <!-- Pager -->
         <ul class="pager">
             <li class="previous">
                 <a href="#">&larr; Older</a>
             </li>
             <li class="next">
                 <a href="#">Newer &rarr;</a>
             </li>
         </ul>

         <!-- Blog Categories Well -->
         <div class="well">


             <?php
                $querry = "SELECT * FROM categories";
                $select_categories_sidebar = mysqli_query($connection, $querry);

                ?>


             <h4>Blog Categories</h4>
             <div class="row">
                 <div class="col-lg-12">
                     <ul class="list-unstyled">
                      <?php

                        while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];

                            echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                        }
                      ?>
                     </ul>
                 </div>
                 <!-- /.col-lg-6 -->
                 
                 <!-- /.col-lg-6 -->
             </div>
             <!-- /.row -->
         </div>

         <!-- Side Widget Well -->
         <?php include "widget.php"; ?>

     </div>