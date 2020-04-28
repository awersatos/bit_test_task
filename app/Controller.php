<?php


class Controller
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function run()
    {
        $requestUri = explode('/', $_SERVER['REQUEST_URI']);

        switch ($requestUri[1]) {
            case '':
                $this->index();
                break;
            case 'login':
                $this->login();
                break;
            case 'logout':
                $this->logout();
                break;
            default:
                header('HTTP/1.0 404 not found');
                echo 'Страница не найдена';

        }
    }

    private function index()
    {
        $user = Model::find('id', 2);
        $this->render('index', ['user' => 'test']);
    }

    private function login()
    {
        $this->render('index', ['user' => 'login']);
    }

    private function logout()
    {
        $this->render('index', ['user' => 'logout']);
    }

    private function render($view, array $data = [])
    {
        extract($data);

        ob_start();
        require_once 'views/' . $view . '.php';
        $content = ob_get_clean();

        $layout = $this->config['layout'];
        ob_start();
        require_once $layout;
        $output = ob_get_clean();
        echo $output;
    }
}