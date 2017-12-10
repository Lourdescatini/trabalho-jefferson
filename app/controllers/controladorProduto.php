<?php
require_once "../../models/Produto.php";
require_once "../../models/CrudProdutos.php";

$crud = new CrudProdutos();

if ( $_GET['cadastrar'] == 'cadastrar'){
    $novoProduto = new Produto($_POST['nome'], $_POST['preco'], $_POST['categoria'], $_POST['quantidade']);
    $crud->salvar($novoProduto);
}
if ( $_GET['editar'] == 'editar'){
    $codigo = $_GET['codigo'];
    $produtoEditado = new Produto($_POST['nome'], $_POST['preco'], $_POST['categoria'], $_POST['quantidade']);
    $crud->editar($produtoEditado, $codigo);
}
if ( $_GET['excluir'] == 'excluir'){
    $codigo = $_GET['codigo'];
    $crud->excluir($codigo);
}