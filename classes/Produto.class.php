<?php
//BUSCANDO AS CLASSES
include_once "Conexao.class.php";
include_once "Funcoes.class.php";

//CRIANDO A CLASSE
class Produto {

	//ATRIBUTOS
	private $con;
	private $objfc;

	private $idProduto;
	private $nomeProduto;
	private $descricaoProduto;
	private $preco;
	private $publicado;
	private $dataCadastro;
	private $vencimento;
	private $fornecedor;
	private $foto;


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

	public function selecionaUmProduto($dado){
		try{
			$this->idProduto = $dado;
			$cst = $this->con->conectar()->prepare("SELECT  `pk_produto`, `nome_produto`, `descricao_produto`, `valor_produto` FROM `produtos` WHERE `pk_produto` = :idProduto;");
			$cst->bindParam(":idProduto", $this->idProduto, PDO::PARAM_INT);
			if($cst->execute()){
				return $cst->fetch();
			}
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}


	public function selecionaTudo(){
		try{
			$cst = $this->con->conectar()->prepare("SELECT * FROM `produtos`");
			$cst->execute();
			return $cst->fetchAll();
		}catch(PDOException $e){
			return 'Error: '.$e->getMessage();
		}
	}


	public function insereProduto($dados){
		try{
			$this->nomeProduto = $this->objfc->tratarCaracter($dados['nomeProduto'], 1);
			$this->descricaoProduto = $this->objfc->tratarCaracter($dados['descricaoProduto'], 1);
			$this->preco = $dados['preco'];
			$this->publicado = $dados['publicado'];
			$this->fornecedor = $this->objfc->tratarCaracter($dados['fornecedor'], 1);
			$this->dataCadastro = date("d/m/Y");
			$this->foto = $dados['foto'];
			//$this->dataCadastro = $this->objfc->dataAtual(2);
			//$this->vencimento = $this->objfc->tratarCaracter($dados['vencimento'], 1);
			//$this->fornecedor = $this->objfc->tratarCaracter($dados['fornecedor'], 1);
			//$cst->bindParam(":vencimento", $this->vencimento, PDO::PARAM_STR);
			//$cst->bindParam(":fornecedor", $this->fornecedor, PDO::PARAM_STR);

			// Recupera os dados dos campos
	
			// Se a foto estiver sido selecionada
			if (!empty($foto["name"])) {
				
				// Largura máxima em pixels
				$largura = 2000;
				// Altura máxima em pixels
				$altura = 3000;
				// Tamanho máximo do arquivo em bytes
				$tamanho = 5000;

				$error = array();

				// Verifica se o arquivo é uma imagem
				if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
			 	   $error[1] = "Isso não é uma imagem.";
				 	} 

				// Pega as dimensões da imagem
				$dimensoes = getimagesize($foto["tmp_name"]);

				// Verifica se a largura da imagem é maior que a largura permitida
				if($dimensoes[0] > $largura) {
					$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
				}

				// Verifica se a altura da imagem é maior que a altura permitida
				if($dimensoes[1] > $altura) {
					$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
				}
				
				// Verifica se o tamanho da imagem é maior que o tamanho permitido
				if($foto["size"] > $tamanho) {
					 	$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
				}

				// Se não houver nenhum erro
				if (count($error) == 0) {
				
					// Pega extensão da imagem
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);

			    	// Gera um nome único para a imagem
			    	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

			    	// Caminho de onde ficará a imagem
			    	$caminho_imagem = "img/" . $nome_imagem;

					// Faz o upload da imagem para seu respectivo caminho
					move_uploaded_file($foto["tmp_name"], $caminho_imagem);
				
					$this->foto = $nome_imagem;
					// Insere os dados no banco
					/*$cst = $this->con->conectar()->prepare("INSERT INTO `produtos` (`nome_produto`, `descricao_produto`, `valor_produto`) VALUES (:nomeProduto, :descricaoProduto, :preco);");

					$cst->bindParam(":nomeProduto", $this->nomeProduto, PDO::PARAM_STR);
					$cst->bindParam(":descricaoProduto", $this->descricaoProduto, PDO::PARAM_STR);
					$cst->bindParam(":preco", $this->preco, PDO::PARAM_STR);
					//$cst->bindParam(":imagem", $this->foto, PDO::PARAM_STR);

					// Se houver mensagens de erro, exibe-as
					if (count($error) != 0) {
						foreach ($error as $erro) {
							echo $erro . "<br />";
						}
					}*/
				}
			}
					
			$cst = $this->con->conectar()->prepare("INSERT INTO `produtos` (`nome_produto`, `descricao_produto`, `valor_produto`, `publicado`, `datacadastro`, `fornecedor`) VALUES (:nomeProduto, :descricaoProduto, :preco, :publicado, :datacadastro, :fornecedor);");

				
			$cst->bindParam(":nomeProduto", $this->nomeProduto, PDO::PARAM_STR);
			$cst->bindParam(":descricaoProduto", $this->descricaoProduto, PDO::PARAM_STR);
			$cst->bindParam(":preco", $this->preco, PDO::PARAM_STR);
			$cst->bindParam(":publicado", $this->publicado, PDO::PARAM_STR);	
			$cst->bindParam(":datacadastro", $this->dataCadastro, PDO::PARAM_STR);
			$cst->bindParam(":fornecedor", $this->fornecedor, PDO::PARAM_STR);				

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
			$this->pkProduto = $dado;
			$cst = $this->con->conectar()->prepare("DELETE FROM `produtos` WHERE `pk_produto` = :pkProduto;");
			$cst->bindParam(":pkProduto", $this->pkProduto, PDO::PARAM_INT);
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
