<?php
session_start();
$pesquisas = $_SESSION["pesquisa"] ?? [];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Resultados da Pesquisa de Cyberbullying">
    <title>Respostas da Pesquisa</title>
    <link rel="icon" href="resources/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="resources/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Cyberbullying</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="sobre.php">Sobre Nós</a></li>
                    <li class="nav-item"><a class="nav-link"  href="pesquisa.php">Nosso Projeto</a></li>
                    <li class="nav-item"><a class="nav-link active"  href="#">Exibir Resultados</a></li>
                </ul>
            </div>
        </div>
    </nav>
<main class="flex-fill">  

    <?php if (empty($pesquisas)) {
        echo "<div class='container mt-5'><div class='alert alert-info'>Nenhuma pesquisa registrada ainda.</div></div>";
        exit;
    }?>

    <div class="container mt-5">
        <h1 class="mb-4">Dados Gerais</h1>
        <div class="row">
            <div class="col-md-4">
                <canvas id="graficoVitima"></canvas>
            </div>
            <div class="col-md-4">
                <canvas id="graficoTipo"></canvas>
                <br>
                <canvas id="graficoLocal"></canvas>
            </div>
            <div class="col-md-4">
                <canvas id="graficoSentimento"></canvas>
            </div>
            
        </div>
    </div>

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
                                            echo "<span class='badge bg-info text-dark me-1'>" . htmlspecialchars($sent) . "</span>";
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
    </div>
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-4">
      <div class="container">
        <p>&copy; 2025 Projeto Cyberbullying. Todos os direitos reservados.</p>
        <p>Desenvolvido por Gabriel, Olavo e João Vitor</p>
      </div>
    </footer>
  </div>

<script>
    const pesquisas = <?= json_encode($pesquisas, JSON_UNESCAPED_UNICODE) ?>;

    function contarValores(campo, isArray = false) {
        const contagem = {};
        pesquisas.forEach(p => {
            let valor = p[campo];
            if (isArray && Array.isArray(valor)) {
                valor.forEach(v => {
                    contagem[v] = (contagem[v] || 0) + 1;
                });
            } else if (valor) {
                contagem[valor] = (contagem[valor] || 0) + 1;
            }
        });
        return contagem;
    }

    const vitimaCount = contarValores("vitima");
    new Chart(document.getElementById('graficoVitima'), {
        type: 'pie',
        data: {
            labels: Object.keys(vitimaCount),
            datasets: [{
                label: "Já foi vítima?",
                data: Object.values(vitimaCount),
                backgroundColor: ['#dc3545', '#007bff']
            }]
        }
    });

    const tipoCount = contarValores("tipo");
    new Chart(document.getElementById('graficoTipo'), {
        type: 'bar',
        data: {
            labels: Object.keys(tipoCount),
            datasets: [{
                label: "Tipo de Cyberbullying",
                data: Object.values(tipoCount),
                backgroundColor: ['#28a745', '#6f42c1', '#fd7e14', '#20c997', '#e83e8c', '#3E38A6', '#F048A4']
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    const sentimentoCount = contarValores("sentimento", true);
    new Chart(document.getElementById('graficoSentimento'), {
        type: 'doughnut',
        data: {
            labels: Object.keys(sentimentoCount),
            datasets: [{
                label: "Sentimentos",
                data: Object.values(sentimentoCount),
                backgroundColor: ['#28a745', '#6f42c1', '#fd7e14', '#20c997', '#e83e8c', '#3E38A6', '#F048A4']
            }]
        }
    });

    const localCount = contarValores("onde")
    new Chart(document.getElementById('graficoLocal'), {
        type: 'bar',
        data: {
            labels: Object.keys(localCount),
            datasets: [{
                label: "Tipo de A",
                data: Object.values(localCount),
                backgroundColor: ['#007bff', '#dc3545']
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
        
    });
</script>

<script src="resources/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>
</html>
