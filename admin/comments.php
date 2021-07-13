<?php include("includes/header.php"); ?>

<?php

    $comments = Comment::get_all();

?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            
            <?php include("includes/top_nav.php") ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            
            <?php include("includes/side_nav.php") ?>

            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Comments
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Photo_ID</th>
                                <th scope="col">Author</th>
                                <th scope="col">Body</th>
                                <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  foreach($comments as $comment) : ?>
                                <tr>
                                <td><?php echo $comment->id; ?></td>
                                <td><?php echo $comment->photo_id; ?></td>
                                <td><?php echo $comment->author; ?></td>
                                <td><?php echo $comment->body; ?></td>
                                <td><a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a></td>
                                </tr>
                            </tbody>
                            <? endforeach ?>
                        </table>
                    </div>
                </div>

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>