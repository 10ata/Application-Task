<?php

namespace src\core;

use src\core\Helpers\ControllersLoader;
use src\core\Constants\General;

class App
{
    protected $url = [];
    protected $controller = 'index';
    protected $method = 'index';
    protected $params = [];

    protected $controllerClass = null;

    public function __construct()
    {
        $this->handleUrl();
    }

    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    public function handleUrl()
    {
        $this->url = $this->parseUrl();
        if (empty($this->url)) {
            $this->loadController();
            $this->loadMethod();
            return;
        }

        $controllersLoader = ControllersLoader::getInstance();
        if (!in_array($this->url[0] . General::CONTROLLER_SUFFIX, $controllersLoader->getControllerNames())) {
            throw new \Exception("Controller " . ucfirst($this->url[0]) . ucfirst(General::CONTROLLER_SUFFIX) . " not found!");
        }

        $this->controller = $this->url[0];
        $this->loadController();
        $this->loadMethod();
    }

    private function loadController()
    {
        unset($this->url[0]);
        $controllersLoader = ControllersLoader::getInstance();

        $class = General::CONTROLLERS_DIR . ucfirst($this->controller) . ucfirst(General::CONTROLLER_SUFFIX);

        $this->controllerClass = $controllersLoader->load($class);
    }

    private function loadMethod()
    {
        if (!empty($this->url[1])) {
            $this->method = $this->url[1];
            unset($this->url[1]);
        }

        if (!method_exists($this->controllerClass, $this->method . General::METHOD_SUFFIX)) {
            throw new \Exception("Method " . $this->method . General::METHOD_SUFFIX . " does not exist in " . ucfirst($this->controller) . ucfirst(General::CONTROLLER_SUFFIX));
        }

        $this->params = $this->url ? array_values($this->url) : [];
        call_user_func_array([$this->controllerClass, $this->method . General::METHOD_SUFFIX], $this->params);
    }

    public function redirect($url = null)
    {

    }
}