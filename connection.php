<?php
    $hostname = "localhost";//127.0.0.1
    $database = "agenda";
    $user = "root";
    $password = "usbw";

    try
    {
        $conn = new pdo("mysql:host=$hostname;dbname=$database", $user, $password);
        $conn -> setAttribute (pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
        //echo "Conexão Efetuada Com Sucesso!";
    }
    catch(pdoException $e)
    {
        echo "Falha Na Conexão: " . $e->getMessage();
    }
?>