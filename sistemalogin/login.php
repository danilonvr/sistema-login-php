<!DOCTYPE html>
<?php
    require_once 'classes/index.php';
    $instancia = new Usuario;
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="reset.css">
    <title>Login</title>
</head>
<body>
    
    <div class="corpo-form">
    <h1>ENTRAR</h1>
    <form method="get">
        <fieldset>
            <label for="email">E-mail:</label>
            <input type="text" name="email" id="email" placeholder="digite seu e-mail">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="digite sua senha">
            <input type="submit" value="Entrar">
            <a href="registro.php">Ainda não tem uma conta? <strong>Registre-se</strong></a>
        </fieldset>
    </form>
</div>
<?php
    if (isset($_GET['email']))
    {
        $email = addslashes($_GET['email']);
        $senha = addslashes($_GET['senha']);
        //verificar se não está vazio
        if (!empty($email) and !empty($senha))
        {
            $instancia->conectar("projeto_login","localhost","root","");
            if($instancia->msgErro== "")
            {
                if($instancia->logar($email,$senha))
                {
                    header("location:areausuario.php");
                }
                else
                {
                    ?>
                <div class="msg-erro">
                    E-mail e/ou senha incorretos!
                </div>
                <?php
                }
            }
            else
            {
                echo "Erro:". $instancia->msgErro;
            }
           
        }
        else
        {
            ?>
            <div class="msg-erro">
                Preencha todos os campos corretamente!
            </div>
            <?php
        }}
?>
</body>
</html>