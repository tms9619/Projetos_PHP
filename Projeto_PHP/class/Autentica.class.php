<?php	
require_once('Conexao.class.php');
	
class Autentica extends Conexao{
	private $data = array();

	public function __construct(){
		$this->erro = '';
	}
	
	public function __set($name, $value){
		$this->data[$name] = $value;
	}

	public function __get($name){
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}

		$trace = debug_backtrace();
		trigger_error(
			'Undefined property via __get(): ' . $name .
			' in ' . $trace[0]['file'] .
			' on line ' . $trace[0]['line'],
			E_USER_NOTICE);
		return null;
	}
		
	public function Validar_Usuario(){
		//instancio minha classe conexão que foi herdada
		$pdo = new Conexao(); 
		//chamo o método select da classe conexão que retornará um conjunto de dados
		$resultado = $pdo->select("SELECT * FROM users WHERE user = '".$this->user."' AND pass = '".$this->pass."'");
		//desconecto
		$pdo->desconectar();
		//resgato os valores obtidos pelo método através do foreach
		//verifico se houve registros dentro da var se sim entra no if
		if(count($resultado)){
			foreach ($resultado as $res) {
				//estarto a sessão para poder usar os dados do usuario na aplicação através de
				//session, na qual poderei usar para controle de verificar se o user está logado ou não, mostrar o nome do user na tela e etc.
				session_start();
				ob_start();
				//seto as session com os valores obtido da tabela
				$_SESSION['id_users'] = $res['id_users'];
				$_SESSION['user'] = $res['user'];
				$_SESSION['setor'] = $res['setor'];
				$_SESSION['pass'] = $res['pass'];
				$_SESSION['logado'] = 'S';
		}
			//se tudo ocorrer bem retornara true, ou seja verdade
			return true;
		}else{
			//se algo deu errado retornara false
			return false;
		}
	}
}
?>