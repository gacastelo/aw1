<?php

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sobre Nós">
    <link rel="icon" href="resources/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="resources/css/style.css">
    <title>Sobre Nós</title>
</head>

<body class="d-flex flex-column min-vh-100">
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
                    <li class="nav-item"><a class="nav-link active"  href="#">Nosso Projeto</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="flex-fill">
    <section id="formulario">
        <div class="container mt-5">
            <h2 class="text-center mb-4">Formulário Anônimo sobre Cyberbullying</h2>
            <form action="resources/php/processar_pesquisa.php" method="post">
                <div class="mb-3">
                    <label for="vitima" class="form-label">Você já foi vítima de cyberbullying?</label>
                    <select class="form-select" id="vitima" name="vitima" required>
                        <option value="" disabled selected>Selecione uma opção</option>
                        <option value="sim">Sim</option>
                        <option value="nao">Não</option>
                    </select>
                </div>
                <div id="hide" class="hidden">
                    <div class="mb-3">
                        <label for="onde" class="form-label">Onde aconteceu o cyberbullying?</label>
                        <select class="form-select not-required" id="onde" name="onde" required>
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="redes_sociais">Redes sociais (Instagram, Facebook, etc.)</option>
                            <option value="jogos_online">Jogos online (ex.: Fortnite, LOL)</option>
                            <option value="aplicativos_mensagem">Aplicativos de mensagem (WhatsApp, Telegram)</option>
                            <option value="fora_internet">Fora da internet (comentários e fofocas)</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Qual foi o tipo de agressão sofrida?</label>
                        <select class="form-select not-required" id="tipo" name="tipo" required>
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="ofensas">Ofensas públicas ou comentários maldosos</option>
                            <option value="exclusao">Exclusão de grupos ou redes sociais</option>
                            <option value="ameacas">Ameaças (verbais ou físicas)</option>
                            <option value="compartilhamento">Compartilhamento de informações pessoais sem consentimento
                            </option>
                            <option value="assedio">Assédio constante (mensagens indesejadas)</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="frequencia" class="form-label">Qual a frequência com que ocorreu o
                            cyberbullying?</label>
                        <select class="form-select not-required" id="frequencia" name="frequencia" required>
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="diariamente">Diariamente</option>
                            <option value="semanalmente">Semanalmente</option>
                            <option value="mensalmente">Mensalmente</option>
                            <option value="ocasionalmente">Ocasionalmente</option>
                            <option value="incidente_unico">Foi um incidente único</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sentimento" class="form-label">Como o cyberbullying fez você se sentir? (Marque
                            todas as opções que se aplicam)</label>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sentimento[]" id="sentimento1"
                                value="triste">
                            <label class="form-check-label" for="sentimento1">Triste</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sentimento[]" id="sentimento2"
                                value="ansioso">
                            <label class="form-check-label" for="sentimento2">Ansioso(a)</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sentimento[]" id="sentimento3"
                                value="com_raiva">
                            <label class="form-check-label" for="sentimento3">Com raiva</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sentimento[]" id="sentimento4"
                                value="inseguro">
                            <label class="form-check-label" for="sentimento4">Inseguro(a)</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sentimento[]" id="sentimento5"
                                value="desesperancado">
                            <label class="form-check-label" for="sentimento5">Desesperançado(a)</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sentimento[]" id="sentimento6"
                                value="outro">
                            <label class="form-check-label" for="sentimento6">Outro</label>
                            <input type="text" class="form-control mt-2" name="sentimento_outro" id="sentimentoOutro"
                                placeholder="Especifique...">
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="ajuda" class="form-label">Você procurou ajuda para lidar com o
                            cyberbullying?</label>
                        <select class="form-select not-required" id="ajuda" name="ajuda" required>
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>
                            <option value="naosabia">Não sabia como buscar ajuda</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="suporte" class="form-label">Você se sentiu apoiado(a) por amigos, familiares ou
                            pessoas próximas?</label>
                        <select class="form-select not-required" id="suporte" name="suporte" required>
                            <option value="" disabled selected>Selecione uma opção</option>
                            <option value="sim">Sim</option>
                            <option value="nao">Não</option>
                            <option value="parcialmente">Parcialmente</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="comentarios" class="form-label">Você tem alguma sugestão ou comentário sobre como melhorar
                        a prevenção e o combate ao cyberbullying?</label>
                    <textarea class="form-control" id="comentarios" name="comentarios" rows="4"></textarea>
                </div>

                <div style="text-align: center; width: 100%;"><button type="submit" class="btn btn-primary w-25">Enviar</button></div>
            </form>
        </div>
    </section>
    </main>
    <footer class="bg-dark text-white text-center py-3">
      <div class="container">
        <p>&copy; 2025 Projeto Cyberbullying. Todos os direitos reservados.</p>
        <p>Desenvolvido por Gabriel, Olavo e João Vitor</p>
      </div>
    </footer>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="resources/js/script.js"></script>
</body>

</html>