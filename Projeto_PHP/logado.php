<?php
    //starta a sessão
    session_start();
    ob_start();
    //resgata os valores das session em variaveis
    $id_users = isset($_SESSION['id_users']) ? $_SESSION['id_users']: "";   
    $user_users = isset($_SESSION['user']) ? $_SESSION['user']: "";
    $setor_users = isset($_SESSION['setor']) ? $_SESSION['setor']: "";  
    $pass_users = isset($_SESSION['pass']) ? $_SESSION['pass']: ""; 
    $logado = isset($_SESSION['logado']) ? $_SESSION['logado']: "N";

    //varifica se a var logado contém o valos (S) OU (N), se conter N quer dizer que a pessoa não fez o login corretamente
    //que no caso satisfará a condição no if e a pessoa sera redirecionada para a tela de login novamente
    if ($logado == "N" && $id_users == ""){     
        echo  "<script type='text/javascript'>
                    location.href='index.php'
                </script>";   
        exit();
    }
    
?>

<?php
require 'formularios/init.php';

// abre a conexão
$PDO = db_connect();
 
// SQL para contar o total de registros
$sql_count = "SELECT COUNT(*) AS total FROM chamadomolog ORDER BY nome ASC";
 
// SQL para selecionar os registros
$sql = "SELECT id, nome, equipamento, defeito, setor, dat, hora, obs FROM chamadomolog ORDER BY nome ASC";
 
// conta o total de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
 
// seleciona os registros
$stmt = $PDO->prepare($sql);
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>chamados</title>

  <!-- Bootstrap e CSS -->

  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
  <link rel="stylesheet" type="text/css" href="/css/csschamado.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <!--<script>
        function funcaosair()
        {
            alert("Saindo do sistema!")
        }
    </script>
    -->

</head>

<body class="color">
  <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Unitrans</a>
    <div class="dropdown show">
      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span data-feather="user"></span>
      </a>

      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="logout.php"><span data-feather="log-out"></span>Logoff</a>
      </div>
    </div>
    <!--<ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="logout.php">Sair</a>
        </li>
      </ul>-->
  </nav>

  <div class="container-fluid espaco">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar color">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item h2 selecao">
              <span data-feather="home"></span>Módulos
            </li>
            <li class="nav-item h5">
              <a class="nav-link" href="logado.php">
                <span data-feather="users"></span>
                Abertura de chamado
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!--Enviar chamado-->

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2 selecao">Chamado Técnico</h1>
        </div>
        <form action="formularios/add.php" method="post">
          <div class="form-group">
            <label for="nome"><span data-feather="file-text"></span>NOME:</label>
            <input type="text" name="nome" class="form-control" id="nome" placeholder="Informe seu nome">
          </div>
          <div class="form-group">
            <label for="equipamento"><span data-feather="file-text"></span>EQUIPAMENTO:</label>
            <input type="text" name="equipamento" class="form-control" id="equipamento" placeholder="Informe o nome do equipamento">
          </div>
          <div class="form-group">
            <label for="defeito"><span data-feather="file-text"></span>DEFEITO:</label>
            <input type="text" name="defeito" class="form-control" id="defeito" placeholder="Informe o defeito apresentado">
          </div>
          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="setor"><span data-feather="list"></span>SETOR:</label>
              <select class="custom-select d-block w-100" id="setor" name="setor" required>
                <option input>ALMOXARIFADO</option>
                <option input>ARQUIVO</option>
                <option input>CONTABILIDADE</option>
                <option input>DEPARTAMENTO PESSOAL</option>
                <option input>TRÁFEGO</option>
                <option input>FINANCEIRO</option>
                <option input>RECURSOS HUMANOS</option>
                <option input>BILHETAGEM</option>
                <option input>RODOVIÁRIO NORDESTINO</option>
                <option input>TBS</option>
                <option input>COMPRAS</option>
                <option input>COMBUSTIVEL/PNEUS</option>
                <option input>MANUNTENÇÃO</option>
                <option input>ESTATISTICA</option>
                <option input>ELI</option>
                <option selected disabled hidden>Informe seu setor</option>
              </select>
            </div>
            <div class="form-group">
              <label for="data"><span data-feather="calendar"></span>DATA:</label>
              <input type="date" name="dat" class="form-control" id="data">
            </div>
            <div class="form-group horaspace">
              <label for="hora"><span data-feather="clock"></span>HORA:</label>
              <input type="time" name="hora" class="form-control" id="hora">
            </div>
          </div>
          <div class="form-group">
            <label for="assunto"><span data-feather="file-text"></span>OBSERVAÇÃO:</label>
            <textarea name="obs" class="form-control" id="obs"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" value="Enviar"><span data-feather="send"></span> Enviar</button>
        </form>

        <!--Listando chamados-->

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2 selecao">Lista de chamados</h1>
        </div>

        <?php if ($total > 0): ?>

        <div class="table-responsive">
          <table class="table table-hover table-bordered table-striped">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Equipamento</th>
                <th>Defeito</th>
                <th>Setor</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Observações</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
              <tr>
                <td>
                  <?php echo $user['nome'] ?>
                </td>
                <td>
                  <?php echo $user['equipamento'] ?>
                </td>
                <td>
                  <?php echo $user['defeito'] ?>
                </td>
                <td>
                  <?php echo $user['setor'] ?>
                </td>
                <td>
                  <?php echo dateConvert($user['dat']) ?>
                </td>
                <td>
                  <?php echo $user['hora'] ?>
                </td>
                <td>
                  <?php echo $user['obs'] ?>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

        <div class="form-group">
          <h3>Quantidade total de chamados:
            <?php echo $total ?>
          </h3>
        </div>

        <?php else: ?>

        <p>Nenhum usuário registrado</p>

        <?php endif; ?>

        <!--<a href="formularios/form.php"><input type="button" value="Crud"/></a>-->

        <!---<a href="formularios/form.php"><input type="button" value="chamados"/></a><br/>-->

        <script src="/js/icons.js"></script>
        <script>
          feather.replace()
        </script>

</body>
</html>