<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

// Exibe todos os erros PHP (see changelog)
error_reporting(E_ALL);

// Exibe todos os erros PHP
error_reporting(-1);

// Mesmo que error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
//BUSCANDO AS CLASSES
include_once "Conexao.class.php";
include_once "Funcoes.class.php";

//CRIANDO A CLASSE
class Receita {

	//ATRIBUTOS
	private $con;
	private $objfc;

	private $idRec;
	private $tituloRec;
	private $descRec;
	private $ingredientesReceita;
	private $dataReceita;
  	private $pubRec;

	//CONSTRUTOR
	public function __construct(){
		$this->con = new Conexao();
		$this->objfc = new Funcoes();
	}

	//METODOS get e sets
	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
	public function __get($atributo){
		return $this->$atributo;
	}
	//METODOS

	public function selecionaUmReceita($dado){
		try{
			$this->idRec = $dado;
			$cst = $this->con->conectar()->prepare("SELECT  * FROM `receita` WHERE `idRec` = :idRec;");
			$cst->bindParam(":idRec", $this->idReceita, PDO::PARAM_INT);
			if($cst->execute()){
				return $cst->fetch();
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}


	public function selecionaTudo(){
		try{
			$cst = $this->con->conectar()->prepare("SELECT * FROM `receita`");
			$cst->execute();
			return $cst->fetchAll();
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}


	public function insereRec($dados){
		try{
			$this->tituloRec = $this->objfc->tratarCaracter($dados['tituloRec'], 1);
			$this->descRec = $this->objfc->tratarCaracter($dados['descRec'], 1);
			//$this->ingRec = $this->objfc->tratarCaracter($dados['ingRec'], 1);
      		//$this->dataReceita = date('dd/mm/Y');
      		$this->pubRec = $this->$dados['pubRec'];

			$cst = $this->con->conectar()->prepare("INSERT INTO `receita` (`tituloRec`, `descRec`, `pubRec`, `datacriacao`) 
													VALUES (:tituloRec, :descRec, :pubRec, :datacriacao);");

			$cst->bindParam(":tituloRec", $this->tituloRec, PDO::PARAM_STR);
			$cst->bindParam(":pubRec", $this->pubRec, PDO::PARAM_STR);
			$cst->bindParam(":descRec", $this->descRec, PDO::PARAM_STR);
			//$cst->bindParam(":ingredientesReceita", $this->ingredientesReceita, PDO::PARAM_STR);
			$cst->bindParam(":dataReceita", $this->dataReceita, PDO::PARAM_STR);


			if($cst->execute()){
				return 1;
			}else{
				return 'Error ao cadastrar';
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}


	public function updade($dados){
		try{
      $this->idReceita = $this->objfc->tratarCaracter($dados['idReceita'], 1);
      $this->tituloReceita = $this->objfc->tratarCaracter($dados['tituloReceita'], 1);
			$this->preparoReceita = $this->objfc->tratarCaracter($dados['preparoReceita'], 1);
			$this->ingredientesReceita = $this->objfc->tratarCaracter($dados['ingredientesReceita'], 1);
      $this->dataReceita = $this->$dados['dataReceita'];
      $this->publicadaReceita = $this->$dados['publicadaReceita'];

      $cst = $this->con->conectar()->prepare("UPDATE `receita` SET `titulo`=:tituloReceita, `preparo`=:preparoReceita, `publicada`=:publicadaReceita, `ingredientesReceita`=:ingredientes, `datacriacao`=:dataReceita WHERE `idreceita` = :idReceita;");

      $cst->bindParam(":tituloReceita", $this->tituloReceita, PDO::PARAM_STR);
			$cst->bindParam(":publicadaReceita", $this->publicadaReceita, PDO::PARAM_STR);
			$cst->bindParam(":preparoReceita", $this->preparoReceita, PDO::PARAM_STR);
			$cst->bindParam(":ingredientesReceita", $this->ingredientesReceita, PDO::PARAM_STR);
			$cst->bindParam(":dataReceita", $this->dataReceita, PDO::PARAM_STR);
      $cst->bindParam(":idReceita", $this->idReceita, PDO::PARAM_STR);
			if($cst->execute()){
				return '1';
			}else{
				return 'Error ao alterar';
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}

	public function delete($dado){
		try{
			$this->idReceita = $dado;
			$cst = $this->con->conectar()->prepare("DELETE FROM `receita` WHERE `idreceita` = :idReceita;");
			$cst->bindParam(":idReceita", $this->idReceita, PDO::PARAM_INT);
			if($cst->execute()){
				return 1;
			}else{
				return 'Erro ao deletar';
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}

	public function logaUsuario($dados){
		$this->email = $dados['email'];
		$this->senha = $dados['senha'];
		try{
			$cst = $this->con->conectar()->prepare("SELECT `pk`, `nivel`, `email`, `senha` FROM `usuarios` WHERE `email` = :email AND `senha` = :senha;");
			$cst->bindParam(':email', $this->email, PDO::PARAM_STR);
			$cst->bindParam(':senha', $this->senha, PDO::PARAM_STR);
			$cst->execute();
			if($cst->rowCount() == 0){
				header('location: index.php?login=error');
			}else{
				session_start();
				$rst = $cst->fetch();
				$_SESSION['logado'] = "sim";
				$_SESSION['email'] = $rst['email'];
				$_SESSION['pk'] = $rst['pk'];
				$_SESSION['nivel'] = $rst['nivel'];
				header("location: admin");
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMassage();
		}
	}

	public function usuarioLogado($dado){
		$cst = $this->con->conectar()->prepare("SELECT `pk`, `nivel`, `nome`, `email` FROM `usuarios` WHERE `pk` = :idUsuario;");
		$cst->bindParam(':idUsuario', $dado, PDO::PARAM_INT);
		$cst->execute();
		$rst = $cst->fetch();
		$_SESSION['nome'] = $rst['nome'];
		$_SESSION['email'] = $rst['email'];
		$_SESSION['pk'] = $rst['pk'];
		$_SESSION['nivel'] = $rst['nivel'];
	}

	public function sairusuarios(){
		session_destroy();
		header ('location: phpooppdo');
	}

}

?>
