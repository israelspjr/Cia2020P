<?php
class ClientePj extends Database {
	// class attributes
	var $idClientePj;
    var $id_migracao;
	var $tipoClienteIdTipoCliente;
	var $razaoSocial;
	var $nomeFantasia;
	var $cnpj;
	var $inscricaoEstadual;
	var $logo;
	var $senhaAcesso;
	var $inativo;
	var $frequenciaMinimaExigida;
	var $faltaJustificadaPresenca;
	var $obs;
	var $dataCadastro;
	var $dataContratacao;
	var $excluido;
	var $clientePjIdClientePj;
	var $intGrupo;
	var $empresaIndica;
	var $potencial;
	var $conheceu;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idClientePj = "NULL";
        $this -> id_migracao = "NULL";
		$this -> tipoClienteIdTipoCliente = "NULL";
		$this -> razaoSocial = "NULL";
		$this -> nomeFantasia = "NULL";
		$this -> cnpj = "NULL";
		$this -> inscricaoEstadual = "NULL";
		$this -> logo = "NULL";
		$this -> senhaAcesso = "NULL";
		$this -> inativo = "NULL";
		$this -> frequenciaMinimaExigida = "75";
		$this -> faltaJustificadaPresenca = "NULL";
		$this -> obs = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataContratacao = "NULL";
		$this -> excluido = "0";
		$this -> clientePjIdClientePj = "0";
		$this -> intGrupo = "0";
		$this -> empresaIndica = "0";
		$this -> potencial = "0";
		$this -> conheceu = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdClientePj($value) {
		$this -> idClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}
 
 	function setId_migracao($value) {
    	$this -> id_migracao = ($value) ? $this -> gravarBD($value) : "NULL";
  	}
	
	function setTipoClienteIdTipoCliente($value) {
		$this -> tipoClienteIdTipoCliente = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setRazaoSocial($value) {
		$this -> razaoSocial = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNomeFantasia($value) {
		$this -> nomeFantasia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCnpj($value) {
		$this -> cnpj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInscricaoEstadual($value) {
		$this -> inscricaoEstadual = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setLogo($value) {
		$this -> logo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSenhaAcesso($value) {
		$value = EncryptSenha::B64_Encode($value);  
		$this -> senhaAcesso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setFrequenciaMinimaExigida($value) {
		$this -> frequenciaMinimaExigida = ($value) ? $this -> gravarBD($value) : "75";
	}

	function setFaltaJustificadaPresenca($value) {
		$this -> faltaJustificadaPresenca = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setDataContratacao($value) {
		$this -> dataContratacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setIntGrupo($value) {
		$this -> intGrupo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setEmpresaIndica($value) {
		$this -> empresaIndica = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setPotencial($value) {
		$this -> potencial = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setConheceu($value) {
		$this -> conheceu = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addClientePj() Function
	 */
	function addClientePj() {
		$sql = "INSERT INTO clientePj (clientePj_idClientePj, id_migracao, tipoCliente_idTipoCliente, razaoSocial, nomeFantasia, cnpj, inscricaoEstadual, logo, senhaAcesso, inativo, frequenciaMinimaExigida, faltaJustificadaPresenca, obs, dataCadastro, dataContratacao, excluido, intGrupo, empresaIndica, potencial, conheceu) VALUES ($this->clientePjIdClientePj, $this->id_migracao, $this->tipoClienteIdTipoCliente, $this->razaoSocial, $this->nomeFantasia, $this->cnpj, $this->inscricaoEstadual, $this->logo, $this->senhaAcesso, $this->inativo, $this->frequenciaMinimaExigida, $this->faltaJustificadaPresenca, $this->obs, $this->dataCadastro, $this->dataContratacao, $this->excluido, $this->intGrupo, $this->empresaIndica, $this->potencial, $this->conheceu)";
		//echo "$sql";exit;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteClientePj() Function
	 */
	function deleteClientePj() {
		$sql = "DELETE FROM clientePj WHERE idClientePj = $this->idClientePj";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldClientePj() Function
	 */
	function updateFieldClientePj($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE clientePj SET " . $field . " = " . $value . " WHERE idClientePj = $this->idClientePj";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateClientePj() Function
	 */
	function updateClientePj() {
		$sql = "UPDATE clientePj SET clientePj_idClientePj = $this->clientePjIdClientePj, tipoCliente_idTipoCliente = $this->tipoClienteIdTipoCliente, razaoSocial = $this->razaoSocial, nomeFantasia = $this->nomeFantasia, cnpj = $this->cnpj, inscricaoEstadual = $this->inscricaoEstadual, logo = $this->logo, senhaAcesso = $this->senhaAcesso, inativo = $this->inativo, frequenciaMinimaExigida = $this->frequenciaMinimaExigida, faltaJustificadaPresenca = $this->faltaJustificadaPresenca, obs = $this->obs, dataContratacao = $this->dataContratacao, intGrupo = $this->intGrupo, empresaIndica = $this->empresaIndica, potencial = $this->potencial, conheceu = $this->conheceu WHERE idClientePj = $this->idClientePj";
	//	echo $sql;
		$result = $this -> query($sql, true);
	}

	/**
	 * selectClientePj() Function
	 */
	function selectClientePj($where = "") {
		$sql = "SELECT SQL_CACHE idClientePj, clientePj_idClientePj, id_migracao, tipoCliente_idTipoCliente, razaoSocial, nomeFantasia, cnpj, inscricaoEstadual, logo, senhaAcesso, inativo, frequenciaMinimaExigida, faltaJustificadaPresenca, obs, dataCadastro, dataContratacao, intGrupo, empresaIndica, potencial, conheceu FROM clientePj " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectClientePjSelect() Function
	 */
	function selectClientePjSelect($idAtual = 0, $classes = "", $and = "", $id2 = "") {
		$sql = "SELECT SQL_CACHE idClientePj, razaoSocial FROM clientePj ";
		$sql .= " WHERE excluido = 0 " . $and . " ORDER BY razaoSocial";
		$result = $this -> query($sql);
		//echo $sql;
		$html = "<select id=\"clientePj_idClientePj".$id2."\" name=\"clientePj_idClientePj".$id2."\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idClientePj'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idClientePj'] . "\" title=\"".$valor['razaoSocial']."\" >" . Uteis::resumir($valor['razaoSocial']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function selectClientePjSelectFilha($idAtual = 0, $classes = "", $and = "") {
		$sql = "SELECT SQL_CACHE idClientePj, clientePj_idClientePj, razaoSocial FROM clientePj ";
		$sql .= " WHERE excluido = 0 " . $and . " ORDER BY razaoSocial";
		$result = $this -> query($sql);
	//	echo $sql;
		$html = "<select id=\"subEmpresa\" name=\"subEmpresa\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idClientePj'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idClientePj'] . "\" title=\"".$valor['razaoSocial']."\" >" . Uteis::resumir($valor['razaoSocial']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectClientePjSelectMult($idAtual = 0, $classes = "", $and = "") {		
		$sql = "SELECT SQL_CACHE CPJ.idClientePj, CPJ.razaoSocial FROM clientePj AS CPJ WHERE CPJ.excluido = 0 " . $and . " ORDER BY razaoSocial";
		$result = $this -> query($sql);
		//echo $sql;
		$html = "<select id=\"clientePj_idClientePj\" name=\"clientePj_idClientePj[]\" class=\"" . $classes . "\" multiple=\"multiple\" >";
		$html .= "<option value=\"\">Todos</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idClientePj'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idClientePj'] . "\" title=\"".$valor['razaoSocial']."\" >" . Uteis::resumir($valor['razaoSocial']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	/**
	 * selectClientepjTr() Function
	 */
	function selectClientepjTr($where = "", $apenasLinha = false) {

		$sql = "SELECT SQL_CACHE idClientePj, razaoSocial, inativo, cnpj, empresaIndica FROM clientePj WHERE excluido = 0 " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";
			$cont = 0;

			while ($valor = mysqli_fetch_array($result)) {

				$idClientePj = $valor['idClientePj'];
				$razaoSocial = $valor['razaoSocial'];
				$cnpj = $valor['cnpj'];
				$ativo = Uteis::exibirStatus(!$valor['inativo']);
				$empresaIndica = $valor['empresaIndica'];
				
				if ($empresaIndica == 1) {
					$nomeExt = "<img src=\"".CAMINHO_IMG."diamante.png\" width=\"18\" height=\"18\" title=\"Aluno Indica\" >";
					
				}
				

				$caminhoAtualizar = CAMINHO_CAD . "clientePj/index.php";
				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePj/cadastro.php?id=" . $idClientePj . "', '$caminhoAtualizar?tr=1&idClientePj=" . $idClientePj . "&ordem=" . ($cont++) . "', 'tr')\" ";
				$delete = "<center><img src=\"" . CAMINHO_IMG . "excluir.png\" 
				onclick=\"deletaRegistro('" . CAMINHO_CAD . "clientePj/include/acao/clientePj.php', '.$idClientePj', '$caminhoAtualizar', '#centro')\" /></center>";

				if ($apenasLinha) {

					$col = array();

					$col[] = $razaoSocial . $nomeExt;
					$col[] = $cnpj;
					$col[] = $ativo;
					$col[] = $delete;

					$html = $col;
					break;

				} else {

					$html .= "<tr >";

					$html .= "<td $onclick>" . $razaoSocial . $nomeExt."</td>";

					$html .= "<td $onclick>" . $cnpj . "</td>";

					$html .= "<td $onclick>" . $ativo . "</td>";

					$html .= "<td >" . $delete . "</td>";

					$html .= "</tr>";

				}
			}
		}

		return $html;
	}

	function getEmail($id) {

		$emails = array();

		$sql = " SELECT E.valor, E.ePrinc FROM clientePj AS C		
		INNER JOIN contatoAdicional AS CA ON CA.clientePj_idClientePj = C.idClientePj		
		INNER JOIN enderecoVirtual AS E ON E.contatoAdicional_idContatoAdicional = CA.idContatoAdicional AND E.tipoEnderecoVirtual_idTipoEnderecoVirtual = 1
		WHERE E.ePrinc = 1 AND C.idClientePj = " . $id;
		$result = $this -> query($sql);
		while ($valor = mysqli_fetch_array($result)) {
			$emails[] = $valor['valor'];
		}
		return $emails;
	}

	function getIdClientePj_porGrupo($idGrupo) {
		$GrupoClientePj = new GrupoClientePj();
		$valor = $GrupoClientePj -> selectGrupoClientePj(" WHERE (dataFim IS NULL OR dataFim = '') AND grupo_idGrupo = " . $idGrupo);
		return $valor[0]['clientePj_idClientePj'] ? $valor[0]['clientePj_idClientePj'] : "0";
	}

	function getNome($id) {
		$rs = $this -> selectClientePj(" WHERE idClientePj = $id");
		return $rs[0]['razaoSocial'];
	}
	
	function get_faltaJustificadaPresenca($id){
		$rs = $this->selectClientePj(" WHERE idClientePj = $id");
		return $rs[0]['faltaJustificadaPresenca']; 
	}	
	
	function getFME($id) {
		$rs = $this->selectClientePj(" WHERE idClientePj = $id");
		return $rs[0]['frequenciaMinimaExigida']; 
	}
}
?>
