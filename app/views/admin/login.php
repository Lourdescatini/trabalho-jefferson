<?php
    require "cabecalho.php";
    require "../../models/login.php";
    $logar = new login;

    if(isset($_POST['enviar'])){
        $logar->logar($_POST['email'], $_POST['senha']);
    }
?>
<form method="post">
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <input name="email" type="text" class="form-control" placeholder="email" aria-describedby="basic-addon2">
            </div>
            <div class="input-group">
                <input name="senha" type="password" class="form-control" placeholder="senha" aria-describedby="basic-addon2">
            </div>
            <div class="input-group">
                <input name="enviar" type="submit" class="input-group-addon center" value="Enviar">
            </div>
        </div>
    </div>
</form>
<?php
    require "rodape.php";
?>
