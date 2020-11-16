<?php
class ZonaAtendimentoCidade extends Database {
	// class attributes
	var $idZonaAtendimentoCidade;
	var $cidadeIdCidade;
	var $paisIdPais;
	var $zona;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idZonaAtendimentoCidade = "NULL";
		$this -> cidadeIdCidade = "NULL";
		$this -> paisIdPais = "NULL";
		$this -> zona = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdZonaAtendimentoCidade($value) {
		$this -> idZonaAtendimentoCidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCidadeIdCidade($value) {
		$this -> cidadeIdCidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPaisIdPais($value) {
		$this -> paisIdPais = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setZona($value) {
		$this -> zona = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addZonaAtendimentoCidade() Function
	 */
	function addZonaAtendimentoCidade() {
		$sql = "INSERT INTO zonaAtendimentoCidade (cidade_idCidade, pais_idPais, zona, inativo, excluido) VALUES ($this->cidadeIdCidade, $this->paisIdPais, $this->zona, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteZonaAtendimentoCidade() Function
	 */
	function deleteZonaAtendimentoCidade() {
		$sql = "DELETE FROM zonaAtendimentoCidade WHERE idZonaAtendimentoCidade = $this->idZonaAtendimentoCidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldZonaAtendimentoCidade() Function
	 */
	function updateFieldZonaAtendimentoCidade($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE zonaAtendimentoCidade SET " . $field . " = " . $value . " WHERE idZonaAtendimentoCidade = $this->idZonaAtendimentoCidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateZonaAtendimentoCidade() Function
	 */
	function updateZonaAtendimentoCidade() {
		$sql = "UPDATE zonaAtendimentoCidade SET cidade_idCidade = $this->cidadeIdCidade, pais_idPais = $this->paisIdPais, zona = $this->zona, inativo = $this->inativo WHERE idZonaAtendimentoCidade = $this->idZonaAtendimentoCidade";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectZonaAtendimentoCidade() Function
	 */
	function selectZonaAtendimentoCidade($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idZonaAtendimentoCidade, cidade_idCidade, pais_idPais, zona, inativo, excluido FROM zonaAtendimentoCidade " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectZonaAtendimentoCidadeTr() Function
	 */
	/**
	 * selectZonaAtendimentoCidadeTr() Function
	 */
	function selectZonaAtendimentoCidadeTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE z.idZonaAtendimentoCidade, z.cidade_idCidade, z.pais_idPais, z.zona, z.inativo, z.excluido, c.cidade, p.pais 
		FROM zonaAtendimentoCidade z LEFT JOIN cidade c ON c.idCidade = z.cidade_idCidade LEFT JOIN pais p ON p.idPais = z.pais_idPais " . $where;
//		echo $sql;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idZonaAtendimentoCidade = $valor['idZonaAtendimentoCidade'];
				$cidade_idCidade = $valor['cidade'];
				$pais_idPais = $valor['pais'];
				$zona = $valor['zona'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<td>" . $idZonaAtendimentoCidade . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idZonaAtendimentoCidade'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $cidade_idCidade . "</td>";
				$html .= "<td>" . $pais_idPais . "</td>";
				$html .= "<td>" . $zona . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idZonaAtendimentoCidade'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectZonaatendimentocidadeSelect($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idZonaAtendimentoCidade, zona FROM zonaAtendimentoCidade 
		WHERE inativo = 0 AND excluido = 0 ORDER BY zona";
		$result = $this -> query($sql);
		$html = "<select id=\"idZonaAtendimentoCidade\" name=\"idZonaAtendimentoCidade\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idZonaAtendimentoCidade'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idZonaAtendimentoCidade'] . "\">" . ($valor['zona']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectZonaatendimentocidadeSelectMult($classes = "", $idAtual = 0) {
		$sql = "SELECT SQL_CACHE idZonaAtendimentoCidade, zona FROM zonaAtendimentoCidade 
		WHERE inativo = 0 AND excluido = 0 ORDER BY zona";
		$result = $this -> query($sql);
		$html = "<select id=\"idZonaAtendimentoCidade\" name=\"idZonaAtendimentoCidade[]\" class=\"" . $classes . "\" multiple=\"multiple\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idZonaAtendimentoCidade'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idZonaAtendimentoCidade'] . "\">" . ($valor['zona']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectZonaatendimentocidadePorCidadeSelect($classes = "", $idAtual = 0, $idCidade = 0, $and = "") {
		$sql = "SELECT SQL_CACHE idZonaAtendimentoCidade, zona FROM zonaAtendimentoCidade 
		WHERE inativo = 0 AND excluido = 0 AND cidade_idCidade = '" . $idCidade . "' " . $and . " ORDER BY zona";
		$result = $this -> query($sql);
		
		if (mysqli_num_rows($result) > 0) {
		
		$html = "<select id=\"idZonaAtendimentoCidade\" name=\"idZonaAtendimentoCidade\"  class=\"" . $classes . "\" >";
	//	$html .= "<option value=\"\">Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idZonaAtendimentoCidade'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idZonaAtendimentoCidade'] . "\">" . ($valor['zona']) . "</option>";
		}
		$html .= "</select>";
		} else {
		$html .= "Nenhuma zona de atendimento criada, será gerada uma nova zona de atendimento Todas";
		$html .= "<input type=\"hidden\" name=\"idZonaAtendimentoCidade\" id=\"idZonaAtendimentoCidade\" value=\"-\" >";
		}
			
		return $html;

	}

	//ALTERAR CLASSE
	function selectZonaatendimentocidadePorPaisSelect($classes = "", $idAtual = 0, $idPais = 0, $and = "") {
		$sql = "SELECT SQL_CACHE idZonaAtendimentoCidade, zona FROM zonaAtendimentoCidade 
		WHERE inativo = 0 AND excluido = 0 AND pais_idPais = '" . $idPais . "' " . $and . " ORDER BY zona";
		//echo $sql;
		//exit;
		$result = $this -> query($sql);

		$html = "<select id=\"idZonaAtendimentoCidade\" name=\"idZonaAtendimentoCidade\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idZonaAtendimentoCidade'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idZonaAtendimentoCidade'] . "\">" . ($valor['zona']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>