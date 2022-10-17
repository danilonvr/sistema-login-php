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
    <title>Registro</title>
</head>
<body>
    
    <div class="corpo-form">
    <h1>CADASTRE-SE</h1>
    <form method="get">
        <fieldset>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="digite seu nome" maxlength="30">
            <label for="nome">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="digite seu e-mail" maxlength="30">
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" placeholder="digite seu cpf" maxlength="11">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="******" maxlength="32">
            <label for="senha">Confirme sua senha:</label>
            <input type="password" name="confirmarSenha" id="csenha" placeholder="******" maxlength="32">
            <input type="submit" value="Cadastrar">
            <a href="login.php">Já tem uma conta? <strong>Entrar</strong></a>
        </fieldset>
    </form>
</div>

<?php
    //verificar se as variáveis existem, com isset
    if (isset($_GET['nome']))
    {
        $nome = addslashes($_GET['nome']);
        $cpf = addslashes($_GET['cpf']);
        $email = addslashes($_GET['email']);
        $senha = addslashes($_GET['senha']);
        $confSenha = addslashes($_GET['confirmarSenha']);
        //verificar se não está vazio
        if (!empty($nome) and !empty($cpf) and !empty($email) and !empty($senha) and !empty($confSenha))
        {
            /*preencher com as informações que estão definidas no parâmetro da função
            $instancia->conectar($nome,$host,$usuario,$senha);
            */
            $instancia->conectar("projeto_login","localhost","root","");
            //usuário root e senha vazio = padrão xampp
            if($instancia->msgErro == ""){
                //tudo ok
                if ($senha == $confSenha)
                {
                    if($instancia->cadastrar($nome,$cpf,$email,$senha))
                    {
                        ?>
                        <div class="msg-sucesso">
                            Cadastrado com sucesso, faça o seu <a href='login.php'>login</a>
                        </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="msg-erro">
                        E-mail já cadastrado, faça o seu <a href='login.php'>login</a>
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div class="msg-erro">
                    Senhas não condizem, reveja seus dados!
                    </div>
                    <?php
                }
                
                
            }
            else
            {
                echo "Erro:" .$instancia->msgErro;
            }
        }
        else
        {
            ?>
            <div class="msg-erro">
                Preencha todos os campos corretamente!
            </div>
            <?php
            
        }
    }
?>
</body>
</html>