<?php
    require_once("connection.php");

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <title> Informações Contato </title>
</head>
<body>
<div class="container">
    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Informção Contato </h3>
            </div>

            <div class="container">
                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label"> Nome: </label>
                        <div class="controls from-control">
                            <label class="carousel-inner">
                                <?php echo $nome; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> Telefone: </label>
                        <div class="controls from-control disabled">
                            <label class="carousel-inner">
                                <?php echo $telefone; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"> Email: </label>
                        <div class="controls from-control disabled">
                            <label class="carousel-inner">
                                <?php echo $email; ?>
                            </label>
                        </div>
                    </div>

                    <br>
                    <div class="form-actions">
                        <a href="index.php" type="btn" class="btn btn-primary"> Voltar </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>