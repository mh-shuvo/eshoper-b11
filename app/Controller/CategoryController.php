<?php
namespace App\Controller;
use App\Models\Category;
use App\Middleware\AdminLoginMiddleware;
class CategoryController extends BaseController{

    protected $middlewares = [AdminLoginMiddleware::class];

    public function index()
    {
        $data["scripts"] = [
            asset("admin_assets/js/category.js"),
        ];
        
        return view("admin.category",$data);
    }

    public function edit($id){
        echo "You are trying to edit Category {$id}";
    }

    public function delete($id){
        $category = new Category();
        
        $hasDeleted = $category->delete($id);
        $responseCode = 200;
        $response = [
            "status"=> "success",
            "message"=> "Successfully Deleted",
        ];

        if(is_string($hasDeleted)){
            $response["status"] = "failed";
            $response["message"] = $hasDeleted;
            $responseCode = 500;
        }

        http_response_code($responseCode);

        echo json_encode($response);
    }


    public function fetchCategories(){
        $page = $_GET['page'] ?? 1;
        $limit = $_GET['limit'] ?? 10; // Default items per page
        $offset = ($page - 1) * $limit;
        $category = new Category();
    
        // Fetch categories with limit and offset for pagination
        $categories = $category->getPaginatedCategories($limit, $offset);
        $totalCategories = $category->getTotalCategoriesCount();
    
        echo json_encode([
            "status" => "success",
            "data" => $categories,
            "pagination" => [
                "total" => $totalCategories,
                "current_page" => $page,
                "per_page" => $limit,
                "total_pages" => ceil($totalCategories / $limit)
            ]
        ]);
    }


}