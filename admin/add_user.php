<?php include("includes/header.php"); ?>

<?php
    
    $user = new User();
    $msg = "";

    if(isset($_POST['create'])){
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];

        if($user->set_file($_FILES['user_image'])){
            if($user->create()){
                if(move_uploaded_file($user->tmp_path, $user->image_path_local())){
                    $msg = "Korisnik uspješno kreiran";
                }else{
                    $msg = "Problem kod prijenos slike!";
                }
            }else{
                $msg = "Dogodila se greška!";
            }
        }else{
            $msg = "Neuspješan prijenos slike!";
        }
    }

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
                    <div class="col-md-12">
                        <h1 class="page-header">
                            users  
                        </h1>
                        <div class="col-md-6 col-md-offset-3">
                            <?php echo $msg; ?>
                            <form action="add_user.php" method="POST" enctype="multipart/form-data">
                            Upload user image: <input type="file" name="user_image" /><br />
                            <div class="form-row">
                                <div class="from-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control"/>
                                </div> <br />

                                <div class="from-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control"/>
                                </div><br />

                                <div class="from-group">
                                    <label for="first_name">First name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control"/>
                                </div><br />

                                <div class="from-group">
                                    <label for="last_name">Last name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control"/>
                                </div><br />

                                <button type="submit" name="create" class="btn btn-primary btn-sm btn-block">Add user</button>
                            </div>
                            </form>
                        </div>
               
                    </div>
                </div>

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>