<?php
class KitMaterialDidatico extends Database {
	// class attributes
	var $idKitMaterialDidatico;
	var $kitMaterialIdKitMaterial;
	var $materialDidaticoIdMaterialDidatico;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idKitMaterialDidatico = "NULL";
		$this -> kitMaterialIdKitMaterial = "NULL";
		$this -> materialDidaticoIdMaterialDidatico = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdKitMaterialDidatico($value) {
		$this -> idKitMaterialDidatico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setKitMaterialIdKitMaterial($value) {
		$this -> kitMaterialIdKitMaterial = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMaterialDidaticoIdMaterialDidatico($value) {
		$this -> materialDidaticoIdMaterialDidatico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addKitMaterialDidatico() Function
	 */
	function addKitMaterialDidatico() {
		$sql = "INSERT INTO kitMaterialDidatico (kitMaterial_idKitMaterial, materialDidatico_idMaterialDidatico, excluido) VALUES ($this->kitMaterialIdKitMaterial, $this->materialDidaticoIdMaterialDidatico, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteKitMaterialDidatico() Function
	 */
	function deleteKitMaterialDidatico() {
		$sql = "DELETE FROM kitMaterialDidatico WHERE idKitMaterialDidatico = $this->idKitMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldKitMaterialDidatico() Function
	 */
	function updateFieldKitMaterialDidatico($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE kitMaterialDidatico SET " . $field . " = " . $value . " WHERE idKitMaterialDidatico = $this->idKitMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateKitMaterialDidatico() Function
	 */
	function updateKitMaterialDidatico() {
		$sql = "UPDATE kitMaterialDidatico SET kitMaterial_idKitMaterial = $this->kitMaterialIdKitMaterial, materialDidatico_idMaterialDidatico = $this->materialDidaticoIdMaterialDidatico WHERE idKitMaterialDidatico = $this->idKitMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectKitMaterialDidatico() Function
	 */
	function selectKitMaterialDidatico($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idKitMaterialDidatico, kitMaterial_idKitMaterial, materialDidatico_idMaterialDidatico, excluido FROM kitMaterialDidatico " . $where;
		return $this -> executeQuery($sql);
	}

	function selectKitMaterialDidaticoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE K.idKitMaterialDidatico, K.kitMaterial_idKitMaterial, M.nome as nomeMaterialDidatico , KM.nome as nomeKitMaterial 
		FROM kitMaterialDidatico AS K  
		INNER JOIN kitMaterial AS KM ON KM.idkitMaterial = K.kitMaterial_idkitMaterial 
		INNER JOIN materialDidatico AS M ON K.materialDidatico_idMaterialDidatico = M.idMaterialDidatico " . $where;
		//echo "$sql";
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idKitMaterialDidatico = $valor['idKitMaterialDidatico'];
				$kitMaterial_idKitMaterial = $valor['nomeKitMaterial'];
				$materialDidatico_idMaterialDidatico = $valor['nomeMaterialDidatico'];

				$html .= "<td>" . $idKitMaterialDidatico . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idKitMaterialDidatico'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $kitMaterial_idKitMaterial . "</td>";
				$html .= "<td>" . $materialDidatico_idMaterialDidatico . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idKitMaterialDidatico'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectKitMaterialDidaticoSelect() Function
	 */
	function selectKitMaterialDidaticoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idKitMaterialDidatico, kitMaterial_idKitMaterial, materialDidatico_idMaterialDidatico FROM kitMaterialDidatico " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idKitMaterialDidatico\" name=\"idKitMaterialDidatico\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idKitMaterialDidatico'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idKitMaterialDidatico'] . "\">" . ($valor['idKitMaterialDidatico']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectKitMaterialDidatico_itens($where = "") {

		$sql = "SELECT SQL_CACHE DISTINCT(MD.idMaterialDidatico), MD.nome, EMD.editora, TMD.tipo, MD.valor 
		FROM planoAcaoGrupo AS PAG 
		INNER JOIN planoAcaoGrupoKitMaterial AS PAGK ON PAGK.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
		INNER JOIN kitMaterialDidatico AS KMD ON KMD.kitMaterial_idKitMaterial = PAGK.kitMaterial_idKitMaterial 
		INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = KMD.materialDidatico_idMaterialDidatico 
		LEFT JOIN editoraMaterialDidatico AS EMD ON EMD.idEditoraMaterialDidatico = MD.materialDidaticoTipo_idMaterialDidaticoTipo 
		LEFT JOIN tipoMaterialDidatico AS TMD ON TMD.idTipoMaterialDidatico = MD.materialDidaticoTipo_idMaterialDidaticoTipo " . $where;
		return Uteis::executarQuery($sql);

	}

}
?>