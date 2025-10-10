<?php
require_once __DIR__ . '/../config/database.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// $path = trim($requestUri, '/');
$basePath = '/aw1/twitter-clone/public'; // Ajustar conforme o caminho real do projeto
$path = substr($requestUri, strlen($basePath));
$path = trim($path, '/');


// Inclusão dos Controllers
require_once __DIR__ . '/../src/Controller/AbstractController.php';
require_once __DIR__ . '/../src/Controller/PostController.php';
require_once __DIR__ . '/../src/Controller/AuthController.php';

switch ($path) {
    case '':
        if ($_SESSION['user_id'] ?? false) {
            //$controller = new PostController($db);
            //$controller->render('home');
        } else {
            $controller = new AuthController($db);
            $controller->loginView();
        }
        break;
    case 'login':
        $controller = new AuthController($db);
        $controller->loginView();
        break;
    case 'cadastro':
        $controller = new AuthController($db);
        $controller->registerView();
        break;


    default:
        // Página não encontrada
        http_response_code(404);
        echo "404 - Página Não Encontrada";
        break;
}

?>