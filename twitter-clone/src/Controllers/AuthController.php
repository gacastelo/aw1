<?php 
class AuthController extends AbstractController
{
    public function loginView()
    {
        $this->render('login');
    }
    public function handleLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userRepo = new UserRepository($this->db);
            $user = $userRepo->findByEmail($email);

            if ($user && $user->verifyPassword($password)) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $user->__get('id');
                $this->flash('success', 'Login realizado com sucesso!');
                header('Location: /home');
                exit();
            } else {
                $this->flash('error', 'Credenciais inválidas. Tente novamente.');
                header('Location: /login');
                exit();
            }
        }
    }

    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        $this->flash('success', 'Logout realizado com sucesso!');
        header('Location: /login');
        exit();
    }

    public function registerView(): void
    {
        $this->render('cadastro');
    }

    public function handleRegister(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userRepo = new UserRepository($this->db);
            $user = new User($username, $email, $password);
            if ($userRepo->save($user)) {
                $this->flash('success', 'Cadastro realizado com sucesso! Por favor, faca o login.');
                header('Location: /login');
                exit();
            } else {
                $this->flash('error', 'Erro ao cadastrar o usuário. Por favor, tente novamente.');
                header('Location: /cadastro');
                exit();
            }
        }
    }
}

?>

