<?php
class EncomendaMaterialGrupo extends Database {
	// class attributes
	var $idEncomendaMaterialGrupo;
	var $integranteGrupoIdIntegranteGrupo;
	var $materialDidaticoIdMaterialDidatico;
	var $planoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado;
	var $valor;
	var $parcelas;
	var $dataPrimeiraCobranca;
	var $dataPrevisaoEntregaMaterial;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idEncomendaMaterialGrupo = "NULL";
		$this -> integranteGrupoIdIntegranteGrupo = "NULL";
		$this -> materialDidaticoIdMaterialDidatico = "NULL";
		$this -> planoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado = "NULL";
		$this -> valor = "NULL";
		$this -> parcelas = "NULL";
		$this -> dataPrimeiraCobranca = "NULL";
		$this -> dataPrevisaoEntregaMaterial = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdEncomendaMaterialGrupo($value) {
		$this -> idEncomendaMaterialGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIntegranteGrupoIdIntegranteGrupo($value) {
		$this -> integranteGrupoIdIntegranteGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMaterialDidaticoIdMaterialDidatico($value) {
		$this -> materialDidaticoIdMaterialDidatico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado($value) {
		$this -> planoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setParcelas($value) {
		$this -> parcelas = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataPrimeiraCobranca($value) {
		$this -> dataPrimeiraCobranca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataPrevisaoEntregaMaterial($value) {
		$this -> dataPrevisaoEntregaMaterial = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addEncomendaMaterialGrupo() Function
	 */
	function addEncomendaMaterialGrupo() {
		$sql = "INSERT INTO encomendaMaterialGrupo (integranteGrupo_idIntegranteGrupo, materialDidatico_idMaterialDidatico, planoAcaoGrupoMaterialMontado_idPlanoAcaoGrupoMaterialMontado, valor, parcelas, dataPrimeiraCobranca, dataPrevisaoEntregaMaterial) VALUES ($this->integranteGrupoIdIntegranteGrupo, $this->materialDidaticoIdMaterialDidatico, $this->planoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado, $this->valor, $this->parcelas, $this->dataPrimeiraCobranca, $this->dataPrevisaoEntregaMaterial)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteEncomendaMaterialGrupo() Function
	 */
	function deleteEncomendaMaterialGrupo() {
		$sql = "DELETE FROM encomendaMaterialGrupo WHERE idEncomendaMaterialGrupo = $this->idEncomendaMaterialGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldEncomendaMaterialGrupo() Function
	 */
	function updateFieldEncomendaMaterialGrupo($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE encomendaMaterialGrupo SET " . $field . " = " . $value . " WHERE idEncomendaMaterialGrupo = $this->idEncomendaMaterialGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateEncomendaMaterialGrupo() Function
	 */
	function updateEncomendaMaterialGrupo() {
		$sql = "UPDATE encomendaMaterialGrupo SET integranteGrupo_idIntegranteGrupo = $this->integranteGrupoIdIntegranteGrupo, materialDidatico_idMaterialDidatico = $this->materialDidaticoIdMaterialDidatico, planoAcaoGrupoMaterialMontado_idPlanoAcaoGrupoMaterialMontado = $this->planoAcaoGrupoMaterialMontadoIdPlanoAcaoGrupoMaterialMontado, valor = $this->valor, parcelas = $this->parcelas, dataPrimeiraCobranca = $this->dataPrimeiraCobranca, dataPrevisaoEntregaMaterial = $this->dataPrevisaoEntregaMaterial WHERE idEncomendaMaterialGrupo = $this->idEncomendaMaterialGrupo";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectEncomendaMaterialGrupo() Function
	 */
	function selectEncomendaMaterialGrupo($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idEncomendaMaterialGrupo, integranteGrupo_idIntegranteGrupo, materialDidatico_idMaterialDidatico, planoAcaoGrupoMaterialMontado_idPlanoAcaoGrupoMaterialMontado, valor, parcelas, dataPrimeiraCobranca, dataPrevisaoEntregaMaterial FROM encomendaMaterialGrupo " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectEncomendaMaterialGrupoTr() Function
	 */
	function selectEncomendaMaterialGrupoTr($where = "") {

		$sql = "SELECT SQL_CACHE idEncomendaMaterialGrupo, integranteGrupo_idIntegranteGrupo, materialDidatico_idMaterialDidatico, 
		planoAcaoGrupoMaterialMontado_idPlanoAcaoGrupoMaterialMontado, valor, parcelas, dataPrimeiraCobranca, dataPrevisaoEntregaMaterial 
		FROM encomendaMaterialGrupo " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$html .= "<tr>";

				$html .= "<td>" . "" . "</td>";

				$html .= "<td>R$ " . Uteis::formatarMoeda($valor['valor']) . "</td>";

				$html .= "<td>" . $valor['parcelas'] . "</td>";

				//PARCELAS PAGAS
				$html .= "<td>" . "" . "</td>";

				$html .= "<td>" . Uteis::exibirData($valor['dataPrimeiraCobranca']) . "</td>";

				$html .= "<td>" . Uteis::exibirData($valor['dataPrevisaoEntregaMaterial']) . "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectEncomendaMaterialGrupoSelect() Function
	 */
	function selectEncomendaMaterialGrupoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idEncomendaMaterialGrupo, integranteGrupo_idIntegranteGrupo, materialDidatico_idMaterialDidatico, planoAcaoGrupoMaterialMontado_idPlanoAcaoGrupoMaterialMontado, valor, parcelas, dataPrimeiraCobranca, dataPrevisaoEntregaMaterial FROM encomendaMaterialGrupo " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idEncomendaMaterialGrupo\" name=\"idEncomendaMaterialGrupo\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idEncomendaMaterialGrupo'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idEncomendaMaterialGrupo'] . "\">" . ($valor['idEncomendaMaterialGrupo']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectEncomendaMaterialGrupo_parcela($idPlanoAcaoGrupo, $dataReferencia, $where = "") {

		$sql = " SELECT EMGP.idEncomendaMaterialPagamentoParcela, (EMG.valor/EMG.parcelas) AS valor, IG.idIntegranteGrupo, EMGP.dataReferencia
		FROM planoAcaoGrupo AS PAG
		INNER JOIN integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		INNER JOIN encomendaMaterialGrupo AS EMG ON EMG.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo
		INNER JOIN encomendaMaterialPagamentoParcela AS EMGP ON EMGP.encomendaMaterialGrupo_idEncomendaMaterialGrupo = EMG.idEncomendaMaterialGrupo AND quitada = 0
		WHERE EMGP.dataReferencia = '$dataReferencia' AND PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo $where GROUP BY EMG.idEncomendaMaterialGrupo ";

		return Uteis::executarQuery($sql);

	}

	function listaMaterialEncomendar($idPlanoAcaoGrupo, $idIntegranteGrupo) {

		$html = "";

		$KitMaterialDidatico = new KitMaterialDidatico();
		$MaterialDidatico = new MaterialDidatico();
		$MaterialMontadoPlanoAcao = new MaterialMontadoPlanoAcao();

		$where = " WHERE PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND dataInicio <= CURDATE() AND ( dataFim >= CURDATE() OR dataFim = '' OR dataFim IS NULL) ";

		//KIT DE MATERIAL
		$valorMaterialDidatico = $KitMaterialDidatico -> selectKitMaterialDidatico_itens($where);

		if ($valorMaterialDidatico) {
			for ($row = 0; $row < count($valorMaterialDidatico, 0); $row++) {

				$id = $valorMaterialDidatico[$row]['idMaterialDidatico'] . "_" . $idIntegranteGrupo;

				$html .= "<tr>
				
				<td >
					<label for=\"checkbox_KitMaterialDidatico_" . $id . "\" >					
						<input type=\"checkbox\" name=\"checkbox_KitMaterialDidatico[]\" 
						id=\"checkbox_KitMaterialDidatico_" . $id . "\" value=\"" . $id . "\" from=\"KitMaterialDidatico_" . $id . "\" onclick=\"ativaOutrosCampos(this)\"/>" . $valorMaterialDidatico[$row]['nome'] . "						
					</label>
				</td>
				
				<td>
					R$ " . Uteis::formatarMoeda($valorMaterialDidatico[$row]['valor']) . " 
					<input type=\"hidden\" name=\"valor_KitMaterialDidatico_" . $id . "\" id=\"valor_KitMaterialDidatico_" . $id . "\" value=\"" . $valorMaterialDidatico[$row]['valor'] . "\" disabled />
				</td>
				
				<td>
					<input type=\"text\" name=\"parcelas_KitMaterialDidatico_" . $id . "\" id=\"parcelas_KitMaterialDidatico_" . $id . "\" class=\"numeric\" maxlength=\"2\" disabled /><span class=\"placeholder\"></span>
				</td>
				
				<td>
					<input type=\"text\" name=\"dataPrimeiraCobranca_KitMaterialDidatico_" . $id . "\" id=\"dataPrimeiraCobranca_KitMaterialDidatico_" . $id . "\" class=\"data\" disabled /><span class=\"placeholder\"></span>
				</td>
				
				<td>
					<input type=\"text\" name=\"dataPrevisaoEntregaMaterial_KitMaterialDidatico_" . $id . "\" id=\"dataPrevisaoEntregaMaterial_KitMaterialDidatico_" . $id . "\" class=\"data\" disabled />
				</td>
				
				</tr>";
			}
		}

		//MATERIAL AVULSO
		$valorMaterialDidatico = $MaterialDidatico -> selectMaterialDidatico_itens($where);

		if ($valorMaterialDidatico) {
			for ($row = 0; $row < count($valorMaterialDidatico, 0); $row++) {

				$id = $valorMaterialDidatico[$row]['idMaterialDidatico'] . "_" . $idIntegranteGrupo;

				$html .= "<tr>
				
				<td >
					<label for=\"checkbox_MaterialDidaticPlanoAcao_" . $id . "\" >
						<input type=\"checkbox\" name=\"checkbox_MaterialDidaticPlanoAcao[]\" 
						id=\"checkbox_MaterialDidaticPlanoAcao_" . $id . "\" value=\"" . $id . "\"
						onclick=\"ativaOutrosCampos(this)\" from=\"MaterialDidaticPlanoAcao_" . $id . "\" />" . $valorMaterialDidatico[$row]['nome'] . "
					</label>
				</td>
				
				<td>
					R$ " . Uteis::formatarMoeda($valorMaterialDidatico[$row]['valor']) . " 
					<input type=\"hidden\" name=\"valor_MaterialDidaticPlanoAcao_" . $id . "\" id=\"valor_MaterialDidaticPlanoAcao_" . $id . "\" value=\"" . $valorMaterialDidatico[$row]['valor'] . "\" disabled />
				</td>
				
				<td>
					<input type=\"text\" name=\"parcelas_MaterialDidaticPlanoAcao_" . $id . "\" id=\"parcelas_MaterialDidaticPlanoAcao_" . $id . "\" class=\"numeric\" maxlength=\"2\" disabled /><span class=\"placeholder\"></span>
				</td>
				
				<td>
					<input type=\"text\" name=\"dataPrimeiraCobranca_MaterialDidaticPlanoAcao_" . $id . "\" id=\"dataPrimeiraCobranca_MaterialDidaticPlanoAcao_" . $id . "\" class=\"data\" disabled /><span class=\"placeholder\"></span>
				</td>
				
				<td>
					<input type=\"text\" name=\"dataPrevisaoEntregaMaterial_MaterialDidaticPlanoAcao_" . $id . "\" id=\"dataPrevisaoEntregaMaterial_MaterialDidaticPlanoAcao_" . $id . "\" class=\"data\" disabled />
				</td>
				
				</tr>";
			}
		}

		//MATERIAL MONTADO/PERSONALIZADO/APOSTILAS
		$valorMaterialMontadoPlanoAcao = $MaterialMontadoPlanoAcao -> selectMaterialMontadoPlanoAcao_itens($where);

		if ($valorMaterialMontadoPlanoAcao) {
			for ($row = 0; $row < count($valorMaterialMontadoPlanoAcao, 0); $row++) {

				$id = $valorMaterialMontadoPlanoAcao[$row]['idPlanoAcaoGrupoMaterialMontado'] . "_" . $idIntegranteGrupo;

				$html .= "<tr>
				
				<td >
					<label for=\"checkbox_MaterialMontadoPlanoAcao_" . $id . "\">
						<input type=\"checkbox\" name=\"checkbox_MaterialMontadoPlanoAcao[]\" id=\"checkbox_MaterialMontadoPlanoAcao_" . $id . "\" value=\"" . $id . "\" onclick=\"ativaOutrosCampos(this)\" from=\"MaterialMontadoPlanoAcao_" . $id . "\"/>" . $valorMaterialMontadoPlanoAcao[$row]['nome'] . "</label>
				</td>
				
				<td>
					R$ " . Uteis::formatarMoeda($valorMaterialMontadoPlanoAcao[$row]['preco']) . "
					<input type=\"hidden\" name=\"valor_MaterialMontadoPlanoAcao_" . $id . "\" id=\"valor_MaterialMontadoPlanoAcao_" . $id . "\" value=\"" . $valorMaterialMontadoPlanoAcao[$row]['preco'] . "\" disabled />
				</td>
				
				<td>
					<input type=\"text\" name=\"parcelas_MaterialMontadoPlanoAcao_" . $id . "\" id=\"parcelas_MaterialMontadoPlanoAcao_" . $id . "\" class=\"numeric\" maxlength=\"2\" disabled /><span class=\"placeholder\"></span>
				</td>
				
				<td>
					<input type=\"text\" name=\"dataPrimeiraCobranca_MaterialMontadoPlanoAcao_" . $id . "\" id=\"dataPrimeiraCobranca_MaterialMontadoPlanoAcao_" . $id . "\" class=\"data\" disabled /><span class=\"placeholder\"></span>
				</td>
				
				<td>
					<input type=\"text\" name=\"dataPrevisaoEntregaMaterial_MaterialMontadoPlanoAcao_" . $id . "\" id=\"dataPrevisaoEntregaMaterial_MaterialMontadoPlanoAcao_" . $id . "\" class=\"data\" disabled />
				</td>
				
				</tr>";
			}
		}

		return $html;
	}

}
?>