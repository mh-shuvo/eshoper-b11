<?php include_components('includes.web_header');
$categories = $data['categories'];
?>	
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center">All <span style="color:#FE980F">Categories</span></h2>
            </div>
        </div>

        <div class="row mb-5">
            <?php 
                foreach($categories as $category){
            ?>
            <div class="col-sm-4 col-md-3 col-lg-2 text-center">
                <div class="card">
                    <img class="card-img-top" src="<?=getPublicUrlOfFile($category->image)?>" style="height: 80px;" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?=$category->name?></h5>
                    </div>
                </div>
            </div>

            <?php 
                }
            ?>

        </div>
    </div>
</section>
<?php include_components('includes.web_footer') ?>	