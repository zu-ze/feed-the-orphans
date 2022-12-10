<?php 

abstract class Controller 
{
    public $layout = 'layout/main';

    public function __construct()
    {
        Application::$app->controller = $this;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    public function renderView($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function redirect($url)
    {
        return Application::$app->response->redirect($url);
    }
}