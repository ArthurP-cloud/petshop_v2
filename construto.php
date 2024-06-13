<?php 
include_once "conexao.php";

switch ($_GET['mode']) {

  case 'cadastrar':
    echo "<h3>Cadastrar Funcionario</h3>";
    echo "<label>Email</label>";
    echo "<input type='email' name='email' id='email'>";
    echo "<label>Senha</label>";
    echo "<input type='password' name='senha' id='senha'>";
    echo "<br>";
    echo "<div class='buttons'>";
    echo "<button id='btn-cadastrar-funcionario'>Cadastrar</button>";
    echo "</div>";
    break;
    
  case 'login':
    //session_start();
    echo "<label class='label'>login</label>";
    echo "<br>";
    echo "<input type='email' name='email' id='email' placeholder='email'>";
    echo "<br>";
    echo "<input type='password' name='senha' id='senha' placeholder='senha'>";
    echo "<br>";
    echo "<div class='buttons'>";
    echo "<button id='btn-cadastrar'>Cadastrar</button> ";
    echo " <button tipy='submit' id='btn-logar'>Logar</button>";
    echo "</div>";
    break;

  case 'logado':
    $email = $_GET['email'];
    $senha = $_GET['senha'];
    

    $sql = "SELECT * FROM funcionarios where email = '$email' and senha = '$senha'";

    $result = $conn->prepare($sql);
    $result->execute();
    $row = $result->rowCount();
    
    if(($result) && ($row > 0)){
      echo "<label style='color:green'>Logado com sucesso</label>";
      echo "<br>";
      echo "<div class='buttons'>";
      echo "<button id='btn-ok-logar'>OK</button>";
      echo "</div>";
      session_start();
      $_SESSION['email'] = $email;
    }else{
      echo "<label style='color:red'>Não foi possivel fazer o login</label>";
      echo "<br>";
      echo "<div class='buttons'>";
      echo "<button id='btn-ok-deslogar'>OK</button>";
      echo "</div>";
      session_start();
      session_reset();
      session_destroy();
      session_start();
    }
    break;
  case "cliente-cadastrar":
    session_start();
    if(!empty($_SESSION['email'])){
    echo "<div class='buttons'>";
    echo "<button id='btn-lista'>Lista de Clientes</button>  ";
    echo "<button style='background-color: red' id='btn-deslogar'>X</button>";
    echo "</div>";
    echo "<h3>Cadastrar Novo Cliente</h3>";
    echo "<label>Nome</label>";
    echo "<input type='text' name='nomec' id='nomec' min='3' max='256'>";
    echo "<label>CPF</label>";
    echo "<input type='text' name='cpf' id='cpf' min='3'>";
    echo "<label>Telefone</label>";
    echo "<input type='text' name='telefone' id='telefone' min='3'>";
    echo "<label>Endereço</label>";
    echo "<input type='text' name='endereço' id='endereço' min='3'>";
    echo "<label>Nome do pet</label>";
    echo "<input type='text' name='nomepet' id='nomepet' min='3'>";
    echo "<label>Raça do pet</label>";
    echo "<input type='text' name='raçapet' id='raçapet' min='3'>";
    echo "<label>Cor do pet</label>";
    echo "<input type='text' name='corpet' id='corpet' min='3'>";
    echo "<br>";
    echo "<div class='buttons'>";
    echo "<input type='submit' id='btn-logado-cadastrar'value='Cadastrar'>";
    echo "</div>";   
    }else{
      session_start();
      if(empty($_SESSION)){
      header('Location : construto.php?mode=login');
      }
    };
    break;

  case "deslogar":
    session_start();
    session_reset();
    session_destroy();
    echo "<label style='color:red'>Deslogado</label>";
    echo "<br>";
    echo "<div class='buttons'>";
    echo "<button id='btn-ok-deslogado'>OK</button>";
    echo "</div>";
    break;

  case "listar":
    include_once "conexao.php";
    session_start();

    if(!empty($_SESSION)){
      $sql = "SELECT * FROM cliente";
      $result = $conn->prepare($sql);
      $result->execute();
      $verifyrows = $result->rowCount();

      echo "<h3>Registros encontrado: ".$verifyrows."</h3>";
      echo "<br><br>";

      while($row_clientes = $result->fetch(PDO::FETCH_ASSOC)){
          //extract($row_clientes);
        echo "<article>";
        echo "<div class='divcliente'>";
        echo "ID: ".$row_clientes['id'];
        echo "<p>Nome: ".$row_clientes['nome']."</p>";
        echo "<p>CPF: ".$row_clientes['cpf']."</p>";
        echo "<p>Telefone: ".$row_clientes['telefone']."</p>";
        echo "<p>Endereço: ".$row_clientes['endereco']."</p>";
        echo "<p>Nome do pet: ".$row_clientes['nome_pet']."</p>";
        echo "<p>Raça: ".$row_clientes['raca_pet']."</p>";
        echo "<p>Cor: ".$row_clientes['cor_pet']."</p>";
        echo "<input type='submit' value='Editar' name='".$row_clientes['id']."' id='editar_cliente'>";
        echo "</div>";
        echo "</article>";
        echo "<br>";
        //echo "<form method='get'>";
        echo "<input type='submit' value='Remover' name='".$row_clientes['id']."' id='remover_cliente'>";
          //echo "</form>";
        echo "<hr>";
      }


      }else{
        echo "<label style='color: red'>Favor iniciar uma sessão!</label>";
        header("Location: construto.php?mode=login");
      }
    break;

  case "cliente-editar":
    session_start();
    include_once "conexao.php";

    if(!empty($_SESSION['email'])){
      $id = $_GET['clienteid'];
      
      $sql = "SELECT * FROM cliente WHERE id = '$id'";
      $result = $conn->prepare($sql);
      $result->execute();
      $verifyrows = $result->rowCount();

      $row_cliente = $result->fetch(PDO::FETCH_ASSOC);
      
      echo "<div class='buttons'>";
      echo "<button id='btn-lista'>Lista de Clientes</button>  ";
      echo "<button style='background-color: red' id='btn-deslogar'>X</button>";
      echo "</div>";
      echo "<h3>Cadastrar Novo Cliente</h3>";
      echo "<input type='number' name='id' id='id' value='".$row_cliente['id']."' readonly>";
      echo "<label>Nome</label>";
      echo "<input type='text' name='nomec' id='nomec' value='".$row_cliente['nome']."'>";
      echo "<label>CPF</label>";
      echo "<input type='text' name='cpf' id='cpf' value='".$row_cliente['cpf']."' readonly>";
      echo "<label>Telefone</label>";
      echo "<input type='text' name='telefone' id='telefone' value='".$row_cliente['telefone']."'>";
      echo "<label>Endereço</label>";
      echo "<input type='text' name='endereco' id='endereço' value='".$row_cliente['endereco']."'>";
      echo "<label>Nome do pet</label>";
      echo "<input type='text' name='nomepet' id='nomepet' value='".$row_cliente['nome_pet']."'>";
      echo "<label>Raça do pet</label>";
      echo "<input type='text' name='racapet' id='raçapet' value='".$row_cliente['raca_pet']."'>";
      echo "<label>Cor do pet</label>";
      echo "<input type='text' name='corpet' id='corpet'value='".$row_cliente['cor_pet']."'>";
      echo "<br>";
      echo "<div class='buttons'>";
      echo "<input type='submit' id='logado_editar'value='Editar'>";
      echo "</div>";   
    }else{
      session_start();
      if(empty($_SESSION)){
      header('Location : construto.php?mode=login');
      }
    };
    break;
  case "cliente-editado":
    session_start();
    include_once "conexao.php";

    if(!empty($_SESSION)){
        $id = $_GET['id'];
        $nome = $_GET['nomec'];
        $cpf = $_GET['cpf'];
        $telefone = $_GET['telefone'];
        $endereço = $_GET['endereco'];
        $nomepet = $_GET['nomepet'];
        $raçapet = $_GET['racapet'];
        $corpet = $_GET['corpet'];

        $sql = "UPDATE cliente SET nome='$nome', cpf='$cpf', telefone='$telefone', endereco='$endereço', nome_pet='$nomepet', raca_pet='$raçapet', cor_pet='$corpet' WHERE id = '$id'";

        $result = $conn->prepare($sql);
        $result->execute();
        // $verifyrows = $result->rowCount();

        // if($verifyrows>0){
          echo "<label style='color: green'>Cliente editado com sucesso!</label>";
          echo "<button id='btn-ok-editado'>Ok</button>";

        // }else{
        //   echo "<label style='color: red'>Não foi possível editar o cliente!</label>";
        //   echo "<button id='btn-ok-naoeditado'>Ok</button>";
        // }

      }else{
        echo "Favor realizar o login!";
      }
      break;
    case "cliente-cadastrado":
      session_start();
      include_once 'conexao.php';

      if(!empty($_SESSION)){
        $nome = $_GET["nomec"];
        $cpf = $_GET['cpf'];
        $telefone = $_GET['telefone'];
        $endereço = $_GET['endereco'];
        $nomepet = $_GET['nomepet'];
        $raçapet = $_GET['racapet'];
        $corpet = $_GET['corpet'];

        $sql = "SELECT cpf FROM cliente WHERE cpf = '$cpf'";

        $result = $conn->prepare($sql);
        $result->execute();
        $verifyrows = $result->rowCount();

        if($verifyrows < 1){
          $sql = "INSERT INTO cliente (nome,cpf,telefone,endereco,nome_pet,raca_pet,cor_pet) VALUES ('$nome','$cpf','$telefone','$endereço','$nomepet','$raçapet','$corpet')";

          $result = $conn->prepare($sql);
          $result->execute();
          $verify = 1;
        }else{
          $verify = 0;
        }
        if($verify == 1){
          echo "Cadastro realizado com sucesso!";
          echo "<div class='buttons'>";
          echo "<button id='btn-ok-logar'>OK</button>";
          echo "</div>";
        }else{
          echo "CPF já cadastrado!";
          echo "<div class='buttons'>";
          echo "<button id='btn-ok-logar'>OK</button>";
          echo "</div>";
        }
      }else{
        echo "Favor fazer o login!";
      }
      break;
    case "cliente-removido":
      session_start();
      include_once "conexao.php";

      if(!empty($_SESSION)){
        $id = $_GET['id'];

        $sql = "DELETE FROM cliente WHERE id = '$id'";
        $result = $conn->prepare($sql);
        $result->execute();
        $verifyrows = $result->rowCount();

        if($verifyrows > 0){
          echo "Cliente removido com sucesso!";
          echo "<button id='btn-ok-editado'>Ok</button>";
        }else{
          echo "Não foi possível remover o cliente!";          
        }
      }else{
        echo "Favor realizar o login!";
      }
      break;
    case "cadastrar-funcionario":
      include_once "conexao.php";

      $email = $_GET['email'];
      $senha = $_GET['senha'];

      $sql = "SELECT email FROM funcionarios WHERE email = '$email'";

      $result = $conn->prepare($sql);
      $result->execute();
      $verifyrows = $result->rowCount();

      if($verifyrows < 1){
        $sql = "INSERT INTO funcionarios (email,senha) VALUES ('$email','$senha')";
        
        $result = $conn->prepare($sql);
        $result->execute();

        echo "<label style='color: green'>Cadastrado com sucesso</label>";
      }else{
        echo "<label style='color: red'>Email já cadastrado!</label>";
      }
      break;
  default:
    session_start();
    session_reset();
    session_destroy();
    echo "<button id='btn-login' name='login'>Entrar</button>";
    break;
}
?>