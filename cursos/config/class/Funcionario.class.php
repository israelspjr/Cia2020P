<?php
class Funcionario extends Database {
	// class attributes
	var $idFuncionario; 
	var $estadoCivilIdEstadoCivil;
	var $paisIdPais;
	var $nome;
	var $nomeExibicao;
	var $sexo;
	var $dataNascimento;
	var $rg;
	var $tipoDocumentoUnicoIdTipoDocumentoUnico;
	var $documentoUnico;
	var $senhaAcesso;
	var $obs;
	var $inativo;
	var $foto;
	var $cargo;
	var $admicao;
	var $demicao;
	var $excluido;
	var $horasTrabalho;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idFuncionario = "NULL";   
		$this -> estadoCivilIdEstadoCivil = "NULL";
		$this -> paisIdPais = "NULL";
		$this -> nome = "NULL";
		$this -> nomeExibicao = "NULL";
		$this -> sexo = "NULL";
		$this -> dataNascimento = "NULL";
		$this -> rg = "NULL";
		$this -> tipoDocumentoUnicoIdTipoDocumentoUnico = "NULL";
		$this -> documentoUnico = "NULL";
		$this -> senhaAcesso = "NULL";
		$this -> obs = "NULL";
		$this -> inativo = "NULL";
		$this -> foto = "NULL";
		$this -> cargo = "NULL";
		$this -> admicao = "NULL";
		$this -> demicao = "NULL";
		$this -> excluido = "0";
		$this -> horasTrabalho = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdFuncionario($value) {
		$this -> idFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
	}

 	function setEstadoCivilIdEstadoCivil($value) {
		$this -> estadoCivilIdEstadoCivil = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPaisIdPais($value) {
		$this -> paisIdPais = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNomeExibicao($value) {
		$this -> nomeExibicao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSexo($value) {
		$this -> sexo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataNascimento($value) {
		$this -> dataNascimento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setRg($value) {
		$this -> rg = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipoDocumentoUnicoIdTipoDocumentoUnico($value) {
		$this -> tipoDocumentoUnicoIdTipoDocumentoUnico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDocumentoUnico($value) {
		$this -> documentoUnico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setSenhaAcesso($value) {		  
		$value = EncryptSenha::B64_Encode($value);	
		$this -> senhaAcesso = ($value) ? $this -> gravarBD($value) : "NULL";
		
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setFoto($value) {
		$this -> foto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCargo($value) {
		$this -> cargo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAdmicao($value) {
		$this -> admicao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDemicao($value) {
		$this -> demicao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setHorasTrabalho($value) {
		$this -> horasTrabalho = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addFuncionario() Function
	 */
	function addFuncionario() {
		$sql = "INSERT INTO funcionario (estadoCivil_idEstadoCivil, pais_idPais, nome, nomeExibicao, sexo, dataNascimento, rg, tipoDocumentoUnico_idTipoDocumentoUnico, documentoUnico, senhaAcesso, obs, inativo, foto, cargo, admicao, demicao, excluido, horasTrabalho) VALUES ($this->estadoCivilIdEstadoCivil, $this->paisIdPais, $this->nome, $this->nomeExibicao, $this->sexo, $this->dataNascimento, $this->rg, $this->tipoDocumentoUnicoIdTipoDocumentoUnico, $this->documentoUnico, $this->senhaAcesso, $this->obs, $this->inativo, $this->foto, $this->cargo, $this->admicao, $this->demicao, $this->excluido,$this->horasTrabalho)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}
  function addFuncionario_M() {
    $sql = "INSERT INTO funcionario (idFuncionario, estadoCivil_idEstadoCivil, pais_idPais, nome, nomeExibicao, sexo, dataNascimento, rg, tipoDocumentoUnico_idTipoDocumentoUnico, documentoUnico, senhaAcesso, obs, inativo, foto, cargo, admicao, demicao, excluido, horasTrabalho) VALUES ($this->idFuncionario, $this->estadoCivilIdEstadoCivil, $this->paisIdPais, $this->nome, $this->nomeExibicao, $this->sexo, $this->dataNascimento, $this->rg, $this->tipoDocumentoUnicoIdTipoDocumentoUnico, $this->documentoUnico, $this->senhaAcesso, $this->obs, $this->inativo, $this->foto, $this->cargo, $this->admicao, $this->demicao, $this->excluido, $this->horasTrabalho)";
    $result = $this -> query($sql, true);
    return $this -> connect;
  }

	/**
	 * deleteFuncionario() Function
	 */
	function deleteFuncionario() {
		$sql = "DELETE FROM funcionario WHERE idFuncionario = $this->idFuncionario";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldFuncionario() Function
	 */
	function updateFieldFuncionario($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE funcionario SET " . $field . " = " . $value . " WHERE idFuncionario = $this->idFuncionario";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFuncionario() Function
	 */
	function updateFuncionario() {
		$sql = "UPDATE funcionario SET estadoCivil_idEstadoCivil = $this->estadoCivilIdEstadoCivil, pais_idPais = $this->paisIdPais, nome = $this->nome, nomeExibicao = $this->nomeExibicao, sexo = $this->sexo, dataNascimento = $this->dataNascimento, rg = $this->rg, tipoDocumentoUnico_idTipoDocumentoUnico = $this->tipoDocumentoUnicoIdTipoDocumentoUnico, documentoUnico = $this->documentoUnico, senhaAcesso = $this->senhaAcesso, obs = $this->obs, inativo = $this->inativo, foto = $this->foto, cargo = $this->cargo, admicao = $this->admicao, demicao = $this->demicao, horasTrabalho = $this->horasTrabalho WHERE idFuncionario = $this->idFuncionario";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectFuncionario() Function
	 */
	function selectFuncionario($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idFuncionario, estadoCivil_idEstadoCivil, pais_idPais, nome, nomeExibicao, sexo, dataNascimento, rg, tipoDocumentoUnico_idTipoDocumentoUnico, documentoUnico, senhaAcesso, obs, inativo, foto, cargo, admicao, demicao, horasTrabalho  FROM funcionario " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectFuncionarioTr() Function
	 */
	function selectFuncionarioTr($where = "", $colunas = array()) {
		$sql = "SELECT SQL_CACHE idFuncionario, nome, inativo, cargo FROM funcionario WHERE excluido = 0 " . $where;
		//echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			while ($valor = mysqli_fetch_array($result)) {

				$caminhoAtualizar = CAMINHO_CAD . "funcionario/index.php";

				$html .= "<tr>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "funcionario/cadastro.php?id=" . $valor['idFuncionario'] . "', '$caminhoAtualizar', '#centro')\" >" . $valor['nome'] . "</td>";

				$html .= "<td>" . $valor['cargo'] . "</td>";

				$html .= "<td align=\"center\">" . Uteis::exibirStatus(!$valor['inativo']) . "</td>";

				$html .= "<td align=\"center\" onclick=\"deletaRegistro('" . CAMINHO_CAD . "funcionario/include/acao/funcionario.php', " . $valor['idFuncionario'] . ", '$caminhoAtualizar', '#centro')\">" . "<img src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";

				$html .= "</tr>";
			}
		}

		return $html;
	}

	function selectFuncionarioTr_permissao($where = "") {
		$sql = "SELECT SQL_CACHE idFuncionario, nome, inativo, cargo FROM funcionario WHERE excluido = 0 " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			while ($valor = mysqli_fetch_array($result)) {

				$html .= "<tr>";

				$html .= "<td 
				onclick=\"abrirNivelPagina(this, '" . CAMINHO_MODULO . "configuracoes/permissaoModulo/formulario.php?id=" . $valor['idFuncionario'] . "', '" . CAMINHO_MODULO . "configuracoes/permissaoModulo/filtro.php', '#centro')\" 
				>" . $valor['nome'] . "</td>";

				$html .= "<td>" . $valor['cargo'] . "</td>";

				$html .= "</tr>";
			}
		}

		return $html;
	}

	function selectFuncionarioSelect($idAtual = 0, $classes = "", $and = "") {
		$sql = "SELECT SQL_CACHE idFuncionario, nome, inativo, cargo FROM funcionario ";
		$sql .= " WHERE inativo = 0 AND excluido = 0 " . $and . " ORDER BY nome";
		$result = $this -> query($sql);
		//echo $sql; 
		//exit;
		$html = "<select id=\"idFuncionario\" name=\"idFuncionario\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idFuncionario'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idFuncionario'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
	
	function selectFuncionarioCheckbox($idAtual = 0, $classes = "", $and = "") {
		
		$PermissaoModulo = new PermissaoModulo();
		$sql = "SELECT SQL_CACHE idFuncionario, nome, inativo, cargo FROM funcionario ";
		$sql .= " WHERE inativo = 0 AND excluido = 0 " . $and . " ORDER BY nome";
		$result = $this -> query($sql);
    	while ($valor = mysqli_fetch_array($result)) {
			
			$rs = $PermissaoModulo->selectPermissaoModulo(" WHERE funcionario_idFuncionario = ".$valor['idFuncionario']." AND modulo_idModulo = ".$idAtual);
			
			if($rs) {
				$selecionado = "checked=\"checked\"";
			} else {
				$selecionado = "";
			}
			$html .= "<div><input type=\"checkbox\" id=\"idFuncionario\" name=\"idFuncionario[]\" " . $selecionado . " value=\"" . $valor['idFuncionario'] . "\">" . ($valor['nome']) . "</></div>";
		}
//		$html .= "</select>";
		return $html;
	}

	/**
	 * selectFuncionarioSelect() Function
	 */
	function selectFuncionarioSelectRepresentante($classes = "", $idAtual = 0, $and = "") {
		$sql = "SELECT SQL_CACHE idFuncionario, nome FROM funcionario  WHERE inativo = 0 " . $and . " ORDER BY nome";
		$result = $this -> query($sql);
		$html = "<select id=\"idFuncionario\" name=\"idFuncionario\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idFuncionario'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idFuncionario'] . "\">" . ($valor['nome']) . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function getNome($id) {
		$rs = $this -> selectFuncionario(" WHERE idFuncionario = $id");
		return $rs[0]['nome'];
	}

	function getEmail($idFuncionario) {

		$emails = array();

		$sql = " SELECT E.valor, E.ePrinc FROM funcionario AS F 
		INNER JOIN enderecoVirtual AS E ON E.funcionario_idFuncionario = F.idFuncionario AND E.tipoEnderecoVirtual_idTipoEnderecoVirtual = 1 		
		WHERE E.ePrinc = 1 AND F.idFuncionario = " . $idFuncionario;
		//echo "//".$sql;exit;
		$result = $this -> query($sql);
		while ($valor = mysqli_fetch_array($result)) {
			$emails = $valor['valor'];
		}
		return $emails;
	}

	function select_gerentePorEmpresa($idClientePj, $idFuncionario = "", $class = "") {

		$sql = "SELECT DISTINCT(F.idFuncionario), F.nome  
		FROM clientePf AS C 	
		INNER JOIN gerenteTem AS GT ON GT.clientePj_idClientePj = C.clientePj_idClientePj
			AND (dataExclusao IS NULL OR dataExclusao = '')
		INNER JOIN gerente AS G ON G.idGerente = GT.gerente_idGerente 
		INNER JOIN funcionario AS F ON F.idFuncionario = G.funcionario_idFuncionario 
		WHERE C.clientePj_idClientePj = $idClientePj";
		$result = $this -> query($sql);

		$html = "<select id=\"idFuncionario\" name=\"idFuncionario\" class=\"$class\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idFuncionario == $valor['idFuncionario'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idFuncionario'] . "\">" . ($valor['nome']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>