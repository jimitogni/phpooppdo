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
	private $id;
	private $nomeProduto;
	private $descricaoProduto;
	private $preco;
	private $publicado;
	private $dataCadastro;
	private $vencimento;
	private $fornecedor;
	private $diaDaSemana;
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
			$this->diaDaSemana = $dados['diaDaSemana'];
			$this->fornecedor = $this->objfc->tratarCaracter($dados['fornecedor'], 1);
			$this->dataCadastro = date("d/m/Y");
			//$fotoup = $_FILES['userfile']['name'];
			//$this->dataCadastro = $this->objfc->dataAtual(2);
			//$this->vencimento = $this->objfc->tratarCaracter($dados['vencimento'], 1);
			//$this->fornecedor = $this->objfc->tratarCaracter($dados['fornecedor'], 1);
			//$cst->bindParam(":vencimento", $this->vencimento, PDO::PARAM_STR);
			//$cst->bindParam(":fornecedor", $this->fornecedor, PDO::PARAM_STR);

			// Recupera os dados dos campos

				// Largura máxima em pixels
				//$largura = 2000;
				// Altura máxima em pixels
				//$altura = 3000;
				// Tamanho máximo do arquivo em bytes
				//$tamanho = 5000;

				//$error = array();

				// Verifica se o arquivo é uma imagem
				//if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $_FILES['userfile']['name'])){
			 	  // $error[1] = "Isso não é uma imagem.";
				//}

				// Pega as dimensões da imagem
				//$dimensoes = getimagesize($_FILES['userfile']['name']);

				// Verifica se a largura da imagem é maior que a largura permitida
				//if($dimensoes[0] > $largura) {
				//	$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
				//}

				// Verifica se a altura da imagem é maior que a altura permitida
				//if($dimensoes[1] > $altura) {
				//	$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
				//}

				// Verifica se o tamanho da imagem é maior que o tamanho permitido
				//if($fotoup["size"] > $tamanho) {
				//	 	$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
				//}

				// Se não houver nenhum erro
				//if (count($error) == 0) {

					// Pega extensão da imagem
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $_FILES['userfile']['name'], $ext);

					//$nome_imagem = md5(uniqid(time())) . "." . $ext[1];

					$uploaddir = '/phpoopdo/img/';

					$nomedafoto = md5(uniqid(time())) . "." . $ext[1];

					$uploadfile = DIRROOT.'/img/'.$nomedafoto;

					echo "<br> nomedafoto: ".$nomedafoto;
					echo "<br> <br> uploadfile: ".$uploadfile;
					echo "<br> <br>";

					if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
					echo "Arquivo válido e enviado com sucesso.\n";
					} else {
					echo "Possível ataque de upload de arquivo!\n";
					}

			    	// Gera um nome único para a imagem
			    	//$nome_imagem = basename($_FILES['userfile']['name']);

			    	// Caminho de onde ficará a imagem
			    	//$caminho_imagem = "/var/www/html/php/phpoopdo/img/" . $nome_imagem;

					// Faz o upload da imagem para seu respectivo caminho
					//move_uploaded_file($fotoup["tmp_name"], $caminho_imagem);

					//$fotoup = $nome_imagem;
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
						}*/
					//}
				//}
			//}
			print_r($_FILES);

			print_r($dados);

			$cst = $this->con->conectar()->prepare("INSERT INTO `produtos` (`nome_produto`, `descricao_produto`, `valor_produto`, `publicado`, `datacadastro`, `fornecedor`, `urlimagem`, `diadasemana`) VALUES (:nomeProduto, :descricaoProduto, :preco, :publicado, :datacadastro, :fornecedor, :urlimagem, :diaDaSemana);");


			$cst->bindParam(":nomeProduto", $this->nomeProduto, PDO::PARAM_STR);
			$cst->bindParam(":descricaoProduto", $this->descricaoProduto, PDO::PARAM_STR);
			$cst->bindParam(":preco", $this->preco, PDO::PARAM_STR);
			$cst->bindParam(":publicado", $this->publicado, PDO::PARAM_STR);
			$cst->bindParam(":datacadastro", $this->dataCadastro, PDO::PARAM_STR);
			$cst->bindParam(":fornecedor", $this->fornecedor, PDO::PARAM_STR);
			$cst->bindParam(":urlimagem", $nomedafoto, PDO::PARAM_STR);
			$cst->bindParam(":diaDaSemana", $this->diaDaSemana, PDO::PARAM_STR);



			if($cst->execute()){
				return 'ok';
			}else{
				return 'Error ao cadastrar';
			}

		}catch(PDOException $e){
		return 'Error: '.$e->getMessage();
		}
	}



	public function update($dados){
		try{
			$this->id = $dados['func'];
			$this->idProduto = $this->objfc->base64($dados['func'], 2);
			$this->nomeProduto = $dados['nomeProduto'];
			$this->descricaoProduto = $dados['descricaoProduto'];
			$this->preco = $dados['preco'];
			//$this->dataCadastro = $dados['datacadastro'];
			$this->fornecedor = $dados['fornecedor'];
			$this->publicado = $dados['publicado'];
			$this->urlimagem = $dados['urlimagem'];
			$this->diaDaSemana = $dados['diaDaSemana'];
			
		print_r ($dados);
		echo "<br>-----------------soh o id: ";
		echo $this->idProduto;
		echo "-----------------";
		echo "<br>---antes do sql----<br>";
			
			$cst = $this->con->conectar()->prepare("UPDATE `produtos` SET `nome_produto` = :nomeProduto, `descricao_produto` = :descricaoProduto, `valor_produto` = 222, `fornecedor` = ':fornecedor', `publicado` = 1, `urlimagem` = ':urlimagem', `diadasemana` = 1 WHERE `pk_produto` = :idProduto;");

			$cst->bindParam(":id", $this->id, PDO::PARAM_STR);
			$cst->bindParam(":idProduto", $this->idProduto, PDO::PARAM_STR);
			$cst->bindParam(":nomeProduto", $this->nomeProduto, PDO::PARAM_STR);
			$cst->bindParam(":descricaoProduto", $this->descricaoProduto, PDO::PARAM_STR);
			$cst->bindParam(":preco", $this->preco, PDO::PARAM_STR);
			//$cst->bindParam(":datacadastro", $this->datacadastro, PDO::PARAM_STR);
			$cst->bindParam(":fornecedor", $this->fornecedor, PDO::PARAM_STR);
			$cst->bindParam(":publicado", $this->publicado, PDO::PARAM_STR);
			$cst->bindParam(":urlimagem", $nomedafoto, PDO::PARAM_STR);
			$cst->bindParam(":diaDaSemana", $this->diaDaSemana, PDO::PARAM_STR);

		print_r ($dados);

		echo "<b><br>-------->>>> idProduto: ". $this->idProduto ."<<<--- essa eh a ID do idProduto</b>";

		echo "<b><br>-------->>>> id: ". $this->id ."<<<--- essa eh a ID do id</b>";

		echo "-----------------";

			if($cst->execute()){
				return 1;
			}else{
				return 'Error ao alterar NA CLASSE';
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
