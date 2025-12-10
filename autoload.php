<?php
spl_autoload_register(function ($className) {
    $baseDir = __DIR__ . '/app/';
    preg_match("/^(?P<vendor>\w+\\\\)(?P<path>.*\\\\)(?P<file>\w+)$/", $className, $matches);
    $relativeClass = $matches['path'];
    $file = strtolower($baseDir . str_replace("\\", "/", $relativeClass)) . $matches['file'] . '.php';
    if (file_exists($file)) {
        require $file;
    }
});