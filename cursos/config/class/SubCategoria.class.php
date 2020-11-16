<?php
class SubCategoria extends Database {
	// class attributes
	var $idSubCategoria;
	var $valor;
	var $inativo;
	var $categoriaIdCategoria;


	// constructor
	function __construct() {
		parent::__construct();
		$this -> idSubCategoria = "NULL";
		$this -> valor = "NULL";
		$this -> inativo = "0";
		$this -> categoriaIdCategoria = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdSubCategoria($value) {
		$this -> idSubCategoria = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setCategoriaIdCategoria($value) {
		$this -> categoriaIdCategoria = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	
	/**
	 * addTelefone() Function
	 */
	function addSubCategoria() {
		$sql = "INSERT INTO `subCategoria` (`valor`, `inativo`, `categoria_idCategoria`)
VALUES ($this->valor, $this->inativo, $this->categoriaIdCategoria)";
	//	echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTelefone() Function
	 */
	function deleteSubCategoria($or = " 1 = 2 ") {
		$sql = "DELETE FROM subCategoria WHERE idSubCategoria = $this->idSubCategoria OR (" . $or . ")";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTelefone() Function
	 */
	function updateFieldSubCategoria($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE subCategoria SET " . $field . " = " . $value . " WHERE idSubCategoria = $this->idSubCategoria";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTelefone() Function
	 */
	function updateSubCategoria() {
		$sql = "UPDATE subCategoria SET valor = $this->valor, inativo = $this->inativo, categoria_idCategoria = $this->categoriaIdCategoria WHERE idSubCategoria = $this->idSubCategoria";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTelefone() Function
	 */
	function selectSubCategoria($where = "") {
		$sql = "SELECT `subCategoria`.`idSubCategoria`,
    `subCategoria`.`valor`,
    `subCategoria`.`inativo`, `subCategoria`.`categoria_idCategoria`
FROM `subCategoria`" . $where;
//echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectSubCategoriaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {
		
		$Categoria = new Categoria();
		
	//	$TipoRespsota = new TipoRespsota();
	//	$Idioma = new Idioma();
	//	$NivelEstudo = new NivelEstudo();
		
		$sql = "SELECT `subCategoria`.`idSubCategoria`,
    `subCategoria`.`valor`,
    `subCategoria`.`inativo`, `subCategoria`.`categoria_idCategoria`
FROM `subCategoria`" . $where;
//echo $sql;

		$result = $this -> query($sql);

	//	if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idHabilidades = $valor['idSubCategoria'];
				$idQuestao = $valor['questao_idQuestao'];
		//		$correta = Uteis::exibirStatus($valor['correta']);
				$valorD = $valor['valor'];
				$nomeCategoria = $Categoria->getNome($valor['categoria_idCategoria']);
				
		//		$SubCategoria = $valor['SubCategoria'];
		//		$nomeIdioma = $Idioma->getNome($idiomaN);
				$inativo = Uteis::exibirStatus(!$valor['ativo']);
		//		$dataCadastro = Uteis::exibirData($valor['dataCadastro']);
		//		$Respsota_idRespsota = $valor['Respsota_idRespsota'];
			
		//		$imagem = $valor['imagem'];
				

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?idSubCategoria=$idHabilidades&idQuestao=$idQuestao', '$caminhoAtualizar', '$ondeAtualiza')\" ";

				$html .= "<tr>
				<td $onclick >" . $idHabilidades . "</td>
				<td $onclick >" . $nomeCategoria . "</td> 
				<td $onclick >" . $valorD . "</td> 
				<td  style=\"text-align:center\">" . $inativo . "</td>
				

				
				<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "subCategoria/grava.php', '$idHabilidades', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";

			}
	//	}
		return $html;
	}
	
	function selectSubCategoriaSelect($classes = "", $idAtual = 0, $where = " Where") {
		$sql = "SELECT idSubCategoria, valor, categoria_idCategoria FROM subCategoria $where AND inativo = 0";
		$result = $this -> query($sql);
		$html = "<select id=\"idSubCategoria\" name=\"idSubCategoria\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idSubCategoria'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idSubCategoria'] . "\">" . $valor['valor'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function getNome($id) {
		$sql = "SELECT idSubCategoria, valor FROM subCategoria where idSubCategoria = ".$id;
		$result = Uteis::executarQuery($sql);
		return $result[0]['valor'];
		
		
	}

}
?>