<?php
namespace App\Controller;
use App\Models\Category;
use App\Middleware\AdminLoginMiddleware;
class CategoryController extends BaseController{

    protected $middlewares = [AdminLoginMiddleware::class];

    public function index()
    {
        $category = new Category();
        $data = $category->getAll();
        if(!is_array($data)){
            throwException($data);
        }
        return view("admin.category",$data);
    }

    public function edit($id){
        echo "You are trying to edit Category {$id}";
    }

    public function delete($id){
        $category = new Category();
        $hasDeleted = $category->delete($id);

        if(is_string($hasDeleted)){
            throwException($hasDeleted);
        }

        session()->flash("category_success","Successfully Deleted");
        return redirect("category");
    }


}