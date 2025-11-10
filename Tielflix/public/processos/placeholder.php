<?php
if (!isset($_SESSION)) {
    session_start();
}

    require_once '../src/User.php';
    require_once '../src/Filme.php';


    $usuarios = [
        [
            'username' => 'Gabriel_Castelo',
            'email' => 'gabriel@gmail.com',
            'senha' => '12345678',
            'filme' => [
                'titulo' => 'Pinóquio ',
                'diretor' => 'Guillermo del Toro',
                'ano' => 2022,
                'genero' => 'Animação StopMotion / Fantasia',
                'link_imagem' => 'https://br.web.img3.acsta.net/pictures/22/07/27/15/18/5452852.jpg',
                'avaliacao' => 5,
                'assistido' => true,
                'plataformas' => 'Netflix',
                'link_trailer' => '',
                'comentario' => 'Uma releitura de uma obra antiga, que pode surpreender a todos!'
            ]
        ],
        [
            'username' => 'Vick',
            'email' => 'vic@gmail.com',
            'senha' => 'abcdefgh',
            'filme' => [
                'titulo' => 'Percy Jackson e o Ladrão de Raios',
                'diretor' => 'Joe Wright',
                'ano' => 2010,
                'genero' => 'Romance, ação',
                'link_imagem' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ9b-w8sxCA4onqHPRfX6WtOLmingOhm5A3BPqPfnPxqbB_s5xL16XaBsNha6lYU2XFkfODMjQaK5ftdgHFaYGjzlYtEBkEnOTUXbRJ243v&s=10',
                'avaliacao' => 0,
                'assistido' => true,
                'plataformas' => 'Disney+',
                'link_trailer' => '',
                'comentario' => 'Uma péssima releitura de um livro incrível. Vejam a série vale muito mais a pena.'
            ]
        ],
        [
            'username' => 'Kamilla',
            'email' => 'kamilla@gmail.com',
            'senha' => '987654321',
            'filme' => [
                'titulo' => 'Guerreiras do kpop',
                'diretor' => 'Maggie Kang, Chris Appelhans',
                'ano' => 2025,
                'genero' => 'Animação',
                'link_imagem' =>'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT8SS9fwPdKs1ga2Lpb1G71C1yAEX7e6Fgs3Q&s',
                'avaliacao' => 5,
                'assistido' => true,
                'plataformas' => 'Netflix',
                'link_trailer' => '',
                'comentario' => 'Desenho maravilhoso!'
            ]
        ]
    ];

    // Percorre os usuários e adiciona na sessão
    foreach ($usuarios as $u) {
        $username = $u['username'];
        $email = $u['email'];
        $senha = $u['senha'];

        $_SESSION['users'][$username] = new User($username, $email, $senha);

        $f = $u['filme'];
        $novo_filme = new Filme(
            $f['titulo'],
            $f['ano'],
            $f['diretor'],
            $f['genero'],
            $f['link_imagem'],
            $f['avaliacao'],
            $f['assistido'],
            $f['plataformas'],
            $f['link_trailer'],
            $f['comentario']
        );

        $_SESSION['users'][$username]->addFilme($novo_filme);
    }
$_SESSION['initialized'] = true;