<?php
class RegistroDeAnotacoes extends Database {
	// class attributes
	var $idRegistroDeAnotacoes;
	var $propostaIdProposta;
	var $planoAcaoIdPlanoAcao;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $titulo;
    var $financeiro;
	var $anotacao;
	var $dataCadastro;
	var $dataNovoContato;
	var $clientePjIdClientePj;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idRegistroDeAnotacoes = "NULL";
		$this -> propostaIdProposta = "NULL";
		$this -> planoAcaoIdPlanoAcao = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> titulo = "NULL";
		$this -> anotacao = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataNovoContato = "NULL";
        $this -> financeiro = "0";
		$this -> clientePjIdClientePj = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdRegistroDeAnotacoes($value) {
		$this -> idRegistroDeAnotacoes = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPropostaIdProposta($value) {
		$this -> propostaIdProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoIdPlanoAcao($value) {
		$this -> planoAcaoIdPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTitulo($value) {
		$this -> titulo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAnotacao($value) {
		$this -> anotacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setDataNovoContato($value) {
		$this -> dataNovoContato = ($value) ? $this -> gravarBD($value) : "NULL";
	}
    
    function setFinanceiro($value) {
        $this -> financeiro = ($value) ? $this -> gravarBD($value) : "0";
    }
	
	function setClientePjIdClientePj($value) {
        $this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "0";
    }
	/**
	 * addRegistroDeAnotacoes() Function
	 */
	function addRegistroDeAnotacoes() {
		$sql = "INSERT INTO registroDeAnotacoes (proposta_idProposta, planoAcao_idPlanoAcao, planoAcaoGrupo_idPlanoAcaoGrupo, titulo, anotacao, dataCadastro, dataNovoContato, financeiro, clientePj_idClientePj) VALUES ($this->propostaIdProposta, $this->planoAcaoIdPlanoAcao, $this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->titulo, $this->anotacao, $this->dataCadastro, $this->dataNovoContato, $this->financeiro, $this->clientePjIdClientePj)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteRegistroDeAnotacoes() Function
	 */
	function deleteRegistroDeAnotacoes() {
		$sql = "DELETE FROM registroDeAnotacoes WHERE idRegistroDeAnotacoes = $this->idRegistroDeAnotacoes";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldRegistroDeAnotacoes() Function
	 */
	function updateFieldRegistroDeAnotacoes($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE registroDeAnotacoes SET " . $field . " = " . $value . " WHERE idRegistroDeAnotacoes = $this->idRegistroDeAnotacoes";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateRegistroDeAnotacoes() Function
	 */
	function updateRegistroDeAnotacoes() {
		$sql = "UPDATE registroDeAnotacoes SET proposta_idProposta = $this->propostaIdProposta, planoAcao_idPlanoAcao = $this->planoAcaoIdPlanoAcao, planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, titulo = $this->titulo, anotacao = $this->anotacao, dataNovoContato = $this->dataNovoContato, financeiro = $this->financeiro, clientePj_idClientePj = $this->clientePjIdClientePj WHERE idRegistroDeAnotacoes = $this->idRegistroDeAnotacoes";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectRegistroDeAnotacoes() Function
	 */
	function selectRegistroDeAnotacoes($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idRegistroDeAnotacoes, proposta_idProposta, planoAcao_idPlanoAcao, planoAcaoGrupo_idPlanoAcaoGrupo, titulo, anotacao, dataCadastro, dataNovoContato, financeiro, clientePj_idClientePj FROM registroDeAnotacoes " . $where;
		return $this -> executeQuery($sql);
	}

	function selectRegistroDeAnotacoesTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "",$apenasVer) {

		$sql = "SELECT SQL_CACHE idRegistroDeAnotacoes, titulo, anotacao, dataNovoContato, dataCadastro, financeiro, clientePj_idClientePj FROM registroDeAnotacoes " . $where;
	//	echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				
				if ($apenasVer != 1) {
				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idRegistroDeAnotacoes'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" ";
				}
				
				$html .= "<tr >
				
				<td ></td>
				
				<td $onclick >" . $valor['titulo'] . "</td>
				<td $onclick >" . $valor['anotacao'] . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataCadastro']) . "</td>
				
				<td $onclick >" . Uteis::exibirData($valor['dataNovoContato']) . "</td>
				
				<td $onclick >" . Uteis::exibirStatus($valor['financeiro']). "</td>
				
				<td>";
				if ($apenasVer != 1) {
				$html .= "	<center><img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . CAMINHO_CAD . "registroDeAnotacoes/include/acao/registroDeAnotacoes.php', " . $valor['idRegistroDeAnotacoes'] . ", '$caminhoAtualizar', '$ondeAtualiza')\" ></center>";
				}
				$html .= "</td>
				
				</tr>";
			}
		}
		
		return $html;
	}

}
?>