<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();    
}

require_once __DIR__ . '/../config/database.php';

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// $path = trim($requestUri, '/');
$basePath = '/aw1/twitter-clone/public'; // Ajustar conforme o caminho real do projeto
$path = substr($requestUri, strlen($basePath));
$path = trim($path, '/');

$requestMethod = $_SERVER['REQUEST_METHOD'];

// Inclusão dos Controllers
//require_once __DIR__ . '/../src/Controller/AbstractController.php';
//require_once __DIR__ . '/../src/Controller/PostController.php';
//require_once __DIR__ . '/../src/Controller/AuthController.php';
//require_once __DIR__ . '/../src/Controller/ProfileController.php';
//require_once __DIR__ . '/../src/Controller/TrendingController.php';

foreach (glob(__DIR__ . '/../src/Controller/*.php') as $filename) {
    require_once $filename;
}

switch ($path) {
    case '':
        if ($_SESSION['user_id'] ?? false) {
            $controller = new PostController($db);
            $controller->homeView();
        }
        else {
            $controller = new AuthController($db);
            $controller->loginView();
        }
        break;
    
    // ... (rotas 'login' e 'cadastro' GET)
    case 'login':
        $controller = new AuthController($db);
        
        // Se a requisição for POST, chama o método de processamento
        if ($requestMethod === 'POST') {
             // O AuthController precisa de um método para processar o POST de login
             $controller->handleLogin(); 
        } else {
             // Se for GET, apenas exibe a view
             $controller->loginView();
        }
        break;

    case 'cadastro':
        $controller = new AuthController($db);
        
        // NOVO BLOCO: Lida com o envio do formulário (método POST)
        if ($requestMethod === 'POST') {
            // 👈 Chamando o método do Controller que você deseja
            $controller->handleRegister(); 
            
        } else {
            // Se for GET, apenas exibe a view (o formulário)
            $controller->registerView();
        }
        break;
    
    case 'trends':
        
        $hashtag = $_GET['hashtag'] ?? null;
        if ($hashtag) {
            $controller = new PostController($db);
            $controller->viewTrend($hashtag);
            break;
        }
        $controller = new TrendingController($db);
        $controller->topTrends();
        break;
    case 'home':
        $controller = new PostController($db);
        $controller->homeView();
        break;

    case 'post':
        $controller = new PostController($db);
        if ($requestMethod === 'POST') {
            $controller->store();
        } else {
            http_response_code(405);
            echo "Método Não Permitido";
        }
        break;
    case 'profile':
        $controller = new ProfileController($db);
        $username = $_GET['username'] ?? null;
        if ($username) {
            $controller->show($username);
        } else {
            echo "Usuário não especificado.";
        }
        break;
    case 'logout':
        $controller = new AuthController($db);
        $controller->logout();
        break;
    default:
        http_response_code(404);
        echo "404 - Página Não Encontrada";
        break;
}
?>