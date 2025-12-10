<?php

namespace App\Core;

class Validator 
{
    public static function convertStringToCamelCase($string) 
    {
        $result = preg_replace_callback(
            "/_(\w)/",
            function($matches) {
                return strtoupper($matches[1]);
            }, $string
        );  
        $result = preg_replace("/_|\W/", "", $result);
        $result = preg_replace("/^(\d+)/", "", $result);
        return lcfirst($result);
    } 

    public static function convertArrayKeysToCamelCase(array $array)
    {   
        $newArray = [];
        foreach ($array as $key => $value) {
            $newKey = Validator::convertStringToCamelCase($key);
            $newArray[$newKey] = $value;
        }
        return $newArray;
    }

    public static function prepareArrayToDbRequest(array $array)
    {
        $newArray = [];
        foreach ($array as $key => $value) {
            $newArray[":$key"] = $value;
        }
        return $newArray;
    }
}