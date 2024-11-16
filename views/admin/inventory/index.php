<?php
include_components("includes.admin_header");
?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-10">
            <h1 class="mt-4">Product Inventory</h1>
        </div>
        <div class="col-2 text-right">
            <a href="<?=url("inventory/create")?>" class="btn btn-primary btn-md mt-4">Add Product Stock</a>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Product Inventory List</li>
    </ol>

    <div class="row">
        <span class="text-success"><?=session()->getFlash('success')?></span>
        <span class="text-danger"><?=session()->getFlash('error')?></span>

        <div class="col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>#</th>
                    <th>Stock Input Date</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Buying Price(Unit)</th>
                    <th>Total</th>
                    <th>Note</th>
                </thead>
                
                <tbody></tbody>
            </table>
            <div id="pagination" class="pagination-container mt-3"></div>
        </div>

    </div>
</div>


<?php
    include_components("includes.admin_footer",$data['scripts']);
?>