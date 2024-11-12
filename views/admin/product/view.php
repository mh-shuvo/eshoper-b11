<?php
include_components("includes.admin_header");
$product = $data['product'];
?>
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-10">
            <h1 class="mt-4"><b><?=$product->product_name?></b> Details</h1>
        </div>
        <div class="col-2 text-right">
                <a href="<?=url("product")?>" class="btn btn-primary btn-md mt-4">Back to List</a>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item">Product</li>
        <li class="breadcrumb-item active"><?=$product->product_name?> Details</li>
    </ol>

    <div class="row">
        <div class="col-sm-8 offset-sm-2 border p-3">
            <form action="javascript:void(0)" method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                    <label for="category" class="fw-bold">Category</label>
                    <p> <?=$product->category_name?> </p>
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="fw-bold">Name</label>
                    <p> <?=$product->product_name?> </p>
                </div>
                <div class="form-group mb-3">
                    <label for="price" class="fw-bold">Price</label>
                    <?=$product->price?>
                </div>
                <div class="form-group mb-3">
                    <label for="image" class="fw-bold">Image</label><br>
                    <img src="<?=getPublicUrlOfFile($product->image)?>" alt="" style="height:100px;width:100px">
                    
                </div>
                <div class="form-group mb-3">
                    <label for="is_featured" class="fw-bold">Show as Featured? </label> <br>
                    <span class="fw-bold text-<?=$product->is_featured ? "success":"danger"?>"><?=$product->is_featured ? "Yes":"No"?></span>
                   
                </div>
                <div class="form-group mb-3">
                    <label for="status" class="fw-bold">Status</label> <br>
                    <span class="fw-bold text-<?=$product->status ="ACTIVE" ? "success":"danger"?>"><?=$product->status?></span>
                </div>

                
                <div class="form-group mb-3">
                    <label for="description" class="fw-bold">Description</label> <br>
                    <p>
                        <?= $product->description ?>
                    </p>
                </div>

            </form>
        </div>
    </div>
</div>

<?php
    include_components("includes.admin_footer",$data['scripts']??[]);
?>