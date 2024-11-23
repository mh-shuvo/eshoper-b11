
<?php
include_components("includes.admin_header");
?>
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-10">
            <h1 class="mt-4">Slider</h1>
        </div>
        <div class="col-2 text-right">
                <a href="<?=url("slider/create")?>" class="btn btn-primary btn-md mt-4">Add new Slider</a>
        </div>
    </div>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Slider</li>
    </ol>

    <span class="text-success"><?=session()->getFlash('success')?></span>
    <span class="text-danger"><?=session()->getFlash('error')?></span>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                
                <tbody>
                    <?php 
                        foreach($data['sliders'] as $key => $slider){
                    ?>
                    <tr>
                        <td><?=$key+1?></td>
                        <td>
                            <img src="<?=getPublicUrlOfFile($slider->image)?>" alt="" style="height:100px">
                        </td>
                        <td><?=$slider->title?></td>
                        <td>
                        <?=$slider->status?>
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i>
                            </button>
                            <button class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <div id="pagination" class="pagination-container mt-3"></div>
        </div>
    </div>
</div>

<?php
    include_components("includes.admin_footer",$data['scripts']??[]);
?>