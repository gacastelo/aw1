<?php 
class Filme
{
    public string $titulo;
    public int $ano;
    public string $diretor;
    public string $genero;
    public string $link_imagem;
    public int $avaliacao;
    public bool $assistido;
    public ?string $plataformas;
    public ?string $link_trailer;
    public ?string $comentario;
    
    public function __construct(
        string $titulo,
        int $ano,
        string $diretor,
        string $genero,
        string $link_imagem,
        int $avaliacao,
        bool $assistido,
        ?string $plataformas = null,
        ?string $link_trailer = null,
        ?string $comentario = null
    ) {
        $this->titulo = $titulo;
        $this->ano = $ano;
        $this->diretor = $diretor;
        $this->genero = $genero;
        $this->link_imagem = $link_imagem;
        $this->avaliacao = $avaliacao;
        $this->assistido = $assistido;
        $this->plataformas = $plataformas;
        $this->link_trailer = $link_trailer;
        $this->comentario = $comentario;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }

    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function toArray()
    {
        return [
            'title' => $this->titulo,
            'year' => $this->ano,
            'director' => $this->diretor,
            'genre' => $this->genero,
            'image_link' => $this->link_imagem,
            'rating' => $this->avaliacao,
            'watched' => $this->assistido,
            'platforms' => $this->plataformas,
            'trailer_link' => $this->link_trailer,
            'comment' => $this->comentario,
        ];
    }

    public function view()
    {
        extract($this->toArray());
        require '../assets\php\viewFilmeModal.php';
    }

}
?>
