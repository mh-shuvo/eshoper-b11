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
                    <label for="category">Category</label>
                    <p> <?=$product->category_name?> </p>
                </div>
                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <p> <?=$product->product_name?> </p>
                </div>
                <div class="form-group mb-3">
                    <label for="price">Price</label>
                    <?=$product->price?>
                </div>
                <div class="form-group mb-3">
                    <label for="image">Image</label>
                    <img src="<?=getPublicUrlOfFile($product->image)?>" alt="" style="height:100px;width:100px">
                    
                </div>
                <div class="form-group mb-3">
                    <label for="is_featured">Show as Featured?<sup>*</sup></label>
                   
                </div>
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                </div>

                
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                </div>

            </form>
        </div>
    </div>
</div>

<?php
    include_components("includes.admin_footer",$data['scripts']??[]);
?>