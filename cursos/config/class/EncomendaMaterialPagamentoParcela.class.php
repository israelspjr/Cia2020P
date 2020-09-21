<?php
class EncomendaMaterialPagamentoParcela extends Database {
	// class attributes
	var $idEncomendaMaterialPagamentoParcela;
	var $encomendaMaterialGrupoIdEncomendaMaterialGrupo;
	var $parcela;
	var $quitada;
	var $dataReferencia;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idEncomendaMaterialPagamentoParcela = "NULL";
		$this -> encomendaMaterialGrupoIdEncomendaMaterialGrupo = "NULL";
		$this -> parcela = "NULL";
		$this -> quitada = "0";
		$this -> dataReferencia = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdEncomendaMaterialPagamentoParcela($value) {
		$this -> idEncomendaMaterialPagamentoParcela = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEncomendaMaterialGrupoIdEncomendaMaterialGrupo($value) {
		$this -> encomendaMaterialGrupoIdEncomendaMaterialGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setParcela($value) {
		$this -> parcela = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setQuitada($value) {
		$this -> quitada = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataReferencia($value) {
		$this -> dataReferencia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addEncomendaMaterialPagamentoParcela() Function
	 */
	function addEncomendaMaterialPagamentoParcela() {
		$sql = "INSERT INTO encomendaMaterialPagamentoParcela (encomendaMaterialGrupo_idEncomendaMaterialGrupo, parcela, quitada, dataReferencia) VALUES ($this->encomendaMaterialGrupoIdEncomendaMaterialGrupo, $this->parcela, $this->quitada, $this->dataReferencia)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteEncomendaMaterialPagamentoParcela() Function
	 */
	function deleteEncomendaMaterialPagamentoParcela() {
		$sql = "DELETE FROM encomendaMaterialPagamentoParcela WHERE idEncomendaMaterialPagamentoParcela = $this->idEncomendaMaterialPagamentoParcela";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldEncomendaMaterialPagamentoParcela() Function
	 */
	function updateFieldEncomendaMaterialPagamentoParcela($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE encomendaMaterialPagamentoParcela SET " . $field . " = " . $value . " WHERE idEncomendaMaterialPagamentoParcela = $this->idEncomendaMaterialPagamentoParcela";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateEncomendaMaterialPagamentoParcela() Function
	 */
	function updateEncomendaMaterialPagamentoParcela() {
		$sql = "UPDATE encomendaMaterialPagamentoParcela SET encomendaMaterialGrupo_idEncomendaMaterialGrupo = $this->encomendaMaterialGrupoIdEncomendaMaterialGrupo, parcela = $this->parcela, quitada = $this->quitada, dataReferencia = $this->dataReferencia WHERE idEncomendaMaterialPagamentoParcela = $this->idEncomendaMaterialPagamentoParcela";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectEncomendaMaterialPagamentoParcela() Function
	 */
	function selectEncomendaMaterialPagamentoParcela($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idEncomendaMaterialPagamentoParcela, encomendaMaterialGrupo_idEncomendaMaterialGrupo, parcela, quitada, dataReferencia FROM encomendaMaterialPagamentoParcela " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectEncomendaMaterialPagamentoParcelaTr() Function
	 */
	function selectEncomendaMaterialPagamentoParcelaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idEncomendaMaterialPagamentoParcela, encomendaMaterialGrupo_idEncomendaMaterialGrupo, parcela, quitada, dataReferencia FROM encomendaMaterialPagamentoParcela " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idEncomendaMaterialPagamentoParcela'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['idEncomendaMaterialPagamentoParcela'] . "</td>";
				$html .= "<td>" . $valor['encomendaMaterialGrupo_idEncomendaMaterialGrupo'] . "</td>";
				$html .= "<td>" . $valor['parcela'] . "</td>";
				$html .= "<td>" . $valor['quitada'] . "</td>";
				$html .= "<td>" . $valor['dataReferencia'] . "</td>";

				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "/include/acao/EncomendaMaterialPagamentoParcela.php', " . $valor['idEncomendaMaterialPagamentoParcela'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectEncomendaMaterialPagamentoParcelaSelect() Function
	 */
	function selectEncomendaMaterialPagamentoParcelaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idEncomendaMaterialPagamentoParcela, encomendaMaterialGrupo_idEncomendaMaterialGrupo, parcela, quitada, dataReferencia FROM encomendaMaterialPagamentoParcela " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idEncomendaMaterialPagamentoParcela\" name=\"idEncomendaMaterialPagamentoParcela\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idEncomendaMaterialPagamentoParcela'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idEncomendaMaterialPagamentoParcela'] . "\">" . ($valor['idEncomendaMaterialPagamentoParcela']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}

/** ACAO
 require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
 //require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EncomendaMaterialPagamentoParcela.class.php");
 //require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

 $EncomendaMaterialPagamentoParcela = new EncomendaMaterialPagamentoParcela();

 $arrayRetorno = array();

 if($_POST['acao']=="deletar"){

 $arrayRetorno['mensagem'] = MSG_CADDEL;;

 $idEncomendaMaterialPagamentoParcela = $_REQUEST['id'];
 $EncomendaMaterialPagamentoParcela->setIdEncomendaMaterialPagamentoParcela($idEncomendaMaterialPagamentoParcela);
 $EncomendaMaterialPagamentoParcela->deleteEncomendaMaterialPagamentoParcela();

 echo json_encode($arrayRetorno);

 }else{

 $idEncomendaMaterialPagamentoParcela = $_REQUEST['id'];

 $EncomendaMaterialPagamentoParcela->setIdEncomendaMaterialPagamentoParcela($idEncomendaMaterialPagamentoParcela);
 $EncomendaMaterialPagamentoParcela->setIdEncomendaMaterialPagamentoParcela('IdEncomendaMaterialPagamentoParcela');
 $EncomendaMaterialPagamentoParcela->setEncomendaMaterialGrupo_idEncomendaMaterialGrupo('EncomendaMaterialGrupo_idEncomendaMaterialGrupo');
 $EncomendaMaterialPagamentoParcela->setParcela('Parcela');
 $EncomendaMaterialPagamentoParcela->setQuitada('Quitada');
 $EncomendaMaterialPagamentoParcela->setDataReferencia('DataReferencia');
 if($idEncomendaMaterialPagamentoParcela != "" && $idEncomendaMaterialPagamentoParcela > 0 ){
 $EncomendaMaterialPagamentoParcela->updateEncomendaMaterialPagamentoParcela();
 $arrayRetorno['mensagem'] = "Cadastro atualizado com sucesso";
 $arrayRetorno['fecharNivel'] = true;
 }else{
 $idEncomendaMaterialPagamentoParcela = $EncomendaMaterialPagamentoParcela->addEncomendaMaterialPagamentoParcela();
 $arrayRetorno['mensagem'] = "Cadastro efetuado com sucesso";
 $arrayRetorno['fecharNivel'] = true;
 }

 echo json_encode($arrayRetorno);
 }
 Fim acao */
?>