<?php
class PlanoAcaoMedicaoResultado extends Database {

	// class attributes
	var $idPlanoAcaoMedicaoResultado;
	var $planoAcaoIdPlanoAcao;
	var $medicaoResultadoIdMedicaoResultado;
	var $quantidade;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoAcaoMedicaoResultado = "NULL";
		$this -> planoAcaoIdPlanoAcao = "NULL";
		$this -> medicaoResultadoIdMedicaoResultado = "NULL";
		$this -> quantidade = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoAcaoMedicaoResultado($value) {
		$this -> idPlanoAcaoMedicaoResultado = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoIdPlanoAcao($value) {
		$this -> planoAcaoIdPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMedicaoResultadoIdMedicaoResultado($value) {
		$this -> medicaoResultadoIdMedicaoResultado = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setQuantidade($value) {
		$this -> quantidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addPlanoAcaoMedicaoResultado() Function
	 */
	function addPlanoAcaoMedicaoResultado() {
		$sql = "INSERT INTO planoAcaoMedicaoResultado (planoAcao_idPlanoAcao, medicaoResultado_idMedicaoResultado, quantidade) VALUES ($this->planoAcaoIdPlanoAcao, $this->medicaoResultadoIdMedicaoResultado, $this->quantidade)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deletePlanoAcaoMedicaoResultado() Function
	 */
	function deletePlanoAcaoMedicaoResultado() {
		$sql = "DELETE FROM planoAcaoMedicaoResultado WHERE idPlanoAcaoMedicaoResultado = $this->idPlanoAcaoMedicaoResultado";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPlanoAcaoMedicaoResultado() Function
	 */
	function updateFieldPlanoAcaoMedicaoResultado($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE planoAcaoMedicaoResultado SET " . $field . " = " . $value . " WHERE idPlanoAcaoMedicaoResultado = $this->idPlanoAcaoMedicaoResultado";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePlanoAcaoMedicaoResultado() Function
	 */
	function updatePlanoAcaoMedicaoResultado() {
		$sql = "UPDATE planoAcaoMedicaoResultado SET planoAcao_idPlanoAcao = $this->planoAcaoIdPlanoAcao, medicaoResultado_idMedicaoResultado = $this->medicaoResultadoIdMedicaoResultado, quantidade = $this->quantidade WHERE idPlanoAcaoMedicaoResultado = $this->idPlanoAcaoMedicaoResultado";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPlanoAcaoMedicaoResultado() Function
	 */
	function selectPlanoAcaoMedicaoResultado($where = "") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoMedicaoResultado, planoAcao_idPlanoAcao, medicaoResultado_idMedicaoResultado, quantidade FROM planoAcaoMedicaoResultado " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPlanoAcaoMedicaoResultadoTr() Function
	 */
	function selectPlanoAcaoMedicaoResultadoTr($where = "",$apenasVer) {
		$sql = "SELECT SQL_CACHE idPlanoAcaoMedicaoResultado, planoAcao_idPlanoAcao, MR.medicao, PMR.quantidade ";
		$sql .= " FROM planoAcaoMedicaoResultado AS PMR ";
		$sql .= " INNER JOIN medicaoResultado AS MR ON MR.idMedicaoResultado = PMR.medicaoResultado_idMedicaoResultado " . $where;
//		echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$html .= "<tr>";

				if ($apenasVer != 1) {
								
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/include/form/medicaoResultado.php?id=" . $valor['idPlanoAcaoMedicaoResultado'] . "', '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/medicaoResultado.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '#div_lista_medicaoResultado')\" >" . $valor['medicao'] . "</td>";
				} else {
				$html .= "<td>".$valor['medicao']."</td>";
				}
				
				$html .= "<td>" . $valor['quantidade'] . "</td>";

				if ($apenasVer != 1) {
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "planoAcao/include/acao/medicaoResultado.php', '" . $valor['idPlanoAcaoMedicaoResultado'] . "', '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/medicaoResultado.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '#div_lista_medicaoResultado')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				} else {
				$html .= "<td></td>";
				}

				$html .= "</tr>";
			}
		}
		return $html;

	}

}
?>