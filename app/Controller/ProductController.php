<?php
namespace App\Controller;
use App\Models\Category;
use App\Middleware\AdminLoginMiddleware;
use Exception;
class ProductController extends BaseController{

    protected $middlewares = [AdminLoginMiddleware::class];

    public function index()
    {
        $data["scripts"] = [
            asset("admin_assets/js/product.js"),
        ];
        
        return view("admin.product.index",$data);
    }


}