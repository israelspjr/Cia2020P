<?php
class Batismo extends Database {
	// class attributes
	var $idBatismo;
	var $idPlanoAcao;
	var $idIntegrantePlanoAcao;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoAcao = "NULL";
		$this -> idIntegrantePlanoAcao = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdBatismo($value) {
		$this -> idBatismo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdPlanoAcao($value) {
		$this -> idPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdIntegrantePlanoAcao($value) {
		$this -> idIntegrantePlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function selectBatismoTr() {

		$PlanoAcao = new PlanoAcao();
		$PlanoAcaoGrupo = new PlanoAcaoGrupo();

		$subQuery = $PlanoAcaoGrupo -> selectPlanoAcaoGrupo();
		$subQuery = implode(",", Uteis::arrayCampoEspecifico($subQuery, "planoAcao_idPlanoAcao"));
		$subQuery = $subQuery != '' ? $subQuery : "0";

		$sql = " SELECT idPlanoAcao, ST.idStatusAprovacao, I.idioma, NE.nivel, P.dataCadastro AS DTPP, PA.dataAprovacao, COALESCE(PJ.razaoSocial, 'Particular') AS razaoSocial ";
		$sql .= " FROM planoAcao AS PA ";
		$sql .= " INNER JOIN proposta AS P ON P.idProposta = PA.proposta_idProposta ";
		$sql .= " LEFT JOIN clientePj AS PJ ON PJ.idClientePj = P.clientePj_idClientePj ";
		$sql .= " INNER JOIN idioma AS I ON I.idIdioma = P.idioma_idIdioma ";
		$sql .= " INNER JOIN nivelEstudo AS NE ON NE.IdNivelEstudo = PA.nivelEstudo_IdNivelEstudo ";
		$sql .= " LEFT JOIN statusAprovacao AS ST ON ST.idStatusAprovacao = PA.statusAprovacao_idStatusAprovacao ";
		$sql .= " WHERE (PA.dataExclusao IS NULL OR PA.dataExclusao='') AND (idStatusAprovacao = 2 ) ";
		$sql .= " AND idPlanoAcao NOT IN (" . $subQuery . ") AND PA.dataAprovacao IS NOT NULL AND YEAR(PA.dataAprovacao) = YEAR(CURDATE()) ORDER BY PA.dataAprovacao DESC";
    //echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {

				$html .= "<tr>";

				$onclick = " title=\"Batizar o grupo\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "/batismo/cadastro.php?id=" . $valor['idPlanoAcao'] . "', '" . CAMINHO_REL . "batismo/index.php', '#centro')\" ";

				$html .= "<td $onclick >" . $valor['idPlanoAcao'] . "</td>";

				$html .= "<td $onclick >" . $valor['idioma'] . "</td>";

				$html .= "<td $onclick >" . $valor['nivel'] . "</td>";

				$html .= "<td $onclick >" . $valor['razaoSocial'] . "</td>";

				$html .= "<td $onclick >" . Uteis::exibirData($valor['DTPP']) . "</td>";

				$html .= "<td $onclick  >" . Uteis::exibirData($valor['dataAprovacao']) . "</td>";

				$html .= "<td title=\"Visualizar plano de ação\" onclick=\"window.open('" . CAMINHO_PA . "index.php?p=" . Uteis::base64_url_encode($valor['idPlanoAcao'])."')\" align=\"center\" >
					<img src=\"" . CAMINHO_IMG . "pa.png\"  >
				</td>";

				$html .= "</tr>";
			}
		}

		return $html;

	}

	function listaMaterialEncomendar() {

		$html = "";

		//KIT DE MATERIAL
		$MaterialDidatico = new MaterialDidatico();
		$valorMaterialDidatico = $MaterialDidatico -> selectMaterialDidatico(" WHERE idMaterialDidatico IN (
			SELECT K2.materialDidatico_idMaterialDidatico FROM kitMaterialDidatico AS K2 
			WHERE K2.kitMaterial_idKitMaterial IN(
				SELECT PA2.kitMaterial_idKitMaterial FROM planoAcao AS PA2 WHERE PA2.idPlanoAcao = $this->idPlanoAcao
			)
		)"); 		
				
		if ($valorMaterialDidatico) {
			for ($row = 0; $row < count($valorMaterialDidatico, 0); $row++) {

				$id = $valorMaterialDidatico[$row]['idMaterialDidatico'] . "_" . $this -> idIntegrantePlanoAcao;

				$html .= "<tr>";

				$checkbox = "<input type=\"checkbox\" name=\"checkbox_KitMaterialDidatico_" . $id . "\" id=\"checkbox_KitMaterialDidatico_" . $id . "\" value=\"" . $id . "\" from=\"KitMaterialDidatico_" . $id . "\" onclick=\"ativaOutrosCampos(this)\"/>";
				$html .= "<td ><label for=\"checkbox_KitMaterialDidatico_" . $id . "\" >" . $checkbox . $valorMaterialDidatico[$row]['nome'] . "</label></td>";

				$inputValor = "<input type=\"hidden\" name=\"valor_KitMaterialDidatico_" . $id . "\" id=\"valor_KitMaterialDidatico_" . $id . "\" value=\"" . $valorMaterialDidatico[$row]['valor'] . "\" disabled />";
				$html .= "<td>R$ " . Uteis::formatarMoeda($valorMaterialDidatico[$row]['valor']) . " $inputValor </td>";

				$parcelas = "<input type=\"text\" name=\"parcelas_KitMaterialDidatico_" . $id . "\" id=\"parcelas_KitMaterialDidatico_" . $id . "\" class=\"numeric\" maxlength=\"2\" disabled /><span class=\"placeholder\"></span>";
				$html .= "<td>" . $parcelas . "</td>";

				$dataPrimeiraCobranca = "<input type=\"text\" name=\"dataPrimeiraCobranca_KitMaterialDidatico_" . $id . "\" id=\"dataPrimeiraCobranca_KitMaterialDidatico_" . $id . "\" class=\"data\" disabled /><span class=\"placeholder\"></span>";
				$html .= "<td>" . $dataPrimeiraCobranca . "</td>";

				$dataPrevisaoEntregaMaterial = "<input type=\"text\" name=\"dataPrevisaoEntregaMaterial_KitMaterialDidatico_" . $id . "\" id=\"dataPrevisaoEntregaMaterial_KitMaterialDidatico_" . $id . "\" class=\"data\" disabled />";
				$html .= "<td>" . $dataPrevisaoEntregaMaterial . "</td>";

				$html .= "</tr>";
			}
		}

		//MATERIAL AVULSO
		$valorMaterialDidatico = $MaterialDidatico -> selectMaterialDidatico(" WHERE idMaterialDidatico IN (
			SELECT materialDidatico_idMaterialDidatico FROM materialDidaticPlanoAcao AS M2 WHERE M2.planoAcao_idPlanoAcao = $this->idPlanoAcao
		)");

		if ($valorMaterialDidatico) {
			for ($row = 0; $row < count($valorMaterialDidatico, 0); $row++) {

				$id = $valorMaterialDidatico[$row]['idMaterialDidatico'] . "_" . $this -> idIntegrantePlanoAcao;

				$html .= "<tr>";

				$checkbox = "<input type=\"checkbox\" name=\"checkbox_MaterialDidaticPlanoAcao_" . $id . "\" id=\"checkbox_MaterialDidaticPlanoAcao_" . $id . "\" value=\"" . $id . "\" onclick=\"ativaOutrosCampos(this)\" from=\"MaterialDidaticPlanoAcao_" . $id . "\" />";
				$html .= "<td ><label for=\"checkbox_MaterialDidaticPlanoAcao_" . $id . "\" >" . $checkbox . $valorMaterialDidatico[$row]['nome'] . "</label></td>";

				$inputValor = "<input type=\"hidden\" name=\"valor_MaterialDidaticPlanoAcao_" . $id . "\" id=\"valor_MaterialDidaticPlanoAcao_" . $id . "\" value=\"" . $valorMaterialDidatico[$row]['valor'] . "\" disabled />";
				$html .= "<td>R$ " . Uteis::formatarMoeda($valorMaterialDidatico[$row]['valor']) . " $inputValor</td>";

				$parcelas = "<input type=\"text\" name=\"parcelas_MaterialDidaticPlanoAcao_" . $id . "\" id=\"parcelas_MaterialDidaticPlanoAcao_" . $id . "\" class=\"numeric\" maxlength=\"2\" disabled /><span class=\"placeholder\"></span>";
				$html .= "<td>" . $parcelas . "</td>";

				$dataPrimeiraCobranca = "<input type=\"text\" name=\"dataPrimeiraCobranca_MaterialDidaticPlanoAcao_" . $id . "\" id=\"dataPrimeiraCobranca_MaterialDidaticPlanoAcao_" . $id . "\" class=\"data\" disabled /><span class=\"placeholder\"></span>";
				$html .= "<td>" . $dataPrimeiraCobranca . "</td>";

				$dataPrevisaoEntregaMaterial = "<input type=\"text\" name=\"dataPrevisaoEntregaMaterial_MaterialDidaticPlanoAcao_" . $id . "\" id=\"dataPrevisaoEntregaMaterial_MaterialDidaticPlanoAcao_" . $id . "\" class=\"data\" disabled />";
				$html .= "<td>" . $dataPrevisaoEntregaMaterial . "</td>";

				$html .= "</tr>";
			}
		}

		//MATERIAL MONTADO/PERSONALIZADO/APOSTILAS
		$MaterialMontadoPlanoAcao = new MaterialMontadoPlanoAcao();
		$valorMaterialMontadoPlanoAcao = $MaterialMontadoPlanoAcao -> selectMaterialMontadoPlanoAcao(" WHERE planoAcao_idPlanoAcao = " . $this -> idPlanoAcao);

		if ($valorMaterialMontadoPlanoAcao) {
			for ($row = 0; $row < count($valorMaterialMontadoPlanoAcao, 0); $row++) {

				$id = $valorMaterialMontadoPlanoAcao[$row]['idMaterialMontadoPlanoAcao'] . "_" . $this -> idIntegrantePlanoAcao;

				$html .= "<tr>";

				$checkbox = "<input type=\"checkbox\" name=\"checkbox_MaterialMontadoPlanoAcao_" . $id . "\" id=\"checkbox_MaterialMontadoPlanoAcao_" . $id . "\" value=\"" . $id . "\" onclick=\"ativaOutrosCampos(this)\" from=\"MaterialMontadoPlanoAcao_" . $id . "\"/>";
				$html .= "<td ><label for=\"checkbox_MaterialMontadoPlanoAcao_" . $id . "\">" . $checkbox . $valorMaterialMontadoPlanoAcao[$row]['nome'] . "</label></td>";

				$inputValor = "<input type=\"hidden\" name=\"valor_MaterialMontadoPlanoAcao_" . $id . "\" id=\"valor_MaterialMontadoPlanoAcao_" . $id . "\" value=\"" . $valorMaterialMontadoPlanoAcao[$row]['preco'] . "\" disabled />";
				$html .= "<td>R$ " . Uteis::formatarMoeda($valorMaterialMontadoPlanoAcao[$row]['preco']) . "$inputValor </td>";

				$parcelas = "<input type=\"text\" name=\"parcelas_MaterialMontadoPlanoAcao_" . $id . "\" id=\"parcelas_MaterialMontadoPlanoAcao_" . $id . "\" class=\"numeric\" maxlength=\"2\" disabled /><span class=\"placeholder\"></span>";
				$html .= "<td>" . $parcelas . "</td>";

				$dataPrimeiraCobranca = "<input type=\"text\" name=\"dataPrimeiraCobranca_MaterialMontadoPlanoAcao_" . $id . "\" id=\"dataPrimeiraCobranca_MaterialMontadoPlanoAcao_" . $id . "\" class=\"data\" disabled /><span class=\"placeholder\"></span>";
				$html .= "<td>" . $dataPrimeiraCobranca . "</td>";

				$dataPrevisaoEntregaMaterial = "<input type=\"text\" name=\"dataPrevisaoEntregaMaterial_MaterialMontadoPlanoAcao_" . $id . "\" id=\"dataPrevisaoEntregaMaterial_MaterialMontadoPlanoAcao_" . $id . "\" class=\"data\" disabled />";
				$html .= "<td>" . $dataPrevisaoEntregaMaterial . "</td>";

				$html .= "</tr>";
			}
		}

		return $html;
	}

}
?>