<?php include("includes/header.php"); ?>

<?php
    $msg = ""; 
    if(isset($_POST['submit'])){
        $photo = new Photo();
        $photo->author = $_POST['author'];
        $photo->caption = $_POST['caption'];
        $photo->description = $_POST['description'];
        $photo->title = $_POST['title'];
        $photo->date_and_time = date("Y-m-d") . " " . date("h:i:sa");
        if($photo->set_file($_FILES['file_upload'])){
            if($photo->save()){
                $msg = "Slika uspješno učitana.";
            }else{
                $msg = join("<br />", $photo->errors);
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
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Upload  
                        </h1>
                        <div class="col-md-6 col-md-offset-3 justify-center">
                            <?php echo $msg;?>
                            <form action="upload.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" id="author" name="author" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" id="title" name="title" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label for="caption">Caption</label>
                                    <input type="text" id="caption" name="caption" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" rows="10" cols="10" id="description" name="description" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <input type="file" name="file_upload">
                                </div>

                                <input type="submit" name="submit"/>
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