<?php
//BUSCANDO AS CLASSES
include_once "Conexao.class.php";
include_once "Funcoes.class.php";

//CRIANDO A CLASSE
class Cardapio {

	//ATRIBUTOS
	private $con;
	private $objfc;

	private $idCard;
	private $tituloCard;
	private $itensCard;
	private $descricaoCard;
	private $dataCard;
	private $diaDaSemana;
	private $publicadoCard;

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

	public function selecionaUmCard($dado){
		try{
			$this->idCard = $dado;
			$cst = $this->con->conectar()->prepare("SELECT * FROM `cardapio` WHERE `idCard` = :idCard;");
			$cst->bindParam(":idCard", $this->idCard, PDO::PARAM_INT);
			if($cst->execute()){
				return $cst->fetch();
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}


	public function selecionaTudo(){
		try{
			$cst = $this->con->conectar()->prepare("SELECT * FROM `cardapio`");
			$cst->execute();
			return $cst->fetchAll();
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}


	public function insere($dados){
		try{
			$this->tituloCard = $this->objfc->tratarCaracter($dados['tituloCard'], 1);
			$this->descricaoCard = $this->objfc->tratarCaracter($dados['descricaoCard'], 1);
			$this->diaDaSemana = $dados['diaDaSemana'];
			$this->publicadoCard = $dados['publicadoCard'];
      		
			$cst = $this->con->conectar()->prepare("INSERT INTO `cardapio` (`tituloCard`, `descricaoCard`, `diaDaSemana`, `publicadoCard`) VALUES (:tituloCard, :descricaoCard, :diaDaSemana, :publicadoCard);");

			$cst->bindParam(":tituloCard", $this->tituloCard, PDO::PARAM_STR);
			$cst->bindParam(":descricaoCard", $this->descricaoCard, PDO::PARAM_STR);
			$cst->bindParam(":publicadoCard", $this->publicadoCard, PDO::PARAM_STR);
			$cst->bindParam(":diaDaSemana", $this->diaDaSemana, PDO::PARAM_STR);

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
			
	      $this->idCard = $this->objfc->base64($dados['func'], 2);
	      $this->tituloCard = $dados['tituloCard'];	  
		  $this->descricaoCard = $dados['descricaoCard'];
	      $this->publicadoCard = $dados['publicadoCard'];
	      $this->diaDaSemana = $dados['diaDaSemana'];

	      
	      $cst = $this->con->conectar()->prepare("UPDATE `cardapio` SET `tituloCard` = :tituloCard, `descricaoCard` = :descricaoCard, `publicadoCard` = :publicadoCard, `diaDaSemana` = :diaDaSemana WHERE `idCard` = :idCard;");

	      $cst->bindParam(":idCard", $this->idCard, PDO::PARAM_STR);
		  $cst->bindParam(":tituloCard", $this->tituloCard, PDO::PARAM_STR);
		  $cst->bindParam(":descricaoCard", $this->descricaoCard, PDO::PARAM_STR);
	      $cst->bindParam(":publicadoCard", $this->publicadoCard, PDO::PARAM_STR);
	      $cst->bindParam(":diaDaSemana", $this->publicadoCard, PDO::PARAM_STR);

	      		echo "-----------------";

		print_r ($dados);

		echo "<br>-----------------soh o id: ";

		echo $this->idCard;

		echo "-----------------";
			
			if ($cst->execute()){
				return 1;
				echo "inserido com sucesso";
			}else{
				echo "Erro ao inserir";
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}

	public function delete($dado){
		try{
			$this->idCard = $dado;
			$cst = $this->con->conectar()->prepare("DELETE FROM `cardapio` WHERE `idCard` = :idCard;");
			$cst->bindParam(":idCard", $this->idCard, PDO::PARAM_INT);
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
