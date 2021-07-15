<?php include("includes/header.php"); ?>

<?php  

    $photos = Photo::get_all();

?>

        <div class="row">

            <!-- Blog Entries Column -->
            <?php foreach($photos as $photo) : ?>
            <div class="col-md-4" style="margin-top: 25px;">

    
            
            <div class="card" style="width: 250px;">
                <img class="card-img-top" src="<?php echo "admin" . DS . $photo->image_path(); ?>" alt="Card image cap" width="250" height="250">
                <div class="card-body">
                    <h3 class="card-title text-center"><?php echo $photo->title; ?></h3>
                    <a href="photo.php?id=<?php echo $photo->id;?>" class="btn btn-primary btn-block">Opširnije</a>
                </div>
            </div>
         

            </div>

            <?php endforeach; ?>




        </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>

<style>
.card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}
</style>
