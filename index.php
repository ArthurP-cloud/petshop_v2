<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="style.css">
  <title>Sistema PetShop</title>
</head>
<body>
  <header></header>
  <div class="main">
    <form id="form" name="task" method="get">

    </form>
  </div>
</body>
<script>
  $(document).ready(function(){
    build();
    function build(mode){
      $("#form").load("construto.php?mode="+mode);
    };
    function logado(mode,email,senha){
      $("#form").load("construto.php?mode="+mode+"&email="+email+"&senha="+senha);
    };
    function editar(mode,id){
      $("#form").load("construto.php?mode="+mode+"&clienteid="+id);
    }
    function removido(mode,id){
      $("#form").load("construto.php?mode="+mode+"&id="+id);
    }
    function editado(mode,id,nome,cpf,telefone,endereço,nomepet,raçapet,corpet){
      $("#form").load("construto.php?mode="+mode+"&id="+id+"&nomec="+nome+"&cpf="+cpf+"&telefone="+telefone+"&endereco="+endereço+"&nomepet="+nomepet+"&racapet="+raçapet+"&corpet="+corpet);
    }
    function cadastrado(mode,nome,cpf,telefone,endereço,nomepet,raçapet,corpet){
      $("#form").load("construto.php?mode="+mode+"&nomec="+nome+"&cpf="+cpf+"&telefone="+telefone+"&endereco="+endereço+"&nomepet="+nomepet+"&racapet="+raçapet+"&corpet="+corpet);
    }
    // $("#btn-login").click(function(e){
    //   e.preventDefault();
    //   console.log('clicado');
    // });
    $("#form").on("click", "#btn-login",function(e){
      e.preventDefault();
      build("login");
    })
    $("#form").on("click", "#btn-cadastrar",function(e){
      e.preventDefault();
      build('cadastrar');
      $("header").append("<button id='btn-para-tela-login'>Tela de Login</button>");
    })
    $("#form").on("click", "#btn-logar", function(e){
      e.preventDefault();
      var mode = "logado";
      var email = $("#email").val();
      var senha = $("#senha").val();
      logado(mode,email,senha);

      // $.ajax({
      //   method: "GET",
      //   url: "construto.php?mode=logado",
      //   data: {email: email, senha: senha},
      // }).done(function(){
      //   window.location = 'construto.php?mode=logado&email='+email+"&senha="+senha;
      // });      
    })
    $("#form").on("click", "#btn-ok-logar", function(e){
      e.preventDefault();
      build('cliente-cadastrar');

    })
    $("#form").on("click", "#btn-ok-deslogar", function(e){
      e.preventDefault();
      build('login');
    })
    $("#form").on("click", "#btn-deslogar", function(e){
      e.preventDefault();
      build('deslogar');
    })
    // $("#form").on("click", "#btn-ok-deslogado", function(e){
    //   e.preventDefault();
    //   build('login');
    // })
    $("#form").on("click", "#btn-logado-cadastrar", function(e){
      e.preventDefault();
      var mode = "cliente-cadastrado";
      var nome = $("#nomec").val();
      
      var cpf = $("#cpf").val();
      var telefone = $("#telefone").val();
      var endereço = $("#endereço").val();
      var nomepet = $("#nomepet").val();
      var raçapet = $("#raçapet").val();
      var corpet = $("#corpet").val();
      if(nome === "" || cpf === "" || telefone === "" || endereço === "" || nomepet === "" || raçapet === "" || corpet === ""){
        alert("Todos os campos são obrigatorios!");
      }else{        
        cadastrado(mode,encodeURI(nome),cpf,telefone,encodeURI(endereço),encodeURI(nomepet),encodeURI(raçapet),encodeURI(corpet));
      }
      
    })
    $("#form").on("click", "#btn-lista", function(e){
      e.preventDefault();
      build('listar')
      $("header").append("<button id='cadastrarcliente'>Cadastrar</button>");
    })
    $("header").on("click", "#cadastrarcliente", function(e){
      e.preventDefault();
      $(this).remove();
      build('cliente-cadastrar');
    })
    $("#form").on("click", "#editar_cliente", function(e){
      e.preventDefault();
      var id = $(this).attr("name");
      $("#cadastrarcliente").remove();
      editar('cliente-editar', id);

           
    })
    $("#form").on("click", "#remover_cliente", function(e){
      e.preventDefault();
      var id = $(this).attr("name");
      var confirmado = confirm("Deseja deletar o cliente de id: "+id);
      var mode = "cliente-removido";

      if(confirmado){
        removido(mode,id);
      }else{
        alert("Negado");
      }
    })
    $("#form").on("click", "#logado_editar", function(e){
      e.preventDefault();
      var mode = "cliente-editado";
      var id = $("#id").val();
      var nome = $("#nomec").val();
      var cpf = $("#cpf").val();
      var telefone = $("#telefone").val();
      var endereço = $("#endereço").val();
      var nomepet = $("#nomepet").val();
      var raçapet = $("#raçapet").val();
      var corpet = $("#corpet").val();
      editado(mode,id,encodeURI(nome),cpf,telefone,encodeURI(endereço),encodeURI(nomepet),encodeURI(raçapet),encodeURI(corpet));
      //console.log(mode,id,encodeURI(nome),cpf,telefone,endereço,nomepet,raçapet,corpet);

    })
    $("#form").on("click", "#btn-ok-editado", function(e){
      e.preventDefault();
      build('listar');
    })
    $("#form").on("click", "#btn-ok-naoeditado", function(e){
      e.preventDefault();
      build('listar');
    })
    $("header").on("click", "#btn-para-tela-login", function(e){
      e.preventDefault();
      $(this).remove();
      build('login');
    })
    $("#form").on("click", "#btn-cadastrar-funcionario", function(e){
      e.preventDefault();
      var mode = "cadastrar-funcionario";
      var email = $("#email").val();
      var senha = $("#senha").val();
      
      logado(mode,email,senha);

    })
 })
</script>
</html>