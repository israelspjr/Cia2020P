<?php
class OpcaoDia extends Database {
	// class attributes
	var $idOpcao;
	var $escolhido;
	var $valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idOpcao = "NULL";
		$this -> escolhido = "NULL";
		$this -> valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdOpcao($value) {
		$this -> idOpcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEscolhido($value) {
		$this -> escolhido = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao($value) {
		$this -> valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addOpcaoDia() Function
	 */
	function addOpcaoDia() {
		$sql = "INSERT INTO opcaoDia (escolhido, valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao) VALUES ($this->escolhido, $this->valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteOpcaoDia() Function
	 */
	function deleteOpcaoDia($and) {

		$OpcaoDiaPlanoAcao = new OpcaoDiaPlanoAcao();
		$OpcaoDiaPlanoAcao -> deleteOpcaoDiaPlanoAcao(" OR opcaoDia_idOpcao IN( " . $this -> idOpcao . ")");

		$sql = "DELETE FROM opcaoDia WHERE idOpcao IN( $this->idOpcao ) " . $and;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldOpcaoDia() Function
	 */
	function updateFieldOpcaoDia($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE opcaoDia SET " . $field . " = " . $value . " WHERE idOpcao = $this->idOpcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateOpcaoDia() Function
	 */
	function updateOpcaoDia() {
		//escolhido = $this->escolhido,
		$sql = "UPDATE opcaoDia SET valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = $this->valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao WHERE idOpcao = $this->idOpcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectOpcaoDia() Function
	 */
	function selectOpcaoDia($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idOpcao, escolhido, valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao FROM opcaoDia " . $where;
		return $this -> executeQuery($sql);
	}


	function selectOpcaoDiaTr($where = "") {

		$sql = "SELECT SQL_CACHE idOpcao, escolhido, valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao FROM opcaoDia " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";
			$OpcaoDiaPlanoAcao = new OpcaoDiaPlanoAcao();

			$ValorSimuladoPlanoAcao = new ValorSimuladoPlanoAcao();

			while ($valor = mysqli_fetch_array($result)) {

				$html .= "<tr>";

				$escolhido = $valor['escolhido'] ? " checked" : "";
				$radio = "<input type=\"radio\" name=\"radio_opcaoDia\" id=\"radio_opcaoDia" . $valor['idOpcao'] . "\" value=\"" . $valor['idOpcao'] . "\" onclick=\"gravaOpcaoDia()\" " . $escolhido . " />";

				$html .= "<td  >" . $radio . "</td>";

				$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "planoAcao/include/form/opcaoDiaPlanoAcao.php?id=" . $valor['idOpcao'] . "', '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/opcaoDiaPlanoAcao.php?id=" . $valor['valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao'] . "', '#div_lista_OpcaoDiaPlanoAcao')\" ";

				$valorOpcaoDiaPlanoAcao = $OpcaoDiaPlanoAcao -> selectOpcaoDiaPlanoAcao(" WHERE opcaoDia_idOpcao = " . $valor['idOpcao']);

				$descricao = "";

				for ($row = 0; $row < count($valorOpcaoDiaPlanoAcao, 0); $row++) {

					$descricao .= $OpcaoDiaPlanoAcao->montarDia($valorOpcaoDiaPlanoAcao[$row]['idOpcaoDiaPlanoAcao'])."<br />";

				}

				$html .= "<td $onclick >" . $descricao . "</td>";

				$deleta = " onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "planoAcao/include/acao/opcaoDiaPlanoAcao.php', " . $valor['idOpcao'] . ", '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/opcaoDiaPlanoAcao.php?id=" . $valor['valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao'] . "', '#div_lista_OpcaoDiaPlanoAcao')\" ";
				$html .= "<td $deleta align=\"center\" >" . "<img src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";

				$html .= "</tr>";
			}
		}

		return $html;
	}

	function selectOpcaoDiaTr_T_E($where = "") {

		$sql = "SELECT SQL_CACHE idOpcao, escolhido, valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao FROM opcaoDia " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";
			$OpcaoDiaPlanoAcao = new OpcaoDiaPlanoAcao();

			while ($valor = mysqli_fetch_array($result)) {

				$valorOpcaoDiaPlanoAcao = $OpcaoDiaPlanoAcao -> selectOpcaoDiaPlanoAcao(" WHERE opcaoDia_idOpcao = " . $valor['idOpcao']);

				for ($row = 0; $row < count($valorOpcaoDiaPlanoAcao, 0); $row++) {

					$dataAula = Uteis::exibirData($valorOpcaoDiaPlanoAcao[$row]['dataAula']);
					$horaInicio = Uteis::exibirHoras($valorOpcaoDiaPlanoAcao[$row]['horaInicio']);
					$horaFim = Uteis::exibirHoras($valorOpcaoDiaPlanoAcao[$row]['horaFim']);

					$html .= "<tr>";

					$html .= "<td>" . strtotime($valorOpcaoDiaPlanoAcao[$row]['dataAula']) . "</td>";

					$html .= "<td $onclick > $dataAula das $horaInicio ás $horaFim</td>";

					$deleta = " onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "planoAcao/include/acao/opcaoDiaPlanoAcao.php?tipo=TE', " . $valorOpcaoDiaPlanoAcao[$row]['idOpcaoDiaPlanoAcao'] . ", '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/opcaoDiaPlanoAcao.php?id=" . $valor['valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao'] . "', '#div_lista_OpcaoDiaPlanoAcao')\" ";
					$html .= "<td $deleta align=\"center\" >" . "<img src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";

					$html .= "</tr>";

				}
			}
		}

		return $html;
	}

	function atualizarOpcaoDia() {

		$idValorSimuladoPlanoAcao = $this -> selectOpcaoDia(" WHERE idOpcao = $this->idOpcao");

		$idValorSimuladoPlanoAcao = $idValorSimuladoPlanoAcao[0]['valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao'];

		$this -> query("UPDATE opcaoDia SET escolhido = 0 WHERE valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = " . $idValorSimuladoPlanoAcao);

		$this -> updateFieldOpcaoDia("escolhido", 1);

	}

}
?>