<?php

namespace Http\Requests;

/**
 * Żądanie HTTP
 */
class Request
{
    protected $rules = [];
    protected $path = '';
    protected $method = '';

    public function __construct()
    {
        $this->path = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function path()
    {
        return $this->path;
    }

    public function method()
    {
        return $this->method;
    }
   
    public function get(string $name, $default = null)
    {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }

    public function post(string $name, $default = null)
    {
        return isset($_POST[$name]) ? $_POST[$name] : $default;
    }    

    /**
     * Waliduje dane przesłąne metodą GET/POST na podstawie reguł walidacji z tabeli $rules.
     */
    public function validate(): ?array
    {
        $errorsBag = [];
        if (!is_array($this->rules)) {
            return $errorsBag;
        }
        foreach ($this->rules as $attribute => $validationRules) {
            $validationRules = is_array($validationRules) ? $validationRules : [$validationRules];

            $value = $this->post($attribute);
            $value = $value !== null ? $value : $this->get($attribute);

            foreach ($validationRules as $rule) {
                // czy jest stringiem
                if (!is_string($rule)) {
                    continue;
                } 
                $validateMethodName = $rule.'ValidationRule';
                if (method_exists($this, $validateMethodName)) {
                    $result = $this->$validateMethodName($value, $attribute);
                    if (count($result) > 0) {
                        $errorsBag = array_merge($errorsBag, $result);
                    }
                }
            }
        }        
        return count($errorsBag) > 0 ? $errorsBag : null;
    }    
}