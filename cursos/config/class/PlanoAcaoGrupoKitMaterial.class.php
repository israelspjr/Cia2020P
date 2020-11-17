<?php
class PlanoAcaoGrupoKitMaterial extends Database {
	// class attributes
	var $idPlanoAcaoGrupoKitMaterial;
	var $kitMaterialIdKitMaterial;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $datainicio;
	var $dataFim;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoAcaoGrupoKitMaterial = "NULL";
		$this -> kitMaterialIdKitMaterial = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> datainicio = "NULL";
		$this -> dataFim = "NULL";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoAcaoGrupoKitMaterial($value) {
		$this -> idPlanoAcaoGrupoKitMaterial = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setKitMaterialIdKitMaterial($value) {
		$this -> kitMaterialIdKitMaterial = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDatainicio($value) {
		$this -> datainicio = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataFim($value) {
		$this -> dataFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addPlanoAcaoGrupoKitMaterial() Function
	 */
	function addPlanoAcaoGrupoKitMaterial() {
		$sql = "INSERT INTO planoAcaoGrupoKitMaterial (kitMaterial_idKitMaterial, planoAcaoGrupo_idPlanoAcaoGrupo, datainicio, dataFim, dataCadastro) VALUES ($this->kitMaterialIdKitMaterial, $this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->datainicio, $this->dataFim, $this->dataCadastro)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deletePlanoAcaoGrupoKitMaterial() Function
	 */
	function deletePlanoAcaoGrupoKitMaterial() {
		$sql = "DELETE FROM planoAcaoGrupoKitMaterial WHERE idPlanoAcaoGrupoKitMaterial = $this->idPlanoAcaoGrupoKitMaterial";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPlanoAcaoGrupoKitMaterial() Function
	 */
	function updateFieldPlanoAcaoGrupoKitMaterial($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE planoAcaoGrupoKitMaterial SET " . $field . " = " . $value . " WHERE idPlanoAcaoGrupoKitMaterial = $this->idPlanoAcaoGrupoKitMaterial";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePlanoAcaoGrupoKitMaterial() Function
	 */
	function updatePlanoAcaoGrupoKitMaterial() {
		$sql = "UPDATE planoAcaoGrupoKitMaterial SET kitMaterial_idKitMaterial = $this->kitMaterialIdKitMaterial, planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, datainicio = $this->datainicio, dataFim = $this->dataFim,  WHERE idPlanoAcaoGrupoKitMaterial = $this->idPlanoAcaoGrupoKitMaterial";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPlanoAcaoGrupoKitMaterial() Function
	 */
	function selectPlanoAcaoGrupoKitMaterial($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupoKitMaterial, kitMaterial_idKitMaterial, planoAcaoGrupo_idPlanoAcaoGrupo, datainicio, dataFim, dataCadastro FROM planoAcaoGrupoKitMaterial " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectPlanoAcaoGrupoKitMaterialTr() Function
	 */

	function selectPlanoAcaoGrupoKitMaterialTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE PAG.idPlanoAcaoGrupo, KM.nome, PAGKM.idPlanoAcaoGrupoKitMaterial, PAGKM.datainicio, PAGKM.dataFim
		FROM planoAcaoGrupoKitMaterial AS PAGKM
		INNER JOIN kitMaterial AS KM ON KM.idKitMaterial = PAGKM.kitMaterial_idKitMaterial 
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = PAGKM.planoAcaoGrupo_idPlanoAcaoGrupo " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			$KitMaterialDidatico = new KitMaterialDidatico();

			while ($valor = mysqli_fetch_array($result)) {

				$idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
				$idPlanoAcaoGrupoKitMaterial = $valor['idPlanoAcaoGrupoKitMaterial'];

				$dataEntrada = $valor['datainicio'];
				$dataSaida = $valor['dataFim'];

				$entrada = $dataEntrada > date('Y-m-d') ? " - <font color=\"#009900;\"> iniciará em " . Uteis::exibirData($dataEntrada) . "</font>" : "";
				$saida = $dataSaida ? " - <font color=\"#FF0000;\"> sairá do grupo em " . Uteis::exibirData($dataSaida) . "</font>" : "";

				$html .= "<tr>";

				//$onclick = "";
				$html .= "<td $onclick >" . "<a title=\"inicio em " . Uteis::exibirData($dataEntrada) . "\">" . $valor['nome'] . "</a>" . $entrada . $saida . "</td>";

				$html .= "<td $onclick >" . "" . "</td>";

				$html .= "<td $onclick >" . Uteis::exibirData($valor['datainicio']) . "</td>";

				$html .= "<td $onclick >" . Uteis::exibirData($valor['dataFim']) . "</td>";

				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/include/form/planoAcaoGrupoKitMaterial_deleta.php?id=$idPlanoAcaoGrupoKitMaterial', '$caminhoAtualizar', '$ondeAtualiza')\" ";
				$html .= "<td align=\"center\" $onclick >" . "<img src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectPlanoAcaoGrupoKitMaterialTr_historico($where = "") {

		$sql = "SELECT SQL_CACHE PAG.idPlanoAcaoGrupo, KM.nome, PAGKM.idPlanoAcaoGrupoKitMaterial, PAGKM.datainicio, PAGKM.dataFim
		FROM planoAcaoGrupoKitMaterial AS PAGKM
		INNER JOIN kitMaterial AS KM ON KM.idKitMaterial = PAGKM.kitMaterial_idKitMaterial 
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = PAGKM.planoAcaoGrupo_idPlanoAcaoGrupo 
		WHERE PAGKM.dataFim < CURDATE() " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			$KitMaterialDidatico = new KitMaterialDidatico();

			while ($valor = mysqli_fetch_array($result)) {

				$idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
				$idPlanoAcaoGrupoKitMaterial = $valor['idPlanoAcaoGrupoKitMaterial'];

				$dataEntrada = $valor['datainicio'];
				$dataSaida = $valor['dataFim'];

				$html .= "<tr>";

				$html .= "<td>" . $valor['nome'] . "</td>";

				$html .= "<td>" . "" . "</td>";

				$html .= "<td>" . Uteis::exibirData($valor['datainicio']) . "</td>";

				$html .= "<td>" . Uteis::exibirData($valor['dataFim']) . "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectPlanoAcaoGrupoKitMaterialSelect() Function
	 */
	function selectPlanoAcaoGrupoKitMaterialSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoGrupoKitMaterial, kitMaterial_idKitMaterial, planoAcaoGrupo_idPlanoAcaoGrupo, datainicio, dataFim, dataCadastro FROM planoAcaoGrupoKitMaterial " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idPlanoAcaoGrupoKitMaterial\" name=\"idPlanoAcaoGrupoKitMaterial\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idPlanoAcaoGrupoKitMaterial'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idPlanoAcaoGrupoKitMaterial'] . "\">" . ($valor['idPlanoAcaoGrupoKitMaterial']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>