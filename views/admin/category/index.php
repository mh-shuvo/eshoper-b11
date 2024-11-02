
<?php
include_components("includes.admin_header");
?>
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-10">
            <h1 class="mt-4">Category</h1>
        </div>
        <div class="col-2 text-right">
                <a href="<?=url("category/create")?>" class="btn btn-primary btn-md mt-4">Add new Category</a>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Category</li>
    </ol>

    <span class="text-success"><?=session()->getFlash('success')?></span>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                
                <tbody></tbody>
            </table>
            <div id="pagination" class="pagination-container mt-3"></div>
        </div>
    </div>
</div>

<?php
    include_components("includes.admin_footer",$data['scripts']??[]);
?>