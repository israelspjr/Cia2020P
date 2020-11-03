<?php
class ValorSimuladoProposta extends Database {
	// class attributes
	var $idValorSimuladoProposta;
	var $propostaIdProposta;
	var $nome;
	var $escolhido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idValorSimuladoProposta = "NULL";
		$this -> propostaIdProposta = "NULL";
		$this -> nome = "NULL";
		$this -> escolhido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdValorSimuladoProposta($value) {
		$this -> idValorSimuladoProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPropostaIdProposta($value) {
		$this -> propostaIdProposta = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEscolhido($value) {
		$this -> escolhido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addValorSimuladoProposta() Function
	 */
	function addValorSimuladoProposta() {
		$sql = "INSERT INTO valorSimuladoProposta (proposta_idProposta, nome, escolhido) VALUES ($this->propostaIdProposta, $this->nome, $this->escolhido)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}
  function inserirValorSimuladoProposta() {
    $sql = "INSERT INTO valorSimuladoProposta (idValorSimuladoProposta, proposta_idProposta, nome, escolhido) VALUES ($this->idValorSimuladoProposta, $this->propostaIdProposta, $this->nome, $this->escolhido)";
    $result = $this -> query($sql, true);
    return mysqli_insert_id($this -> connect);
  }

	/**
	 * deleteValorSimuladoProposta() Function
	 */
	function deleteValorSimuladoProposta() {

		//DELETAR TODOS ITEN ASSOCIADOS
		$ItemValorSimuladoProposta = new ItemValorSimuladoProposta();
		$rs = $ItemValorSimuladoProposta -> selectItemValorSimuladoProposta(" WHERE valorSimuladoProposta_idValorSimuladoProposta IN( $this->idValorSimuladoProposta )");

		if ($rs) {
			foreach ($rs as $val) {
				$ItemValorSimuladoProposta -> setIdItemValorSimuladoProposta($va['idItemValorSimuladoProposta']);
				//" OR valorSimuladoProposta_idValorSimuladoProposta IN( $this->idValorSimuladoProposta)"
				$ItemValorSimuladoProposta -> deleteItemValorSimuladoProposta();
			}
		}

		$sql = "DELETE FROM valorSimuladoProposta WHERE idValorSimuladoProposta = $this->idValorSimuladoProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldValorSimuladoProposta() Function
	 */
	function updateFieldValorSimuladoProposta($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE valorSimuladoProposta SET " . $field . " = " . $value . " WHERE idValorSimuladoProposta = $this->idValorSimuladoProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateValorSimuladoProposta() Function
	 */
	function updateValorSimuladoProposta() {
		$sql = "UPDATE valorSimuladoProposta SET proposta_idProposta = $this->propostaIdProposta, nome = $this->nome, escolhido = $this->escolhido WHERE idValorSimuladoProposta = $this->idValorSimuladoProposta";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectValorSimuladoProposta() Function
	 */
	function selectValorSimuladoProposta($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idValorSimuladoProposta, proposta_idProposta, nome, escolhido FROM valorSimuladoProposta " . $where;
		 //echo $sql;
        //exit;
		return $this -> executeQuery($sql);
	}

	function selectValorSimuladoPropostaTr($where = "") {
		$sql = "SELECT SQL_CACHE idValorSimuladoProposta, proposta_idProposta, nome, escolhido FROM valorSimuladoProposta " . $where;
		 //echo $sql;
        //exit;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			$ItemValorSimuladoProposta = new ItemValorSimuladoProposta();
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr >";

				//opção
				$temItemValorSimuladoProposta = $ItemValorSimuladoProposta -> selectItemValorSimuladoProposta(" WHERE valorSimuladoProposta_idValorSimuladoProposta = " . $valor['idValorSimuladoProposta']);

				if ($temItemValorSimuladoProposta) {

					$escolhido = $valor['escolhido'] ? " checked" : "";

					$radio = "<input type=\"radio\" name=\"radio_ValorSimuladoProposta\" id=\"radio_ValorSimuladoProposta_" . $valor['idValorSimuladoProposta'] . "\" value=\"" . $valor['idValorSimuladoProposta'] . "\" onclick=\"gravaOpcaoValorSimuladoProposta()\" " . $escolhido . " />";

				} else {
					$radio = "";
					$escolhido = "";
				}

				$html .= "<td>" . $radio . "</td>";
				//

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "proposta/include/form/valorSimuladoProposta.php?id=" . $valor['idValorSimuladoProposta'] . "', '" . CAMINHO_VENDAS . "proposta/include/resourceHTML/valorSimuladoProposta.php?id=" . $valor['proposta_idProposta'] . "', '#div_lista_ValorSimuladoProposta')\" >" . $valor['nome'] . "</td>";

				if ($escolhido != "") {
					$deleta = "<td></td>";
				} else {
					$deleta = "<td align=\"center\" onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "proposta/include/acao/valorSimuladoProposta.php', " . $valor['idValorSimuladoProposta'] . ", '" . CAMINHO_VENDAS . "proposta/include/resourceHTML/valorSimuladoProposta.php?id=" . $valor['proposta_idProposta'] . "', '#div_lista_ValorSimuladoProposta')\">" . "<img src=\"" . CAMINHO_IMG . "excluir.png\">" . "</td>";
				}

				$html .= $deleta;

				$html .= "</tr>";
			}
		}
		return $html;
	}

	function atualizarValorSimuladoPropostaEscolhido() {
		$idProposta = $this -> selectValorSimuladoProposta(" WHERE idValorSimuladoProposta = $this->idValorSimuladoProposta");
		$idProposta = $idProposta[0]['proposta_idProposta'];

		$this -> query("UPDATE valorSimuladoProposta SET escolhido = 0 WHERE proposta_idProposta = " . $idProposta);

		$this -> updateFieldValorSimuladoProposta("escolhido", 1);
	}

}
?>