<?php
class ItenProva extends Database {
	// class attributes
	var $idItenProva;
	var $provaIdProva;
	var $nome;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idItenProva = "NULL";
		$this -> provaIdProva = "NULL";
		$this -> nome = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdItenProva($value) {
		$this -> idItenProva = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProvaIdProva($value) {
		$this -> provaIdProva = ($value) ? $this -> gravarBD($value) : "NULL";
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
	 * addItenProva() Function
	 */
	function addItenProva() {
		$sql = "INSERT INTO itenProva (prova_idProva, nome, inativo, excluido) VALUES ($this->provaIdProva, $this->nome, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteItenProva() Function
	 */
	function deleteItenProva() {
		$sql = "DELETE FROM itenProva WHERE idItenProva = $this->idItenProva";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldItenProva() Function
	 */
	function updateFieldItenProva($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE itenProva SET " . $field . " = " . $value . " WHERE idItenProva = $this->idItenProva";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateItenProva() Function
	 */
	function updateItenProva() {
		$sql = "UPDATE itenProva SET prova_idProva = $this->provaIdProva, nome = $this->nome, inativo = $this->inativo WHERE idItenProva = $this->idItenProva";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectItenProva() Function
	 */
	function selectItenProva($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idItenProva, prova_idProva, nome, inativo, excluido FROM itenProva " . $where;
    //echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectItenProvaTr() Function
	 */
	function selectItenProvaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE i.idItenProva, i.prova_idProva, i.nome, i.inativo, i.excluido, p.nome as nomeProva FROM itenProva i INNER JOIN prova p ON i.prova_idProva = p.idProva " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idItenProva = $valor['idItenProva'];
				$prova_idProva = $valor['nomeProva'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idItenProva . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idItenProva'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $prova_idProva . "</td>";
				$html .= "<td>" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idItenProva'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectItenProvaSelect() Function
	 */
	function selectItenProvaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idItenProva, prova_idProva, nome, inativo, excluido FROM itenProva " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idItenProva\" name=\"idItenProva\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idItenProva'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idItenProva'] . "\">" . ($valor['idItenProva']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
    
    function selectItenProvaSelectMulti($classes = "", $idAtual = 0, $where = "") {
        $sql = "SELECT SQL_CACHE idItenProva, prova_idProva, nome, inativo, excluido FROM itenProva " . $where;
		$result = $this -> query($sql);
        $html = "<select id=\"idItenProva[]\" name=\"idItenProva[]\"  class=\"" . $classes . "\" multiple>";
        $html .= "<option value=\"\" selected=\"selected\" >Todos</option>";
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idAtual == $valor['idItenProva'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idItenProva'] . "\">" . ($valor['nome']) . "</option>";
        }

        $html .= "</select>";
        return $html;
    }

	function getNome($id) {
		$rs = $this -> selectItenProva(" WHERE idItenProva = $id");
		return $rs[0]['nome'];
	}

}
?>