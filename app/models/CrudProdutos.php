<?php
/**
 * Created by PhpStorm.
 * User: JEFFERSON
 * Date: 16/11/2017
 * Time: 10:56
 */

require_once "Conexao.php";
require_once "Produto.php";

class CrudProdutos {

    private $conexao;
    private $produto;

    public function __construct() {
        $this->conexao = Conexao::getConexao();
    }

    public function salvar(Produto $produto){
        $sql = "INSERT INTO tb_produtos (nome, preco, categoria) VALUES ('$produto->nome', $produto->preco, '$produto->categoria')";

        $this->conexao->exec($sql);
    }

    public function excluir($codigo){
        $sql = "DELETE FROM tb_produtos WHERE id = $codigo";

        $this->conexao->exec($sql);
    }

    public function editar(Produto $produto, $codigo){
        $sql = "UPDATE tb_produtos SET nome = '$produto->nome', preco = $produto->preco, categoria = '$produto->categoria' WHERE id = $codigo";

        $this->conexao->exec($sql);
    }

    public function getProduto($codigo){
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos WHERE id = $codigo");
        $produto = $consulta->fetch(PDO::FETCH_ASSOC); //SEMELHANTES JSON ENCODE E DECODE

        return new Produto($produto['nome'], $produto['preco'], $produto['categoria'], $produto['quantidade_estoque'], $produto['id']);

    }

    public function getProdutos(){
        $consulta = $this->conexao->query("SELECT * FROM tb_produtos");
        $arrayProdutos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        //Fabrica de Produtos
        $listaProdutos = [];
        foreach ($arrayProdutos as $produto){
            $listaProdutos[] = new Produto($produto['nome'], $produto['preco'], $produto['categoria'], $produto['quantidade_estoque'], $produto['id']);
        }

        return $listaProdutos;

    }

    public function comprar($quantidade, $codigo){
        if(empty($quantidade)){
            return(array('danger','Quantidade vazia'));
        }

        $consulta = $this->conexao->query("SELECT quantidade_estoque FROM tb_produtos WHERE id=$codigo");
        $quantidadeEstoque = $consulta->fetchAll(PDO::FETCH_ASSOC);
        if($quantidade>$quantidadeEstoque[0]['quantidade_estoque']){
            return(array('danger','Quantidade desejada excede quantidade disponível em estoque'));
        }else{
            $consulta = $this->conexao->query("UPDATE tb_produtos SET quantidade_estoque = (quantidade_estoque - $quantidade) WHERE id=$codigo");
            return(array('success','Feito com sucesso'));
        }
    }

    public function pesquisar($nome){
        if(empty($nome)){
            return("Nada encontrado");
        }

        $consulta = $this->conexao->query("SELECT * FROM tb_produtos WHERE nome ='$nome';");
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $produto){
            $listaProdutos[] = new Produto($produto['nome'], $produto['preco'], $produto['categoria'], $produto['quantidade_estoque'], $produto['id']);
        }

        return($listaProdutos);
    }
}
