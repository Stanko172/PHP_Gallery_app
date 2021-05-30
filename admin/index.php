<?php include("includes/header.php");?>

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
                            Blank Page
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
                    </div>
                </div>

                <?php 
                
                    if($database->connection){
                        echo "DB connection succes!";
                    }

                    $result = User::get_user(1);
                    echo "<br />" . $result->username;

                    echo "<br /> -------";

                    $users = User::get_all_users("SELECT * FROM users;");
                    foreach( $users as $user){
                        echo "<br />" . $user->username;
                    }

                    //Testiranje ubacivanja korisnika u bazu podataka
                    /*$user = new User();
                    $user->username = "Mirko123";
                    $user->password = "12345678";
                    $user->first_name = "Mirko";
                    $user->last_name = "Ptica";

                    $user->create();*/

                    /*
                    $user = User::get_user(3);
                    $user->username = 'JaneDoe123';

                    $user->update();
                    */

                    $user = new User();
                    $user = $user->get_user(4);
                    print_r($user);
                    print_r($user->delete());




                    



                ?>

                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>