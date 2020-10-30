<?php
class EtapaValidacaoBusca extends Database {
	// class attributes
	var $idEtapaValidacaoBusca;
	var $etapa;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idEtapaValidacaoBusca = "NULL";
		$this -> etapa = "NULL";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdEtapaValidacaoBusca($value) {
		$this -> idEtapaValidacaoBusca = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEtapa($value) {
		$this -> etapa = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addEtapaValidacaoBusca() Function
	 */
	function addEtapaValidacaoBusca() {
		$sql = "INSERT INTO etapaValidacaoBusca (etapa, inativo, excluido) VALUES ($this->etapa, $this->inativo, $this->excluido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteEtapaValidacaoBusca() Function
	 */
	function deleteEtapaValidacaoBusca() {
		$sql = "DELETE FROM etapaValidacaoBusca WHERE idEtapaValidacaoBusca = $this->idEtapaValidacaoBusca";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldEtapaValidacaoBusca() Function
	 */
	function updateFieldEtapaValidacaoBusca($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE etapaValidacaoBusca SET " . $field . " = " . $value . " WHERE idEtapaValidacaoBusca = $this->idEtapaValidacaoBusca";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateEtapaValidacaoBusca() Function
	 */
	function updateEtapaValidacaoBusca() {
		$sql = "UPDATE etapaValidacaoBusca SET etapa = $this->etapa, inativo = $this->inativo WHERE idEtapaValidacaoBusca = $this->idEtapaValidacaoBusca";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectEtapaValidacaoBusca() Function
	 */
	function selectEtapaValidacaoBusca($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idEtapaValidacaoBusca, etapa, inativo, excluido FROM etapaValidacaoBusca " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectEtapaValidacaoBuscaTr() Function
	 */
	function selectEtapaValidacaoBuscaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idEtapaValidacaoBusca, etapa, inativo FROM etapaValidacaoBusca " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {

				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//

				$html .= "<tr>
				
				<td>" . $valor['idEtapaValidacaoBusca'] . "</td>
				
				<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idEtapaValidacaoBusca'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $valor['etapa'] . "</td>
				
				<td>" . $inativo . "</td>";

				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idEtapaValidacaoBusca'] . ", '$caminhoAtualizar', 'tr')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectEtapaValidacaoBuscaSelect() Function
	 */
	function selectEtapaValidacaoBuscaSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idEtapaValidacaoBusca, etapa, inativo FROM etapaValidacaoBusca " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idEtapaValidacaoBusca\" name=\"idEtapaValidacaoBusca\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idEtapaValidacaoBusca'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idEtapaValidacaoBusca'] . "\">" . ($valor['idEtapaValidacaoBusca']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

	function selectEtapaValidacaoBusca_etapas($idOpcaoBuscaProfessorSelecionada, $idBuscaProfessor, $idPlanoAcaoGrupo, $caminhoAtualizar, $tipo, $dataApartir = "") {

		$query = " SELECT idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada, idEtapaValidacaoBusca, etapa, concluida 
		FROM etapaValidacaoBusca AS E 
		INNER JOIN etapaValidacaoBuscaOpcaoBuscaProfessorSelecionada AS EP 
			ON E.idEtapaValidacaoBusca = EP.etapaValidacaoBusca_idEtapaValidacaoBusca 
		WHERE E.inativo = 0 AND opcaoBuscaProfessorSelecionada_idOpcaoBuscaProfessorSelecionada = " . $idOpcaoBuscaProfessorSelecionada . " ORDER BY E.etapa";
        //echo $query;
		$rsEtapas = $this -> query($query);

		if (mysqli_num_rows($rsEtapas) > 0) {

			$finalizar = true;

			while ($valor3 = mysqli_fetch_array($rsEtapas)) {

				$status = $valor3['concluida'];
				if (!$status)
					$finalizar = false;

				$queryString = "idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada=" . $valor3['idEtapaValidacaoBuscaOpcaoBuscaProfessorSelecionada'] . "&status=" . !$status . "&idEtapaValidacaoBusca=" . $valor3['idEtapaValidacaoBusca'] . "&idBuscaProfessor=" . $idBuscaProfessor . "&idOpcaoBuscaProfessorSelecionada=" . $idOpcaoBuscaProfessorSelecionada . "&caminhoAtualizar=" . urlencode($caminhoAtualizar) . "&dataApartir=" . $dataApartir . "&tipo=" . $tipo . "&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo;

				$html .= "<a onclick=\"postForm('', '" . CAMINHO_REL . "busca/vendas/include/acao/etapas.php', '" . $queryString . "')\" title=\"" . $valor3['etapa'] . "\">" . Uteis::exibirStatus($status) . "</a> ";

			}

			if ($finalizar) {

				if ($tipo == "AP") {
					$queryString = "?idBuscaProfessor=" . $idBuscaProfessor . "&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo."&dataApartir=" . Uteis::exibirData($dataApartir);
					$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/form/finalizar.php" . $queryString . "', '$caminhoAtualizar', 'tr');\" ";
				} elseif ($tipo == "AF") {
					$queryString = "idBuscaProfessor=" . $idBuscaProfessor . "&dataApartir=" . Uteis::exibirData($dataApartir) . "&caminhoAtualizar=" . urlencode($caminhoAtualizar);
					$onclick = " onclick=\"if(confirm('Deseja realmente vincular este professor ao dia?')){ postForm('', '" . CAMINHO_REL . "busca/vendas/include/acao/finalizar.php', '" . $queryString . "')}\" ";
				}				

				//VERIFICAR SE HÁ MAIS ALGUM DIA NA BUSCA
				if (1) {
					$queryString = "?idBuscaProfessor=" . $idBuscaProfessor . "&idPlanoAcaoGrupo=" . $idPlanoAcaoGrupo;
					$html .= "  <a onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "busca/vendas/include/form/copiarProfessores.php$queryString', '$caminhoAtualizar', 'tr')\" >
						<img title=\"Copiar professor para outros dias\" src=\"" . CAMINHO_IMG . "copy16.png\">
					</a>";
				}
				$html .= "&nbsp;&nbsp;<a title=\"FINALIZAR ETAPAS\" $onclick >" . "<img src=\"" . CAMINHO_IMG . "success.png\">" . "</a>";

			}
		}
		return $html;
	}

}
?>