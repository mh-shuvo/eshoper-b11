<?php
namespace App\Controller;
use App\Controller\BaseController;
use App\Middleware\AdminLoginMiddleware;
use App\Models\Slider;
class SliderController extends BaseController {
    protected $middlewares = [AdminLoginMiddleware::class];
    public function index(){
        $model = new Slider();
        $sliders = $model->getAll();
        if(is_string($sliders)){
            session()->flash('error',"There is something went wrong during sliders fetching.");
            $sliders = [];
        }
        $data['sliders'] = $sliders;
        return view("admin.slider.index",$data);
    }

    public function create(){
        $data['scripts'] = [
            asset('admin_assets/js/slider.js')
        ];
        return view("admin.slider.create",$data);
    }

    public function save(){
        $data = $_POST;
        session()->flash('old',$data);
        $image = $_FILES['image'];
        $errors = [];

        if(empty($data['title'])){
            $errors['title_error'] = "The slider title field is required.";
        }
        if(empty($data['status'])){
            $errors['status_error'] = "The slider status field is required.";
        }
        if(empty($data['show_btn'])){
            $errors['show_btn_error'] = "Select the options for the button will show or not.";
        }

        if(empty($image['name'])){
            $errors['image_error'] = "The image field is required.";
        }else{
            $image_errors = "";
            if($_FILES['image']['size'] > 2*MB){
                $image_errors .= 'The slider image should be less than 2MB.';
            }

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if(!in_array($ext,SUPPORTED_FILE_TYPES)){
                $image_errors .= '<br>The slider image is not supported.';
            }

            if($image_errors != null){
                $errors['image_error'] = $image_errors;
            }
            
         }

        if($data['show_btn'] == "YES"){
            if(empty($data['btn_text'])){
                $errors['btn_text_error'] = "The button text field is required.";
            }
            if(empty($data['btn_link'])){
                $errors['btn_link_error'] = "The button link field is required.";
            }
        }

        if(!empty($errors)){
            session()->flash("validation_errors",$errors);
            return redirect("slider/create");
        }
        $file = $_FILES['image'];
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = time().".".$ext;
        $absoluteFilePath = UPLOAD_ROOT ."/slider/";
        
        if(!is_dir($absoluteFilePath)){
           mkdir($absoluteFilePath,777, true);
        }

        $absoluteFileName = $absoluteFilePath."".$fileName;
        
        if(!move_uploaded_file($file['tmp_name'],$absoluteFileName)){
           session()->flash('error','Something went wrong duing file upload.');
           return redirect('slider/create');
        }
        $data['image'] = "/upload/slider/".$fileName;
        
        $sliderModel = new Slider();
        $hasStored = $sliderModel->store($data);
        if(is_string($hasStored)){
           unlink($absoluteFileName);
           session()->flash('error','Something went wrong. Error: '.$hasStored);
           return redirect('slider/create');
        }
        session()->remove("old");
        session()->flash('success','The Slider Successfully Added.');
        return redirect('slider');
        
    }

}