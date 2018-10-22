<?php
 
require_once 'init.php';
 
// pega os dados do formuário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$equipamento = isset($_POST['equipamento']) ? $_POST['equipamento'] : null;
$defeito = isset($_POST['defeito']) ? $_POST['defeito'] : null;
$setor = isset($_POST['setor']) ? $_POST['setor'] : null;
$dat = isset($_POST['dat']) ? $_POST['dat'] : null;
$hora = isset($_POST['hora']) ? $_POST['hora'] : null;
$assunto = isset($_POST['obs']) ? $_POST['obs'] : null;
 
 
// validação (bem simples, só pra evitar dados vazios)
if (empty($nome) || empty($equipamento) || empty($defeito) || empty($setor) || empty($dat) || empty($hora))
{
    echo "<script type='text/javascript'>
               alert('Porfavor preencha todos os campos')
               </script>";
    echo "<script type='text/javascript'>
               alert('Redirecionando para página de cadastros')
               location.href='/logado.php'</script>";
    //echo "Volte e preencha todos os campos";
    exit;
}
 
// a data vem no formato dd/mm/YYYY
// então eu precissei converter para YYYY-mm-dd
$isoDate = dateConvert($dat);
 
// insere no banco
$PDO = db_connect();
$sql = "INSERT INTO chamadomolog(nome, equipamento, defeito, setor, dat, hora, obs) VALUES(:nome, :equipamento, :defeito, :setor, :dat, :hora, :obs)";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':equipamento', $equipamento);
$stmt->bindParam(':defeito', $defeito);
$stmt->bindParam(':setor', $setor);
$stmt->bindParam(':dat', $dat);
$stmt->bindParam(':hora', $hora);
$stmt->bindParam(':obs', $assunto);
 
 
if ($stmt->execute())
{
    echo "<script type='text/javascript'>
               alert('Enviado com sucesso!') 
               location.href='/logado.php'</script>";
    //header('Location: form-add.php');
}
else
{   //Tratar o error caso aja alguma anomalia com o BD
    echo "<script type='text/javascript'>
                alert('Falha ao se conectar com o Banco, porfavor relatar ao administrador do sistema!')
          </script>";
    print_r($stmt->errorInfo());
}