<?php
class TipoQualidadeComunicacao extends Database {
	// class attributes
	var $idTipoQualidadeComunicacao;
	var $idiomaIdIdioma;
	var $nome;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idTipoQualidadeComunicacao = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdTipoQualidadeComunicacao($value) {
		$this -> idTipoQualidadeComunicacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addTipoQualidadeComunicacao() Function
	 */
	function addTipoQualidadeComunicacao() {
		$sql = "INSERT INTO tipoQualidadeComunicacao (idioma_idIdioma, nome, inativo, excluido) VALUES ($this->idiomaIdIdioma, $this->nome, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteTipoQualidadeComunicacao() Function
	 */
	function deleteTipoQualidadeComunicacao() {
		$sql = "DELETE FROM tipoQualidadeComunicacao WHERE idTipoQualidadeComunicacao = $this->idTipoQualidadeComunicacao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldTipoQualidadeComunicacao() Function
	 */
	function updateFieldTipoQualidadeComunicacao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE tipoQualidadeComunicacao SET " . $field . " = " . $value . " WHERE idTipoQualidadeComunicacao = $this->idTipoQualidadeComunicacao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateTipoQualidadeComunicacao() Function
	 */
	function updateTipoQualidadeComunicacao() {
		$sql = "UPDATE tipoQualidadeComunicacao SET idioma_idIdioma = $this->idiomaIdIdioma, nome = $this->nome, inativo = $this->inativo WHERE idTipoQualidadeComunicacao = $this->idTipoQualidadeComunicacao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectTipoQualidadeComunicacao() Function
	 */
	function selectTipoQualidadeComunicacao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idTipoQualidadeComunicacao, idioma_idIdioma, nome, inativo, excluido FROM tipoQualidadeComunicacao " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectTipoQualidadeComunicacaoTr() Function
	 */
	function selectTipoQualidadeComunicacaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE t.idTipoQualidadeComunicacao, t.idioma_idIdioma, t.nome, t.inativo, t.excluido, i.idioma nomeIdioma FROM tipoQualidadeComunicacao t INNER JOIN idioma i ON i.idIdioma = t.idioma_idIdioma " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idTipoQualidadeComunicacao = $valor['idTipoQualidadeComunicacao'];
				$idioma_idIdioma = $valor['nomeIdioma'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idTipoQualidadeComunicacao . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idTipoQualidadeComunicacao'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $idioma_idIdioma . "</td>";
				$html .= "<td>" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idTipoQualidadeComunicacao'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectTipoQualidadeComunicacaoSelect() Function
	 */
	function selectTipoQualidadeComunicacaoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idTipoQualidadeComunicacao, idioma_idIdioma, nome, inativo, excluido FROM tipoQualidadeComunicacao " . $where;
        $idioma = new Idioma();        
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoQualidadeComunicacao\" name=\"idTipoQualidadeComunicacao\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoQualidadeComunicacao'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoQualidadeComunicacao'] . "\">" . ($valor['nome']." - ".$idioma->getNome($valor['idioma_idIdioma'])) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
	
	function selectTipoQualidadeComunicacaoMulti($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idTipoQualidadeComunicacao, idioma_idIdioma, nome, inativo, excluido FROM tipoQualidadeComunicacao " . $where;
        $idioma = new Idioma();        
		$result = $this -> query($sql);
		$html = "<select id=\"idTipoQualidadeComunicacao\" name=\"idTipoQualidadeComunicacao\"  multiple=\"multiple\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idTipoQualidadeComunicacao'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idTipoQualidadeComunicacao'] . "\">" . ($valor['nome']." - ".$idioma->getNome($valor['idioma_idIdioma'])) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
	
	function getNome($id) {
		$sql = "SELECT SQL_CACHE
    QC.idQualidadeComunicacaoPlanoAcao,
    IQC.descricao AS descricao
    
FROM
    qualidadeComunicacaoPlanoAcao AS QC
        INNER JOIN
    itenQualidadeComunicacao AS IQC ON QC.itenQualidadeComunicacao_idItenQualidadeComunicacao = IQC.idItenQualidadeComunicacao
WHERE idQualidadeComunicacaoPlanoAcao = ".$id;
		
//		echo $sql."<br>";
		$rs = $this->executeQuery($sql);
		
		$nome = $rs[0]['descricao'];
		return $nome;	
	}

}
?>