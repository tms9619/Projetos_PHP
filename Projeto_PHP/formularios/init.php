<?php
  
// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', '127.0.0.1');//ip da base de dados
define('DB_USER', 'root');//seu usuario
define('DB_PASS', '');//sua senha
define('DB_NAME', 'syscandido');//nome do banco
  
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
  
// inclui o arquivo de funções
require_once 'functions.php';

?>