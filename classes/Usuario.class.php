<?php
//BUSCANDO AS CLASSES
include_once "Conexao.class.php";
include_once "Funcoes.class.php";

//CRIANDO A CLASSE
class Usuario {

	//ATRIBUTOS
	private $con;
	private $objfc;

	private $idUsuario;
	private $nome;
	private $email;
	private $senha;
	private $dataCadastro;
	private $nivel;

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

	public function selecionaUm($dado){
		try{
			$this->idUsuario = $dado;
			$cst = $this->con->conectar()->prepare("SELECT `pk`, `nome`, `email`, `data_cadastro` FROM `usuarios` WHERE `pk` = :idUsuario;");
			$cst->bindParam(":idUsuario", $this->idUsuario, PDO::PARAM_INT);
			if($cst->execute()){
				return $cst->fetch();
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}

	public function selecionaTudo(){
		try{
			$cst = $this->con->conectar()->prepare("SELECT `pk`, `nome`, `email`, `data_cadastro` FROM `usuarios`");
			$cst->execute();
			return $cst->fetchAll();
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}

	public function insere($dados){
		try{
			$this->nome = $this->objfc->tratarCaracter($dados['nome'], 1);
			$this->email = $this->objfc->tratarCaracter($dados['email'], 1);
			$this->senha = sha1($dados['senha']);
			$this->dataCadastro = $this->objfc->dataAtual(2);
			$cst = $this->con->conectar()->prepare("INSERT INTO `usuarios` (`nome`, `email`, `senha`, `data_cadastro`) VALUES (:nome, :email, :senha, :data);");
			$cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
			$cst->bindParam(":email", $this->email, PDO::PARAM_STR);
			$cst->bindParam(":senha", $this->senha, PDO::PARAM_STR);
			$cst->bindParam(":data", $this->dataCadastro, PDO::PARAM_STR);
			if($cst->execute()){
				return 'ok';
			}else{
				return 'Error ao cadastrar';
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}

	public function updade($dados){
		try{
			$this->idUsuario = $this->objfc->base64($dados['func'], 2);
			$this->nome = $dados['nome'];
			$this->email = $dados['email'];
			$cst = $this->con->conectar()->prepare("UPDATE `usuarios` SET `nome` = :nome, `email` = :email WHERE `pk` = :idUsuario;");
			$cst->bindParam(":idUsuario", $this->idUsuario, PDO::PARAM_INT);
			$cst->bindParam(":nome", $this->nome, PDO::PARAM_STR);
			$cst->bindParam(":email", $this->email, PDO::PARAM_STR);
			if($cst->execute()){
				return 'ok';
			}else{
				return 'Error ao alterar';
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}

	public function delete($dado){
		try{
			$this->idUsuario = $dado;
			$cst = $this->con->conectar()->prepare("DELETE FROM `usuarios` WHERE `pk` = :idUsuario;");
			$cst->bindParam(":idUsuario", $this->idUsuario, PDO::PARAM_INT);
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
