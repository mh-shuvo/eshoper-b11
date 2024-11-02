<?php
include_components("includes.admin_header");
$errors = session()->getFlash("validation_errors") ?? [];
?>
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-10">
            <h1 class="mt-4">Create New Category</h1>
        </div>
        <div class="col-2 text-right">
                <a href="<?=url("category")?>" class="btn btn-primary btn-md mt-4">Back to List</a>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Category</li>
    </ol>

    <div class="row">
        <div class="col-sm-8 offset-sm-2 border p-3">
            <span class="text-danger"><?=session()->getFlash('error')?></span>
            <form action="<?=url('category/save')?>" method="post" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="name">Name<sup>*</sup></label>
                    <input type="text" name="name" id="name" class="form-control">
                    <span class="text-danger"><?=$errors['name_error'] ?? ""?></span>
                </div>
                <div class="form-group mb-3">
                    <label for="image">Image<sup>*</sup></label>
                    <input type="file" name="image" id="image" class="form-control">
                    <span class="text-danger"><?=$errors['image_error'] ?? ""?></span>
                </div>
                <div class="form-group mb-3">
                    <label for="is_featured">Show as Featured?<sup>*</sup></label>
                    <select name="is_featured" id="is_featured" class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <span class="text-danger"><?=$errors['is_featured_error'] ?? ""?></span>
                </div>
                <div class="form-group mb-3">
                    <label for="status">Status<sup>*</sup></label>
                    <select name="status" id="status" class="form-control">
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="INACTIVE">INACTIVE</option>
                    </select>
                    <span class="text-danger"><?=$errors['status_error'] ?? ""?></span>
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