<?php
    session_start();
    include_once 'config.php';

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {

        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    
    $logado = $_SESSION['email'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    if(!empty($_GET['search'])){
        $data = $_GET['search'];
        $sql = "SELECT * FROM usuarios WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id DESC";
    }
    else{
        $sql = "SELECT * FROM usuarios ORDER BY id DESC";
    }
    $result = $conexao->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sistema</title>
    <style> 
        body{
            background-image: linear-gradient(to right,rgb(0, 106, 255), rgb(0, 45, 109));
            color: white;
            text-align: center;
        }
        .table-bg {
    background: rgba(0, 0, 0, 0.6); 
    border-radius: 15px; 
    overflow: hidden;
}

.table-bg th, .table-bg td {
    padding: 10px; 
    text-align: center; 
}

.table-bg thead th {
    background-color: rgb(0, 40, 150); 
}

.table-bg tbody tr:hover {
    background-color: rgba(0, 106, 255, 0.3); 
}

.table-bg tbody tr:nth-child(odd) {
    background-color: rgba(255, 255, 255, 0.1); 
}
.box-search{
    display: flex;
    justify-content: center;
    gap: .1%;
}
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1">Sistema</span>
  </div>
  <div class="d-flex">
        <a href="sair.php" class="btn btn-danger me-5">Sair</a>
  </div>
</nav>
<br>
<?php
    echo "<h1>Seja bem vindo, <u>$logado</u></h1>";
?>
<br>
<div class="box-search">
    <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
    <button onclick="searchData()" class="btn btn-primary">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
    </svg>
    </button>
</div>
<div class="m-5">
    <table class="table table-dark table-striped table-hover table-bordered table-bg">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Senha</th>
                <th scope="col">Email</th>
                <th scope="col">Telefone</th>
                <th scope="col">Sexo</th>
                <th scope="col">Data de Nascimento</th>
                <th scope="col">Cidade</th>
                <th scope="col">Estado</th>
                <th scope="col">Endereço</th>
                <th scope="col">...</th>
            </tr>
        </thead>
    <tbody>
       <?php
            while($user_data = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
                echo "<td>".$user_data['id']."</td>";
                echo "<td>".$user_data['nome']."</td>";
                echo "<td>".$user_data['senha']."</td>";
                echo "<td>".$user_data['email']."</td>";
                echo "<td>".$user_data['telefone']."</td>";
                echo "<td>".$user_data['sexo']."</td>";
                echo "<td>".$user_data['data_nasc']."</td>";
                echo "<td>".$user_data['cidade']."</td>";
                echo "<td>".$user_data['estado']."</td>";
                echo "<td>".$user_data['endereco']."</td>";
                
                if ($tipo_usuario === 'admin') {
                    echo "<td>
                        <a href='edit.php?id=$user_data[id]' class='btn btn-sm btn-primary'>Editar</a>
                        <a href='delete.php?id=".$user_data['id']."' class='btn btn-sm btn-danger'>Excluir</a>
                    </td>";
                } else {
                    echo "<td>-</td>";
                }
                echo "</tr>";
            }
       ?>
    </tbody>
    </table>
</div>
</body>
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData(){
        window.location = 'sistema.php?search='+search.value;
    }
</script>
</html>