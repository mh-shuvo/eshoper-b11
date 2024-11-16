<?php
namespace App\Controller;
use App\Controller\BaseController;
use App\Middleware\AdminLoginMiddleware;
use App\Models\Inventory;
use App\Models\Product;
class InventoryController extends BaseController{
    protected $middlewares = [AdminLoginMiddleware::class];

    public function index(){
        $data['scripts'] = [
            asset('admin_assets/js/inventory.js')
        ];
        return view("admin.inventory.index", $data);
    }
    public function fetchInventories(){
        $page = $_GET['page'] ?? 1;
        $limit = $_GET['limit'] ?? 10; // Default items per page
        $offset = ($page - 1) * $limit;
        $inventory = new Inventory();
    
        // Fetch categories with limit and offset for pagination
        $inventories = $inventory->getPaginatedInventories($limit, $offset);
        $totalInventories = $inventory->getTotalInventoriesCount();
    
        echo json_encode([
            "status" => "success",
            "data" => $inventories,
            "pagination" => [
                "total" => $totalInventories,
                "current_page" => $page,
                "per_page" => $limit,
                "total_pages" => ceil($totalInventories / $limit)
            ]
        ]);
    }
    public function create(){
        $productModel = new Product();
        
        $products = $productModel->getAll();

        if(is_string($products)){
            session()->flash("error","Something went wrong during fetching products. Error: ".$products);
            return redirect("inventory");
        }

        $data['products'] = $products;
        
        return view("admin.inventory.create",$data);
    }

    public function add(){
        $data = $_POST;
        session()->flash("old",$data);
        $errors = [];

        if(is_null($data['price']) || $data['price'] == "" ){
           $errors['price_error'] = 'The buying price field is required.';
        }
        
        if(is_null($data['product']) || $data['product'] == "" ){
           $errors['product_error'] = 'The product field is required.';
        }
        
        if(is_null($data['stock_input_date']) || $data['stock_input_date'] == "" ){
            $errors['stock_input_date_error'] = 'The stock in date field is required.';
         }

         if(is_null($data['quantity']) || $data['quantity'] == "" ){
            $errors['quantity_error'] = 'The quantity field is required.';
         }

         if(!empty($errors)){
            session()->flash('validation_errors', $errors);
            return redirect("inventory/create");
         }

         $data['action'] = 'IN';
         $data['total'] = $data['price']*$data['quantity'];
         $inventory = new Inventory();
         $result = $inventory->stock_add($data);
         if(is_string($result)){
            session()->flash('error', "Something went wront. Error: ".$result);
            return redirect("inventory/create");
         }
         session()->remove('old');
         session()->flash("success","Product stock successfully added.");
         return redirect("inventory");

         
    }

}