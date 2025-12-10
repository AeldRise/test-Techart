<?php

namespace App\Models;

use App\Core\Validator;

abstract class Model
{
    protected array $properties;
    
    public function __construct(array $properties)
    {
        $this->properties = Validator::convertArrayKeysToCamelCase($properties);
    }
    
    public function __call($name, $arguments = NULL)
    {   
        try {
            preg_match("/([a-z]+)(([A-Z]{1}[a-z]*)+)/", $name, $matches);
            $propertyName = lcfirst($matches[2]);
            if(isset($this->properties[$propertyName])) {
                if ($matches[1] === "get") {
                    return $this->properties[$propertyName];
                } elseif ($matches[1] === "set" && count($arguments) === 1) {
                    $this->properties[$propertyName] = $arguments[0];
                } 
            }      
        } catch (Exeption $e) {
            echo "Ошибка {$e->getMessage}";
        }
    } 
}