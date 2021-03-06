<?php include("includes/header.php"); ?>

<?php

    $photos = Photo::get_all();

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
                            Photos  
                        </h1>
                        <div>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Slika</th>
                                <th scope="col">Author</th>
                                <th scope="col">Naziv</th>
                                <th scope="col">Tip</th>
                                <th scope="col">Veličina</th>
                                <th scope="col">Broj komentara</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  foreach($photos as $photo) : ?>
                                <tr>
                                <td><img src=<?php echo $photo->image_path() ?> width = "125px" height = "125px" />
                                
                                    <div class="action_links">
                                        <a href="delete_photo.php?id=<?php echo $photo->id;?>">Delete</a>
                                        <a href="edit_photo.php?id=<?php echo $photo->id;?>">Edit</a>
                                        <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a>
                                    </div>
                                
                                </td>
                                <td><?php echo $photo->author; ?></td>
                                <td><?php echo $photo->title; ?></td>
                                <td><?php echo $photo->type; ?></td>
                                <td><?php echo $photo->size; ?></td>
                                <td><?php echo count(Comment::get_all_comments_for_image($photo->id)); ?></td>
                                </tr>
                            </tbody>
                            <? endforeach ?>
                        </table>
                        </div>
                    </div>
                </div>

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>