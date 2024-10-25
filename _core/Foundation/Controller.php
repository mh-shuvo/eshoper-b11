<?php
namespace Atova\Eshoper\Foundation;
use App\Controller\WelcomeController;
use App\Interfaces\MiddlewareInterface;
class Controller {

    protected $currentController = WelcomeController::class;
    protected $currentMethod = "index";
    protected $params = [];
    
    public function __construct(){
        $url = $this->getUrl();
        
        if($url != false){
         $urlControllerName = str_replace(" ","",ucwords(str_replace(["-","_"]," ",$url[0])));
        
          $fullyQualifiedClassName = "App\\Controller\\" . $urlControllerName . "Controller";
          // Look in controllers for first value
          if(class_exists($fullyQualifiedClassName)){
            // If exists, set as controller
            $this->currentController = $fullyQualifiedClassName;
            // Unset 0 Index
            unset($url[0]);
          }
        }

      // Instantiate controller class
      $this->currentController = new $this->currentController();

      foreach ($this->currentController->getMiddlewares() as $key => $middleware) {
          $middlewareObj = new $middleware();
          if($middlewareObj instanceof MiddlewareInterface){
            $middlewareObj->handle();
          }
          else{
            throwException(sprintf("The [%s] Should be instance of [%s]",$middleware,MiddlewareInterface::class));
          }

      }

      // Check for second part of url
      if(isset($url[1])){
          $urlMethodName = toCamelCase($url[1]);

          if(!method_exists($this->currentController, $urlMethodName) && $_SERVER['REQUEST_METHOD'] != "GET"){
              throwViewNotFoundException("Method $urlMethodName does not exist");
          }

        // Check to see if method exists in controller
        if(method_exists($this->currentController, $urlMethodName)){
          $this->currentMethod = $urlMethodName;
          // Unset 1 index
          unset($url[1]);
        }

      }

      // Get params
      $this->params = $url ? array_values($url) : [];

      // Call a callback with array of params
      call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    public function getUrl()
    {
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/',$url);
            return $url;
        }
        return false;
    }
}