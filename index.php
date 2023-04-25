
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
  // Conexão com o banco de dados
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "form_cadastro";

  $conn = mysqli_connect($host, $username, $password, $dbname);

  if (!$conn) {
      die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
  }


    // Recebendo dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    // Verificando se o e-mail já está cadastrado
    $sql = "SELECT * FROM formulario WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $mensagemErro = '<p class="md">E-mail já existe.</p>';
    $erroCadastro =  '<p class="md">Erro ao cadastrar:</p>';
    $cadastroSucesso = '<p class="md">Cadastrado com sucesso.</p>';
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='errocadastro' >$mensagemErro </div>";
    } else {
        // Inserindo os dados no banco de dados
        $sql = "INSERT INTO formulario (nome, email) VALUES ('$nome', '$email')";
        if (mysqli_query($conn, $sql)) {
            echo "<div class='messagegreen'> $cadastroSucesso </div>";
        } else {
            echo "<div class='errocadastro'> $erroCadastro </div>" . mysqli_error($conn);
        }
    }

    // Fechando a conexão com o banco de dados
    mysqli_close($conn); 
  }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Cadastro</title>
  <style>
    /* estilos para as mensagens após o envio do cadastro */
    .errocadastro {
      background-color: #F5F5F5;
      color: #ff0000;
      text-align:center;
     
      position: absolute;
      width: 100%;
  height: 100%;
display: flex;
justify-content: center;
  align-items: center;
    
    }
    .messagegreen {
      background-color: #F5F5F5;
      color: #008000;
      text-align:center;
     
      position: absolute;
      width: 100%;
  height: 100%;
display: flex;
justify-content: center;
  align-items: center;
    }
    .md {
      width: 200px;
  height: 100px;
z-index: 3;
margin-bottom: 190px;
font-family: 'Source Sans Pro', sans-serif;
  font-style: normal;
font-weight: 500;
font-size: 16px;
    }

    @media (max-width: 450px) {
     .md {
      margin-bottom: 142px;
     }
}
  </style>

</head>
<body>
  <!-- Estrutura do Cadastro -->
<section class="container">
    <form action="" method="post" class="formcadastro">
  
      <div class="cadastrocontainer">
        <h1>Informações básicas</h1>

        <label for="">Nome</label>
        <input type="text" name="nome" id="nome" class="nomeinput" placeholder="Priscilla Barros">

        <label for="">E-mail</label>
        <input type="email" name="email" id="email" class="emailinput" placeholder="priscilla.barros@netwall.com.br">


        <button type="submit" name="acao" class="btn">Salvar </button>
      </div>

    </form>
  </section>
</body>
</html>