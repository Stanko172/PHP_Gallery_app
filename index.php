<?php include("includes/header.php"); ?>

<?php  

    $page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $items_per_page = 4;
    $total_items_count = Photo::count_all();

    $paginate = new Paginate($page, $items_per_page, $total_items_count);

    $sql = "SELECT * FROM `photos` ";
    $sql .= "LIMIT {$paginate->items_per_page} ";
    $sql .= "OFFSET {$paginate->offset()}";

    $photos = Photo::activate_query($sql);
    //$photos = Photo::get_all();

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
            
            <div class="row">
                <ul class="pager">
                    <?php
                        if($paginate->has_next()){

                            echo "<li class='next'><a href='index.php?page=" . $paginate->next() . "'>Next</a></li>";

                        }

                        for($i = 1; $i <= $paginate->total_page(); $i++){
                            if($i == $paginate->page){
                                echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                            }else{
                                echo "<li ><a href='index.php?page={$i}'>{$i}</a></li>";
                            }
                        }


                        if($paginate->has_previous()){

                            echo "<li class='previous'><a href='index.php?page=" . $paginate->previous() . "'>Previous</a></li>";
                        
                        }
                    ?>
                    
                </ul>
            </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>

<style>
.card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}

.pager .active a{
    background-color: black;
    color: white;
}

.pager .active a:hover{
    background-color: grey;
    color: white;
}
</style>
