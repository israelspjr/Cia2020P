<?php
class IntermediarioProposta extends Database {
	// class attributes
	var $idIntermediarioProposta;
	var $clientePfIdClientePf;
	var $propostaIdProposta;
	var $statusAprovacaoIdStatusAprovacao;
	var $dataCadastro;
	var $linkVisualizacao;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idIntermediarioProposta = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> propostaIdProposta = "NULL";
		$this -> statusAprovacaoIdStatusAprovacao = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> linkVisualizacao = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdIntermediarioProposta($value) {
		$this -> idIntermediarioProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPropostaIdProposta($value) {
		$this -> propostaIdProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setStatusAprovacaoIdStatusAprovacao($value) {
		$this -> statusAprovacaoIdStatusAprovacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setLinkVisualizacao($value) {
		$this -> linkVisualizacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addIntermediarioProposta() Function
	 */
	function addIntermediarioProposta() {
		$sql = "INSERT INTO intermediarioProposta (clientePf_idClientePf, proposta_idProposta, statusAprovacao_idStatusAprovacao, dataCadastro, linkVisualizacao) VALUES ($this->clientePfIdClientePf, $this->propostaIdProposta, $this->statusAprovacaoIdStatusAprovacao, $this->dataCadastro, $this->linkVisualizacao)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteIntermediarioProposta() Function
	 */
	function deleteIntermediarioProposta() {
		$sql = "DELETE FROM intermediarioProposta WHERE idIntermediarioProposta = $this->idIntermediarioProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldIntermediarioProposta() Function
	 */
	function updateFieldIntermediarioProposta($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE intermediarioProposta SET " . $field . " = " . $value . " WHERE idIntermediarioProposta = $this->idIntermediarioProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateIntermediarioProposta() Function
	 */
	function updateIntermediarioProposta() {
		$sql = "UPDATE intermediarioProposta SET clientePf_idClientePf = $this->clientePfIdClientePf, proposta_idProposta = $this->propostaIdProposta, statusAprovacao_idStatusAprovacao = $this->statusAprovacaoIdStatusAprovacao WHERE idIntermediarioProposta = $this->idIntermediarioProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectIntermediarioProposta() Function
	 */
	function selectIntermediarioProposta($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idIntermediarioProposta, clientePf_idClientePf, proposta_idProposta, statusAprovacao_idStatusAprovacao, dataCadastro, linkVisualizacao FROM intermediarioProposta " . $where;
		return $this -> executeQuery($sql);
	}

	function selectIntermediarioPropostaTr($where = "") {
		$sql = "SELECT SQL_CACHE idIntermediarioProposta, Proposta_idProposta AS idProposta, PF.nome, PF.idClientePf FROM intermediarioProposta AS IP ";
		$sql .= " INNER JOIN clientePf AS PF ON PF.idClientePf = IP.clientePf_idClientePf " . $where;
		//echo $sql;
		//exit;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr >";

				$img = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"IR PARA O CADASTRO\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/cadastro.php?id=" . $valor['idClientePf'] . "', '" . CAMINHO_VENDAS . "proposta/include/resourceHTML/integranteProposta.php?id=" . $valor['idProposta'] . "', '#div_lista_integranteProposta')\" >";
				$html .= "<td>" . $img . $valor['nome'] . "</td>";

				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "proposta/include/acao/intermediarioProposta.php', " . $valor['idIntermediarioProposta'] . ", '" . CAMINHO_VENDAS . "proposta/include/resourceHTML/intermediarioProposta.php?id=" . $valor['idProposta'] . "', '#div_lista_intermediarioProposta')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

}
?>