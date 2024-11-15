
</main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; <a href="<?=url()?>">
                                <?=getConfig('app.name',"E-Commerce")?> 
                                <?=getConfig('app.version',"1.0.1")?>
                            </a> <?=date("Y");?></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        

<form action="<?=url("admin/logout")?>" method="post" id="LogoutForm"></form>    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script>
            const BASEPATH = document.querySelector("meta[name='BASEPATH']").getAttribute("content");
            const BASECURRENCY = document.querySelector("meta[name='BASECURRENCY']").getAttribute("content");
            
            function logout(){
                const form = document.querySelector("#LogoutForm");
                form.submit();
            }
        </script>
        <?php 
           if(isset($staticFiles)){
           foreach($staticFiles as $k=> $js){
        ?>
            <script src="<?=$js?>"></script>

        <?php
           }
        }
        ?>
        <script src="<?=asset("admin_assets/js/scripts.js")?>"></script>
    </body>
</html>