<?php

namespace App\Core;

class Router
{
    // Menyimpan daftar rute yang terdaftar
    protected $routes = [];
    // Menyimpan handler untuk rute yang tidak ditemukan
    protected $notFoundHandler;

    // Menambahkan rute ke dalam daftar rute
    private function addRoute($route, $controller, $action, $method)
    {
        // Mengatur rute dengan metode HTTP tertentu (GET/POST) dan menyimpan informasi controller serta action
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    // Menambahkan rute untuk metode GET
    public function get($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "GET");
    }

    // Menambahkan rute untuk metode POST
    public function post($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "POST");
    }

    // Menetapkan handler untuk menangani rute yang tidak ditemukan
    public function setNotFoundHandler(callable $handler)
    {
        $this->notFoundHandler = $handler;
    }

    // Mengatur dan menjalankan rute yang sesuai dengan permintaan saat ini
    public function dispatch()
    {
        // Mengambil URI tanpa query string
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        // Mendapatkan metode HTTP dari permintaan
        $method = $_SERVER['REQUEST_METHOD'];

        // Memeriksa apakah rute untuk metode HTTP dan URI yang diminta ada
        if (isset($this->routes[$method][$uri])) {
            // Mengambil controller dan action untuk rute tersebut
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];

            // Membuat instance dari controller dan memanggil method action
            $controller = new $controller();
            $controller->$action();
        } else {
            // Jika rute tidak ditemukan, panggil handler 'not found' jika disediakan
            if ($this->notFoundHandler) {
                call_user_func($this->notFoundHandler);
            } else {
                // Jika tidak ada handler, kirimkan respon 404 Not Found
                http_response_code(404);
                echo "404 Not Found";
            }
        }
    }
}
