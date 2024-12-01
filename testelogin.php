<?php
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        include_once 'config.php';
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";

        $result = $conexao->query($sql);


        if (mysqli_num_rows($result) < 1) { 
            // Credenciais inválidas
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('location: login.php');
        } else {
            // Credenciais válidas
            $user_data = $result->fetch_assoc(); // Obter dados do usuário
        
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
        
            // Verifica o tipo de usuário
            if ($user_data['email'] === 'admin@admin.com') {
                $_SESSION['tipo_usuario'] = 'admin';
            } else {
                $_SESSION['tipo_usuario'] = 'normal';
            }
        
            // Redireciona para o sistema
            header('Location: sistema.php');
        }
    }