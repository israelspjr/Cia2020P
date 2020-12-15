<?php
class GerenteTem extends Database {
	// class attributes
	var $idGgerenteTem;
	var $gerenteIdGerente;
	var $clientePjIdClientePj;
	var $grupoIdGrupo;
	var $dataCadastro;
	var $dataExclusao;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idGgerenteTem = "NULL";
		$this -> gerenteIdGerente = "NULL";
		$this -> clientePjIdClientePj = "NULL";
		$this -> grupoIdGrupo = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataExclusao = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdGgerenteTem($value) {
		$this -> idGgerenteTem = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setGerenteIdGerente($value) {
		$this -> gerenteIdGerente = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setGrupoIdGrupo($value) {
		$this -> grupoIdGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setDataExclusao($value) {
		$this -> dataExclusao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addGerenteTem() Function
	 */
	function addGerenteTem() {
		$sql = "INSERT INTO gerenteTem (gerente_idGerente, clientePj_idClientePj, grupo_idGrupo, dataCadastro, dataExclusao) VALUES ($this->gerenteIdGerente, $this->clientePjIdClientePj, $this->grupoIdGrupo, $this->dataCadastro, $this->dataExclusao)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteGerenteTem() Function
	 */
	function deleteGerenteTem() {
		$sql = "DELETE FROM gerenteTem WHERE idGgerenteTem = $this->idGgerenteTem";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldGerenteTem() Function
	 */
	function updateFieldGerenteTem($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE gerenteTem SET " . $field . " = " . $value . " WHERE idGgerenteTem = $this->idGgerenteTem";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateGerenteTem() Function
	 */
	function updateGerenteTem() {
		$sql = "UPDATE gerenteTem SET gerente_idGerente = $this->gerenteIdGerente, clientePj_idClientePj = $this->clientePjIdClientePj, grupo_idGrupo = $this->grupoIdGrupo, dataExclusao = $this->dataExclusao WHERE idGgerenteTem = $this->idGgerenteTem";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectGerenteTem() Function
	 */
	function selectGerenteTem($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idGgerenteTem, gerente_idGerente, clientePj_idClientePj, grupo_idGrupo, dataCadastro, dataExclusao FROM gerenteTem " . $where;
		echo $sql;
		return $this -> executeQuery($sql);
	}
	
	function selectGerenteTemBH($where) {
		$sql = "SELECT SQL_CACHE G.idGrupo, PAG.idPlanoAcaoGrupo, G.nome, G.inativo, PA.idPlanoAcao, N.nivel  
    FROM grupo AS G 
    INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo 
    INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao 
    INNER JOIN nivelEstudo AS N ON N.IdNivelEstudo = PA.nivelEstudo_IdNivelEstudo    
    INNER JOIN grupoClientePj AS GC ON GC.grupo_idGrupo = G.idGrupo 
	left JOIN gerenteTem AS GT ON GT.clientePj_idClientePj = GC.clientePj_idClientePj 
	INNER JOIN clientePj AS CL ON CL.idClientePj = GC.clientePj_idClientePj " . $where . " AND GT.dataExclusao is NULL";
	//	echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectGerenteTemTr() Function
	 */
	function selectGerenteTemTr_grupo($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE GT.idGgerenteTem, GT.dataCadastro, GT.dataExclusao, G.nome 
		FROM gerenteTem AS GT
		INNER JOIN grupo AS G ON G.idGrupo = GT.grupo_idGrupo " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idGgerenteTem = $valor['idGgerenteTem'];
				$dataCadastro = Uteis::exibirData($valor['dataCadastro']);
				$dataExclusao = Uteis::exibirData($valor['dataExclusao']);
				$grupo = $valor['nome'];

				$html .= "<tr>";

				$html .= "<td >
				$grupo
				</td>";

				$html .= "<td>" . $dataCadastro . "</td>";

				$html .= "<td>" . $dataExclusao . "</td>";

				$html .= "<td align=\"center\" onclick=\"deletaRegistro('" . CAMINHO_CAD . "gerente/include/acao/gerenteTem.php', '$idGgerenteTem', '$caminhoAtualizar', '$ondeAtualiza')\">
				<img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Excluir\">
				</td>";

				$html .= "</tr>";

			}
		}
		return $html;
	}

	//,
	function selectGerenteTemTr_empresa($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE GT.idGgerenteTem, GT.dataCadastro, GT.dataExclusao, PJ.razaoSocial
		FROM gerenteTem AS GT
		INNER JOIN clientePj AS PJ ON PJ.idClientePj = GT.clientePj_idClientePj " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idGgerenteTem = $valor['idGgerenteTem'];
				$dataCadastro = Uteis::exibirData($valor['dataCadastro']);
				$dataExclusao = Uteis::exibirData($valor['dataExclusao']);
				$razaoSocial = $valor['razaoSocial'];

				$html .= "<tr>";

				$html .= "<td >
				$razaoSocial
				</td>";

				$html .= "<td>" . $dataCadastro . "</td>";

				$html .= "<td>" . $dataExclusao . "</td>";

				$html .= "<td align=\"center\" onclick=\"deletaRegistro('" . CAMINHO_CAD . "gerente//include/acao/gerenteTem.php', '$idGgerenteTem', '$caminhoAtualizar', '$ondeAtualiza')\">
				<img src=\"" . CAMINHO_IMG . "excluir.png\" title=\"Excluir\">
				</td>";

				$html .= "</tr>";

			}
		}
		return $html;

	}

	function selectGerenteTemSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idGgerenteTem, gerente_idGerente, clientePj_idClientePj, grupo_idGrupo, dataCadastro, dataExclusao FROM gerenteTem " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idGgerenteTem\" name=\"idGgerenteTem\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idGgerenteTem'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idGgerenteTem'] . "\">" . ($valor['idGgerenteTem']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectGerenteTem_porGrupo($idPlanoAcaoGrupo) {

		$sql = "SELECT SQL_CACHE F.idFuncionario
		FROM gerenteTem AS GT		
		LEFT JOIN clientePj AS CPJ ON CPJ.idClientePj = GT.clientePj_idClientePj
		LEFT JOIN grupoClientePj AS GCPJ ON GCPJ.clientePj_idClientePj = CPJ.idClientePj AND (GCPJ.dataFim IS NULL OR GCPJ.dataFim = '' OR GCPJ.dataFim >= CURDATE() )
		INNER JOIN grupo AS G ON (G.idGrupo = GT.grupo_idGrupo OR G.idGrupo = GCPJ.grupo_idGrupo)
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo
		INNER JOIN gerente AS GNT ON GNT.idGerente = GT.gerente_idGerente
		INNER JOIN funcionario AS F ON F.idFuncionario = GNT.funcionario_idFuncionario
		WHERE PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND GNT.inativo = 0 AND (GT.dataExclusao IS NULL OR GT.dataExclusao = '' OR GT.dataExclusao >= CURDATE() )";
	//	echo $sql;
		$res = Uteis::executarQuery($sql);
		$idFuncionario = $res[0]['idFuncionario'];

		return $idFuncionario;

	}
	
	function selectGerenteTem_porEmp($idClientePj) {

		$sql = "SELECT SQL_CACHE F.idFuncionario
		FROM gerenteTem AS GT		
		LEFT JOIN clientePj AS CPJ ON CPJ.idClientePj = GT.clientePj_idClientePj
		INNER JOIN gerente AS GNT ON GNT.idGerente = GT.gerente_idGerente
		INNER JOIN funcionario AS F ON F.idFuncionario = GNT.funcionario_idFuncionario
		WHERE CPJ.idClientePj = $idClientePj AND GNT.inativo = 0 AND (GT.dataExclusao IS NULL OR GT.dataExclusao = '' OR GT.dataExclusao >= CURDATE() )";
	//	echo $sql;
		$res = Uteis::executarQuery($sql);
		$idFuncionario = $res[0]['idFuncionario'];

		return $idFuncionario;

	}

	function selectGerenteTem_cor($idPlanoAcaoGrupo) {

		$sql = "SELECT SQL_CACHE GNT.cor FROM gerenteTem AS GT		
		LEFT JOIN clientePj AS CPJ ON CPJ.idClientePj = GT.clientePj_idClientePj
		LEFT JOIN grupoClientePj AS GCPJ ON GCPJ.clientePj_idClientePj = CPJ.idClientePj AND (GCPJ.dataFim IS NULL OR GCPJ.dataFim = '' OR GCPJ.dataFim >= CURDATE() )
		INNER JOIN grupo AS G ON (G.idGrupo = GT.grupo_idGrupo OR G.idGrupo = GCPJ.grupo_idGrupo)
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo
		INNER JOIN gerente AS GNT ON GNT.idGerente = GT.gerente_idGerente
		INNER JOIN funcionario AS F ON F.idFuncionario = GNT.funcionario_idFuncionario
		WHERE PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND (GT.dataExclusao IS NULL OR GT.dataExclusao = '' OR GT.dataExclusao >= CURDATE() )";
		$res = Uteis::executarQuery($sql);
		$cor = $res[0]['cor'];

		return $cor;

	}

}
?>
