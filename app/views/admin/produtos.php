<?php

    require_once __DIR__."/../../models/CrudProdutos.php";
    require "../../controllers/controladorProduto.php";
    require "../../models/login.php";

    $crud = new CrudProdutos();
    $login = new login;

    $login->checarLogin();

    if(isset($_POST['enviar'])){
        $listaProdutos = $crud->pesquisar($_POST['pesquisa']);
    }else{
        $listaProdutos = $crud->getProdutos();
    }

    if(isset($_GET['logout'])){
        $login->logout();
    }

    require "cabecalho.php";
?>
<a href="?logout=1">Logout</a>
<!--Barra de busca-->
<form method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <input name="pesquisa" type="text" class="form-control" placeholder="digite o nome do produto" aria-describedby="basic-addon2">
                <input name="enviar" type="submit" class="input-group-addon" value="Enviar">
            </div>
        </div>
    </div>
</form>
<br>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Título</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Categoria</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($listaProdutos as $produto): ?>
    <tr>
        <th scope="row"><?= $produto->codigo; ?></th>
        <td><?= $produto->nome; ?></td>
        <td><?= $produto->preco; ?></td>
        <td><?= $produto->quantidade_estoque; ?></td>
        <td><?= $produto->categoria; ?></td>
        <td><a href="editar-produto.php?codigo=<?= $produto->codigo; ?>">##editar</a> | <a href="?excluir=excluir&codigo=<?=$produto->codigo;?>">remover</a></td>
    </tr>
   <?php endforeach; ?>

    </tbody>
</table>
<?php
    require "rodape.php";
?>