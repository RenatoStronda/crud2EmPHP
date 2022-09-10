<?php
    require_once("connection.php");

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
    }

    if(isset($_POST['id']) && !empty($_POST['id']))
    {
        $cd = $_POST['id'];

        try
        {
            $sql = $conn->prepare("DELETE FROM contato WHERE cd_contato = ?");
            $sql->execute(array($cd));
            echo "<script language=\"javascript\"> alert(\"Contato Excluído Com Sucesso!\"); location.replace(\"index.php\"); </script>";
            $conn = null;
        }
        catch(PDOException $e)
        {
            echo "Falha Ao Excluir Os Contatos: " . $e->getMessage();
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
    <title> Excluir Contato </title>
</head>
<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3 class="well"> Excluir Contato </h3>
            </div>

            <form class="form-horizontal" action="delete.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="alert alert-danger"> Deseja Excluir O Contato? </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-danger"> Sim </button>
                    <a href="index.php" type="btn" class="btn btn-outline-danger"> Não </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>