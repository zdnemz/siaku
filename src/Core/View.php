<?php
namespace App\Core;

class View
{
    public static function render($view, $data = [])
    {
        // Convert array keys into variables
        extract($data);

        // Build the path to the view file
        $viewPath = __DIR__ . "./../Views/{$view}.php";

        // Check if the view file exists
        if (file_exists($viewPath)) {
            // Include the view file
            include $viewPath;
        } else {
            // Handle the case where the view file doesn't exist
            throw new \Exception("View file '{$view}.php' not found.");
        }
    }
}
