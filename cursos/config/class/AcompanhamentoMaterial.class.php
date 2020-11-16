<?php
class AcompanhamentoMaterial extends Database {
	// class attributes
	var $idAcompanhamentoMaterial;
    var $folhaFrequencia_idFolhaFrequencia;
	var $kitMaterial_idKitMaterial;
    var $materialMontadoPlanoAcao_idMaterialMontadoPlanoAcao;
    var $materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao;
 	var $unidade;
	var $dataCadastro;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idAcompanhamentoMaterial = "NULL";
        $this -> folhaFrequencia_idFolhaFrequencia = "NULL";
		$this -> kitMaterial_idKitMaterial = "NULL";
        $this -> materialMontadoPlanoAcao_idMaterialMontadoPlanoAcao = "NULL";
        $this -> materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao = "NULL";
		$this -> unidade = "NULL";
		$this -> dataCadastro = "NULL";
		$this -> obs = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdAcompanhamentoMaterial($value) {
		$this -> idAcompanhamentoMaterial = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setfolhaFrequencia_idFolhaFrequencia($value) {
		$this -> folhaFrequencia_idFolhaFrequencia = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setKitMaterial_idKitMAterial($value) {
		$this -> kitMaterial_idKitMaterial = ($value) ? $this -> gravarBD($value) : "NULL";
	}
    function setMaterialMontadoPlanoAcao_idMaterialMontadoPlanoAcao($value) {
        $this -> materialMontadoPlanoAcao_idMaterialMontadoPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
    }
    function setMaterialDidaticPlanoAcao_idMaterialDidaticPlanoAcao($value) {
        $this -> materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
    }
    
	function setUnidade($value) {
		$this -> unidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		$this -> dataCadastro = ($value) ? $this -> gravarBD(Uteis::gravarData($value)) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addAcompanhamentoMaterial() Function
	 */
	function addAcompanhamentoMaterial() {
		$sql = "INSERT INTO acompanhamentoMaterial (folhaFrequencia_idFolhaFrequencia, kitMaterial_idKitMaterial, materialMontadoPlanoAcao_idMaterialMontadoPlanoAcao, materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao, unidade, dataCadastro, obs) VALUES ($this->folhaFrequencia_idFolhaFrequencia, $this->kitMaterial_idKitMaterial, $this->materialMontadoPlanoAcao_idMaterialMontadoPlanoAcao, $this->materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao, $this->unidade, $this->dataCadastro, $this->obs)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteAcompanhamentoMaterial() Function
	 */
	function deleteAcompanhamentoMaterial() {
		$sql = "DELETE FROM acompanhamentoMaterial WHERE idAcompanhamentoMaterial = $this->idAcompanhamentoMaterial";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldAcompanhamentoMaterial() Function
	 */
	function updateFieldAcompanhamentoMaterial($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE acompanhamentoMaterial SET " . $field . " = " . $value . " WHERE idAcompanhamentoMaterial = $this->idAcompanhamentoMaterial";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateAcompanhamentoMaterial() Function
	 */
	function updateAcompanhamentoMaterial() {
		$sql = "UPDATE acompanhamentoMaterial SET folhaFrequencia_idFolhaFrequencia = $this->folhaFrequencia_idFolhaFrequencia, kitMaterial_idKitMaterial = $this->kitMaterial_idKitMaterial, materialMontadoPlanoAcao_idMaterialMontadoPlanoAcao = $this->materialMontadoPlanoAcao_idMaterialMontadoPlanoAcao, materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao = $this->materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao, unidade = $this->unidade, dataCadastro = $this->dataCadastro, obs = $this->obs WHERE idAcompanhamentoMaterial = $this->idAcompanhamentoMaterial";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectAcompanhamentoMaterial() Function
	 */
	function selectAcompanhamentoMaterial($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idAcompanhamentoMaterial, folhaFrequencia_idFolhaFrequencia, kitMaterial_idKitMaterial, materialMontadoPlanoAcao_idMaterialMontadoPlanoAcao, materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao, unidade, dataCadastro, obs FROM acompanhamentoMaterial " . $where;
//		echo $sql;
		return $this -> executeQuery($sql);
	}

	
	/**
	 * selectAcompanhamentoMaterialSelect() Function
	 */
	function selectAcompanhamentoMaterialSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idAcompanhamentoMaterial, folhaFrequencia_idFolhaFrequencia, kitMaterial_idKitMaterial, materialMontadoPlanoAcao_idMaterialMontadoPlanoAcao, materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao, unidade, dataCadastro, obs FROM acompanhamentoMaterial " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idAcompanhamentoMaterial\" name=\"idAcompanhamentoMaterial\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idAcompanhamentoMaterial'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idAcompanhamentoMaterial'] . "\">" . ($valor['idAcompanhamentoMaterial']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}
function selectAcompanhamentoMaterialTr($mostrarAcoes, $caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

        $sql = "SELECT SQL_CACHE idAcompanhamentoMaterial, folhaFrequencia_idFolhaFrequencia, kitMaterial_idKitMaterial, materialMontadoPlanoAcao_idMaterialMontadoPlanoAcao, materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao, unidade, obs FROM acompanhamentoMaterial " . $where;
//		echo$sql; 
        $result = $this -> query($sql);

        if (mysqli_num_rows($result) > 0) {
           $html = "";

            while ($valor = mysqli_fetch_array($result)) {

                $del = "";
                if ($mostrarAcoes) {
                    $del = "<center><img src=\"" . CAMINHO_IMG . "excluir.png\" onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/acompanhamentoMaterial.php', " . $valor['idAcompanhamentoMaterial'] . ", '$caminhoAtualizar', '$ondeAtualiza')\" ></center>";
                }

                $onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "form/acompanhamentoMaterial.php?mostrarAcoes=" . $mostrarAcoes . "&id=" . $valor['idAcompanhamentoMaterial'] . "', '" . $caminhoAtualizar . "&mostrarAcoes=" . $mostrarAcoes . "', '$ondeAtualiza')\" ";

                $html .= "<tr>
                
                <td id=\"AcompMat\" $onclick >" . $valor[''] . "</td>
                
                <td $onclick>" . $valor['campo2'] . "</td>
                
                <td $onclick>" . $valor['obs'] . "</td>
                
                <td>" . $del . "</td>
                
                </tr>";
            }
        }
        return $html;
    }

}