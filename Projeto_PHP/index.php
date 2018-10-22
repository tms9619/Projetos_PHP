<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Login</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="css/cssindex.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
</head>
<body>
<form class="form-horizontal" method="post">
	<div class="form-group">
          <label for="inputEmail1" class="col-lg-2 control-label">Usúario:</label>
		<input type="login" name="user" value="" title="Username" class="form-control" id="inputEmail1" placeholder="Login">
	</div>
	<div class="form-group">
          <label for="inputPassword1" class="col-lg-2_control-label">Senha:</label>
		<input type="password" name="pass" title="Password" value="" class="form-control" id="inputPassword1" placeholder="Senha">
	</div>
	<div class="form-group">
		<div class="checkbox">
        <input type="checkbox" name="remember" value="1" class="checkbox-1">
          <label for="checkbox-1">Me manter conectado</label><br/>
		</div>
	</div>
	<div class="form-group">
		<button type="submit" class="btn_btn-primary" name="acao" value="logar">Entrar</button>
	</div>
</form>
</body>
</html>

<?php
$action = isset($_POST['acao']) ? trim($_POST['acao']) : '';
    if(isset($action) && $action != ""){ 
         
        switch($action){
            case 'logar':
                //requerindo a classe de autenticação passando os valores dos inputs como parâmetros
                require_once('class/Autentica.class.php');
                //instancio a classse para poder usar o método nela contida
                $Autentica = new Autentica();
                //setando 
                $Autentica->user = $_POST['user'];
                $Autentica->pass = $_POST['pass'];
                //chamando o método                     
                if($Autentica->Validar_Usuario()){
                   echo  "<script type='text/javascript'>
                            location.href='logado.php'
                        </script>";
                  }else{
                   echo  "<script type='text/javascript'>
                            alert('Login ou Senha invalidos...');
                            location.href='index.php'
                        </script>";
                  }
            break;
        }   
    }
?>