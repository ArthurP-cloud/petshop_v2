<?php 
$hostname = "localhost";
$user = "root";
$password = "";
$database = "tao_petshop";
$port = 3306;

try {
  $conn = new PDO("mysql:host=$hostname;dbname=".$database,$user,$password);
} catch (PDOException $erro) {
  die("Erro: Conexão com o banco de dados falhou.".$erro->getMessage());
}
?>