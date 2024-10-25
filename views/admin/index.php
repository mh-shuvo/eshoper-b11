<?php
include_components("includes.admin_header");
?>

<div class="row">
    <div class="cols-sm-12">
        <h3>Dashboard</h3>
        <h4 class="text-success"><?=session()->getFlash('login_success')?></h4>
    </div>
</div>

<?php
    include_components("includes.admin_footer");
?>