<?php
class IntegranteProposta extends Database {
	// class attributes
	var $idIntegranteProposta;
	var $propostaIdProposta;
	var $clientePfIdClientePf;
	var $dataCadastro;
	var $linkVisualizacao;
	var $statusAprovacaoIdStatusAprovacao;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idIntegranteProposta = "NULL";
		$this -> propostaIdProposta = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> linkVisualizacao = "NULL";
		$this -> statusAprovacaoIdStatusAprovacao = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdIntegranteProposta($value) {
		$this -> idIntegranteProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPropostaIdProposta($value) {
		$this -> propostaIdProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setLinkVisualizacao($value) {
		$this -> linkVisualizacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setStatusAprovacaoIdStatusAprovacao($value) {
		$this -> statusAprovacaoIdStatusAprovacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addIntegranteProposta() Function
	 */
	function addIntegranteProposta() {
		$sql = "INSERT INTO integranteProposta (proposta_idProposta, clientePf_idClientePf, dataCadastro, linkVisualizacao, statusAprovacao_idStatusAprovacao) VALUES ($this->propostaIdProposta, $this->clientePfIdClientePf, $this->dataCadastro, $this->linkVisualizacao, $this->statusAprovacaoIdStatusAprovacao)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteIntegranteProposta() Function
	 */
	function deleteIntegranteProposta() {
		$sql = "DELETE FROM integranteProposta WHERE idIntegranteProposta = $this->idIntegranteProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldIntegranteProposta() Function
	 */
	function updateFieldIntegranteProposta($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE integranteProposta SET " . $field . " = " . $value . " WHERE idIntegranteProposta = $this->idIntegranteProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateIntegranteProposta() Function
	 */
	function updateIntegranteProposta() {
		//, dataCadastro = $this->dataCadastro
		$sql = "UPDATE integranteProposta SET proposta_idProposta = $this->propostaIdProposta, clientePf_idClientePf = $this->clientePfIdClientePf, statusAprovacao_idStatusAprovacao = $this->statusAprovacaoIdStatusAprovacao WHERE idIntegranteProposta = $this->idIntegranteProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectIntegranteProposta() Function
	 */
	function selectIntegranteProposta($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idIntegranteProposta, proposta_idProposta, clientePf_idClientePf, dataCadastro, linkVisualizacao, statusAprovacao_idStatusAprovacao FROM integranteProposta " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectIntegrantePropostaTr($where = "") {
		$sql = "SELECT SQL_CACHE idIntegranteProposta, PF.nome, Proposta_idProposta AS idProposta, PF.idClientePf FROM integranteProposta AS IP ";
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
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "proposta/include/acao/integranteProposta.php', " . $valor['idIntegranteProposta'] . ", '" . CAMINHO_VENDAS . "proposta/include/resourceHTML/integranteProposta.php?id=" . $valor['idProposta'] . "', '#div_lista_integranteProposta')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

}
?>