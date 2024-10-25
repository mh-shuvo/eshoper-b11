<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atova</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <header>
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item">E-Shoper</li>
                        <li class="list-group-item">
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?=getCurrentLoggedInAdminInfo("name")?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Change Password</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)" onclick="logout()">Logout</a></li>
                            </ul>
                            </div>
                        </li>
                    </ul>
                </header>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
            <div class="list-group">
                <a href="<?=url('admin')?>" class="list-group-item list-group-item-action">Dashboard</a>
                <a href="<?=url('category')?>" class="list-group-item list-group-item-action">Category</a>
            </div>
            </div>
            <div class="col-sm-10">
                <h4 class="text-success"><?=session()->getFlash('login_success')?></h4>
            </div>
        </div>
        
    </div>



<form action="<?=url("admin/logout")?>" method="post" id="LogoutForm"></form>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function logout(){
        const form = document.querySelector("#LogoutForm");
        form.submit();
    }
</script>
</body>
</html>