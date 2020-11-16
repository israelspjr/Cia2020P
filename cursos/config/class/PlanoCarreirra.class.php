<?php
class PlanoCarreirra extends Database {
	// class attributes
	var $idPlanoCarreira;
  var $descricao;
	var $plano;
	var $inativo;
	var $dataCadastro;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoCarreira = "NULL";
    $this -> descricao = "NULL";
		$this -> plano = "NULL";
		$this -> inativo = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoCarreira($value) {
		$this -> idPlanoCarreira = ($value) ? $this -> gravarBD($value) : "NULL";
	}
  
  function setDescricao($value){
     $this -> descricao = ($value) ? $this -> gravarBD($value) : "NULL"; 
  }
  
	function setPlano($value) {
		$this -> plano = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addPlanoCarreirra() Function
	 */
	function addPlanoCarreirra() {
		$sql = "INSERT INTO planoCarreirra (descricao, plano, inativo, dataCadastro, excluido) VALUES ($this->descricao, $this->plano, $this->inativo, '" . date('Y-m-y H:i:s') . "', $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deletePlanoCarreirra() Function
	 */
	function deletePlanoCarreirra() {
		$sql = "DELETE FROM planoCarreirra WHERE idPlanoCarreira = $this->idPlanoCarreira";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPlanoCarreirra() Function
	 */
	function updateFieldPlanoCarreirra($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE planoCarreirra SET " . $field . " = " . $value . " WHERE idPlanoCarreira = $this->idPlanoCarreira";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePlanoCarreirra() Function
	 */
	function updatePlanoCarreirra() {
		$sql = "UPDATE planoCarreirra SET plano = $this->plano, inativo = $this->inativo WHERE idPlanoCarreira = $this->idPlanoCarreira";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPlanoCarreirra() Function
	 */
	function selectPlanoCarreirra($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPlanoCarreira, descricao, plano, inativo, dataCadastro, excluido FROM planoCarreirra " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPlanoCarreirraTr() Function
	 */
	function selectPlanoCarreirraTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idPlanoCarreira, descricao, plano, inativo, dataCadastro, excluido FROM planoCarreirra " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idPlanoCarreira = $valor['idPlanoCarreira'];
        $descricao = $valor['descricao'];
				$plano = Uteis::formatarMoeda($valor['plano']);
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				$dataCadastro = $valor['dataCadastro'];

			
				$html .= "<td>" . $idPlanoCarreira . "</td>";
        $html .= "<td>" . $descricao . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idPlanoCarreira'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >R$ " . $plano . "</td>";
				$html .= "<td>" . $inativo . "</td>";

				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idPlanoCarreira'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectPlanoCarreirraSelect() Function
	 */
	function selectPlanoCarreirraSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idPlanoCarreira, plano FROM planoCarreirra WHERE inativo = 0 ORDER BY plano ";
		$result = $this -> query($sql);
		$html = "<select id=\"idPlanoCarreira\" name=\"idPlanoCarreira\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPlanoCarreira'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPlanoCarreira'] . "\">" . "R$ " . number_format($valor['plano'], 2, ',', '.') . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>