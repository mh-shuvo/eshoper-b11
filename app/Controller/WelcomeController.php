<?php
namespace App\Controller;
use App\Controller\BaseController;
use App\Models\Category;
use App\Models\Slider;
class WelcomeController extends BaseController{
    public function index(){
        $category = new Category();
        $featuredCategories = $category->getFeaturedCategories("id,name",10);

        if(is_string($featuredCategories)){
            session()->flash("error","Failed to fetch featured categories");
            $featuredCategories = [];
        }

        $data['featured_categories'] = $featuredCategories;

        $slider = new Slider();
        $activeSliders = $slider->getAllActiveSliders();

        if(is_string($activeSliders)){
            session()->flash("error","Failed to fetch active sliders");
            $activeSliders = [];
        }

        $data['sliders'] = $activeSliders;

        return view("web.index",$data);
    }

    public function allCategories(){
        $category = new Category();
        $categories = $category->getAllActiveCategories();

        if(is_string($categories)){
            session()->flash("error","Failed to fetch featured categories");
            $categories = [];
        }

        $data['categories'] = $categories;

        return view("web.categories",$data);
    }
}