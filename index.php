<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets\css\bootstrap.min.css">
    <title> Contatos </title>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <div class="row align-items-center justify-content-center">
                <h2> CRUD CONTATOS </h2>
            </div>
        </div>

        <div class="row d-flex flex-row-reverse">
            <p>
                <a href="create.php" class="btn btn-success"> Adicionar </a>
            </p>
        </div>

        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"> Código </th>
                        <th scope="col"> Nome </th>
                        <th scope="col"> Telefone </th>
                        <th scope="col"> E-mail </th>
                        <th scope="col"> Ação </th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        require_once("connection.php");
                        try
                        {
                            $sql = $conn->query("SELECT * FROM contato");
                            while($row = $sql->fetch(PDO::FETCH_ASSOC))
                            {
                                echo '<tr>';
                                echo '<th scope="row">' . $row['cd_contato'] . '</th>';
                                echo '<td>' . $row['nm_contato'] . '</td>';
                                echo '<td>' . $row['nm_telefone'] . '</td>';
                                echo '<td>' . $row['nm_email'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn btn-primary" href="read.php?id=' . $row['cd_contato'] . '">Info</a>';
                                echo '<a class="btn btn-warning" href="update.php?id=' . $row['cd_contato'] . '">Atualizar</a>';
                                echo '<a class="btn btn-danger" href="delete.php?id=' . $row['cd_contato'] . '">Excluir</a>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            $conn = null;
                        }
                        catch(PDOException $e)
                        {
                            echo "Falha Ao Buscar Os Contatos: " . $e->getMessage();
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>