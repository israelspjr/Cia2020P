<?php
class TemaRedacao extends Database {
	// class attributes
	var $idTemaRedacao;
	var $idiomaIdIdioma;
	var $titulo;
	var $tema;
	var $dataCadastro;
	var $inativo;
	var $nivelEstudoIdNivelEstudo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTemaRedacao = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> titulo = "NULL";
		$this -> tema = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> inativo = "0";
		$this -> nivelEstudoIdNivelEstudo = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTemaRedacao($value) {
		$this -> idTemaRedacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTitulo($value) {
		$this -> titulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTema($value) {
		$this -> tema = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}
	
	function setNivelEstudoIdNivelEstudo($value) {
		$this -> nivelEstudoIdNivelEstudo = ($value) ? $this -> gravarBD($value) : "0";
	}


	/**
	 * addTemaRedacao() Function
	 */
	function addTemaRedacao() {
		$sql = "INSERT INTO temaRedacao (idioma_idIdioma, titulo, tema, dataCadastro, inativo, nivelEstudo_idNivelEstudo) VALUES ($this->idiomaIdIdioma, $this->titulo, $this->tema, $this->dataCadastro, $this->inativo, $this->nivelEstudoIdNivelEstudo)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteTemaRedacao() Function
	 */
	function deleteTemaRedacao($or = " 1 = 2 ") {
		$sql = "DELETE FROM temaRedacao WHERE idTemaRedacao = $this->idTemaRedacao OR (" . $or . ")";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTemaRedacao() Function
	 */
	function updateFieldTemaRedacao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE temaRedacao SET " . $field . " = " . $value . " WHERE idTemaRedacao = $this->idTemaRedacao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTemaRedacao() Function
	 */
	function updateTemaRedacao() {
		$sql = "UPDATE temaRedacao SET idioma_idIdioma = $this->idiomaIdIdioma, titulo = $this->titulo, tema = $this->tema, inativo = $this->inativo, nivelEstudo_idNivelEstudo = $this->nivelEstudoIdNivelEstudo WHERE idTemaRedacao = $this->idTemaRedacao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTemaRedacao() Function
	 */
	function selectTemaRedacao($where = "") {
		$sql = "SELECT SQL_CACHE idTemaRedacao, idioma_idIdioma, titulo, tema, dataCadastro, inativo, nivelEstudo_idNivelEstudo FROM temaRedacao " . $where;
		return $this -> executeQuery($sql);
	}

	function selectTemaRedacaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "",$mobile) {

		$sql = "SELECT SQL_CACHE idTemaRedacao, idioma_idIdioma, titulo, tema, dataCadastro, inativo, nivelEstudo_idNivelEstudo FROM temaRedacao " . $where;
//echo $sql;
		$Idioma = new Idioma();
		$NivelEstudo = new NivelEstudo();

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idTemaRedacao = $valor['idTemaRedacao'];
				$nomeIdioma = $Idioma->getNome($valor['idioma_idIdioma']);
				$titulo = $valor['titulo'];
				$tema = $valor['tema'];
				$nomeNivel = $NivelEstudo->getNome($valor['nivelEstudo_idNivelEstudo']);
				
				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=$idTemaRedacao', '$caminhoAtualizar', '$ondeAtualiza')\" ";
		
				$html .= "<tr>
				
				<td $onclick >" . $idTemaRedacao . "</td> 
				
				<td $onclick >" .$nomeIdioma . "</td>
				
				<td $onclick >" .$nomeNivel . "</td>
				
				<td $onclick >" . $titulo . "</td>
				
				<td $onclick >" . $tema . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataCadastro']). "</td>
				
				<td $onclick >" . Uteis::exibirStatus(!$valor['inativo']). "</td>
				
				<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "temaRedacao/grava.php', '$idTemaRedacao', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";

			}
		}
		return $html;
	}

	/*function getTemaRedacao($id) {
		$sql = " SELECT T.ddd, T.numero, D.nome AS descricao
		FROM TemaRedacao AS T 
		LEFT JOIN descricaoTemaRedacao AS D ON D.idDescricaoTemaRedacao = T.descricaoTemaRedacao_idDescricaoTemaRedacao 		
		WHERE T.idTemaRedacao = $id ";
		$rs = mysqli_fetch_array($this -> query($sql));
		return ($rs['ddd'] ? "(" . $rs['ddd'] . ") " : "") . $rs['numero'] . ($rs['descricao'] ? " [" . $rs['descricao'] . "]" : "");
		
	}*/

}
?>