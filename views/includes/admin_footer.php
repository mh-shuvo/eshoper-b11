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