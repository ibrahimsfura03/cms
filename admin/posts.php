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
                    <!-- /table -->

    
                    <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        }else {
                             $source = "";
                         }
                        switch($source){
                            case 'add_post';
                            include "add_post.php";
                            break;
                            
                            case 'edit_post';
                            include "includes/edit_post.php";
                            break;

                            case '30';
                            echo 'GOOD 30';
                            break;

                            default:
                            //code
                            include "includes/view_all_posts.php";
                            break;

                        }
                    ?>




                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
</div>
<!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>