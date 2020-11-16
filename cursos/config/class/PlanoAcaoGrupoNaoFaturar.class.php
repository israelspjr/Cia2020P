<?php
class PlanoAcaoGrupoNaoFaturar extends Database {

	// class attributes
	var $idPlanoAcaoGrupoNaoFaturar;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $data;
	var $dataExcluido;
	var $dataCadastro;

	// constructor
	function PlanoAcaoGrupoNaoFaturar() {
		parent::__construct();
		$this -> idPlanoAcaoGrupoNaoFaturar = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> data = "NULL";
		$this -> dataExcluido = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoAcaoGrupoNaoFaturar($value) {
		$this -> idPlanoAcaoGrupoNaoFaturar = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setData($value) {
		$this -> data = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataExcluido($value) {
		$this -> dataExcluido = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function addPlanoAcaoGrupoNaoFaturar() {
		$sql = "INSERT INTO planoAcaoGrupoNaoFaturar (planoAcaoGrupo_idPlanoAcaoGrupo, data, dataExcluido, dataCadastro) 
		VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->data, $this->dataExcluido, $this->dataCadastro)";
		$result = $this -> query($sql);
		return $this->connect;
	}

	function deletePlanoAcaoGrupoNaoFaturar() {
		$sql = "DELETE FROM planoAcaoGrupoNaoFaturar WHERE idPlanoAcaoGrupoNaoFaturar = $this->idPlanoAcaoGrupoNaoFaturar";
		$result = $this -> query($sql);
	}

	function updateFieldPlanoAcaoGrupoNaoFaturar($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE planoAcaoGrupoNaoFaturar SET " . $field . " = " . $value . " WHERE idPlanoAcaoGrupoNaoFaturar = $this->idPlanoAcaoGrupoNaoFaturar";
		$result = $this -> query($sql);
	}

	function updatePlanoAcaoGrupoNaoFaturar() {
		$sql = "UPDATE planoAcaoGrupoNaoFaturar SET planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, data = $this->data, dataExcluido = $this->dataExcluido   
		WHERE idPlanoAcaoGrupoNaoFaturar = $this->idPlanoAcaoGrupoNaoFaturar";
		$result = $this -> query($sql);
	}

	function selectPlanoAcaoGrupoNaoFaturar($where = "WHERE 1") {
		$sql = "SELECT idPlanoAcaoGrupoNaoFaturar, planoAcaoGrupo_idPlanoAcaoGrupo, data, dataExcluido, dataCadastro FROM planoAcaoGrupoNaoFaturar " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}
	
	function selectPlanoAcaoGrupoStatus($where = "WHERE 1") {
		$sql = "SELECT PA.idPlanoAcaoGrupoNaoFaturar, PA.planoAcaoGrupo_idPlanoAcaoGrupo, PA.data, PA.dataExcluido, PA.dataCadastro, F.tipo, F.idFechamentoGrupo, F.dataFechamento FROM planoAcaoGrupoNaoFaturar AS PA
			INNER JOIN fechamentoGrupo AS F on F.planoAcaoGrupo_idPlanoAcaoGrupo = PA.planoAcaoGrupo_idPlanoAcaoGrupo
		 " . $where. " order by F.idFechamentoGrupo Desc";
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectPlanoAcaoGrupoNaoFaturarTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT idPlanoAcaoGrupoNaoFaturar, planoAcaoGrupo_idPlanoAcaoGrupo, data, dataExcluido, dataCadastro FROM planoAcaoGrupoNaoFaturar " . $where;
		$result = $this -> query($sql);
		//echo $sql;

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idPlanoAcaoGrupoNaoFaturar = $valor['idPlanoAcaoGrupoNaoFaturar'];

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/planoAcaoGrupoNaoFaturar.php?id=$idPlanoAcaoGrupoNaoFaturar', '$caminhoAtualizar', '$ondeAtualiza')\"  ";

				$html .= "<tr>
				
				<td >" . strtotime($valor['dataCadastro']) . "</td>
				
				<td $onclick>" . Uteis::exibirData($valor['data']) . "</td>
								
				<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/planoAcaoGrupoNaoFaturar.php', '$idPlanoAcaoGrupoNaoFaturar', '$caminhoAtualizar', '$ondeAtualiza')\" >
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";
			}
		}
		return $html;
	}

	function selectPlanoAcaoGrupoNaoFaturarSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT idPlanoAcaoGrupoNaoFaturar, planoAcaoGrupo_idPlanoAcaoGrupo, data, dataExcluido, dataCadastro FROM planoAcaoGrupoNaoFaturar " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idPlanoAcaoGrupoNaoFaturar\" name=\"idPlanoAcaoGrupoNaoFaturar\"  class=\"" . $classes . "\" >";
		$html = $html . "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPlanoAcaoGrupoNaoFaturar'] ? "selected=\"selected\"" : "";
			$html = $html . "<option " . $selecionado . " value=\"" . $valor['idPlanoAcaoGrupoNaoFaturar'] . "\">" . ($valor['idPlanoAcaoGrupoNaoFaturar']) . "</option>";
		}

		$html = $html . "</select>";
		return $html;
	}

}
?>