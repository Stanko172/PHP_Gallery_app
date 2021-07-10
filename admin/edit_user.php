<?php include("includes/header.php"); ?>

<?php

    if(!isset($_GET['id'])){
        redirect('users.php');
    }
    
    $user = new User();
    $msg = "";

    $user = $user->get_by_id($_GET['id']);

    if(isset($_POST['update'])){
        $user->username = $_POST['username'];
        $user->password = $_POST['username'];
        $user->first_name = $_POST['username'];
        $user->last_name = $_POST['username'];

        if($_FILES['user_image']['size'] == 0){
            $user->save();
            $msg = "Korisnik uspješno ažuriran";
        }else{
            $user->user_image = $_FILES['user_image']['name'];
            $user->tmp_path = $_FILES['user_image']['tmp_name'];
            if(move_uploaded_file($user->tmp_path, $user->image_path_local())){
                $user->save();
                $msg = "Korisnik uspješno ažuriran";
            }else{
                $msg = "Problem kod prijenosa slike!";
            }
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
                            Edit users  
                        </h1>
                        <div class="col-md-6 col-md-offset-3">
                            <?php echo $msg; ?>
                            <form action="edit_user.php?id=<?php echo $user->id; ?>" method="POST" enctype="multipart/form-data">
                            Upload user image: <input type="file" name="user_image"/><br />
                            <div class="form-row">
                                <div class="from-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $user->username; ?>"/>
                                </div> <br />

                                <div class="from-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" value="<?php echo $user->password; ?>"/>
                                </div><br />

                                <div class="from-group">
                                    <label for="first_name">First name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>"/>
                                </div><br />

                                <div class="from-group">
                                    <label for="last_name">Last name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control"value="<?php echo $user->last_name; ?>"/>
                                </div><br />

                                <button type="submit" name="update" class="btn btn-primary btn-sm btn-block">Update user</button>
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