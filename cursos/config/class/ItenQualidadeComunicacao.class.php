<?php
class ItenQualidadeComunicacao extends Database {
	// class attributes
	var $idItenQualidadeComunicacao;
	var $tipoQualidadeComunicacaoIdTipoQualidadeComunicacao;
	var $nome;
    var $descricao;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idItenQualidadeComunicacao = "NULL";
		$this -> tipoQualidadeComunicacaoIdTipoQualidadeComunicacao = "NULL";
		$this -> nome = "NULL";
        $this -> descricao = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdItenQualidadeComunicacao($value) {
		$this -> idItenQualidadeComunicacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoQualidadeComunicacaoIdTipoQualidadeComunicacao($value) {
		$this -> tipoQualidadeComunicacaoIdTipoQualidadeComunicacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}
  
  function setDescricao($value) {
    $this -> descricao = ($value) ? $this -> gravarBD($value) : "NULL";
  }

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addItenQualidadeComunicacao() Function
	 */
	function addItenQualidadeComunicacao() {
		$sql = "INSERT INTO itenQualidadeComunicacao (tipoQualidadeComunicacao_idTipoQualidadeComunicacao, nome, descricao, inativo, excluido) VALUES ($this->tipoQualidadeComunicacaoIdTipoQualidadeComunicacao, $this->nome, $this->descricao, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteItenQualidadeComunicacao() Function
	 */
	function deleteItenQualidadeComunicacao() {
		$sql = "DELETE FROM itenQualidadeComunicacao WHERE idItenQualidadeComunicacao = $this->idItenQualidadeComunicacao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldItenQualidadeComunicacao() Function
	 */
	function updateFieldItenQualidadeComunicacao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE itenQualidadeComunicacao SET " . $field . " = " . $value . " WHERE idItenQualidadeComunicacao = $this->idItenQualidadeComunicacao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateItenQualidadeComunicacao() Function
	 */
	function updateItenQualidadeComunicacao() {
		$sql = "UPDATE itenQualidadeComunicacao SET tipoQualidadeComunicacao_idTipoQualidadeComunicacao = $this->tipoQualidadeComunicacaoIdTipoQualidadeComunicacao, nome = $this->nome, descricao = $this->descricao, inativo = $this->inativo WHERE idItenQualidadeComunicacao = $this->idItenQualidadeComunicacao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectItenQualidadeComunicacao() Function
	 */
	function selectItenQualidadeComunicacao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idItenQualidadeComunicacao, tipoQualidadeComunicacao_idTipoQualidadeComunicacao, nome, descricao, inativo, excluido FROM itenQualidadeComunicacao " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectItenQualidadeComunicacaoTr() Function
	 */
	function selectItenQualidadeComunicacaoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE i.idItenQualidadeComunicacao, i.tipoQualidadeComunicacao_idTipoQualidadeComunicacao, i.nome, i.descricao, i.inativo, t.nome as nomeTipoQualidadeComunicacao FROM itenQualidadeComunicacao i INNER JOIN  tipoQualidadeComunicacao t ON t.idTipoQualidadeComunicacao = i.tipoQualidadeComunicacao_idTipoQualidadeComunicacao" . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<tr>";
				$html .= "<td>" . $valor['idItenQualidadeComunicacao'] . "</td>";
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idItenQualidadeComunicacao'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['nomeTipoQualidadeComunicacao'] . "</td>";
				$html .= "<td>" . $valor['nome'] . "</td>";
        $html .= "<td>" . $valor['descricao'] . "</td>";
				$html .= "<td>" . $inativo . "</td>";

				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/grava.php', " . $valor['idItenQualidadeComunicacao'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectItenQualidadeComunicacaoSelect() Function
	 */
	function selectItenQualidadeComunicacaoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idItenQualidadeComunicacao, tipoQualidadeComunicacao_idTipoQualidadeComunicacao, nome, descricao, inativo FROM itenQualidadeComunicacao " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idItenQualidadeComunicacao\" name=\"idItenQualidadeComunicacao\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idItenQualidadeComunicacao'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idItenQualidadeComunicacao'] . "\">" . ($valor['nome']." - ".$valor['descricao']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>