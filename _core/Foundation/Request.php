<?php
namespace Atova\Eshoper\Foundation;

class Request {

    private static $instance = null;
    public $data = [];
    private $errors = [];

    // Private constructor to prevent multiple instances
    private function __construct() {
        // Automatically store all incoming request data (POST or GET)
        $this->data = $_POST;
    }

    // Static method to get the single instance of the class
    public static function getInstance(): Request {
        if (self::$instance === null) {
            self::$instance = new Request();
        }
        return self::$instance;
    }
    
    /**
     * Retrieve a value from the request data, or return null if not found
     * 
     * @param string $key
     * @return mixed|null
     */
    public function input($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    /**
     * Store validation errors
     * 
     * @param string $key
     * @param string $errorMessage
     */
    public function addError($key, $errorMessage) {
        $this->errors[$key][] = $errorMessage;
    }

    /**
     * Check if there are any errors for a specific field
     * 
     * @param string $key
     * @return bool
     */
    public function hasError($key) {
        return isset($this->errors[$key]) && !empty($this->errors[$key]);
    }

    /**
     * Get validation errors for a specific field
     * 
     * @param string $key
     * @return string|null
     */
    public function getError($key) {
        return $this->hasError($key) ? implode(', ', $this->errors[$key]) : null;
    }

    /**
     * Retrieve all validation errors
     * 
     * @return array
     */
    public function allErrors() {
        return $this->errors;
    }

    /**
     * Get old input value for the specified field
     * 
     * @param string $key
     * @return mixed|null
     */
    public function old($key) {
        return $this->input($key);
    }

    /**
     * Validate the request data
     * 
     * @param array $rules - an associative array where the key is the input name and the value is the validation rule
     */
    public function validate(array $rules) {
        foreach ($rules as $key => $rule) {
            $value = $this->input($key);

            // Example: required rule
            if ($rule === 'required' && empty($value)) {
                $this->addError($key, ucfirst($key) . ' is required.');
            }

            // Add other rules as needed (like email, min, max, etc.)
        }
    }
}
