<?php
namespace App\Controller;
use App\Models\Category;
use App\Middleware\AdminLoginMiddleware;
use Exception;
class CategoryController extends BaseController{

    protected $middlewares = [AdminLoginMiddleware::class];

    public function index()
    {
        $data["scripts"] = [
            asset("admin_assets/js/category.js"),
        ];
        
        return view("admin.category.index",$data);
    }

    public function edit($id){
        $category = new Category();
        $result = $category->getCategoryById($id);
        if(is_string($result)){
            session()->flash("error","Something went wrong to. ".$result);
            return redirect('category');
        }
        return view("admin.category.edit",[
            'category' => $result
        ]);
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

    public function create(){
        return view("admin.category.create");
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
            $errors['name_error'] = 'The category name field is required.';
         }
         if(is_null($data['status']) || $data['status'] == ""){
            $errors['status_error'] = 'The category status field is required.';
         }
         if(is_null($data['is_featured']) || $data['is_featured'] == "" ){
            $errors['is_featured_error'] = 'The category is_featured field is required.';
         }


         if(is_null($_FILES['image']['name']) || $_FILES['image']['name'] == ""){
            $errors['image_error'] = 'The category image field is required.';
         }
         else{
            $image_errors = "";
            if($_FILES['image']['size'] > 2*MB){
                $image_errors .= 'The category image should be less than 2MB.';
            }

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if(!in_array($ext,SUPPORTED_FILE_TYPES)){
                $image_errors .= '<br>The category image is not supported.';
            }

            if($image_errors != null){
                $errors['image_error'] = $image_errors;
            }
            
         }


         if(!empty($errors)){
            session()->flash('validation_errors', $errors);
            return redirect('category/create');
         }


         $file = $_FILES['image'];
         $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
         $fileName = time().".".$ext;
         $absoluteFilePath = UPLOAD_ROOT ."/category/";
         
         if(!is_dir($absoluteFilePath)){
            mkdir($absoluteFilePath,777, true);
         }

         $absoluteFileName = $absoluteFilePath."".$fileName;
         
         if(!move_uploaded_file($file['tmp_name'],$absoluteFileName)){
            session()->flash('error','Something went wrong duing file upload.');
            return redirect('category/create');
         }
         $data['image'] = "/upload/category/".$fileName;
         
         $categoryModel = new Category();
         $hasStored = $categoryModel->store($data);
         if(is_string($hasStored)){
            unlink($absoluteFileName);
            session()->flash('error','Something went wrong. Error: '.$hasStored);
            return redirect('category/create');
         }
         session()->remove("old");
         session()->flash('success','The Category Successfully Added.');
         return redirect('category');
         

    }
    public function update(){
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
            $errors['name_error'] = 'The category name field is required.';
         }
         if(is_null($data['status']) || $data['status'] == ""){
            $errors['status_error'] = 'The category status field is required.';
         }
         if(is_null($data['is_featured']) || $data['is_featured'] == "" ){
            $errors['is_featured_error'] = 'The category is_featured field is required.';
         }


         if(!empty($_FILES['image']['name'])){
            $image_errors = "";
            if($_FILES['image']['size'] > 2*MB){
                $image_errors .= 'The category image should be less than 2MB.';
            }

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if(!in_array($ext,SUPPORTED_FILE_TYPES)){
                $image_errors .= '<br>The category image is not supported.';
            }

            if($image_errors != null){
                $errors['image_error'] = $image_errors;
            }
            
         }


         if(!empty($errors)){
            session()->flash('validation_errors', $errors);
            return redirect('category/edit/'.$data['id']);
         }


         $file = $_FILES['image'];
         $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
         $fileName = time().".".$ext;
         $absoluteFilePath = UPLOAD_ROOT ."/category/";
         
         if(!is_dir($absoluteFilePath)){
            mkdir($absoluteFilePath,777, true);
         }

         $absoluteFileName = $absoluteFilePath."".$fileName;
         
         if(!move_uploaded_file($file['tmp_name'],$absoluteFileName)){
            session()->flash('error','Something went wrong duing file upload.');
            return redirect('category/create');
         }

         $data['image'] = "/upload/category/".$fileName;
         
         $categoryModel = new Category();
         $previousData = $categoryModel->getCategoryById($data["id"]);
         $hasStored = $categoryModel->update($data);

         if(is_string($hasStored)){
            unlink($absoluteFileName);
            session()->flash('error','Something went wrong. Error: '.$hasStored);
            return redirect('category/edit/'.$data['id']);
         }
         session()->remove("old");
         deleteFile($previousData->image);
         session()->flash('success','The Category Successfully Updated.');
         return redirect('category');
         

    }


}