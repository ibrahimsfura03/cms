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
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Ibrahim</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-file"></i> Blank Page
                        </li>
                    </ol>

                    <div class="col-xs-6">
                        <!-- Full texts
                    cat_id
                    cat_title -->

                        <!-- ------------------------ ADD CAT ---------------------------------------- -->
                        <?php
                        insert_category()
                        ?>


                        <form action="" class="" method="post">
                            <div class="form-group">
                                <label for="cat_title" class="">Add categories</label>
                                <input type="text" class="form-control" name="cat_title" id="cat_title">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary yt-3" value="Add Category">
                            </div>
                        </form>



                        <!-- ------------------------ EDIT CAT ---------------------------------------- -->

                        <?php //////////////// UPDATE AND INCLUDE //////////////////; 
                        ?>

                        <?php
                        if (isset($_GET['edit'])) {
                            $the_cat_id = $_GET['edit'];

                            include "includes/update_categories.php";
                        }
                        ?>

                    </div>

                    <!-- ------------------------ CAT TABLE ---------------------------------------- -->
                    <div class="col-md-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php //// FIND ALL CATS ////////////// 
                                ?>
                                <?php
                                findAllCategories()
                                ?>


                                <!-- ------------------------ DELETE CAT ---------------------------------------- -->
                                <?php
                                deleteCategory();
                                ?>


                            </tbody>
                        </table>
                    </div>


                </div>


            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>