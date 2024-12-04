<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profissionais</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
<?php 
session_start();

// Dados de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jobs";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se o usuário está logado
if (!isset($_SESSION["user_id"])) {
  header("Location: ..\login.php");
  exit;
}

$id_do_usuario = $_SESSION["user_id"];

// Busca os dados do usuário no banco de dados
$sql = "SELECT * FROM `cadastro` WHERE id = $id_do_usuario and foto is not null";
$result = $conn->query($sql);

// Exibe o formulário para atualização do cadastro
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

echo "<header style='background:white; margin-top:-10px; padding:5px;'>
    <ul>
        <a href='../authenticated/home.php'> <li>
            <img src='..\imagens\Logo.svg' alt=''class='logo'> JMTG
        </li></a> 
        <a href='../authenticated/profissionais.php'><li>
           Profissionais
        </li></a>
        <a href='../authenticated/cadastroVagas.php'> <li>Cadastrar vaga</li></a>
        <a href='../authenticated/ultimasVagas.php'><li>Ultimas vagas</li></a>
        <a href='../authenticated/vagasCriadas.php'><li>Minhas vagas</li></a>
        <a href='../authenticated/vagasPorCidade.php'><li>Vagas por cidade</li></a>
        <div class='dropdown'> 
        <div class='perfil-img' style='display:flex; align-items:center; justify-content:center;'>
        <div style='display:flex; flex-direction:column; align-items:center;'>
          <img src='uploads/$row[foto]' style='width:50px; height:50px; border-radius:100%;'>  
          </div>    
  <li class='dropdown-btn'>$row[nome]</li>
  <svg xmlns='http://www.w3.org/2000/svg' style='width:10px; color:green;' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z'/ ></svg>
  </div>
  <ul class='dropdown-menu'>
  <a href='perfil.php'><li>Editar perfil</li></a>
  <a href='#'> <li>Ranking</li></a>
  <a href='../authenticated/profissao.php'> <li>Profissão</li></a>
  <a href='#'><li>Contratos</li></a>
  <a href='#'> <li>Chat</li></a>
  <a href='curriculo.php'> <li>Currículo</li></a>
  <a href='./logout.php'><li>Sair</li></a>
  </ul>
</div>


    </ul>
</header>";

     }
      

}

  else{

    echo "<header style='background:white; margin-top:-10px;padding:5px; '>
      <ul>
          <a href='../authenticated/home.php'> <li>
              <img src='..\imagens\Logo.svg' alt=''class='logo'> JOBS IN CARIRI
          </li></a> 
          <a href='../authenticated/profissionais.php'><li>
           Profissionais
        </li></a>
        <a href='../authenticated/cadastroVagas.php'> <li>Cadastrar vaga</li></a>
        <a href='../authenticated/ultimasVagas.php'><li>Ultimas vagas</li></a>
        <a href='../authenticated/vagasCriadas.php'><li>Minhas vagas</li></a>
          <div class='dropdown'> 
          <div class='perfil-img' style='display:flex; align-items:center; justify-content:center;'>
            <img src='https://placehold.co/500x400' style='width:50px; height:50px; border-radius:100%;'>        
    <li class='dropdown-btn'>Perfil</li>
    <svg xmlns='http://www.w3.org/2000/svg' style='width:10px; color:green;' viewBox='0 0 320 512'><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M137.4 374.6c12.5 12.5 32.8 12.5 45.3 0l128-128c9.2-9.2 11.9-22.9 6.9-34.9s-16.6-19.8-29.6-19.8L32 192c-12.9 0-24.6 7.8-29.6 19.8s-2.2 25.7 6.9 34.9l128 128z'/ ></svg>
    </div>
    <ul class='dropdown-menu'>
    <a href='perfil.php'><li>Editar perfil</li></a>
    <a href='#'> <li>Ranking</li></a>
    <a href='../authenticated/profissao.php'> <li>Profissão</li></a>
    <a href='#'><li>Contratos</li></a>
    <a href='#'> <li>Chat</li></a>
    <a href='#'> <li>Curriculo</li></a>
    <a href='./logout.php'><li>Sair</li></a>
    </ul>
  </div>
  
  
      </ul>
  </header>";
  
  }

?>
<h1>Profissionais</h1>
<div id="modal" style="display: none;">
    <div class="modal-content">
        
        <div class='container-button'><button  onclick="closeModal()" class='close-modal'>X</button></div>
        <h3>Profissionais inscritos na vaga</h3>
        <ul id="usuarios-vinculados"></ul>
    </div>
</div>

</body>
</html>