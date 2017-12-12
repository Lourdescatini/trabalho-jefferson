<?php

require_once "Conexao.php";

class login
{
    private $conexao;

    public function __construct(){
        session_start();
        $this->conexao = Conexao::getConexao();
    }

    public function logar($email, $senha){
        $consulta = $this->conexao->query("SELECT email FROM users WHERE email='$email' AND senha='$senha';");
        $user = $consulta->fetch(PDO::FETCH_ASSOC);
        if(isset($user['email'])){
            $_SESSION['logado'] = true;
            header('Location: http://localhost/trabLourdes/app/views/admin/produtos.php');
        }
    }

    public function checarLogin(){
        if(!isset($_SESSION['logado'])){
            header('Location: http://localhost/trabLourdes/app/views/admin/login.php');
        }
    }

    public function logout(){
        $_SESSION['logado'] = false;
    }
}