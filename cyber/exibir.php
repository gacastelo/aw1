<?php
session_start();
$pesquisas = $_SESSION["pesquisa"] ?? [];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Respostas da Pesquisa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="resources/css/style.css">
</head>
<body>
<main class="flex-fill">  
    <?php if (empty($pesquisas)) {
    echo "<div class='container mt-5'><div class='alert alert-info'>Nenhuma pesquisa registrada ainda.</div></div>";
    exit;
}?>
    <div class="container mt-5">
        <h1 class="mb-4">Respostas Registradas</h1>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Vitima</th>
                        <th>Onde</th>
                        <th>Tipo</th>
                        <th>Frequência</th>
                        <th>Sentimentos</th>
                        <th>Ajuda</th>
                        <th>Suporte</th>
                        <th>Comentários</th>
                        <th>Horário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pesquisas as $pesquisa): ?>
                        <tr>
                            <td><?= htmlspecialchars($pesquisa['id']) ?></td>
                            <td><?= htmlspecialchars($pesquisa['vitima']) ?></td>
                            <td><?= htmlspecialchars($pesquisa['onde'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($pesquisa['tipo'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($pesquisa['frequencia'] ?? '-') ?></td>
                            <td>
                                <?php
                                    if (is_array($pesquisa['sentimento'])) {
                                        foreach ($pesquisa['sentimento'] as $sent) {
                                            echo "<span class='tag'>" . htmlspecialchars($sent) . "</span>";
                                        }
                                    } else {
                                        echo '-';
                                    }
                                ?>
                            </td>
                            <td><?= htmlspecialchars($pesquisa['ajuda'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($pesquisa['suporte'] ?? '-') ?></td>
                            <td><?= nl2br(htmlspecialchars($pesquisa['comentarios'] ?? '-')) ?></td>
                            <td><?= htmlspecialchars($pesquisa['horario']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container mt-5 text-center">
    <button onclick="alert('Obrigado pela colaboração!'); window.location.href='index.php';" class="btn btn-primary">
        Voltar para Início
    </button>
    </main>
    <footer class="bg-dark text-white text-center py-3">
      <div class="container">
        <p>&copy; 2025 Projeto Cyberbullying. Todos os direitos reservados.</p>
        <p>Desenvolvido por Gabriel, Olavo e João Vitor</p>
      </div>
    </footer>
  </div>
</div>
</body>
</html>
