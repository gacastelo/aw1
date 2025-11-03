<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página de Cadastro de Usuário">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Cadastro - TielFlix</title>
    
    <style>
        body {
            min-height: 100vh; 
            background-color: #f8f9fa; 
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center"> 

    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
        
        <h2 class="card-title text-center mb-4">Criar Nova Conta</h2>

        <form action="../processos/cadastro_processo.php" method="post">
            <?php 
            session_start();
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário:</label>
                <input type="text" id="username" name="username" class="form-control" required 
                       placeholder="Escolha um nome de usuário">
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required
                       placeholder="seu@email.com">
            </div>
            
            <div class="mb-3">
                
                <label for="password" class="form-label">Senha:</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control" required
                           placeholder="Crie uma senha segura">
                    <span id="eye" style="font-size: 15pt;">👁️‍🗨️</span>
                </div>
            </div>
            
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary btn-lg" id="validate-btn">Cadastrar</button>
                </div>
        </form>
        
        <p class="text-center mt-3">
            <a href="login.php" class="text-secondary text-decoration-none">Já tenho conta</a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <script src="../assets/js/cadastro.js"></script>
</body>
</html>