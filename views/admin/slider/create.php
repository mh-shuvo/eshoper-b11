<?php
include_components("includes.admin_header");
$errors = session()->getFlash("validation_errors") ?? [];
$old = session()->getFlash("old") ?? [];
?>
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-10">
            <h1 class="mt-4">Add New Slider</h1>
        </div>
        <div class="col-2 text-right">
                <a href="<?=url("slider")?>" class="btn btn-primary btn-md mt-4">Back to List</a>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Slider</li>
    </ol>

    <div class="row">
        <div class="col-sm-8 offset-sm-2 border p-3">
            <span class="text-danger"><?=session()->getFlash('error')?></span>
            <form action="<?=url('slider/save')?>" method="post" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="title">Slider Title<sup>*</sup></label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="E-Shooper 11:11" value="<?=$old['title'] ?? null?>">
                    <span class="text-danger"><?=$errors['title_error'] ?? ""?></span>
                </div>
                <div class="form-group mb-3">
                    <label for="image">Image<sup>*</sup></label>
                    <input type="file" name="image" id="image" class="form-control">
                    <span class="text-danger"><?=$errors['image_error'] ?? ""?></span>
                </div>
                <div class="form-group mb-3">
                    <label for="is_featured">Show Button?<sup>*</sup></label>
                    <select name="show_btn" id="show_btn" class="form-control">
                        <option value="YES"<?= isset($old['show_btn']) && $old['show_btn'] == "YES" ?"selected":"" ?>>YES</option>
                        <option value="NO" <?= isset($old['show_btn']) && $old['show_btn'] == "NO" ?"selected":"" ?>>NO</option>
                    </select>
                    <span class="text-danger"><?=$errors['show_btn_error'] ?? ""?></span>
                </div>

                <div class="form-group mb-3 button-group <?=isset($old['show_btn']) && $old['show_btn'] == "NO" ? "d-none":""?>">
                    <label for="btn_text">Button Text</label>
                    <input type="text" name="btn_text" id="btn_text" placeholder="Get it now" class="form-control" value="<?=$old['btn_text'] ?? null?>">
                    <span class="text-danger"><?=$errors['btn_text_error'] ?? ""?></span>
                </div>
                <div class="form-group mb-3 button-group <?=isset($old['show_btn']) && $old['show_btn'] == "NO" ? "d-none":""?>">
                    <label for="btn_link">Button Link</label>
                    <input type="text" name="btn_link" id="btn_link" placeholder="https://eshopper.com/discounts" class="form-control" value="<?=$old['btn_link'] ?? null?>">
                    <span class="text-danger"><?=$errors['btn_link_error'] ?? ""?></span>
                </div>

                <div class="form-group mb-3">
                    <label for="description">Description</label></label>
                    <textarea name="description" id="description" class="form-control" placeholder="Some description on the slider"><?=$old['description'] ?? null?></textarea>
                    <span class="text-danger"><?=$errors['description_error'] ?? ""?></span>
                </div>

                <div class="form-group mb-3">
                    <label for="status">Status<sup>*</sup></label>
                    <select name="status" id="status" class="form-control">
                        <option value="ACTIVE" <?= isset($old['status']) && $old['status'] == "ACTIVE" ?"selected":"" ?>>ACTIVE</option>
                        <option value="INACTIVE" <?= isset($old['status']) && $old['status'] == "INACTIVE" ?"selected":"" ?>>INACTIVE</option>
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