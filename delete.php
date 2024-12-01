<?php

    if(!empty($_GET['id']))
    {
       
        include_once 'config.php';

        $id = $_GET['id'];
        $sqlselect = "SELECT * FROM usuarios WHERE id=$id";
        $result = $conexao->query($sqlselect);
       
        if($result->num_rows > 0)
        {
            $sqlDelete = "DELETE FROM usuarios WHERE id=$id";
            $resultDelete = $conexao->query($sqlDelete);
        }
    }
    header('Location: sistema.php');