<?php
include_components("includes.admin_header",$data['styles']??[]);
$errors = session()->getFlash("validation_errors") ?? [];
$old = session()->getFlash("old") ?? [];
$products = $data['products'] ?? [];
?>
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-10">
            <h1 class="mt-4">Add Product Stock</h1>
        </div>
        <div class="col-2 text-right">
                <a href="<?=url("product")?>" class="btn btn-primary btn-md mt-4">Back to List</a>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item">Inventory</li>
        <li class="breadcrumb-item active">Add Product Stock</li>
    </ol>

    <div class="row">
        <div class="col-sm-8 offset-sm-2 border p-3">
            <span class="text-danger"><?=session()->getFlash('error')?></span>
            <form action="<?=url('inventory/add')?>" method="post" enctype="multipart/form-data">

                <div class="form-group mb-3">
                    <label for="product">Product <sup>*</sup></label>
                    <select name="product" id="product" class="form-control">
                        <option value="">Select one</option>
                        <?php
                            foreach($products as $product) {
                        ?>
                        <option value="<?=$product->id?>" <?= isset($old['product']) && $old['product'] == $product->id ? "selected":"" ?> ><?=$product->product_name?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <span class="text-danger"><?=$errors['product_error'] ?? ""?></span>
                </div>
            
                <div class="form-group mb-3">
                    <label for="stock_input_date">Stock In Date<sup>*</sup></label>
                    <input type="date" name="stock_input_date" id="stock_input_date" class="form-control" value="<?=$old['stock_input_date'] ?? null?>">
                    <span class="text-danger"><?=$errors['stock_input_date_error'] ?? ""?></span>
                </div>
                <div class="form-group mb-3">
                    <label for="quantity">Quantity<sup>*</sup></label>
                    <input type="text" name="quantity" id="quantity" class="form-control" placeholder="10" value="<?=$old['quantity'] ?? null?>">
                    <span class="text-danger"><?=$errors['quantity_error'] ?? ""?></span>
                </div>

                <div class="form-group mb-3">
                    <label for="price">Buying Price(Unit)<sup>*</sup></label>
                    <input type="text" name="price" id="price" placeholder="100" class="form-control" value="<?=$old['price'] ?? null?>">
                    <span class="text-danger"><?=$errors['price_error'] ?? ""?></span>
                </div>
                
                <div class="form-group mb-3">
                    <label for="note">Note</label>

                    <textarea name="note" id="note" class="form-control" placeholder="Note if any"><?=$old['note'] ?? null?></textarea>
                    
                    <span class="text-danger"><?=$errors['note_error'] ?? ""?></span>
                </div>

                <div class="text-center">
                    <button type="reset" class="btn btn-danger">Clear</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include_components("includes.admin_footer",$data['scripts']??[]);
?>