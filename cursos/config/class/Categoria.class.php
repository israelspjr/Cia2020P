<?php
class Categoria extends Database {
	// class attributes
	var $idCategoria;
	var $valor;
	var $inativo;


	// constructor
	function __construct() {
		parent::__construct();
		$this -> idCategoria = "NULL";
		$this -> valor = "NULL";
		$this -> inativo = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdCategoria($value) {
		$this -> idCategoria = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	/**
	 * addTelefone() Function
	 */
	function addCategoria() {
		$sql = "INSERT INTO `categoria` (`valor`, `inativo`)
VALUES ($this->valor, $this->inativo)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTelefone() Function
	 */
	function deleteCategoria($or = " 1 = 2 ") {
		$sql = "DELETE FROM categoria WHERE idCategoria = $this->idCategoria OR (" . $or . ")";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTelefone() Function
	 */
	function updateFieldCategoria($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE categoria SET " . $field . " = " . $value . " WHERE idCategoria = $this->idCategoria";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTelefone() Function
	 */
	function updateCategoria() {
		$sql = "UPDATE categoria SET valor = $this->valor, inativo = $this->inativo WHERE idCategoria = $this->idCategoria";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTelefone() Function
	 */
	function selectCategoria($where = "") {
		$sql = "SELECT `categoria`.`idCategoria`,
    `categoria`.`valor`,
    `categoria`.`inativo`
FROM `categoria`" . $where;
//echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectCategoriaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {
		
	//	$TipoRespsota = new TipoRespsota();
	//	$Idioma = new Idioma();
	//	$NivelEstudo = new NivelEstudo();
		
		$sql = "SELECT `categoria`.`idCategoria`,
    `categoria`.`valor`,
    `categoria`.`inativo`
FROM `categoria`"  . $where;

		$result = $this -> query($sql);

	//	if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idHabilidades = $valor['idCategoria'];
		//		$idQuestao = $valor['questao_idQuestao'];
		//		$correta = Uteis::exibirStatus($valor['correta']);
				$valor = $valor['valor'];
			//	$nomeTipo = $TipoRespsota->getNome($valor['tipoRespsota_idTipoRespsota']);
				
		//		$Categoria = $valor['Categoria'];
		//		$nomeIdioma = $Idioma->getNome($idiomaN);
				$inativo = Uteis::exibirStatus($valor['ativo']);
		//		$dataCadastro = Uteis::exibirData($valor['dataCadastro']);
		//		$Respsota_idRespsota = $valor['Respsota_idRespsota'];
			
		//		$imagem = $valor['imagem'];
				

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idCategoria=$idHabilidades&idQuestao=$idQuestao', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>
				<td $onclick >" . $idHabilidades . "</td>
				<td $onclick >" . $valor . "</td> 
				<td  style=\"text-align:center\">" . $inativo . "</td>
				

				
				<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "categoria/grava.php', '$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";

			}
	//	}
		return $html;
	}
	
	function selectCategoriaSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT idCategoria, valor FROM categoria where inativo = 0";
		$result = $this -> query($sql);
		$html = "<select id=\"idCategoria\" name=\"idCategoria\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idCategoria'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idCategoria'] . "\">" . $valor['valor'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function getNome($id) {
		$sql = "SELECT idCategoria, valor FROM categoria where idCategoria = ".$id;
		$result = Uteis::executarQuery($sql);
		return $result[0]['valor'];
		
		
	}

}
?>