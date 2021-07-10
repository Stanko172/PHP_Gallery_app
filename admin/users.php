<?php include("includes/header.php"); ?>

<?php
    
    $users = user::get_all();

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
                            users  
                        </h1>
                        <div>
                        <a type="button" href="add_user.php" class="btn btn-primary btn-md">Add user</a>    
                        <br />
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Slika</th>
                                <th scope="col">ID</th>
                                <th scope="col">Naziv</th>
                                <th scope="col">Tip</th>
                                <th scope="col">Veličina</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  foreach($users as $user) : ?>
                                <tr>
                                <td><img src=<?php echo $user->image_path() ?> width = "125px" height = "125px" />
                                
                                    <div class="action_links">
                                        <a href="delete_user.php?id=<?php echo $user->id;?>">Delete</a>
                                        <a href="edit_user.php?id=<?php echo $user->id;?>">Edit</a>
                                        <a href="delete_user.php">View</a>
                                    </div>
                                
                                </td>
                                <td><?php echo $user->id; ?></td>
                                <td><?php echo $user->username; ?></td>
                                <td><?php echo $user->first_name; ?></td>
                                <td><?php echo $user->last_name; ?></td>
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