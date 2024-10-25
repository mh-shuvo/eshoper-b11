
<?php
include_components("includes.admin_header");
?>

<div class="row">
    <div class="col-sm-8">
        <h3>Category</h3>
    </div>
    <div class="col-sm-4">
        <a href="<?=url("category/create")?>" class="btn btn-primary btn-sm">Add new Category</a>
    </div>
</div>

<div class="alert alert-success <?php echo !session()->has("category_success") ? "d-none":""; ?>">
    <?=session()->getFlash("category_success")?>
</div>

<div class="alert alert-danger <?php echo !session()->has("category_error") ? "d-none":""; ?>">
    <?=session()->getFlash("category_error")?>
</div>

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
            
            <tbody>
                <?php
                    foreach($data as $key => $item){
                ?>
                <tr>
                    <td>
                        <?=$key+1?>
                    </td>
                    <td>
                        <img src="<?=$item->image?>" style="height:100px;width:100px;" alt="">
                    </td>
                    <td>
                        <p>
                            <?=$item->name?> 
                            <?php
                                if($item->is_featured){
                                    echo '<span class="badge text-bg-success">Featured</span>';
                                }
                            ?>
                        </p>
                    </td>
                    <td><?=$item->status?></td>
                    <td>
                        <a href="<?=url("category/edit/{$item->id}")?>" class="btn btn-success btn-sm">Edit</a>
                        <a href="<?=url("category/delete/{$item->id}")?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>

                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
    include_components("includes.admin_footer");
?>