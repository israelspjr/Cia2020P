<?php
class FechamentoGrupo extends Database {
	// class attributes
	var $idFechamentoGrupo;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $dataFechamento;
	var $obs;
	var $inativo;
	var $tipo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idFechamentoGrupo = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> dataFechamento = "NULL";
		$this -> obs = "NULL";
		$this -> inativo = "NULL";
		$this -> tipo = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdFechamentoGrupo($value) {
		$this -> idFechamentoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataFechamento($value) {
		$this -> dataFechamento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addFechamentoGrupo() Function
	 */
	function addFechamentoGrupo() {
		$sql = "INSERT INTO fechamentoGrupo (planoAcaoGrupo_idPlanoAcaoGrupo, dataFechamento, obs, inativo, tipo) VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->dataFechamento, $this->obs, $this->inativo, $this->tipo)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteFechamentoGrupo() Function
	 */
	function deleteFechamentoGrupo() {

		$FechamentoGrupoItenMotivoFechamento = new FechamentoGrupoItenMotivoFechamento();
		$FechamentoGrupoItenMotivoFechamento -> deleteFechamentoGrupoItenMotivoFechamento(" OR (fechamentoGrupo_idFechamentoGrupo = " . $this -> idFechamentoGrupo . ")");

		$sql = "DELETE FROM fechamentoGrupo WHERE idFechamentoGrupo = $this->idFechamentoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldFechamentoGrupo() Function
	 */
	function updateFieldFechamentoGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE fechamentoGrupo SET " . $field . " = " . $value . " WHERE idFechamentoGrupo = $this->idFechamentoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFechamentoGrupo() Function
	 */
	function updateFechamentoGrupo() {
		$sql = "UPDATE fechamentoGrupo SET planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, dataFechamento = $this->dataFechamento, obs = $this->obs, inativo = $this->inativo, tipo = $this->tipo  WHERE idFechamentoGrupo = $this->idFechamentoGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectFechamentoGrupo() Function
	 */
	function selectFechamentoGrupo($where = "WHERE 1") {

		$sql = "SELECT SQL_CACHE idFechamentoGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, dataFechamento, obs, inativo, tipo FROM fechamentoGrupo " . $where;
//	echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectFechamentoGrupoTr() Function
	 */
	function selectFechamentoGrupoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $soexibir = 0) {

		$sql = "SELECT SQL_CACHE idFechamentoGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, dataFechamento, obs, inativo, tipo FROM fechamentoGrupo " . $where;
//		echo $sql;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idFechamentoGrupo = $valor['idFechamentoGrupo'];
				//$idPlanoAcaoGrupo = $valor['planoAcaoGrupo_idPlanoAcaoGrupo'];
				$dataFechamento = Uteis::exibirData($valor['dataFechamento']);
				echo $dataFechamento;
				$tipo = $valor['tipo'];

				$onclick = "onclick=\"abrirNivelPagina(this, '$caminhoAbrir?id=$idFechamentoGrupo', '$caminhoAtualizar', '$ondeAtualiza')\"";

				$html .= "<tr>
				
				<td $onclick >" . $dataFechamento . "</td>
				
				<td $onclick >" . $this -> retornaTipo($tipo) . "</td>";				
				
				if ($soexibir == 0) {
				
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_REL . "grupo/include/acao/fechamentoGrupo.php', '$idFechamentoGrupo', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>";
				
				} else {
					
				$html .= "<td> </td>";	
				
				}
								
				$html .= "</tr>";

			}
		}
		return $html;
	}

	/**
	 * selectFechamentoGrupoSelect() Function
	 */
	function selectFechamentoGrupoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idFechamentoGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, dataFechamento, obs, inativo, tipo FROM fechamentoGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idFechamentoGrupo\" name=\"idFechamentoGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idFechamentoGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idFechamentoGrupo'] . "\">" . ($valor['idFechamentoGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function retornaTipo($tipo) {
		switch ($tipo) {
			case 1 :
				return "Fechamento";
				break;
			case 2 :
				return "Reversão";
				break;
			case 3 :
				return "Pendente";
				break;
			default :
				return "";
		}
	}
	
	function getDataFechamento($idPlanoAcaoGrupo) {
		$valor = $this->selectFechamentoGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo =".$idPlanoAcaoGrupo." AND tipo = 2");
			if ($valor[0]['dataFechamento']) {
		//		return $rs;
			} else {
		$valor = $this->selectFechamentoGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo =".$idPlanoAcaoGrupo." AND tipo = 1");
		if ($valor[0]['dataFechamento'] != '') {
			$rs = date("Y-m-d", strtotime($valor[0]['dataFechamento']));
		}
	//	return $rs;	
			}
	//	Uteis::pr($rs);	
		return $rs;
		
	}

}
?>