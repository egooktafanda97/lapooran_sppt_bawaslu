<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class BaseControllers extends Controller
{
    private $view;
    private $ControllerClass;
    private $method;
    private $guards_request;

    public function __construct(Request $request)
    {
        $controllerName = ucfirst($request->segment(1) != "api" ? $request->segment(1) : $request->segment(2)) . 'Controller';
        $controllerClass = "App\\Http\\Controllers\\$controllerName";
        if (class_exists($controllerClass)) {
            // $this->view = "pages." . $request->segment(1) . "." . ($request->segment(2) ?: "show");

            $segment1 = $request->segment(1);
            $segment2 = $request->segment(2);
            if ($segment1 === 'api') {
                $this->view = "api.$segment2";
                $this->method = $request->segment(3) ?: 'index';
                $this->guards_request = "api";
                $request->merge(['view' => $this->view, "guards_request" => "api"]);
            } else if ($segment1 != 'api') {
                $this->guards_request = "web";
                $this->view = "pages.$segment1.$segment2";
                $this->method = $request->segment(2) ?: 'index';
                $request->merge(['view' => $this->view, "guards_request" => "web"]);
            }

            $this->ControllerClass = $controllerClass;
        } else {
            $this->view = "pages." . $request->segment(1) . "." . ($request->segment(2) ?: "show");
        }
    }

    public function index(Request $request)
    {
        if (!empty($this->ControllerClass)) {
            if (method_exists($this->ControllerClass, $this->method)) {
                $segments = $request->segments();
                $arguments = array_slice($segments, 2);
                // return call_user_func_array([new $this->ControllerClass(), $this->method], [$request, ...$arguments]);
                return [$this->ControllerClass, $this->method];
                $result =  call_user_func_array([new $this->ControllerClass(), $this->method], []);

                if ($request->segment(1) != "api") {
                    if (method_exists($result, 'view')) {
                        return $result->view();
                    } else {
                        return $result;
                    }
                } else {
                    if (method_exists($result, 'view')) {
                        return $result->json();
                    } else {
                        return $result;
                    }
                }
            } else {
                return function (Request $request) {
                    return abort(404);
                };
            }
        }


        return view($this->view);
    }
}
