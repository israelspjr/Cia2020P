<?php
class IdiomaBackgroundPerfil extends Database {
	// class attributes
	var $idIdiomaBackgroundPerfil;
	var $clientePfIdClientePf;
	var $idiomaIdIdioma;
	var $escolaIdEscola;
	var $obs;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idIdiomaBackgroundPerfil = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> escolaIdEscola = "NULL";
		$this -> obs = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdIdiomaBackgroundPerfil($value) {
		$this -> idIdiomaBackgroundPerfil = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEscolaIdEscola($value) {
		$this -> escolaIdEscola = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addIdiomabackgroundperfil() Function
	 */
	function addIdiomabackgroundperfil() {
		$sql = "INSERT INTO idiomaBackgroundPerfil (clientePf_idClientePf, idioma_idIdioma, escola_idEscola, obs) VALUES ($this->clientePfIdClientePf, $this->idiomaIdIdioma, $this->escolaIdEscola, $this->obs)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteIdiomabackgroundperfil() Function
	 */
	function deleteIdiomabackgroundperfil() {
		$sql = "DELETE FROM idiomaBackgroundPerfil WHERE idIdiomaBackgroundPerfil = $this->idIdiomaBackgroundPerfil";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldIdiomabackgroundperfil() Function
	 */
	function updateFieldIdiomabackgroundperfil($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE idiomaBackgroundPerfil SET " . $field . " = " . $value . " WHERE idIdiomaBackgroundPerfil = $this->idIdiomaBackgroundPerfil";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateIdiomabackgroundperfil() Function
	 */
	function updateIdiomabackgroundperfil() {
		$sql = "UPDATE idiomaBackgroundPerfil SET clientePf_idClientePf = $this->clientePfIdClientePf, idioma_idIdioma = $this->idiomaIdIdioma, escola_idEscola = $this->escolaIdEscola, obs = $this->obs WHERE idIdiomaBackgroundPerfil = $this->idIdiomaBackgroundPerfil";
		$result = $this -> query($sql, true);
	}

	function selectIdiomabackgroundperfil($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idIdiomaBackgroundPerfil, clientePf_idClientePf, idioma_idIdioma, escola_idEscola, obs FROM idiomaBackgroundPerfil " . $where;
		return $this -> executeQuery($sql);
	}
	
	function selectIdiomabackgroundperfilJoin($where = "", $campos = array("*")) {
		$sql = "SELECT SQL_CACHE ". implode(",", $campos)." 
		FROM idiomaBackgroundPerfil AS IB
		INNER JOIN escola AS E ON E.idEscola = IB.escola_idEscola 
		INNER JOIN idioma AS I ON I.idIdioma= IB.idioma_idIdioma 
		" . $where;
		return $this -> executeQuery($sql);
	}

	function selectIdiomabackgroundperfilTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "") {
		$sql = "SELECT SQL_CACHE idIdiomaBackgroundPerfil, clientePf_idClientePf, I.idioma, E.nome, IB.obs
		FROM idiomaBackgroundPerfil AS IB 
		LEFT JOIN idioma AS I on I.idIdioma = IB.idioma_idIdioma 
		LEFT JOIN escola AS E on E.idEscola = IB.escola_idEscola " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idIdiomaBackgroundPerfil'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . ($valor['idioma']) . "</td>";
				$html .= "<td>" . $valor['nome'] . "</td>";
                $html .= "<td>" . $valor['obs'] . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_CAD . "clientePf/include/acao/idiomaBackgroundPerfil.php', " . $valor['idIdiomaBackgroundPerfil'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

}
?>