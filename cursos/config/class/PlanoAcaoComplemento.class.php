<?php
class PlanoAcaoComplemento extends Database {
	// class attributes
	var $idPlanoAcaoComplemento;
	var $planoAcao_idPlanoAcao;
	var $ComplementoAbordagemIdComplementoAbordagem;
	var $conteudo;
	var $ordem;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoAcaoComplemento = "NULL";
		$this -> planoAcao_idPlanoAcao = "NULL";
		$this -> ComplementoAbordagemIdComplementoAbordagem = "NULL";
		$this -> conteudo = "NULL";
		$this -> ordem = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoAcaoComplemento($value) {
		$this -> idPlanoAcaoComplemento = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setplanoAcao_idPlanoAcao($value) {
		$this -> planoAcao_idPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setComplementoAbordagemIdComplementoAbordagem($value) {
		$this -> ComplementoAbordagemIdComplementoAbordagem = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setConteudo($value) {
		$this -> conteudo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setOrdem($value) {
		$this -> ordem = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addPlanoAcaoComplemento() Function
	 */
	function addPlanoAcaoComplemento() {
		$sql = "INSERT INTO planoAcaoComplemento (planoAcao_idPlanoAcao, complementoAbordagem_idComplementoAbordagem, conteudo, ordem) VALUES ($this->planoAcao_idPlanoAcao, $this->ComplementoAbordagemIdComplementoAbordagem, $this->conteudo, $this->ordem)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deletePlanoAcaoComplemento() Function
	 */
	function deletePlanoAcaoComplemento($and = "") {
		$sql = "DELETE FROM planoAcaoComplemento WHERE idPlanoAcaoComplemento = $this->idPlanoAcaoComplemento".$and;
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldPlanoAcaoComplemento() Function
	 */
	function updateFieldPlanoAcaoComplemento($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE planoAcaoComplemento SET " . $field . " = " . $value . " WHERE idPlanoAcaoComplemento = $this->idPlanoAcaoComplemento";
		$result = $this -> query($sql, true);
	}

	/**
	 * updatePlanoAcaoComplemento() Function
	 */
	function updatePlanoAcaoComplemento() {
		$sql = "UPDATE planoAcaoComplemento SET planoAcao_idPlanoAcao = $this->planoAcao_idPlanoAcao, complementoAbordagem_idComplementoAbordagem = $this->ComplementoAbordagemIdComplementoAbordagem, conteudo = $this->conteudo, ordem = $this->ordem WHERE idPlanoAcaoComplemento = $this->idPlanoAcaoComplemento";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectPlanoAcaoComplemento() Function
	 */
	function selectPlanoAcaoComplemento($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPlanoAcaoComplemento, planoAcao_idPlanoAcao, complementoAbordagem_idComplementoAbordagem, conteudo, ordem FROM planoAcaoComplemento AS PID " . $where;
		//echo $sql;
		//exit;
		return $this -> executeQuery($sql);
	}

	function selectPlanoAcaoComplementoTr($idPlanoAcao) {

		$sql = "SELECT SQL_CACHE idPlanoAcaoComplemento, conteudo, ordem, IDE.nome, planoAcao_idPlanoAcao FROM planoAcaoComplemento PID ";
		$sql .= " INNER JOIN ComplementoAbordagem AS IDE ON IDE.idComplementoAbordagem = PID.complementoAbordagem_idComplementoAbordagem ";
		$sql .= " WHERE planoAcao_idPlanoAcao = " . $idPlanoAcao . " ORDER BY ordem";

		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$html .= "<td >" . $valor['ordem'] . "</td>";

				$html .= "<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "proposta/include/form/planoAcaoComplemento.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '" . CAMINHO_VENDAS . "proposta/include/form/planoAcaoComplemento.php?id=" . $idPlanoAcao . "', '#div_lista_ComplementoAbordagem')\" >" . $valor['nome'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "proposta/include/acao/planoAcaoComplemento.php', " . $valor['planoAcao_idPlanoAcao'] . ", '" . CAMINHO_VENDAS . "proposta/include/form/planoAcaoComplemento.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '#div_lista_ComplementoAbordagem')\" >" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;

	}

}
?>