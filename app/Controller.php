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
        session_start();
        session_write_close();
        if(isset($_SESSION['id'])) {
            $user = Model::find('id', $_SESSION['id']);
        } else {
            header('Location: /login');
            exit();
        }
        $this->render('index', ['user' => $user->name]);
    }

    private function login()
    {
        $error = '';

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $password = $_POST['password'];
            $user = Model::find('name', $name);
            if($user) {
                 if($user->checkPassword($password)) {
                     session_start();
                     $_SESSION['id'] = $user->id;
                     session_write_close();
                     header('Location: /');
                     exit();
                 } else {
                     $error = 'Неверный пароль';
                 }
            } else {
                $error = 'Пользователь не найден';
            }
        }

        $this->render('login', ['error' => $error]);
    }

    private function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
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