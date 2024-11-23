<?php
namespace App\Controller;
use App\Models\Category;
use App\Middleware\AdminLoginMiddleware;
use App\Models\Product;
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

    public function create(){
        $categoryModel = new Category();
        $data['categories'] = $categoryModel->getAllActiveCategories();
        $data['scripts'] = [
            'https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js'
        ];
        $data['styles'] = [
            'https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css'
        ];
        return view("admin.product.create",$data);
    }
    public function save(){
        /**
         * 1. Declare new variable as $data to store all post data.
         * 2. Check validations for all of field except file
         * 3. Check is there any file upload or not
         * 4. If not upload then set error msg for file
         * 5. if upload then check the supported type and size. 
         * 6. if any errors then set the errors in session and get it from the view file to show the user
         * 6 Upload file into the respected direcoty and keep the file name.
         * 7. create new instance for Category model class
         * 8 creaet new method to store category in category mode as store()
         * 9. call store() from controller with data.
         * 10. if success then show success msg otherwise show errors
         */

         $data = $_POST;
         session()->flash('old',$_POST);
         $errors = [];

         if(is_null($data['name']) || $data['name'] == ""){
            $errors['name_error'] = 'The product name field is required.';
         }
         if(is_null($data['status']) || $data['status'] == ""){
            $errors['status_error'] = 'The product status field is required.';
         }
         if(is_null($data['is_featured']) || $data['is_featured'] == "" ){
            $errors['is_featured_error'] = 'The product is_featured field is required.';
         }
         
         if(is_null($data['price']) || $data['price'] == "" ){
            $errors['price_error'] = 'The product price field is required.';
         }
         
         if(is_null($data['description']) || $data['description'] == "" ){
            $errors['description_error'] = 'The product description field is required.';
         }
         if(is_null($data['category']) || $data['category'] == "" ){
            $errors['category_error'] = 'The product category field is required.';
         }

         if(is_null($_FILES['image']['name']) || $_FILES['image']['name'] == ""){
            $errors['image_error'] = 'The product image field is required.';
         }

         if(!empty($_FILES['image']['name'])){
            $image_errors = "";
            if($_FILES['image']['size'] > 2*MB){
                $image_errors .= 'The product image should be less than 2MB.';
            }

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if(!in_array($ext,SUPPORTED_FILE_TYPES)){
                $image_errors .= '<br>The product image is not supported.';
            }

            if($image_errors != null){
                $errors['image_error'] = $image_errors;
            }
            
         }


         if(!empty($errors)){
            session()->flash('validation_errors', $errors);
            return redirect('product/create/');
         }


         $file = $_FILES['image'];
         $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
         $fileName = time().".".$ext;
         $absoluteFilePath = UPLOAD_ROOT ."/products/";
         
         if(!is_dir($absoluteFilePath)){
            mkdir($absoluteFilePath,777, true);
         }

         $absoluteFileName = $absoluteFilePath."".$fileName;
         
         if(!move_uploaded_file($file['tmp_name'],$absoluteFileName)){
            session()->flash('error','Something went wrong duing file upload.');
            return redirect('product/create');
         }

         $data['image'] = "/upload/products/".$fileName;
         
         $productModel = new Product();
         $hasStored = $productModel->store($data);

         if(is_string($hasStored)){
            unlink($absoluteFileName);
            session()->flash('error','Something went wrong. Error: '.$hasStored);
            return redirect('product/create/');
         }
         session()->remove("old");
         session()->flash('success','The Product Successfully Updated.');
         return redirect('product');
         

    }

    public function fetchProducts(){
        $page = $_GET['page'] ?? 1;
        $limit = $_GET['limit'] ?? 10; // Default items per page
        $offset = ($page - 1) * $limit;
        $model = new Product();
    
        // Fetch categories with limit and offset for pagination
        $products = $model->getPaginatedProducts($limit, $offset);
        $totalProducts = $model->getTotalProductsCount();
    
        echo json_encode([
            "status" => "success",
            "data" => $products,
            "pagination" => [
                "total" => $totalProducts,
                "current_page" => $page,
                "per_page" => $limit,
                "total_pages" => ceil($totalProducts / $limit)
            ]
        ]);
    }

    public function view($id){
        $product = new Product();
        $productDetails = $product->getProductDetailsById($id);
        if(is_string($productDetails)){
            session()->flash("error","".$productDetails);
            return redirect("product");
        }

        $data['product'] = $productDetails;
        return view('admin.product.view',$data);
    }

    public function edit($id){
        $product = new Product();
        $productDetails = $product->getProductById($id);
        if(is_string($productDetails)){
            session()->flash("error","".$productDetails);
            return redirect("product");
        }

        $data['product'] = $productDetails;
        $categoryModel = new Category();
        $data['categories'] = $categoryModel->getAllActiveCategories();
        $data['scripts'] = [
            'https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js'
        ];
        $data['styles'] = [
            'https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css'
        ];
        return view('admin.product.edit',$data);
    }

    public function update($id){
        $data = $_POST;
        session()->flash('old',$data);
        $errors = [];
        $productModel = new Product();
        $previousProductInfo = $productModel->getProductById($id);
        $data['id'] = $id;

        if(is_null($data['name']) || $data['name'] == ""){
            $errors['name_error'] = 'The product name field is required.';
         }
         if(is_null($data['status']) || $data['status'] == ""){
            $errors['status_error'] = 'The product status field is required.';
         }
         if(is_null($data['is_featured']) || $data['is_featured'] == "" ){
            $errors['is_featured_error'] = 'The product is_featured field is required.';
         }
         
         if(is_null($data['price']) || $data['price'] == "" ){
            $errors['price_error'] = 'The product price field is required.';
         }
         
         if(is_null($data['description']) || $data['description'] == "" ){
            $errors['description_error'] = 'The product description field is required.';
         }
         if(is_null($data['category']) || $data['category'] == "" ){
            $errors['category_error'] = 'The product category field is required.';
         }


         if(!empty($_FILES['image']['name'])){
            $image_errors = "";
            if($_FILES['image']['size'] > 2*MB){
                $image_errors .= 'The product image should be less than 2MB.';
            }

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if(!in_array($ext,SUPPORTED_FILE_TYPES)){
                $image_errors .= '<br>The product image should be '.implode(",",SUPPORTED_FILE_TYPES)."";
            }

            if($image_errors != null){
                $errors['image_error'] = $image_errors;
            }
            
         }

         if(!empty($errors)){
            session()->flash('validation_errors', $errors);
            return redirect('product/edit/'.$id);
         }

         if(!empty($_FILES['image']['name'])){
            $file = $_FILES['image'];
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fileName = time().".".$ext;
            $absoluteFilePath = UPLOAD_ROOT ."/products/";
            
            if(!is_dir($absoluteFilePath)){
                mkdir($absoluteFilePath,777, true);
            }

            $absoluteFileName = $absoluteFilePath."".$fileName;
            
            if(!move_uploaded_file($file['tmp_name'],$absoluteFileName)){
                session()->flash('error','Something went wrong duing file upload.');
                return redirect('product/edit/'.$id);
            }

            $data['image'] = "/upload/products/".$fileName;
         }else{
            $data['image'] = $previousProductInfo->image;
         }

         $hasUpdate = $productModel->update($data);
         if(is_string($hasUpdate)){
            unlink($absoluteFileName);
            session()->flash('error','Something went wrong. Error: '.$hasUpdate);
            return redirect('product/edit/'.$data['id']);
         }

         deleteFile($previousProductInfo->image);
         session()->remove("old");
         session()->flash('success','The Product Successfully Updated.');
         return redirect('product');
    }


    public function delete($id){
        $productModel = new Product();

        $productInfo = $productModel->getProductById($id);
        $hasDeleted = $productModel->delete($id);
        $responseCode = 200;
        $response = [
            "status"=> "success",
            "message"=> "Successfully Deleted",
        ];

        if(is_string($hasDeleted)){
            $response["status"] = "failed";
            $response["message"] = $hasDeleted;
            $responseCode = 500;
        }else{
            deleteFile($productInfo->image);
        }

        http_response_code($responseCode);

        echo json_encode($response);
    }





}