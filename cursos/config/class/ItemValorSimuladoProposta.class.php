<?php
class ItemValorSimuladoProposta extends Database {
	// class attributes
	var $idItemValorSimuladoProposta;
	var $valorSimuladoPropostaIdValorSimuladoProposta;
	var $valor;
	var $valorDescontoHora;
	var $validadeDesconto;
	var $horasPorAula;
	var $frequenciaSemanalAula;
	var $cargaHorariaFixaMensal;
	var $horaNaoGeraFf;
	var $obs;
	var $tipo;
	var $modalidadeIdModalidade;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idItemValorSimuladoProposta = "NULL";
		$this -> valorSimuladoPropostaIdValorSimuladoProposta = "NULL";
		$this -> valor = "NULL";
		$this -> valorDescontoHora = "NULL";
		$this -> validadeDesconto = "NULL";
		$this -> horasPorAula = "NULL";
		$this -> frequenciaSemanalAula = "NULL";
		$this -> cargaHorariaFixaMensal = "NULL";
		$this -> horaNaoGeraFf = "NULL";
		$this -> obs = "NULL";
		$this -> tipo = "NULL";
		$this -> modalidadeIdModalidade = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdItemValorSimuladoProposta($value) {
		$this -> idItemValorSimuladoProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValorSimuladoPropostaIdValorSimuladoProposta($value) {
		$this -> valorSimuladoPropostaIdValorSimuladoProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {

		$this -> valor = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	function setValorDescontoHora($value) {

		$this -> valorDescontoHora = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	function setValidadeDesconto($value) {
		$this -> validadeDesconto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHorasPorAula($value) {
		$this -> horasPorAula = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFrequenciaSemanalAula($value) {
		$this -> frequenciaSemanalAula = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setCargaHorariaFixaMensal($value) {
		$this -> cargaHorariaFixaMensal = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setHoraNaoGeraFf($value) {
		$this -> horaNaoGeraFf = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTipo($value) {
		$this -> tipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setModalidadeIdModalidade($value) {
		$this -> modalidadeIdModalidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addItemValorSimuladoProposta() Function
	 */
	function addItemValorSimuladoProposta() {
		$sql = "INSERT INTO itemValorSimuladoProposta (idItemValorSimuladoProposta, valorSimuladoProposta_idValorSimuladoProposta, valor, valorDescontoHora, validadeDesconto, horasPorAula, frequenciaSemanalAula, cargaHorariaFixaMensal, horaNaoGeraFf, obs, tipo, modalidade_idModalidade) VALUES ($this->idItemValorSimuladoProposta, $this->valorSimuladoPropostaIdValorSimuladoProposta, $this->valor, $this->valorDescontoHora, $this->validadeDesconto, $this->horasPorAula, $this->frequenciaSemanalAula, $this->cargaHorariaFixaMensal, $this->horaNaoGeraFf, $this->obs, $this->tipo, $this->modalidadeIdModalidade)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteItemValorSimuladoProposta() Function
	 */
	function deleteItemValorSimuladoProposta() {

		$NaoFazAulaNestaSemanaProposta = new NaoFazAulaNestaSemanaProposta();
		$where = " OR itemValorSimuladoProposta_idItemValorSimuladoProposta IN (" . $this -> idItemValorSimuladoProposta . ")";
		$NaoFazAulaNestaSemanaProposta -> deleteNaoFazAulaNestaSemanaProposta($where);

		$ProdutoAdicionalItemValorSimuladoProposta = new ProdutoAdicionalItemValorSimuladoProposta();
		$where = " OR itemValorSimuladoProposta_idItemValorSimuladoProposta IN (" . $this -> idItemValorSimuladoProposta . ")";
		$ProdutoAdicionalItemValorSimuladoProposta -> deleteProdutoAdicionalItemValorSimuladoProposta($where);

		$sql = "DELETE FROM itemValorSimuladoProposta WHERE idItemValorSimuladoProposta = $this->idItemValorSimuladoProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldItemValorSimuladoProposta() Function
	 */
	function updateFieldItemValorSimuladoProposta($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE itemValorSimuladoProposta SET " . $field . " = " . $value . " WHERE idItemValorSimuladoProposta = $this->idItemValorSimuladoProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateItemValorSimuladoProposta() Function
	 */
	function updateItemValorSimuladoProposta() {
		$sql = "UPDATE itemValorSimuladoProposta SET valorSimuladoProposta_idValorSimuladoProposta = $this->valorSimuladoPropostaIdValorSimuladoProposta, valor = $this->valor, valorDescontoHora = $this->valorDescontoHora, validadeDesconto = $this->validadeDesconto, horasPorAula = $this->horasPorAula, frequenciaSemanalAula = $this->frequenciaSemanalAula, cargaHorariaFixaMensal = $this->cargaHorariaFixaMensal, horaNaoGeraFf = $this->horaNaoGeraFf, obs = $this->obs, tipo = $this->tipo, modalidade_idModalidade = $this->modalidadeIdModalidade WHERE idItemValorSimuladoProposta = $this->idItemValorSimuladoProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectItemValorSimuladoProposta() Function
	 */
	function selectItemValorSimuladoProposta($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idItemValorSimuladoProposta, valorSimuladoProposta_idValorSimuladoProposta, valor, valorDescontoHora, validadeDesconto, horasPorAula, frequenciaSemanalAula, cargaHorariaFixaMensal, horaNaoGeraFf, obs, tipo, modalidade_idModalidade FROM itemValorSimuladoProposta " . $where;
		//echo $sql;
		//exit;
		return $this -> executeQuery($sql);
	}

	function selectItemValorSimuladoPropostaTr($where = "") {
		$sql = "SELECT SQL_CACHE idItemValorSimuladoProposta, valorSimuladoProposta_idValorSimuladoProposta, valor, valorDescontoHora, validadeDesconto, horasPorAula, frequenciaSemanalAula, cargaHorariaFixaMensal, horaNaoGeraFf, obs, tipo FROM itemValorSimuladoProposta " . $where;

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";
			$NaoFazAulaNestaSemanaProposta = new NaoFazAulaNestaSemanaProposta();

			while ($valor = mysqli_fetch_array($result)) {

				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "proposta/include/form/itemValorSimuladoProposta_abas.php?id=" . $valor['idItemValorSimuladoProposta'] . "', '" . CAMINHO_VENDAS . "proposta/include/resourceHTML/itemValorSimuladoProposta.php?id=" . $valor['valorSimuladoProposta_idValorSimuladoProposta'] . "', '#div_lista_itemValorSimuladoProposta')\" ";

				$textoAdicional = $valor['valorDescontoHora'] ? " <font color=\"#FF0000\">(desconto de R$ " . Uteis::formatarMoeda($valor['valorDescontoHora']) . " por hora até " . Uteis::exibirData($valor['validadeDesconto']) . ")</font>" : "";

				$html .= "<tr >";

				$html .= "<td " . $onclick . ">R$ " . Uteis::formatarMoeda($valor['valor']) . $textoAdicional . "</td>";

				$horas = Uteis::exibirHoras($valor['horasPorAula']);

				$cargaHorariaFixaMensal = $valor['cargaHorariaFixaMensal'] ? " <font color=\"#FF0000\">(carga horária fixa de " . Uteis::exibirHoras($valor['cargaHorariaFixaMensal']) . ")</font>" : "";

				$html .= "<td >" . $horas . $cargaHorariaFixaMensal . "</td>";

				$freq = $valor['frequenciaSemanalAula'] ? $valor['frequenciaSemanalAula'] . " vez(es) na semana" : "";
				$semanas = $NaoFazAulaNestaSemanaProposta -> selectNaoFazAulaNestaSemanaProposta(" WHERE itemValorSimuladoProposta_idItemValorSimuladoProposta = " . $valor['idItemValorSimuladoProposta']);
				$semanas = Uteis::arrayCampoEspecifico($semanas, 'semana');

				if ($semanas) {
					$freq .= " <font color=\"#FF0000\">(não fará aula na " . implode("ª, ", $semanas) . "ª semana de cada mês)</font>";
				}

				$html .= "<td>" . $freq . "</td>";

				$somaProdutosAdicionais = $this -> somaProdutosAdicionais($valor['idItemValorSimuladoProposta']);
				$padicional = $somaProdutosAdicionais ? "R$ " . Uteis::formatarMoeda($somaProdutosAdicionais) : "";
				$html .= "<td>" . $padicional . "</td>";

				$tipo = ($valor['tipo']);

				if ($tipo == 'R')
					$tipoDescricao = "Regular";
				else if ($tipo == 'T')
					$tipoDescricao = "Total";
				else if ($tipo == 'E')
					$tipoDescricao = "Exata";

				$html .= "<td>" . $tipoDescricao . "</td>";

				$valorTotal = $this -> calculoItemValorSimuladoProposta($valor['idItemValorSimuladoProposta']);

				if ($tipo == 'R')
					$totalDescricao = "R$ " . $valorTotal . " por mês";
				else if ($tipo == 'T' || $tipo == 'E')
					$totalDescricao = "total de R$ " . $valorTotal;

				$html .= "<td>" . $totalDescricao . "</td>";

				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "proposta/include/acao/itemValorSimuladoProposta.php', " . $valor['idItemValorSimuladoProposta'] . ", '" . CAMINHO_VENDAS . "proposta/include/resourceHTML/itemValorSimuladoProposta.php?id=" . $valor['valorSimuladoProposta_idValorSimuladoProposta'] . "', '#div_lista_itemValorSimuladoProposta')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	function calculoItemValorSimuladoProposta($id) {

		$ItemValorSimuladoProposta = new ItemValorSimuladoProposta();

		$where = " WHERE idItemValorSimuladoProposta = " . $id;
		$arrayItemValorSimuladoProposta = $ItemValorSimuladoProposta -> selectItemValorSimuladoProposta($where);

		$tipo = $arrayItemValorSimuladoProposta[0]['tipo'];

		$valor = $arrayItemValorSimuladoProposta[0]['valor'];

		//SOMA PRODUTOS ADICIONAIS

		$valor += $this -> somaProdutosAdicionais($id);

		$valorDescontoHora = $arrayItemValorSimuladoProposta[0]['valorDescontoHora'];

		if ($valorDescontoHora == '' || is_null($valorDescontoHora))
			$valorDescontoHora = 0;

		$horasPorAula = $arrayItemValorSimuladoProposta[0]['horasPorAula'];

		$frequenciaSemanalAula = $arrayItemValorSimuladoProposta[0]['frequenciaSemanalAula'];

		$cargaHorariaFixaMensal = $arrayItemValorSimuladoProposta[0]['cargaHorariaFixaMensal'];

		if ($cargaHorariaFixaMensal == '' || is_null($cargaHorariaFixaMensal))
			$cargaHorariaFixaMensal = 0;

		if ($tipo == 'R') {

			$NaoFazAulaNestaSemanaProposta = new NaoFazAulaNestaSemanaProposta();
			$semanasNaoFaz = $NaoFazAulaNestaSemanaProposta -> selectNaoFazAulaNestaSemanaProposta(" WHERE itemValorSimuladoProposta_idItemValorSimuladoProposta = " . $id);
			$semanasNaoFaz = count($semanasNaoFaz, 0);

			$semanasNoMes = 4 - $semanasNaoFaz;

			$horasTotais = ($frequenciaSemanalAula * $semanasNoMes) * ($horasPorAula / 60);
			$cargaHorariaFixaMensal = $cargaHorariaFixaMensal / 60;
			if ($cargaHorariaFixaMensal < $horasTotais && $cargaHorariaFixaMensal != 0)
				$horasTotais = $cargaHorariaFixaMensal;

			$total = ($valor - $valorDescontoHora) * $horasTotais;

		} elseif ($tipo == 'T') {

			$total = $valor * ($horasPorAula / 60);

		} elseif ($tipo == 'E') {

			$total = $valor;

		}
		$total = Uteis::formatarMoeda($total);

		return $total;
	}

	function somaProdutosAdicionais($id) {

		$sql = "SELECT SQL_CACHE SUM(valor) AS valor
		FROM produtoAdicional WHERE idProdutoAdicional IN (
			SELECT DISTINCT(produtoAdicional_idProdutoAdicional)
			FROM produtoAdicionalItemValorSimuladoProposta
			WHERE itemValorSimuladoProposta_idItemValorSimuladoProposta = $id
		)";
		$rs = Uteis::executarQuery($sql);
		return $rs[0]['valor'];

	}

}
?>