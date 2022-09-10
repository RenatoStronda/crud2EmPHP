<?php
    require_once("connection.php");

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $nomeErro = null;
        $telefoneErro = null;
        $emailErro = null;
        $validacao = true;

    if(isset($_POST["nome"]) && !empty($_POST["nome"]))
    {
        $nome = $_POST["nome"];
    }
    else
    {
        $nomeErro = "Por Favor, Digite Seu Nome!";
        $validacao = false;
    }

    if(isset($_POST["telefone"]) && !empty($_POST["telefone"]))
    {
        $telefone = $_POST["telefone"];
    }
    else
    {
        $telefoneErro = "Por Favor, Digite Seu Telefone!";
        $validacao = false;
    }

    if(isset($_POST["email"]) && !empty($_POST["email"]))
    {
        $email = $_POST["email"];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $emailErro = "Por Favor, Digite Seu E-mail Válido";
            $validacao = false;
        }
    }
    else
    {
        $emailErro = "Por Favor, Digite Seu E-mail!";
        $validacao = false;
    }

    if($validacao)
    {
        try
        {
            $sql = $conn->prepare("UPDATE contato SET nm_contato = ?, nm_telefone = ?, nm_email = ? WHERE cd_contato = ?");
            $sql->execute(array($nome, $telefone, $email, $id));
            echo "<script language=\"javascript\"> alert(\"Contato Atualizado Com Sucesso!\"); location.replace(\"index.php\"); </script>";
            $conn = null;
        }
        catch(PDOException $e)
        {
            echo "Falha Ao Atualizar Os Contatos: " . $e->getMessage();
        }
    }
}
else
{
    try
    {
        $sql = $conn->prepare("SELECT * FROM contato WHERE cd_contato = $id");
        $sql->execute(array($id));
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        $nome = $data['nm_contato'];
        $telefone = $data['nm_telefone'];
        $email = $data['nm_email'];
    }
    catch(PDOException $e)
    {
        echo "Falha Ao Buscar Os Contatos: " . $e->getMessage();
    }  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <title> Atualizar Contato </title>
</head>
<body>
<div class="container">
    <div class="span10 offset1">
        <div class="card-header">
            <h3 class="well"> Atualizar Contato </h3>
        </div>

        <div class="card-body">
            <form class="form-horizontal" action="update.php?id=" method="POST">
                <div class="control-group">
                    <label class="control-label"> Nome: </label>
                        <div class="controls">
                            <input name="nome" class="form-control" size="50" type="text" placeholder="Nome" 
                            value="<?php echo !empty($nome) ? $nome : ''; ?>">
                            <span class="text-danger"><?php echo $nomeErro; ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> Telefone: </label>
                        <div class="controls">
                            <input name="telefone" class="form-control" size="50" type="text" placeholder="Telefone" 
                            value="<?php echo !empty($telefone) ? $telefone : ''; ?>">
                            <span class="text-danger"><?php echo $telefoneErro; ?></span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> E-mail: </label>
                        <div class="controls">
                            <input name="email" class="form-control" size="50" type="text" placeholder="E-mail" 
                            value="<?php echo !empty($email) ? $email : ''; ?>">
                            <span class="text-danger"><?php echo $emailErro; ?></span>
                        </div>
                    </div>

                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning"> Atualizar </button>
                        <a href="index.php" class="btn btn-success"> Voltar </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>