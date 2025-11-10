<?php 
class User
{
    public $username;
    public $email;
    public $password;
    public $created_at;
    public $filmes;
    public $bio;

    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->created_at = date('d-m-Y H:i:s');
        $this->filmes = [];
        $this->bio = "";
    }

    public function addFilme($filme)
    {
        $this->filmes[] = $filme;
    }

    public function verifyPassword($password)
    {   
        return password_verify($password, $this->password);
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
    
    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }
}
?>