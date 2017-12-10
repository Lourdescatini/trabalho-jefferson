<?php
/**
 * Created by PhpStorm.
 * User: JEFFERSON
 * Date: 09/11/2017
 * Time: 10:40
 */

require_once "Conexao.php";

class Produto {

    public $codigo;
    public $nome;
    public $preco;
    public $categoria;
    //estoque
    private $conexao;

    public function __construct($nome, $preco, $categoria, $quantidade, $id = 0){ //estoque
        $this->nome = $nome;
        $this->preco = $preco;
        $this->categoria = $categoria;
        $this->codigo = $id;
        $this->quantidade = $quantidade;
        $this->conexao = Conexao::getConexao();
    }

    public function estaDisponivel($id){
        $consulta = $this->conexao->query("SELECT quantidade_estoque FROM tb_produtos WHERE id = $id");
        $produtoQuantidade = $consulta->fetch(PDO::FETCH_ASSOC);

        if($produtoQuantidade['quantidade_estoque'] == 0)
            return "Indisponível";
        else
            return "Disponível";
    }
}
