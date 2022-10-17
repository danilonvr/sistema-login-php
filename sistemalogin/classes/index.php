<?php

Class Usuario
{
    private $pdo;
    public $msgErro = ""; // fica assim se tiver td certo
    public function conectar($nome,$host,$usuario,$senha)
    {
        global $pdo;
        global $msgErro;
        try {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
        
        
    }

    public function cadastrar($nome,$cpf,$email,$senha)
    {
        global $pdo;
        //verificar cadastro
        $sql = $pdo->prepare("SELECT ID_USUARIO FROM usuarios where EMAIL = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if ($sql->rowCount() > 0)
        {
            return false; //já está cadastrada
        }
        else
        {
            $sql = $pdo->prepare("INSERT INTO usuarios (NOME,CPF,EMAIL,SENHA) VALUES (:n,:c,:e,:s)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":c",$cpf);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            return true;
        }
    }

    public function logar($email,$senha)
    {
        global $pdo;
        //verificar se o email e senha estao cadastrados
        $sql = $pdo->prepare("SELECT ID_USUARIO FROM usuarios WHERE EMAIL = :e AND SENHA = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        //testando se ja existe
        if($sql->rowCount() > 0 )
        {
            $dado = $sql->fetch();
            session_start();
            $_SESSION['ID_USUARIO'] = $dado['ID_USUARIO'];
            //apenas o id vai acessar a area privada dele
            return true;//sucesso no login
        }
        else
        {
            return false;
        }

    }
}

?>